@extends('layouts.barber')

@section('additional_styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<style>
    .card-hover {
        transition: all 0.3s ease;
    }
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .form-section {
        transition: all 0.3s ease;
        border-radius: 0.5rem;
        background-color: white;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    .form-section:hover {
        box-shadow: 0 8px 15px rgba(0,0,0,0.08);
    }
    .section-title {
        position: relative;
        padding-bottom: 0.75rem;
        margin-bottom: 1.5rem;
        color: #2c3e50;
    }
    .section-title:after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        height: 3px;
        width: 50px;
        background: linear-gradient(to right, #3490dc, #6574cd);
    }
    .custom-file-input {
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }
    .custom-file-input input[type="file"] {
        position: absolute;
        font-size: 100px;
        opacity: 0;
        right: 0;
        top: 0;
        cursor: pointer;
    }
    .status-badge {
        border-radius: 30px;
        padding: 0.5rem 1rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }
    .working-hours-row {
        border-radius: 0.5rem;
        transition: all 0.2s ease;
        padding: 0.5rem;
    }
    .working-hours-row:hover {
        background-color: #f8fafc;
    }
</style>
@endsection

@section('content')
<div class="py-8 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen">
    <div class="max-w-5xl mx-auto">
        <div class="mb-8 animate__animated animate__fadeIn">
            <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                <i class="fas fa-store-alt mr-3 text-primary-600"></i>
                Shop Profile
            </h1>
            <p class="mt-2 text-lg text-gray-600">Customize your barbershop appearance and details to attract more customers.</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-sm animate__animated animate__fadeInUp">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-3 text-green-500"></i>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md shadow-sm animate__animated animate__fadeInUp">
                <div class="flex">
                    <i class="fas fa-exclamation-circle mr-3 text-red-500"></i>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form action="{{ route('barberShop.profile.update',auth()->user()?->barbershop?->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Shop Status Banner -->
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg shadow-lg p-6 text-white mb-6 animate__animated animate__fadeIn">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-bold mb-2">Shop Status</h2>
                        <p class="text-blue-100">{{ auth()->user()?->barberShop->is_active ? 'Your shop is currently visible to customers.' : 'Your shop is currently hidden from customers.' }}</p>
                    </div>
                    <div class="flex items-center">
                        <span class="mr-3 font-semibold">{{ auth()->user()?->barberShop->is_active ? 'Active' : 'Inactive' }}</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" id="is_active" name="is_active" value="1" class="sr-only peer" {{ auth()->user()?->barberShop->is_active ? 'checked' : '' }}>
                            <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-green-500"></div>
                        </label>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="inline-flex status-badge {{ auth()->user()?->barberShop->is_verified === 'Verified' ? 'bg-green-100 text-green-800' : (auth()->user()?->barberShop->is_verified === 'Rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                        <i class="fas {{ auth()->user()?->barberShop->is_verified === 'Verified' ? 'fa-check-circle' : (auth()->user()?->barberShop->is_verified === 'Rejected' ? 'fa-times-circle' : 'fa-clock') }} mr-2"></i>
                        {{ auth()->user()?->barberShop->is_verified }}
                    </span>
                </div>
            </div>

            <!-- Profile Images Section -->
            <div class="form-section animate__animated animate__fadeIn">
                <h3 class="section-title text-xl font-semibold">Shop Appearance</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="card-hover p-4 border border-gray-200 rounded-lg">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Shop Avatar</label>
                        <div class="flex flex-col items-center">
                            <div class="w-32 h-32 bg-gray-100 rounded-full overflow-hidden mb-4 border-4 border-white shadow-lg">
                                <img src="{{ auth()->user()?->barberShop->avatar ? asset('storage/' . auth()->user()?->barberShop->avatar) : asset('images/default-barbershop-avatar.jpg') }}" alt="Shop avatar" class="w-full h-full object-cover">
                            </div>
                            <div class="w-full">
                                <div class="custom-file-input bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-lg py-3 px-4 text-center transition-all w-full">
                                    <i class="fas fa-cloud-upload-alt mr-2"></i> Choose Avatar
                                    <input type="file" name="avatar" id="avatar" class="absolute opacity-0 w-full h-full top-0 left-0 cursor-pointer" accept="image/*">
                                </div>
                                <p class="mt-2 text-xs text-center text-gray-500">PNG, JPG up to 2MB</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-hover p-4 border border-gray-200 rounded-lg">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Cover Image</label>
                        <div class="flex flex-col items-center">
                            <div class="w-full h-40 bg-gray-100 rounded-lg overflow-hidden mb-4 shadow-lg">
                                <img src="{{ auth()->user()?->barberShop->cover ? asset('storage/' . auth()->user()?->barberShop->cover) : asset('images/default-barbershop-cover.jpg') }}" alt="Shop cover" class="w-full h-full object-cover">
                            </div>
                            <div class="w-full">
                                <div class="custom-file-input bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-lg py-3 px-4 text-center transition-all w-full">
                                    <i class="fas fa-image mr-2"></i> Choose Cover Image
                                    <input type="file" name="cover" id="cover" class="absolute opacity-0 w-full h-full top-0 left-0 cursor-pointer" accept="image/*">
                                </div>
                                <p class="mt-2 text-xs text-center text-gray-500">Recommended size: 1200x300px</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Basic Information -->
            <div class="form-section animate__animated animate__fadeIn">
                <h3 class="section-title text-xl font-semibold">Basic Information</h3>
                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-signature mr-2 text-primary-500"></i>Shop Name
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name', auth()->user()?->barberShop->name) }}" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div class="sm:col-span-3">
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-link mr-2 text-primary-500"></i>URL Slug
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                {{ config('app.url') }}barber/
                            </span>
                            <input type="text" name="slug" id="slug" value="{{ old('slug', auth()->user()?->barberShop->slug) }}" class="focus:ring-primary-500 focus:border-primary-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
                        </div>
                    </div>

                    <div class="sm:col-span-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-align-left mr-2 text-primary-500"></i>Description
                        </label>
                        <textarea id="description" name="description" rows="4" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('description', auth()->user()?->barberShop->description) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="form-section animate__animated animate__fadeIn">
                <h3 class="section-title text-xl font-semibold">Contact Information</h3>
                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-2">
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-phone-alt mr-2 text-primary-500"></i>Phone
                        </label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', auth()->user()?->barberShop->phone) }}" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div class="sm:col-span-2">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-envelope mr-2 text-primary-500"></i>Email
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email', auth()->user()?->barberShop->email) }}" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div class="sm:col-span-2">
                        <label for="website" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-globe mr-2 text-primary-500"></i>Website
                        </label>
                        <input type="text" name="website" id="website" value="{{ old('website', auth()->user()?->barberShop->website) }}" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                </div>
            </div>

            <!-- Address Information -->
            <div class="form-section animate__animated animate__fadeIn">
                <h3 class="section-title text-xl font-semibold">Address Information</h3>
                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-6">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-map-marker-alt mr-2 text-primary-500"></i>Street Address
                        </label>
                        <input type="text" name="address" id="address" value="{{ old('address', auth()->user()?->barberShop->address) }}" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div class="sm:col-span-3">
                        <label for="city" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-city mr-2 text-primary-500"></i>City
                        </label>
                        <input type="text" name="city" id="city" value="{{ old('city', auth()->user()?->barberShop->city) }}" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div class="sm:col-span-3">
                        <label for="zip" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-mail-bulk mr-2 text-primary-500"></i>ZIP / Postal Code
                        </label>
                        <input type="text" name="zip" id="zip" value="{{ old('zip', auth()->user()?->barberShop->zip) }}" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                </div>
            </div>

            <!-- Working Hours -->
            <div class="form-section animate__animated animate__fadeIn">
                <h3 class="section-title text-xl font-semibold">Working Hours</h3>
                <div class="space-y-3">
                    @php
                        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                        $workingHours = old('working_hours', auth()->user()?->barberShop->working_hours ?? []);
                    @endphp

                    <div class="grid grid-cols-4 gap-4 mb-3 bg-gray-50 p-3 rounded-lg text-sm font-medium">
                        <div>Day</div>
                        <div>Status</div>
                        <div class="col-span-2">Hours</div>
                    </div>

                    @foreach($days as $day)
                        <div class="working-hours-row grid grid-cols-4 gap-4 items-center p-2 border-b border-gray-100">
                            <div class="font-medium text-gray-700">
                                <i class="far fa-calendar-alt mr-2 text-primary-500"></i>{{ $day }}
                            </div>
                            <div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" id="{{ strtolower($day) }}_closed" name="working_hours[{{ strtolower($day) }}][closed]" value="1" 
                                           {{ isset($workingHours[strtolower($day)]['closed']) && $workingHours[strtolower($day)]['closed'] ? 'checked' : '' }}
                                           class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-500"></div>
                                    <span class="ml-3 text-sm font-medium text-gray-700">Closed</span>
                                </label>
                            </div>
                            <div class="col-span-2 grid grid-cols-2 items-center gap-2">
                                <div class="relative flex items-center">
                                    <i class="far fa-clock absolute left-3 text-gray-400"></i>
                                    <input type="text" name="working_hours[{{ strtolower($day) }}][open]" placeholder="09:00"
                                           value="{{ $workingHours[strtolower($day)]['open'] ?? '' }}" 
                                           class="time-picker pl-10 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <div class="relative flex items-center">
                                    <span class="absolute left-3 text-gray-400">to</span>
                                    <input type="text" name="working_hours[{{ strtolower($day) }}][close]" placeholder="17:00"
                                           value="{{ $workingHours[strtolower($day)]['close'] ?? '' }}" 
                                           class="time-picker pl-10 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Barbers Management -->
            <div class="form-section animate__animated animate__fadeIn">
                <h3 class="section-title text-xl font-semibold">Barbers Team</h3>
                <div class="space-y-4" id="barbers-container">
                    @php
                        $barbers = old('barbers', auth()->user()?->barberShop->barbers ?? []);
                    @endphp

                    @foreach($barbers as $index => $barber)
                        <div class="border rounded-md p-5 barber-item card-hover bg-white">
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="text-md font-medium flex items-center">
                                    <i class="fas fa-user-circle text-primary-500 mr-2"></i>
                                    Barber #<span class="barber-number">{{ $index + 1 }}</span>
                                </h4>
                                <button type="button" class="remove-barber text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded-full transition-all">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                    <input type="text" name="barbers[{{ $index }}][name]" 
                                           value="{{ is_array($barber) ? ($barber['name'] ?? '') : $barber }}" 
                                           class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Position</label>
                                    <input type="text" name="barbers[{{ $index }}][position]" 
                                           value="{{ is_array($barber) ? ($barber['position'] ?? '') : '' }}" 
                                           class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                                    <textarea name="barbers[{{ $index }}][bio]" rows="2" 
                                              class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ is_array($barber) ? ($barber['bio'] ?? '') : '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                    <!-- Empty template when no barbers exist -->
                    @if(count($barbers) === 0)
                        <div class="border rounded-md p-5 barber-item card-hover bg-white">
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="text-md font-medium flex items-center">
                                    <i class="fas fa-user-circle text-primary-500 mr-2"></i>
                                    Barber #<span class="barber-number">1</span>
                                </h4>
                                <button type="button" class="remove-barber text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded-full transition-all">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                    <input type="text" name="barbers[0][name]" 
                                           class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Position</label>
                                    <input type="text" name="barbers[0][position]" 
                                           class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                                    <textarea name="barbers[0][bio]" rows="2" 
                                              class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                
                <button type="button" id="add-barber" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all">
                    <i class="fas fa-plus mr-2"></i> Add Barber
                </button>
            </div>

            <!-- Social Media Links -->
            <div class="form-section animate__animated animate__fadeIn">
                <h3 class="section-title text-xl font-semibold">Social Media</h3>
                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                    @php
                        $socialLinks = old('social_links', auth()->user()?->barberShop->social_links ?? []);
                    @endphp
                    
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Facebook</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-blue-50 text-blue-600">
                                <i class="fab fa-facebook-f"></i>
                            </span>
                            <input type="text" name="social_links[facebook]" value="{{ $socialLinks['facebook'] ?? '' }}" 
                                  class="focus:ring-primary-500 focus:border-primary-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" 
                                  placeholder="facebook.com/yourbarbershop">
                        </div>
                    </div>
                    
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Instagram</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-pink-50 text-pink-600">
                                <i class="fab fa-instagram"></i>
                            </span>
                            <input type="text" name="social_links[instagram]" value="{{ $socialLinks['instagram'] ?? '' }}" 
                                  class="focus:ring-primary-500 focus:border-primary-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                  placeholder="instagram.com/yourbarbershop">
                        </div>
                    </div>
                    
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Twitter</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-blue-50 text-blue-400">
                                <i class="fab fa-twitter"></i>
                            </span>
                            <input type="text" name="social_links[twitter]" value="{{ $socialLinks['twitter'] ?? '' }}" 
                                  class="focus:ring-primary-500 focus:border-primary-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                  placeholder="twitter.com/yourbarbershop">
                        </div>
                    </div>
                    
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-1">YouTube</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-red-50 text-red-600">
                                <i class="fab fa-youtube"></i>
                            </span>
                            <input type="text" name="social_links[youtube]" value="{{ $socialLinks['youtube'] ?? '' }}" 
                                  class="focus:ring-primary-500 focus:border-primary-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                  placeholder="youtube.com/yourbarbershop">
                        </div>
                    </div>
                </div>
            </div>

            <div class="fixed bottom-0 md:left-60 right-0 bg-white shadow-lg border-t border-gray-200 p-4 z-50">
                <div class="max-w-5xl mx-auto flex justify-end space-x-3">
                    <a href="{{ route('barber.dashboard') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all">
                        <i class="fas fa-arrow-left mr-2"></i> Cancel
                    </a>
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all">
                        <i class="fas fa-save mr-2"></i> Save Changes
                    </button>
                </div>
            </div>
            <div class="pb-20"><!-- Spacer to prevent content from being hidden behind the fixed bar --></div>
        </form>
    </div>
</div>
@endsection

@section('additional_scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // File input previews
        document.getElementById('avatar').addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('img[alt="Shop avatar"]').src = e.target.result;
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });

        document.getElementById('cover').addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('img[alt="Shop cover"]').src = e.target.result;
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });

        // Initialize time pickers with better styling
        flatpickr('.time-picker', {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            minuteIncrement: 15
        });

        // Handle slug generation from shop name
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');
        
        if (nameInput && slugInput) {
            nameInput.addEventListener('blur', function() {
                if (!slugInput.value.trim()) {
                    // Only auto-generate slug if it's empty
                    let slug = this.value.trim()
                        .toLowerCase()
                        .replace(/\s+/g, '-')
                        .replace(/[^\w\-]+/g, '')
                        .replace(/\-\-+/g, '-')
                        .replace(/^-+/, '')
                        .replace(/-+$/, '');
                    
                    slugInput.value = slug;
                }
            });
        }

        // Barbers management with animation
        const barbersContainer = document.getElementById('barbers-container');
        const addBarberButton = document.getElementById('add-barber');
        
        // Add new barber
        addBarberButton.addEventListener('click', function() {
            const barberItems = document.querySelectorAll('.barber-item');
            const newIndex = barberItems.length;
            const barberTemplate = `
                <div class="border rounded-md p-5 barber-item card-hover bg-white animate__animated animate__fadeInDown">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-md font-medium flex items-center">
                            <i class="fas fa-user-circle text-primary-500 mr-2"></i>
                            Barber #<span class="barber-number">${newIndex + 1}</span>
                        </h4>
                        <button type="button" class="remove-barber text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded-full transition-all">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                            <input type="text" name="barbers[${newIndex}][name]" 
                                   class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Position</label>
                            <input type="text" name="barbers[${newIndex}][position]" 
                                   class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                            <textarea name="barbers[${newIndex}][bio]" rows="2" 
                                      class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                        </div>
                    </div>
                </div>
            `;
            
            barbersContainer.insertAdjacentHTML('beforeend', barberTemplate);
            attachRemoveEvents();
        });

        // Remove barber functionality
        function attachRemoveEvents() {
            const removeButtons = document.querySelectorAll('.remove-barber');
            removeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const barberItem = this.closest('.barber-item');
                    
                    if (document.querySelectorAll('.barber-item').length > 1) {
                        barberItem.classList.add('animate__animated', 'animate__fadeOutUp');
                        barberItem.addEventListener('animationend', function() {
                            barberItem.remove();
                            updateBarberNumbers();
                        });
                    } else {
                        alert('You need at least one barber in your shop.');
                    }
                });
            });
        }

        // Update barber numbers after removal
        function updateBarberNumbers() {
            const barberItems = document.querySelectorAll('.barber-item');
            barberItems.forEach((item, index) => {
                // Update visible number
                item.querySelector('.barber-number').textContent = index + 1;
                
                // Update form field names
                const inputs = item.querySelectorAll('input, textarea');
                inputs.forEach(input => {
                    const name = input.getAttribute('name');
                    if (name) {
                        const newName = name.replace(/barbers\[\d+\]/, `barbers[${index}]`);
                        input.setAttribute('name', newName);
                    }
                });
            });
        }

        // Initial setup
        attachRemoveEvents();
    });
</script>
@endsection