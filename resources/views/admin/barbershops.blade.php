@extends('layouts.admin')

@section('additional_styles')
<style>
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
            
            #barbershop-loader {
            animation: fade-in 0.5s ease-out;
            }
            
            @keyframes fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
            }

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
                <div >
                <div class="relative">
                    <input id="search-input" type="text" class="filter w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-500" placeholder="Search barbershops by name, location, or services...">
                    <div class="absolute left-3 top-2.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 w-full md:w-auto pt-3">
                <select id="status-filter" class="filter rounded-md border border-gray-300 py-2 pl-3 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-500">
                    <option value="">All Status</option>
                    <option value="Pending Verification">Pending</option>
                    <option value="Verified">Approved</option>
                    <option value="Rejected">Rejected</option>
                </select>
                
                <select id="rating-filter" class="filter rounded-md border border-gray-300 py-2 pl-3 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-500">
                    <option value="">All Ratings</option>
                    <option value="5">5 stars</option>
                    <option value="4">4+ stars</option>
                    <option value="3">3+ stars</option>
                    <option value="2">2+ stars</option>
                    <option value="1">1+ stars</option>
                </select>
                
                <select id="sort-filter" class="filter rounded-md border border-gray-300 py-2 pl-3 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-500">
                    <option value="DESC">Newest First</option>
                    <option value="ASC">Oldest First</option>
                    <!-- <option value="rating">Highest Rating</option> -->
                    <option value="name">Name A-Z</option>
                    <!-- <option value="bookings">Most Bookings</option> -->
                </select>
            </div>
        </div>
        <div class="flex justify-end mt-3">
            <button type="reset" onclick="getBarberShops(1,{sort:'DESC'})" id="clear-filters" class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Clear Filters
            </button>
        </div>
</div>
        <div id="active-filters" class="mt-3 flex flex-wrap gap-2">
            <!-- Active filters will be dynamically added here -->
        </div>
    </div>
    
    <!-- Stats Overview -->
    <div id="statistics" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        
    </div>

    <!-- Barbershops Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">

       
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
                   
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Rejection Modal -->
<div id="rejectionModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
    <form id="rejectionForm" action="" method="POST">
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
                <select id="rejection-reason" name="Rejection_Reason" class="w-full rounded-md border border-gray-300 py-2 pl-3 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-500">
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
                    <input type="checkbox" id="sendRejectionEmail" class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
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
    </form>
</div>

<!-- Reconsideration Modal -->

<div id="reconsiderationModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 overflow-hidden">
        <div class="bg-blue-50 px-4 py-3 border-b border-blue-100">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-blue-800">Reconsider Barbershop</h3>
                <button type="button" class="close-reconsider-modal text-blue-400 hover:text-blue-600">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        
        <div class="p-4">
            <p class="text-sm text-gray-700 mb-4">You are about to reconsider this barbershop's application. This will move the shop back to pending status for review.</p>
            
            <div class="mb-4">
                <label for="reconsideration-notes" class="block text-sm font-medium text-gray-700 mb-1">Notes (Optional)</label>
                <textarea id="reconsideration-notes" rows="3" class="w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Add any notes about why this shop is being reconsidered..."></textarea>
            </div>
            
            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" id="sendReconsiderationEmail" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <span class="ml-2 text-sm text-gray-700">Send email notification to owner</span>
                </label>
            </div>
        </div>
        
        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 border-t">
            <button type="button" class="close-reconsider-modal inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mr-2">
                Cancel
            </button>
            <button type="button" class="confirm-reconsideration inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Confirm Reconsideration
            </button>
        </div>
    </div>
</div>

<!-- Approval Modal -->
<div id="approvalModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 overflow-hidden">
        <div class="bg-green-50 px-4 py-3 border-b border-green-100">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-green-800">Approve Barbershop</h3>
                <button type="button" class="close-approval-modal text-green-400 hover:text-green-600">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        
        <div class="p-4">
            <p class="text-sm text-gray-700 mb-4">You are about to approve this barbershop. This will make the shop visible to all users and allow bookings.</p>
            
            <div class="mb-4">
                <label for="approval-notes" class="block text-sm font-medium text-gray-700 mb-1">Notes (Optional)</label>
                <textarea id="approval-notes" rows="3" class="w-full rounded-md border border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" placeholder="Add any notes about this approval..."></textarea>
            </div>
            
            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" id="sendApprovalEmail" checked class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                    <span class="ml-2 text-sm text-gray-700">Send email notification to owner</span>
                </label>
            </div>
        </div>
        
        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 border-t">
            <button type="button" class="close-approval-modal inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mr-2">
                Cancel
            </button>
            <button type="button" class="confirm-approval inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                Confirm Approval
            </button>
        </div>
    </div>
