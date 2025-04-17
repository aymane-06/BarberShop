@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-8">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Sidebar -->
            <div class="md:w-1/4 bg-white rounded-lg shadow-sm p-6">
                <div class="flex flex-col items-center mb-8">
                    <div class="w-24 h-24 rounded-full overflow-hidden mb-4">
                        <img id="profileImage" src="{{ auth()->user()->provider ? auth()->user()->avatar : (auth()->user()->avatar ? '/storage/'.auth()->user()->avatar : asset('images/default-avatar.png')) }}" class="w-full h-full object-cover" alt="Profile picture">
                    </div>
                    <h2 class="text-lg font-semibold text-gray-900">{{ auth()->user()->name }}</h2>
                    <p class="text-sm text-gray-500">Member since {{ auth()->user()->created_at->format('F Y') }}</p>
                </div>

                <nav>
                    <ul class="space-y-1">
                        <li>
                            <button data-section="personal-info" class="tab-active w-full text-left px-4 py-3 rounded flex items-center text-sm font-medium">
                                <div class="w-5 h-5 flex items-center justify-center mr-3">
                                    <i class="ri-user-3-line"></i>
                                </div>
                                <span>Personal Information</span>
                            </button>
                        </li>
                        <li>
                            <button data-section="appointments" class="w-full text-left px-4 py-3 rounded flex items-center text-sm font-medium text-gray-700 hover:bg-gray-50">
                                <div class="w-5 h-5 flex items-center justify-center mr-3">
                                    <i class="ri-calendar-check-line"></i>
                                </div>
                                <span>My Appointments</span>
                            </button>
                        </li>
                        <li>
                            <button data-section="favorites" class="w-full text-left px-4 py-3 rounded flex items-center text-sm font-medium text-gray-700 hover:bg-gray-50">
                                <div class="w-5 h-5 flex items-center justify-center mr-3">
                                    <i class="ri-heart-line"></i>
                                </div>
                                <span>Favorites</span>
                            </button>
                        </li>
                        <li>
                            <button data-section="notifications" class="w-full text-left px-4 py-3 rounded flex items-center text-sm font-medium text-gray-700 hover:bg-gray-50">
                                <div class="w-5 h-5 flex items-center justify-center mr-3">
                                    <i class="ri-notification-3-line"></i>
                                </div>
                                <span>Notifications</span>
                            </button>
                        </li>
                        <li>
                            <button data-section="password" class="w-full text-left px-4 py-3 rounded flex items-center text-sm font-medium text-gray-700 hover:bg-gray-50">
                                <div class="w-5 h-5 flex items-center justify-center mr-3">
                                    <i class="ri-lock-password-line"></i>
                                </div>
                                <span>Password & Security</span>
                            </button>
                        </li>
                    </ul>
                </nav>

                <div class="mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ route('home') }}" class="flex items-center text-gray-700 hover:text-primary">
                        <div class="w-5 h-5 flex items-center justify-center mr-2">
                            <i class="ri-arrow-left-line"></i>
                        </div>
                        <span>Back to Home</span>
                    </a>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="md:w-3/4">
                <!-- Personal Information Section -->
                <div id="personal-info" class="profile-section active bg-white rounded-lg shadow-sm p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold text-gray-900">Personal Information</h1>
                        <p class="text-sm text-gray-500">Last updated: {{ auth()->user()->updated_at->format('F d, Y') }}</p>
                    </div>


                    <form action="{{ route("user.profile.update") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <div class="flex flex-col md:flex-row gap-8 mb-8">
                        <div class="md:w-1/3 flex flex-col items-center">
                            <div class="w-40 h-40 rounded-full overflow-hidden mb-4 bg-gray-100 flex items-center justify-center border-4 border-white shadow">
                                <img id="profile-preview" src="{{ auth()->user()->provider ? auth()->user()->avatar : (auth()->user()->avatar ? '/storage/'.auth()->user()->avatar : asset('images/default-avatar.png')) }}" class="w-full h-full object-cover" alt="Profile picture">
                            </div>
                            <div class="custom-file-input">
                                <button type="button" id="upload-btn" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-button font-medium hover:bg-gray-50 transition whitespace-nowrap w-full flex items-center justify-center">
                                    <div class="w-5 h-5 flex items-center justify-center mr-2">
                                        <i class="ri-upload-2-line"></i>
                                    </div>
                                    <span>Change Photo</span>
                                </button>
                                <input id="profile-upload" type="file" name="avatar" accept="image/*" class="hidden">
                                @error('avatar')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Supported formats: JPG, PNG, GIF (Max 5MB)</p>
                        </div>

                        <div class="md:w-2/3">
                            
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                    <div class="col-span-2">
                                        <label for="fullname" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                        <input type="text" id="fullname" name="name" placeholder="{{ auth()->user()->name }}" class="w-full px-4 py-2 border @error('name') border-red-500 @else border-gray-300 @enderror rounded focus:ring-2 focus:ring-primary focus:border-primary outline-none">
                                        @error('name')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                        <input type="email" id="email" name="email" placeholder="{{ auth()->user()->email }}" class="w-full px-4 py-2 border @error('email') border-red-500 @else border-gray-300 @enderror rounded focus:ring-2 focus:ring-primary focus:border-primary outline-none">
                                        @error('email')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                        <input type="tel" id="phone" name="phone" placeholder="{{ auth()->user()->phone }}" class="w-full px-4 py-2 border @error('phone') border-red-500 @else border-gray-300 @enderror rounded focus:ring-2 focus:ring-primary focus:border-primary outline-none">
                                        @error('phone')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <button type="submit" class="bg-primary text-white px-6 py-2 rounded-button font-medium bg-primary-600 transition whitespace-nowrap flex items-center">
                                        <div class="w-5 h-5 flex items-center justify-center mr-2">
                                            <i class="ri-save-line"></i>
                                        </div>
                                        <span>Save Changes</span>
                                    </button>
                                </div>

                            </div>

                        </form>
                        </div>
                </div>

                <!-- Appointments Section -->
                <div id="appointments" class="profile-section bg-white rounded-lg shadow-sm p-6 hidden">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold text-gray-900">My Appointments</h1>
                        <a href="{{ route('search-results') }}" class="bg-primary text-white px-4 py-2 rounded-button font-medium hover:bg-primary-600 transition whitespace-nowrap flex items-center">
                            <div class="w-5 h-5 flex items-center justify-center mr-1">
                                <i class="ri-add-line"></i>
                            </div>
                            <span>Book New Appointment</span>
                        </a>
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
                                <div class="mt-3 flex flex-wrap gap-4 text-sm">
                                    <div class="flex items-center text-gray-500">
                                        <i class="ri-calendar-line w-4 h-4 mr-1"></i>
                                        June 14, 2023
                                    </div>
                                    <div class="flex items-center text-gray-500">
                                        <i class="ri-time-line w-4 h-4 mr-1"></i>
                                        2:30 PM
                                    </div>
                                    <div class="flex items-center text-gray-500">
                                        <i class="ri-map-pin-line w-4 h-4 mr-1"></i>
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
                                <i class="ri-calendar-line w-12 h-12 text-gray-400 mx-auto"></i>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No appointments</h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    You don't have any upcoming appointments.
                                </p>
                                <div class="mt-6">
                                    <a href="{{ route('search-results') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-primary-600">
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
                                    <button class="text-primary hover:text-primary-800 text-sm book-again-btn">Book Again</button>
                                    <button class="text-gray-500 hover:text-gray-700 text-sm open-modal" data-modal="review-modal">Leave Review</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Favorites Tab -->
                <div id="favorites" class="profile-section bg-white rounded-lg shadow-sm p-6 hidden">
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-900">My Favorites</h1>
                    </div>

                    <div>
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
                                            <i class="ri-star-fill w-4 h-4"></i>
                                            <i class="ri-star-fill w-4 h-4"></i>
                                            <i class="ri-star-fill w-4 h-4"></i>
                                            <i class="ri-star-fill w-4 h-4"></i>
                                            <i class="ri-star-fill w-4 h-4"></i>
                                        </div>
                                        <span class="text-sm text-gray-500 ml-2">5.0 (42 reviews)</span>
                                    </div>
                                </div>
                                <div>
                                    <a href="#" class="text-primary hover:text-primary-800 text-sm">Book</a>
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
                                    <button class="w-full bg-primary text-white py-2 rounded-md hover:bg-primary-600 transition-colors">Book Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notifications Tab -->
                <div id="notifications" class="profile-section bg-white rounded-lg shadow-sm p-6 hidden">
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">Notification Preferences</h1>
                        <p class="text-gray-500">Manage how you receive notifications and updates</p>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <h2 class="text-lg font-medium text-gray-900 mb-4">Email Notifications</h2>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="font-medium text-gray-800">Appointment Reminders</h3>
                                        <p class="text-sm text-gray-500">Get notified about upcoming appointments</p>
                                    </div>
                                    <label class="custom-switch">
                                        <input type="checkbox" checked name="email_notifications" />
                                        <span class="switch-slider"></span>
                                    </label>
                                </div>

                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="font-medium text-gray-800">Special Offers</h3>
                                        <p class="text-sm text-gray-500">Get notified about promotions and discounts</p>
                                    </div>
                                    <label class="custom-switch">
                                        <input type="checkbox" />
                                        <span class="switch-slider"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-gray-200">
                            <h2 class="text-lg font-medium text-gray-900 mb-4">SMS Notifications</h2>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="font-medium text-gray-800">Appointment Reminders</h3>
                                        <p class="text-sm text-gray-500">Get text reminders about upcoming appointments</p>
                                    </div>
                                    <label class="custom-switch">
                                        <input type="checkbox" checked name="sms_notifications" />
                                        <span class="switch-slider"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="bg-primary text-white px-6 py-2 rounded-button font-medium bg-primary-600 transition whitespace-nowrap">
                            Save Preferences
                        </button>
                    </div>
                </div>

                <!-- Password & Security Tab -->
                <div id="password" class="profile-section bg-white rounded-lg shadow-sm p-6 hidden">
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">Password & Security</h1>
                        <p class="text-gray-500">Manage your password and account security settings</p>
                    </div>

                    <div class="max-w-md">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">Change Password</h2>
                        <form id="password-form" method="POST" action="{{ route("user.profile.update") }}">
                            @csrf
                            @method('PUT')
                            <div class="space-y-4">
                                <div>
                                    <label for="current-password" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                                    <div class="relative">
                                        <input type="password" id="current-password" name="current_password" class="w-full px-4 py-2 border @error('current_password') border-red-500 @else border-gray-300 @enderror rounded focus:ring-2 focus:ring-primary focus:border-primary outline-none">
                                        <button type="button" class="toggle-password absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 flex items-center justify-center text-gray-500">
                                            <i class="ri-eye-line"></i>
                                        </button>
                                    </div>
                                    @error('current_password')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="new-password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                                    <div class="relative">
                                        <input type="password" id="new-password" name="password" class="w-full px-4 py-2 border @error('password') border-red-500 @else border-gray-300 @enderror rounded focus:ring-2 focus:ring-primary focus:border-primary outline-none">
                                        <button type="button" class="toggle-password absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 flex items-center justify-center text-gray-500">
                                            <i class="ri-eye-line"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="confirm-password" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                                    <div class="relative">
                                        <input type="password" id="confirm-password" name="password_confirmation" class="w-full px-4 py-2 border @error('password_confirmation') border-red-500 @else border-gray-300 @enderror rounded focus:ring-2 focus:ring-primary focus:border-primary outline-none">
                                        <button type="button" class="toggle-password absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 flex items-center justify-center text-gray-500">
                                            <i class="ri-eye-line"></i>
                                        </button>
                                    </div>
                                    @error('password_confirmation')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-6">
                                <button type="submit" class="bg-primary text-white px-6 py-2 rounded-button font-medium bg-primary-600 transition whitespace-nowrap flex items-center">
                                    <div class="w-5 h-5 flex items-center justify-center mr-2">
                                        <i class="ri-lock-password-line"></i>
                                    </div>
                                    <span>Update Password</span>
                                </button>
                            </div>
                        </form>
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
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
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
                                    <input type="date" id="reschedule-date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary">
                                </div>
                                <div>
                                    <label for="reschedule-time" class="block text-sm font-medium text-gray-700">Time</label>
                                    <select id="reschedule-time" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary">
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
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:ml-3 sm:w-auto sm:text-sm">
                    Confirm
                </button>
                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm modal-close">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('additional_styles')
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
<style>
    .tab-active {
        color: #7d3ced;
        border-left: 3px solid #7d3ced;
        background-color: rgba(184, 125, 59, 0.1);
    }
    .profile-section {
        display: none;
    }
    .profile-section.active {
        display: block;
    }
    .custom-switch {
        position: relative;
        display: inline-block;
        width: 44px;
        height: 24px;
    }
    .custom-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }
    .switch-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #e5e7eb;
        transition: .4s;
        border-radius: 24px;
    }
    .switch-slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }
    input:checked + .switch-slider {
        background-color: #7d3ced;
    }
    input:checked + .switch-slider:before {
        transform: translateX(20px);
    }
    /* From Uiverse.io by vinodjangid07 */ 
