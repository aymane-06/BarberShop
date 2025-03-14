@extends('layouts.barber')

@section('additional_styles')
<style>
    body {
        font-family: 'Poppins', sans-serif;
        scroll-behavior: smooth;
    }
    
    .dashboard-gradient {
        background: linear-gradient(145deg, #ffffff 0%, #f5f3ff 100%);
    }
    
    .dashboard-header-gradient {
        background: linear-gradient(135deg, rgba(109, 40, 217, 0.95) 0%, rgba(91, 33, 182, 0.8) 100%);
    }
    
    .card-hover {
        transition: all 0.3s ease;
    }
    
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    
    .stat-card {
        overflow: hidden;
        position: relative;
        z-index: 1;
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: -10px;
        right: -10px;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: rgba(124, 58, 237, 0.1);
        z-index: -1;
    }
    
    .pulse {
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
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">
                <!-- Stats Card 1: Today's Appointments -->
                <div class="bg-gradient-to-br from-indigo-600 to-violet-700 rounded-xl p-4 text-white stat-card shadow-lg transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:from-indigo-500 hover:to-violet-600" style="animation-delay: 0.3s">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-indigo-200 font-medium">Today's Appointments</p>
                            <h3 class="text-2xl font-bold count-up mt-1" data-target="8">0</h3>
                        </div>
                        <div class="p-3 rounded-full bg-white/20 backdrop-blur-sm shadow-inner transition-all duration-300 hover:bg-white/30 hover:scale-110">
                            <i class="fas fa-calendar-day text-xl text-white"></i>
                        </div>
                    </div>
                    <div class="mt-4 text-xs flex items-center">
                        <span class="bg-green-500/30 px-2 py-1 rounded-full text-green-200"><i class="fas fa-arrow-up mr-1"></i>12%</span>
                        <span class="ml-2 text-indigo-100">from yesterday</span>
                    </div>
                </div>
                
                <!-- Stats Card 2: Weekly Revenue -->
                <div class="bg-gradient-to-br from-fuchsia-600 to-purple-700 rounded-xl p-4 text-white stat-card shadow-lg transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:from-fuchsia-500 hover:to-purple-600" style="animation-delay: 0.4s">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-fuchsia-200 font-medium">Weekly Revenue</p>
                            <h3 class="text-2xl font-bold count-up mt-1" data-target="1250">0</h3>
                        </div>
                        <div class="p-3 rounded-full bg-white/20 backdrop-blur-sm shadow-inner transition-all duration-300 hover:bg-white/30 hover:scale-110">
                            <i class="fas fa-euro-sign text-xl text-white"></i>
                        </div>
                    </div>
                    <div class="mt-4 text-xs flex items-center">
                        <span class="bg-green-500/30 px-2 py-1 rounded-full text-green-200"><i class="fas fa-arrow-up mr-1"></i>8%</span>
                        <span class="ml-2 text-fuchsia-100">from last week</span>
                    </div>
                </div>
                
                <!-- Stats Card 3: New Clients -->
                <div class="bg-gradient-to-br from-blue-600 to-violet-700 rounded-xl p-4 text-white stat-card shadow-lg transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:from-blue-500 hover:to-violet-600" style="animation-delay: 0.5s">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-blue-200 font-medium">New Clients</p>
                            <h3 class="text-2xl font-bold count-up mt-1" data-target="15">0</h3>
                        </div>
                        <div class="p-3 rounded-full bg-white/20 backdrop-blur-sm shadow-inner transition-all duration-300 hover:bg-white/30 hover:scale-110">
                            <i class="fas fa-user-plus text-xl text-white"></i>
                        </div>
                    </div>
                    <div class="mt-4 text-xs flex items-center">
                        <span class="bg-green-500/30 px-2 py-1 rounded-full text-green-200"><i class="fas fa-arrow-up mr-1"></i>24%</span>
                        <span class="ml-2 text-blue-100">this month</span>
                    </div>
                </div>
                
                <!-- Stats Card 4: Rating -->
                <div class="bg-gradient-to-br from-purple-600 to-indigo-700 rounded-xl p-4 text-white stat-card shadow-lg transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:from-purple-500 hover:to-indigo-600" style="animation-delay: 0.6s">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-purple-200 font-medium">Overall Rating</p>
                            <h3 class="text-2xl font-bold mt-1"><span class="count-up" data-target="4">0</span>.8/5</h3>
                        </div>
                        <div class="p-3 rounded-full bg-white/20 backdrop-blur-sm shadow-inner transition-all duration-300 hover:bg-white/30 hover:scale-110">
                            <i class="fas fa-star text-xl text-white"></i>
                        </div>
                    </div>
                    <div class="mt-4 text-xs flex items-center">
                        <div class="flex space-x-0.5 text-yellow-300">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
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
                            <select class="text-sm border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                                <option>This Week</option>
                                <option>Last Week</option>
                                <option>This Month</option>
                                <option>Last Month</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="chart-container">
                        <canvas id="performanceChart"></canvas>
                    </div>
                </div>

                <!-- Today's Schedule -->
                <div class="bg-white rounded-xl shadow-sm p-6 card-hover rotate-in" id="schedule-card">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Today's Schedule</h2>
                            <p class="text-gray-500 text-sm">{{ now()->format('l, F j, Y') }}</p>
                        </div>
                        <div class="flex space-x-2">
                            <button class="p-2 text-gray-500 hover:text-primary-600 transition-colors rounded-lg hover:bg-gray-100">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="p-2 text-gray-500 hover:text-primary-600 transition-colors rounded-lg hover:bg-gray-100">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Timeline Schedule -->
                    <div class="relative overflow-x-auto">
                        <div class="flex min-h-[500px]">
                            <!-- Time Indicators -->
                            <div class="flex-shrink-0 w-16 flex flex-col text-sm text-gray-500">
                                <div class="h-20 flex items-center">9:00</div>
                                <div class="h-20 flex items-center">10:00</div>
                                <div class="h-20 flex items-center">11:00</div>
                                <div class="h-20 flex items-center">12:00</div>
                                <div class="h-20 flex items-center">13:00</div>
                                <div class="h-20 flex items-center">14:00</div>
                                <div class="h-20 flex items-center">15:00</div>
                                <div class="h-20 flex items-center">16:00</div>
                                <div class="h-20 flex items-center">17:00</div>
                            </div>
                            
                            <!-- Schedule Content -->
                            <div class="flex-grow border-l border-gray-200 pl-4 relative">
                                <!-- Current time indicator -->
                                <div class="absolute left-0 right-0 flex items-center" style="top: 120px;">
                                    <div class="h-0.5 w-3 bg-red-500"></div>
                                    <div class="h-0.5 flex-grow bg-red-500 bg-opacity-60 relative shimmer">
                                        <div class="absolute -top-2 -left-2.5 w-5 h-5 rounded-full bg-red-500 border-2 border-white pulse"></div>
                                    </div>
                                    <span class="text-xs bg-red-500 text-white px-2 py-1 rounded">Now</span>
                                </div>
                                
                                <!-- Appointment 1 -->
                                <div class="absolute left-4 right-4" style="top: 30px;">
                                    <div class="bg-primary-100 border-l-4 border-primary-600 rounded-r-lg p-3 slide-in-right" style="animation-delay: 0.3s">
                                        <div class="flex justify-between items-start">
                                            <div class="flex-grow min-w-0">
                                                <h4 class="font-semibold text-primary-800 truncate">John Doe</h4>
                                                <p class="text-xs text-primary-600">9:30 - 10:15</p>
                                                <div class="flex flex-wrap items-center mt-1 gap-2">
                                                    <span class="bg-primary-200 text-primary-700 text-xs px-2 py-0.5 rounded service-tag">Haircut</span>
                                                    <span class="bg-primary-200 text-primary-700 text-xs px-2 py-0.5 rounded service-tag">Beard Trim</span>
                                                </div>
                                            </div>
                                            <div class="flex space-x-1 flex-shrink-0 ml-2">
                                                <button class="p-1.5 text-gray-500 hover:text-primary-600 hover:bg-primary-50 rounded-full transition-colors">
                                                    <i class="fas fa-phone-alt"></i>
                                                </button>
                                                <button class="p-1.5 text-gray-500 hover:text-primary-600 hover:bg-primary-50 rounded-full transition-colors">
                                                    <i class="fas fa-comment"></i>
                                                </button>
                                                <button class="p-1.5 text-gray-500 hover:text-primary-600 hover:bg-primary-50 rounded-full transition-colors">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Appointment 2 -->
                                <div class="absolute left-4 right-4" style="top: 180px;">
                                    <div class="bg-green-100 border-l-4 border-green-600 rounded-r-lg p-3 slide-in-right" style="animation-delay: 0.5s">
                                        <div class="flex justify-between items-start">
                                            <div class="flex-grow min-w-0">
                                                <h4 class="font-semibold text-green-800 truncate">Mike Johnson</h4>
                                                <p class="text-xs text-green-600">12:00 - 13:00</p>
                                                <div class="flex flex-wrap items-center mt-1 gap-2">
                                                    <span class="bg-green-200 text-green-700 text-xs px-2 py-0.5 rounded service-tag">Full Service</span>
                                                    <span class="bg-green-200 text-green-700 text-xs px-2 py-0.5 rounded service-tag">Hair Coloring</span>
                                                </div>
                                            </div>
                                            <div class="flex space-x-1 flex-shrink-0 ml-2">
                                                <button class="p-1.5 text-gray-500 hover:text-green-600 hover:bg-green-50 rounded-full transition-colors">
                                                    <i class="fas fa-phone-alt"></i>
                                                </button>
                                                <button class="p-1.5 text-gray-500 hover:text-green-600 hover:bg-green-50 rounded-full transition-colors">
                                                    <i class="fas fa-comment"></i>
                                                </button>
                                                <button class="p-1.5 text-gray-500 hover:text-green-600 hover:bg-green-50 rounded-full transition-colors">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Appointment 3 -->
                                <div class="absolute left-4 right-4" style="top: 260px;">
                                    <div class="bg-blue-100 border-l-4 border-blue-600 rounded-r-lg p-3 slide-in-right" style="animation-delay: 0.7s">
                                        <div class="flex justify-between items-start">
                                            <div class="flex-grow min-w-0">
                                                <h4 class="font-semibold text-blue-800 truncate">Sarah Williams</h4>
                                                <p class="text-xs text-blue-600">14:30 - 15:15</p>
                                                <div class="flex flex-wrap items-center mt-1 gap-2">
                                                    <span class="bg-blue-200 text-blue-700 text-xs px-2 py-0.5 rounded service-tag">Haircut</span>
                                                    <span class="bg-blue-200 text-blue-700 text-xs px-2 py-0.5 rounded service-tag">Hair Styling</span>
                                                </div>
                                            </div>
                                            <div class="flex space-x-1 flex-shrink-0 ml-2">
                                                <button class="p-1.5 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-full transition-colors">
                                                    <i class="fas fa-phone-alt"></i>
                                                </button>
                                                <button class="p-1.5 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-full transition-colors">
                                                    <i class="fas fa-comment"></i>
                                                </button>
                                                <button class="p-1.5 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-full transition-colors">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add Appointment Button -->
                    <div class="mt-6 text-center">
                        <button class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition-colors inline-flex items-center hover:scale-105 transform transition-transform duration-300">
                            <i class="fas fa-plus mr-2"></i> Add Appointment
                        </button>
                    </div>
                </div>
                
                
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
@endsection

@section('additional_scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Performance Overview Chart
    var ctx = document.getElementById('performanceChart').getContext('2d');
    var performanceChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Appointments',
                data: [12, 19, 3, 5, 2, 3, 7],
                backgroundColor: 'rgba(124, 58, 237, 0.1)',
                borderColor: 'rgba(124, 58, 237, 1)',
                borderWidth: 2,
                tension: 0.3
            }, {
                label: 'Revenue',
                data: [100, 200, 150, 300, 200, 250, 150],
                backgroundColor: 'rgba(29, 185, 84, 0.1)',
                borderColor: 'rgba(29, 185, 84, 1)',
                borderWidth: 2,
                tension: 0.3
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
                