</div>

<!-- Email Owner Modal -->
<div id="emailOwnerModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 overflow-hidden">
        <div class="bg-primary-50 px-4 py-3 border-b border-primary-100">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-primary-800">Email Shop Owner</h3>
                <button type="button" class="close-email-modal text-primary-400 hover:text-primary-600">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        
        <div class="p-4">
            <p class="text-sm text-gray-700 mb-4">Send a direct email to the barbershop owner.</p>
            
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

<script>
   
</script>



@endsection

@section('additional_scripts')
<script>

    let barberShops=[];
    let pagination=[];
    let curentPage=1;
    let filterData={
        sort:'DESC',
    };
    

    async function getBarberShops(page=1, filterData={}) {
        // Show loader animation
        const gridContainer = document.querySelector('.grid.grid-cols-1.md\\:grid-cols-2.lg\\:grid-cols-3.gap-6.mb-6');
        // Display a more refined loader animation
        gridContainer.innerHTML = `
        <div id="barbershop-loader" class="col-span-full flex flex-col justify-center items-center py-20">
            <div class="flex flex-col items-center">
            <div class="barber-pole-loader mb-4">
                <div class="barber-pole">
                <div class="pole-stripe"></div>
                </div>
                <div class="scissors">
                <span class="scissors-top"></span>
                <span class="scissors-bottom"></span>
                </div>
            </div>
            <div class="text-center">
                <p class="text-xl font-bold text-gray-800">Loading Barbershops</p>
                <p class="text-sm text-gray-500 mt-2">Just a moment while we fetch the latest data...</p>
                <div class="loading-dots mt-2">
                <span></span><span></span><span></span>
                </div>
            </div>
            </div>
        </div>`;


        // Fetch barbershops from the API

        url=`/api/admin/Barbershops?page=${page}`;
        // Add filter parameters to the URL if they exist
        if (filterData.search) url += `&search=${encodeURIComponent(filterData.search)}`;
        if (filterData.status) url += `&status=${encodeURIComponent(filterData.status)}`;
        if (filterData.rating) url += `&rating=${encodeURIComponent(filterData.rating)}`;
        if (filterData.sort) url += `&sort=${encodeURIComponent(filterData.sort)}`;
        
        await fetch(url, {
            method: 'GET'
        })
            .then(res=>res.json())
            .then(data=>{
                console.log(data);
                barberShops=data.data;
                curentPage=data.current_page;
                pagination=data.links;
            })
            .catch(err=>console.log(err));

        // console.log(barberShops);
        // Display the barbershops in the grid
        gridContainer.innerHTML = ''; // Clear existing content
        barberShops.forEach(shop => {
            // console.log(shop);
            
            // Determine status badge class and text
            let statusClass, statusText;
            if (shop.is_verified === "Pending Verification") {
                statusClass = "bg-yellow-100 text-yellow-800";
                statusText = "Pending Verification";
            } else if (shop.is_verified === "Verified") {
                statusClass = "bg-green-100 text-green-800";
                statusText = "Verified";
            } else if (shop.is_verified === "Rejected") {
                statusClass = "bg-red-100 text-red-800";
                statusText = "Rejected";
            }
            
            // Format created_at date
            const createdDate = new Date(shop.created_at);
            const timeDiff = Math.floor((new Date() - createdDate) / (1000 * 60 * 60 * 24));
            const submittedText = timeDiff <= 1 ? "Submitted today" : `Submitted ${timeDiff} days ago`;
            
            // Generate rating stars
            const rating = shop.ratings || 0;
            let ratingStars = '';
            for (let i = 1; i <= 5; i++) {
                if (i <= rating) {
                    ratingStars += '<span class="filled">★</span>';
                } else {
                    ratingStars += '<span class="empty">★</span>';
                }
            }
            
            // Generate barber badges if available
            let barberBadges = '';
            if (shop.barbers && shop.barbers.length > 0) {
                // Parse the barbers JSON string if necessary
                if (typeof shop.barbers === 'string') {
                    shop.barbers = JSON.parse(shop.barbers);
                }
                shop.barbers.forEach(barber => {
                    barberBadges += `
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mr-1">
                            ${barber}
                        </span>`;
                });
            }

            // Get first part of working hours if available
            let workingHoursText = "Hours not specified";
            if (shop.working_hours && shop.working_hours.monday) {
                const monday = shop.working_hours.monday;
                if (monday.open && monday.close) {
                    workingHoursText = `Mon: ${monday.open} - ${monday.close}`;
                }
            }
            
            let container=document.createElement('div'); 

            // Create the HTML string for the barbershop card
            const shopHTML = `
            <div class="bg-white rounded-lg shadow overflow-hidden barbershop-card">
                <div class="relative">
                    <img src="${shop.cover ? '/storage/' + shop.cover : 'https://placehold.co/600x400'}" alt="${shop.name}" class="h-48 w-full object-cover">
                    <div class="absolute top-2 right-2">
                        <span class="status-badge px-3 py-1 rounded-full text-xs font-medium ${statusClass}">
                            ${statusText}
                        </span>
                    </div>
                    <div class="absolute top-2 left-2">
                        <span class="px-2 py-1 rounded-md text-xs font-medium bg-gray-900 bg-opacity-70 text-white">
                            ${submittedText}
                        </span>
                    </div>
                </div>
                <div class="p-4">
                    <div class="flex justify-between items-start">
                        <h3 class="text-lg font-bold text-gray-900">${shop.name}</h3>
                        <div class="rating-stars flex">
                            ${ratingStars}
                            <span class="ml-1 text-xs text-gray-600">(${shop.ratings_count || 0})</span>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm mt-1">${shop.address || ''}, ${shop.city || ''}, ${shop.zip || ''}</p>
                    
                    ${shop.is_verified === "Pending Verification" ? `
                    <div class="mt-4">
                        <div class="flex items-center text-sm text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            ${workingHoursText}
                        </div>
                        <div class="flex items-center text-sm text-gray-500 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            ${shop.phone || 'No phone provided'}
                        </div>
                    </div>
                    <div class="mt-4 flex justify-between">
                        <div>
                            ${barberBadges || '<span class="text-sm text-gray-600">No barbers listed</span>'}
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-600">Views: ${shop.views || 0}</span>
                        </div>
                    </div>
                    <div class="mt-4 border-t pt-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-sm font-medium text-gray-600">Email: </span>
                                <span class="text-sm text-gray-600">${shop.email || ''}</span>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-600">Website: </span>
                                <a href="${shop.website || '#'}" class="text-sm text-blue-600 hover:underline" target="_blank">Visit</a>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-between space-x-2">
                        <button onclick="openApprovalModal(${shop.id})" class="approve flex-1 inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Approve
                        </button>
                        <button onclick="openModal(${shop.id})" class="reject flex-1 inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Reject
                        </button>
                    </div>
                    ` : shop.is_verified === "Verified" ? `
                    <div class="mt-4">
                        <div class="flex items-center text-sm text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            ${workingHoursText}
                        </div>
                        <div class="flex items-center text-sm text-gray-500 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z" />
                            </svg>
                            ${shop.bookings_count || 0} bookings this month
                        </div>
                    </div>
                    <div class="mt-4 flex justify-between">
                        <div>
                            ${barberBadges || '<span class="text-sm text-gray-600">No services listed</span>'}
                        </div>
                    </div>
                    
                    <div class="mt-4 border-t pt-4 flex justify-between">
                        <div class="text-sm">
                            <span class="font-medium">Revenue:</span>
                            <span class="text-green-600 font-medium">$${shop.revenue || 0} last month</span>
                        </div>
                        <div>
                            <span class="inline-flex items-center text-xs font-medium text-green-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                                ${shop.revenue_change || 0}% from last month
                            </span>
                        </div>
                    </div>
                    
                    <div class="mt-4 flex space-x-2 quick-actions">
                        <button class="flex-1 inline-flex justify-center items-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            View Details
                        </button>
                        <button onclick="openModal(${shop.id})" class="inline-flex justify-center items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Reject
                        </button>
                    </div>
                    ` : shop.is_verified === "Rejected" ? `
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
                                    ${shop.rejection_reason || 'Invalid business license documentation'}
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4 border-t pt-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-sm font-medium text-gray-600">Rejected by: </span>
                                <span class="text-sm text-gray-600">${shop.rejected_by?.name || 'Admin'}</span>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-600">Date: </span>
                                <span class="text-sm text-gray-600">${new Date(shop.rejected_at || shop.updated_at).toLocaleDateString()}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4 flex justify-between space-x-2">
                        <button onclick="openEmailModal(${shop.id})"  class="flex-1 inline-flex justify-center items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 email-owner">
                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Email Owner
                        </button>
                        <button onclick="openReconsiderationModal(${shop.id})" class="reconsider flex-1 inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Reconsider
                        </button>
                    </div>
                    ` : ''}
                </div>
            </div>
            `;

            container.innerHTML = shopHTML;

            
            gridContainer.appendChild(container);
            
        });
        
        
        
        // // Animation for activity items with delay
        const cards = document.querySelectorAll('.barbershop-card');
        cards.forEach((card, index) => {
            setTimeout(() => {
                card.classList.add('scale-in');
            }, 100 * index);
        });
            console.log(pagination);
            let paginationContainer=document.getElementById('pagination');
            paginationContainer.innerHTML='';
            pagination.forEach((page, index) => {
                let pageLink=document.createElement('a');
                pageLink.classList.add('relative', 'inline-flex', 'items-center', 'px-4', 'py-2', 'border', 'text-sm', 'font-medium', 'rounded-md');
                
                if(page.active) {
                    // Style for current page
                    pageLink.classList.add('z-10', 'bg-primary-50', 'border-primary-500', 'text-primary-600');
                } else {
                    // Style for non-current pages
                    pageLink.classList.add('bg-white', 'border-gray-300', 'text-gray-700', 'hover:bg-gray-50');
                }
                
                pageLink.innerHTML=page.label;
                if(page.url){
                    pageLink.setAttribute('href', page.url);
                    pageLink.addEventListener('click',(e)=>{
                        e.preventDefault();
                        page.label=page.url.split('page=')[1];
                            
                            getBarberShops(page.label,filterData);
                        
                    });
                }else{
                    pageLink.classList.add('bg-gray-200','text-gray-500','cursor-not-allowed');
                }
                paginationContainer.appendChild(pageLink);
            });
            
        

        
 
        
    }
    getBarberShops(curentPage,filterData);

    document.addEventListener('DOMContentLoaded', function() {
        // Animation for activity items with delay
        const cards = document.querySelectorAll('.barbershop-card');
        cards.forEach((card, index) => {
            setTimeout(() => {
                card.classList.add('scale-in');
            }, 100 * index);
        });

    });

    function openModal(shopId) {
        
        const modal = document.getElementById('rejectionModal');
        modal.classList.remove('hidden');
        const confirmButton = modal.querySelector('.confirm-rejection');
        confirmButton.setAttribute('id', shopId); // Set the id attribute to the shop ID
        document.body.style.overflow = 'hidden';
    }


     // Initialize modal functionality
     document.addEventListener('DOMContentLoaded', function() {
        // Get all buttons that should open the rejection modal
        const rejectButtons = document.querySelectorAll('.reject');
        
        // Get the modal
        const modal = document.getElementById('rejectionModal');
        
        // Get all elements that should close the modal
        const closeElements = modal.querySelectorAll('.close-modal');
        
        // Get the confirm button
        const confirmButton = modal.querySelector('.confirm-rejection');
        
        
        // Function to close modal
        function closeModal() {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
            document.getElementById('rejectionForm').reset(); // Reset the form
        }
        
        
        
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
        confirmButton.addEventListener('click', async function() {
            const reason = document.getElementById('rejection-reason').value;
            const details = document.getElementById('rejection-details').value;
            const SendRejectionEmail = document.getElementById('sendRejectionEmail').checked;
            
            

            const shopId = this.getAttribute('id'); // Get the shop ID from the button's id attribute
            
            if (!reason) {
                alert('Please select a rejection reason');
                return;
            }

            
            
            // console.log('Rejection confirmed with reason:', reason);
            // console.log('Additional details:', details);
            let data = JSON.stringify({
                rejected_by: {{ auth()->user()->id }},
                shopId: shopId,
                Rejection_Reason: reason,
                Rejection_Details: details,
                SendRejectionEmail: SendRejectionEmail
            });
            
            
          
        let reject = await fetch('/api/admin/barbershops/reject', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: data,
                });
                reject.json()
                .then(data=>{
                    console.log(data);
                    alert(data.message);
                })
                .catch(err=>console.log(err));
            

            

            
            // Close the modal after successful submission
            getBarberShops(curentPage,filterData);

            getBarberShopsStatistics();

            closeModal();
            
            // Show a success message
            
        });
    });







