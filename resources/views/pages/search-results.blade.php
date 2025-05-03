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
    <div  class="bg-gray-100 border-b search">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="mb-6" data-aos="fade-down">
                <h1 class="text-3xl font-bold text-gray-800">Barber Search Results</h1>
                <p class="text-gray-600 mt-2">Find the perfect barber in your area</p>
            </div>
            
            <!-- Search Form -->
            <div  class="bg-white shadow-sm rounded-lg p-4 flex flex-wrap justify-center items-center gap-3" data-aos="fade-up">
                <div class="flex-grow min-w-[200px]">
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                            <i class="fas fa-map-marker-alt"></i>
                        </span>
                        <input type="text" id="location" name="location" placeholder="City or zip code" 
                            class="filter w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                            value="">
                    </div>
                </div>
                <div class="w-full sm:w-auto">
                    <label for="service" class="block text-sm font-medium text-gray-700 mb-1">Service</label>
                    <select id="service" name="service" class="filter w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        <option value="">All Services</option>
                        <option value="Haircuts">Haircut</option>
                        <option value="Beard & Shave">Beard & Shave</option>
                        <option value="Packages">Packages</option>
                    </select>
                </div>
                <div class="w-full sm:w-auto">
                    <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                    <input type="date" id="date" name="date" 
                        class="w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 filter"
                        value=""
                        min="{{ date('Y-m-d') }}">

                </div>
                <div class="w-full sm:w-auto flex items-end">
                    <button type="button" class="filter w-full bg-primary-600 hover:bg-primary-700 text-white font-medium py-2 px-6 rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 h-[42px]">
                        <i class="fas fa-search mr-2"></i>Search
                    </button>
                </div>
            </div>
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
                    
                    
                    
                    <!-- Price Range -->
                    <div class="mb-6">
                        <h4 class="font-medium text-gray-700 mb-2">Price Range</h4>
                        <div class="space-y-2">
                            <label class="flex items-center filter-option p-2 rounded cursor-pointer active">
                                <input type="radio" name="price" value="" class="filter form-radio h-4 w-4 text-primary-600" checked>
                                <span class="ml-2">Any Price</span>
                            </label>
                            <label class="flex items-center filter-option p-2 rounded cursor-pointer">
                                <input type="radio" value="9" name="price" class="filter form-radio h-4 w-4 text-primary-600">
                                <span class="ml-2">€ (Budget)</span>
                            </label>
                            <label class="flex items-center filter-option p-2 rounded cursor-pointer">
                                <input type="radio" value="99" name="price" class="filter form-radio h-4 w-4 text-primary-600">
                                <span class="ml-2">€€ (Standard)</span>
                            </label>
                            <label class="flex items-center filter-option p-2 rounded cursor-pointer">
                                <input type="radio" value="999" name="price" class="filter form-radio h-4 w-4 text-primary-600">
                                <span class="ml-2">€€€ (Premium)</span>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Ratings -->
                    <div class="mb-6">
                        <h4 class="font-medium text-gray-700 mb-2">Rating</h4>
                        <div class="space-y-2">
                            <label class="flex items-center filter-option p-2 rounded cursor-pointer">
                                <input type="radio" value="5"  name="rating" class="filter form-radio h-4 w-4 text-primary-600">
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
                                <input type="radio" value="4" name="rating" class="filter form-radio h-4 w-4 text-primary-600">
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
                                <input type="radio" value="3" name="rating" class="filter form-radio h-4 w-4 text-primary-600" >
                                <span class="ml-2 flex items-center">
                                    <i class="fas fa-star rating-star"></i>
                                    <i class="fas fa-star rating-star"></i>
                                    <i class="fas fa-star rating-star"></i>
                                    <i class="far fa-star rating-star"></i>
                                    <i class="far fa-star rating-star"></i>
                                    <span class="ml-1">& up</span>
                                </span>
                            </label>
                            <label class="flex items-center filter-option p-2 rounded cursor-pointer">
                                <input type="radio" value="0" name="rating" checked class="filter form-radio h-4 w-4 text-primary-600">
                                <span class="ml-2 flex items-center">
                                    <i class="far fa-star rating-star"></i>
                                    <i class="far fa-star rating-star"></i>
                                    <i class="far fa-star rating-star"></i>
                                    <i class="far fa-star rating-star"></i>
                                    <i class="far fa-star rating-star"></i>
                                    <span class="ml-1">No rating</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    
                    
                    
                    <button class="filter w-full bg-primary-600 text-white py-2 px-4 rounded-md hover:bg-primary-700 transition-colors">
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
                        <!-- Price Range -->
                        <div class="mb-6">
                            <h4 class="font-medium text-gray-700 mb-2">Price Range</h4>
                            <div class="space-y-2">
                            <label class="flex items-center filter-option p-2 rounded cursor-pointer active">
                                <input type="radio" name="price" value="" class="filter form-radio h-4 w-4 text-primary-600" checked>
                                <span class="ml-2">Any Price</span>
                            </label>
                            <label class="flex items-center filter-option p-2 rounded cursor-pointer">
                                <input type="radio" value="9" name="price" class="filter form-radio h-4 w-4 text-primary-600">
                                <span class="ml-2">€ (Budget)</span>
                            </label>
                            <label class="flex items-center filter-option p-2 rounded cursor-pointer">
                                <input type="radio" value="99" name="price" class="filter form-radio h-4 w-4 text-primary-600">
                                <span class="ml-2">€€ (Standard)</span>
                            </label>
                            <label class="flex items-center filter-option p-2 rounded cursor-pointer">
                                <input type="radio" value="999" name="price" class="filter form-radio h-4 w-4 text-primary-600">
                                <span class="ml-2">€€€ (Premium)</span>
                            </label>
                            </div>
                        </div>
                        
                        <!-- Ratings -->
                        <div class="mb-6">
                            <h4 class="font-medium text-gray-700 mb-2">Rating</h4>
                            <div class="space-y-2">
                            <label class="flex items-center filter-option p-2 rounded cursor-pointer">
                                <input type="radio" value="5"  name="rating" class="filter form-radio h-4 w-4 text-primary-600">
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
                                <input type="radio" value="4" name="rating" class="filter form-radio h-4 w-4 text-primary-600">
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
                                <input type="radio" value="3" name="rating" class="filter form-radio h-4 w-4 text-primary-600">
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
                    </div>
                    <div class="p-4 border-t sticky bottom-0 bg-white">
                        <button class="filter w-full bg-primary-600 text-white py-3 px-4 rounded-md hover:bg-primary-700 transition-colors">
                            Apply Filters
                        </button>
                    </div>
                </div>
            </div>
        
            <!-- Results Grid -->
            <div class="flex-1">
                <!-- Sort Options -->
                <div class="flex justify-between items-center mb-6">
                    <p class="text-gray-600 pageData"></p>
                    <div class="relative">
                        <select id="sort" class="filter appearance-none bg-white border border-gray-300 text-gray-700 py-2 pl-4 pr-8 rounded leading-tight focus:outline-none focus:ring-2 focus:ring-primary-300">
                            <option value="">Recommended</option>
                            <option value="rating">Highest Rated</option>
                            <option value="PriceASC">Price: Low to High</option>
                            <option value="PriceDESC">Price: High to Low</option>
                            <option value="bookings">Most Popular</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Results Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-6">
                    
                </div>
                
                <!-- Pagination -->
                <div id="pagination" class="mt-12 flex justify-center" data-aos="fade-up" data-aos-delay="400">
                    
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
        let barberShops = [];
        
        let filtersSelcted = {};
        let currentPage = 1;
        let totalPages = 1;
        let totalResults = 0;
        let from = 0;
        let to = 0;
        let Pagination;

        //filter
        const filters = document.querySelectorAll('.filter');
        filters.forEach(filter => {
            filter.addEventListener('change', () => {
                const location = document.querySelector('input[name="location"]').value;
                const service = document.querySelector('select[name="service"]').value;
                const date = document.querySelector('input[name="date"]').value;
                const price = document.querySelector('input[name="price"]:checked').value;
                const rating = document.querySelector('input[name="rating"]:checked')?.value;
                const sort =document.getElementById('sort').value;
                const filtersSelcted = {
                    location: location,
                    service: service,
                    date: date,
                    price: price,
                    rating: rating,
                    sort: sort
                };
                console.log(filtersSelcted);
                getBarberShops(currentPage, filtersSelcted);
              
            });
        });




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
        
        

