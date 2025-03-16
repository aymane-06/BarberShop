@extends('layouts.auth')

@section('additional_styles')
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
    .working-hours-container {
        max-height: 250px;
        overflow-y: auto;
    }
</style>
@endsection

@section('content')
<div class="flex-grow flex items-center justify-center px-4 py-8">
    <div class="w-full max-w-6xl mx-auto">
        <div class="form-gradient p-8 rounded-xl shadow-lg">
            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Create Your Barbershop</h1>
                <p class="text-gray-600">Set up your shop on CutBook to attract new customers</p>
            </div>

            <!-- Form Progress Indicator -->
            <div class="mb-6">
                <div class="flex justify-between mb-2">
                    <span id="step1" class="progress-step active text-sm">Basic Information</span>
                    <span id="step2" class="progress-step text-sm">Contact & Location</span>
                    <span id="step3" class="progress-step text-sm">Shop Details</span>
                    <span id="step4" class="progress-step text-sm">Finalize</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                    <div id="progressBar" class="bg-primary-600 h-2 rounded-full progress-bar" style="width: 25%"></div>
                </div>
            </div>

            <form id="createBarbershopForm" action="{{ route('barber.barbershop.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <!-- Step 1: Basic Information -->
                <div id="step1Fields" class="space-y-4 slide-in-right">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Barbershop Name -->
                        <div class="input-focus-effect">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Barbershop Name*</label>
                            <input id="name" name="name" type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500" required>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Slug (auto-generated but can be edited) -->
                        <div class="input-focus-effect">
                            <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">URL Slug*</label>
                            <input id="slug" name="slug" type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500" required>
                            <p class="text-xs text-gray-500 mt-1">This will be your shop's unique URL identifier</p>
                            @error('slug')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Description -->
                    <div class="input-focus-effect">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description*</label>
                        <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500" required></textarea>
                        <p class="text-xs text-gray-500 mt-1">Tell potential customers about your shop and services</p>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4">
                        <button type="button" id="nextToStep2" class="btn-shine w-full bg-primary-600 hover:bg-primary-700 text-white py-3 px-6 rounded-lg font-medium transition-colors shadow-md">
                            Continue to Contact Details
                            <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 2: Contact & Location -->
                <div id="step2Fields" class="space-y-4 hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Phone -->
                        <div class="input-focus-effect">
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number*</label>
                            <input id="phone" name="phone" type="tel" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500" required>
                            @error('phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Email -->
                        <div class="input-focus-effect">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address*</label>
                            <input id="email" name="email" type="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500" required>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Address -->
                    <div class="input-focus-effect">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address*</label>
                        <input id="address" name="address" type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500" required>
                        @error('address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- City -->
                        <div class="input-focus-effect">
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City*</label>
                            <input id="city" name="city" type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500" required>
                            @error('city')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- ZIP Code -->
                        <div class="input-focus-effect">
                            <label for="zip" class="block text-sm font-medium text-gray-700 mb-1">ZIP Code*</label>
                            <input id="zip" name="zip" type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500" required>
                            @error('zip')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Website -->
                    <div class="input-focus-effect">
                        <label for="website" class="block text-sm font-medium text-gray-700 mb-1">Website (Optional)</label>
                        <input id="website" name="website" type="url" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                        @error('website')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button type="button" id="backToStep1" class="w-1/3 border border-gray-300 text-gray-700 py-3 px-6 rounded-lg font-medium hover:bg-gray-50 transition-colors">
                            <i class="fas fa-arrow-left mr-2"></i> Back
                        </button>
                        <button type="button" id="nextToStep3" class="btn-shine w-2/3 bg-primary-600 hover:bg-primary-700 text-white py-3 px-6 rounded-lg font-medium transition-colors shadow-md">
                            Continue to Shop Details
                            <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 3: Shop Details -->
                <div id="step3Fields" class="space-y-4 hidden">
                    <!-- Barbers Input -->
                    <div class="input-focus-effect">
                        <label for="barbers" class="block text-sm font-medium text-gray-700 mb-1">Barbers*</label>
                        <div class="border border-gray-300 rounded-lg p-3 bg-white">
                            <div id="barbers-container" class="space-y-3">
                                <div class="barber-entry flex items-center space-x-2">
                                    <input type="text" name="barbers[]" placeholder="Enter barber name" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500" required>
                                    <button type="button" class="remove-barber text-red-500 hover:text-red-700" style="display: none">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="button" id="add-barber" class="mt-2 text-sm text-primary-600 hover:text-primary-800 flex items-center">
                                <i class="fas fa-plus mr-1"></i> Add Another Barber
                            </button>
                        </div>
                        @error('barbers')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Working Hours -->
                    <div class="input-focus-effect">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Working Hours*</label>
                        <div class="border border-gray-300 rounded-lg p-3 bg-white working-hours-container">
                            @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                <div class="day-hours mb-3">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="font-medium text-sm">{{ $day }}</span>
                                        <div class="flex items-center">
                                            <input type="checkbox" id="{{ strtolower($day) }}_closed" data-day="{{ strtolower($day) }}" name="working_hours[{{ strtolower($day) }}][closed]" class="day-closed mr-2">
                                            <label for="{{ strtolower($day) }}_closed" class="text-sm text-gray-600">Closed</label>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2 day-time-inputs" data-day="{{ strtolower($day) }}">
                                        <div class="flex items-center">
                                            <input type="time" name="working_hours[{{ strtolower($day) }}][open]" class="w-full px-2 py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                                        </div>
                                        <div class="flex items-center">
                                            <input type="time" name="working_hours[{{ strtolower($day) }}][close]" class="w-full px-2 py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @error('working_hours')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Social Links -->
                    <div class="input-focus-effect">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Social Media Links (Optional)</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                <div class="bg-gray-100 px-3 py-2">
                                    <i class="fab fa-facebook text-blue-600"></i>
                                </div>
                                <input type="url" name="social_links[facebook]" placeholder="Facebook URL" class="flex-1 px-3 py-2 focus:outline-none">
                            </div>
                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                <div class="bg-gray-100 px-3 py-2">
                                    <i class="fab fa-instagram text-pink-600"></i>
                                </div>
                                <input type="url" name="social_links[instagram]" placeholder="Instagram URL" class="flex-1 px-3 py-2 focus:outline-none">
                            </div>
                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                <div class="bg-gray-100 px-3 py-2">
                                    <i class="fab fa-twitter text-blue-400"></i>
                                </div>
                                <input type="url" name="social_links[twitter]" placeholder="Twitter URL" class="flex-1 px-3 py-2 focus:outline-none">
                            </div>
                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                <div class="bg-gray-100 px-3 py-2">
                                    <i class="fab fa-tiktok text-black"></i>
                                </div>
                                <input type="url" name="social_links[tiktok]" placeholder="TikTok URL" class="flex-1 px-3 py-2 focus:outline-none">
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button type="button" id="backToStep2" class="w-1/3 border border-gray-300 text-gray-700 py-3 px-6 rounded-lg font-medium hover:bg-gray-50 transition-colors">
                            <i class="fas fa-arrow-left mr-2"></i> Back
                        </button>
                        <button type="button" id="nextToStep4" class="btn-shine w-2/3 bg-primary-600 hover:bg-primary-700 text-white py-3 px-6 rounded-lg font-medium transition-colors shadow-md">
                            Continue to Final Step
                            <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 4: Finalize -->
                <div id="step4Fields" class="space-y-4 hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Upload Avatar/Logo -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Shop Logo/Avatar</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                                <div class="space-y-1 text-center">
                                    <div id="avatar-preview" class="mx-auto h-32 w-32 rounded-full bg-gray-200 flex items-center justify-center mb-2 hidden">
                                        <img src="#" alt="Avatar preview" class="h-32 w-32 rounded-full object-cover">
                                    </div>
                                    <div id="avatar-placeholder" class="mx-auto h-24 w-24 text-gray-400">
                                        <i class="fas fa-store-alt fa-3x"></i>
                                    </div>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="avatar" class="relative cursor-pointer bg-white rounded-md font-medium text-primary-600 hover:text-primary-500 focus-within:outline-none">
                                            <span>Upload a logo</span>
                                            <input id="avatar" name="avatar" type="file" class="sr-only" accept="image/*" onchange="previewImage(this, 'avatar-preview', 'avatar-placeholder')">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG up to 2MB</p>
                                </div>
                            </div>
                            @error('avatar')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Upload Cover Photo -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Cover Photo</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                                <div class="space-y-1 text-center">
                                    <div id="cover-preview" class="mx-auto h-32 w-full bg-gray-200 flex items-center justify-center mb-2 hidden">
                                        <img src="#" alt="Cover preview" class="h-32 w-full object-cover">
                                    </div>
                                    <div id="cover-placeholder" class="mx-auto h-24 w-24 text-gray-400">
                                        <i class="fas fa-image fa-3x"></i>
                                    </div>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="cover" class="relative cursor-pointer bg-white rounded-md font-medium text-primary-600 hover:text-primary-500 focus-within:outline-none">
                                            <span>Upload a cover</span>
                                            <input id="cover" name="cover" type="file" class="sr-only" accept="image/*" onchange="previewImage(this, 'cover-preview', 'cover-placeholder')">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG up to 2MB</p>
                                </div>
                            </div>
                            @error('cover')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Terms and Privacy -->
                    <div class="mt-4">
                        <div class="flex items-start">
                            <input id="terms" name="terms" type="checkbox" class="h-4 w-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500" required>
                            <label for="terms" class="ml-2 block text-sm text-gray-700">
                                I agree to the <a href="#" class="text-primary-600 hover:text-primary-800">Terms of Service</a> and <a href="#" class="text-primary-600 hover:text-primary-800">Privacy Policy</a>
                            </label>
                        </div>
                        @error('terms')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3 pt-6">
                        <button type="button" id="backToStep3" class="w-1/3 border border-gray-300 text-gray-700 py-3 px-6 rounded-lg font-medium hover:bg-gray-50 transition-colors">
                            <i class="fas fa-arrow-left mr-2"></i> Back
                        </button>
                        <button type="submit" class="btn-shine w-2/3 bg-primary-600 hover:bg-primary-700 text-white py-3 px-6 rounded-lg font-medium transition-colors shadow-md">
                            Create Barbershop
                            <i class="fas fa-check ml-2"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('additional_scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    // Initialize AOS animation
    AOS.init({
        once: true,
        duration: 800,
    });
    
    // Auto-generate slug from name
    document.getElementById('name').addEventListener('input', function() {
        const name = this.value;
        const slug = name.toLowerCase()
            .replace(/[^\w\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .trim();
        
        document.getElementById('slug').value = slug;
    });
    
    // Multi-step form navigation
    const step1 = document.getElementById('step1');
    const step2 = document.getElementById('step2');
    const step3 = document.getElementById('step3');
    const step4 = document.getElementById('step4');
    const step1Fields = document.getElementById('step1Fields');
    const step2Fields = document.getElementById('step2Fields');
    const step3Fields = document.getElementById('step3Fields');
    const step4Fields = document.getElementById('step4Fields');
    const progressBar = document.getElementById('progressBar');
    
    // Navigation buttons
    document.getElementById('nextToStep2').addEventListener('click', function() {
        // Validate step 1
        const name = document.getElementById('name').value;
        const description = document.getElementById('description').value;
        const slug = document.getElementById('slug').value;
        
        if (!name || !description || !slug) {
            alert('Please fill in all required fields before proceeding.');
            return;
        }
        
        step1Fields.classList.add('hidden');
        step2Fields.classList.add('slide-in-right');
        step2Fields.classList.remove('hidden');
        step1.classList.remove('active');
        step2.classList.add('active');
        progressBar.style.width = '50%';
    });
    
    document.getElementById('backToStep1').addEventListener('click', function() {
        step2Fields.classList.add('hidden');
        step1Fields.classList.remove('hidden');
        step2.classList.remove('active');
        step1.classList.add('active');
        progressBar.style.width = '25%';
    });
    
    document.getElementById('nextToStep3').addEventListener('click', function() {
        // Validate step 2
        const phone = document.getElementById('phone').value;
        const email = document.getElementById('email').value;
        const address = document.getElementById('address').value;
        const city = document.getElementById('city').value;
        const zip = document.getElementById('zip').value;
        
        if (!phone || !email || !address || !city || !zip) {
            alert('Please fill in all required fields before proceeding.');
            return;
        }
        
        step2Fields.classList.add('hidden');
        step3Fields.classList.add('slide-in-right');
        step3Fields.classList.remove('hidden');
        step2.classList.remove('active');
        step3.classList.add('active');
        progressBar.style.width = '75%';
    });
    
    document.getElementById('backToStep2').addEventListener('click', function() {
        step3Fields.classList.add('hidden');
        step2Fields.classList.remove('hidden');
        step3.classList.remove('active');
        step2.classList.add('active');
        progressBar.style.width = '50%';
    });
    
    document.getElementById('nextToStep4').addEventListener('click', function() {
        // Basic validation for step 3
        const barberInputs = document.querySelectorAll('input[name="barbers[]"]');
        let hasBarber = false;
        
        barberInputs.forEach(input => {
            if (input.value.trim() !== '') {
                hasBarber = true;
            }
        });
        
        if (!hasBarber) {
            alert('Please add at least one barber.');
            return;
        }
        
        step3Fields.classList.add('hidden');
        step4Fields.classList.add('slide-in-right');
        step4Fields.classList.remove('hidden');
        step3.classList.remove('active');
        step4.classList.add('active');
        progressBar.style.width = '100%';
    });
    
    document.getElementById('backToStep3').addEventListener('click', function() {
        step4Fields.classList.add('hidden');
        step3Fields.classList.remove('hidden');
        step4.classList.remove('active');
        step3.classList.add('active');
        progressBar.style.width = '75%';
    });
    
    // Add barber functionality
    document.getElementById('add-barber').addEventListener('click', function() {
        const container = document.getElementById('barbers-container');
        const newBarberEntry = document.createElement('div');
        newBarberEntry.className = 'barber-entry flex items-center space-x-2';
        newBarberEntry.innerHTML = `
            <input type="text" name="barbers[]" placeholder="Enter barber name" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500" required>
            <button type="button" class="remove-barber text-red-500 hover:text-red-700">
                <i class="fas fa-times"></i>
            </button>
        `;
        
        container.appendChild(newBarberEntry);
        
        // Show all remove buttons if there's more than one barber
        if (container.children.length > 1) {
            document.querySelectorAll('.remove-barber').forEach(button => button.style.display = 'inline-block');
        }
    });
    
    // Remove barber functionality
    document.addEventListener('click', function(e) {
        
        
        if (e.target.classList.contains('remove-barber') || 
            (e.target.parentElement && e.target.parentElement.classList.contains('remove-barber'))) {
            
            // Find the barber-entry element to remove (could be parent or grandparent)
            const barberEntry = e.target.closest('.barber-entry');
            if (barberEntry) {
                barberEntry.remove();
                
                // Hide all remove buttons if there's only one barber
                const container = document.getElementById('barbers-container');
                if (container.children.length === 1) {
                    document.querySelectorAll('.remove-barber').forEach(button => button.style.display = 'none');
                }
            }
        }
    });
</script>
@endsection
