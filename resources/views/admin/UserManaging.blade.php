@extends('layouts.admin')

@section('additional_styles')
<style>
    .user-loader {
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
    
    #user-loader {
        animation: fade-in 0.5s ease-out;
    }
    
    @keyframes fade-in {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .status-badge {
        transition: all 0.3s ease;
    }
    .user-card:hover .quick-actions {
        opacity: 1;
    }
    .quick-actions {
        opacity: 0;
        transition: all 0.3s ease;
    }
    .role-badge {
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
            <h1 class="text-3xl font-bold text-gray-900">Manage Users</h1>
            <p class="mt-1 text-sm text-gray-600">Review, update and manage all users in the platform</p>
        </div>
        <div class="mt-4 md:mt-0 flex space-x-3">
            <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add New User
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
                <form action="">
                <div class="relative">
                    <input id="search-input" type="text" class="filter w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-500" placeholder="Search users by name, email, or role...">
                    <div class="absolute left-3 top-2.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 w-full md:w-auto">
                <select id="status-filter" class="filter rounded-md border border-gray-300 py-2 pl-3 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-500">
                    <option value="">All Status</option>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                    <option value="Suspended">Suspended</option>
                </select>
                
                <select id="role-filter" class="filter rounded-md border border-gray-300 py-2 pl-3 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-500">
                    <option value="">All Roles</option>
                    <option value="admin">Admin</option>
                    <option value="barber">Barber</option>
                    <option value="customer">Customer</option>
                    <option value="shop_owner">Shop Owner</option>
                </select>
                
                <select id="sort-filter" class="filter rounded-md border border-gray-300 py-2 pl-3 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-500">
                    <option value="DESC">Newest First</option>
                    <option value="ASC">Oldest First</option>
                    <option value="name">Name A-Z</option>
                    <option value="login">Last Login</option>
                </select>
            </div>
        </div>
        <div class="flex justify-end mt-3">
            <button type="reset" onclick="getUsers(1,{sort:'DESC'})" id="clear-filters" class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Clear Filters
            </button>
        </div>
        </form>
        <div id="active-filters" class="mt-3 flex flex-wrap gap-2">
            <!-- Active filters will be dynamically added here -->
        </div>
    </div>
    
    <!-- Stats Overview -->
    <div id="statistics" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <!-- Statistics will be populated here -->
    </div>

    <!-- Users Grid -->
    <div id="users-table" class="">
        <!-- Users will be populated here -->
        <!-- Sample Users (Static Examples) -->
        <div class="overflow-x-auto relative">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="py-3 px-6">User</th>
                        <th scope="col" class="py-3 px-6">Role</th>
                        <th scope="col" class="py-3 px-6">Status</th>
                        <th scope="col" class="py-3 px-6">Joined</th>
                        <th scope="col" class="py-3 px-6">Last Login</th>
                        <th scope="col" class="py-3 px-6">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Example User 1 -->
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="py-4 px-6">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <img src="https://ui-avatars.com/api/?name=John+Doe&background=3f83f8" 
                                         alt="John Doe" 
                                         class="h-10 w-10 rounded-full">
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">John Doe</p>
                                    <p class="text-xs text-gray-600">johndoe@example.com</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 role-badge">
                                Customer
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="status-badge px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Active
                            </span>
                        </td>
                        <td class="py-4 px-6">Jan 15, 2023</td>
                        <td class="py-4 px-6">Today</td>
                        <td class="py-4 px-6">
                            <div class="flex space-x-2">
                                <button class="inline-flex items-center p-1.5 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <button class="inline-flex items-center p-1.5 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </button>
                                <button class="inline-flex items-center p-1.5 border border-transparent rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Example User 2 -->
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="py-4 px-6">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <img src="https://ui-avatars.com/api/?name=Jane+Smith&background=6b46c1" 
                                         alt="Jane Smith" 
                                         class="h-10 w-10 rounded-full">
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">Jane Smith</p>
                                    <p class="text-xs text-gray-600">janesmith@example.com</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 role-badge">
                                Barber
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="status-badge px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                Suspended
                            </span>
                        </td>
                        <td class="py-4 px-6">Feb 8, 2023</td>
                        <td class="py-4 px-6">5 days ago</td>
                        <td class="py-4 px-6">
                            <div class="flex space-x-2">
                                <button class="inline-flex items-center p-1.5 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <button class="inline-flex items-center p-1.5 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </button>
                                <button class="inline-flex items-center p-1.5 border border-transparent rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Example User 3 -->
                    <tr class="bg-white hover:bg-gray-50">
                        <td class="py-4 px-6">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <img src="https://ui-avatars.com/api/?name=Mike+Johnson&background=10b981" 
                                         alt="Mike Johnson" 
                                         class="h-10 w-10 rounded-full">
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">Mike Johnson</p>
                                    <p class="text-xs text-gray-600">mike@example.com</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 role-badge">
                                Shop Owner
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="status-badge px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                Inactive
                            </span>
                        </td>
                        <td class="py-4 px-6">March 22, 2023</td>
                        <td class="py-4 px-6">30 days ago</td>
                        <td class="py-4 px-6">
                            <div class="flex space-x-2">
                                <button class="inline-flex items-center p-1.5 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <button class="inline-flex items-center p-1.5 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </button>
                                <button class="inline-flex items-center p-1.5 border border-transparent rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
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
                
            </div>
            <div>
                <nav id="pagination" class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                   <!-- Pagination will be populated here -->
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div id="editUserModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 overflow-hidden">
        <div class="bg-primary-50 px-4 py-3 border-b border-primary-100">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-primary-800">Edit User</h3>
                <button type="button" class="close-modal text-primary-400 hover:text-primary-600">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        
        <form id="editUserForm">
            <div class="p-4">
                <div class="mb-4">
                    <label for="edit-name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" id="edit-name" name="name" class="w-full rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                </div>
                
                <div class="mb-4">
                    <label for="edit-email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="edit-email" name="email" class="w-full rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                </div>
                
                <div class="mb-4">
                    <label for="edit-role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                    <select id="edit-role" name="role" class="w-full rounded-md border border-gray-300 py-2 pl-3 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-500">
                        <option value="customer">Customer</option>
                        <option value="barber">Barber</option>
                        <option value="shop_owner">Shop Owner</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                
                <div class="mb-4">
                    <label for="edit-status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select id="edit-status" name="status" class="w-full rounded-md border border-gray-300 py-2 pl-3 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-500">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                        <option value="Suspended">Suspended</option>
                    </select>
                </div>
                
                <div class="mb-4">
                    <label class="flex items-center">
                        <input type="checkbox" id="edit-email-verified" name="email_verified" class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">Email Verified</span>
                    </label>
                </div>
                
                <div class="mb-4">
                    <label for="edit-notes" class="block text-sm font-medium text-gray-700 mb-1">Admin Notes</label>
                    <textarea id="edit-notes" name="notes" rows="3" class="w-full rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-200 focus:ring-opacity-50"></textarea>
                </div>
            </div>
            
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 border-t">
                <button type="button" class="close-modal inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mr-2">
                    Cancel
                </button>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Suspend User Modal -->
<div id="suspendUserModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 overflow-hidden">
        <div class="bg-red-50 px-4 py-3 border-b border-red-100">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-red-800">Suspend User</h3>
                <button type="button" class="close-suspend-modal text-red-400 hover:text-red-600">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        
        <div class="p-4">
            <p class="text-sm text-gray-700 mb-4">Are you sure you want to suspend this user? They will no longer be able to access the platform until reinstated.</p>
            
            <div class="mb-4">
                <label for="suspend-reason" class="block text-sm font-medium text-gray-700 mb-1">Suspension Reason</label>
                <select id="suspend-reason" class="w-full rounded-md border border-gray-300 py-2 pl-3 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-500">
                    <option value="">Select a reason</option>
                    <option value="policy_violation">Policy Violation</option>
                    <option value="spam">Spam Activity</option>
                    <option value="abuse">Abusive Behavior</option>
                    <option value="fraud">Fraudulent Activity</option>
                    <option value="other">Other</option>
                </select>
            </div>
            
            <div class="mb-4">
                <label for="suspend-details" class="block text-sm font-medium text-gray-700 mb-1">Additional Details</label>
                <textarea id="suspend-details" rows="3" class="w-full rounded-md border border-gray-300 shadow-sm focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50" placeholder="Please provide specific details about the suspension reason..."></textarea>
            </div>
            
            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" id="sendSuspensionEmail" class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                    <span class="ml-2 text-sm text-gray-700">Send email notification to user</span>
                </label>
            </div>
        </div>
        
        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 border-t">
            <button type="button" class="close-suspend-modal inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mr-2">
                Cancel
            </button>
            <button type="button" class="confirm-suspension inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                Confirm Suspension
            </button>
        </div>
    </div>
</div>

<!-- Email User Modal -->
<div id="emailUserModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 overflow-hidden">
        <div class="bg-primary-50 px-4 py-3 border-b border-primary-100">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-primary-800">Email User</h3>
                <button type="button" class="close-email-modal text-primary-400 hover:text-primary-600">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        
        <div class="p-4">
            <p class="text-sm text-gray-700 mb-4">Send a direct email to the user.</p>
            
            <div class="mb-4">
                <label for="email-subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                <input type="text" id="email-subject" class="w-full rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-200 focus:ring-opacity-50" placeholder="Enter email subject...">
            </div>
            
            <div class="mb-4">
                <label for="email-message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                <textarea id="email-message" rows="5" class="w-full rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-200 focus:ring-opacity-50" placeholder="Type your message here..."></textarea>
            </div>
            
            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" id="send-copy" class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                    <span class="ml-2 text-sm text-gray-700">Send me a copy</span>
                </label>
            </div>
        </div>
        
        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 border-t flex items-center justify-end">
            <button type="button" class="close-email-modal inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mr-2">
                Cancel
            </button>
            <button type="button" class="send-email inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                Send Email
            </button>
        </div>
    </div>
</div>

@endsection

@section('additional_scripts')
<script>
    let users = [];
    let pagination = [];
    let currentPage = 1;
    let filterData = {
        sort: 'DESC',
    };

    async function getUsers(page = 1, filterData = {}) {
        // Show loader animation
        const tableContainer = document.getElementById('users-table');
        tableContainer.innerHTML = `
        <div id="user-loader" class="flex flex-col justify-center items-center py-20">
            <div class="flex flex-col items-center">
                <div class="barber-pole-loader mb-4">
                    <div class="barber-pole">
                        <div class="pole-stripe"></div>
                    </div>
                </div>
                <div class="text-center">
                    <p class="text-xl font-bold text-gray-800">Loading Users</p>
                    <p class="text-sm text-gray-500 mt-2">Just a moment while we fetch the latest data...</p>
                    <div class="loading-dots mt-2">
                        <span></span><span></span><span></span>
                    </div>
                </div>
            </div>
        </div>`;

        try {
            // Construct the API URL with filters
            let url = `/api/admin/users?page=${page}`;
            
            if (filterData.search) url += `&search=${encodeURIComponent(filterData.search)}`;
            if (filterData.status) url += `&status=${encodeURIComponent(filterData.status)}`;
            if (filterData.role) url += `&role=${encodeURIComponent(filterData.role)}`;
            if (filterData.sort) url += `&sort=${encodeURIComponent(filterData.sort)}`;
            
            const response = await fetch(url);
            const data = await response.json();
            console.log('Fetched users:', data);
            
            users = data.data;
            currentPage = data.current_page;
            pagination = data.links;
            
            // Render users
            renderUsers();
            
            // Render pagination
            renderPagination();
            
        } catch (error) {
            console.error('Error fetching users:', error);
            tableContainer.innerHTML = `
            <div class="text-center py-10">
                <p class="text-red-500">Failed to load users. Please try again later.</p>
            </div>`;
        }
    }

    function renderUsers() {
        const tableContainer = document.getElementById('users-table');
        
        if (users.length === 0) {
            tableContainer.innerHTML = `
            <div class="text-center py-10">
                <p class="text-gray-500">No users found matching your criteria.</p>
            </div>`;
            return;
        }
        
        let tableHtml = `
        <div class="overflow-x-auto relative">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="py-3 px-6">User</th>
                        <th scope="col" class="py-3 px-6">Role</th>
                        <th scope="col" class="py-3 px-6">Status</th>
                        <th scope="col" class="py-3 px-6">Joined</th>
                        <th scope="col" class="py-3 px-6">Last Login</th>
                        <th scope="col" class="py-3 px-6">Actions</th>
                    </tr>
                </thead>
                <tbody>`;
        
        users.forEach(user => {
            // Determine status badge class and text
            let statusClass, statusText;
            switch (user.status) {
                case 'Active':
                    statusClass = "bg-green-100 text-green-800";
                    statusText = "Active";
                    break;
                case 'Inactive':
                    statusClass = "bg-gray-100 text-gray-800";
                    statusText = "Inactive";
                    break;
                case 'Suspended':
                    statusClass = "bg-red-100 text-red-800";
                    statusText = "Suspended";
                    break;
                default:
                    statusClass = "bg-yellow-100 text-yellow-800";
                    statusText = "Unknown";
            }
            
            // Format created_at date
            const createdDate = new Date(user.created_at);
            const joinedDate = createdDate.toLocaleDateString('en-US', {
                year: 'numeric', 
                month: 'short', 
                day: 'numeric'
            });
            
            // Format last login date if available
            let lastLoginText = "Never logged in";
            if (user.last_login_at) {
                const lastLogin = new Date(user.last_login_at);
                const now = new Date();
                const diffTime = Math.abs(now - lastLogin);
                const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
                
                if (diffDays === 0) {
                    lastLoginText = "Today";
                } else if (diffDays === 1) {
                    lastLoginText = "Yesterday";
                } else {
                    lastLoginText = `${diffDays} days ago`;
                }
            }
            
            tableHtml += `
            <tr class="bg-white border-b hover:bg-gray-50">
                <td class="py-4 px-6">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <img src="${user.avatar || 'https://ui-avatars.com/api/?name=' + encodeURIComponent(user.name) + '&background=random'}" 
                                 alt="${user.name}" 
                                 class="h-10 w-10 rounded-full">
                        </div>
                        <div>
                            <p class="font-bold text-gray-900">${user.name}</p>
                            <p class="text-xs text-gray-600">${user.email}</p>
                        </div>
                    </div>
                </td>
                <td class="py-4 px-6">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 role-badge">
                        ${user.role || 'Customer'}
                    </span>
                </td>
                <td class="py-4 px-6">
                    <span class="status-badge px-3 py-1 rounded-full text-xs font-medium ${statusClass}">
                        ${statusText}
                    </span>
                </td>
                <td class="py-4 px-6">${joinedDate}</td>
                <td class="py-4 px-6">${lastLoginText}</td>
                <td class="py-4 px-6">
                    <div class="flex space-x-2">
                        <button onclick="openEditModal(${user.id})" class="inline-flex items-center p-1.5 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>
                        <button onclick="openEmailModal(${user.id})" class="inline-flex items-center p-1.5 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </button>
                        ${user.status !== 'Suspended' ? 
                            `<button onclick="openSuspendModal(${user.id})" class="inline-flex items-center p-1.5 border border-transparent rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                </svg>
                            </button>` : 
                            `<button onclick="activateUser(${user.id})" class="inline-flex items-center p-1.5 border border-transparent rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>`
                        }
                    </div>
                </td>
            </tr>`;
        });
        
        tableHtml += `
                </tbody>
            </table>
        </div>`;
        
        tableContainer.innerHTML = tableHtml;
    }

    function renderPagination() {
        const paginationContainer = document.getElementById('pagination');
        paginationContainer.innerHTML = '';
        
        pagination.forEach((page, index) => {
            let pageLink = document.createElement('a');
            pageLink.classList.add('relative', 'inline-flex', 'items-center', 'px-4', 'py-2', 'border', 'text-sm', 'font-medium', 'rounded-md');
            
            if (page.active) {
                // Style for current page
                pageLink.classList.add('z-10', 'bg-primary-50', 'border-primary-500', 'text-primary-600');
            } else {
                // Style for non-current pages
                pageLink.classList.add('bg-white', 'border-gray-300', 'text-gray-700', 'hover:bg-gray-50');
            }
            
            pageLink.innerHTML = page.label;
            
            if (page.url) {
                pageLink.setAttribute('href', '#');
                pageLink.addEventListener('click', (e) => {
                    e.preventDefault();
                    const pageNum = page.url.split('page=')[1];
                    getUsers(pageNum, filterData);
                });
            } else {
                pageLink.classList.add('bg-gray-200', 'text-gray-500', 'cursor-not-allowed');
            }
            
            paginationContainer.appendChild(pageLink);
        });
    }

    async function getUsersStatistics() {
        try {
            const response = await fetch('/api/admin/users/statistics');
            const statistics = await response.json();
            
            const statisticsContainer = document.getElementById('statistics');
            statisticsContainer.innerHTML = `
                <div class="bg-white rounded-lg shadow p-4 scale-in">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-sm font-medium text-gray-600">Total Users</h2>
                            <p class="text-xl font-semibold">${statistics.totalUsers || 0}</p>
                            <p class="text-xs text-green-600 mt-1">↑ ${statistics.newUsersPercentage || 0}% from last month</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow p-4 scale-in" style="animation-delay: 0.1s">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-sm font-medium text-gray-600">Active Users</h2>
                            <p class="text-xl font-semibold">${statistics.activeUsers || 0}</p>
                            <p class="text-xs text-gray-600 mt-1">${statistics.activeUsersPercentage || 0}% of total</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow p-4 scale-in" style="animation-delay: 0.2s">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-purple-100 rounded-md p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-sm font-medium text-gray-600">Shop Owners</h2>
                            <p class="text-xl font-semibold">${statistics.shopOwners || 0}</p>
                            <p class="text-xs text-gray-600 mt-1">${statistics.shopOwnersPercentage || 0}% of total</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow p-4 scale-in" style="animation-delay: 0.3s">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-red-100 rounded-md p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-sm font-medium text-gray-600">Suspended Users</h2>
                            <p class="text-xl font-semibold">${statistics.suspendedUsers || 0}</p>
                            <p class="text-xs text-gray-600 mt-1">${statistics.suspendedUsersPercentage || 0}% of total</p>
                        </div>
                    </div>
                </div>
            `;
        } catch (error) {
            console.error('Error fetching statistics:', error);
        }
    }

    // Filter handling
    document.addEventListener('DOMContentLoaded', function() {
        const filterInputs = document.querySelectorAll('.filter');
        
        filterInputs.forEach(input => {
            input.addEventListener('change', () => {
                filterData = {
                    search: document.getElementById('search-input').value,
                    status: document.getElementById('status-filter').value,
                    role: document.getElementById('role-filter').value,
                    sort: document.getElementById('sort-filter').value,
                };
                
                getUsers(1, filterData);
            });
        });
        
        // Search input with debounce
        const searchInput = document.getElementById('search-input');
        let debounceTimer;
        
        searchInput.addEventListener('input', () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                filterData.search = searchInput.value;
                getUsers(1, filterData);
            }, 500);
        });
        
        // Clear filters button
        document.getElementById('clear-filters').addEventListener('click', () => {
            document.getElementById('search-input').value = '';
            document.getElementById('status-filter').value = '';
            document.getElementById('role-filter').value = '';
            document.getElementById('sort-filter').value = 'DESC';
            
            filterData = {
                sort: 'DESC'
            };
            
            getUsers(1, filterData);
        });
    });

    // Modal functions
    function openEditModal(userId) {
        const modal = document.getElementById('editUserModal');
        const user = users.find(u => u.id === userId);
        
        if (user) {
            document.getElementById('edit-name').value = user.name;
            document.getElementById('edit-email').value = user.email;
            document.getElementById('edit-role').value = user.role || 'customer';
            document.getElementById('edit-status').value = user.status || 'Active';
            document.getElementById('edit-email-verified').checked = !!user.email_verified_at;
            document.getElementById('edit-notes').value = user.admin_notes || '';
            
            const form = document.getElementById('editUserForm');
            form.onsubmit = (e) => {
                e.preventDefault();
                updateUser(userId);
            };
        }
        
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function openSuspendModal(userId) {
        const modal = document.getElementById('suspendUserModal');
        const confirmButton = modal.querySelector('.confirm-suspension');
        confirmButton.setAttribute('id', userId);
        
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function openEmailModal(userId) {
        const modal = document.getElementById('emailUserModal');
        const sendButton = modal.querySelector('.send-email');
        const user = users.find(u => u.id === userId);
        
        sendButton.setAttribute('id', userId);
        
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    async function updateUser(userId) {
        const name = document.getElementById('edit-name').value;
        const email = document.getElementById('edit-email').value;
        const role = document.getElementById('edit-role').value;
        const status = document.getElementById('edit-status').value;
        const emailVerified = document.getElementById('edit-email-verified').checked;
        const notes = document.getElementById('edit-notes').value;
        
        try {
            const response = await fetch(`/api/admin/users/${userId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    name,
                    email,
                    role,
                    status,
                    email_verified: emailVerified,
                    admin_notes: notes
                })
            });
            
            const data = await response.json();
            
            if (data.success) {
                // Close modal
                const modal = document.getElementById('editUserModal');
                modal.classList.add('hidden');
                document.body.style.overflow = '';
                
                // Refresh user data
                getUsers(currentPage, filterData);
                getUsersStatistics();
                
                alert('User updated successfully!');
            } else {
                alert(data.message || 'Failed to update user.');
            }
        } catch (error) {
            console.error('Error updating user:', error);
            alert('An error occurred while updating the user.');
        }
    }

    // Initialize data and event listeners
    document.addEventListener('DOMContentLoaded', function() {
        getUsers(currentPage, filterData);
        getUsersStatistics();
        
        // Setup modal close handlers
        const modals = [
            { id: 'editUserModal', closeBtns: '.close-modal' },
            { id: 'suspendUserModal', closeBtns: '.close-suspend-modal' },
            { id: 'emailUserModal', closeBtns: '.close-email-modal' }
        ];
        
        modals.forEach(modal => {
            const modalElement = document.getElementById(modal.id);
            const closeButtons = modalElement.querySelectorAll(modal.closeBtns);
            
            closeButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    modalElement.classList.add('hidden');
                    document.body.style.overflow = '';
                });
            });
            
            modalElement.addEventListener('click', (e) => {
                if (e.target === modalElement) {
                    modalElement.classList.add('hidden');
                    document.body.style.overflow = '';
                }
            });
        });
        
        // Suspend user handler
        const suspendConfirmButton = document.querySelector('.confirm-suspension');
        suspendConfirmButton.addEventListener('click', async () => {
            const userId = suspendConfirmButton.getAttribute('id');
            const reason = document.getElementById('suspend-reason').value;
            const details = document.getElementById('suspend-details').value;
            const sendEmail = document.getElementById('sendSuspensionEmail').checked;
            
            if (!reason) {
                alert('Please select a suspension reason');
                return;
            }
            
            try {
                const response = await fetch(`/api/admin/users/suspend`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        user_id: userId,
                        suspended_by: {{ auth()->user()->id }},
                        reason,
                        details,
                        send_email: sendEmail
                    })
                });
                
                const data = await response.json();
                
                
                    // Close modal
                    const modal = document.getElementById('suspendUserModal');
                    modal.classList.add('hidden');
                    document.body.style.overflow = '';
                    
                    // Reset form
                    document.getElementById('suspend-reason').value = '';
                    document.getElementById('suspend-details').value = '';
                    document.getElementById('sendSuspensionEmail').checked = false;
                    
                    // Refresh data
                    getUsers(currentPage, filterData);
                    getUsersStatistics();
                    
                    alert('User suspended successfully!');
                
                    
                
            } catch (error) {
                console.error('Error suspending user:', error);
                alert('An error occurred while suspending the user.');
            }
        });
        
        // Email user handler
        const sendEmailButton = document.querySelector('.send-email');
        sendEmailButton.addEventListener('click', async function() {
            const subject = document.getElementById('email-subject').value;
            const message = document.getElementById('email-message').value;
            const sendCopy = document.getElementById('send-copy').checked;
            const userId = this.getAttribute('id');
            const send_by = {{ auth()->user()->id }};
            
            if (!subject || !message) {
                alert('Please fill in both subject and message fields.');
                return;
            }
            
            try {
                const response = await fetch('http://127.0.0.1:8000/api/admin/users/email-user', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        user_id: userId,
                        subject: subject,
                        message: message,
                        send_copy: sendCopy,
                        sent_by: send_by
                    }),
                });
                
                const data = await response.json();
                
                
                    // console.log(data);
                    
                    alert('Email sent successfully!');
                    closeEmailModal();
                
                
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred while sending the email.');
            }
        });
    });

    function closeEmailModal() {
        const modal = document.getElementById('emailUserModal');
        modal.classList.add('hidden');
        document.body.style.overflow = '';
        
        // Reset form fields
        document.getElementById('email-subject').value = '';
        document.getElementById('email-message').value = '';
        document.getElementById('send-copy').checked = false;
    }

    // Function to activate a suspended user
    async function activateUser(userId) {
        if (!confirm('Are you sure you want to activate this user?')) {
            return;
        }
        
        try {
            const response = await fetch(`/api/admin/users/${userId}/activate`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    activated_by: {{ auth()->user()->id }}
                })
            });
            
            const data = await response.json();
            
            if (data.success) {
                getUsers(currentPage, filterData);
                getUsersStatistics();
                alert('User activated successfully!');
            } else {
                alert(data.message || 'Failed to activate user.');
            }
        } catch (error) {
            console.error('Error activating user:', error);
            alert('An error occurred while activating the user.');
        }
    }
</script>
@endsection