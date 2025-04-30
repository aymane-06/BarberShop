@extends('layouts.barber')

@section('additional_styles')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #7c3aed, #4f46e5);
        --secondary-gradient: linear-gradient(135deg, #4338ca, #3b82f6);
        --accent-gradient: linear-gradient(135deg, #ec4899, #8b5cf6);
        --success-gradient: linear-gradient(135deg, #10b981, #059669);
        --warning-gradient: linear-gradient(135deg, #f59e0b, #d97706);
        --shadow-sm: 0 4px 6px rgba(0, 0, 0, 0.05);
        --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        --shadow-hover: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        --glass-effect: rgba(255, 255, 255, 0.2);
        --glass-border: rgba(255, 255, 255, 0.3);
    }
    
    body {
        font-family: 'Poppins', sans-serif;
        scroll-behavior: smooth;
        background-color: #f8f9fc;
    }
    
    .dashboard-gradient {
        background: linear-gradient(145deg, #f8faff 0%, #f0f4ff 100%);
        min-height: 100vh;
    }
    
    .dashboard-header-gradient {
        background: var(--primary-gradient);
        border-radius: 0 0 2rem 2rem;
        box-shadow: var(--shadow-lg);
        position: relative;
        z-index: 10;
        padding: 2.5rem 0;
    }
    
    .dashboard-header-gradient::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: .7; }
    }
    
    .fade-in {
        animation: fadeIn 0.5s ease-out forwards;
        opacity: 0;
    }
    
    @keyframes fadeIn {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }
    
    .slide-up {
        animation: slideUp 0.5s ease-out forwards;
        opacity: 0;
    }
    
    @keyframes slideUp {
        0% { transform: translateY(20px); opacity: 0; }
        100% { transform: translateY(0); opacity: 1; }
    }
    
    .slide-in-right {
        animation: slideInRight 0.5s ease-out forwards;
        opacity: 0;
    }
    
    @keyframes slideInRight {
        0% { transform: translateX(20px); opacity: 0; }
        100% { transform: translateX(0); opacity: 1; }
    }
    
    .scale-in {
        animation: scaleIn 0.5s ease-out forwards;
        opacity: 0;
    }
    
    @keyframes scaleIn {
        0% { transform: scale(0.9); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }
    
    .bounce-in {
        animation: bounceIn 0.8s cubic-bezier(0.215, 0.610, 0.355, 1.000) forwards;
        opacity: 0;
    }
    #calendar {
    min-height: 800px;  /* Add this */
    margin-top: 2rem;
    padding: 15px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }
    
    @keyframes bounceIn {
        0% { transform: scale(0.3); opacity: 0; }
        50% { transform: scale(1.05); opacity: 1; }
        70% { transform: scale(0.9); }
        100% { transform: scale(1); opacity: 1; }
    }
    
    .rotate-in {
        animation: rotateIn 0.6s ease-out forwards;
        opacity: 0;
    }
    
    @keyframes rotateIn {
        0% { transform: rotate(-15deg) scale(0.9); opacity: 0; }
        100% { transform: rotate(0) scale(1); opacity: 1; }
    }
    
    .count-up {
        visibility: visible;
    }
    
    .time-slot {
        transition: all 0.2s ease;
    }
    
    .time-slot:hover {
        background-color: #ede9fe;
        border-color: #7c3aed;
    }
    
    .time-slot.selected {
        background-color: #7c3aed;
        color: white;
        border-color: #5b21b6;
    }
    
    .time-slot.booked {
        background-color: #f3f4f6;
        color: #9ca3af;
        border-color: #d1d5db;
        cursor: not-allowed;
    }
    
    .progress-ring {
        transform: rotate(-90deg);
        transform-origin: 50% 50%;
        transition: all 0.5s ease;
    }
    
    .progress-ring-circle {
        stroke-dasharray: 251.2;
        stroke-dashoffset: 251.2;
        transition: stroke-dashoffset 1s ease;
    }
    
    .floating-note {
        animation: float 6s ease-in-out infinite;
    }
    
    @keyframes float {
        0% { transform: translateY(0px) rotate(-3deg); }
        50% { transform: translateY(-15px) rotate(2deg); }
        100% { transform: translateY(0px) rotate(-3deg); }
    }
    
    .chart-container {
        height: 250px;
    }
    
    .customer-avatar {
        transition: transform 0.3s ease;
    }
    
    .customer-avatar:hover {
        transform: scale(1.1);
    }
    
    .tab-panel {
        display: none;
    }
    
    .tab-panel.active {
        display: block;
        animation: fadeTabIn 0.5s ease-out forwards;
    }
    
    @keyframes fadeTabIn {
        0% { opacity: 0; transform: translateX(10px); }
        100% { opacity: 1; transform: translateX(0); }
    }
    
    .service-tag {
        transition: all 0.2s ease;
    }
    
    .service-tag:hover {
        transform: translateY(-2px);
    }
    
    .notification-badge {
        animation: pulse 2s infinite;
    }
    
    .quick-action {
        transition: all 0.3s ease;
    }
    
    .quick-action:hover {
        background-color: #7c3aed;
        color: white;
        transform: translateY(-2px);
    }
    
    .sticky-sidebar {
        position: sticky;
        top: 84px;
    }
    
    .shimmer {
        background: linear-gradient(90deg, 
            rgba(255,255,255,0) 0%, 
            rgba(255,255,255,0.2) 50%, 
            rgba(255,255,255,0) 100%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
    }
    
    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }
    
    .icon-spin {
        animation: spin 10s linear infinite;
    }
    
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    :root {
            --primary-color: #3f51b5;
            --secondary-color: #4caf50;
            --task-color: #ff9800;
        }

        body {
            font-family: 'Segoe UI', system-ui;
            padding: 20px;
            background: #f5f7fa;
        }

        .calendar-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.05);
            padding: 24px;
        }

        .view-buttons {
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
        }

        .view-button {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .view-button:hover {
            opacity: 0.9;
        }

        .fc-event {
    /* Keep important properties */
    border: none !important;
    border-radius: 6px !important;
    padding: 4px 8px !important;
    font-size: 0.9em !important;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05) !important;
}

        .fc-event-task {
    background: var(--task-color) !important;
    border-left: 4px solid #e65100 !important;
}

        .fc-event-appointment {
    background: var(--primary-color) !important;
    border-left: 4px solid #283593 !important;
}

        .fc-daygrid-day-number {
            color: #666;
            font-weight: 500;
        }

        .fc-today-button {
            background: var(--secondary-color) !important;
            border-color: var(--secondary-color) !important;
        }
