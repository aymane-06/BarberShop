<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CutBook - Reset Your Password</title>
    <meta name="description" content="Create a new password for your CutBook account to regain access to barber appointments and bookings.">
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f5f3ff', 100: '#ede9fe', 200: '#ddd6fe',
                            300: '#c4b5fd', 400: '#a78bfa', 500: '#8b5cf6',
                            600: '#7c3aed', 700: '#6d28d9', 800: '#5b21b6',
                            900: '#4c1d95',
                        },
                        secondary: {
                            50: '#f8fafc', 100: '#f1f5f9', 200: '#e2e8f0',
                            300: '#cbd5e1', 400: '#94a3b8', 500: '#64748b',
                            600: '#475569', 700: '#334155', 800: '#1e293b',
                            900: '#0f172a',
                        },
                    }
                }
            }
        }
    </script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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
            0% { transform: rotateZ(60deg) translate(-5em, 7.5em); }
            100% { transform: rotateZ(60deg) translate(5em, -7.5em); }
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
        .shake {
            animation: shake 0.82s cubic-bezier(.36,.07,.19,.97) both;
        }
        @keyframes shake {
            10%, 90% { transform: translate3d(-1px, 0, 0); }
            20%, 80% { transform: translate3d(2px, 0, 0); }
            30%, 50%, 70% { transform: translate3d(-4px, 0, 0); }
            40%, 60% { transform: translate3d(4px, 0, 0); }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm px-4 md:px-6 py-3 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="/" class="flex items-center space-x-1">
                <svg class="w-8 h-8 text-primary-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M7 21h10V7l-10 14zm2.74-7.76L12 7.5l2.26 5.74-4.52 0z"></path>
                    <path d="M18.07 2.93L16 5l2.07 2.07-1.41 1.42L13 4.83 17.59 0l1.41 1.41L16.93 3.5l2.55 2.55-1.41 1.42z"></path>
                </svg>
                <span class="font-bold text-xl text-primary-600">CutBook</span>
            </a>
            <div class="flex items-center space-x-4">
                <a href="/login" class="text-primary-600 hover:text-primary-800 transition-colors">Log In</a>
                <a href="/register" class="text-primary-600 hover:text-primary-800 transition-colors">Sign Up</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex-grow flex items-center justify-center px-4 py-10">
        <div class="w-full max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <!-- Left Column - Reset Password Form -->
            <div class="form-gradient p-8 rounded-xl shadow-lg scale-in" data-aos="fade-right">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Reset Your Password</h1>
                    <p class="text-gray-600">Create a new secure password for your account</p>
                </div>

                @if (session('status'))
                    <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            <p>{{ session('status') }}</p>
                        </div>
                    </div>
                @endif

                <form id="resetPasswordForm" class="space-y-6" method="POST" action="">
                    @csrf

                    <input type="hidden" name="token" value="">

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
                                    placeholder="your@email.com" value="{{ $email ?? old('email') }}" required autofocus readonly>
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
                                    placeholder="Enter your new password" required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <button type="button" id="togglePassword" class="text-gray-400 hover:text-gray-600 focus:outline-none" aria-label="toggle password visibility">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Confirmation Field -->
                        <div class="input-focus-effect">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input id="password_confirmation" name="password_confirmation" type="password" 
                                    class="bg-white w-full pl-10 pr-10 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                    placeholder="Confirm your new password" required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <button type="button" id="toggleConfirmPassword" class="text-gray-400 hover:text-gray-600 focus:outline-none" aria-label="toggle password visibility">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            @error('password_confirmation')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Strength Meter -->
                        <div class="hidden" id="passwordStrength"></div>

                        <div class="flex justify-between mb-1 text-xs">
                            <span>Password Strength:</span>
                            <span id="passwordStrengthText">None</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div id="passwordStrengthBar" class="bg-red-500 h-2 rounded-full" style="width: 0%"></div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit" class="btn-shine w-full py-3 px-4 bg-primary-600 hover:bg-primary-700 focus:ring-primary-500 focus:ring-offset-primary-200 text-white rounded-lg transition-all focus:outline-none focus:ring-2 focus:ring-offset-2">
                            <span class="flex justify-center items-center">
                                <i class="fas fa-key mr-2"></i>
                                <span>Reset Password</span>
                            </span>
                        </button>
                    </div>
                </form>
                
                <div class="mt-6 text-center text-sm">
                    <p class="text-gray-600">
                        Remember your password? <a href="{{ route('login') }}" class="text-primary-600 hover:text-primary-700 font-medium">Sign in here</a>
                    </p>
                </div>
            </div>

            <!-- Right Column - Illustration -->
            <div class="hidden md:block" data-aos="fade-left">
                <div class="hero-gradient rounded-xl p-8 text-white relative overflow-hidden"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white rounded-full opacity-10 transform translate-x-10 -translate-y-10"></div>
                    <div class="absolute bottom-0 left-0 w-40 h-40 bg-primary-400 rounded-full opacity-20 transform -translate-x-10 translate-y-10"></div>
                    
                    <div class="relative z-10 mb-8">
                        <h2 class="text-2xl font-bold mb-4 fade-in-up">Create a Strong Password</h2>
                        <p class="mb-6 fade-in-up" style="animation-delay: 0.1s;">A strong password helps protect your account from unauthorized access.</p>
                        <ul class="space-y-3">
                            <li class="flex items-center fade-in-up" style="animation-delay: 0.2s;"></li>
                                <i class="fas fa-check-circle text-green-300 mr-2"></i>
                                <span>Use at least 8 characters</span>
                            </li>
                            <li class="flex items-center fade-in-up" style="animation-delay: 0.3s;">
                                <i class="fas fa-check-circle text-green-300 mr-2"></i>
                                <span>Include uppercase and lowercase letters</span>
                            </li>
                            <li class="flex items-center fade-in-up" style="animation-delay: 0.4s;">
                                <i class="fas fa-check-circle text-green-300 mr-2"></i>
                                <span>Add numbers and special characters</span>
                            </li>
                        </ul>
                    </div>

                    <img src="https://images.unsplash.com/photo-1560157368-946d9c8f7cb6?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&h=350&q=80" 
                         alt="Password Security" 
                         class="rounded-lg shadow-lg w-full h-48 object-cover floating">

                    <div class="mt-6 bg-white bg-opacity-20 p-4 rounded-lg backdrop-filter backdrop-blur-sm fade-in-up" style="animation-delay: 0.5s;">
                        <p class="italic font-light">"I reset my password in seconds and was back to booking appointments right away!" - Alex</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white py-6 border-t">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <p class="text-sm text-gray-500">&copy; 2023 CutBook. All rights reserved.</p>
                <div class="flex space-x-4">
                    <a href="/privacy" class="text-sm text-gray-500 hover:text-gray-700 transition-colors">Privacy Policy</a>
                    <a href="/terms" class="text-sm text-gray-500 hover:text-gray-700 transition-colors">Terms of Service</a>
                    <a href="/contact" class="text-sm text-gray-500 hover:text-gray-700 transition-colors">Contact Us</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- AOS Animation Library Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Custom Scripts -->
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });

        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Toggle confirm password visibility
        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password_confirmation');
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Password strength meter
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthBar = document.getElementById('passwordStrengthBar');
            const strengthText = document.getElementById('passwordStrengthText');

            if (password.length > 0) {
                // Calculate strength
                let strength = 0;

                // Length contribution
                if (password.length >= 8) strength += 25;

                // Character type contribution
                if (/[A-Z]/.test(password)) strength += 25; // Uppercase
                if (/[a-z]/.test(password)) strength += 25; // Lowercase
                if (/[0-9]/.test(password)) strength += 15; // Numbers
                if (/[^A-Za-z0-9]/.test(password)) strength += 10; // Special chars

                // Update strength bar
                strengthBar.style.width = strength + '%';

                // Update color and text based on strength
                if (strength < 30) {
                    strengthBar.className = 'bg-red-500 h-2 rounded-full';
                    strengthText.textContent = 'Weak';
                } else if (strength < 60) {
                    strengthBar.className = 'bg-yellow-500 h-2 rounded-full';
                    strengthText.textContent = 'Medium';
                } else {
                    strengthBar.className = 'bg-green-500 h-2 rounded-full';
                    strengthText.textContent = 'Strong';
                }
            } else {
                strengthBar.style.width = '0%';
                strengthText.textContent = 'None';
            }
        });
    </script>
</body>
</html>
