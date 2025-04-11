@extends('layouts.admin')

@section('additional_styles')
<style>
    .status-badge {
        transition: all 0.3s ease;
    }
    .barbershop-card:hover .quick-actions {
        opacity: 1;
    }
    .quick-actions {
        opacity: 0;
        transition: all 0.3s ease;
    }
    .rating-stars .filled {
        color: #FFD700;
    }
    .rating-stars .empty {
        color: #E5E7EB;
    }
    .featured-badge {
        animation: pulse-gold 2s infinite;
    }
    @keyframes pulse-gold {
        0% {
            box-shadow: 0 0 0 0 rgba(251, 191, 36, 0.4);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(251, 191, 36, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(251, 191, 36, 0);
        }
    }
</style>
@endsection

@section('content')
<div class="container mx-auto">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Manage Barbershops</h1>
            <p class="mt-1 text-sm text-gray-600">Review, approve and manage all barbershops in the platform</p>
        </div>
        <div class="mt-4 md:mt-0 flex space-x-3">
            <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add New Barbershop
            </a>
            <button class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
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
                    <input type="text" class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-500" placeholder="Search barbershops...">
                    <div class="absolute left-3 top-2.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap gap-2">
                <select class="rounded-md border border-gray-300 py-2 pl-3 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-500">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>
                
                <select class="rounded-md border border-gray-300 py-2 pl-3 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-500">
                    <option value="">All Ratings</option>
                    <option value="5">5 stars</option>
                    <option value="4">4+ stars</option>
                    <option value="3">3+ stars</option>
                </select>
                
                <select class="rounded-md border border-gray-300 py-2 pl-3 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-500">
                    <option value="">Sort By</option>
                    <option value="newest">Newest First</option>
                    <option value="oldest">Oldest First</option>
                    <option value="rating">Highest Rating</option>
                    <option value="bookings">Most Bookings</option>
                </select>
            </div>
        </div>
        
        <div class="mt-3 flex flex-wrap gap-2">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                Active filters:
            </span>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                Pending
                <button type="button" class="ml-1 inline-flex text-gray-400 hover:text-gray-600">
                    <span class="sr-only">Remove filter</span>
                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </span>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                4+ stars
                <button type="button" class="ml-1 inline-flex text-gray-400 hover:text-gray-600">
                    <span class="sr-only">Remove filter</span>
                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </span>
            <button type="button" class="text-xs text-primary-600 hover:text-primary-800">
                Clear all filters
            </button>
        </div>
    </div>
    
    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow p-4 scale-in">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-sm font-medium text-gray-600">Total Barbershops</h2>
                    <p class="text-xl font-semibold">187</p>
                    <p class="text-xs text-green-600 mt-1">↑ 12% from last month</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4 scale-in" style="animation-delay: 0.1s">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-yellow-100 rounded-md p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-sm font-medium text-gray-600">Pending Verification</h2>
                    <p class="text-xl font-semibold">14</p>
                    <p class="text-xs text-red-600 mt-1">↑ 8 new in last 24h</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4 scale-in" style="animation-delay: 0.2s">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-sm font-medium text-gray-600">Verified Shops</h2>
                    <p class="text-xl font-semibold">156</p>
                    <p class="text-xs text-green-600 mt-1">83% of total</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4 scale-in" style="animation-delay: 0.3s">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-red-100 rounded-md p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-sm font-medium text-gray-600">Rejected</h2>
                    <p class="text-xl font-semibold">17</p>
                    <p class="text-xs text-gray-500 mt-1">9% of total</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Barbershops Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <!-- Pending Verification Shop -->
        <div class="bg-white rounded-lg shadow overflow-hidden barbershop-card">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1521490711676-14a7cdad7564" alt="Barbershop" class="h-48 w-full object-cover">
                <div class="absolute top-2 right-2">
                    <span class="status-badge px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        Pending Verification
                    </span>
                </div>
                <div class="absolute top-2 left-2">
                    <span class="px-2 py-1 rounded-md text-xs font-medium bg-gray-900 bg-opacity-70 text-white">
                        Submitted 2 days ago
                    </span>
                </div>
            </div>
            <div class="p-4">
                <div class="flex justify-between items-start">
                    <h3 class="text-lg font-bold text-gray-900">CutMaster Barbershop</h3>
                    <div class="rating-stars flex">
                        <span class="filled">★</span>
                        <span class="filled">★</span>
                        <span class="filled">★</span>
                        <span class="filled">★</span>
                        <span class="empty">★</span>
                        <span class="ml-1 text-xs text-gray-600">(0)</span>
                    </div>
                </div>
                <p class="text-gray-600 text-sm mt-1">123 Main St, New York, NY 10001</p>
                <div class="mt-4">
                    <div class="flex items-center text-sm text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Mon-Sat: 9:00 AM - 8:00 PM
                    </div>
                    <div class="flex items-center text-sm text-gray-500 mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        (555) 123-4567
                    </div>
                </div>
                <div class="mt-4 flex justify-between">
                    <div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mr-1">
                            Haircuts
                        </span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                            Shaves
                        </span>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-600">Owner: John Doe</span>
                    </div>
                </div>
                <div class="mt-4 border-t pt-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-sm font-medium text-gray-600">ID Verification: </span>
                            <span class="px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">Pending</span>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-600">Business License: </span>
                            <span class="px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">Submitted</span>
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex justify-between space-x-2">
                    <button class="flex-1 inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Approve
                    </button>
                    <button class="flex-1 inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Reject
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Verified Shop -->
        <div class="bg-white rounded-lg shadow overflow-hidden barbershop-card">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1585747860715-2ba37e788b70" alt="Barbershop" class="h-48 w-full object-cover">
                <div class="absolute top-2 right-2">
                    <span class="status-badge px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        Verified
                    </span>
                </div>
                <div class="absolute top-2 left-2 featured-badge">
                    <span class="px-2 py-1 rounded-md text-xs font-medium bg-amber-500 text-white">
                        FEATURED
                    </span>
                </div>
            </div>
            <div class="p-4">
                <div class="flex justify-between items-start">
                    <h3 class="text-lg font-bold text-gray-900">Classic Men's Salon</h3>
                    <div class="rating-stars flex">
                        <span class="filled">★</span>
                        <span class="filled">★</span>
                        <span class="filled">★</span>
                        <span class="filled">★</span>
                        <span class="filled">★</span>
                        <span class="ml-1 text-xs text-gray-600">(78)</span>
                    </div>
                </div>
                <p class="text-gray-600 text-sm mt-1">456 Broadway, New York, NY 10012</p>
                <div class="mt-4">
                    <div class="flex items-center text-sm text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Open today: 10:00 AM - 9:00 PM
                    </div>
                    <div class="flex items-center text-sm text-gray-500 mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z" />
                        </svg>
                        143 bookings this month
                    </div>
                </div>
                <div class="mt-4 flex justify-between">
                    <div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mr-1">
                            Premium
                        </span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-pink-100 text-pink-800 mr-1">
                            Hot Towels
                        </span>
                    </div>
                </div>
                
                <div class="mt-4 border-t pt-4 flex justify-between">
                    <div class="text-sm">
                        <span class="font-medium">Revenue:</span>
                        <span class="text-green-600 font-medium">$12,450 last month</span>
                    </div>
                    <div>
                        <span class="inline-flex items-center text-xs font-medium text-green-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                            32% from last month
                        </span>
                    </div>
                </div>
                
                <div class="mt-4 flex space-x-2 quick-actions">
                    <button class="flex-1 inline-flex justify-center items-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        View Details
                    </button>
                    <button class="inline-flex justify-center items-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Rejected Shop -->
        <div class="bg-white rounded-lg shadow overflow-hidden barbershop-card">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1622288432450-277d0fef5ed6" alt="Barbershop" class="h-48 w-full object-cover">
                <div class="absolute top-2 right-2">
                    <span class="status-badge px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        Rejected
                    </span>
                </div>
            </div>
            <div class="p-4">
                <div class="flex justify-between items-start">
                    <h3 class="text-lg font-bold text-gray-900">City Barbers</h3>
                    <div class="rating-stars flex">
                        <span class="empty">★</span>
                        <span class="empty">★</span>
                        <span class="empty">★</span>
                        <span class="empty">★</span>
                        <span class="empty">★</span>
                        <span class="ml-1 text-xs text-gray-600">(0)</span>
                    </div>
                </div>
                <p class="text-gray-600 text-sm mt-1">789 Park Ave, New York, NY 10021</p>
                
                <div class="mt-4 bg-red-50 border border-red-200 rounded-md p-3">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Rejection reason:</h3>
                            <p class="text-sm text-red-700 mt-1">
                                Invalid business license documentation. Need to provide proper business registration certificate.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 border-t pt-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-sm font-medium text-gray-600">Rejected by: </span>
                            <span class="text-sm text-gray-600">Admin (Jane Smith)</span>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-600">Date: </span>
                            <span class="text-sm text-gray-600">Oct 12, 2023</span>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 flex justify-between space-x-2">
                    <button class="flex-1 inline-flex justify-center items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Email Owner
                    </button>
                    <button class="flex-1 inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Reconsider
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Pagination -->
    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 rounded-lg shadow">
        <div class="flex-1 flex justify-between sm:hidden">
            <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Previous
            </a>
            <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Next
            </a>
        </div>
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">187</span> results
                </p>
            </div>
            <div>
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <span class="sr-only">Previous</span>
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                        1
                    </a>
                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-primary-50 text-sm font-medium text-primary-600 hover:bg-primary-100">
                        2
                    </a>
                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                        3
                    </a>
                    <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                        ...
                    </span>
                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                        19
                    </a>
                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <span class="sr-only">Next</span>
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Rejection Modal -->
<div id="rejectionModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 overflow-hidden">
        <div class="bg-red-50 px-4 py-3 border-b border-red-100">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-red-800">Reject Barbershop</h3>
                <button type="button" class="close-modal text-red-400 hover:text-red-600">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        
        <div class="p-4">
            <p class="text-sm text-gray-700 mb-4">Please provide a reason for rejecting this barbershop. This will be shared with the owner.</p>
            
            <div class="mb-4">
                <label for="rejection-reason" class="block text-sm font-medium text-gray-700 mb-1">Rejection Reason</label>
                <select id="rejection-reason" class="w-full rounded-md border border-gray-300 py-2 pl-3 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-500">
                    <option value="">Select a reason</option>
                    <option value="invalid_license">Invalid Business License</option>
                    <option value="incomplete_info">Incomplete Information</option>
                    <option value="inappropriate_content">Inappropriate Content</option>
                    <option value="duplicate">Duplicate Entry</option>
                    <option value="other">Other</option>
                </select>
            </div>
            
            <div class="mb-4">
                <label for="rejection-details" class="block text-sm font-medium text-gray-700 mb-1">Additional Details</label>
                <textarea id="rejection-details" rows="3" class="w-full rounded-md border border-gray-300 shadow-sm focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50" placeholder="Please provide specific details about the rejection reason..."></textarea>
            </div>
            
            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                    <span class="ml-2 text-sm text-gray-700">Send email notification to owner</span>
                </label>
            </div>
        </div>
        
        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 border-t">
            <button type="button" class="close-modal inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mr-2">
                Cancel
            </button>
            <button type="button" class="confirm-rejection inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                Confirm Rejection
            </button>
        </div>
    </div>
</div>

<script>
    // Initialize modal functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Get all buttons that should open the rejection modal
        const rejectButtons = document.querySelectorAll('button:has(svg path[d="M6 18L18 6M6 6l12 12"])');
        
        // Get the modal
        const modal = document.getElementById('rejectionModal');
        
        // Get all elements that should close the modal
        const closeElements = modal.querySelectorAll('.close-modal');
        
        // Get the confirm button
        const confirmButton = modal.querySelector('.confirm-rejection');
        
        // Function to open modal
        function openModal() {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        
        // Function to close modal
        function closeModal() {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }
        
        // Add click event to all reject buttons
        rejectButtons.forEach(button => {
            button.addEventListener('click', openModal);
        });
        
        // Add click event to all close elements
        closeElements.forEach(element => {
            element.addEventListener('click', closeModal);
        });
        
        // Close modal when clicking outside of it
        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                closeModal();
            }
        });
        
        // Handle confirmation
        confirmButton.addEventListener('click', function() {
            const reason = document.getElementById('rejection-reason').value;
            const details = document.getElementById('rejection-details').value;
            
            if (!reason) {
                alert('Please select a rejection reason');
                return;
            }
            
            // Here you would typically send an AJAX request to your server
            console.log('Rejection confirmed with reason:', reason);
            console.log('Additional details:', details);
            
            // Close the modal after successful submission
            closeModal();
            
            // Show a success message
            alert('Barbershop has been rejected');
        });
    });
</script>

@endsection

@section('additional_scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation for activity items with delay
        const cards = document.querySelectorAll('.barbershop-card');
        cards.forEach((card, index) => {
            setTimeout(() => {
                card.classList.add('scale-in');
            }, 100 * index);
        });
    });
</script>
@endsection