</style>
@endsection

@section('content')
<div class="dashboard-gradient min-h-screen">
    <!-- Dashboard Header -->
    <div class="dashboard-header-gradient text-white">
        <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-4 md:space-y-0">
                <div class="slide-up" style="animation-delay: 0.1s">
                    <h1 class="text-2xl md:text-3xl font-bold">Welcome back, {{ Auth::user()->name }}</h1>
                    <p class="text-primary-100">Manage your barbershop services and appointments</p>
                </div>
                <div class="flex items-center space-x-4 slide-up" style="animation-delay: 0.2s">
                    <a href="/barber/new-appointment" class="bg-white text-primary-700 px-4 py-2 rounded-md font-medium hover:bg-primary-50 transition-all transform hover:scale-105">
                        <i class="fas fa-plus mr-2"></i> New Appointment
                    </a>
                    <div class="relative">
                        <button class="p-2 rounded-full bg-primary-500 hover:bg-primary-400 transition-colors">
                            <i class="fas fa-bell"></i>
                        </button>
                        <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center notification-badge">3</span>
                    </div>
                </div>
            </div>
            
            <!-- Quick Stats Row -->
            <div id="stats" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">
                
            </div>
        </div>
    </div>
    
    <!-- Main Dashboard Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col xl:flex-row gap-8">
            <!-- Left Column - 2/3 Width -->
            <div class="xl:w-2/3 space-y-8">
                <!-- Analytics Overview Chart -->
                <div class="bg-white rounded-xl shadow-sm p-6 card-hover fade-in" style="animation-delay: 0.2s">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Performance Overview</h2>
                            <p class="text-gray-500 text-sm">Appointments & Revenue</p>
                        </div>
                        <div>
                            <select id="chartDateSelctor" class="text-sm border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                                <option value="Week">This Week</option>
                                <option value="Month">This Month</option>
                                <option value="Year">This Year</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="chart-container">
                        <canvas id="performanceChart"></canvas>
                    </div>
                </div>

                <!--  Schedule -->
                <div id="calendar"></div>
                
                
                
                <!-- Recent Reviews -->
                <div class="bg-white rounded-xl shadow-sm p-6 card-hover slide-up" style="animation-delay: 0.3s">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Recent Reviews</h2>
                            <p class="text-gray-500 text-sm">What clients are saying</p>
                        </div>
                        <a href="/barber/reviews" class="text-primary-600 hover:text-primary-700 text-sm font-medium">View All</a>
                    </div>
                    
                    <!-- Reviews List -->
                    <div class="space-y-6">
                        <!-- Review 1 -->
                        <div class="border-b border-gray-100 pb-6 fade-in" style="animation-delay: 0.4s">
                            <div class="flex justify-between">
                                <div class="flex items-center">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Alex Smith" class="w-10 h-10 rounded-full mr-3 customer-avatar">
                                    <div>
                                        <h4 class="font-medium text-gray-800">Alex Smith</h4>
                                        <div class="flex items-center mt-1">
                                            <div class="flex mr-2">
                                                <i class="fas fa-star text-yellow-400"></i>
                                                <i class="fas fa-star text-yellow-400"></i>
                                                <i class="fas fa-star text-yellow-400"></i>
                                                <i class="fas fa-star text-yellow-400"></i>
                                                <i class="fas fa-star text-yellow-400"></i>
                                            </div>
                                            <span class="text-xs text-gray-500">2 days ago</span>
                                        </div>
                                    </div>
                                </div>
                                <button class="text-gray-400 hover:text-primary-600 transition-colors">
                                    <i class="fas fa-reply"></i>
                                </button>
                            </div>
                            <p class="mt-3 text-gray-600">
                                Best haircut I've had in years! James really understood what I wanted and delivered perfectly.
                                The atmosphere is great and everyone is very friendly. Will definitely be coming back!
                            </p>
                        </div>
                        
                        <!-- Review 2 -->
                        <div class="border-b border-gray-100 pb-6 fade-in" style="animation-delay: 0.6s">
                            <div class="flex justify-between">
                                <div class="flex items-center">
                                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Emma Davis" class="w-10 h-10 rounded-full mr-3 customer-avatar">
                                    <div>
                                        <h4 class="font-medium text-gray-800">Emma Davis</h4>
                                        <div class="flex items-center mt-1">
                                            <div class="flex mr-2">
                                                <i class="fas fa-star text-yellow-400"></i>
                                                <i class="fas fa-star text-yellow-400"></i>
                                                <i class="fas fa-star text-yellow-400"></i>
                                                <i class="fas fa-star text-yellow-400"></i>
                                                <i class="far fa-star text-yellow-400"></i>
                                            </div>
                                            <span class="text-xs text-gray-500">1 week ago</span>
                                        </div>
                                    </div>
                                </div>
                                <button class="text-gray-400 hover:text-primary-600 transition-colors">
                                    <i class="fas fa-reply"></i>
                                </button>
                            </div>
                            <p class="mt-3 text-gray-600">
                                Great service and very professional. My husband loves his new style! The hot towel treatment
                                was a nice touch. Would recommend to anyone looking for a quality barbershop.
                            </p>
                        </div>
                        
                        <!-- Review 3 -->
                        <div class="fade-in" style="animation-delay: 0.8s">
                            <div class="flex justify-between">
                                <div class="flex items-center">
                                    <img src="https://randomuser.me/api/portraits/men/67.jpg" alt="Ryan Johnson" class="w-10 h-10 rounded-full mr-3 customer-avatar">
                                    <div>
                                        <h4 class="font-medium text-gray-800">Ryan Johnson</h4>
                                        <div class="flex items-center mt-1">
                                            <div class="flex mr-2">
                                                <i class="fas fa-star text-yellow-400"></i>
                                                <i class="fas fa-star text-yellow-400"></i>
                                                <i class="fas fa-star text-yellow-400"></i>
                                                <i class="fas fa-star text-yellow-400"></i>
                                                <i class="fas fa-star-half-alt text-yellow-400"></i>
                                            </div>
                                            <span class="text-xs text-gray-500">2 weeks ago</span>
                                        </div>
                                    </div>
                                </div>
                                <button class="text-gray-400 hover:text-primary-600 transition-colors">
                                    <i class="fas fa-reply"></i>
                                </button>
                            </div>
                            <p class="mt-3 text-gray-600">
                                First time visiting and I was not disappointed. The beard trim was perfect and the 
                                staff were very friendly. Will definitely be returning for my next
                                appointment.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Add Review Button -->
                    <div class="mt-6 text-center">
                        <button class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition-colors inline-flex items-center hover:scale-105 transform transition-transform duration-300">
                            <i class="fas fa-plus mr-2"></i> Add Review
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Right Column - 1/3 Width -->
            <div class="xl:w-1/3 space-y-8">
                <!-- Add your right column content here -->
            </div>
        </div>
    </div>
