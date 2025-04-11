<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Jobs\SendFrogetPasswordJob;
use App\Jobs\SendVerficationEmailJob;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Str;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Process login request
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Show registration form
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Process registration request
     */
    public function register(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:client,admin,barber',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'role' => $validated['role'],
            'password' => bcrypt($validated['password']),
        ]);

        auth()->login($user);
        
        $this->emailVerification();

        // return redirect()->route('home');
        return redirect()->route('email.verifyUser');
    }

    /**
     * Show forgot password form
     */
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    /**
     * Process forgot password request
     */
    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users']);

        // Generate a new token
        $token = \Illuminate\Support\Str::random(64);
        
        // Store the token in the password resets table
        \DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'email' => $request->email,
                'token' => bcrypt($token),
                'created_at' => now()
            ]
        );
        
        // Send the custom reset password email
        // \Mail::to($request->email)->send(new \App\Mail\CustomResetPassword($token, $request->email));
        // Send the email verification job to the queue
        SendFrogetPasswordJob::dispatch($token, $request->email);
        
        return back()->with(['status' => 'We have emailed your password reset link!']);
    }

    /**
     * Show reset password form
     */
    public function showResetPassword()
    {
        return view('auth.passwords.reset');
    }

    /**
     * Process reset password request
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = \Illuminate\Support\Facades\Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->save();
            }
        );

        return $status === \Illuminate\Support\Facades\Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    /**
     * Process logout request
     */
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function emailVerification(){
        $token = \Illuminate\Support\Str::random(64);
        $user = auth()->user();
        $token=hash('sha256', $token);
        $user->email_verification_token = $token;
        $user->email_verified_at = null;
        $user->save();
        // dd($user->email_verification_token);
        $verificationUrl=\Illuminate\Support\Facades\URL::temporarySignedRoute(
            'email.verify', now()->addMinutes(60), ['token' => $token, 'email' => $user->email]
        );

        // \Mail::to($user->email)->send(new \App\Mail\EmailVerification($verificationUrl, $user));
        // Send the email verification job to the queue
        SendVerficationEmailJob::dispatch($user, $verificationUrl);
        return redirect()->route('email.verifyUser');
    }

    public function verifyEmail(Request $request){
        
        
        $user = User::where('email', $request->email)->first();
        $verified=true;
        if (! hash_equals((string) $request->token, (string) $user->email_verification_token)) {
           $verified=false;
        }

        $user->email_verified_at=now();
        $user->email_verification_token=null;
        $user->save();
        auth()->login($user);
        return view('auth.emailVerification',compact('verified'));
    }

    public function showEmailVerification(){
        return view('auth.verifyUserEmail');
    }

    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        //   dd($socialUser);
            $user = User::firstOrCreate(
                [
                    'email' => $socialUser->getEmail(),
                ],
                [
                    'provider' => $provider,
                    'provider_id' => $socialUser->id,
                    'name' => $socialUser->getName(),
                    'password' => bcrypt(Str::random(24)),
                    'provider_token' => $socialUser->token ?? null,
                    'avatar' => $socialUser->avatar ?? null,
                    'role' => 'client', 
                    'email_verified_at' => now() 
                ]
            );
            
            // dd($user);
            
            Auth::login($user, true);

            return redirect()->route('home');

        } catch (\Exception $e) {
            return redirect('/login')->withErrors([
                'socialite' => 'Unable to authenticate using '.ucfirst($provider)
            ]);
        }
    }

    public function redirect($provider)
    {
    //   dd($provider);
        return Socialite::driver($provider)->redirect();
    }
}