// Function to handle reconsideration button clicks
function openReconsiderationModal(shopId) {
    const modal = document.getElementById('reconsiderationModal');
    modal.classList.remove('hidden');
    const confirmButton = modal.querySelector('.confirm-reconsideration');
    confirmButton.setAttribute('id', shopId); // Set the id attribute to the shop ID
    document.body.style.overflow = 'hidden';
}

// Initialize reconsideration modal functionality
document.addEventListener('DOMContentLoaded', function() {
    // Get the modal
    const modal = document.getElementById('reconsiderationModal');
    
    // Get all elements that should close the modal
    const closeElements = modal.querySelectorAll('.close-reconsider-modal');
    
    // Get the confirm button
    const confirmButton = modal.querySelector('.confirm-reconsideration');
    
    // Function to close modal
    function closeReconsiderationModal() {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
        document.getElementById('reconsideration-notes').value = '';
        document.getElementById('sendReconsiderationEmail').checked = false;
    }
    
    // Add click event to all close elements
    closeElements.forEach(element => {
        element.addEventListener('click', closeReconsiderationModal);
    });
    
    // Close modal when clicking outside of it
    modal.addEventListener('click', function(event) {            
        if (event.target === modal) {
            closeReconsiderationModal();
        }
    });
    
    // Handle confirmation
    confirmButton.addEventListener('click', async function() {
        const notes = document.getElementById('reconsideration-notes').value;
        const sendEmail = document.getElementById('sendReconsiderationEmail').checked;
        const shopId = this.getAttribute('id');
        
        let data = JSON.stringify({
            reconsidered_by: {{ auth()->user()->id }},
            shopId: shopId,
            notes: notes,
            sendEmail: sendEmail
        });
        
        
        
        try {
            let reconsider = await fetch('/api/admin/barbershops/reconsider', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: data,
            });
            
            const response = await reconsider.json();
            console.log(response);
            alert(response.message || 'Barbershop has been moved to pending status for reconsideration.');
            
            // Refresh the barbershops display
            getBarberShops(curentPage,filterData);
            getBarberShopsStatistics();

            
            // Close the modal after successful submission
            closeReconsiderationModal();
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred while processing your request.');
        }
    });
});



