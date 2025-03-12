<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CutBook - Barber Appointment System')</title>
    <meta name="description" content="@yield('meta_description', 'Manage your barber appointments with CutBook - book, reschedule, and cancel appointments with ease.')">
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
            50% { transform: translateY(-15p</div>x); }
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
       </div>     position: absolute;
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
        .pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: .7; }
        }
        /* Additional animations and styles from individual pages */
        @yield('additional_styles')
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
                @yield('nav_links')
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex-grow flex items-center justify-center px-4 py-10">
        <div class="w-full max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <!-- Left Column - Form -->
            <div class="form-gradient p-8 rounded-xl shadow-lg scale-in @yield('form_column_classes')" data-aos="fade-right">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">@yield('form_title')</h1>
                    <p class="text-gray-600">@yield('form_subtitle')</p>
                </div>

                @yield('alerts')

                @yield('form_content')
            </div>

            <!-- Right Column - Image and Text -->
            <div class="hidden md:block relative @yield('image_column_classes')" data-aos="fade-left">
                <div class="hero-gradient rounded-xl p-8 text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white rounded-full opacity-10 transform translate-x-10 -translate-y-10"></div>
                    <div class="absolute bottom-0 left-0 w-40 h-40 bg-primary-400 rounded-full opacity-20 transform -translate-x-10 translate-y-10"></div>
                    
                    <div class="relative z-10 mb-8">
                        @yield('image_content')
                    </div>

                    @yield('hero_image')

                    <div class="mt-6 bg-white bg-opacity-20 p-4 rounded-lg backdrop-filter backdrop-blur-sm fade-in-up" style="animation-delay: 0.5s;">
                        @yield('testimonial')
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
        
        // Common JavaScript functionality
        @yield('scripts')
    </script>
</body>
</html>