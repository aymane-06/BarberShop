@extends('layouts.auth')

@section('title', 'CutBook - Login to Your Account')
@section('meta_description', 'Log in to your CutBook account to book barber appointments, manage your bookings and more.')

@section('additional_styles')
.show-password {
    transition: opacity 0.3s ease;
}
@endsection

@section('nav_links')
<a href="/register" class="text-primary-600 hover:text-primary-800 transition-colors">Sign Up</a>
@endsection

@section('form_title', 'Welcome Back')
@section('form_subtitle', 'Log in to manage your appointments')

@section('form_content')
<form id="loginForm" class="space-y-6" action="{{ route('login') }}" method="POST">
    @csrf

    <div class="space-y-4">
        <!-- Email Field -->
        <div class="input-focus-effect">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-gray-400"></i>
                </div>
                <input id="email" name="email" type="email" 
                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                    placeholder="your@email.com" required autofocus value="{{ old('email') }}">
            </div>
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password Field -->
        <div class="input-focus-effect">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-gray-400"></i>
                </div>
                <input id="password" name="password" type="password" 
                    class="block w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                    placeholder="••••••••" required>
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <button type="button" id="togglePassword" class="text-gray-400 hover:text-gray-600 focus:outline-none show-password">
                        <i id="eyeIcon" class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me Checkbox -->
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input id="remember" name="remember" type="checkbox" 
                    class="h-4 w-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500"
                    {{ old('remember') ? 'checked' : '' }}>
                <label for="remember" class="ml-2 block text-sm text-gray-700">
                    Remember me
                </label>
            </div>
            <a href="{{ route('password.request') }}" class="text-sm text-primary-600 hover:text-primary-800 transition-colors">
                Forgot password?
            </a>
        </div>
    </div>

    <!-- Login Button -->
    <div>
        <button type="submit" class="btn-shine w-full bg-primary-600 hover:bg-primary-700 text-white py-3 px-6 rounded-lg font-medium transition-colors shadow-md">
            Log in
            <i class="fas fa-arrow-right ml-2"></i>
        </button>
    </div>

    <!-- Social Login -->
    <div class="relative mt-8">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-300"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="px-4 bg-gradient-to-r from-white via-gray-50 to-white text-gray-500">or continue with</span>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4 mt-4">
        <a href="#" class="flex items-center justify-center py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
            <i class="fab fa-google text-red-500 mr-2"></i>
            <span>Google</span>
        </a>
        <a href="#" class="flex items-center justify-center py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
            <i class="fab fa-facebook-f text-blue-600 mr-2"></i>
            <span>Facebook</span>
        </a>
    </div>

    <!-- Sign Up Link -->
    <div class="text-center mt-6">
        <p class="text-gray-600">
            Don't have an account? 
            <a href="{{ route('register') }}" class="text-primary-600 hover:text-primary-800 font-medium">
                Sign up now
            </a>
        </p>
    </div>
</form>
@endsection

@section('image_content')
<h2 class="text-2xl font-bold mb-4 fade-in-up">Welcome Back to CutBook!</h2>
<p class="mb-6 fade-in-up" style="animation-delay: 0.1s;">Access your account to book your next perfect haircut or manage your existing appointments.</p>
<div class="flex items-center space-x-3 fade-in-up" style="animation-delay: 0.2s;">
    <div class="flex">
        <i class="fas fa-star text-yellow-300"></i>
        <i class="fas fa-star text-yellow-300"></i>
        <i class="fas fa-star text-yellow-300"></i>
        <i class="fas fa-star text-yellow-300"></i>
        <i class="fas fa-star-half-alt text-yellow-300"></i>
    </div>
    <span>4.8/5 from over 2,000 reviews</span>
</div>
@endsection

@section('hero_image')
<img src="https://images.unsplash.com/photo-1599351431202-1e0f0137899a?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&h=350&q=80" 
    alt="Barber Shop" 
    class="rounded-lg shadow-lg w-full h-48 object-cover floating">
@endsection

@section('testimonial')
<p class="italic font-light">"CutBook has made booking my monthly haircut so easy. No more waiting in line!" - Michael</p>
@endsection

@section('scripts')
// Toggle password visibility
document.getElementById('togglePassword').addEventListener('click', function() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
    }

    // Add shine effect to button
    this.classList.add('pulse');
    setTimeout(() => this.classList.remove('pulse'), 300);
});

// Form validation animation
document.getElementById('loginForm').addEventListener('submit', function(e) {
    let valid = true;
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    
    if (!email.value.includes('@') || !email.value.includes('.')) {
        email.classList.add('shake');
        email.classList.add('border-red-500');
        setTimeout(() => {
            email.classList.remove('shake');
        }, 820);
        valid = false;
    } else {
        email.classList.remove('border-red-500');
    }
    
    if (password.value.length < 6) {
        password.classList.add('shake');
        password.classList.add('border-red-500');
        setTimeout(() => {
            password.classList.remove('shake');
        }, 820);
        valid = false;
    } else {
        password.classList.remove('border-red-500');
    }
    
    if (!valid) {
        e.preventDefault();
    }
});
@endsection