async function getBarberShops(page = 1, filtersSelcted = null) {
    let url = `/api/barberShops?page=${page}`;
    if (filtersSelcted) {
        url += '&location=' + filtersSelcted.location;
        url += '&service=' + filtersSelcted.service;
        url += '&date=' + filtersSelcted.date;
        url += '&price=' + filtersSelcted.price;
        url += '&rating=' + filtersSelcted.rating;
        url += '&sort=' + filtersSelcted.sort;
    }
    const response = await fetch(`${url}`);
    const data = await response.json();
    console.log(data);
    barberShops = data.data;
    currentPage = data.current_page;
    Pagination = data.links;	
    totalPages = data.last_page;
    totalResults = data.total;
    from = data.from;
    to = data.to;

    // console.log(barberShops);
    renderBarberShops(barberShops);
    renderPagination(Pagination);

    
}
getBarberShops();

function renderBarberShops(barberShops) {
    
    const resultsContainer = document.querySelector('.grid');
    if (barberShops.length === 0) {
        resultsContainer.innerHTML = '<div class="col-span-full text-center py-12"><p class="text-xl text-gray-500 font-medium">No results found.</p><p class="text-gray-400 mt-2">Try adjusting your filters or search criteria.</p></div>';
        return;
    }
    resultsContainer.innerHTML = ''; // Clear previous results

    barberShops.forEach(barberShop => {
        const card = document.createElement('div');
        card.className = 'bg-white rounded-xl shadow-sm overflow-hidden card-hover';
        card.setAttribute('data-aos', 'fade-up');
        card.setAttribute('data-aos-delay', '100');

        // Define helper functions
        function calculateAveragePrice(services) {
            if (services.length === 0) return 'N/A';
            const sum = services.reduce((total, service) => total + parseFloat(service.price), 0);
            return (sum / services.length).toFixed(2);
        }

        function generateStarRating(rating) {
            const averageRating = typeof rating === 'number' ? rating : 0;
            const fullStars = Math.floor(averageRating);
            const halfStar = averageRating - fullStars > 0.2 && averageRating - fullStars < 0.8;
            const emptyStars = 5 - fullStars - (halfStar ? 1 : 0);
            
            let starsHTML = '';
            
            for (let i = 0; i < fullStars; i++) {
                starsHTML += '<i class="fas fa-star rating-star text-sm"></i>';
            }
            
            if (halfStar) {
                starsHTML += '<i class="fas fa-star-half-alt rating-star text-sm"></i>';
            }
            
            for (let i = 0; i < emptyStars; i++) {
                starsHTML += '<i class="far fa-star rating-star text-sm"></i>';
            }
            
            return starsHTML;
        }

        card.innerHTML = `
            <a href="/barbershop-detail/${barberShop.id}" class="block">
                <div class="relative">
                    <img src="${barberShop.cover ? (barberShop.cover.startsWith('http') ? barberShop.cover : '/storage/' + barberShop.cover) : '/images/default-barbershop.jpg'}" alt="${barberShop.name}" class="w-full h-48 object-cover" onerror="this.onerror=null; this.src='/images/default-barbershop.jpg';">
                    <div class="absolute top-4 right-4 bg-white rounded-full px-3 py-1 text-sm font-medium text-primary-600 shadow price-tag">
                        ${barberShop.services.length > 0 ? calculateAveragePrice(barberShop.services) : ''}$$
                    </div>
                </div>
                <div class="p-5">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-bold text-lg text-gray-900">${barberShop.name}</h3>
                            <div class="flex items-center mt-1 mb-2">
                                <div class="flex items-center">
                                    ${generateStarRating(parseFloat(barberShop.average_rating) > 0 ? parseFloat(barberShop.average_rating) : 0)}
                                </div>
                                <span class="ml-1 text-sm text-gray-600">(${barberShop.ratings_count} reviews)</span>
                            </div>
                        </div>
                        <button class="text-gray-400 hover:text-primary-600 transition-colors">
                            <i class="far fa-heart text-xl"></i>
                        </button>
                    </div>
                    <div class="flex items-center text-gray-600 text-sm">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <span>${barberShop.address || ''}, ${barberShop.city || ''}</span>
                    </div>
                    <div class="flex items-center text-gray-600 text-sm mt-2">
                        <i class="fas fa-cut mr-2"></i>
                        <span>
                            ${barberShop.services.length > 0 
                                ? [...new Set(barberShop.services.map(service => service.type))].join(', ')
                                : 'No services available'
                            }
                        </span>
                    </div>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-primary-600 font-medium">From €${barberShop.services.length > 0 
                            ? Math.min(...barberShop.services.map(service => parseFloat(service.price)))
                            : '(No Services available)'
                        }</span>
                    </div>
                </div>
            </a>
        `;

        resultsContainer.appendChild(card);

        const pageData= document.querySelector('.pageData');
        pageData.innerHTML = `Showing ${from} - ${to} of ${totalResults} results`;

    });
}
function renderPagination(pagination) {
    const paginationContainer = document.getElementById('pagination');
    paginationContainer.innerHTML = ''; // Clear previous pagination
    pagination.forEach((link, index) => {
        const pageLink = document.createElement('a');
        pageLink.href = `#`;
        pageLink.innerHTML = link.label;
        pageLink.className = `px-4 py-2 border rounded-md ${link.active ? 'bg-primary-600 text-white' : 'text-gray-700 hover:bg-gray-200 not-allowed'}`;
        pageLink.addEventListener('click', (e) => {
            e.preventDefault();
            let page = link.url.split('page=')[1];
            getBarberShops(page);
            // Scroll to the top of the results
            window.scrollTo({
                top: document.querySelector('.search').offsetTop,
                behavior: 'smooth'
            });
        });
        paginationContainer.appendChild(pageLink);
    });
}

    </script>
@endsection
    

