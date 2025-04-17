<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CutBook - Find & Book Your Perfect Barber</title>
  <meta name="description"
    content="Find and book the best barbers in your area. Quick, easy and reliable booking for your next perfect cut.">
  <!-- Tailwind CSS via CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: {
              50: '#f5f3ff', 100: '#ede9fe', 200: '#ddd6fe',
              300: '#c4b5fd', 400: '#a78bfa', 500: '#8b5cf6',
              600: '#7c3aed', 700: '#6d28d9', 800: '#5b21b6',
              900: '#4c1d95',
            },
            secondary: {
              50: '#f8fafc', 100: '#f1f5f9', 200: '#e2e8f0',
              300: '#cbd5e1', 400: '#94a3b8', 500: '#64748b',
              600: '#475569', 700: '#334155', 800: '#1e293b',
              900: '#0f172a',
            },
          }
        }
      }
    }
  </script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- AOS Animation Library -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @yield('additional_styles')
</head>
<body class="bg-gray-50">
  <!-- Mobile Menu Overlay -->
<div id="mobile-menu" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden">
    <div class="mobile-menu bg-white h-full w-72 shadow-xl p-5 overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
                    <div class="flex items-center space-x-1">
                        <svg class="w-8 h-8 text-primary-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M7 21h10V7l-10 14zm2.74-7.76L12 7.5l2.26 5.74-4.52 0z"></path>
                            <path d="M18.07 2.93L16 5l2.07 2.07-1.41 1.42L13 4.83 17.59 0l1.41 1.41L16.93 3.5l2.55 2.55-1.41 1.42z"></path>
                        </svg>
                        <span class="font-bold text-xl text-primary-600">CutBook</span>
                    </div>
                    <button id="close-menu" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
        <nav class="space-y-4 text-gray-700">
            <a href="{{ route('home') }}" class="block hover:text-primary-600 transition-colors font-medium">Home</a>
            <div class="border-b border-gray-200 my-2"></div>
            
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex justify-between w-full hover:text-primary-600 transition-colors">
                    Discover
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="open" class="pl-4 mt-2 space-y-2">
                    <a href="{{ route('search-results') }}" class="block hover:text-primary-600 transition-colors">Find Barbers</a>
                    <a href="{{ route('home') }}#features" class="block hover:text-primary-600 transition-colors">Features</a>
                    <a href="{{ route('home') }}#how-it-works" class="block hover:text-primary-600 transition-colors">How it Works</a>
                    <a href="{{ route('home') }}#testimonials" class="block hover:text-primary-600 transition-colors">Testimonials</a>
                </div>
            </div>
            
            @auth
                <div class="border-b border-gray-200 my-2"></div>
                @if(auth()->user()->role === 'barber')
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex justify-between w-full hover:text-primary-600 transition-colors">
                            Barber Dashboard
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" class="pl-4 mt-2 space-y-2">
                            <a href="{{ route('barber.dashboard') }}" class="block hover:text-primary-600 transition-colors">Dashboard</a>
                            <a href="{{ route('user.profile') }}" class="block hover:text-primary-600 transition-colors">Profile</a>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 rounded-md">Log out</button>
                        </form>
                    </div>
                @elseif(auth()->user()->role === 'admin')
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex justify-between w-full hover:text-primary-600 transition-colors">
                            Admin Panel
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" class="pl-4 mt-2 space-y-2">
                            <a href="{{ route('admin.dashboard') }}" class="block hover:text-primary-600 transition-colors">Dashboard</a>
                            <a href="{{ route('user.profile') }}" class="block hover:text-primary-600 transition-colors">Profile</a>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 rounded-md">Log out</button>
                        </form>
                    </div>
                @else
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex justify-between w-full hover:text-primary-600 transition-colors">
                            My Account
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" class="pl-4 mt-2 space-y-2">
                            <a href="{{ route('user.profile') }}" class="block hover:text-primary-600 transition-colors">My Bookings</a>
                            <a href="{{ route('user.profile') }}" class="block hover:text-primary-600 transition-colors">Favorites</a>
                            <a href="" class="block hover:text-primary-600 transition-colors">My Reviews</a>
                            <a href="{{ route('user.profile') }}" class="block hover:text-primary-600 transition-colors">Profile</a>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 rounded-md">Log out</button>
                        </form>
                    </div>
                @endif
                
                
            @else
                <div class="border-b border-gray-200 my-2"></div>
                <a href="{{ route('login') }}" class="block hover:text-primary-600 transition-colors mt-4">Log in</a>
                <a href="{{ route('register') }}" class="block bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700 transition-colors shadow-sm text-center mt-2">Sign Up Free</a>
            @endauth
        </nav>
    </div>
</div>