.bookmarkBtn {
  width: 100px;
  height: 40px;
  border-radius: 40px;
  border: 1px solid rgba(255, 255, 255, 0.349);
  background-color: rgb(12, 12, 12);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition-duration: 0.3s;
  overflow: hidden;
}

.IconContainer {
  width: 30px;
  height: 30px;
  background: linear-gradient(to bottom, rgb(255, 136, 255), rgb(172, 70, 255));
  border-radius: 50px;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  z-index: 2;
  transition-duration: 0.3s;
}

.icon {
  border-radius: 1px;
}

.text {
  height: 100%;
  width: 60px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  z-index: 1;
  transition-duration: 0.3s;
  font-size: 1.04em;
}

.bookmarkBtn:hover .IconContainer {
  width: 90px;
  transition-duration: 0.3s;
}

.bookmarkBtn:hover .text {
  transform: translate(10px);
  width: 0;
  font-size: 0;
  transition-duration: 0.3s;
}

.bookmarkBtn:active {
  transform: scale(0.95);
  transition-duration: 0.3s;
}

</style>
@endsection

@section('additional_scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab switching functionality
        const tabButtons = document.querySelectorAll('[data-section]');
        const profileSections = document.querySelectorAll('.profile-section');

        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                const sectionId = this.getAttribute('data-section');
                
                // Hide all sections
                profileSections.forEach(section => {
                    section.classList.remove('active');
                });
                
                // Show selected section
                document.getElementById(sectionId).classList.add('active');
                
                // Update active tab
                tabButtons.forEach(btn => {
                    btn.classList.remove('tab-active');
                });
                this.classList.add('tab-active');
            });
        });
        
        // Profile image upload
        // Profile image upload
        const profileUpload = document.getElementById('profile-upload');
        const profilePreview = document.getElementById('profile-preview');
        const profileImage = document.getElementById('profileImage');
        const uploadBtn = document.getElementById('upload-btn');
        
        if(uploadBtn && profileUpload) {
            uploadBtn.addEventListener('click', function() {
                profileUpload.click();
            });
        }
        
        if(profileUpload) {
            profileUpload.addEventListener('change', function() {
                const file = this.files[0];
                if(file) {
                    // Update preview
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        profilePreview.src = e.target.result;
                        if (profileImage) {
                            profileImage.src = e.target.result;
                        }
                    };
                    reader.readAsDataURL(file);
                    
                    // Form will be submitted normally as it's inside a form already
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
        
        // Password visibility toggle
        const passwordToggles = document.querySelectorAll('.toggle-password');
        passwordToggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const input = this.parentElement.querySelector('input');
                const icon = this.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('ri-eye-line');
                    icon.classList.add('ri-eye-off-line');
                } else {
                    input.type = 'password';
                    icon.classList.remove('ri-eye-off-line');
                    icon.classList.add('ri-eye-line');
                }
            });
        });
        
        // Form submissions
        const personalInfoForm = document.getElementById('personal-info-form');
        if(personalInfoForm) {
            personalInfoForm.addEventListener('submit', function(e) {
                // Form will be submitted normally, uncomment to prevent default and use AJAX
                // e.preventDefault();
                
                // Show success message after successful submission
            });
        }
        
        const passwordForm = document.getElementById('password-form');
        if(passwordForm) {
            passwordForm.addEventListener('submit', function(e) {
                // Form will be submitted normally, uncomment to prevent default and use AJAX
                // e.preventDefault();
            });
        }
    });
</script>
@endsection