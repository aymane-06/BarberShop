<!DOCTYPE html>
<html lang="en">
<head>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>CutBook - Login to Your Account</title>
              <meta name="description" content="Log in to your CutBook account to book barber appointments, manage your bookings and more.">
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
<body class="bg-gray-50 min-h-screen flex flex-col">
     <!-- Flash messages overlay -->
  <div class="absolute top-4 right-4 left-4 z-100 max-w-lg mx-auto">
    @include('partials.auth-errors')
  </div>
              <!-- Navigation -->
              <nav class="bg-white shadow-sm px-4 md:px-6 py-3 sticky top-0 z-40">
                            <div class="max-w-7xl mx-auto flex justify-between items-center">
                                          <a href="/" class="flex items-center space-x-1">
                                                        <svg class="w-8 h-8 text-primary-600" fill="currentColor" viewBox="0 0 24 24">
                                                                      <path d="M7 21h10V7l-10 14zm2.74-7.76L12 7.5l2.26 5.74-4.52 0z"></path>
                                                                      <path d="M18.07 2.93L16 5l2.07 2.07-1.41 1.42L13 4.83 17.59 0l1.41 1.41L16.93 3.5l2.55 2.55-1.41 1.42z"></path>
                                                        </svg>
                                                        <span class="font-bold text-xl text-primary-600">CutBook</span>
                                          </a>
                                          <div class="flex items-center space-x-4">
                                          </div>
                            </div>
              </nav>

              @yield('content')

              <footer class="bg-white py-6 border-t">
                            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                                          <div class="flex justify-between items-center">
                                                        <p class="text-sm text-gray-500">&copy; 2023 CutBook. All rights reserved.</p>
                                                        <div class="flex space-x-4">
                                                                      <a href="/privacy" class="text-sm text-gray-500 hover:text-gray-700 transition-colors">Privacy Policy</a>
                                                                      <a href="/terms" class="text-sm text-gray-500 hover:text-gray-700 transition-colors">Terms of Service</a>
                                                                      <a href="/contact" class="text-sm text-gray-500 hover:text-gray-700 transition-colors">Contact Us</a>
                                                        </div>
                                          </div>
                            </div>
              </footer>

              
              @yield('additional_scripts')

              </body>
</html>