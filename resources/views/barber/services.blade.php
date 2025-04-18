@extends('layouts.barber')

@section('additional_styles')
<style>
    .service-loader {
        display: flex;
        align-items: center;
        justify-content: center;
        perspective: 800px;
    }
    
    .barber-pole-loader {
        display: flex;
        align-items: center;
        justify-content: center;
        perspective: 800px;
    }
    
    .barber-pole {
        position: relative;
        width: 50px;
        height: 120px;
        background-color: white;
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        border: 3px solid #e5e7eb;
        transform: rotateX(10deg);
    }
    
    .pole-stripe {
        position: absolute;
        top: -100%;
        left: 0;
        width: 200%;
        height: 300%;
        background: repeating-linear-gradient(
            45deg,
            #d20a0a 0px,
            #d20a0a 12px,
            #ffffff 12px,
            #ffffff 24px,
            #1a56db 24px,
            #1a56db 36px,
            #ffffff 36px,
            #ffffff 48px
        );
        animation: spin-pole 1.2s linear infinite;
    }
    
    @keyframes spin-pole {
        0% { transform: translateY(0); }
        100% { transform: translateY(48px); }
    }
    
    .loading-dots span {
        display: inline-block;
        width: 8px;
        height: 8px;
        margin: 0 3px;
        background-color: #6b7280;
        border-radius: 50%;
        animation: dot-pulse 1.5s infinite ease-in-out;
    }
    
    .loading-dots span:nth-child(2) {
        animation-delay: 0.2s;
    }
    
    .loading-dots span:nth-child(3) {
        animation-delay: 0.4s;
    }
    
    @keyframes dot-pulse {
        0%, 100% { transform: scale(0.8); opacity: 0.5; }
        50% { transform: scale(1.2); opacity: 1; }
    }
    
    #service-loader {
        animation: fade-in 0.5s ease-out;
    }
    
    @keyframes fade-in {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .status-badge {
        transition: all 0.3s ease;
    }
    .service-card {
        transition: all 0.3s ease;
    }
    .service-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    .service-card:hover .quick-actions {
        opacity: 1;
    }
    .quick-actions {
        opacity: 0;
        transition: all 0.3s ease;
    }
    .price-tag {
        background: linear-gradient(45deg, #0ea5e9, #0284c7);
        color: white;
        transform: rotate(-2deg);
    }
    .popular-badge {
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(79, 70, 229, 0.4);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(79, 70, 229, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(79, 70, 229, 0);
        }
    }
    @keyframes fadeInUp {
                        from {
                            opacity: 0;
                            transform: translateY(20px);
                        }
                        to {
                            opacity: 1;
                            transform: translateY(0);
                        }
                    }
                    .animate-fade-in-up {
                        animation: fadeInUp 0.5s ease-out forwards;
                        opacity: 0;
                    }
</style>
@endsection

@section('content')
<div class="container mx-auto">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Services Management </h1>
            <p class="mt-1 text-sm text-gray-600">Add, edit and manage your barbershop services</p>
        </div>
        <div class="mt-4 md:mt-0 flex space-x-3">
            <button id="addServiceBtn" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add New Service
            </button>
            <button id="openFilterBtn" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                </svg>
                Filter
            </button>
        </div>
    </div>

    <!-- Filter and Search Section -->
    <div class="bg-white rounded-lg shadow mb-6 p-4">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <div class="relative">
                    <input id="search-input" type="text" placeholder="Search services..." class="filter w-full rounded-md border border-gray-300 shadow-sm py-2 pl-10 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-500">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 w-full md:w-auto">
                <select id="status-filter" class="filter rounded-md border border-gray-300 py-2 pl-3 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-500">
                    <option value="">Status: All</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
                
                <select id="type-filter" class="filter rounded-md border border-gray-300 py-2 pl-3 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-500">
                    <option value="">type: All</option>
                    <option value="Haircuts">Haircuts</option>
                    <option value="Beard & Shave">Beard & Shave</option>
                    <option value="Packages">Packages</option>
                </select>
                
                <select id="sort-filter" class="filter rounded-md border border-gray-300 py-2 pl-3 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-500">
                    <option value="DESC" selected>Last Created</option>
                    <option value="name_asc">Name (A-Z)</option>
                    <option value="name_desc">Name (Z-A)</option>
                    <option value="price_asc">Price (Low-High)</option>
                    <option value="price_desc">Price (High-Low)</option>
                    <option value="duration_asc">Duration (Short-Long)</option>
                    <option value="duration_desc">Duration (Long-Short)</option>
                </select>
            </div>
        </div>
        <div class="flex justify-end mt-3">
            <button type="button" id="clear-filters" class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Clear Filters
            </button>
        </div>
        
        <div id="active-filters" class="mt-3 flex flex-wrap gap-2">
            <!-- Active filters will be dynamically added here -->
        </div>
    </div>
    
    <!-- Stats Overview -->
    <div id="statistics" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        
    </div>

    <!-- Services Grid -->
    <div id="services-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <!-- Services will be populated here -->
        <div id="service-loader" class="col-span-full flex flex-col justify-center items-center py-20">
            <div class="flex flex-col items-center">
                <div class="barber-pole-loader mb-4">
                    <div class="barber-pole">
                        <div class="pole-stripe"></div>
                    </div>
                </div>
                <div class="text-center">
                    <p class="text-gray-700 font-medium mb-2">Loading services...</p>
                    <div class="loading-dots">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Pagination -->
    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 rounded-lg shadow mb-6">
        <div class="flex-1 flex justify-between sm:hidden">
            <button id="prev-page-mobile" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Previous
            </button>
            <button id="next-page-mobile" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Next
            </button>
        </div>
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p id="pagination-info" class="text-sm text-gray-700">
                    Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">20</span> services
                </p>
            </div>
            <div>
                <nav id="pagination" class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                    <!-- Pagination buttons will be dynamically added here -->
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Add/Edit Service Modal -->
<div id="serviceModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 overflow-hidden">
        <div class="bg-primary-50 px-4 py-3 border-b border-primary-100">
            <div class="flex items-center justify-between">
                <h3 id="modal-title" class="text-lg font-medium text-primary-800">Add New Service</h3>
                <button type="button" class="close-modal text-primary-400 hover:text-primary-600">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        
        <form id="serviceForm">
            <input type="hidden" id="service-id">
            <div class="p-4">
                <div class="mb-4">
                    <label for="service-name" class="block text-sm font-medium text-gray-700 mb-1">Service Name</label>
                    <input type="text" id="service-name" name="name" class="w-full rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-200 focus:ring-opacity-50" placeholder="Enter service name..." required>
                </div>
                
                <div class="mb-4">
                    <label for="service-description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea id="service-description" name="description" rows="3" class="w-full rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-200 focus:ring-opacity-50" placeholder="Enter service description..."></textarea>
                </div>
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="service-price" class="block text-sm font-medium text-gray-700 mb-1">Price ($)</label>
                        <input type="number" id="service-price" name="price" step="0.01" min="0" class="w-full rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-200 focus:ring-opacity-50" placeholder="0.00" required>
                    </div>
                    
                    <div>
                        <label for="service-duration" class="block text-sm font-medium text-gray-700 mb-1">Duration (minutes)</label>
                        <input type="number" id="service-duration" name="duration" min="5" step="5" class="w-full rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-200 focus:ring-opacity-50" placeholder="30" required>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="service-type" class="block text-sm font-medium text-gray-700 mb-1">type</label>
                    <select id="service-type" name="type" class="w-full rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-200 focus:ring-opacity-50" required>
                        <option value="">Select a type</option>
                        <option value="Haircuts">Haircuts</option>
                        <option value="Beard & Shave">Beard & Shave</option>
                        <option value="Packages">Packages</option>
                    </select>
                </div>
                
                <div class="mb-4">
                    <label for="service-image" class="block text-sm font-medium text-gray-700 mb-1">Service Image (Optional)</label>
                    <input type="file" id="service-image" name="image" accept="image/*" class="w-full rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                </div>
                
                <div class="flex items-center space-x-4 mb-4">
                    <div class="flex items-center">
                        <input type="checkbox" id="service-active" name="is_active" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                        <label for="service-active" class="ml-2 block text-sm text-gray-700">Active</label>
                    </div>
                    
                    
                </div>
            </div>
            
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 border-t">
                <button type="button" class="close-modal inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mr-2">
                    Cancel
                </button>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    Save Service
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Service Modal -->
<div id="deleteServiceModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 overflow-hidden">
        <div class="bg-red-50 px-4 py-3 border-b border-red-100">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-red-800">Delete Service</h3>
                <button type="button" class="close-delete-modal text-red-400 hover:text-red-600">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        
        <div class="p-4">
            <div class="flex items-center mb-4">
                <div class="flex-shrink-0 bg-red-100 rounded-full p-2">
                    <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <p class="ml-3 text-sm text-gray-700">Are you sure you want to delete this service? This action cannot be undone.</p>
            </div>
            
            <div class="bg-gray-50 p-3 rounded-lg mb-4">
                <h4 id="delete-service-name" class="font-medium text-gray-900"></h4>
                <p id="delete-service-details" class="text-sm text-gray-500"></p>
            </div>
        </div>
        
        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 border-t">
            <button type="button" class="close-delete-modal inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mr-2">
                Cancel
            </button>
            <button type="button" id="confirm-delete" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                Delete Service
            </button>
        </div>
    </div>
</div>
@endsection

@section('additional_scripts')
<script>
    let services = [];
    let pagination ;
    let filterData = {
        search: '',
        status: '',
        type: '',
        sort: 'DESC'
    };
    let pagesData={};

    let current_page=1;
    document.addEventListener('DOMContentLoaded', function() {
        // Load services on page load
        getServices();
        
        // Add event listeners for filter inputs
        let filterInputs = document.querySelectorAll('.filter');
        filterInputs.forEach(input => {
            input.addEventListener('change', function() {
                let searchValue = document.getElementById('search-input').value;
                let statusValue = document.getElementById('status-filter').value;
                let typeValue = document.getElementById('type-filter').value;
                let sortValue = document.getElementById('sort-filter').value;

                filterData = {
                    search: searchValue,
                    status: statusValue,
                    type: typeValue,
                    sort: sortValue
                };
                getServices(current_page, filterData);
            });
        });
        
        // Clear filters button
        document.getElementById('clear-filters').addEventListener('click', function() {
            document.getElementById('search-input').value = '';
            document.getElementById('status-filter').value = '';
            document.getElementById('type-filter').value = '';
            document.getElementById('sort-filter').value = 'DESC';
            
            filterData = {
                search: '',
                status: '',
                type: '',
                sort: 'name_asc'
            };
            
            getServices(current_page);
        });
        
        // Add new service button
        document.getElementById('addServiceBtn').addEventListener('click', function() {
            openServiceModal();
        });
        
        // Service form submission
        document.getElementById('serviceForm').addEventListener('submit', function(e) {
            e.preventDefault();
            saveService();
        });
        
        // Close modals
        document.querySelectorAll('.close-modal').forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('serviceModal').classList.add('hidden');
                resetServiceForm();
            });
        });
        
        document.querySelectorAll('.close-delete-modal').forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('deleteServiceModal').classList.add('hidden');
            });
        });
        
        // Confirm delete button
        document.getElementById('confirm-delete').addEventListener('click', function() {
            const serviceId = this.getAttribute('data-service-id');
            deleteService(serviceId);
        });
        
    });
    getStatistics();

    async function getServices(page = 1, filterData = {sort: 'DESC'} ) {
        // Show loader animation
        const servicesContainer = document.getElementById('services-container');
        servicesContainer.innerHTML = `
        <div id="service-loader" class="col-span-full flex flex-col justify-center items-center py-20">
            <div class="flex flex-col items-center">
                <div class="barber-pole-loader mb-4">
                    <div class="barber-pole">
                        <div class="pole-stripe"></div>
                    </div>
                </div>
                <div class="text-center">
                    <p class="text-gray-700 font-medium mb-2">Loading services...</p>
                    <div class="loading-dots">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>`;
        
        try {
            let formData = new FormData();
            formData.append('shopId', @json(auth()->user()->barberShop->id));

            
            let url = `/api/barberShop/services?page=${page}`;
            console.log(filterData);
            
            if (filterData.search) {
                url += `&search=${encodeURIComponent(filterData.search)}`;
            }
            if (filterData.status) {
                url += `&status=${encodeURIComponent(filterData.status)}`;
            }
            if (filterData.type) {
                url += `&type=${encodeURIComponent(filterData.type)}`;
            }
            if (filterData.sort) {
                url += `&sort=${encodeURIComponent(filterData.sort)}`;
            }

            const response = await fetch(url, {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                method: 'POST',
                body: formData
            });
            
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            
            const data = await response.json();
            console.log(data);
            
            
            services = data.data;
            pagination = data.links;
            current_page = data.current_page;
            pagesData = {
                total: data.total,
                per_page: data.per_page,
                from: data.from,
                to: data.to,
                last_page: data.last_page
            };
            
            renderServices();
            renderPagination();
        } catch (error) {
            console.error('Error fetching services:', error);
            servicesContainer.innerHTML = `
            <div class="col-span-full text-center py-10">
                <p class="text-red-500">Failed to load services. Please try again later.</p>
                <button class="mt-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500" onclick="getServices(${current_page})">
                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Retry
                </button>
            </div>`;
        }
    }

    async function getStatistics() {
        await fetch('/api/barberShop/services/statistics', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ shopId: {{auth()->user()->barberShop->id}} })
        })
        .then(res => res.json())
        .then(data => {
            console.log(data);
            let statisticsContainer = document.getElementById('statistics');
            statisticsContainer.innerHTML = `
                <div class="bg-white rounded-lg shadow p-4 transition transform hover:-translate-y-1 hover:shadow-lg animate-fade-in-up" style="animation-delay: 0ms">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 rounded-md bg-blue-100 p-3 transition-all duration-300 ease-in-out hover:bg-blue-200 hover:rotate-12">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <h4 class="text-lg font-medium text-gray-900 animate-count-up" data-count="${data.total_services}">${data.total_services}</h4>
                            <p class="text-sm font-medium text-gray-500">Total Services</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-4 transition transform hover:-translate-y-1 hover:shadow-lg animate-fade-in-up" style="animation-delay: 100ms">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 rounded-md bg-green-100 p-3 transition-all duration-300 ease-in-out hover:bg-green-200 hover:scale-110">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <h4 class="text-lg font-medium text-gray-900 animate-count-up" data-count="${data.active_services}">${data.active_services}</h4>
                            <p class="text-sm font-medium text-gray-500">Active Services</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-4 transition transform hover:-translate-y-1 hover:shadow-lg animate-fade-in-up" style="animation-delay: 200ms">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 rounded-md bg-red-100 p-3 transition-all duration-300 ease-in-out hover:bg-red-200 hover:rotate-[-12deg]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <h4 class="text-lg font-medium text-gray-900 animate-count-up" data-count="${data.inactive_services}">${data.inactive_services}</h4>
                            <p class="text-sm font-medium text-gray-500">Inactive Services</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-4 transition transform hover:-translate-y-1 hover:shadow-lg animate-fade-in-up" style="animation-delay: 300ms">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 rounded-md bg-yellow-100 p-3 transition-all duration-300 ease-in-out hover:bg-yellow-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <h4 class="text-lg font-medium text-gray-900 animate-count-up" data-count="${data.avg_price}">
                                $${parseFloat(data.avg_price).toFixed(2)}
                            </h4>
                            <p class="text-sm font-medium text-gray-500">Average Price</p>
                        </div>
                    </div>
                </div>`;
                
            
        })
        .catch(err => {
            console.log('Error fetching statistics:', err);
        });
    }

    function renderServices() {
        const servicesContainer = document.getElementById('services-container');
        
        if (services.length === 0) {
            servicesContainer.innerHTML = `
            <div class="col-span-full text-center py-10">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No services found</h3>
                <p class="mt-1 text-sm text-gray-500">Get started by adding a new service.</p>
                <div class="mt-6">
                    <button onclick="openServiceModal()" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add New Service
                    </button>
                </div>
            </div>`;
            return;
        }
        
        let servicesHTML = '';
        
        services.forEach(service => {
            // Create status badge
            let statusBadge = '';
            
            const activeStatus = service.is_active ? 
                `<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Active</span>` : 
                `<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Inactive</span>`;
            
            // Format type
            const typeName = service.type.charAt(0).toUpperCase() + service.type.slice(1);
            
            servicesHTML += `
            <div class="service-card bg-white rounded-lg shadow-md overflow-hidden relative animate-fade-in-up" style="animation-delay: ${services.indexOf(service) * 100}ms">
                ${statusBadge}
                <div class="relative h-48 overflow-hidden">
                    <img src="/storage/${service.image}" alt="${service.name}" class="w-full h-full object-cover transition duration-300 ease-in-out transform hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black opacity-60"></div>
                    <div class="absolute bottom-0 left-0 p-4">
                        <span class="inline-block px-2 py-1 text-xs font-semibold text-white bg-primary-600 rounded-md animate-pulse">${typeName}</span>
                    </div>
                    <div class="absolute top-0 right-0 m-3">
                        <span class="price-tag inline-block px-3 py-1 text-sm font-bold rounded-lg shadow-lg animate-bounce-gentle">$${service.price}</span>
                    </div>
                </div>
                <div class="p-4">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-lg font-semibold text-gray-800 hover:text-primary-600 transition-colors">${service.name}</h3>
                        <div class="text-primary-600">
                            <span class="inline-flex items-center text-sm">
                                <svg class="h-5 w-5 mr-1 animate-spin-slow" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                ${service.duration} min
                            </span>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 mb-3 line-clamp-2">${service.description}</p>
                    <div class="flex items-center justify-between">
                        ${activeStatus}
                        <div class="quick-actions flex space-x-2">
                            <button onclick="openServiceModal(${service.id})" class="text-primary-600 hover:text-primary-800 transition-colors transform hover:scale-110">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                            <button onclick="openDeleteModal(${service.id})" class="text-red-600 hover:text-red-800 transition-colors transform hover:scale-110">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                            <button onclick="toggleServiceStatus(${service.id},${!service.is_active})" class="text-gray-600 hover:text-gray-800 transition-colors transform hover:scale-110">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    ${service.is_active ? 
                                        `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />` : 
                                        `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />`
                                    }
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>`;
        });
        
        servicesContainer.innerHTML = servicesHTML;
        
        // Update pagination info
        document.getElementById('pagination-info').innerHTML = `
            Showing <span class="font-medium">${pagesData.from}</span> to <span class="font-medium">${pagesData.to}</span> of <span class="font-medium">${pagesData.total}</span> services
        `;
    }

    function renderPagination() {
        console.log(pagination);
        
        document.getElementById('pagination').innerHTML = ''; // Clear existing pagination
        pagination.forEach(element => {
            let pageButton = document.createElement('button');
            pageButton.className = 'relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500';
            pageButton.innerHTML = element.label;

            if(element.active) {
                pageButton.classList.add('bg-primary-600', 'text-white', 'hover:bg-primary-700', 'focus:ring-primary-500');
            } else if (element.url) {
                pageButton.classList.add('text-gray-700', 'hover:bg-gray-50');
            } else {
                pageButton.classList.add('text-gray-300', 'cursor-not-allowed');
            }
            
            if (element.url) {
                // Extract the page number from the URL
                const pageNum = element.url.split('page=')[1];
                // Use closure to preserve the page number
                pageButton.onclick = function() {
                    getServices(pageNum);
                };
            }
            
            document.getElementById('pagination').appendChild(pageButton);
        });
    }

   
    function openServiceModal(serviceId = null) {
        const modal = document.getElementById('serviceModal');
        const modalTitle = document.getElementById('modal-title');
        const form = document.getElementById('serviceForm');
        
        if (serviceId) {
            // Edit existing service
            const service = services.find(s => s.id === serviceId) || 
                            { name: '', description: '', price: 0, duration: 30, type: '', is_active: true, is_featured: false };
            
            document.getElementById('service-id').value = serviceId;
            document.getElementById('service-name').value = service.name;
            document.getElementById('service-description').value = service.description;
            document.getElementById('service-price').value = service.price;
            document.getElementById('service-duration').value = service.duration;
            document.getElementById('service-type').value = service.type;
            document.getElementById('service-active').checked = service.is_active;
            
            modalTitle.textContent = 'Edit Service';
        } else {
            // Add new service
            resetServiceForm();
            modalTitle.textContent = 'Add New Service';
        }
        
        modal.classList.remove('hidden');
    }

    function openDeleteModal(serviceId) {
        const modal = document.getElementById('deleteServiceModal');
        const service = services.find(s => s.id === serviceId);
        
        if (service) {
            document.getElementById('delete-service-name').textContent = service.name;
            document.getElementById('delete-service-details').textContent = `$${service.price} • ${service.duration} minutes • ${service.type}`;
            
            document.getElementById('confirm-delete').setAttribute('data-service-id', serviceId);
            
            modal.classList.remove('hidden');
        }
    }

    function resetServiceForm() {
        const form = document.getElementById('serviceForm');
        form.reset();
        document.getElementById('service-id').value = '';
        document.getElementById('service-active').checked = true;
    }

    async function saveService() {
    const serviceId = document.getElementById('service-id').value;
    const isNewService = !serviceId;

    const formData = new FormData();
    formData.append('shopId', '{{ auth()->user()->barberShop->id }}');
    formData.append('name', document.getElementById('service-name').value);
    formData.append('description', document.getElementById('service-description').value);
    formData.append('price', document.getElementById('service-price').value);
    formData.append('duration', document.getElementById('service-duration').value);
    formData.append('type', document.getElementById('service-type').value);
    formData.append('is_active', document.getElementById('service-active').checked ? 1 : 0);
    
    const imageFile = document.getElementById('service-image').files?.[0];
    if (imageFile) {
        formData.append('image', imageFile);
    }

    if (!isNewService) {
        formData.append('id', serviceId);
    }
    console.log(formData);
    
    await fetch(isNewService ? '/api/barberShop/services/add' : `/api/barberShop/services/update/${serviceId}`, {
        method: 'POST', // Still use POST; Laravel handles PUT via _method if needed
        body: formData,
        headers: {
            // Do NOT set 'Content-Type' manually when using FormData
        }
    })
    .then(res => res.json())
    .then(data => {
        console.log(data);
        alert(isNewService ? 'Service created successfully!' : 'Service updated successfully!');
        document.getElementById('serviceModal').classList.add('hidden');
        getServices(current_page);
        resetServiceForm();
        getStatistics();

    })
    .catch(err => {
        console.log('Error saving service:', err);
    });
}


   async function deleteService(serviceId) {
    
        await fetch(`/api/barberShop/services/delete/${serviceId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ shopId: '{{ auth()->user()->barberShop->id }}' })
        })
        .then(res => res.json())
        .then(data => {
            // console.log(data);
            
                // Service deleted successfully
                getServices(current_page);
            
                getStatistics();

                
            })
            .catch(err => {
                alert('Failed to delete service. Please try again.');
                console.log('Error deleting service:', err);
            });
            // Add success notification
        alert('Service deleted successfully!');
        
        // Close modal and refresh services
        document.getElementById('deleteServiceModal').classList.add('hidden');
    }

    async function toggleServiceStatus(serviceId, status) {
        console.log('Service ID:', serviceId, 'Status:', status);
        
        await fetch(`/api/barberShop/services/toggle/${serviceId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ is_active: status, shopId: '{{ auth()->user()->barberShop->id }}' })
        })
        .then(res => res.json())
        .then(data => {
            // console.log(data);
            
                // Service status updated successfully
                getServices(current_page);
            
                getStatistics();

                
            })
            .catch(err => {
                alert('Failed to update service status. Please try again.');
                console.log('Error updating service status:', err);
            });
        
        console.log('Toggling service status:', serviceId);
        
        // Add success notification
        alert('Service status updated!');
        
       
    }
</script>
@endsection