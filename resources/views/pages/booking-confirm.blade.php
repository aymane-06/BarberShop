<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CutBook - Booking Confirmation</title>
    <meta name="description" content="Your barber appointment has been confirmed. View your booking details and get ready for your haircut.">
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f5f3ff',
                            100: '#ede9fe',
                            200: '#ddd6fe',
                            300: '#c4b5fd',
                            400: '#a78bfa',
                            500: '#8b5cf6',
                            600: '#7c3aed',
                            700: '#6d28d9',
                            800: '#5b21b6',
                            900: '#4c1d95',
                        },
                        secondary: {}
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
        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
        .booking-details {
            transition: all 0.3s ease;
        }
        .booking-details:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        .timeline-dot::before {
            content: '';
            position: absolute;
            left: 0;
            top: 10px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #8b5cf6;
            z-index: 10;
        }
        .timeline-line::before {
            content: '';
            position: absolute;
            left: 6px;
            top: 22px;
            width: 1px;
            height: calc(100% - 22px);
            background-color: #ddd6fe;
        }
    </style>
</head>
<body class="bg-gray-50">
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
            <div class="hidden md:flex space-x-6 text-gray-700">
                <a href="/#features" class="hover:text-primary-600 transition-colors">Features</a>
                <a href="/#how-it-works" class="hover:text-primary-600 transition-colors">How it Works</a>
                <a href="/#testimonials" class="hover:text-primary-600 transition-colors">Testimonials</a>
            </div>
            <div class="hidden md:flex items-center space-x-4">
                <a href="/login" class="text-primary-600 hover:text-primary-800 transition-colors">Log in</a>
                <a href="/register" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700 transition-colors shadow-sm">Sign Up Free</a>
            </div>
            <button id="open-menu" class="md:hidden text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden">
        <div class="mobile-menu bg-white h-full w-64 shadow-xl p-5">
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center space-x-1">
                    <svg class="w-8 h-8 text-primary-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7 21h10V7l-10 14zm2.74-7.76L12 7.5l2.26 5.74-4.52 0z"></path>
                        <path d="M18.07 2.93L16 5l2.07 2.07-1.41 1.42L13 4.83 17.59 0l1.41 1.41L16.93 3.5l2.55 2.55-1.41 1.42z"></path>
                    </svg>
                    <span class="font-bold text-xl text-primary-600">CutBook</span>
                </div>
                <button id="close-menu" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <nav class="space-y-4 text-gray-700">
                <a href="/#features" class="block hover:text-primary-600 transition-colors">Features</a>
                <a href="/#how-it-works" class="block hover:text-primary-600 transition-colors">How it Works</a>
                <a href="/#testimonials" class="block hover:text-primary-600 transition-colors">Testimonials</a>
                <a href="/login" class="block hover:text-primary-600 transition-colors mt-6">Log in</a>
                <a href="/register" class="block bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700 transition-colors shadow-sm text-center mt-2">Sign Up Free</a>
            </nav>
        </div>
    </div>

    <!-- Booking Confirmation Header -->
    <div class="bg-white py-10 border-b">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-down">
            <div class="bg-primary-50 inline-flex items-center justify-center w-16 h-16 rounded-full mb-6">
                <i class="fas fa-check text-3xl text-primary-600"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Booking Confirmed!</h1>
            <p class="text-gray-600">Your appointment has been successfully scheduled.</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Booking Details Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8 booking-details" data-aos="fade-up">
            <div class="flex flex-col md:flex-row border-b pb-6 mb-6">
                <!-- Barber Shop Info -->
                <div class="md:w-1/4 mb-4 md:mb-0">
                    <img src="https://images.unsplash.com/photo-1621605815971-fbc98d665033?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=150&h=150&q=80" 
                         alt="Classic Cuts Barber Shop" 
                         class="w-24 h-24 object-cover rounded-lg shadow-sm">
                </div>
                <!-- Booking Info -->
                <div class="md:w-3/4 md:pl-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-2">Classic Cuts Barber Shop</h2>
                    <div class="flex items-center text-gray-600 mb-4">
                        <i class="fas fa-map-marker-alt mr-2 text-primary-500"></i>
                        <span>15 Rue Saint-Honoré, Paris 1er</span>
                    </div>
                    <div class="flex flex-wrap gap-y-3">
                        <div class="w-full sm:w-1/2 flex items-center">
                            <i class="far fa-calendar-check mr-2 text-primary-500"></i>
                            <span>Wednesday, May 22, 2023</span>
                        </div>
                        <div class="w-full sm:w-1/2 flex items-center">
                            <i class="far fa-clock mr-2 text-primary-500"></i>
                            <span>2:00 PM - 2:45 PM</span>
                        </div>
                        <div class="w-full sm:w-1/2 flex items-center">
                            <i class="fas fa-user mr-2 text-primary-500"></i>
                            <span>Thomas Martin</span>
                        </div>
                        <div class="w-full sm:w-1/2 flex items-center">
                            <i class="far fa-credit-card mr-2 text-primary-500"></i>
                            <span>Pay at location</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Service Details -->
            <h3 class="font-semibold text-lg mb-4">Service Details</h3>
            <div class="space-y-4 mb-6">
                <div class="flex justify-between items-center">
                    <div class="flex items-start">
                        <i class="fas fa-cut mr-3 text-primary-500 mt-1"></i>
                        <div>
                            <p class="font-medium">Men's Haircut</p>
                            <p class="text-sm text-gray-500">45 minutes</p>
                        </div>
                    </div>
                    <span class="font-medium">€25</span>
                </div>
                <div class="flex justify-between items-center">
                    <div class="flex items-start">
                        <i class="fas fa-cut mr-3 text-primary-500 mt-1"></i>
                        <div>
                            <p class="font-medium">Beard Trim</p>
                            <p class="text-sm text-gray-500">15 minutes</p>
                        </div>
                    </div>
                    <span class="font-medium">€15</span>
                </div>
                <div class="pt-4 border-t flex justify-between items-center">
                    <span class="font-semibold">Total</span>
                    <span class="font-semibold text-primary-600">€40</span>
                </div>
            </div>
            
            <!-- Booking Code -->
            <div class="bg-gray-50 rounded-lg p-4 text-center mb-6">
                <p class="text-sm text-gray-600 mb-1">Booking Reference</p>
                <p class="text-xl font-bold text-gray-800">#CB58924</p>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="#" class="w-full bg-primary-600 hover:bg-primary-700 text-white text-center font-medium px-6 py-3 rounded-md transition-colors shadow-sm">
                    <i class="far fa-calendar-alt mr-2"></i>Add to Calendar
                </a>
                <a href="#" class="w-full border border-gray-300 hover:bg-gray-50 text-gray-800 text-center font-medium px-6 py-3 rounded-md transition-colors">
                    <i class="fas fa-pen mr-2"></i>Reschedule
                </a>
            </div>
        </div>
        
        <!-- Next Steps -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8" data-aos="fade-up" data-aos-delay="100">
            <h3 class="font-bold text-xl mb-6">What's Next</h3>
            <div class="space-y-6">
                <div class="relative pl-8 timeline-dot timeline-line">
                    <h4 class="font-medium text-gray-900 mb-1">Booking Confirmation Email</h4>
                    <p class="text-gray-600 text-sm">We've sent a confirmation email to your registered address with all your booking details.</p>
                </div>
                <div class="relative pl-8 timeline-dot timeline-line">
                    <h4 class="font-medium text-gray-900 mb-1">Reminder 24 Hours Before</h4>
                    <p class="text-gray-600 text-sm">We'll send you a reminder 24 hours before your appointment.</p>
                </div>
                <div class="relative pl-8 timeline-dot">
                    <h4 class="font-medium text-gray-900 mb-1">Arrive On Time</h4>
                    <p class="text-gray-600 text-sm">Please arrive 5-10 minutes before your scheduled time. If you need to cancel, please do so at least 24 hours in advance.</p>
                </div>
            </div>
        </div>
        
        <!-- More Options -->
        <div class="text-center" data-aos="fade-up" data-aos-delay="200">
            <h3 class="font-medium text-gray-800 mb-6">Would you like to...</h3>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="/barber-detail/1" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-800 px-5 py-3 rounded-md transition-colors shadow-sm flex items-center justify-center">
                    <i class="fas fa-store mr-2 text-primary-500"></i>
                    View Barber Profile
                </a>
                <a href="/" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-800 px-5 py-3 rounded-md transition-colors shadow-sm flex items-center justify-center">
                    <i class="fas fa-home mr-2 text-primary-500"></i>
                    Return to Home
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-1 mb-4">
                        <svg class="w-8 h-8 text-primary-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M7 21h10V7l-10 14zm2.74-7.76L12 7.5l2.26 5.74-4.52 0z"></path>
                            <path d="M18.07 2.93L16 5l2.07 2.07-1.41 1.42L13 4.83 17.59 0l1.41 1.41L16.93 3.5l2.55 2.55-1.41 1.42z"></path>
                        </svg>
                        <span class="font-bold text-xl text-white">CutBook</span>
                    </div>
                    <p class="text-gray-400 text-sm">Book your next barber appointment with ease.</p>
                </div>
                <div>
                    <h3 class="font-semibold text-lg mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-primary-400 transition-colors">Home</a></li>
                        <li><a href="#" class="hover:text-primary-400 transition-colors">Find a Barber</a></li>
                        <li><a href="#" class="hover:text-primary-400 transition-colors">How it Works</a></li>
                        <li><a href="#" class="hover:text-primary-400 transition-colors">About Us</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold text-lg mb-4">For Businesses</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-primary-400 transition-colors">Join as a Barber</a></li>
                        <li><a href="#" class="hover:text-primary-400 transition-colors">Business Dashboard</a></li>
                        <li><a href="#" class="hover:text-primary-400 transition-colors">Resources</a></li>
                        <li><a href="#" class="hover:text-primary-400 transition-colors">Partner Program</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold text-lg mb-4">Contact</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center"><i class="fas fa-envelope mr-2"></i> support@cutbook.com</li>
                        <li class="flex items-center"><i class="fas fa-phone mr-2"></i> +33 1 23 45 67 89</li>
                    </ul>
                    <div class="flex space-x-4 mt-4">
                        <a href="#" class="text-gray-400 hover:text-primary-400"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-400 hover:text-primary-400"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-400 hover:text-primary-400"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">&copy; 2023 CutBook. All rights reserved.</p>
                <div class="flex space-x-6 text-sm text-gray-400 mt-4 md:mt-0">
                    <a href="#" class="hover:text-primary-400">Privacy Policy</a>
                    <a href="#" class="hover:text-primary-400">Terms of Service</a>
                    <a href="#" class="hover:text-primary-400">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- AOS Animation Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Custom Scripts -->
    <script>
        // Initialize AOS animation
        AOS.init({
            duration: 800,
            once: true
        });

        // Mobile menu toggle
        document.getElementById('open-menu').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.remove('hidden');
        });
        
        document.getElementById('close-menu').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.add('hidden');
        });
    </script>
</body>
</html> 
