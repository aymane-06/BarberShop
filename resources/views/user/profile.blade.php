@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <!-- Profile Header -->
            <div class="bg-primary-600 h-32 relative">
                <div class="absolute bottom-0 left-6 transform translate-y-1/2">
                    <div class="h-24 w-24 rounded-full border-4 border-white bg-gray-200 flex items-center justify-center overflow-hidden">
                        <img id="profileImage" src="{{ auth()->user()->profile_image ?? asset('images/default-avatar.png') }}" alt="Profile" class="h-full w-full object-cover">
                    </div>
                </div>
            </div>
            
            <!-- Profile Content -->
            <div class="pt-16 pb-8 px-6">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ auth()->user()->name }}</h1>
                        <p class="text-gray-600">{{ auth()->user()->email }}</p>
                    </div>
                    <button class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700 transition-colors shadow-sm">
                        Edit Profile
                    </button>
                </div>

                <!-- Profile Tabs -->
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8">
                        <a href="#" class="border-primary-600 text-primary-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium">
                            My Appointments
                        </a>
                        <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium">
                            Favorites
                        </a>
                        <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium">
                            Settings
                        </a>
                    </nav>
                </div>

                <!-- Upcoming Appointments -->
                <div class="mt-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Upcoming Appointments</h2>
                    
                    <div class="space-y-4">
                        <!-- Sample Appointment Card -->
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex justify-between">
                                <div>
                                    <h3 class="font-medium text-gray-900">Classic Haircut</h3>
                                    <p class="text-gray-600">with John's Barbershop</p>
                                </div>
                                <div class="text-right">
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Confirmed</span>
                                </div>
                            </div>
                            <div class="mt-3 flex justify-between text-sm">
                                <div class="flex items-center text-gray-500">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                    </svg>
                                    June 14, 2023
                                </div>
                                <div class="flex items-center text-gray-500">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                    </svg>
                                    2:30 PM
                                </div>
                                <div class="flex items-center text-gray-500">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                    </svg>
                                    123 Barber Street
                                </div>
                            </div>
                            <div class="mt-4 flex justify-end space-x-3">
                                <button class="text-gray-500 hover:text-gray-700 text-sm">Reschedule</button>
                                <button class="text-red-500 hover:text-red-700 text-sm">Cancel</button>
                            </div>
                        </div>

                        <!-- Empty state for when no appointments -->
                        <div class="hidden border border-dashed border-gray-300 rounded-lg p-8 text-center">
                            <svg class="w-12 h-12 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No appointments</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                You don't have any upcoming appointments.
                            </p>
                            <div class="mt-6">
                                <a href="{{ route('search-results') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700">
                                    Book an Appointment
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Past Appointments -->
                <div class="mt-8">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Past Appointments</h2>
                    
                    <div class="space-y-4">
                        <!-- Sample Past Appointment Card -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex justify-between">
                                <div>
                                    <h3 class="font-medium text-gray-900">Beard Trim</h3>
                                    <p class="text-gray-600">with Mike's Barbershop</p>
                                </div>
                                <div class="text-right">
                                    <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full">Completed</span>
                                </div>
                            </div>
                            <div class="mt-3 flex justify-between text-sm text-gray-500">
                                <div>May 28, 2023 at 11:00 AM</div>
                                <div>$25.00</div>
                            </div>
                            <div class="mt-4 flex justify-end space-x-3">
                                <button class="text-primary-600 hover:text-primary-800 text-sm">Book Again</button>
                                <button class="text-gray-500 hover:text-gray-700 text-sm">Leave Review</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('additional_scripts')
<script>
    // You can add JavaScript for interacting with profile elements
    document.addEventListener('DOMContentLoaded', function() {
        // Example: Toggle between tabs
        const tabs = document.querySelectorAll('nav a');
        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                tabs.forEach(t => {
                    t.classList.remove('border-primary-600', 'text-primary-600');
                    t.classList.add('border-transparent', 'text-gray-500');
                });
                this.classList.remove('border-transparent', 'text-gray-500');
                this.classList.add('border-primary-600', 'text-primary-600');
            });
        });
    });
</script>
@endsection</div></svg></div></svg></div></a></div>