// Function to handle approval button clicks
function openApprovalModal(shopId) {
    const modal = document.getElementById('approvalModal');
    modal.classList.remove('hidden');
    const confirmButton = modal.querySelector('.confirm-approval');
    confirmButton.setAttribute('id', shopId); // Set the id attribute to the shop ID
    document.body.style.overflow = 'hidden';
}

// Initialize approval modal functionality
document.addEventListener('DOMContentLoaded', function() {
    // Get the modal
    const modal = document.getElementById('approvalModal');
    
    // Get all elements that should close the modal
    const closeElements = modal.querySelectorAll('.close-approval-modal');
    
    // Get the confirm button
    const confirmButton = modal.querySelector('.confirm-approval');
    
    // Function to close modal
    function closeApprovalModal() {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
        document.getElementById('approval-notes').value = '';
        // Keep the email notification checked by default
        document.getElementById('sendApprovalEmail').checked = true;
    }
    
    // Add click event to all close elements
    closeElements.forEach(element => {
        element.addEventListener('click', closeApprovalModal);
    });
    
    // Close modal when clicking outside of it
    modal.addEventListener('click', function(event) {            
        if (event.target === modal) {
            closeApprovalModal();
        }
    });
    
    // Handle confirmation
    confirmButton.addEventListener('click', async function() {
        const notes = document.getElementById('approval-notes').value;
        const sendEmail = document.getElementById('sendApprovalEmail').checked;
        const shopId = this.getAttribute('id');
        
        let data = JSON.stringify({
            approved_by: {{ auth()->user()->id }},
            shopId: shopId,
            notes: notes,
            sendEmail: sendEmail
        });
        
        try {
            let approve = await fetch('/api/admin/barbershops/approve', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: data,
            });
            
            const response = await approve.json();
            console.log(response);
            alert(response.message || 'Barbershop has been approved successfully!');
            
            // Refresh the barbershops display
            getBarberShopsStatistics();
            getBarberShops(curentPage,filterData);
            
            // Close the modal after successful submission
            closeApprovalModal();
        } catch (error) {
            console.log('Error:', error);
            alert('An error occurred while processing your request.');
        }
    });
    
});

