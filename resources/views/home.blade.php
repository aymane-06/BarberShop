@extends('layouts.barber')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Welcome to BarberShop Dashboard</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Dashboard stats cards go here -->
        <div class="bg-white rounded-lg shadow p-5">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-sm font-medium text-gray-500">Today's Appointments</h2>
                    <p class="text-2xl font-bold text-gray-800">8</p>
                </div>
                <div class="bg-primary-100 rounded-full p-3">
                    <i class="fas fa-calendar-day text-primary-600"></i>
                </div>
            </div>
        </div>
        
        <!-- Add more stat cards -->
    </div>
    
    <!-- Main content goes here -->
</div>
@endsection

@section('additional_scripts')
<script>
    // Mobile menu functionality
    document.addEventListener('DOMContentLoaded', function() {
        const menuButton = document.querySelector('.md\\:hidden button');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
        
        menuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('translate-x-0');
            mobileMenu.classList.toggle('-translate-x-full');
            mobileMenuOverlay.classList.toggle('hidden');
        });
        
        mobileMenuOverlay.addEventListener('click', function() {
            mobileMenu.classList.remove('translate-x-0');
            mobileMenu.classList.add('-translate-x-full');
            this.classList.add('hidden');
        });
    });
</script>
@endsection

@section('additional_styles')
<style>
    #mobile-menu {
        transition: transform 0.3s ease-in-out;
    }
</style>
@endsection

<!-- Mobile Menu Overlay -->
<div id="mobile-menu-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden"></div>

<!-- Mobile Menu -->
<div id="mobile-menu" class="fixed inset-y-0 left-0 bg-white shadow-lg w-64 z-50 transform -translate-x-full transition-transform md:hidden">
    <div class="flex flex-col h-full">
        <div class="px-4 py-6 border-b">
            <div class="flex items-center justify-between">
                <h1 class="text-xl font-bold leading-none text-primary-700">
                    <span class="text-primary-600">Barber</span>Shop
                </h1>
                <button id="close-menu" class="text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="flex-grow overflow-y-auto">
            <div class="p-4">
                <ul class="space-y-1">
                    <li>
                        <a href="/barber/dashboard" class="flex items-center bg-primary-100 rounded-xl font-bold text-primary-700 py-3 px-4">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="/barber/appointments" class="flex bg-white hover:bg-primary-50 rounded-xl font-medium text-gray-600 hover:text-primary-700 py-3 px-4 transition-all">
                            <i class="fas fa-calendar-alt mr-3"></i>
                            Appointments
                        </a>
                    </li>
                    <li>
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
                    </li>
                    <li>
                        <a href="/barber/analytics" class="flex bg-white hover:bg-primary-50 rounded-xl font-medium text-gray-600 hover:text-primary-700 py-3 px-4 transition-all">
                            <i class="fas fa-chart-line mr-3"></i>
                            Analytics
                        </a>
                    </li>
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
            </div>
        </div>
    </div>
</div></li></div>