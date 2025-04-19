@extends('layouts.app')
@section('additional_styles')

    <style>
        *{
            scroll-behavior: smooth;
        }
        body {
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
        }
        .rating-star {
            color: #f59e0b;
        }
        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
        .service-card {
            transition: all 0.3s ease;
        }
        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .time-slot {
            transition: all 0.3s ease;
        }
        .time-slot:hover:not(.selected):not(.booked) {
            background-color: #ede9fe;
            border-color: #8b5cf6;
        }
        .time-slot.selected {
            background-color: #8b5cf6;
            color: white;
            border-color: #6d28d9;
        }
        .time-slot.booked {
            background-color: #f3f4f6;
            color: #9ca3af;
            cursor: not-allowed;
        }
        .gallery-img {
            transition: all 0.3s ease;
        }
        .gallery-img:hover {
            opacity: 0.9;
            transform: scale(1.02);
        }
        .tab-btn.active {
            color: #7c3aed;
            border-bottom-color: #7c3aed;
        }
    </style>
    @endsection

@section('content')


    <!-- Barber Header Section -->
    <div class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col md:flex-row" data-aos="fade-up">
                <!-- Barber Image -->
                <div class="md:w-1/3 mb-6 md:mb-0 md:pr-8">
                    <div class="relative rounded-lg overflow-hidden shadow-md h-64 md:h-auto">
                        <img src="/storage/{{ $barberShop->cover }}" alt="Classic Cuts Barber Shop" class="w-full h-full object-cover">
                        <div class="absolute top-4 right-4 bg-white rounded-full px-3 py-1 text-sm font-medium text-primary-600 shadow">
                            €€
                        </div>
                    </div>
                </div>
                
                <!-- Barber Info -->
                <div class="md:w-2/3">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">{{ $barberShop->name }}</h1>
                            <div class="flex items-center mt-2 mb-4">
                                <div class="flex items-center">
                                    <i class="fas fa-star rating-star"></i>
                                    <i class="fas fa-star rating-star"></i>
                                    <i class="fas fa-star rating-star"></i>
                                    <i class="fas fa-star rating-star"></i>
                                    <i class="fas fa-star-half-alt rating-star"></i>
                                </div>
                                <span class="ml-2 text-gray-600">(124 reviews)</span>
                            </div>
                        </div>
                        <button class="text-gray-400 hover:text-primary-600 transition-colors">
                            <i class="far fa-heart text-2xl"></i>
                        </button>
                    </div>
                    
                    <div class="space-y-3 text-gray-600">
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt w-5 text-center mr-2"></i>
                            <span>{{ $barberShop->city.', '.$barberShop->address.', '.$barberShop->zip}}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-phone-alt w-5 text-center mr-2"></i>
                            <span>{{ $barberShop->phone }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="far fa-clock w-5 text-center mr-2"></i>
                            @php
                                $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
                                $today = $days[date('w')];
                                $hours = json_decode(json_encode($barberShop->working_hours));
                                
                                if (isset($hours->$today)) {
                                    if (isset($hours->$today->closed) && $hours->$today->closed == "1") {
                                        $status = "Closed today";
                                    } else {
                                        $openTime = date('g:i A', strtotime($hours->$today->open));
                                        $closeTime = date('g:i A', strtotime($hours->$today->close));
                                        $status = "Open today: $openTime - $closeTime";
                                    }
                                } else {
                                    $status = "Hours not available";
                                }
                            @endphp
                            <span>{{ $status }}</span>
                        </div>
                    </div>
                    
                    <div class="mt-6 flex flex-wrap gap-4">
                        <a href="#book-appointment" class="bg-primary-600 hover:bg-primary-700 text-white font-medium px-6 py-3 rounded-md transition-colors shadow-sm inline-flex items-center">
                            <i class="far fa-calendar-check mr-2"></i>
                            Book Appointment
                        </a>
                        <a href="tel:{{ $barberShop->phone }}" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-800 font-medium px-6 py-3 rounded-md transition-colors shadow-sm inline-flex items-center">
                            <i class="fas fa-phone-alt mr-2"></i>
                            Call
                        </a>
                        <a href="{{ 'https://www.google.com/maps?q=' . urlencode($barberShop->name.','.$barberShop->city . ', ' . $barberShop->address . ', ' . $barberShop->zip) }}" target="_blank" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-800 font-medium px-6 py-3 rounded-md transition-colors shadow-sm inline-flex items-center">
                            <i class="fas fa-directions mr-2"></i>
                            Directions
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <div class="bg-white border-b sticky top-16 z-30" data-aos="fade-down">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex overflow-x-auto hide-scrollbar">
                <button class="tab-btn active whitespace-nowrap px-5 py-4 text-sm font-medium border-b-2 border-transparent focus:outline-none" data-target="services">
                    Services
                </button>
                <button class="tab-btn whitespace-nowrap px-5 py-4 text-sm font-medium border-b-2 border-transparent focus:outline-none" data-target="gallery">
                    Gallery
                </button>
                <button class="tab-btn whitespace-nowrap px-5 py-4 text-sm font-medium border-b-2 border-transparent focus:outline-none" data-target="reviews">
                    Reviews
                </button>
                <button class="tab-btn whitespace-nowrap px-5 py-4 text-sm font-medium border-b-2 border-transparent focus:outline-none" data-target="team">
                    Team
                </button>
                <button class="tab-btn whitespace-nowrap px-5 py-4 text-sm font-medium border-b-2 border-transparent focus:outline-none" data-target="about">
                    About
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Left Column -->
            <div class="md:w-2/3">
                <!-- Services Section -->
                <div id="services" class="tab-content bg-white rounded-lg shadow-sm p-6 mb-8" data-aos="fade-up">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Services</h2>
                    <div class="space-y-4">
                        @php
                            $serviceTypes = ['Haircuts', 'Beard & Shave', 'Packages'];
                            $groupedServices = collect($barberShop->services)
                                ->where('is_active', true)
                                ->groupBy('type');
                                //dd($groupedServices);
                        @endphp
                        
                        @foreach($serviceTypes as $type)
                            @if($groupedServices->has($type) && $groupedServices[$type]->count() > 0)
                                <div class="{{ !$loop->first ? 'mt-8' : '' }}">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-3">{{ $type }}</h3>
                                    <div class="space-y-4">
                                        @foreach($groupedServices[$type] as $service)
                                            <!-- Service Item -->
                                            <div class="service-card bg-gray-50 rounded-lg p-4 flex justify-between hover:shadow-md">
                                                <div>
                                                    <h4 class="service_name font-medium text-gray-900">{{ $service->name }}</h4>
                                                    <p class="text-sm text-gray-600 mt-1">{{ $service->description }}</p>
                                                    <p class="text-xs text-gray-500 mt-2">{{ $service->duration }} min</p>
                                                </div>
                                                <div class="text-right">
                                                    <div class="flex  font-semibold text-primary-600">
                                                €<p class="service_price">{{ $service->price }}</p>
                                                </div>
                                                    <button class="mt-2 text-sm bg-white text-primary-600 border border-primary-600 hover:bg-primary-600 hover:text-white px-3 py-1 rounded service-select-btn" 
                                                        data-service-id="{{ $service->id }}" 
                                                        onclick="toggleServiceSelection(this)">
                                                        Select
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        
                        @if($groupedServices->count() == 0)
                            <div class="text-center py-8 text-gray-500">
                                <p>No services available at the moment.</p>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Gallery Section -->
                <div id="gallery" class="tab-content hidden bg-white rounded-lg shadow-sm p-6 mb-8" data-aos="fade-up">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Gallery</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        <div class="gallery-img rounded-lg overflow-hidden cursor-pointer">
                            <img src="https://images.unsplash.com/photo-1625795856114-3e51a8c51e47?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&h=300&q=80" alt="Haircut example" class="w-full h-40 object-cover">
                        </div>
                        <div class="gallery-img rounded-lg overflow-hidden cursor-pointer">
                            <img src="https://images.unsplash.com/photo-1593702288056-7cc591665142?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&h=300&q=80" alt="Barber shop interior" class="w-full h-40 object-cover">
                        </div>
                        <div class="gallery-img rounded-lg overflow-hidden cursor-pointer">
                            <img src="https://images.unsplash.com/photo-1521490892560-df2bdbdc3a7a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&h=300&q=80" alt="Beard trim" class="w-full h-40 object-cover">
                        </div>
                        <div class="gallery-img rounded-lg overflow-hidden cursor-pointer">
                            <img src="https://images.unsplash.com/photo-1599351431202-1e0f0137899a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&h=300&q=80" alt="Styling products" class="w-full h-40 object-cover">
                        </div>
                        <div class="gallery-img rounded-lg overflow-hidden cursor-pointer">
                            <img src="https://images.unsplash.com/photo-1622296089748-53466f8e9a04?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&h=300&q=80" alt="Hair styling" class="w-full h-40 object-cover">
                        </div>
                        <div class="gallery-img rounded-lg overflow-hidden cursor-pointer">
                            <img src="https://images.unsplash.com/photo-1583500178450-e59e4309b57e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&h=300&q=80" alt="Beard grooming" class="w-full h-40 object-cover">
                        </div>
                    </div>
                </div>
                
                <!-- Reviews Section -->
                <div id="reviews" class="tab-content hidden bg-white rounded-lg shadow-sm p-6 mb-8" data-aos="fade-up">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">Reviews</h2>
                        <span class="bg-primary-50 text-primary-700 px-3 py-1 rounded-full text-sm font-medium">4.5 <i class="fas fa-star text-yellow-500 text-xs"></i> (124)</span>
                    </div>
                    
                    <!-- Review filters -->
                    <div class="flex flex-wrap gap-2 mb-6">
                        <button class="bg-primary-50 text-primary-700 px-3 py-1 rounded-full text-sm font-medium">All</button>
                        <button class="bg-gray-100 text-gray-700 hover:bg-gray-200 px-3 py-1 rounded-full text-sm">5 Stars (86)</button>
                        <button class="bg-gray-100 text-gray-700 hover:bg-gray-200 px-3 py-1 rounded-full text-sm">4 Stars (28)</button>
                        <button class="bg-gray-100 text-gray-700 hover:bg-gray-200 px-3 py-1 rounded-full text-sm">3 Stars (7)</button>
                        <button class="bg-gray-100 text-gray-700 hover:bg-gray-200 px-3 py-1 rounded-full text-sm">2 Stars (2)</button>
                        <button class="bg-gray-100 text-gray-700 hover:bg-gray-200 px-3 py-1 rounded-full text-sm">1 Star (1)</button>
                    </div>
                    
                    <!-- Review list -->
                    <div class="space-y-6">
                        <!-- Review Item -->
                        <div class="border-b pb-6">
                            <div class="flex justify-between mb-2">
                                <div class="flex items-center">
                                    <div class="bg-primary-600 text-white w-10 h-10 rounded-full flex items-center justify-center mr-3">
                                        <span>MB</span>
                                    </div>
                                    <div>
                                        <h4 class="font-medium">Maxime Bertrand</h4>
                                        <div class="flex items-center text-sm text-gray-500">
                                            <div class="flex">
                                                <i class="fas fa-star rating-star text-xs"></i>
                                                <i class="fas fa-star rating-star text-xs"></i>
                                                <i class="fas fa-star rating-star text-xs"></i>
                                                <i class="fas fa-star rating-star text-xs"></i>
                                                <i class="fas fa-star rating-star text-xs"></i>
                                            </div>
                                            <span class="ml-2">2 weeks ago</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-sm text-gray-500">
                                    <span>Classic Haircut</span>
                                </div>
                            </div>
                            <p class="text-gray-600 mt-2">Excellent service from start to finish. Thomas is a true professional who listens to what you want and delivers every time. The atmosphere is relaxed and the hot towel finish is an amazing touch!</p>
                        </div>
                        
                        <!-- Review Item -->
                        <div class="border-b pb-6">
                            <div class="flex justify-between mb-2">
                                <div class="flex items-center">
                                    <div class="bg-green-600 text-white w-10 h-10 rounded-full flex items-center justify-center mr-3">
                                        <span>LC</span>
                                    </div>
                                    <div>
                                        <h4 class="font-medium">Lucas Chambon</h4>
                                        <div class="flex items-center text-sm text-gray-500">
                                            <div class="flex">
                                                <i class="fas fa-star rating-star text-xs"></i>
                                                <i class="fas fa-star rating-star text-xs"></i>
                                                <i class="fas fa-star rating-star text-xs"></i>
                                                <i class="fas fa-star rating-star text-xs"></i>
                                                <i class="far fa-star rating-star text-xs"></i>
                                            </div>
                                            <span class="ml-2">1 month ago</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-sm text-gray-500">
                                    <span>Full Service</span>
                                </div>
                            </div>
                            <p class="text-gray-600 mt-2">Great haircut and beard trim. Would have given stars but the price is a bit high for me. Will definitely be back for the quality though!</p>
                        </div>
                    </div>
                </div>
            <!-- Team Section -->
<div id="team" class="tab-content hidden bg-white rounded-lg shadow-sm p-6 mb-8" data-aos="fade-up">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Meet Our Team</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Team Member -->
        <div class="text-center">
            <div class="rounded-full overflow-hidden w-32 h-32 mx-auto mb-4 border-2 border-primary-100">
                <img src="https://images.unsplash.com/photo-1572786194701-34e2ce740d2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&h=300&q=80" alt="Thomas Martin" class="w-full h-full object-cover">
            </div>
            <h3 class="font-semibold text-lg">Thomas Martin</h3>
            <p class="text-gray-600 text-sm">Master Barber</p>
            <p class="text-gray-500 text-sm mt-2">15+ years experience</p>
            <button class="mt-3 text-primary-600 hover:underline text-sm font-medium">Book with Thomas</button>
        </div>

        <!-- Team Member -->
        <div class="text-center">
            <div class="rounded-full overflow-hidden w-32 h-32 mx-auto mb-4 border-2 border-primary-100">
                <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&h=300&q=80" alt="David Leclerc" class="w-full h-full object-cover">
            </div>
            <h3 class="font-semibold text-lg">David Leclerc</h3>
            <p class="text-gray-600 text-sm">Senior Barber</p>
            <p class="text-gray-500 text-sm mt-2">8 years experience</p>
            <button class="mt-3 text-primary-600 hover:underline text-sm font-medium">Book with David</button>
        </div>

        <!-- Team Member -->
        <div class="text-center">
            <div class="rounded-full overflow-hidden w-32 h-32 mx-auto mb-4 border-2 border-primary-100">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&h=300&q=80" alt="Antoine Dupont" class="w-full h-full object-cover">
            </div>
            <h3 class="font-semibold text-lg">Antoine Dupont</h3>
            <p class="text-gray-600 text-sm">Junior Barber</p>
            <p class="text-gray-500 text-sm mt-2">3 years experience</p>
            <button class="mt-3 text-primary-600 hover:underline text-sm font-medium">Book with Antoine</button>
        </div>
    </div>
</div>

<!-- About Section -->
<div id="about" class="tab-content hidden bg-white rounded-lg shadow-sm p-6 mb-8" data-aos="fade-up">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">About Us</h2>
    <div class="prose max-w-none">
        <p class="mb-4">
            Founded in 2010, Classic Cuts Barber Shop has been providing premium men's grooming services in the heart of Paris for over a decade. Our shop combines traditional barbering techniques with modern styles to give you the perfect look.
        </p>
        <p class="mb-4">
            We believe that a visit to the barber should be more than just a haircut – it should be an experience. That's why we offer complimentary beverages, relaxing hot towel treatments, and a comfortable atmosphere where you can unwind.
        </p>
        <p class="mb-4">
            Our team of skilled barbers undergoes regular training to stay up-to-date with the latest trends and techniques, ensuring that you always receive the highest quality service.
        </p>
        <h3 class="text-xl font-semibold mt-6 mb-3">Our Values</h3>
        <ul class="list-disc pl-5 mb-4">
            <li>Quality service that exceeds expectations</li>
            <li>Creating lasting relationships with our clients</li>
            <li>Continuous learning and improvement</li>
            <li>Supporting our local community</li>
        </ul>
        <h3 class="text-xl font-semibold mt-6 mb-3">Amenities</h3>
        <div class="grid grid-cols-2 gap-2">
            <div class="flex items-center"><i class="fas fa-wifi mr-2 text-primary-600"></i> Free WiFi</div>
            <div class="flex items-center"><i class="fas fa-coffee mr-2 text-primary-600"></i> Complimentary Drinks</div>
            <div class="flex items-center"><i class="fas fa-tv mr-2 text-primary-600"></i> TV Entertainment</div>
            <div class="flex items-center"><i class="fas fa-credit-card mr-2 text-primary-600"></i> Card Payment</div>
        </div>
    </div>
</div>
</div>

<!-- Right Column -->
<div class="md:w-1/3">
    <!-- Booking Widget -->
    <div id="book-appointment" class="bg-white rounded-lg shadow-sm p-6 sticky top-32" data-aos="fade-up">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Book an Appointment</h2>
        <!-- Selected Services -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Selected Services</label>
            <div class="bg-gray-50 rounded-md p-4">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Services selected</span>
                    <span id="selected-services-count" class="bg-primary-100 text-primary-800 px-2 py-1 rounded-full text-xs font-medium">0</span>
                </div>
                <div id="selected-services-list" class="mt-3 space-y-2">
                    <!-- Selected services will be listed here dynamically -->
                    <p class="text-sm text-gray-500 italic">No services selected yet</p>
                </div>
                <div class="mt-3 pt-3 border-t border-gray-200">
                    <div class="flex justify-between">
                        <span class="font-medium ">Total</span>
                        <div>
                        €<span class="font-medium services_Total_price mr-0">0</span>
                        </div>
                    </div>
                    <div class="text-xs text-gray-500 mt-1">
                        Estimated duration: 0 min
                    </div>
                </div>
            </div>
        </div>
        <!-- Date Selector -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Select Date</label>
            <div class="flex space-x-2 overflow-x-auto pb-2 hide-scrollbar">
            @php
                $today = now();
                $workingHours = json_decode(json_encode($barberShop->working_hours));
            @endphp
            
            @for ($i = 0; $i < 7; $i++)
                @php
                $date = $today->copy()->addDays($i); // Creates a new date object for each day
                $dayName = strtolower($date->format('l'));// Gets the lowercase day name (e.g., "monday")
                $isOpen = isset($workingHours->$dayName) && 
                     (!isset($workingHours->$dayName->closed) || $workingHours->$dayName->closed != "1");
                $displayName = $i === 0 ? 'Today' : $date->format('D');// Shows "Today" for current day, short day name for others
                $dateValue = $date->format('Y-m-d');// Gets the date in 'Y-m-d' format for the input value
                @endphp
                
                <div class="min-w-[4.5rem] relative">
                    <input type="radio" 
                           name="appointment_date" 
                           id="date-{{ $i }}" 
                           value="{{ $dateValue }}" 
                           class="hidden peer"
                           {{ $i === 0 ? 'checked' : '' }}
                           {{ !$isOpen ? 'disabled' : '' }}>
                    <label 
                        for="date-{{ $i }}" 
                        class="block w-full px-3 py-2 border border-primary-500 rounded-md text-center text-sm 
                               transition-colors duration-200 cursor-pointer
                               text-primary-500 hover:bg-primary-50 
                               peer-checked:bg-primary-500 peer-checked:text-white
                               {{ !$isOpen ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}">
                        <span class="flex flex-col items-center justify-center w-full h-full">
                            <div class="font-medium">{{ $displayName }}</div>
                            <div class="text-xs">{{ $date->format('M j') }}</div>
                            @if (!$isOpen)
                                <div class="text-xs mt-1 text-gray-500 peer-checked:text-white">Closed</div>
                            @endif
                        </span>
                    </label>
                </div>
            @endfor
            </div>
        </div>
        
        <!-- Staff Selector -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Select Staff</label>
            <select class="w-full border border-gray-300 rounded-md p-2 focus:ring-primary-600 focus:border-primary-600">
                <option value="">Any available</option>
                <option value="thomas">Thomas Martin</option>
                <option value="david">David Leclerc</option>
                <option value="antoine">Antoine Dupont</option>
            </select>
        </div>
        
        <!-- Time Slots -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Select Time</label>
            <div class="grid grid-cols-3 gap-2">
                <button class="time-slot booked px-2 py-3 border rounded-md text-center text-sm">9:00</button>
                <button class="time-slot booked px-2 py-3 border rounded-md text-center text-sm">9:30</button>
                <button class="time-slot px-2 py-3 border rounded-md text-center text-sm hover:border-primary-600">10:00</button>
                <button class="time-slot px-2 py-3 border rounded-md text-center text-sm hover:border-primary-600">10:30</button>
                <button class="time-slot px-2 py-3 border rounded-md text-center text-sm hover:border-primary-600">11:00</button>
                <button class="time-slot booked px-2 py-3 border rounded-md text-center text-sm">11:30</button>
                <button class="time-slot px-2 py-3 border rounded-md text-center text-sm hover:border-primary-600">12:00</button>
                <button class="time-slot px-2 py-3 border rounded-md text-center text-sm hover:border-primary-600">12:30</button>
                <button class="time-slot selected px-2 py-3 border rounded-md text-center text-sm">14:00</button>
            </div>
        </div>
        
        <!-- Booking Button -->
        <button class="w-full bg-primary-600 hover:bg-primary-700 text-white font-medium px-6 py-3 rounded-md transition-colors shadow-sm text-center">
            Confirm Booking
        </button>
        <p class="text-xs text-gray-500 text-center mt-3">Free cancellation up to 24 hours before</p>
    </div>
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

    // Tabs functionality
    document.querySelectorAll('.tab-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            
            // Add active class to clicked button
            this.classList.add('active');
            
            // Hide all tab content
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });
            
            // Show selected tab content
            document.getElementById(this.dataset.target).classList.remove('hidden');
        });
    });

    // Time slot selection
    document.querySelectorAll('.time-slot:not(.booked)').forEach(slot => {
        slot.addEventListener('click', function() {
            document.querySelectorAll('.time-slot').forEach(s => {
                s.classList.remove('selected');
            });
            this.classList.add('selected');
        });
    });

    let selectedCount = 0;
    function toggleServiceSelection(ServiceSelectBtn) {
        const serviceId = ServiceSelectBtn.getAttribute('data-service-id');
        const selectedServices = document.querySelectorAll('.service-select-btn.selected');
        // Get the service details
            const serviceCard = ServiceSelectBtn.closest('.service-card');
            const serviceName = serviceCard.querySelector('.service_name').innerText;
            const servicePrice = serviceCard.querySelector('.service_price').innerText;
            const serviceDuration = serviceCard.querySelector('.text-xs.text-gray-500').innerText;
            const services_Total_price= document.querySelector('.services_Total_price');
        
        // Check if the button is already selected
        if (ServiceSelectBtn.classList.contains('selected')) {
            selectedCount--;       
            // Remove the service from the selected services list
            const selectedServicesList = document.getElementById('selected-services-list');
            const serviceToRemove = selectedServicesList.querySelector(`.service-item-${serviceId}`);
            if (serviceToRemove) {
                selectedServicesList.removeChild(serviceToRemove);
            }
            
            // If no services left, show "No services selected yet" message
            if (selectedCount === 0) {
                selectedServicesList.innerHTML = '<p class="text-sm text-gray-500 italic">No services selected yet</p>';
            }
            
            
            // Update total price by subtracting the deselected service price
            services_Total_price.innerText = (parseFloat(services_Total_price.innerText) - parseFloat(servicePrice)).toFixed(2);
            // Deselect the button
            ServiceSelectBtn.classList.remove('selected', 'bg-primary-600', 'text-white');
            ServiceSelectBtn.classList.add('bg-white', 'text-primary-600', 'border', 'border-primary-600', 'hover:bg-primary-600', 'hover:text-white');
            ServiceSelectBtn.innerText = 'Select';
            
            // Deselect the parent service card
            serviceCard.classList.remove('bg-primary-50', 'bg-primary-100');
            serviceCard.classList.add('bg-gray-50');
            
            // Reset text colors in the service card
            const serviceTexts = serviceCard.querySelectorAll('h4, p');
            serviceTexts.forEach(text => {
            text.classList.remove('text-white', 'text-primary-100');
            });
        } else {
            
            selectedCount++;
            

            // Get the selected services list container
            const selectedServicesList = document.getElementById('selected-services-list');

            // If this is the first selected service, clear the "No services selected yet" message
            if (selectedCount === 1) {
                selectedServicesList.innerHTML = '';
            }

            // Create a new service entry
            const serviceEntry = document.createElement('div');
            serviceEntry.classList.add('flex', 'justify-between', 'items-center', 'text-sm', `service-item-${serviceId}`);
            serviceEntry.setAttribute('data-selected-service-id', serviceId);
            serviceEntry.innerHTML = `
                <div>
                    <div class="font-medium">${serviceName}</div>
                    <div class="text-xs text-gray-500">${serviceDuration}</div>
                </div>
                <div class="font-medium">${servicePrice}</div>
            `;

            
            // Add the service to the selected services list
            selectedServicesList.appendChild(serviceEntry);

             // Update total price by subtracting the adding service price
             services_Total_price.innerText = (parseFloat(services_Total_price.innerText) + parseFloat(servicePrice)).toFixed(2);

            // Select the button
            ServiceSelectBtn.classList.add('selected', 'bg-primary-600', 'text-white');
            ServiceSelectBtn.classList.remove('bg-white', 'text-primary-600', 'border', 'border-primary-600', 'hover:bg-primary-600', 'hover:text-white');
            ServiceSelectBtn.innerText = 'Selected';
            
            // Select the parent service card with better contrast
            const serviceCard = ServiceSelectBtn.closest('.service-card');
            serviceCard.classList.remove('bg-gray-50');
            serviceCard.classList.add('bg-primary-50');
            
            // Set appropriate text colors for better visibility
            const serviceTexts = serviceCard.querySelectorAll('h4, p');
            serviceTexts.forEach(text => {
            text.classList.remove('text-gray-900', 'text-gray-600');
            });
        }
        
        // Update the selected services count
        document.getElementById('selected-services-count').innerText = selectedCount;

    }
</script>
@endsection


