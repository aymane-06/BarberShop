<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Barbershop') }} - Admin</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f5f3ff',
                            100: '#ede9fe',
                            200: '#ddd6fe',
                            300: '#c4b5fd',
                            400: '#a78bfa',
                            500: '#8b5cf6',
                            600: '#6d28d9',
                            700: '#5b21b6',
                            800: '#4c1d95',
                            900: '#3c1e79',
                        }
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif']
                    }
                }
            }
        }
    </script>

    <style>
        /* Custom styles */
        body {
            background-color: #f9fafb;
        }
        .card-gradient {
            background: linear-gradient(145deg, #ffffff 0%, #f9fafb 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .chart-container {
            position: relative;
        }
        .pulse {
            position: relative;
        }
        .pulse::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 0.75rem;
            box-shadow: 0 0 0 0 rgba(109, 40, 217, 0.4);
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(109, 40, 217, 0.4);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(109, 40, 217, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(109, 40, 217, 0);
            }
        }
        .activity-item {
            opacity: 0;
            animation: fadeInUp 0.4s ease forwards;
        }
        .scale-in {
            animation: scaleIn 0.5s ease-out forwards;
        }
        .slide-in-right {
            opacity: 0;
            animation: slideInRight 0.5s ease-out forwards;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
    
    @yield('additional_styles')
</head>
<body class="font-sans antialiased">
     <!-- Flash messages overlay -->
  <div class="absolute top-4 right-4 left-4 z-100 max-w-lg mx-auto">
    @include('partials.auth-errors')
  </div>
    <div class="min-h-screen flex">
        <!-- Sidebar (hidden on mobile by default) -->
        <div id="sidebar" class="w-64 bg-white shadow-md fixed inset-y-0 left-0 z-30 transform transition duration-300 ease-in-out -translate-x-full md:translate-x-0">
            <div class="flex items-center justify-center h-16 shadow-sm">
                <div class="text-xl font-bold text-primary-600">
                    {{ config('app.name', 'Barbershop') }} Admin
                </div>
            </div>
            <div class="p-4 space-y-2 overflow-y-auto h-[calc(100vh-4rem)]">
                <!-- Navigation Links -->
                <div class="mt-2 space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-primary-50 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-primary-50 text-primary-600' : 'text-gray-700' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>

                    <a href="{{ route('admin.users') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-primary-50 transition-colors text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Users
                    </a>

                    <a href="{{route('admin.barbershops')}}" class="flex items-center px-4 py-3 rounded-lg hover:bg-primary-50 transition-colors text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Barbershops
                    </a>

                    <!-- <a href="#" class="flex items-center px-4 py-3 rounded-lg hover:bg-primary-50 transition-colors text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Appointments
                    </a>

                    <a href="#" class="flex items-center px-4 py-3 rounded-lg hover:bg-primary-50 transition-colors text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Reports
                    </a>

                    <a href="#" class="flex items-center px-4 py-3 rounded-lg hover:bg-primary-50 transition-colors text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Settings
                    </a> -->
                </div>

                <!-- Admin Profile Section -->
                <div class="mt-10 pt-6 border-t border-gray-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'Admin User' }}&background=6D28D9&color=ffffff" alt="Admin">
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name ?? 'Admin User' }}</p>
                            <div class="flex items-center mt-1">
                                <span class="text-xs text-gray-500">Administrator</span>
                                <span class="ml-2 h-2 w-2 rounded-full bg-green-500"></span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center px-4 py-2 text-sm text-red-600 font-medium rounded-md hover:bg-red-50 w-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 w-full md:pl-64">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm sticky top-0 z-20">
                <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center">
                        <button type="button" id="sidebar-toggle" class="text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-400 rounded-md md:hidden">
                            <span class="sr-only">Toggle menu</span>
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <div class="text-xl font-bold text-primary-600 ml-2 md:hidden">
                            {{ config('app.name', 'Barbershop') }}
                        </div>
                    </div>
                    <div class="flex items-center">
                        <!-- Search - hidden on small screens -->
                        <div class="relative mr-4 hidden sm:block">
                            <input type="text" class="w-full sm:w-64 pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-primary-500" placeholder="Search...">
                            <div class="absolute left-3 top-2.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                        <!-- Notification Bell -->
                        <button class="relative p-2 text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-400 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 01-6 0v-1m6 0H9" />
                            </svg>
                            <span class="absolute top-1 right-1 block h-2 w-2 rounded-full bg-red-500"></span>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 p-4 sm:p-6">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 py-4">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <p class="text-center text-sm text-gray-500">
                        &copy; {{ date('Y') }} Barbershop Admin. All rights reserved.
                    </p>
                </div>
            </footer>
        </div>
    </div>

    <!-- Mobile sidebar overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-20 hidden"></div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            function toggleSidebar() {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
                document.body.classList.toggle('overflow-hidden');
            }
            
            sidebarToggle.addEventListener('click', toggleSidebar);
            overlay.addEventListener('click', toggleSidebar);
            
            // Close sidebar when window is resized to desktop size
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768) {
                    sidebar.classList.add('md:translate-x-0');
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }
            });
        });
    </script>
    
    @yield('additional_scripts')
</body>
</html>