///statistics

async function getBarberShopsStatistics() {
    
  let statistics=  await fetch('/api/admin/Barbershops/statistics')
        .then(res=>res.json())
        .then(data=>{
            console.log(data);
            return data;
        })
        .catch(err=>console.log(err));
    console.log(statistics);
    let statisticsContainer=document.getElementById('statistics');
    statisticsContainer.innerHTML=`<div class="bg-white rounded-lg shadow p-4 scale-in">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-sm font-medium text-gray-600">Total Barbershops</h2>
                    <p id="totalBarberShops" class="text-xl font-semibold">${statistics.totalBarberShops}</p>
                    <p class="text-xs text-green-600 mt-1">↑ ${statistics.newBarberShopsPercentage}% from last month</p>
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
                    <p class="text-xl font-semibold">${statistics.totalBarberShopsPending}</p>
                    <p class="text-xs text-red-600 mt-1">↑ ${statistics.pendingLastDay} new in last 24h</p>
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
                    <p class="text-xl font-semibold">${statistics.totalBarberShopsApproved}</p>
                    <p class="text-xs text-green-600 mt-1">${statistics.approvedPercentage}% of total</p>
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
                    <p class="text-xl font-semibold">${statistics.totalBarberShopsRejected}</p>
                    <p class="text-xs text-gray-500 mt-1">${statistics.rejectedPercentage}% of total</p>
                </div>
            </div>
        </div>`;

}

