<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - Barber Dashboard</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1'
                        }
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- Additional Styles -->
    @yield('additional_styles')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-50">
     <!-- Flash messages overlay -->
  <div class="absolute top-4 right-4 left-4 z-100 max-w-lg mx-auto">
    @include('partials.auth-errors')
  </div>
    <div id="app">
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 bg-white shadow-md max-h-screen w-60 hidden md:block">
            <div class="flex flex-col justify-between h-full">
                <div class="flex-grow">
                    <div class="px-4 py-6 text-center border-b">
                        <h1 class="text-xl font-bold leading-none text-primary-700">
                            <span class="text-primary-600">Barber</span>Shop
                        </h1>
                    </div>
                    <div class="p-4">
                        <ul class="space-y-1">
                            <li>
                                <a href="{{ Route('barber.dashboard') }}" class="flex items-center bg-primary-100 rounded-xl font-bold text-primary-700 py-3 px-4">
                                    <i class="fas fa-tachometer-alt mr-3"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('barberShop.appointments') }}" class="flex bg-white hover:bg-primary-50 rounded-xl font-medium text-gray-600 hover:text-primary-700 py-3 px-4 transition-all">
                                    <i class="fas fa-calendar-alt mr-3"></i>
                                    Appointments
                                </a>
                            </li>
                            <!-- <li>
                                <a href="/barber/services" class="flex bg-white hover:bg-primary-50 rounded-xl font-medium text-gray-600 hover:text-primary-700 py-3 px-4 transition-all">
                                    <i class="fas fa-cut mr-3"></i>
                                    Services
                                </a>
                            </li>
                            <li>
                                <a href="/barber/clients" class="flex bg-white hover:bg-primary-50 rounded-xl font-medium text-gray-600 hover:text-primary-700 py-3 px-4 transition-all">
                                    <i class="fas fa-users mr-3"></i>
                                    Clients
                                </a>
                            </li>
                            <li>
                                <a href="/barber/reviews" class="flex bg-white hover:bg-primary-50 rounded-xl font-medium text-gray-600 hover:text-primary-700 py-3 px-4 transition-all">
                                    <i class="fas fa-star mr-3"></i>
                                    Reviews
                                </a>
                            </li> -->
                            <li>
                                <div class="relative">
                                    <button onclick="toggleDropdown('shopDropdown')" class="flex items-center justify-between w-full bg-white hover:bg-primary-50 rounded-xl font-medium text-gray-600 hover:text-primary-700 py-3 px-4 transition-all">
                                        <div class="flex items-center">
                                            <i class="fas fa-store mr-3"></i>
                                            <span>Shop Management</span>
                                        </div>
                                        <i class="fas fa-chevron-down text-xs"></i>
                                    </button>
                                    <div id="shopDropdown" class="hidden pl-4 py-2 space-y-1">
                                        <a href="{{ route('barberShop.profile') }}" class="flex items-center bg-white hover:bg-primary-50 rounded-xl font-medium text-gray-600 hover:text-primary-700 py-2 px-4 transition-all">
                                            <i class="fas fa-id-card mr-3"></i>
                                            Shop Profile
                                        </a>
                                        <a href="{{ route('barberShop.services') }}" class="flex items-center bg-white hover:bg-primary-50 rounded-xl font-medium text-gray-600 hover:text-primary-700 py-2 px-4 transition-all">
                                            <i class="fas fa-list-ul mr-3"></i>
                                            Services Management
                                        </a>
                                        <a href="" class="flex items-center bg-white hover:bg-primary-50 rounded-xl font-medium text-gray-600 hover:text-primary-700 py-2 px-4 transition-all">
                                            <i class="fas fa-images mr-3"></i>
                                            Gallery
                                        </a>
                                        <a href="" class="flex items-center bg-white hover:bg-primary-50 rounded-xl font-medium text-gray-600 hover:text-primary-700 py-2 px-4 transition-all">
                                            <i class="fas fa-cog mr-3"></i>
                                            Settings
                                        </a>
                                    </div>

                                    <script>
                                        function toggleDropdown(id) {
                                            const dropdown = document.getElementById(id);
                                            dropdown.classList.toggle('hidden');
                                        }
                                    </script>
                                </div>
                            </li></div>
                        </ul>
                    </div>
                </div>
                <div class="p-4 border-t">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="User avatar" class="w-10 h-10 rounded-full">
                            <span class="text-sm font-medium truncate">{{ Auth::user()->name }}</span>
                        </div>
                        <a href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="text-gray-500 hover:text-red-500 transition-colors">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="md:ml-60 h-screen pt-16">
            <!-- Top Navbar -->
            <header class="fixed top-0 right-0 left-0 md:left-60 h-16 z-40 flex items-center justify-between bg-white shadow-sm px-5">
                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-gray-500 hover:text-primary-600 focus:outline-none">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const menuButton = document.getElementById('mobile-menu-button');
                        const sidebar = document.querySelector('aside');
                        
                        menuButton.addEventListener('click', function(e) {
                            e.stopPropagation();
                            toggleSidebar();
                        });
                        
                        // Close sidebar when clicking outside
                        document.addEventListener('click', function(e) {
                            if (sidebar.classList.contains('absolute') && 
                                !sidebar.contains(e.target) && 
                                e.target !== menuButton) {
                                closeSidebar();
                            }
                        });
                        
                        function toggleSidebar() {
                            sidebar.classList.toggle('hidden');
                            sidebar.classList.toggle('md:block');
                            sidebar.classList.toggle('absolute');
                            sidebar.classList.toggle('z-50');
                            
                            // Toggle icon between bars and times
                            const icon = menuButton.querySelector('i');
                            if (icon.classList.contains('fa-bars')) {
                                icon.classList.replace('fa-bars', 'fa-times');
                            } else {
                                icon.classList.replace('fa-times', 'fa-bars');
                            }
                        }
                        
                        function closeSidebar() {
                            if (sidebar.classList.contains('absolute')) {
                                sidebar.classList.add('hidden');
                                sidebar.classList.add('md:block');
                                sidebar.classList.remove('absolute');
                                sidebar.classList.remove('z-50');
                                
                                const icon = menuButton.querySelector('i');
                                if (icon.classList.contains('fa-times')) {
                                    icon.classList.replace('fa-times', 'fa-bars');
                                }
                            }
                        }
                    });
                </script>
                
                <!-- Search -->
                <div class="relative hidden md:block md:w-1/3">
                    <div class="flex items-center border rounded-lg bg-gray-50 px-3 py-2">
                        <i class="fas fa-search text-gray-400 mr-3"></i>
                        <input type="text" placeholder="Search..." class="bg-transparent border-none focus:ring-0 focus:outline-none w-full text-sm">
                    </div>
                </div>
                
                <!-- Right Navigation -->
                <div class="flex items-center space-x-4">
                    <!-- Notifications -->
                    <div class="relative">
                        <button class="p-2 text-gray-500 rounded-full hover:bg-gray-100 focus:outline-none">
                            <i class="fas fa-bell"></i>
                            <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">3</span>
                        </button>
                    </div>
                    
                    <!-- Messages -->
                    <div class="relative">
                        <button class="p-2 text-gray-500 rounded-full hover:bg-gray-100 focus:outline-none">
                            <i class="fas fa-comment"></i>
                            <span class="absolute top-0 right-0 bg-primary-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">2</span>
                        </button>
                    </div>
                    
                    <!-- Settings -->
                    <div>
                        <button class="p-2 text-gray-500 rounded-full hover:bg-gray-100 focus:outline-none">
                            <i class="fas fa-cog"></i>
                        </button>
                    </div>
                </div>
            </header>
            
            <!-- Page Content -->
            <div class="content px-4 py-3">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Additional Scripts -->
    @yield('additional_scripts')
</body>
</html>