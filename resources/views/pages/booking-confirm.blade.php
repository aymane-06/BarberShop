@extends('layouts.app')
@section('additional_styles')
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
@endsection
    
@section('content')



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
    @endsection
    
    @section('additional_scripts')
    

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
    @endsection


