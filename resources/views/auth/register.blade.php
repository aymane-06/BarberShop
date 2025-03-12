<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CutBook - Create Your Account</title>
    <meta name="description" content="Sign up for a CutBook account to book barber appointments, manage your bookings and more.">
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
        .slide-in-right {
            animation: slideInRight 0.5s ease-out forwards;
        }
        @keyframes slideInRight {
            0% { transform: translateX(100px); opacity: 0; }
            100% { transform: translateX(0); opacity: 1; }
        }
        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
        .scale-in {
            animation: scaleIn 0.5s ease-out forwards;
        }
        @keyframes scaleIn {
            0% { transform: scale(0.9); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
        .bounce-in {
            animation: bounceIn 0.5s ease-out forwards;
        }
        @keyframes bounceIn {
            0% { transform: scale(0.3); opacity: 0; }
            50% { transform: scale(1.05); }
            70% { transform: scale(0.9); }
            100% { transform: scale(1); opacity: 1; }
        }
        .progress-step {
            transition: all 0.3s ease;
        }
        .progress-step.active {
            color: #6d28d9;
            font-weight: 600;
        }
        .progress-bar {
            transition: width 0.5s ease;
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
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex-grow flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <!-- Left Column - Register Form -->
            <div class="form-gradient p-8 rounded-xl shadow-lg scale-in order-2 md:order-1" data-aos="fade-up">
                <div class="text-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Create Your Account</h1>
                    <p class="text-gray-600">Join CutBook and book your perfect haircut</p>
                </div>

                <!-- Registration Progress Indicator -->
                <div class="mb-6">
                    <div class="flex justify-between mb-2">
                        <span id="step1" class="progress-step active text-sm">Personal Info</span>
                        <span id="step2" class="progress-step text-sm">Account Setup</span>
                        <span id="step3" class="progress-step text-sm">Preferences</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                        <div id="progressBar" class="bg-primary-600 h-2 rounded-full progress-bar" style="width: 33.3%"></div>
                    </div>
                </div>

                <form id="registerForm" class="space-y-4" action="" method="POST">
                    @csrf
                    
                    <!-- Step 1: Personal Information -->
                    <div id="step1Fields" class="space-y-4 slide-in-right">
                        <!-- Full Name Field -->
                        <div class="input-focus-effect">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                                <input id="name" name="name" type="text" 
                                    class="bg-white w-full pl-10 pr-3 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                    placeholder="John Doe" required autofocus>
                            </div>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="input-focus-effect">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                                <input id="email" name="email" type="email" 
                                    class="bg-white w-full pl-10 pr-3 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                    placeholder="your@email.com" required>
                            </div>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone Field -->
                        <div class="input-focus-effect">
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-phone text-gray-400"></i>
                                </div>
                                <input id="phone" name="phone" type="tel" 
                                    class="bg-white w-full pl-10 pr-3 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                    placeholder="(123) 456-7890">
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="button" id="nextToStep2" class="btn-shine w-full bg-primary-600 hover:bg-primary-700 text-white py-3 px-6 rounded-lg font-medium transition-colors shadow-md">
                                Continue
                                <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 2: Account Setup -->
                    <div id="step2Fields" class="space-y-4 hidden">
                        <!-- Password Field -->
                        <div class="input-focus-effect">
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input id="password" name="password" type="password" 
                                    class="bg-white w-full pl-10 pr-10 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                    placeholder="••••••••" required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <button type="button" id="togglePassword" class="text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-eye" id="eyeIcon"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Password Confirmation Field -->
                        <div class="input-focus-effect">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input id="password_confirmation" name="password_confirmation" type="password" 
                                    class="bg-white w-full pl-10 pr-3 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                    placeholder="••••••••" required>
                            </div>
                        </div>

                        <!-- Password Strength Indicator -->
                        <div class="hidden" id="passwordStrength">
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div id="strengthBar" class="bg-red-500 h-2 rounded-full transition-all" style="width: 0%"></div>
                            </div>
                            <p id="strengthText" class="text-xs mt-1 text-gray-500">Password strength: Weak</p>
                        </div>

                        <div class="flex gap-3 pt-2">
                            <button type="button" id="backToStep1" class="w-1/3 border border-gray-300 text-gray-700 py-3 px-6 rounded-lg font-medium hover:bg-gray-50 transition-colors">
                                <i class="fas fa-arrow-left mr-2"></i> Back
                            </button>
                            <button type="button" id="nextToStep3" class="btn-shine w-2/3 bg-primary-600 hover:bg-primary-700 text-white py-3 px-6 rounded-lg font-medium transition-colors shadow-md">
                                Continue
                                <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 3: Preferences -->
                    <div id="step3Fields" class="space-y-4 hidden">
                        <!-- Gender Selection -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                            <div class="grid grid-cols-3 gap-3">
                                <label class="flex items-center justify-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="gender" value="male" class="hidden">
                                    <span class="text-center">
                                        <i class="fas fa-mars text-blue-500 block mb-1"></i>
                                        Male
                                    </span>
                                </label>
                                <label class="flex items-center justify-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="gender" value="female" class="hidden">
                                    <span class="text-center">
                                        <i class="fas fa-venus text-pink-500 block mb-1"></i>
                                        Female
                                    </span>
                                </label>
                                <label class="flex items-center justify-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="gender" value="other" class="hidden">
                                    <span class="text-center">
                                        <i class="fas fa-genderless text-purple-500 block mb-1"></i>
                                        Other
                                    </span>
                                </label>
                            </div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="flex items-center">
                            <input id="terms" name="terms" type="checkbox" required
                                class="h-4 w-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <label for="terms" class="ml-2 block text-sm text-gray-700">
                                I agree to the <a href="/terms" class="text-primary-600 hover:text-primary-800">Terms and Conditions</a> 
                                and <a href="/privacy" class="text-primary-600 hover:text-primary-800">Privacy Policy</a>
                            </label>
                        </div>

                        <!-- Newsletter -->
                        <div class="flex items-center">
                            <input id="newsletter" name="newsletter" type="checkbox"
                                class="h-4 w-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <label for="newsletter" class="ml-2 block text-sm text-gray-700">
                                Send me updates about promotions and special offers
                            </label>
                        </div>

                        <div class="flex gap-3 pt-2">
                            <button type="button" id="backToStep2" class="w-1/3 border border-gray-300 text-gray-700 py-3 px-6 rounded-lg font-medium hover:bg-gray-50 transition-colors">
                                <i class="fas fa-arrow-left mr-2"></i> Back
                            </button>
                            <button type="submit" class="btn-shine w-2/3 bg-primary-600 hover:bg-primary-700 text-white py-3 px-6 rounded-lg font-medium transition-colors shadow-md">
                                Create Account
                                <i class="fas fa-check ml-2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Social Sign Up -->
                    <div class="relative mt-8">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-gradient-to-r from-white via-gray-50 to-white text-gray-500">or sign up with</span>
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

                    <!-- Login Link -->
                    <div class="text-center mt-6">
                        <p class="text-gray-600">
                            Already have an account? 
                            <a href="/login" class="text-primary-600 hover:text-primary-800 font-medium">
                                Log in
                            </a>
                        </p>
                    </div>
                </form>
            </div>

            <!-- Right Column - Image and Text -->
            <div class="hidden md:block relative order-1 md:order-2" data-aos="fade-left">
                <div class="hero-gradient rounded-xl p-8 text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white rounded-full opacity-10 transform translate-x-10 -translate-y-10"></div>
                    <div class="absolute bottom-0 left-0 w-40 h-40 bg-primary-400 rounded-full opacity-20 transform -translate-x-10 translate-y-10"></div>
                    
                    <div class="relative z-10 mb-8">
                        <h2 class="text-2xl font-bold mb-4 bounce-in">Join CutBook Today!</h2>
                        <p class="mb-6 fade-in">Create your account to enjoy effortless booking for haircuts, personalized recommendations, and exclusive offers.</p>
                        <ul class="space-y-3">
                            <li class="flex items-center slide-in-right" style="animation-delay: 0.1s;">
                                <i class="fas fa-check-circle text-green-300 mr-2"></i>
                                <span>Book appointments 24/7</span>
                            </li>
                            <li class="flex items-center slide-in-right" style="animation-delay: 0.2s;">
                                <i class="fas fa-check-circle text-green-300 mr-2"></i>
                                <span>Get reminder notifications</span>
                            </li>
                            <li class="flex items-center slide-in-right" style="animation-delay: 0.3s;">
                                <i class="fas fa-check-circle text-green-300 mr-2"></i>
                                <span>Access exclusive discounts</span>
                            </li>
                        </ul>
                    </div>

                    <img src="https://images.unsplash.com/photo-1521490858495-2afb6f0e9e52?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&h=350&q=80" 
                         alt="Barber Shop" 
                         class="rounded-lg shadow-lg w-full h-48 object-cover floating">

                    <div class="mt-6 bg-white bg-opacity-20 p-4 rounded-lg backdrop-filter backdrop-blur-sm fade-in" style="animation-delay: 0.4s;">
                        <p class="italic font-light">"Signing up took less than a minute, and I booked my first appointment right away!" - Jason</p>
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

    <!-- JavaScript -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS animation
        AOS.init({
            once: true,
            duration: 800,
        });
        
        // Multi-step form navigation
        const step1 = document.getElementById('step1');
        const step2 = document.getElementById('step2');
        const step3 = document.getElementById('step3');
        const step1Fields = document.getElementById('step1Fields');
        const step2Fields = document.getElementById('step2Fields');
        const step3Fields = document.getElementById('step3Fields');
        const progressBar = document.getElementById('progressBar');
        
        // Navigation buttons
        document.getElementById('nextToStep2').addEventListener('click', function() {
            step1Fields.classList.add('hidden');
            step2Fields.classList.add('slide-in-right');
            step2Fields.classList.remove('hidden');
            step1.classList.remove('active');
            step2.classList.add('active');
            progressBar.style.width = '66.6%';
        });
        
        document.getElementById('backToStep1').addEventListener('click', function() {
            step2Fields.classList.add('hidden');
            step1Fields.classList.remove('hidden');
            step2.classList.remove('active');
            step1.classList.add('active');
            progressBar.style.width = '33.3%';
        });
        
        document.getElementById('nextToStep3').addEventListener('click', function() {
            step2Fields.classList.add('hidden');
            step3Fields.classList.add('slide-in-right');
            step3Fields.classList.remove('hidden');
            step2.classList.remove('active');
            step3.classList.add('active');
            progressBar.style.width = '100%';
        });
        
        document.getElementById('backToStep2').addEventListener('click', function() {
            step3Fields.classList.add('hidden');
            step2Fields.classList.remove('hidden');
            step3.classList.remove('active');
            step2.classList.add('active');
            progressBar.style.width = '66.6%';
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
        });
        
        // Password strength meter
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const passwordStrength = document.getElementById('passwordStrength');
            const strengthBar = document.getElementById('strengthBar');
            const strengthText = document.getElementById('strengthText');
            
            if (password.length > 0) {
                passwordStrength.classList.remove('hidden');
                
                // Simple strength calculation
                const strength = calculatePasswordStrength(password);
                
                if (strength < 30) {
                    strengthBar.style.width = '33%';
                    strengthBar.className = 'bg-red-500 h-2 rounded-full transition-all';
                    strengthText.textContent = 'Password strength: Weak';
                } else if (strength < 60) {
                    strengthBar.style.width = '66%';
                    strengthBar.className = 'bg-yellow-500 h-2 rounded-full transition-all';
                    strengthText.textContent = 'Password strength: Medium';
                } else {
                    strengthBar.style.width = '100%';
                    strengthBar.className = 'bg-green-500 h-2 rounded-full transition-all';
                    strengthText.textContent = 'Password strength: Strong';
                }
            } else {
                passwordStrength.classList.add('hidden');
            }
        });
        
        // Simple password strength calculation
        function calculatePasswordStrength(password) {
            let strength = 0;
            if (password.length >= 8) strength += 25;
            if (/[A-Z]/.test(password)) strength += 25;
            if (/[0-9]/.test(password)) strength += 25;
            if (/[^A-Za-z0-9]/.test(password)) strength += 25;
            return strength;
        }
        
        // Style selected gender
        document.querySelectorAll('input[name="gender"]').forEach(input => {
            input.addEventListener('change', function() {
                // Reset all labels
                document.querySelectorAll('input[name="gender"]').forEach(radio => {
                    radio.parentElement.classList.remove('bg-primary-50', 'border-primary-500');
                    radio.parentElement.classList.add('border-gray-300');
                });
                
                // Style selected label
                if (this.checked) {
                    this.parentElement.classList.remove('border-gray-300');
                    this.parentElement.classList.add('bg-primary-50', 'border-primary-500');
                }
            });
        });
    </script>
</body>
</html>