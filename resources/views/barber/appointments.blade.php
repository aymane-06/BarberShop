@extends('layouts.barber')

@section('additional_styles')
<style>
    .appointment-loader {
        display: flex;
        align-items: center;
        justify-content: center;
        perspective: 800px;
    }
    
    .barber-pole-loader {
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
    
    .status-badge {
        transition: all 0.3s ease;
    }
</style>
@endsection

@section('content')
<div class="container mx-auto">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Appointment Management</h1>
            <p class="mt-1 text-sm text-gray-600">View and manage all upcoming and past appointments</p>
        </div>
        <div class="mt-4 md:mt-0 flex space-x-3">
            <button id="refresh-btn" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                Refresh
            </button>
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
                    <input id="search-input" type="text" placeholder="Search by client name or phone..." class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-500">
                    <div class="absolute left-3 top-2.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 w-full md:w-auto">
                <select id="status-filter" class="filter rounded-md border border-gray-300 py-2 pl-3 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-500">
                    <option value="">All Statuses</option>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                    <option value="no-show">No Show</option>
                </select>
                
                <select id="date-filter" class="filter rounded-md border border-gray-300 py-2 pl-3 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-500">
                    <option value="">All Dates</option>
                    <option value="today">Today</option>
                    <option value="tomorrow">Tomorrow</option>
                    <option value="this-week">This Week</option>
                    <option value="next-week">Next Week</option>
                    <option value="past">Past Appointments</option>
                </select>
                
                <select id="service-filter" class="filter rounded-md border border-gray-300 py-2 pl-3 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-500">
                    <option value="">All Services</option>
                    <!-- Will be populated with available services -->
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
    </div>
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Pending Appointments Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
            <div class="p-3 rounded-full bg-amber-100 text-amber-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="ml-5">
                <p class="text-gray-500 text-sm">Pending Appointments</p>
                <div class="flex items-center">
                <h3 class="font-bold text-xl text-gray-900" id="stats-pending">--</h3>
                <span class="ml-2 text-sm text-amber-600" id="stats-pending-trend">--</span>
                </div>
            </div>
            </div>
        </div>

        <!-- Upcoming Appointments Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-5">
                    <p class="text-gray-500 text-sm">Upcoming</p>
                    <div class="flex items-center">
                        <h3 class="font-bold text-xl text-gray-900" id="stats-upcoming">--</h3>
                        <span class="ml-2 text-sm text-green-600" id="stats-upcoming-trend">--</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Completed Appointments Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="ml-5">
                    <p class="text-gray-500 text-sm">Completed</p>
                    <div class="flex items-center">
                        <h3 class="font-bold text-xl text-gray-900" id="stats-completed">--</h3>
                        <span class="ml-2 text-sm text-blue-600" id="stats-completed-trend">--</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cancellation Rate Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <div class="ml-5">
                    <p class="text-gray-500 text-sm">Cancellation Rate</p>
                    <div class="flex items-center">
                        <h3 class="font-bold text-xl text-gray-900" id="stats-cancelled">--</h3>
                        <span class="ml-2 text-sm text-red-600" id="stats-cancelled-trend">--</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

  

    <!-- Appointments Table -->
    <div id="appointments-table" class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto relative">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="py-3 px-6">Date & Time</th>
                        <th scope="col" class="py-3 px-6">Client</th>
                        <th scope="col" class="py-3 px-6">Service</th>
                        <th scope="col" class="py-3 px-6">Duration</th>
                        <th scope="col" class="py-3 px-6">Price</th>
                        <th scope="col" class="py-3 px-6">Status</th>
                        <th scope="col" class="py-3 px-6">Actions</th>
                    </tr>
                </thead>
                <tbody id="appointments-body">
                    <!-- Loading state -->
                    <tr>
                        <td colspan="7" class="py-20">
                            <div class="appointment-loader flex flex-col justify-center items-center">
                                <div class="barber-pole-loader mb-4">
                                    <div class="pole-stripe"></div>
                                </div>
                                <div class="text-center">
                                    <div class="text-gray-600 mb-2">Loading appointments...</div>
                                    <div class="loading-dots">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Pagination -->
    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 rounded-lg shadow mt-4">
        <div class="flex-1 flex justify-between sm:hidden">
            <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Previous
            </button>
            <button class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Next
            </button>
        </div>
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Showing <span id="pagination-start">1</span> to <span id="pagination-end">10</span> of <span id="pagination-total">--</span> results
                </p>
            </div>
            <div>
                <nav id="pagination" class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                    <!-- Pagination will be inserted here -->
                </nav>
            </div>
        </div>
    </div>
</div>


<!-- Cancel Appointment Modal -->
<div id="cancelModal" class="fixed inset-0 z-50 overflow-auto hidden bg-black bg-opacity-50 flex items-center justify-center">
    <div class="relative bg-white rounded-lg shadow-xl max-w-md w-full mx-4 sm:mx-auto">
        <div class="absolute top-0 right-0 pt-4 pr-4">
            <button onclick="closeCancelModal()" type="button" class="close-modal text-gray-400 hover:text-gray-500 focus:outline-none">
                <span class="sr-only">Close</span>
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <div class="p-6">
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-red-100 mx-auto mb-4">
                <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            <h3 class="text-lg font-medium text-center text-gray-900 mb-6">Cancel Appointment</h3>
            
            <input type="hidden" id="cancel-appointment-id">
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Reason for cancellation</label>
                <select id="cancel-reason" class="w-full rounded-md border border-gray-300 py-2 pl-3 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-500">
                    <option value="client_request">Client requested</option>
                    <option value="barber_unavailable">Barber unavailable</option>
                    <option value="scheduling_conflict">Scheduling conflict</option>
                    <option value="maintenance">Shop maintenance</option>
                    <option value="other">Other</option>
                </select>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Additional notes</label>
                <textarea id="cancel-notes" rows="3" class="w-full rounded-md border border-gray-300 py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-500" placeholder="Add any additional details..."></textarea>
            </div>
            
            <div class="mb-6">
                <div class="flex items-center">
                    <input id="notify-client-cancel" type="checkbox" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded" checked>
                    <label for="notify-client-cancel" class="ml-2 block text-sm text-gray-700">
                        Notify client about cancellation
                    </label>
                </div>
            </div>
            
            <div class="flex justify-end space-x-3">
                <button onclick="closeCancelModal()" type="button" class="close-modal inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    Cancel
                </button>
                <button type="button" id="confirm-cancel" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Confirm Cancellation
                </button>
            </div>
        </div>
    </div>
</div>

<!-- approve Modal -->
<!-- Approve Appointment Modal -->
<div id="approveModal" class="fixed inset-0 z-50 overflow-auto hidden bg-black bg-opacity-50 flex items-center justify-center">
    <div class="relative bg-white rounded-lg shadow-xl max-w-md w-full mx-4 sm:mx-auto">
        <div class="absolute top-0 right-0 pt-4 pr-4">
            <button onclick="closeApproveModal()" type="button" class="close-modal text-gray-400 hover:text-gray-500 focus:outline-none">
                <span class="sr-only">Close</span>
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <div class="p-6">
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-green-100 mx-auto mb-4">
                <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h3 class="text-lg font-medium text-center text-gray-900 mb-6">Approve Appointment</h3>
            
            <input type="hidden" id="approve-appointment-id">
            
            <div class="mb-4">
                <p class="text-sm text-gray-600 mb-4">Are you sure you want to approve this appointment? An email confirmation will be sent to the client.</p>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Add a note (optional)</label>
                    <textarea id="approve-notes" rows="3" class="w-full rounded-md border border-gray-300 py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-500" placeholder="Add any additional information for the client..."></textarea>
                </div>
            </div>
            
            <div class="mb-6">
                <div class="flex items-center">
                    <input id="notify-client-approve" type="checkbox" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded" checked>
                    <label for="notify-client-approve" class="ml-2 block text-sm text-gray-700">
                        Send confirmation email to client
                    </label>
                </div>
            </div>
            
            <div class="flex justify-end space-x-3">
                <button onclick="closeApproveModal()" type="button" class="close-modal inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    Cancel
                </button>
                <button onclick="confirmApproval()" type="button" id="confirm-approve" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Confirm Approval
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Reschedule Appointment Modal -->
<div id="rescheduleModal" class="fixed inset-0 z-50 overflow-auto hidden bg-black bg-opacity-50 flex items-center justify-center">
    <div class="relative bg-white rounded-lg shadow-xl max-w-md w-full mx-4 sm:mx-auto">
        <div class="absolute top-0 right-0 pt-4 pr-4">
            <button onclick="closeRescheduleModal()" type="button" class="close-modal text-gray-400 hover:text-gray-500 focus:outline-none">
                <span class="sr-only">Close</span>
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <div class="p-6">
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-amber-100 mx-auto mb-4">
                <svg class="h-6 w-6 text-amber-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <h3 class="text-lg font-medium text-center text-gray-900 mb-6">Reschedule Appointment</h3>
            
            <input type="hidden" id="reschedule-appointment-id">
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">New Date</label>
                <input type="date" onchange="getWorkingHouers()" id="reschedule-date" min="{{ date('Y-m-d') }}" class="w-full rounded-md border border-gray-300 py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-500">
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">New Time</label>
                <select id="reschedule-time" class="w-full rounded-md border border-gray-300 py-2 pl-3 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-500">
                    <option value="">Select a time...</option>
                    <!-- Will be populated dynamically based on available slots -->
                </select>
                <p class="mt-2 text-xs text-gray-500">Available time slots will appear after selecting a date.</p>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Reason for rescheduling (optional)</label>
                <textarea id="reschedule-reason" rows="3" class="w-full rounded-md border border-gray-300 py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-500" placeholder="Add any additional details..."></textarea>
            </div>
            
            <div class="mb-6">
                <div class="flex items-center">
                    <input id="notify-client-reschedule" type="checkbox" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded" checked>
                    <label for="notify-client-reschedule" class="ml-2 block text-sm text-gray-700">
                        Notify client about rescheduling
                    </label>
                </div>
            </div>
            
            <div class="flex justify-end space-x-3">
                <button onclick="closeRescheduleModal()" type="button" class="close-modal inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    Cancel
                </button>
                <button type="button" id="confirm-reschedule" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                    Confirm Reschedule
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('additional_scripts')
<script>
    

    // Open cancel appointment modal
    function openCancelModal(appointmentId) {
        const modal = document.getElementById('cancelModal');
        document.getElementById('cancel-appointment-id').value = appointmentId;
        
        // Reset the form
        document.getElementById('cancel-reason').value = 'client_request';
        document.getElementById('cancel-notes').value = '';
        document.getElementById('notify-client-cancel').checked = true;
        
        // Show the modal
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    

    // Close cancel modal
    function closeCancelModal() {
        const modal = document.getElementById('cancelModal');
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }

    // Confirm cancellation handler
    document.getElementById('confirm-cancel').addEventListener('click', confirmCancellation);

    // Cancel the appointment
    async function confirmCancellation() {
        const appointmentId = document.getElementById('cancel-appointment-id').value;
        const reason = document.getElementById('cancel-reason').value;
        const notes = document.getElementById('cancel-notes').value;
        const notifyClient = document.getElementById('notify-client-cancel').checked;
        
        try {
            const response = await fetch(`/api/Booking/cancel/${appointmentId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    cancel_reason: reason,
                    notes: notes,
                    notify_client: notifyClient
                })
            });
            
            if (response.ok) {
                // Close modal and refresh appointments
                closeCancelModal();
                loadAppointments();
                loadStatistics();
                
                // Show success message
                showToast('Appointment cancelled successfully', 'success');
            } else {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Failed to cancel appointment');
            }
        } catch (error) {
            console.error('Error cancelling appointment:', error);
            showToast('Failed to cancel appointment: ' + error.message, 'error');
        }
    }

    // Simple toast notification system
    function showToast(message, type = 'info') {
        // Create toast container if it doesn't exist
        let toastContainer = document.getElementById('toast-container');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.id = 'toast-container';
            toastContainer.className = 'fixed bottom-4 right-4 z-50 flex flex-col gap-2';
            document.body.appendChild(toastContainer);
        }
        
        // Create toast element
        const toast = document.createElement('div');
        toast.className = `p-4 rounded-md shadow-md text-white max-w-xs animate-slide-in flex items-center ${
            type === 'success' ? 'bg-green-600' : 
            type === 'error' ? 'bg-red-600' : 
            'bg-blue-600'
        }`;
        
        // Add icon based on type
        let icon = '';
        if (type === 'success') {
            icon = '<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
        } else if (type === 'error') {
            icon = '<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';
        } else {
            icon = '<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
        }
        
        toast.innerHTML = `
            <div class="flex items-center">
                ${icon}
                <span>${message}</span>
            </div>
        `;
        
        // Add to container
        toastContainer.appendChild(toast);
        
        // Remove after delay
        setTimeout(() => {
            toast.classList.add('animate-fade-out');
            setTimeout(() => {
                toastContainer.removeChild(toast);
                if (toastContainer.childNodes.length === 0) {
                    document.body.removeChild(toastContainer);
                }
            }, 300);
        }, 3000);
    }

    // Add these CSS animations to your styles section
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slide-in {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        @keyframes fade-out {
            from { opacity: 1; }
            to { opacity: 0; }
        }
        
        .animate-slide-in {
            animation: slide-in 0.3s ease forwards;
        }
        
        .animate-fade-out {
            animation: fade-out 0.3s ease forwards;
        }
    `;
    document.head.appendChild(style);

    // Global variables
    let appointments = [];
    let currentPage = 1;
    let totalPages = 1;
    let filterOptions = {};

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Load initial appointments
        loadAppointments();
        
        // Set up event listeners
        document.getElementById('refresh-btn').addEventListener('click', () => loadAppointments());
        document.getElementById('clear-filters').addEventListener('click', clearFilters);
        
        // Set up filter event listeners
        const filters = document.querySelectorAll('.filter');
        filters.forEach(filter => {
            filter.addEventListener('change', () => {
                currentPage = 1;
                applyFilters();
            });
        });
        
        // Search input listener
        const searchInput = document.getElementById('search-input');
        searchInput.addEventListener('input', debounce(() => {
            currentPage = 1;
            applyFilters();
        }, 500));
        
        
        document.getElementById('save-status').addEventListener('click', saveStatusChange);
    });

    // Fetch appointments from API
    async function loadAppointments() {
        showLoader();
        
        try {
            // Construct URL with filters and pagination
            let url = '/api/barberShop/{{ auth()->user()->barberShop->id }}/appointments?page=' + currentPage;
            
            // Add filters to URL if they exist
            if (filterOptions.status) url += `&status=${filterOptions.status}`;
            if (filterOptions.date) url += `&date_filter=${filterOptions.date}`;
            if (filterOptions.service) url += `&service_id=${filterOptions.service}`;
            if (filterOptions.search) url += `&search=${filterOptions.search}`;
            
            const response = await fetch(url);
            const data = await response.json();
                // console.log(data);
                
            // Update appointments array
            appointments = data.data;
            console.log(appointments);
            
            currentPage = data.current_page;
            totalPages = data.last_page;
            
            // Render appointments and pagination
            renderAppointments();
            renderPagination(data);
            
        } catch (error) {
            console.error('Error loading appointments:', error);
            showErrorMessage();
        }
    }

    // Show loading indicator
    function showLoader() {
        const tableBody = document.getElementById('appointments-body');
        tableBody.innerHTML = `
        <tr>
            <td colspan="7" class="py-20">
                <div class="appointment-loader flex flex-col justify-center items-center">
                    <div class="barber-pole-loader mb-4">
                        <div class="pole-stripe"></div>
                    </div>
                    <div class="text-center">
                        <div class="text-gray-600 mb-2">Loading appointments...</div>
                        <div class="loading-dots">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </td>
        </tr>`;
    }

    // Show error message
    function showErrorMessage() {
        const tableBody = document.getElementById('appointments-body');
        tableBody.innerHTML = `
        <tr>
            <td colspan="7" class="py-10">
                <div class="text-center">
                    <svg class="mx-auto h-12 w-12 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="mt-2 text-gray-700">Failed to load appointments. Please try again.</p>
                    <button onclick="loadAppointments()" class="mt-3 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        Retry
                    </button>
                </div>
            </td>
        </tr>`;
    }

    // Render appointments in the table
    function renderAppointments() {
        const tableBody = document.getElementById('appointments-body');
        
        if (appointments.length === 0) {
            tableBody.innerHTML = `
            <tr>
                <td colspan="7" class="py-10">
                    <div class="text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="mt-2 text-gray-700">No appointments found</p>
                    </div>
                </td>
            </tr>`;
            return;
        }
        
        let html = '';
        
        appointments.forEach(appointment => {
            // Format date and time
            const dateTime = new Date(appointment.booking_date);
            const formattedDate = dateTime.toLocaleDateString('en-US', {
                weekday: 'short',
                month: 'short', 
                day: 'numeric'
            });
            const timeStr = appointment.time;
            const [hours, minutes] = timeStr.split(':');
            const timeObj = new Date();
            timeObj.setHours(hours, minutes, 0);
            
            const formattedTime = timeObj.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit'
            });
            // Determine status badge
            let statusBadge;
            switch (appointment.status) {
                case 'confirmed':
                    statusBadge = '<span class="status-badge px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Confirmed</span>';
                    break;
                case 'pending':
                    statusBadge = '<span class="status-badge px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Pending</span>';
                    break;
                case 'completed':
                    statusBadge = '<span class="status-badge px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">Completed</span>';
                    break;
                case 'cancelled':
                    statusBadge = '<span class="status-badge px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Cancelled</span>';
                    break;
                case 'no-show':
                    statusBadge = '<span class="status-badge px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">No Show</span>';
                    break;
                default:
                    statusBadge = '<span class="status-badge px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">Unknown</span>';
            }
            
            html += `
            <tr class="bg-white border-b hover:bg-gray-50" data-id="${appointment.id}">
                <td class="py-4 px-6">
                    <div class="font-medium text-gray-900">${formattedDate}</div>
                    <div class="text-gray-500">${formattedTime}</div>
                </td>
                <td class="py-4 px-6">
                    <div class="font-medium text-gray-900">${appointment.user.name}</div>
                    <div class="text-gray-500">${appointment.user.phone || ''}</div>
                </td>
                <td class="py-4 px-6">
                    <div class="flex flex-col space-y-1">
                        ${appointment.services.map(service => 
                            `<div class="flex items-center">
                                <span class="inline-block w-2 h-2 rounded-full bg-primary-500 mr-2"></span>
                                <span class="text-gray-800">${service.name}</span>
                             </div>`
                        ).join('')}
                    </div>
                </td>
                <td class="py-4 px-6">
                    ${appointment.services.reduce((total, service) => total + parseInt(service.duration || 0), 0)} min
                </td>
                <td class="py-4 px-6">$${appointment.services.reduce((total,service)=>total+parseInt(service.price || 0),0)}</td>
                <td class="py-4 px-6">
                    ${statusBadge}
                </td>
                <td class="py-4 px-6">
                    <div class="flex space-x-2">
                        <div class="flex space-x-2">
                            ${appointment.status.toLowerCase() === 'pending' ? `
                                <button onclick="openApproveAppointmentModal(${appointment.id})" class="text-green-600 hover:text-green-900" title="Approve Appointment">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </button>
                            ` : ''}
                            ${appointment.status.toLowerCase() === 'pending' || appointment.status.toLowerCase() === 'confirmed' ? `
                                <button onclick="openCancelModal(${appointment.id})" class="text-red-600 hover:text-red-900" title="Cancel Appointment">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                                <button onclick="openRescheduleModal(${appointment.id})" class="text-amber-600 hover:text-amber-900" title="Reschedule Appointment">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </button>
                            ` : ''}

                        </div>
                    </div>
                </td>
            </tr>`;
        });
        
        tableBody.innerHTML = html;
    }

    // Render pagination
    function renderPagination(data) {
        const paginationContainer = document.getElementById('pagination');
        const paginationStart = document.getElementById('pagination-start');
        const paginationEnd = document.getElementById('pagination-end');
        const paginationTotal = document.getElementById('pagination-total');
        
        // Update pagination text
        paginationStart.textContent = data.from || 0;
        paginationEnd.textContent = data.to || 0;
        paginationTotal.textContent = data.total;
        
        // Clear previous pagination
        paginationContainer.innerHTML = '';
        
        // Previous page button
        const prevButton = document.createElement('button');
        prevButton.classList.add('relative', 'inline-flex', 'items-center', 'px-2', 'py-2', 'rounded-l-md', 'border', 'border-gray-300', 'bg-white', 'text-sm', 'font-medium', 'text-gray-500');
        prevButton.innerHTML = '<span class="sr-only">Previous</span><svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>';
        
        if (data.current_page > 1) {
            prevButton.classList.add('hover:bg-gray-50');
            prevButton.addEventListener('click', () => goToPage(data.current_page - 1));
        } else {
            prevButton.classList.add('cursor-not-allowed');
        }
        
        paginationContainer.appendChild(prevButton);
        
        // Page numbers
        let startPage = Math.max(1, data.current_page - 2);
        let endPage = Math.min(data.last_page, startPage + 4);
        
        if (endPage - startPage < 4 && data.last_page > 5) {
            startPage = Math.max(1, endPage - 4);
        }
        
        for (let i = startPage; i <= endPage; i++) {
            const pageButton = document.createElement('button');
            pageButton.classList.add('relative', 'inline-flex', 'items-center', 'px-4', 'py-2', 'border', 'text-sm', 'font-medium');
            
            if (i === data.current_page) {
                pageButton.classList.add('z-10', 'bg-primary-50', 'border-primary-500', 'text-primary-600');
            } else {
                pageButton.classList.add('bg-white', 'border-gray-300', 'text-gray-700', 'hover:bg-gray-50');
                pageButton.addEventListener('click', () => goToPage(i));
            }
            
            pageButton.textContent = i;
            paginationContainer.appendChild(pageButton);
        }
        
        // Next page button
        const nextButton = document.createElement('button');
        nextButton.classList.add('relative', 'inline-flex', 'items-center', 'px-2', 'py-2', 'rounded-r-md', 'border', 'border-gray-300', 'bg-white', 'text-sm', 'font-medium', 'text-gray-500');
        nextButton.innerHTML = '<span class="sr-only">Next</span><svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>';
        
        if (data.current_page < data.last_page) {
            nextButton.classList.add('hover:bg-gray-50');
            nextButton.addEventListener('click', () => goToPage(data.current_page + 1));
        } else {
            nextButton.classList.add('cursor-not-allowed');
        }
        
        paginationContainer.appendChild(nextButton);
    }

    // Go to specific page
    function goToPage(page) {
        currentPage = page;
        loadAppointments();
    }

    // Apply filters
    function applyFilters() {
        const statusFilter = document.getElementById('status-filter').value;
        const dateFilter = document.getElementById('date-filter').value;
        const serviceFilter = document.getElementById('service-filter').value;
        const searchInput = document.getElementById('search-input').value;
        
        filterOptions = {
            status: statusFilter,
            date: dateFilter,
            service: serviceFilter,
            search: searchInput
        };
        
        loadAppointments();
    }

    // Clear filters
    function clearFilters() {
        document.getElementById('status-filter').value = '';
        document.getElementById('date-filter').value = '';
        document.getElementById('service-filter').value = '';
        document.getElementById('search-input').value = '';
        
        filterOptions = {};
        currentPage = 1;
        loadAppointments();
    }

    

    // Utility function for debouncing
    function debounce(func, wait) {
        let timeout;
        return function() {
            const context = this;
            const args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                func.apply(context, args);
            }, wait);
        };
    }

    function openApproveAppointmentModal(appointmentId){
        const modal = document.getElementById('approveModal');
        document.getElementById('approve-appointment-id').value = appointmentId;
        
        // Reset the form
        document.getElementById('approve-notes').value = '';
        document.getElementById('notify-client-approve').checked = true;
        
        // Show the modal
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

    }
    function closeApproveModal(){
        const modal = document.getElementById('approveModal');
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }

    // Confirm approval handler

    // Approve the appointment
    async function confirmApproval() {
        const appointmentId = document.getElementById('approve-appointment-id').value;
        const notes = document.getElementById('approve-notes').value;
        const notifyClient = document.getElementById('notify-client-approve').checked;
        
        try {
            const response = await fetch(`/api/Booking/approve/${appointmentId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    notes: notes,
                    notify_client: notifyClient
                })
            });
            
            if (response.ok) {
                // Close modal and refresh appointments
                closeApproveModal();
                loadAppointments();
                loadStatistics()
                
                // Show success message
                showToast('Appointment approved successfully', 'success');
            } else {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Failed to approve appointment');
            }
        } catch (error) {
            console.error('Error approving appointment:', error);
            showToast('Failed to approve appointment: ' + error.message, 'error');
        }
    }
    //rescheduleModal
    function openRescheduleModal(appointmentId){
        const modal = document.getElementById('rescheduleModal');
        document.getElementById('reschedule-appointment-id').value = appointmentId;
        
        // Reset the form
        document.getElementById('reschedule-date').value = '';
        document.getElementById('reschedule-time').value = '';
        document.getElementById('reschedule-reason').value = '';
        document.getElementById('notify-client-reschedule').checked = true;
        
        // Show the modal
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

    }
    async function getWorkingHouers() {
        const appointment_date = document.getElementById('reschedule-date').value;
        const reschedule_time = document.getElementById('reschedule-time');
        const response = await fetch('/api/barberShop/{{ auth()->user()->barberShop->id }}/working-hours');
        const data = await response.json();
        
        
        let dayName = new Date(appointment_date).toLocaleString('en-US', { weekday: 'long' }).toLowerCase();
        let workingHours = data[dayName];
        console.log(workingHours);
        if(workingHours.closed){
            reschedule_time.innerHTML = `<option value="">Closed</option>`;
            reschedule_time.disabled = true;
        }
        else{
            reschedule_time.innerHTML = `<option value="">Select a time...</option>`;
            reschedule_time.disabled = false;
            let startTime = workingHours.open.split(':');
            let endTime = workingHours.close.split(':');
            let startHour = parseInt(startTime[0]);
            let endHour = parseInt(endTime[0]);
            let startMinute = parseInt(startTime[1]);
            let endMinute = parseInt(endTime[1]);
            
            for(let i=startHour; i<=endHour; i++){
                for(let j = 0; j < 60; j += 30) {
                    // Skip times after closing hour
                    if(i === endHour && j > endMinute) continue;
                    
                    // Format hours and minutes with leading zeros
                    let hour = i.toString().padStart(2, '0');
                    let minute = j.toString().padStart(2, '0');
                    let time = `${hour}:${minute}`;
                    
                    // Add option to select element
                    reschedule_time.innerHTML += `<option value="${time}">${time}</option>`;
                }
            }
        }
    }
    function closeRescheduleModal(){
        const modal = document.getElementById('rescheduleModal');
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }
    // Confirm reschedule handler
    document.getElementById('confirm-reschedule').addEventListener('click', confirmReschedule);

    // Reschedule the appointment
    async function confirmReschedule() {
        const appointmentId = document.getElementById('reschedule-appointment-id').value;
        const date = document.getElementById('reschedule-date').value;
        const time = document.getElementById('reschedule-time').value;
        const reason = document.getElementById('reschedule-reason').value;
        const notifyClient = document.getElementById('notify-client-reschedule').checked;

        try {
            const response = await fetch(`/api/Booking/reschedule/${appointmentId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    new_date: date,
                    new_time: time,
                    notes: reason,
                    notify_client: notifyClient
                })
            });
            
            if (response.ok) {
                // Close modal and refresh appointments
                closeRescheduleModal();
                loadAppointments();
                loadStatistics();
                
                // Show success message
                showToast('Appointment rescheduled successfully', 'success');
            } else {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Failed to reschedule appointment');
            }
        } catch (error) {
            console.error('Error rescheduling appointment:', error);
            showToast('Failed to reschedule appointment: ' + error.message, 'error');
        }
    }


    //Statistics

    document.addEventListener('DOMContentLoaded', function() {
            loadStatistics();
        });
        
        async function loadStatistics() {
            try {
                const response = await fetch('/api/booking/{{ auth()->user()->barberShop->id }}/statistics');
                if (response.ok) {
                    const data = await response.json();
                    console.log('Statistics data:', data);
                    
                    updateStatistics(data);
                } else {
                    console.error('Failed to load statistics');
                }
            } catch (error) {
                console.error('Error loading statistics:', error);
            }
        }
        
        function updateStatistics(data) {
            // Update total appointments
            document.getElementById('stats-pending').textContent = data.pending_bookings || 0;
            
            // Update upcoming appointments
            document.getElementById('stats-upcoming').textContent = data.confirmed_bookings || 0;
            
            // Update completed appointments
            document.getElementById('stats-completed').textContent = data.completed_bookings || 0;
            
            // Update cancellation rate
            const cancelRate = (parseFloat(data.cancelled_bookings_rate) || 0).toFixed(2);
            document.getElementById('stats-cancelled').textContent = cancelRate + '%';
        }
        // Row hover effect with animation
        document.addEventListener('mouseover', function(e) {
            const row = e.target.closest('tr[data-id]');
            if (row) {
                row.classList.add('scale-transition');
                setTimeout(() => row.classList.remove('scale-transition'), 300);
            }
        });

        // Add animations for status changes
        function animateStatusChange(element) {
            element.classList.add('status-change-animation');
            setTimeout(() => element.classList.remove('status-change-animation'), 1000);
        }

        // Animated counter for statistics
        function animateCounter(element, targetValue) {
            const duration = 1500;
            const startValue = parseInt(element.textContent) || 0;
            const increment = targetValue > startValue;
            const change = Math.abs(targetValue - startValue);
            const stepTime = Math.abs(Math.floor(duration / change));
            
            let currentValue = startValue;
            const counter = setInterval(() => {
                currentValue = increment ? currentValue + 1 : currentValue - 1;
                element.textContent = currentValue;
                
                if ((increment && currentValue >= targetValue) || 
                    (!increment && currentValue <= targetValue)) {
                    clearInterval(counter);
                    element.textContent = targetValue;
                }
            }, stepTime);
        }

        // Enhance loading animation with pulse effect
        function enhanceLoaderAnimation() {
            const loader = document.querySelector('.barber-pole-loader');
            if (loader) {
                loader.classList.add('pulse-effect');
            }
        }

        // Add refresh animation
        document.getElementById('refresh-btn').addEventListener('click', function() {
            this.classList.add('spin-once');
            setTimeout(() => this.classList.remove('spin-once'), 1000);
        });

        // Add to your existing style element
        const animationStyles = document.createElement('style');
        animationStyles.textContent = `
            .scale-transition {
                animation: row-scale 0.3s ease-out;
            }
            
            @keyframes row-scale {
                0% { transform: scale(1); }
                50% { transform: scale(1.01); }
                100% { transform: scale(1); }
            }
            
            .status-change-animation {
                animation: status-pulse 1s ease-in-out;
            }
            
            @keyframes status-pulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.2); }
                100% { transform: scale(1); }
            }
            
            .spin-once {
                animation: spin-button 1s ease-in-out;
            }
            
            @keyframes spin-button {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
            
            .pulse-effect {
                animation: pulse 2s infinite;
            }
            
            @keyframes pulse {
                0% { box-shadow: 0 0 0 0 rgba(66, 153, 225, 0.7); }
                70% { box-shadow: 0 0 0 10px rgba(66, 153, 225, 0); }
                100% { box-shadow: 0 0 0 0 rgba(66, 153, 225, 0); }
            }
            
            .appointment-row-enter {
                animation: fadeIn 0.5s ease-in-out;
            }
            
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
        `;
        document.head.appendChild(animationStyles);

        // Apply animations when rendering appointments
        const originalRenderAppointments = renderAppointments;
        renderAppointments = function() {
            originalRenderAppointments();
            
            // Add entrance animation to rows
            const rows = document.querySelectorAll('#appointments-body tr');
            rows.forEach((row, index) => {
                setTimeout(() => {
                    row.classList.add('appointment-row-enter');
                }, index * 100);
            });
            
            // Animate statistics
            const statElements = [
                document.getElementById('stats-pending'),
                document.getElementById('stats-upcoming'),
                document.getElementById('stats-completed')
            ];
            
            statElements.forEach(el => {
                if (el && el.textContent !== '--') {
                    animateCounter(el, parseInt(el.textContent));
                }
            });
            
            // Enhanced loader
            enhanceLoaderAnimation();
        };
        

</script>
@endsection