</div>

<!-- AppointmentDetailsModal -->
<div id="appointmentDetailsModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity" id="modal-backdrop"></div>
        
        <div class="relative bg-white w-full max-w-md rounded-xl shadow-2xl p-6 transform transition-all scale-in">
            <!-- Modal Header -->
            <div class="flex justify-between items-center mb-5 pb-3 border-b border-gray-100">
                <h3 class="text-xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-calendar-check text-primary-600 mr-2"></i>
                    <span id="modal-title">Appointment Details</span>
                </h3>
                <button type="button" id="closeModalBtn" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            
            <!-- Modal Content -->
            <div class="space-y-4">
                <div class="bg-primary-50 p-3 rounded-lg">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-gray-600">Booking Reference:</span>
                        <span id="modal-bookingRef" class="font-mono text-sm bg-white py-1 px-2 rounded border border-primary-200"></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-600">Status:</span>
                        <span id="modal-status" class="py-1 px-3 text-xs font-medium rounded-full"></span>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Client</label>
                        <div id="modal-client" class="font-medium text-gray-800"></div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                        <div id="modal-email" class="font-medium text-gray-800 text-sm"></div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Date & Time</label>
                        <div id="modal-datetime" class="font-medium text-gray-800"></div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Duration</label>
                        <div id="modal-duration" class="font-medium text-gray-800"></div>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Services</label>
                    <div id="modal-services" class="flex flex-wrap gap-2"></div>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Amount</label>
                        <div id="modal-amount" class="font-medium text-gray-800 text-lg"></div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Payment</label>
                        <div id="modal-payment" class="font-medium"></div>
                    </div>
                </div>
            </div>
            
            <!-- Modal Footer -->
            <div class="mt-6 flex justify-between">
                <div class="flex space-x-2">
                    <button type="button" id="cancelAppointmentBtn" class="py-2 px-4 border border-red-200 text-red-600 hover:bg-red-50 rounded-md text-sm font-medium transition-colors flex items-center">
                        <i class="fas fa-times mr-2"></i> Cancel Appointment
                    </button>
                
                
                    <button type="button" id="CompleteAppointmentBtn" class="py-2 px-4 border border-green-200 text-green-600 hover:bg-green-50 rounded-md text-sm font-medium transition-colors flex items-center">
                        <i class="fas fa-check mr-2"></i> Completed
                    </button>
                    <button type="button" id="sendReminderBtn" class="py-2 px-4 bg-primary-600 text-white hover:bg-primary-700 rounded-md text-sm font-medium transition-colors flex items-center">
                        <i class="fas fa-bell mr-2"></i> Send Reminder
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('additional_scripts')
<!-- FullCalendar & Chart.js CDN -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/date-fns@2.29.3/dist/date-fns.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Chart.js Setup -->
<script>
    let performanceChart = null;
    async function fetchChartData($date='Week') {
        const response = await fetch(`/api/barberShop/{{ auth()->user()->barberShop->id }}/weekly-revenue?date=${$date}`);
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        let data= await response.json();
        console.log(data);

        let labels=data.days ?? data.months;
        let revenues=data.revenues;
        let appointments=data.appointments;
        let ctx = document.getElementById('performanceChart');

        if(performanceChart) {
            performanceChart.destroy();
        }

    if (ctx) {
        performanceChart = new Chart(ctx.getContext('2d'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Appointments',
                        data: appointments,
                        backgroundColor: 'rgba(124, 58, 237, 0.1)',
                        borderColor: 'rgba(124, 58, 237, 1)',
                        borderWidth: 2,
                        tension: 0.3
                    },
                    {
                        label: 'Revenue',
                        data: revenues,
                        backgroundColor: 'rgba(29, 185, 84, 0.1)',
                        borderColor: 'rgba(29, 185, 84, 1)',
                        borderWidth: 2,
                        tension: 0.3
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
}
document.getElementById('chartDateSelctor').addEventListener('change', function() {
        const selectedValue = this.value;
        // Update the chart with the selected value
        fetchChartData(selectedValue);
    });


    fetchChartData();

    
    
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        async function barberShopDashboardStats(){
            await fetch(`/api/barberShop/dashboard/{{ auth()->user()->barberShop->id }}`)
                .then(response => response.json())
                .then(data => {
                    // Update stats section with data from API
                    const statsEl = document.getElementById('stats');
                    
                    // Format data
                    const avgRating = parseFloat(data.avgRating).toFixed(1);
                    const newClients = data.newClients;
                    const newClientsPercentage = data.newClientsPercentage;
                    const todaysTotalBooking = data.todaysTotalBooking;
                    const todaysTotalBookingPercentage = data.todaysTotalBookingPercentage;
                    const weeklyRevenue = parseFloat(data.weeklyRevenue).toFixed(0);
                    const weeklyRevenuePercentage = data.weeklyRevenuePercentage;
                    
                    // Build stats HTML
                    statsEl.innerHTML = `
                        <!-- Stats Card 1: Today's Appointments -->
                        <div class="bg-gradient-to-br from-indigo-600 to-violet-700 rounded-xl p-4 text-white stat-card shadow-lg transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:from-indigo-500 hover:to-violet-600" style="animation-delay: 0.3s">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm text-indigo-200 font-medium">Today's Appointments</p>
                                    <h3 class="text-2xl font-bold count-up mt-1" data-target="${todaysTotalBooking}">${todaysTotalBooking}</h3>
                                </div>
                                <div class="p-3 rounded-full bg-white/20 backdrop-blur-sm shadow-inner transition-all duration-300 hover:bg-white/30 hover:scale-110">
                                    <i class="fas fa-calendar-day text-xl text-white"></i>
                                </div>
                            </div>
                            <div class="mt-4 text-xs flex items-center">
                                <span class="${todaysTotalBookingPercentage >= 0 ? 'bg-green-500/30 text-green-200' : 'bg-red-500/30 text-red-200'} px-2 py-1 rounded-full">
                                    <i class="fas fa-arrow-${todaysTotalBookingPercentage >= 0 ? 'up' : 'down'} mr-1"></i>${Math.abs(todaysTotalBookingPercentage)}%
                                </span>
                                <span class="ml-2 text-indigo-100">from yesterday</span>
                            </div>
                        </div>
                        
                        <!-- Stats Card 2: Weekly Revenue -->
                        <div class="bg-gradient-to-br from-fuchsia-600 to-purple-700 rounded-xl p-4 text-white stat-card shadow-lg transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:from-fuchsia-500 hover:to-purple-600" style="animation-delay: 0.4s">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm text-fuchsia-200 font-medium">Weekly Revenue</p>
                                    <h3 class="text-2xl font-bold count-up mt-1" data-target="${weeklyRevenue}">€${weeklyRevenue}</h3>
                                </div>
                                <div class="p-3 rounded-full bg-white/20 backdrop-blur-sm shadow-inner transition-all duration-300 hover:bg-white/30 hover:scale-110">
                                    <i class="fas fa-euro-sign text-xl text-white"></i>
                                </div>
                            </div>
                            <div class="mt-4 text-xs flex items-center">
                                <span class="${weeklyRevenuePercentage >= 0 ? 'bg-green-500/30 text-green-200' : 'bg-red-500/30 text-red-200'} px-2 py-1 rounded-full">
                                    <i class="fas fa-arrow-${weeklyRevenuePercentage >= 0 ? 'up' : 'down'} mr-1"></i>${Math.abs(weeklyRevenuePercentage)}%
                                </span>
                                <span class="ml-2 text-fuchsia-100">from last week</span>
                            </div>
                        </div>
                        
                        <!-- Stats Card 3: New Clients -->
                        <div class="bg-gradient-to-br from-blue-600 to-violet-700 rounded-xl p-4 text-white stat-card shadow-lg transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:from-blue-500 hover:to-violet-600" style="animation-delay: 0.5s">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm text-blue-200 font-medium">New Clients</p>
                                    <h3 class="text-2xl font-bold count-up mt-1" data-target="${newClients}">${newClients}</h3>
                                </div>
                                <div class="p-3 rounded-full bg-white/20 backdrop-blur-sm shadow-inner transition-all duration-300 hover:bg-white/30 hover:scale-110">
                                    <i class="fas fa-user-plus text-xl text-white"></i>
                                </div>
                            </div>
                            <div class="mt-4 text-xs flex items-center">
                                <span class="${newClientsPercentage >= 0 ? 'bg-green-500/30 text-green-200' : 'bg-red-500/30 text-red-200'} px-2 py-1 rounded-full">
                                    <i class="fas fa-arrow-${newClientsPercentage >= 0 ? 'up' : 'down'} mr-1"></i>${Math.abs(newClientsPercentage)}%
                                </span>
                                <span class="ml-2 text-blue-100">this month</span>
                            </div>
                        </div>
                        
                        <!-- Stats Card 4: Rating -->
                        <div class="bg-gradient-to-br from-purple-600 to-indigo-700 rounded-xl p-4 text-white stat-card shadow-lg transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:from-purple-500 hover:to-indigo-600" style="animation-delay: 0.6s">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm text-purple-200 font-medium">Overall Rating</p>
                                    <h3 class="text-2xl font-bold mt-1">${avgRating}/5</h3>
                                </div>
                                <div class="p-3 rounded-full bg-white/20 backdrop-blur-sm shadow-inner transition-all duration-300 hover:bg-white/30 hover:scale-110">
                                    <i class="fas fa-star text-xl text-white"></i>
                                </div>
                            </div>
                            <div class="mt-4 text-xs flex items-center">
                                <div class="flex space-x-0.5 text-yellow-300">
                                    ${generateStarRating(avgRating)}
                                </div>
                            </div>
                        </div>
                    `;
                    
                    
                    // Helper function to generate star icons based on rating
                    function generateStarRating(rating) {
                        let stars = '';
                        const fullStars = Math.floor(rating);
                        const hasHalfStar = rating % 1 >= 0.5;
                        
                        // Add full stars
                        for (let i = 0; i < fullStars; i++) {
                            stars += '<i class="fas fa-star"></i>';
                        }
                        
                        // Add half star if needed
                        if (hasHalfStar) {
                            stars += '<i class="fas fa-star-half-alt"></i>';
                        }
                        
                        // Add empty stars
                        const emptyStars = 5 - fullStars - (hasHalfStar ? 1 : 0);
                        for (let i = 0; i < emptyStars; i++) {
                            stars += '<i class="far fa-star"></i>';
                        }
                        
                        return stars;
                    }
                    
                })
                .catch(error => console.error('Error fetching dashboard stats:', error));
        }
        barberShopDashboardStats();
        

        async function getConfirmedAppointments() {
            try {
                const response = await fetch('/api/barberShop/{{ $barberShop->id }}/confirmed-appointments');
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                const appointments = await response.json();

                const events = appointments.map(appointment => {
                    const startDate = appointment.booking_date.split('T')[0];
                    const startTime = appointment.time;
                    const startDateTime = `${startDate}T${startTime}`;
                    const start = new Date(startDateTime);
                    const end = new Date(start.getTime() + (appointment.duration * 60000));

                    const serviceNames = appointment.services.map(service => service.name).join(', ');
                    const clientName = appointment.user ? appointment.user.name : 'Client';

                    return {
                        id: appointment.id,
                        title: `${serviceNames} - ${clientName}`,
                        start: startDateTime,
                        end: end.toISOString(),
                        backgroundColor: '#3f51b5',
                        borderColor: '#283593',
                        textColor: '#ffffff',
                        extendedProps: {
                            type: 'appointment',
                            bookingRef: appointment.booking_reference,
                            clientName: clientName,
                            clientEmail: appointment.user ? appointment.user.email : '',
                            barberName: appointment.barber_name,
                            services: appointment.services,
                            amount: appointment.amount,
                            paymentStatus: appointment.payment_status,
                            duration: appointment.duration
                        }
                    };
                });

                initializeCalendar(events);
            } catch (error) {
                console.error('Error fetching appointments:', error);
                initializeCalendar([]);
            }
        }

        function initializeCalendar(events) {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridDay',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                editable: false,
                events: events,
                eventDidMount: function (info) {
                    info.el.classList.add('fc-event-appointment');
                },
                eventClick: function (info) {
                    const event = info.event;
                    if (!event.extendedProps) return;
                    openAppointmentDetailsModal(event);
                }
            });

            calendar.render();
        }

        function openAppointmentDetailsModal(event) {
            const modal = document.getElementById('appointmentDetailsModal');
            const modalBackdrop = document.getElementById('modal-backdrop');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const CompleteAppointmentBtn = document.getElementById('CompleteAppointmentBtn');
            const cancelAppointmentBtn = document.getElementById('cancelAppointmentBtn');
            const sendReminderBtn = document.getElementById('sendReminderBtn');

            function setModalTextContent(id, text) {
                const el = document.getElementById(id);
                if (el) el.textContent = text;
            }

            function setModalStatus(status) {
                const el = document.getElementById('modal-status');
                el.textContent = status;
                el.className = 'py-1 px-3 text-xs font-medium rounded-full';
                if (status === 'paid') el.classList.add('bg-green-100', 'text-green-800');
                else if (status === 'pending') el.classList.add('bg-yellow-100', 'text-yellow-800');
                else el.classList.add('bg-red-100', 'text-red-800');
            }

            function populateModalServices(services) {
                const el = document.getElementById('modal-services');
                el.innerHTML = '';
                services.forEach(service => {
                    const span = document.createElement('span');
                    span.className = 'bg-primary-100 text-primary-800 text-xs py-1 px-2 rounded-full service-tag';
                    span.textContent = service.name;
                    el.appendChild(span);
                });
            }

            function setModalPaymentStatus(status) {
                const container = document.getElementById('modal-payment');
                container.innerHTML = '';
                const div = document.createElement('div');
                div.className = 'flex items-center';
                const dot = document.createElement('span');
                dot.className = 'w-2 h-2 rounded-full mr-2';
                if (status === 'paid') dot.classList.add('bg-green-500');
                else if (status === 'pending') dot.classList.add('bg-yellow-500');
                else dot.classList.add('bg-red-500');
                div.appendChild(dot);
                div.append(status.charAt(0).toUpperCase() + status.slice(1));
                container.appendChild(div);
            }

            setModalTextContent('modal-title', 'Appointment Details');
            setModalTextContent('modal-bookingRef', event.extendedProps.bookingRef);
            setModalStatus(event.extendedProps.paymentStatus);
            setModalTextContent('modal-client', event.extendedProps.clientName);
            setModalTextContent('modal-email', event.extendedProps.clientEmail);

            const time = event.start.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            const date = event.start.toLocaleDateString([], { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
            setModalTextContent('modal-datetime', `${date}, ${time}`);
            setModalTextContent('modal-duration', `${event.extendedProps.duration} minutes`);
            populateModalServices(event.extendedProps.services);
            setModalTextContent('modal-amount', `€${event.extendedProps.amount}`);
            setModalPaymentStatus(event.extendedProps.paymentStatus);

            modal.classList.remove('hidden');

            closeModalBtn.onclick = modalBackdrop.onclick = () => modal.classList.add('hidden');

            CompleteAppointmentBtn.onclick = () => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to mark this appointment as completed?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#7c3aed',
                    cancelButtonColor: '#d1d5db',
                    confirmButtonText: 'Yes, complete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/api/Booking/complete/${event.id}`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            Swal.fire(
                                'Completed!',
                                'The appointment has been marked as completed.',
                                'success'
                            );
                            event.remove();
                            barberShopDashboardStats();
                            fetchChartData();
                            modal.classList.add('hidden');
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire(
                                'Error!',
                                'An error occurred while trying to mark the appointment as completed',
                                'error'
                            );
                        });
                    }
                });
            };

            cancelAppointmentBtn.onclick = () => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to cancel this appointment?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#7c3aed',
                    cancelButtonColor: '#d1d5db',
                    confirmButtonText: 'Yes, cancel it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/api/Booking/cancel/${event.id}`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({ notify_client: true })
                        })
                        .then(response => response.json())
                        .then(data => {
                            Swal.fire(
                                'Cancelled!',
                                'The appointment has been cancelled.',
                                'success'
                            );
                            event.remove();
                            modal.classList.add('hidden');
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire(
                                'Error!',
                                'An error occurred while trying to cancel the appointment.',
                                'error'
                            );
                        });
                    }
                });

                
            };

            sendReminderBtn.onclick = () => {
                Swal.fire({
                    title: 'Send Appointment Reminder',
                    html: `
                        <textarea id="reminderMessage" class="w-full p-2 border border-gray-300 rounded-md" 
                        placeholder="Add a custom message (optional)" rows="4"></textarea>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#7c3aed',
                    cancelButtonColor: '#d1d5db',
                    confirmButtonText: 'Send Reminder'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const message = document.getElementById('reminderMessage').value;
                        
                        Swal.fire({
                            title: 'Sending...',
                            text: 'Please wait while we send the reminder',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        
                        fetch(`/api/barber/appointments/remind/${event.id}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({ notes: message })
                        })
                        .then(response => response.json())
                        .then(data => {
                            Swal.close();
                                Swal.fire(
                                    'Reminder Sent!',
                                    'The client has been notified about their appointment.',
                                    'success'
                                );
                            
                        })
                        .catch(error => {
                            console.log('Error:', error);
                            Swal.fire(
                                'Error!',
                                'An error occurred while sending the reminder.',
                                'error'
                            );
                        });
                    }
                });
                
            };
        }

        getConfirmedAppointments();
    });
</script>

    
   


</script>

@endsection
                