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
            <div class="
            {{ $booking->status == 'pending' ? 'bg-yellow-50' : ($booking->status == 'confirmed' ? 'bg-primary-50' : ($booking->status == 'completed' ? 'bg-green-50' : 'bg-red-50')) }}
            inline-flex items-center justify-center w-16 h-16 rounded-full mb-6">
            <i class="
                {{ $booking->status == 'pending' ? 'fas fa-clock text-yellow-600' : 
                   ($booking->status == 'confirmed' ? 'fas fa-check text-primary-600' : 
                   ($booking->status == 'completed' ? 'fas fa-check-double text-green-600' : 
                   'fas fa-times text-red-600')) }}
                text-3xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">
            @if($booking->status == 'pending')
                Booking Pending
            @elseif($booking->status == 'confirmed')
                Booking Confirmed!
            @elseif($booking->status == 'completed')
                Visit Completed
            @elseif($booking->status == 'cancelled')
                Booking Cancelled
            @endif
            </h1>
            <p class="text-gray-600">
            @if($booking->status == 'pending')
                Your appointment is waiting for confirmation.
            @elseif($booking->status == 'confirmed')
                Your appointment has been successfully scheduled.
            @elseif($booking->status == 'completed')
                Thank you for visiting. We hope you enjoyed our service.
            @elseif($booking->status == 'cancelled')
                Your appointment has been cancelled.
            @endif
            </p>
        </div>
    </div>
    <!-- Main Content -->
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8</div> py-10">
        <!-- Booking Details Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8 booking-details" data-aos="fade-up">
            <div class="flex flex-col md:flex-row border-b pb-6 mb-6">
                <!-- Barber Shop Info -->
                <div class="md:w-1/4 mb-4 md:mb-0">
                    <img src="/storage/{{ $booking->barberShop->cover ?? 'https://images.unsplash.com/photo-1621605815971-fbc98d665033?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=150&h=150&q=80' }}" 
                         alt="Classic Cuts Barber Shop" 
                         class="w-40 h-24 object-cover rounded-lg shadow-sm">
                </div>
                <!-- Booking Info -->
                <div class="md:w-3/4 md:pl-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $booking->barberShop->name }}</h2>
                    <div class="flex items-center text-gray-600 mb-4">
                        <i class="fas fa-map-marker-alt mr-2 text-primary-500"></i>
                        <span>{{ $booking->barberShop->city.', '.$booking->barberShop->address.', '.$booking->barberShop->zip }}</span>
                    </div>
                    <div class="flex flex-wrap gap-y-3">
                        <div class="w-full sm:w-1/2 flex items-center">
                            <i class="far fa-calendar-check mr-2 text-primary-500"></i>
                            <span>{{ date('F j, Y', strtotime($booking->booking_date)) }}</span>
                        </div>
                        <div class="w-full sm:w-1/2 flex items-center">
                            <i class="far fa-clock mr-2 text-primary-500"></i>
                            <span>{{ date('h:i A', strtotime($booking->time)) }}</span>
                            <span class="text-sm text-gray-500 ml-2">({{ $booking->duration }} minutes)</span>
                        </div>
                        <div class="w-full sm:w-1/2 flex items-center">
                            <i class="fas fa-user mr-2 text-primary-500"></i>
                            <span>{{ $booking->barber_name ?? 'any disponible staff' }}</span>
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
                @foreach ($booking->services as $service )
                <div class="flex justify-between items-center">
                    <div class="flex items-start">
                        <i class="fas fa-cut mr-3 text-primary-500 mt-1"></i>
                        <div>
                            <p class="font-medium">{{ $service->name }}</p>
                            <p class="text-sm text-gray-500">{{ $service->duration }} min</p>
                        </div>
                    </div>
                    <span class="font-medium">€{{$service->price }}</span>
                </div>
                @endforeach
            </div>
            
            <!-- Booking Code -->
            <div class="bg-gray-50 rounded-lg p-4 text-center mb-6">
                <p class="text-sm text-gray-600 mb-1">Booking Reference</p>
                <p class="text-xl font-bold text-gray-800">{{ $booking->booking_reference }}</p>
            </div>
            
            <!-- Action Buttons -->
             @if ($booking->status == 'pending' || $booking->status == 'confirmed')
             
             <div class="flex flex-col sm:flex-row gap-3">
                 <button onclick="openCancelModal()" class="w-full bg-red-600 hover:bg-red-700 text-white text-center font-medium px-6 py-3 rounded-md transition-colors shadow-sm ">
                     <i class="fas fa-times mr-2"></i>Cancel Booking
                 </button>
                 <form id="cancel-booking-form" action="" method="POST" class="hidden">
                     @csrf
                     @method('DELETE')
                 </form>
                 <button onclick="openRescheduleModal()" href="#" class="w-full border border-gray-300 hover:bg-gray-50 text-gray-800 text-center font-medium px-6 py-3 rounded-md transition-colors">
                     <i class="fas fa-pen mr-2"></i>Reschedule
                 </button>
             </div>
             @endif
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
                <a href="{{ route('barbershop-detail',$booking->barberShop) }}" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-800 px-5 py-3 rounded-md transition-colors shadow-sm flex items-center justify-center">
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
        <!-- Reschedule modal -->
         
    <div id="reschedule-modal" class="fixed inset-0 z-50 hidden">
        <!-- Dark overlay -->
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" onclick="closeRescheduleModal()"></div>
        
        <!-- Modal content -->
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-lg p-6 w-11/12 sm:w-1/2 lg:w-1/3 relative z-10">
                <h2 class="text-xl font-bold mb-4">Reschedule Your Appointment</h2>
                <form action="{{ route('Booking.reschedule',$booking) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="new_date" class="block text-sm font-medium text-gray-700">New Date</label>
                        <input type="date" id="new_date" min="{{ date('Y-m-d') }}" name="new_date" class="mt-1 block
                        w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="new_time" class="block text-sm font-medium text-gray-700">New Time</label>
                        <input type="time" id="new_time" name="new_time" class="mt-1 block
                        w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="reason" class="block text-sm font-medium text-gray-700">Reason for Rescheduling</label>
                        <textarea id="reason" name="reason" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500" placeholder="Optional"></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium px-4 py-2 rounded-md mr-2" onclick="closeRescheduleModal()">Cancel</button>
                        <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-medium px-4 py-2 rounded-md">Reschedule</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- End of Reschedule modal -->

    
    <!-- Cancellation modal -->
    <div id="cancel-modal" class="fixed inset-0 z-50 hidden">
        <!-- Dark overlay -->
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" onclick="closeCancelModal()"></div>
        
        <!-- Modal content -->
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-lg p-6 w-11/12 sm:w-1/2 lg:w-1/3 relative z-10 fade-in">
                <h2 class="text-xl font-bold mb-4">Cancel Your Appointment</h2>
                <p class="text-gray-600 mb-6">Are you sure you want to cancel your appointment? This action cannot be undone.</p>
                
                <form action="{{ route('Booking.cancel',$booking) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="cancel_reason" class="block text-sm font-medium text-gray-700">Reason for Cancellation</label>
                        <textarea id="cancel_reason" name="cancel_reason" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500" placeholder="Optional"></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium px-4 py-2 rounded-md mr-2" onclick="closeCancelModal()">Go Back</button>
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded-md">Confirm Cancellation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openCancelModal() {
            document.getElementById('cancel-modal').classList.remove('hidden');
        }
        
        function closeCancelModal() {
            document.getElementById('cancel-modal').classList.add('hidden');
        }
        
        
    </script>
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

        function openRescheduleModal() {
            document.getElementById('reschedule-modal').classList.remove('hidden');
        }
        function closeRescheduleModal() {
            document.getElementById('reschedule-modal').classList.add('hidden');
        }
    </script>
    @endsection


