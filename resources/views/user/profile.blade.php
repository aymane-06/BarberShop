@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <!-- Profile Header -->
            <div class="bg-primary-600 h-32 relative">
                <div class="absolute bottom-0 left-6 transform translate-y-1/2">
                    <div class="h-24 w-24 rounded-full border-4 border-white bg-gray-200 flex items-center justify-center overflow-hidden">
                        <img id="profileImage" src="{{ auth()->user()->avatar ?? asset('images/default-avatar.png') }}" alt="Profile" class="h-full w-full object-cover">
                    </div>
                    <label for="avatar-upload" class="absolute bottom-0 right-0 bg-primary-500 text-white rounded-full p-1 cursor-pointer hover:bg-primary-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </label>
                    <form id="avatar-form" class="hidden" method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        <input id="avatar-upload" type="file" name="avatar" class="hidden" accept="image/*">
                    </form>
                </div>
            </div>
            
            <!-- Profile Content -->
            <div class="pt-16 pb-8 px-6">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ auth()->user()->name }}</h1>
                        <p class="text-gray-600">{{ auth()->user()->email }}</p>
                        <p class="text-gray-600">{{ auth()->user()->phone }}</p>
                        @if(auth()->user()->role == 'admin')
                            <span class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded-full">Admin</span>
                        @endif
                    </div>
                    <button id="editProfileBtn" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700 transition-colors shadow-sm">
                        Edit Profile
                    </button>
                </div>

                <!-- Profile Tabs -->
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8" id="profile-tabs">
                        <a href="#" data-tab="appointments" class="border-primary-600 text-primary-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium">
                            My Appointments
                        </a>
                        <a href="#" data-tab="favorites" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium">
                            Favorites
                        </a>
                        <a href="#" data-tab="settings" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium">
                            Settings
                        </a>
                    </nav>
                </div>

                <!-- Tab Content -->
                <div id="tab-contents">
                    <!-- Appointments Tab -->
                    <div class="tab-content" id="appointments-tab">
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
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"></svg></svg>
                                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                            </svg>
                                            123 Barber Street
                                        </div>
                                    </div>
                                    <div class="mt-4 flex justify-end space-x-3">
                                        <button class="text-gray-500 hover:text-gray-700 text-sm open-modal" data-modal="reschedule-modal">Reschedule</button>
                                        <button class="text-red-500 hover:text-red-700 text-sm open-modal" data-modal="cancel-modal">Cancel</button>
                                    </div>
                                </div>

                                <!-- Empty state for when no appointments -->
                                <div class="hidden border border-dashed border-gray-300 rounded-lg p-8 text-center" id="no-appointments">
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
                                        <button class="text-primary-600 hover:text-primary-800 text-sm book-again-btn">Book Again</button>
                                        <button class="text-gray-500 hover:text-gray-700 text-sm open-modal" data-modal="review-modal">Leave Review</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Favorites Tab (Hidden by default) -->
                    <div class="tab-content hidden" id="favorites-tab">
                        <div class="mt-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Favorite Barbers</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <!-- Favorite Barber Card -->
                                <div class="border border-gray-200 rounded-lg p-4 flex items-center">
                                    <div class="w-16 h-16 rounded-full overflow-hidden mr-4">
                                        <img src="{{ asset('images/barber1.jpg') }}" alt="Barber" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-medium text-gray-900">John Doe</h3>
                                        <p class="text-sm text-gray-500">Classic Cuts Barbershop</p>
                                        <div class="flex items-center mt-1">
                                            <div class="flex text-yellow-400">
                                                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                            </div>
                                            <span class="text-sm text-gray-500 ml-2">5.0 (42 reviews)</span>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="#" class="text-primary-600 hover:text-primary-800 text-sm">Book</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-8">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Favorite Services</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <!-- Favorite Service Card -->
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex justify-between">
                                        <div>
                                            <h3 class="font-medium text-gray-900">Fade Haircut</h3>
                                            <p class="text-sm text-gray-500">45 mins</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-medium">$35.00</p>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <button class="w-full bg-primary-600 text-white py-2 rounded-md hover:bg-primary-700 transition-colors">Book Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Settings Tab (Hidden by default) -->
                    <div class="tab-content hidden" id="settings-tab">
                        <div class="mt-6">
                            <form id="profile-settings-form" class="space-y-6">
                                <div>
                                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Personal Information</h2>
                                    <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                                        <div>
                                            <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                            <input type="text" name="name" id="name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary-500 focus:border-primary-500" value="{{ auth()->user()->name }}">
                                        </div>
                                        <div>
                                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                            <input type="email" name="email" id="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary-500 focus:border-primary-500" value="{{ auth()->user()->email }}">
                                        </div>
                                        <div>
                                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                            <input type="tel" name="phone" id="phone" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary-500 focus:border-primary-500" value="{{ auth()->user()->phone }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Password</h2>
                                    <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                                        <div>
                                            <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
                                            <input type="password" name="current_password" id="current_password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                                        </div>
                                        <div></div>
                                        <div>
                                            <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                                            <input type="password" name="password" id="password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                                        </div>
                                        <div>
                                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                                            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Notifications</h2>
                                    <div class="space-y-4">
                                        <div class="flex items-start">
                                            <div class="flex items-center h-5">
                                                <input id="email_notifications" name="email_notifications" type="checkbox" class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300 rounded" checked>
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <label for="email_notifications" class="font-medium text-gray-700">Email notifications</label>
                                                <p class="text-gray-500">Get emails about your appointments and account activity.</p>
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-start">
                                            <div class="flex items-center h-5">
                                                <input id="sms_notifications" name="sms_notifications" type="checkbox" class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300 rounded" checked>
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <label for="sms_notifications" class="font-medium text-gray-700">SMS notifications</label>
                                                <p class="text-gray-500">Receive text messages for appointment reminders.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex justify-end pt-5">
                                    <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                        Cancel
                                    </button>
                                    <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                        Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->
<div id="reschedule-modal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left"></div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Reschedule Appointment
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Please select a new date and time for your appointment.
                            </p>
                            <div class="mt-4 space-y-4">
                                <div>
                                    <label for="reschedule-date" class="block text-sm font-medium text-gray-700">Date</label>
                                    <input type="date" id="reschedule-date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                                </div>
                                <div>
                                    <label for="reschedule-time" class="block text-sm font-medium text-gray-700">Time</label>
                                    <select id="reschedule-time" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                                        <option>9:00 AM</option>
                                        <option>10:00 AM</option>
                                        <option>11:00 AM</option>
                                        <option>12:00 PM</option>
                                        <option>1:00 PM</option>
                                        <option>2:00 PM</option>
                                        <option>3:00 PM</option>
                                        <option>4:00 PM</option>
                                        <option>5:00 PM</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary-600 text-base font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Confirm
                    </button>
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm modal-close">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('additional_scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab switching functionality
        const tabs = document.querySelectorAll('[data-tab]');
        const tabContents = document.querySelectorAll('.tab-content');
        
        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all tabs
                tabs.forEach(t => {
                    t.classList.remove('border-primary-600', 'text-primary-600');
                    t.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
                });
                
                // Add active class to clicked tab
                this.classList.add('border-primary-600', 'text-primary-600');
                this.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
                
                // Hide all tab contents
                tabContents.forEach(content => {
                    content.classList.add('hidden');
                });
                
                // Show selected tab content
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId + '-tab').classList.remove('hidden');
            });
        });
        
        // Profile image upload
        const avatarInput = document.getElementById('avatar-upload');
        const avatarForm = document.getElementById('avatar-form');
        const profileImage = document.getElementById('profileImage');
        
        if(avatarInput) {
            avatarInput.addEventListener('change', function() {
                const file = this.files[0];
                if(file) {
                    // Update preview
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        profileImage.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                    
                    // Submit form automatically
                    avatarForm.action = "";
                    avatarForm.submit();
                }
            });
        }
        
        // Modal functionality
        const openModalButtons = document.querySelectorAll('.open-modal');
        const closeModalButtons = document.querySelectorAll('.modal-close');
        
        openModalButtons.forEach(button => {
            button.addEventListener('click', function() {
                const modalId = this.getAttribute('data-modal');
                document.getElementById(modalId).classList.remove('hidden');
            });
        });
        
        closeModalButtons.forEach(button => {
            button.addEventListener('click', function() {
                const modal = this.closest('[id$="-modal"]');
                if(modal) {
                    modal.classList.add('hidden');
                }
            });
        });
        
        // Close modal when clicking outside
        window.addEventListener('click', function(e) {
            document.querySelectorAll('[id$="-modal"]').forEach(modal => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });
        
        // Edit profile button
        const editProfileBtn = document.getElementById('editProfileBtn');
        if(editProfileBtn) {
            editProfileBtn.addEventListener('click', function() {
                // Switch to settings tab
                tabs.forEach(t => {
                    if(t.getAttribute('data-tab') === 'settings') {
                        t.click();
                    }
                });
            });
        }
        
        // Profile settings form submission
        const profileSettingsForm = document.getElementById('profile-settings-form');
        if(profileSettingsForm) {
            profileSettingsForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // You would add AJAX form submission here
                alert('Profile updated successfully!');
            });
        }
    });
</script>
@endsection