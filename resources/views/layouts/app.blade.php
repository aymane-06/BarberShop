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
    <div class="mobile-menu bg-white h-full w-64 shadow-xl p-5">
      <div class="flex justify-between items-center mb-6">
        <div class="flex items-center space-x-1">
          <svg class="w-8 h-8 text-primary-600" fill="currentColor" viewBox="0 0 24 24">
            <path d="M7 21h10V7l-10 14zm2.74-7.76L12 7.5l2.26 5.74-4.52 0z"></path>
            <path d="M18.07 2.93L16 5l2.07 2.07-1.41 1.42L13 4.83 17.59 0l1.41 1.41L16.93 3.5l2.55 2.55-1.41 1.42z">
            </path>
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
        <a href="#features" class="block hover:text-primary-600 transition-colors">Features</a>
        <a href="#how-it-works" class="block hover:text-primary-600 transition-colors">How it Works</a>
        <a href="#testimonials" class="block hover:text-primary-600 transition-colors">Testimonials</a>
        <a href="/login" class="block hover:text-primary-600 transition-colors mt-6">Log in</a>
        <a href="/register"
          class="block bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700 transition-colors shadow-sm text-center mt-2">Sign
          Up Free</a>
      </nav>
    </div>
  </div>

  <!-- Navigation -->
  <nav class="bg-white shadow-sm px-4 md:px-6 py-3 sticky top-0 z-40">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
      <div class="flex items-center space-x-1">
        <svg class="w-8 h-8 text-primary-600" fill="currentColor" viewBox="0 0 24 24">
          <path d="M7 21h10V7l-10 14zm2.74-7.76L12 7.5l2.26 5.74-4.52 0z"></path>
          <path d="M18.07 2.93L16 5l2.07 2.07-1.41 1.42L13 4.83 17.59 0l1.41 1.41L16.93 3.5l2.55 2.55-1.41 1.42z">
          </path>
        </svg>
        <span class="font-bold text-xl text-primary-600">CutBook</span>
      </div>
      <div class="hidden md:flex space-x-6 text-gray-700">
        
        <a href="{{ route('home') }}#features" class="hover:text-primary-600 transition-colors">Features</a>
        <a href="{{ route('home') }}#how-it-works" class="hover:text-primary-600 transition-colors">How it Works</a>
        <a href="{{ route('home') }}#testimonials" class="hover:text-primary-600 transition-colors">Testimonials</a>
        <a href="{{ route('search-results') }}" class="hover:text-primary-600 transition-colors">Find Barber</a>
    </div>
      <div class="hidden md:flex items-center space-x-4">
        <a href="/login" class="text-primary-600 hover:text-primary-800 transition-colors">Log in</a>
        <a href="/register"
          class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700 transition-colors shadow-sm">Sign
          Up Free</a>
      </div>
      <button id="open-menu" class="md:hidden text-gray-700">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>
    </div>
  </nav>
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
            <li><a href="/barbers/register" class="hover:text-white transition-colors">Join as a Barber</a></li>
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