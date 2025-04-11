@extends('layouts.admin')

@section('additional_styles')
<!-- Keep existing styles -->
@endsection

@section('content')
<div class="px-4 py-6 sm:px-6 lg:px-8">
    <!-- Dashboard Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Admin Dashboard</h1>
        <p class="text-gray-600">Welcome back, <span class="font-semibold">{{ Auth::user()->name }}</span>! Here's an overview of the platform.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Users Card -->
        <div class="card-gradient rounded-xl shadow-md p-6 stat-card card-hover">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Users</p>
                    <h3 class="text-2xl font-bold text-gray-900">2,547</h3>
                    <p class="text-xs text-green-600 mt-2 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        12.5% from last month
                    </p>
                </div>
                <div class="bg-primary-100 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Barbershops Card -->
        <div class="card-gradient rounded-xl shadow-md p-6 stat-card card-hover">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Registered Barbershops</p>
                    <h3 class="text-2xl font-bold text-gray-900">128</h3>
                    <p class="text-xs text-green-600 mt-2 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        8.2% from last month
                    </p>
                </div>
                <div class="bg-green-100 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Platform Revenue Card -->
        <div class="card-gradient rounded-xl shadow-md p-6 stat-card card-hover">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Platform Revenue (Month)</p>
                    <h3 class="text-2xl font-bold text-gray-900">$14,825</h3>
                    <p class="text-xs text-green-600 mt-2 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        23.1% from last month
                    </p>
                </div>
                <div class="bg-indigo-100 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- New Registrations Card -->
        <div class="card-gradient rounded-xl shadow-md p-6 stat-card card-hover">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">New Registrations (Today)</p>
                    <h3 class="text-2xl font-bold text-gray-900">12</h3>
                    <p class="text-xs text-gray-500 mt-2">
                        8 users, 4 barbershops
                    </p>
                </div>
                <div class="bg-amber-100 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Charts -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Revenue Chart -->
            <div class="bg-white rounded-xl shadow-md p-6 chart-container">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Platform Growth</h3>
                    <div>
                        <select class="text-sm border-gray-300 rounded-md shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-20">
                            <option>Last 7 days</option>
                            <option>Last 14 days</option>
                            <option>Last 30 days</option>
                            <option>Last 90 days</option>
                        </select>
                    </div>
                </div>
                <div class="w-full h-72">
                    <!-- Canvas for Chart.js -->
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

            <!-- Barbershop Categories -->
            <div class="bg-white rounded-xl shadow-md p-6 slide-in-right" style="animation-delay: 0.3s;">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Barbershop Analytics</h3>
                    <div>
                        <button class="text-primary-600 hover:text-primary-800 font-medium text-sm">
                            View All
                        </button>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Pie Chart -->
                    <div class="h-56">
                        <canvas id="appointmentPieChart"></canvas>
                    </div>
                    <!-- Stats -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-500 mb-1">Average Rating</p>
                            <p class="text-2xl font-bold text-gray-900">4.7</p>
                            <div class="mt-2 relative pt-1">
                                <div class="overflow-hidden h-1 text-xs flex bg-gray-200 rounded">
                                    <div style="width: 94%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-primary-500"></div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-500 mb-1">Verification Rate</p>
                            <p class="text-2xl font-bold text-gray-900">86%</p>
                            <div class="mt-2 relative pt-1">
                                <div class="overflow-hidden h-1 text-xs flex bg-gray-200 rounded">
                                    <div style="width: 86%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-500"></div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-500 mb-1">Avg. Services</p>
                            <p class="text-2xl font-bold text-gray-900">8.2</p>
                            <p class="text-xs text-gray-500 mt-2">
                                per barbershop
                            </p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-500 mb-1">Top Location</p>
                            <p class="text-2xl font-bold text-gray-900">NYC</p>
                            <p class="text-xs text-gray-500 mt-2">
                                21% of shops
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="space-y-8">
            <!-- Recent Registrations -->
            <div class="bg-white rounded-xl shadow-md p-6 pulse">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Registrations</h3>
                    <div>
                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Live Updates</span>
                    </div>
                </div>
                <div class="space-y-4 max-h-96 overflow-y-auto">
                    <!-- Registration Items -->
                    <div class="flex items-center p-3 hover:bg-gray-50 rounded-lg transition-colors cursor-pointer activity-item" style="animation-delay: 0.1s;">
                        <div class="bg-primary-100 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">John Smith</p>
                            <p class="text-xs text-gray-500">New User Registration</p>
                        </div>
                        <div class="ml-auto">
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">2h ago</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center p-3 hover:bg-gray-50 rounded-lg transition-colors cursor-pointer activity-item" style="animation-delay: 0.2s;">
                        <div class="bg-amber-100 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">Classic Cuts</p>
                            <p class="text-xs text-gray-500">New Barbershop Registration</p>
                        </div>
                        <div class="ml-auto">
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">4h ago</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center p-3 hover:bg-gray-50 rounded-lg transition-colors cursor-pointer activity-item" style="animation-delay: 0.3s;">
                        <div class="bg-primary-100 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">Emily Johnson</p>
                            <p class="text-xs text-gray-500">New User Registration</p>
                        </div>
                        <div class="ml-auto">
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">6h ago</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center p-3 hover:bg-gray-50 rounded-lg transition-colors cursor-pointer activity-item" style="animation-delay: 0.4s;">
                        <div class="bg-amber-100 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">Modern Fades</p>
                            <p class="text-xs text-gray-500">New Barbershop Registration</p>
                        </div>
                        <div class="ml-auto">
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">8h ago</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center p-3 hover:bg-gray-50 rounded-lg transition-colors cursor-pointer activity-item" style="animation-delay: 0.5s;">
                        <div class="bg-primary-100 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">Sarah Miller</p>
                            <p class="text-xs text-gray-500">New User Registration</p>
                        </div>
                        <div class="ml-auto">
                            <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">12h ago</span>
                        </div>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <a href="#" class="text-primary-600 hover:text-primary-800 text-sm font-medium">View all registrations →</a>
                </div>
            </div>

            <!-- Performance Target -->
            <div class="bg-white rounded-xl shadow-md p-6 slide-in-right" style="animation-delay: 0.6s;">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Platform Goals</h3>
                    <div>
                        <button class="text-primary-600 hover:text-primary-800 font-medium text-sm">
                            Edit Goals
                        </button>
                    </div>
                </div>
                <div class="space-y-6">
                    <!-- Revenue Goal -->
                    <div>
                        <div class="flex justify-between mb-2">
                            <p class="text-sm font-medium text-gray-700">Monthly Revenue</p>
                            <p class="text-sm font-semibold text-gray-900">$14,825 / $15,000</p>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-primary-600 h-2.5 rounded-full" style="width: 98%"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">98.8% of monthly target</p>
                    </div>

                    <!-- New Users Goal -->
                    <div>
                        <div class="flex justify-between mb-2">
                            <p class="text-sm font-medium text-gray-700">New Users</p>
                            <p class="text-sm font-semibold text-gray-900">178 / 200</p>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-green-500 h-2.5 rounded-full" style="width: 89%"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">89% of monthly target</p>
                    </div>

                    <!-- Barbershop Registrations -->
                    <div>
                        <div class="flex justify-between mb-2">
                            <p class="text-sm font-medium text-gray-700">New Barbershops</p>
                            <p class="text-sm font-semibold text-gray-900">24 / 30</p>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-amber-500 h-2.5 rounded-full" style="width: 80%"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">80% of monthly target</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-md p-6 scale-in">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                <div class="grid grid-cols-2 gap-2">
                    <button class="flex flex-col items-center justify-center p-4 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        <span class="text-sm text-gray-900 font-medium">Add User</span>
                    </button>
                    <button class="flex flex-col items-center justify-center p-4 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <span class="text-sm text-gray-900 font-medium">Add Barbershop</span>
                    </button>
                    <button class="flex flex-col items-center justify-center p-4 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="text-sm text-gray-900 font-medium">Generate Report</span>
                    </button>
                    <button class="flex flex-col items-center justify-center p-4 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="text-sm text-gray-900 font-medium">Settings</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('additional_scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Initialize all charts when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Platform Growth Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [
                    {
                        label: 'Users',
                        data: [1850, 2120, 1790, 2390, 2940, 3200, 2700],
                        borderColor: '#6d28d9',
                        backgroundColor: 'rgba(109, 40, 217, 0.1)',
                        pointBackgroundColor: '#6d28d9',
                        tension: 0.4,
                        fill: true,
                        borderWidth: 2,
                        pointRadius: 3
                    },
                    {
                        label: 'Barbershops',
                        data: [65, 78, 82, 95, 110, 125, 128],
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        pointBackgroundColor: '#10b981',
                        tension: 0.4,
                        fill: true,
                        borderWidth: 2,
                        pointRadius: 3
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 12,
                                family: "'Poppins', sans-serif"
                            }
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Barbershop Categories Pie Chart
        const appointmentPieCtx = document.getElementById('appointmentPieChart').getContext('2d');
        const appointmentPieChart = new Chart(appointmentPieCtx, {
            type: 'doughnut',
            data: {
                labels: ['Premium', 'Standard', 'Budget', 'Mobile', 'Specialty'],
                datasets: [
                    {
                        data: [35, 30, 20, 10, 5],
                        backgroundColor: [
                            '#6d28d9', 
                            '#8b5cf6', 
                            '#a78bfa', 
                            '#c4b5fd', 
                            '#ddd6fe'
                        ],
                        borderWidth: 0
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            boxWidth: 12,
                            font: {
                                size: 11,
                                family: "'Poppins', sans-serif"
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.label}: ${context.parsed}%`;
                            }
                        }
                    }
                },
                cutout: '70%'
            }
        });

        // Animate elements on scroll
        const animateElements = () => {
            document.querySelectorAll('.activity-item').forEach((item, index) => {
                item.style.animationDelay = `${0.1 * (index + 1)}s`;
                item.style.opacity = '1';
            });
        };
        
        // Call animation once page loads
        setTimeout(animateElements, 500);
    });
</script>
@endsection