<!-- Navigation -->
<nav class="bg-white shadow-sm px-4 md:px-6 py-3 sticky top-0 z-40">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <div class="flex items-center space-x-1">
            <a href="{{ route('home') }}" class="flex items-center space-x-1">
                <svg class="w-8 h-8 text-primary-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M7 21h10V7l-10 14zm2.74-7.76L12 7.5l2.26 5.74-4.52 0z"></path>
                    <path d="M18.07 2.93L16 5l2.07 2.07-1.41 1.42L13 4.83 17.59 0l1.41 1.41L16.93 3.5l2.55 2.55-1.41 1.42z"></path>
                </svg>
                <span class="font-bold text-xl text-primary-600">CutBook</span>
            </a>
        </div>
        
        <!-- Desktop Navigation -->
        <div class="hidden md:flex space-x-6 text-gray-700">
            <div class="relative group">
                <a href="{{ route('search-results') }}" class="flex items-center hover:text-primary-600 transition-colors">
                    Find Barber
                    <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </a>
                <div class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg p-2 hidden group-hover:block z-50">
                    <a href="{{ route('search-results') }}?filter=nearest" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md">Nearest Barbers</a>
                    <a href="{{ route('search-results') }}?filter=top-rated" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md">Top Rated</a>
                    <a href="{{ route('search-results') }}?filter=availability" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md">Available Today</a>
                    <a href="{{ route('search-results') }}?filter=promotions" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md">Special Offers</a>
                </div>
            </div>
            
            <a href="{{ route('home') }}#features" class="hover:text-primary-600 transition-colors">Features</a>
            <a href="{{ route('home') }}#how-it-works" class="hover:text-primary-600 transition-colors">How it Works</a>
            <a href="{{ route('home') }}#testimonials" class="hover:text-primary-600 transition-colors">Testimonials</a>
        </div>
        
        <div class="hidden md:flex items-center space-x-4">
            @auth
                <div class="relative group">
                    <button class="flex items-center text-gray-700 hover:text-primary-600 focus:outline-none">
                        <img src="{{ auth()->user()->provider ? auth()->user()->avatar : (auth()->user()->avatar ? '/storage/'.auth()->user()->avatar : asset('images/default-avatar.png')) }}" class="w-8 h-8 rounded-full mr-2 object-cover border border-gray-200">
                        <span>{{ auth()->user()->name }}</span>
                        <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg p-2 hidden group-hover:block z-50">
                        @if(auth()->user()->role === 'barber')
                            @if (auth()->user()->barbershop===null)
                            <a href="{{ route('barber.barbershop.create') }}" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md">Create BarberShop</a>
                            @else
                            <a href="{{ route('barber.dashboard') }}" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md">Barber Dashboard</a>
                            @endif
                        @elseif(auth()->user()->role === 'admin')
                            <a href="" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md">Admin Panel</a>
                        @else
                            <a href="{{ route('user.profile') }}" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md">My Bookings</a>
                            <a href="{{ route('user.profile') }}" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md">Favorites</a>
                        @endif
                        <a href="{{ route('user.profile') }}" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md"> Profile</a>
                        <div class="border-t border-gray-100 my-1"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 rounded-md">Log out</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="text-primary-600 hover:text-primary-800 transition-colors">Log in</a>
                <a href="{{ route('register') }}" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700 transition-colors shadow-sm">Sign Up Free</a>
            @endauth
        </div>
        
        <button id="open-menu" class="md:hidden text-gray-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>
</nav>

<!-- Alpine.js for dropdowns -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        const openMenu = document.getElementById('open-menu');
        const closeMenu = document.getElementById('close-menu');
        
        openMenu.addEventListener('click', function() {
            mobileMenu.classList.remove('hidden');
        });
        
        closeMenu.addEventListener('click', function() {
            mobileMenu.classList.add('hidden');
        });
    });
</script>
  @yield('content')

  <!-- Footer -->
  <footer class="bg-secondary-900 text-gray-300 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <!-- Company Info -->
        <div>
          <h3 class="text-lg font-semibold text-white mb-4">CutBook</h3>
          <p class="mb-4 text-sm">Finding the perfect barber has never been easier. Book your next appointment in
            seconds.</p>
          <div class="flex space-x-4">
            <a href="#" class="text-gray-400 hover:text-white transition-colors transform hover:scale-110">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="text-gray-400 hover:text-white transition-colors transform hover:scale-110">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="text-gray-400 hover:text-white transition-colors transform hover:scale-110">
              <i class="fab fa-instagram"></i>
            </a>
          </div>
        </div>

        <!-- Quick Links -->
        <div>
          <h3 class="text-lg font-semibold text-white mb-4">Quick Links</h3>
          <ul class="space-y-2">
            <li><a href="#features" class="hover:text-white transition-colors">Features</a></li>
            <li><a href="#how-it-works" class="hover:text-white transition-colors">How it Works</a></li>
            <li><a href="#testimonials" class="hover:text-white transition-colors">Testimonials</a></li>
          </ul>
        </div>

        <!-- For Barbers -->
        <div>
          <h3 class="text-lg font-semibold text-white mb-4">For Barbers</h3>
          <ul class="space-y-2">
            <li><a href="{{ route('barber.barberJoin') }}" class="hover:text-white transition-colors">Join as a Barber</a></li>
            <li><a href="/barber-resources" class="hover:text-white transition-colors">Resources</a></li>
            <li><a href="/pricing" class="hover:text-white transition-colors">Pricing</a></li>
          </ul>
        </div>

        <!-- Contact -->
        <div>
          <h3 class="text-lg font-semibold text-white mb-4">Contact</h3>
          <p class="mb-2 text-sm"><i class="fas fa-envelope mr-2"></i> support@cutbook.com</p>
          <p class="mb-2 text-sm"><i class="fas fa-phone mr-2"></i> (123) 456-7890</p>
          <p class="text-sm"><i class="fas fa-map-marker-alt mr-2"></i> 123 Barber Street, Cutville</p>
        </div>
      </div>

      <div class="border-t border-gray-700 mt-10 pt-8 flex flex-col md:flex-row justify-between items-center">
        <p class="text-sm mb-4 md:mb-0">&copy; 2023 CutBook. All rights reserved.</p>
        <div class="flex space-x-6 text-sm">
          <a href="/privacy" class="hover:text-white transition-colors">Privacy Policy</a>
          <a href="/terms" class="hover:text-white transition-colors">Terms of Service</a>
          <a href="/contact" class="hover:text-white transition-colors">Contact Us</a>
        </div>
      </div>
    </div>
  </footer>

    <!-- Additional Scripts -->
    @yield('additional_scripts')
</body>
</html>