getBarberShopsStatistics();


//filter barbershops


    const filter=document.querySelectorAll('.filter');
    
    filter.forEach((item)=>{
       item.addEventListener('change',()=>{
        filterData={
                search:document.getElementById('search-input').value,
                status:document.getElementById('status-filter').value,
                rating:document.getElementById('rating-filter').value,
                sort:document.getElementById('sort-filter').value,
            }
            console.log(filterData);
            getBarberShops(curentPage,filterData);
        });
    });


    // email-owner

    
        // Get email owner buttons
        
        
        // Get the modal
        const modal = document.getElementById('emailOwnerModal');
        
        // Get close buttons
        const closeButtons = modal.querySelectorAll('.close-email-modal');
        
        // Get send button
        const sendButton = modal.querySelector('.send-email');
        
        // Function to open modal
        function openEmailModal(shopId) {
            modal.classList.remove('hidden');
            sendButton.setAttribute('id', shopId);
            document.body.style.overflow = 'hidden';
        }
        
        // Function to close modal
        function closeEmailModal() {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
            document.getElementById('email-subject').value = '';
            document.getElementById('email-message').value = '';
        }
        
        
        
        // Add click listeners to close buttons
        closeButtons.forEach(button => {
            button.addEventListener('click', closeEmailModal);
        });
        
        // Close when clicking outside
        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                closeEmailModal();
            }
        });
        
        // Handle send button
        sendButton.addEventListener('click', async function() {
            const subject = document.getElementById('email-subject').value;
            const message = document.getElementById('email-message').value;
            const sendCopy = document.getElementById('send-copy').checked;
            const shopId = this.getAttribute('id');
            const send_by = {{ auth()->user()->id }};
            
            if (!subject || !message) {
                alert('Please fill in both subject and message fields.');
                return;
            }
            
            try {
                const response = await fetch('/api/admin/barbershops/email-owner', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        shop_id: shopId,
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
  



</script>
@endsection