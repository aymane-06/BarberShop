@extends('layouts.app')
@section('additional_styles')
<style>
        body {
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .rating-star {
            color: #f59e0b;
        }
        .price-tag {
            transition: transform 0.3s ease;
        }
        .price-tag:hover {
            transform: scale(1.05);
        }
        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
        .filter-option {
            transition: all 0.2s ease;
        }
        .filter-option:hover {
            background-color: #f3f4f6;
        }
        .filter-option.active {
            background-color: #ede9fe;
            color: #6d28d9;
            font-weight: 500;
        }
        .mobile-filters {
            transition: transform 0.3s ease-in-out;
        }
    </style>
@endsection
    
@section('content')

    <!-- Search Results Header -->
    <div class="bg-gray-100 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="mb-6" data-aos="fade-down">
                <h1 class="text-3xl font-bold text-gray-800">Barber Search Results</h1>
                <p class="text-gray-600 mt-2">Find the perfect barber in your area</p>
            </div>
            
            <!-- Search Form -->
            <form action="/search-results.php" method="GET" class="bg-white shadow-sm rounded-lg p-4 flex flex-wrap items-center gap-3" data-aos="fade-up">
                <div class="flex-grow min-w-[200px]">
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                            <i class="fas fa-map-marker-alt"></i>
                        </span>
                        <input type="text" id="location" name="location" placeholder="City or zip code" 
                            class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                            value="<?php echo isset($_GET['location']) ? htmlspecialchars($_GET['location']) : ''; ?>">
                    </div>
                </div>
                <div class="w-full sm:w-auto">
                    <label for="service" class="block text-sm font-medium text-gray-700 mb-1">Service</label>
                    <select id="service" name="service" class="w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        <option value="">All Services</option>
                        <option value="haircut" <?php echo isset($_GET['service']) && $_GET['service'] === 'haircut' ? 'selected' : ''; ?>>Haircut</option>
                        <option value="beard" <?php echo isset($_GET['service']) && $_GET['service'] === 'beard' ? 'selected' : ''; ?>>Beard Trim</option>
                        <option value="shave" <?php echo isset($_GET['service']) && $_GET['service'] === 'shave' ? 'selected' : ''; ?>>Shave</option>
                        <option value="coloring" <?php echo isset($_GET['service']) && $_GET['service'] === 'coloring' ? 'selected' : ''; ?>>Hair Coloring</option>
                    </select>
                </div>
                <div class="w-full sm:w-auto">
                    <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                    <input type="date" id="date" name="date" 
                        class="w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        value="<?php echo isset($_GET['date']) ? htmlspecialchars($_GET['date']) : date('Y-m-d'); ?>">
                </div>
                <div class="w-full sm:w-auto flex items-end">
                    <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-medium py-2 px-6 rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 h-[42px]">
                        <i class="fas fa-search mr-2"></i>Search
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Mobile Filter Toggle -->
    <div class="md:hidden bg-white p-4 shadow-sm sticky top-16 z-30">
        <button id="toggle-filters" class="w-full flex items-center justify-center space-x-2 py-2 bg-primary-50 text-primary-700 rounded-md">
            <i class="fas fa-filter"></i>
            <span>Filter Results</span>
        </button>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row">
            <!-- Filter Sidebar - Desktop -->
            <div class="hidden md:block w-64 pr-8" data-aos="fade-right">
                <div class="bg-white rounded-lg shadow-sm p-6 sticky top-24">
                    <h3 class="font-bold text-lg mb-4">Filters</h3>
                    
                    <!-- Services -->
                    <div class="mb-6">
                        <h4 class="font-medium text-gray-700 mb-2">Services</h4>
                        <div class="space-y-2">
                            <label class="flex items-center filter-option p-2 rounded cursor-pointer active">
                                <input type="checkbox" class="form-checkbox h-4 w-4 text-primary-600 rounded" checked>
                                <span class="ml-2">Haircut</span>
                            </label>
                            <label class="flex items-center filter-option p-2 rounded cursor-pointer">
                                <input type="checkbox" class="form-checkbox h-4 w-4 text-primary-600 rounded">
                                <span class="ml-2">Beard Trim</span>
                            </label>
                            <label class="flex items-center filter-option p-2 rounded cursor-pointer">
                                <input type="checkbox" class="form-checkbox h-4 w-4 text-primary-600 rounded">
                                <span class="ml-2">Hair Styling</span>
                            </label>
                            <label class="flex items-center filter-option p-2 rounded cursor-pointer">
                                <input type="checkbox" class="form-checkbox h-4 w-4 text-primary-600 rounded">
                                <span class="ml-2">Hot Towel Shave</span>
                            </label>
                            <label class="flex items-center filter-option p-2 rounded cursor-pointer">
                                <input type="checkbox" class="form-checkbox h-4 w-4 text-primary-600 rounded">
                                <span class="ml-2">Hair Coloring</span>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Price Range -->
                    <div class="mb-6">
                        <h4 class="font-medium text-gray-700 mb-2">Price Range</h4>
                        <div class="space-y-2">
                            <label class="flex items-center filter-option p-2 rounded cursor-pointer active">
                                <input type="radio" name="price" class="form-radio h-4 w-4 text-primary-600" checked>
                                <span class="ml-2">Any Price</span>
                            </label>
                            <label class="flex items-center filter-option p-2 rounded cursor-pointer">
                                <input type="radio" name="price" class="form-radio h-4 w-4 text-primary-600">
                                <span class="ml-2">€ (Budget)</span>
                            </label>
                            <label class="flex items-center filter-option p-2 rounded cursor-pointer">
                                <input type="radio" name="price" class="form-radio h-4 w-4 text-primary-600">
                                <span class="ml-2">€€ (Standard)</span>
                            </label>
                            <label class="flex items-center filter-option p-2 rounded cursor-pointer">
                                <input type="radio" name="price" class="form-radio h-4 w-4 text-primary-600">
                                <span class="ml-2">€€€ (Premium)</span>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Ratings -->
                    <div class="mb-6">
                        <h4 class="font-medium text-gray-700 mb-2">Rating</h4>
                        <div class="space-y-2">
                            <label class="flex items-center filter-option p-2 rounded cursor-pointer">
                                <input type="radio" name="rating" class="form-radio h-4 w-4 text-primary-600">
                                <span class="ml-2 flex items-center">
                                    <i class="fas fa-star rating-star"></i>
                                    <i class="fas fa-star rating-star"></i>
                                    <i class="fas fa-star rating-star"></i>
                                    <i class="fas fa-star rating-star"></i>
                                    <i class="fas fa-star rating-star"></i>
                                    <span class="ml-1">& up</span>
                                </span>
                            </label>
                            <label class="flex items-center filter-option p-2 rounded cursor-pointer active">
                                <input type="radio" name="rating" class="form-radio h-4 w-4 text-primary-600" checked>
                                <span class="ml-2 flex items-center">
                                    <i class="fas fa-star rating-star"></i>
                                    <i class="fas fa-star rating-star"></i>
                                    <i class="fas fa-star rating-star"></i>
                                    <i class="fas fa-star rating-star"></i>
                                    <i class="far fa-star rating-star"></i>
                                    <span class="ml-1">& up</span>
                                </span>
                            </label>
                            <label class="flex items-center filter-option p-2 rounded cursor-pointer">
                                <input type="radio" name="rating" class="form-radio h-4 w-4 text-primary-600">
                                <span class="ml-2 flex items-center">
                                    <i class="fas fa-star rating-star"></i>
                                    <i class="fas fa-star rating-star"></i>
                                    <i class="fas fa-star rating-star"></i>
                                    <i class="far fa-star rating-star"></i>
                                    <i class="far fa-star rating-star"></i>
                                    <span class="ml-1">& up</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Availability -->
                    <div class="mb-6">
                        <h4 class="font-medium text-gray-700 mb-2">Availability</h4>
                        <div class="mb-3">
                            <label class="block text-sm text-gray-600 mb-1">Date</label>
                            <input type="date" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary-300">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Time</label>
                            <select class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary-300">
                                <option value="">Any time</option>
                                <option value="morning">Morning (8AM - 12PM)</option>
                                <option value="afternoon">Afternoon (12PM - 5PM)</option>
                                <option value="evening">Evening (5PM - 10PM)</option>
                            </select>
                        </div>
                    </div>
                    
                    <button class="w-full bg-primary-600 text-white py-2 px-4 rounded-md hover:bg-primary-700 transition-colors">
                        Apply Filters
                    </button>
                </div>
            </div>
            
            <!-- Mobile Filter Panel (Hidden by default) -->
            <div id="mobile-filters" class="md:hidden fixed inset-0 bg-gray-900 bg-opacity-50 z-40 hidden">
                <div class="mobile-filters bg-white h-full w-full overflow-auto transform translate-y-full">
                    <div class="p-4 border-b sticky top-0 bg-white z-10 flex justify-between items-center">
                        <h3 class="font-bold text-lg">Filter Results</h3>
                        <button id="close-filters" class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <!-- Filter Content (same as desktop) -->
                        <!-- Services -->
                        <div class="mb-6">
                            <h4 class="font-medium text-gray-700 mb-2">Services</h4>
                            <div class="space-y-2">
                                <label class="flex items-center filter-option p-2 rounded cursor-pointer active">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary-600 rounded" checked>
                                    <span class="ml-2">Haircut</span>
                                </label>
                                <label class="flex items-center filter-option p-2 rounded cursor-pointer">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary-600 rounded">
                                    <span class="ml-2">Beard Trim</span>
                                </label>
                                <label class="flex items-center filter-option p-2 rounded cursor-pointer">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary-600 rounded">
                                    <span class="ml-2">Hair Styling</span>
                                </label>
                                <label class="flex items-center filter-option p-2 rounded cursor-pointer">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary-600 rounded">
                                    <span class="ml-2">Hot Towel Shave</span>
                                </label>
                                <label class="flex items-center filter-option p-2 rounded cursor-pointer">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-primary-600 rounded">
                                    <span class="ml-2">Hair Coloring</span>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Price Range -->
                        <div class="mb-6">
                            <h4 class="font-medium text-gray-700 mb-2">Price Range</h4>
                            <div class="space-y-2">
                                <label class="flex items-center filter-option p-2 rounded cursor-pointer active">
                                    <input type="radio" name="mobile-price" class="form-radio h-4 w-4 text-primary-600" checked>
                                    <span class="ml-2">Any Price</span>
                                </label>
                                <label class="flex items-center filter-option p-2 rounded cursor-pointer">
                                    <input type="radio" name="mobile-price" class="form-radio h-4 w-4 text-primary-600">
                                    <span class="ml-2">€ (Budget)</span>
                                </label>
                                <label class="flex items-center filter-option p-2 rounded cursor-pointer">
                                    <input type="radio" name="mobile-price" class="form-radio h-4 w-4 text-primary-600">
                                    <span class="ml-2">€€ (Standard)</span>
                                </label>
                                <label class="flex items-center filter-option p-2 rounded cursor-pointer">
                                    <input type="radio" name="mobile-price" class="form-radio h-4 w-4 text-primary-600">
                                    <span class="ml-2">€€€ (Premium)</span>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Ratings -->
                        <div class="mb-6">
                            <h4 class="font-medium text-gray-700 mb-2">Rating</h4>
                            <div class="space-y-2">
                                <label class="flex items-center filter-option p-2 rounded cursor-pointer">
                                    <input type="radio" name="mobile-rating" class="form-radio h-4 w-4 text-primary-600">
                                    <span class="ml-2 flex items-center">
                                        <i class="fas fa-star rating-star"></i>
                                        <i class="fas fa-star rating-star"></i>
                                        <i class="fas fa-star rating-star"></i>
                                        <i class="fas fa-star rating-star"></i>
                                        <i class="fas fa-star rating-star"></i>
                                        <span class="ml-1">& up</span>
                                    </span>
                                </label>
                                <label class="flex items-center filter-option p-2 rounded cursor-pointer active">
                                    <input type="radio" name="mobile-rating" class="form-radio h-4 w-4 text-primary-600" checked>
                                    <span class="ml-2 flex items-center">
                                        <i class="fas fa-star rating-star"></i>
                                        <i class="fas fa-star rating-star"></i>
                                        <i class="fas fa-star rating-star"></i>
                                        <i class="fas fa-star rating-star"></i>
                                        <i class="far fa-star rating-star"></i>
                                        <span class="ml-1">& up</span>
                                    </span>
                                </label>
                                <label class="flex items-center filter-option p-2 rounded cursor-pointer">
                                    <input type="radio" name="mobile-rating" class="form-radio h-4 w-4 text-primary-600">
                                    <span class="ml-2 flex items-center">
                                        <i class="fas fa-star rating-star"></i>
                                        <i class="fas fa-star rating-star"></i>
                                        <i class="fas fa-star rating-star"></i>
                                        <i class="far fa-star rating-star"></i>
                                        <i class="far fa-star rating-star"></i>
                                        <span class="ml-1">& up</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Availability -->
                        <div class="mb-6">
                            <h4 class="font-medium text-gray-700 mb-2">Availability</h4>
                            <div class="mb-3">
                                <label class="block text-sm text-gray-600 mb-1">Date</label>
                                <input type="date" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary-300">
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600 mb-1">Time</label>
                                <select class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary-300">
                                    <option value="">Any time</option>
                                    <option value="morning">Morning (8AM - 12PM)</option>
                                    <option value="afternoon">Afternoon (12PM - 5PM)</option>
                                    <option value="evening">Evening (5PM - 10PM)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 border-t sticky bottom-0 bg-white">
                        <button class="w-full bg-primary-600 text-white py-3 px-4 rounded-md hover:bg-primary-700 transition-colors">
                            Apply Filters
                        </button>
                    </div>
                </div>
            </div>
        
            <!-- Results Grid -->
            <div class="flex-1">
                <!-- Sort Options -->
                <div class="flex justify-between items-center mb-6">
                    <p class="text-gray-600">Showing 1-10 of 24 results</p>
                    <div class="relative">
                        <select class="appearance-none bg-white border border-gray-300 text-gray-700 py-2 pl-4 pr-8 rounded leading-tight focus:outline-none focus:ring-2 focus:ring-primary-300">
                            <option>Recommended</option>
                            <option>Highest Rated</option>
                            <option>Price: Low to High</option>
                            <option>Price: High to Low</option>
                            <option>Most Popular</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Results Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-6">
                    <!-- Result Card 1 -->
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover" data-aos="fade-up">
                        <a href="/barber-detail/1" class="block">
                            <div class="relative">
                                <img src="https://images.unsplash.com/photo-1585747860715-2ba37e788b70?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&h=300&q=80" alt="Classic Cuts Barbershop" class="w-full h-48 object-cover">
                                <div class="absolute top-4 right-4 bg-white rounded-full px-3 py-1 text-sm font-medium text-primary-600 shadow price-tag">
                                    €€
                                </div>
                            </div>
                            <div class="p-5">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-bold text-lg text-gray-900">Classic Cuts Barbershop</h3>
                                        <div class="flex items-center mt-1 mb-2">
                                            <div class="flex items-center">
                                                <i class="fas fa-star rating-star text-sm"></i>
                                                <i class="fas fa-star rating-star text-sm"></i>
                                                <i class="fas fa-star rating-star text-sm"></i>
                                                <i class="fas fa-star rating-star text-sm"></i>
                                                <i class="fas fa-star-half-alt rating-star text-sm"></i>
                                            </div>
                                            <span class="ml-1 text-sm text-gray-600">(126 reviews)</span>
                                        </div>
                                    </div>
                                    <button class="text-gray-400 hover:text-primary-600 transition-colors">
                                        <i class="far fa-heart text-xl"></i>
                                    </button>
                                </div>
                                <div class="flex items-center text-gray-600 text-sm">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>16 Rue de Rivoli, Paris 1er</span>
                                </div>
                                <!-- Completing the first barber card -->
<div class="flex items-center text-gray-600 text-sm mt-2">
    <i class="fas fa-cut mr-2"></i>
    <span>Haircut, Beard Trim, Hot Towel Shave</span>
</div>
<div class="mt-4 flex justify-between items-center">
    <span class="text-primary-600 font-medium">From €25</span>
    <span class="text-sm text-gray-500">Next available: Today</span>
</div>
</div>
</a>
</div>

<!-- Result Card 2 -->
<div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover" data-aos="fade-up" data-aos-delay="100">
<a href="/barber-detail/2" class="block">
    <div class="relative">
        <img src="https://images.unsplash.com/photo-1503951914875-452162b0f3f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&h=300&q=80" alt="Modern Barber Co." class="w-full h-48 object-cover">
        <div class="absolute top-4 right-4 bg-white rounded-full px-3 py-1 text-sm font-medium text-primary-600 shadow price-tag">
            €€€
        </div>
    </div>
    <div class="p-5">
        <div class="flex justify-between items-start">
            <div>
                <h3 class="font-bold text-lg text-gray-900">Modern Barber Co.</h3>
                <div class="flex items-center mt-1 mb-2">
                    <div class="flex items-center">
                        <i class="fas fa-star rating-star text-sm"></i>
                        <i class="fas fa-star rating-star text-sm"></i>
                        <i class="fas fa-star rating-star text-sm"></i>
                        <i class="fas fa-star rating-star text-sm"></i>
                        <i class="fas fa-star rating-star text-sm"></i>
                    </div>
                    <span class="ml-1 text-sm text-gray-600">(89 reviews)</span>
                </div>
            </div>
            <button class="text-gray-400 hover:text-primary-600 transition-colors">
                <i class="far fa-heart text-xl"></i>
            </button>
        </div>
        <div class="flex items-center text-gray-600 text-sm">
            <i class="fas fa-map-marker-alt mr-2"></i>
            <span>42 Avenue des Champs-Élysées, Paris 8e</span>
        </div>
        <div class="flex items-center text-gray-600 text-sm mt-2">
            <i class="fas fa-cut mr-2"></i>
            <span>Haircut, Hair Styling, Hair Coloring</span>
        </div>
        <div class="mt-4 flex justify-between items-center">
            <span class="text-primary-600 font-medium">From €45</span>
            <span class="text-sm text-gray-500">Next available: Tomorrow</span>
        </div>
    </div>
</a>
</div>

<!-- Result Card 3 -->
<div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover" data-aos="fade-up" data-aos-delay="200">
<a href="/barber-detail/3" class="block">
    <div class="relative">
        <img src="https://images.unsplash.com/photo-1599351431202-1e0f0137899a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&h=300&q=80" alt="Le Salon de Coiffure" class="w-full h-48 object-cover">
        <div class="absolute top-4 right-4 bg-white rounded-full px-3 py-1 text-sm font-medium text-primary-600 shadow price-tag">
            €
        </div>
    </div>
    <div class="p-5">
        <div class="flex justify-between items-start">
            <div>
                <h3 class="font-bold text-lg text-gray-900">Le Salon de Coiffure</h3>
                <div class="flex items-center mt-1 mb-2">
                    <div class="flex items-center">
                        <i class="fas fa-star rating-star text-sm"></i>
                        <i class="fas fa-star rating-star text-sm"></i>
                        <i class="fas fa-star rating-star text-sm"></i>
                        <i class="fas fa-star-half-alt rating-star text-sm"></i>
                        <i class="far fa-star rating-star text-sm"></i>
                    </div>
                    <span class="ml-1 text-sm text-gray-600">(42 reviews)</span>
                </div>
            </div>
            <button class="text-gray-400 hover:text-primary-600 transition-colors">
                <i class="far fa-heart text-xl"></i>
            </button>
        </div>
        <div class="flex items-center text-gray-600 text-sm">
            <i class="fas fa-map-marker-alt mr-2"></i>
            <span>8 Rue de Seine, Paris 6e</span>
        </div>
        <div class="flex items-center text-gray-600 text-sm mt-2">
            <i class="fas fa-cut mr-2"></i>
            <span>Haircut, Beard Trim</span>
        </div>
        <div class="mt-4 flex justify-between items-center">
            <span class="text-primary-600 font-medium">From €18</span>
            <span class="text-sm text-gray-500">Next available: Today</span>
        </div>
    </div>
</a>
</div>

<!-- Result Card 4 -->
<div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover" data-aos="fade-up" data-aos-delay="300">
<a href="/barber-detail/4" class="block">
    <div class="relative">
        <img src="https://images.unsplash.com/photo-1622288432450-277d0fef5ed7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&h=300&q=80" alt="Sharp Edge" class="w-full h-48 object-cover">
        <div class="absolute top-4 right-4 bg-white rounded-full px-3 py-1 text-sm font-medium text-primary-600 shadow price-tag">
            €€
        </div>
    </div>
    <div class="p-5">
        <div class="flex justify-between items-start">
            <div>
                <h3 class="font-bold text-lg text-gray-900">Sharp Edge</h3>
                <div class="flex items-center mt-1 mb-2">
                    <div class="flex items-center">
                        <i class="fas fa-star rating-star text-sm"></i>
                        <i class="fas fa-star rating-star text-sm"></i>
                        <i class="fas fa-star rating-star text-sm"></i>
                        <i class="fas fa-star rating-star text-sm"></i>
                        <i class="far fa-star rating-star text-sm"></i>
                    </div>
                    <span class="ml-1 text-sm text-gray-600">(107 reviews)</span>
                </div>
            </div>
            <button class="text-gray-400 hover:text-primary-600 transition-colors">
                <i class="far fa-heart text-xl"></i>
            </button>
        </div>
        <div class="flex items-center text-gray-600 text-sm">
            <i class="fas fa-map-marker-alt mr-2"></i>
            <span>24 Boulevard de Montmartre, Paris 9e</span>
        </div>
        <div class="flex items-center text-gray-600 text-sm mt-2">
            <i class="fas fa-cut mr-2"></i>
            <span>Haircut, Beard Trim, Hot Towel Shave</span>
        </div>
        <div class="mt-4 flex justify-between items-center">
            <span class="text-primary-600 font-medium">From €30</span>
            <span class="text-sm text-gray-500">Next available: Today</span>
        </div>
    </div>
</a>
</div>

                </div>
                
                <!-- Pagination -->
                <div class="mt-12 flex justify-center" data-aos="fade-up" data-aos-delay="400">
                    <nav class="flex items-center">
                        <a href="#" class="px-3 py-2 rounded-md text-gray-400 hover:text-primary-600"></a>
                            <i class="fas fa-chevron-left"></i>
                        </a>
                        <a href="#" class="px-4 py-2 rounded-md bg-primary-50 text-primary-600 font-medium mx-1">1</a>
                        <a href="#" class="px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 mx-1">2</a>
                        <a href="#" class="px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 mx-1">3</a>
                        <span class="px-4 py-2 text-gray-400">...</span>
                        <a href="#" class="px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 mx-1">6</a>
                        <a href="#" class="px-3 py-2 rounded-md text-gray-700 hover:text-primary-600">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @endsection
    
@section('additional_scripts')
<!-- AOS Animation Library Script -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Initialize AOS animations
        AOS.init({
            duration: 800,
            easing: 'ease-out',
            once: true
        });
        
        // Mobile menu functionality
        const mobileMenu = document.getElementById('mobile-menu');
        const openMenuBtn = document.getElementById('open-menu');
        const closeMenuBtn = document.getElementById('close-menu');
        
        openMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        });
        
        closeMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        });
        
        // Mobile filters functionality
        const mobileFilters = document.getElementById('mobile-filters');
        const toggleFiltersBtn = document.getElementById('toggle-filters');
        const closeFiltersBtn = document.getElementById('close-filters');
        
        toggleFiltersBtn.addEventListener('click', () => {
            mobileFilters.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
            
            // Animate filter panel sliding up
            setTimeout(() => {
                const filterPanel = mobileFilters.querySelector('.mobile-filters');
                filterPanel.style.transform = 'translateY(0)';
            }, 10);
        });
        
        closeFiltersBtn.addEventListener('click', () => {
            const filterPanel = mobileFilters.querySelector('.mobile-filters');
            filterPanel.style.transform = 'translateY(100%)';
            
            // Hide the overlay after animation
            setTimeout(() => {
                mobileFilters.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }, 300);
        });
        
        // Filter options toggle active state
        const filterOptions = document.querySelectorAll('.filter-option');
        filterOptions.forEach(option => {
            option.addEventListener('click', () => {
                // If it's a checkbox, toggle the active class
                if (option.querySelector('input[type="checkbox"]')) {
                    option.classList.toggle('active');
                }
                // If it's a radio button, set active only to the clicked one
                if (option.querySelector('input[type="radio"]')) {
                    const name = option.querySelector('input').name;
                    document.querySelectorAll(`input[name="${name}"]`).forEach(radio => {
                        radio.closest('.filter-option').classList.remove('active');
                    });
                    option.classList.add('active');
                }
            });
        });
    </script>
@endsection
    

