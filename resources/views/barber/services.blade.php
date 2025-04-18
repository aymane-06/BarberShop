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
</style>
@endsection

@section('content')
<div class="container mx-auto">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Services Management</h1>
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
                    <input id="search-input" type="text" placeholder="Search services..." class="w-full rounded-md border border-gray-300 shadow-sm py-2 pl-10 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-500">
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
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="featured">Featured</option>
                </select>
                
                <select id="category-filter" class="filter rounded-md border border-gray-300 py-2 pl-3 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-500">
                    <option value="">Category: All</option>
                    <option value="haircuts">Haircuts</option>
                    <option value="Beard & Shave">Beard & Shave</option>
                    <option value="Packages">Packages</option>
                </select>
                
                <select id="sort-filter" class="filter rounded-md border border-gray-300 py-2 pl-3 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-500">
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
        <div class="bg-white rounded-lg shadow p-4 scale-in">
            <div class="flex items-center">
                <div class="flex-shrink-0 rounded-md bg-blue-100 p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
                <div class="ml-5">
                    <h4 class="text-lg font-medium text-gray-900" id="total-services">0</h4>
                    <p class="text-sm font-medium text-gray-500">Total Services</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4 scale-in" style="animation-delay: 0.1s">
            <div class="flex items-center">
                <div class="flex-shrink-0 rounded-md bg-green-100 p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-5">
                    <h4 class="text-lg font-medium text-gray-900" id="active-services">0</h4>
                    <p class="text-sm font-medium text-gray-500">Active Services</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4 scale-in" style="animation-delay: 0.2s">
            <div class="flex items-center">
                <div class="flex-shrink-0 rounded-md bg-yellow-100 p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                </div>
                <div class="ml-5">
                    <h4 class="text-lg font-medium text-gray-900" id="featured-services">0</h4>
                    <p class="text-sm font-medium text-gray-500">Featured Services</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4 scale-in" style="animation-delay: 0.3s">
            <div class="flex items-center">
                <div class="flex-shrink-0 rounded-md bg-purple-100 p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-5">
                    <h4 class="text-lg font-medium text-gray-900" id="avg-price">$0</h4>
                    <p class="text-sm font-medium text-gray-500">Average Price</p>
                </div>
            </div>
        </div>
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
                    <label for="service-category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select id="service-category" name="category" class="w-full rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-200 focus:ring-opacity-50" required>
                        <option value="">Select a category</option>
                        <option value="haircuts">Haircuts</option>
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
                    
                    <div class="flex items-center">
                        <input type="checkbox" id="service-featured" name="is_featured" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                        <label for="service-featured" class="ml-2 block text-sm text-gray-700">Featured</label>
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
    let pagination = { current_page: 1, total: 0, per_page: 9 };
    let filterData = {
        search: '',
        status: '',
        category: '',
        sort: 'name_asc'
    };

    document.addEventListener('DOMContentLoaded', function() {
        // Load services on page load
        getServices();
        
        // Add event listeners for filter inputs
        document.getElementById('search-input').addEventListener('input', function(e) {
            filterData.search = e.target.value;
            getServices(1);
        });
        
        document.getElementById('status-filter').addEventListener('change', function(e) {
            filterData.status = e.target.value;
            getServices(1);
        });
        
        document.getElementById('category-filter').addEventListener('change', function(e) {
            filterData.category = e.target.value;
            getServices(1);
        });
        
        document.getElementById('sort-filter').addEventListener('change', function(e) {
            filterData.sort = e.target.value;
            getServices(1);
        });
        
        // Clear filters button
        document.getElementById('clear-filters').addEventListener('click', function() {
            document.getElementById('search-input').value = '';
            document.getElementById('status-filter').value = '';
            document.getElementById('category-filter').value = '';
            document.getElementById('sort-filter').value = 'name_asc';
            
            filterData = {
                search: '',
                status: '',
                category: '',
                sort: 'name_asc'
            };
            
            getServices(1);
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
        
        // Mobile pagination buttons
        document.getElementById('prev-page-mobile').addEventListener('click', function() {
            if (pagination.current_page > 1) {
                getServices(pagination.current_page - 1);
            }
        });
        
        document.getElementById('next-page-mobile').addEventListener('click', function() {
            if (pagination.current_page < Math.ceil(pagination.total / pagination.per_page)) {
                getServices(pagination.current_page + 1);
            }
        });
    });

    async function getServices(page = 1) {
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
            // In a real app, this would be an API call
            // For this example, we'll simulate fetching data
            await new Promise(resolve => setTimeout(resolve, 1000));
            
            // Sample data for demonstration
            const mockServices = [
                {
                    id: 1,
                    name: 'Classic Haircut',
                    description: 'Traditional haircut with scissors and clippers',
                    price: 25.00,
                    duration: 30,
                    category: 'haircut',
                    is_active: true,
                    is_featured: true,
                    image: 'https://images.unsplash.com/photo-1503951914875-452162b0f3f1?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60'
                },
                {
                    id: 2,
                    name: 'Beard Trim',
                    description: 'Professional beard trimming and styling',
                    price: 15.00,
                    duration: 20,
                    category: 'beard',
                    is_active: true,
                    is_featured: false,
                    image: 'https://images.unsplash.com/photo-1503951914875-452162b0f3f1?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60'
                },
                {
                    id: 3,
                    name: 'Hot Towel Shave',
                    description: 'Relaxing hot towel shave with straight razor',
                    price: 30.00,
                    duration: 45,
                    category: 'shave',
                    is_active: true,
                    is_featured: true,
                    image: 'https://images.unsplash.com/photo-1503951914875-452162b0f3f1?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60'
                },
                {
                    id: 4,
                    name: 'Hair Coloring',
                    description: 'Professional hair coloring service',
                    price: 60.00,
                    duration: 90,
                    category: 'coloring',
                    is_active: true,
                    is_featured: false,
                    image: 'https://images.unsplash.com/photo-1503951914875-452162b0f3f1?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60'
                },
                {
                    id: 5,
                    name: 'Kids Haircut',
                    description: 'Haircut for children under 12',
                    price: 18.00,
                    duration: 20,
                    category: 'haircut',
                    is_active: true,
                    is_featured: false,
                    image: 'https://images.unsplash.com/photo-1503951914875-452162b0f3f1?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60'
                },
                {
                    id: 6,
                    name: 'Facial Treatment',
                    description: 'Refreshing facial treatment for men',
                    price: 40.00,
                    duration: 60,
                    category: 'facial',
                    is_active: false,
                    is_featured: false,
                    image: 'https://images.unsplash.com/photo-1503951914875-452162b0f3f1?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60'
                }
            ];
            
            // Filter services based on search and filters
            let filteredServices = [...mockServices];
            
            if (filterData.search) {
                const searchTerm = filterData.search.toLowerCase();
                filteredServices = filteredServices.filter(service => 
                    service.name.toLowerCase().includes(searchTerm) || 
                    service.description.toLowerCase().includes(searchTerm)
                );
            }
            
            if (filterData.status) {
                if (filterData.status === 'active') {
                    filteredServices = filteredServices.filter(service => service.is_active);
                } else if (filterData.status === 'inactive') {
                    filteredServices = filteredServices.filter(service => !service.is_active);
                } else if (filterData.status === 'featured') {
                    filteredServices = filteredServices.filter(service => service.is_featured);
                }
            }
            
            if (filterData.category) {
                filteredServices = filteredServices.filter(service => service.category === filterData.category);
            }
            
            // Sort services
            filteredServices.sort((a, b) => {
                switch (filterData.sort) {
                    case 'name_asc':
                        return a.name.localeCompare(b.name);
                    case 'name_desc':
                        return b.name.localeCompare(a.name);
                    case 'price_asc':
                        return a.price - b.price;
                    case 'price_desc':
                        return b.price - a.price;
                    case 'duration_asc':
                        return a.duration - b.duration;
                    case 'duration_desc':
                        return b.duration - a.duration;
                    default:
                        return a.name.localeCompare(b.name);
                }
            });
            
            // Pagination
            const total = filteredServices.length;
            const perPage = 6;
            const lastPage = Math.ceil(total / perPage);
            const from = (page - 1) * perPage;
            const to = Math.min(from + perPage, total);
            
            services = filteredServices.slice(from, to);
            
            pagination = {
                current_page: page,
                last_page: lastPage,
                total: total,
                per_page: perPage,
                from: from + 1,
                to: to
            };
            
            // Update statistics
            updateStatistics(mockServices);
            
            // Render services and pagination
            renderServices();
            renderPagination();
            
        } catch (error) {
            console.error('Error fetching services:', error);
            servicesContainer.innerHTML = `
            <div class="col-span-full text-center py-10">
                <p class="text-red-500">Failed to load services. Please try again later.</p>
                <button class="mt-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500" onclick="getServices()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Retry
                </button>
            </div>`;
        }
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
            if (service.is_featured) {
                statusBadge = `<span class="popular-badge absolute top-3 right-3 px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">Featured</span>`;
            }
            
            const activeStatus = service.is_active ? 
                `<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Active</span>` : 
                `<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Inactive</span>`;
            
            // Format category
            const categoryName = service.category.charAt(0).toUpperCase() + service.category.slice(1);
            
            servicesHTML += `
            <div class="service-card bg-white rounded-lg shadow-md overflow-hidden relative">
                ${statusBadge}
                <div class="relative h-48 overflow-hidden">
                    <img src="${service.image}" alt="${service.name}" class="w-full h-full object-cover transition duration-300 ease-in-out transform hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black opacity-60"></div>
                    <div class="absolute bottom-0 left-0 p-4">
                        <span class="inline-block px-2 py-1 text-xs font-semibold text-white bg-primary-600 rounded-md">${categoryName}</span>
                    </div>
                    <div class="absolute top-0 right-0 m-3">
                        <span class="price-tag inline-block px-3 py-1 text-sm font-bold rounded-lg shadow-lg">$${service.price.toFixed(2)}</span>
                    </div>
                </div>
                <div class="p-4">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-lg font-semibold text-gray-800">${service.name}</h3>
                        <div class="text-primary-600">
                            <span class="inline-flex items-center text-sm">
                                <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                            <button onclick="openServiceModal(${service.id})" class="text-primary-600 hover:text-primary-800 transition-colors">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                            <button onclick="openDeleteModal(${service.id})" class="text-red-600 hover:text-red-800 transition-colors">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                            <button onclick="toggleServiceStatus(${service.id})" class="text-gray-600 hover:text-gray-800 transition-colors">
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
            Showing <span class="font-medium">${pagination.from}</span> to <span class="font-medium">${pagination.to}</span> of <span class="font-medium">${pagination.total}</span> services
        `;
    }

    function renderPagination() {
        const paginationContainer = document.getElementById('pagination');
        paginationContainer.innerHTML = '';
        
        // Previous button
        const prevButton = document.createElement('button');
        prevButton.classList.add('relative', 'inline-flex', 'items-center', 'px-2', 'py-2', 'rounded-l-md', 'border', 'border-gray-300', 'bg-white', 'text-sm', 'font-medium', 'text-gray-500', 'hover:bg-gray-50');
        prevButton.innerHTML = `
            <span class="sr-only">Previous</span>
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
        `;
        
        if (pagination.current_page > 1) {
            prevButton.addEventListener('click', () => getServices(pagination.current_page - 1));
        } else {
            prevButton.classList.add('cursor-not-allowed');
        }
        
        paginationContainer.appendChild(prevButton);
        
        // Page numbers
        const totalPages = Math.ceil(pagination.total / pagination.per_page);
        let startPage = Math.max(1, pagination.current_page - 2);
        let endPage = Math.min(totalPages, startPage + 4);
        
        if (endPage - startPage < 4) {
            startPage = Math.max(1, endPage - 4);
        }
        
        for (let i = startPage; i <= endPage; i++) {
            const pageButton = document.createElement('button');
            pageButton.classList.add('relative', 'inline-flex', 'items-center', 'px-4', 'py-2', 'border', 'text-sm', 'font-medium');
            
            if (i === pagination.current_page) {
                pageButton.classList.add('z-10', 'bg-primary-50', 'border-primary-500', 'text-primary-600');
            } else {
                pageButton.classList.add('bg-white', 'border-gray-300', 'text-gray-700', 'hover:bg-gray-50');
                pageButton.addEventListener('click', () => getServices(i));
            }
            
            pageButton.textContent = i;
            paginationContainer.appendChild(pageButton);
        }
        
        // Next button
        const nextButton = document.createElement('button');
        nextButton.classList.add('relative', 'inline-flex', 'items-center', 'px-2', 'py-2', 'rounded-r-md', 'border', 'border-gray-300', 'bg-white', 'text-sm', 'font-medium', 'text-gray-500', 'hover:bg-gray-50');
        nextButton.innerHTML = `
            <span class="sr-only">Next</span>
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
        `;
        
        if (pagination.current_page < totalPages) {
            nextButton.addEventListener('click', () => getServices(pagination.current_page + 1));
        } else {
            nextButton.classList.add('cursor-not-allowed');
        }
        
        paginationContainer.appendChild(nextButton);
    }

    function updateStatistics(allServices) {
        const totalServices = allServices.length;
        const activeServices = allServices.filter(s => s.is_active).length;
        const featuredServices = allServices.filter(s => s.is_featured).length;
        const avgPrice = allServices.reduce((sum, service) => sum + service.price, 0) / totalServices;
        
        document.getElementById('total-services').textContent = totalServices;
        document.getElementById('active-services').textContent = activeServices;
        document.getElementById('featured-services').textContent = featuredServices;
        document.getElementById('avg-price').textContent = '$' + avgPrice.toFixed(2);
    }

    function openServiceModal(serviceId = null) {
        const modal = document.getElementById('serviceModal');
        const modalTitle = document.getElementById('modal-title');
        const form = document.getElementById('serviceForm');
        
        if (serviceId) {
            // Edit existing service
            const service = services.find(s => s.id === serviceId) || 
                            { name: '', description: '', price: 0, duration: 30, category: '', is_active: true, is_featured: false };
            
            document.getElementById('service-id').value = serviceId;
            document.getElementById('service-name').value = service.name;
            document.getElementById('service-description').value = service.description;
            document.getElementById('service-price').value = service.price;
            document.getElementById('service-duration').value = service.duration;
            document.getElementById('service-category').value = service.category;
            document.getElementById('service-active').checked = service.is_active;
            document.getElementById('service-featured').checked = service.is_featured;
            
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
            document.getElementById('delete-service-details').textContent = `$${service.price.toFixed(2)} • ${service.duration} minutes • ${service.category.charAt(0).toUpperCase() + service.category.slice(1)}`;
            
            document.getElementById('confirm-delete').setAttribute('data-service-id', serviceId);
            
            modal.classList.remove('hidden');
        }
    }

    function resetServiceForm() {
        const form = document.getElementById('serviceForm');
        form.reset();
        document.getElementById('service-id').value = '';
        document.getElementById('service-active').checked = true;
        document.getElementById('service-featured').checked = false;
    }

    function saveService() {
        const serviceId = document.getElementById('service-id').value;
        const isNewService = !serviceId;
        
        const serviceData = {
            id: isNewService ? Date.now() : parseInt(serviceId), // Generate a temporary ID for new services
            name: document.getElementById('service-name').value,
            description: document.getElementById('service-description').value,
            price: parseFloat(document.getElementById('service-price').value),
            duration: parseInt(document.getElementById('service-duration').value),
            category: document.getElementById('service-category').value,
            is_active: document.getElementById('service-active').checked,
            is_featured: document.getElementById('service-featured').checked,
            image: 'https://images.unsplash.com/photo-1503951914875-452162b0f3f1?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' // Default image for now
        };
        
        // In a real app, this would be an API call to save the service
        // For this example, we'll just update our local array
        console.log('Saving service:', serviceData);
        
        // Add success notification
        alert(isNewService ? 'Service created successfully!' : 'Service updated successfully!');
        
        // Close modal and refresh services
        document.getElementById('serviceModal').classList.add('hidden');
        getServices(pagination.current_page);
    }

    function deleteService(serviceId) {
        // In a real app, this would be an API call to delete the service
        console.log('Deleting service:', serviceId);
        
        // Add success notification
        alert('Service deleted successfully!');
        
        // Close modal and refresh services
        document.getElementById('deleteServiceModal').classList.add('hidden');
        getServices(pagination.current_page);
    }

    function toggleServiceStatus(serviceId) {
        // In a real app, this would be an API call to toggle the service status
        console.log('Toggling service status:', serviceId);
        
        // Add success notification
        alert('Service status updated!');
        
        // Refresh services
        getServices(pagination.current_page);
    }
</script>
@endsection