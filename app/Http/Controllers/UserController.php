<?php

namespace App\Http\Controllers;

use App\Jobs\SendUserCustomEmail;
use App\Mail\customUserEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Mail;

class UserController extends Controller
{
    public function getUsers(){
        $users = User::paginate(10);
        return response()->json($users, 200);
    }

    public function emailUser(Request $request){
        
        try {
            $validated = $request->validate([
                "subject" => "required",
                "message" => "required",
            ]);
            
            $user = User::findOrFail($request->user_id);
            $admin = User::findOrFail($request->sent_by);
            $subject = $request->subject;
            $message = $request->message;
            $send_copy = $request->send_copy;

            // Mail::to($user->email)->send(new customUserEmail($user, $subject, $message));
            SendUserCustomEmail::dispatch($user, $subject, $message);
            
            if($send_copy) {
            // Mail::to($admin->email)->send(new customUserEmail($user, $subject, $message));
                SendUserCustomEmail::dispatch($user,$subject,$message,$admin);

            }
            
            return response()->json([
                "message" => "Email sent successfully"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Failed to send email: " . $e->getMessage()
            ], 400);
        }
    }


}
