@extends('layouts.auth')

@section('additional_styles')
<style>
    body {
        font-family: 'Poppins', sans-serif;
        scroll-behavior: smooth;
    }
    .hero-gradient {
        background: linear-gradient(135deg, rgba(109, 40, 217, 0.95) 0%, rgba(91, 33, 182, 0.8) 100%);
    }
    .form-gradient {
        background: linear-gradient(145deg, #ffffff 0%, #f5f3ff 100%);
    }
    .floating {
        animation: float 6s ease-in-out infinite;
    }
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
        100% { transform: translateY(0px); }
    }
    .pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: .7; }
    }
    .input-focus-effect {
        position: relative;
        overflow: hidden;
    }
    .input-focus-effect::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: #7c3aed;
        transform: translateX(-100%);
        transition: transform 0.3s ease;
    }
    .input-focus-effect:focus-within::after {
        transform: translateX(0);
    }
    .btn-shine {
        position: relative;
        overflow: hidden;
    }
    .btn-shine::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        bottom: -50%;
        left: -50%;
        background: linear-gradient(to bottom, rgba(229, 172, 142, 0), rgba(255, 255, 255, 0.5) 50%, rgba(229, 172, 142, 0));
        transform: rotateZ(60deg) translate(-5em, 7.5em);
        animation: shine 3s infinite;
    }
    @keyframes shine {
        0% {
            transform: rotateZ(60deg) translate(-5em, 7.5em);
        }
        100% {
            transform: rotateZ(60deg) translate(5em, -7.5em);
        }
    }
    .show-password {
        transition: opacity 0.3s ease;
    }
    .shake {
        animation: shake 0.82s cubic-bezier(.36,.07,.19,.97) both;
    }
    @keyframes shake {
        10%, 90% { transform: translate3d(-1px, 0, 0); }
        20%, 80% { transform: translate3d(2px, 0, 0); }
        30%, 50%, 70% { transform: translate3d(-4px, 0, 0); }
        40%, 60% { transform: translate3d(4px, 0, 0); }
    }
    .scale-in {
        animation: scaleIn 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
    }
    @keyframes scaleIn {
        0% { transform: scale(0.8); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }
    .fade-in-up {
        animation: fadeInUp 0.6s cubic-bezier(0.39, 0.575, 0.565, 1) forwards;
    }
    @keyframes fadeInUp {
        0% { transform: translateY(20px); opacity: 0; }
        100% { transform: translateY(0); opacity: 1; }
    }
</style>
@endsection

@section('content')
<div class="flex-grow flex items-center justify-center px-4 py-10">
    <div class="w-full max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <!-- Left Column - Reset Password Form -->
        <div class="form-gradient p-8 rounded-xl shadow-lg scale-in" data-aos="fade-right">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Reset Password</h1>
                <p class="text-gray-600">Enter your new password below</p>
            </div>

            <form id="resetPasswordForm" class="space-y-6" action="{{ route('reset-password.submit') }}" method="POST">
                @csrf
                <!-- Hidden token field -->
                <input type="hidden" name="token" value="{{ request()->token }}">
                
                <div class="space-y-4">
                    <!-- Email Field -->
                    <div class="input-focus-effect">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input id="email" name="email" type="email" 
                                class="bg-white w-full pl-10 pr-3 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                placeholder="your@email.com" required autocomplete="email" value="{{ request()->email ?? old('email') }}" readonly>
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="input-focus-effect">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input id="password" name="password" type="password" 
                                class="bg-white w-full pl-10 pr-10 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                placeholder="••••••••" required autofocus>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="button" id="togglePassword" class="text-gray-400 hover:text-gray-600 show-password">
                                    <i class="fas fa-eye" id="eyeIcon"></i>
                                </button>
                            </div>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="input-focus-effect">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input id="password_confirmation" name="password_confirmation" type="password" 
                                class="bg-white w-full pl-10 pr-10 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                placeholder="••••••••" required>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="button" id="toggleConfirmPassword" class="text-gray-400 hover:text-gray-600 show-password">
                                    <i class="fas fa-eye" id="confirmEyeIcon"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reset Password Button -->
                <div>
                    <button type="submit" class="btn-shine w-full bg-primary-600 hover:bg-primary-700 text-white py-3 px-6 rounded-lg font-medium transition-colors shadow-md">
                        Reset Password
                        <i class="fas fa-key ml-2"></i>
                    </button>
                </div>

                <!-- Login Link -->
                <div class="text-center mt-6">
                    <p class="text-gray-600">
                        Remember your password? 
                        <a href="{{ route('login') }}" class="text-primary-600 hover:text-primary-800 font-medium">
                            Back to login
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Right Column - Image and Text -->
        <div class="hidden md:block relative" data-aos="fade-left">
            <div class="hero-gradient rounded-xl p-8 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white rounded-full opacity-10 transform translate-x-10 -translate-y-10 pulse"></div>
                <div class="absolute bottom-0 left-0 w-40 h-40 bg-primary-400 rounded-full opacity-20 transform -translate-x-10 translate-y-10 pulse"></div>
                
                <div class="relative z-10 mb-8">
                    <h2 class="text-2xl font-bold mb-4 fade-in-up">Password Reset</h2>
                    <p class="mb-6 fade-in-up" style="animation-delay: 0.1s;">Create a strong new password for your CutBook account to keep your information safe and secure.</p>
                    <div class="flex items-center space-x-3 fade-in-up" style="animation-delay: 0.2s;">
                        <div class="flex">
                            <i class="fas fa-shield-alt text-yellow-300"></i>
                        </div>
                        <span>Your security is our priority</span>
                    </div>
                </div>

                <img src="https://images.unsplash.com/photo-1580618672591-eb180b1a973f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&h=350&q=80" 
                    alt="Secure Password" 
                    class="rounded-lg shadow-lg w-full h-48 object-cover floating">

                <div class="mt-6 bg-white bg-opacity-20 p-4 rounded-lg backdrop-filter backdrop-blur-sm fade-in-up" style="animation-delay: 0.3s;">
                    <p class="italic font-light">"For your security, choose a password that is at least 8 characters long with a mix of letters, numbers and symbols."</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('additional_scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    // Initialize AOS animation
    AOS.init({
        once: true,
        duration: 800,
    });
    
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
    
    // Toggle confirm password visibility
    document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password_confirmation');
        const eyeIcon = document.getElementById('confirmEyeIcon');
        
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
    document.getElementById('resetPasswordForm').addEventListener('submit', function(e) {
        let valid = true;
        const password = document.getElementById('password');
        const passwordConfirm = document.getElementById('password_confirmation');
        
        if (password.value.length < 8) {
            password.classList.add('shake');
            password.classList.add('border-red-500');
            setTimeout(() => {
                password.classList.remove('shake');
            }, 820);
            valid = false;
        } else {
            password.classList.remove('border-red-500');
        }
        
        if (password.value !== passwordConfirm.value) {
            passwordConfirm.classList.add('shake');
            passwordConfirm.classList.add('border-red-500');
            setTimeout(() => {
                passwordConfirm.classList.remove('shake');
            }, 820);
            valid = false;
        } else {
            passwordConfirm.classList.remove('border-red-500');
        }
        
        if (!valid) {
            e.preventDefault();
        }
    });
</script>
@endsection