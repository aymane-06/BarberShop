@extends('layouts.app')
@section('additional_styles')
<style>
    body {
      font-family: 'Poppins', sans-serif;
      scroll-behavior: smooth;
    }

    .hero-gradient {
      background: linear-gradient(135deg, rgba(109, 40, 217, 0.95) 0%, rgba(91, 33, 182, 0.8) 100%);
    }

    .text-shadow {
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .card-hover {
      transition: all 0.3s ease;
    }

    .card-hover:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .testimonial-card {
      position: relative;
    }

    .testimonial-card::before {
      content: '"';
      position: absolute;
      top: -10px;
      left: 20px;
      font-size: 80px;
      color: rgba(124, 58, 237, 0.1);
      line-height: 1;
    }

    .floating {
      animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
      0% {
        transform: translateY(0px);
      }

      50% {
        transform: translateY(-20px);
      }

      100% {
        transform: translateY(0px);
      }
    }

    .pulse {
      animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    @keyframes pulse {

      0%,
      100% {
        opacity: 1;
      }

      50% {
        opacity: .7;
      }
    }

    .mobile-menu {
      transition: transform 0.3s ease-in-out;
    }

    .mobile-menu.hidden {
      transform: translateX(-100%);
    }
  </style>
@endsection
  


@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden">
    <div class="hero-gradient text-white">
      <div
        class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28 lg:py-32 flex flex-col md:flex-row items-center">
        <div class="md:w-1/2 lg:pr-12 mb-10 md:mb-0" data-aos="fade-right" data-aos-duration="1000">
          <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight text-shadow">Find & Book Your Perfect Barber</h1>
          <p class="text-lg mb-8 text-gray-100 max-w-lg">Discover top-rated barbers in your area and book appointments
            with ease. No more waiting in line for your next haircut.</p>
          <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
            <a href="/register"
              class="bg-white text-primary-700 px-6 py-3 rounded-md font-medium text-center shadow-lg hover:bg-gray-100 transition-all transform hover:scale-105">Book
              Now</a>
            <a href="/barbers/register"
              class="bg-transparent border-2 border-white text-white px-6 py-3 rounded-md font-medium text-center hover:bg-white hover:text-primary-700 transition-all transform hover:scale-105">Register
              as a Barber</a>
          </div>
        </div>
        <div class="md:w-1/2 relative" data-aos="fade-left" data-aos-duration="1000">
          <img
            src="https://images.unsplash.com/photo-1503951914875-452162b0f3f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=500&q=80"
            alt="Barber Shop" class="rounded-lg shadow-2xl relative z-10 floating">
          <div class="absolute -bottom-6 -right-6 w-36 h-36 bg-primary-400 rounded-full opacity-20 pulse"></div>
          <div class="absolute -top-10 -left-10 w-48 h-48 bg-white rounded-full opacity-10 pulse"></div>
        </div>
      </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#f8fafc" fill-opacity="1"
          d="M0,192L48,170.7C96,149,192,107,288,112C384,117,480,171,576,186.7C672,203,768,181,864,165.3C960,149,1056,139,1152,144C1248,149,1344,171,1392,181.3L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
        </path>
      </svg>
    </div>
  </section>

  <!-- Features Section -->
  <section id="features" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16" data-aos="fade-up" data-aos-duration="800">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Why Choose CutBook</h2>
        <p class="max-w-xl mx-auto text-gray-600">The easiest way to find, book and manage your barber appointments</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Feature 1 -->
        <div class="bg-white p-6 rounded-lg shadow transition-all duration-300 card-hover" data-aos="zoom-in"
          data-aos-delay="100">
          <div class="rounded-full bg-primary-100 w-14 h-14 flex items-center justify-center mb-4">
            <i class="fas fa-search text-primary-600 text-xl"></i>
          </div>
          <h3 class="text-xl font-semibold mb-2 text-gray-900">Find Local Barbers</h3>
          <p class="text-gray-600">Discover top-rated barbers in your area with our advanced search filters.</p>
        </div>

        <!-- Feature 2 -->
        <div class="bg-white p-6 rounded-lg shadow transition-all duration-300 card-hover" data-aos="zoom-in"
          data-aos-delay="200">
          <div class="rounded-full bg-primary-100 w-14 h-14 flex items-center justify-center mb-4">
            <i class="fas fa-calendar-check text-primary-600 text-xl"></i>
          </div>
          <h3 class="text-xl font-semibold mb-2 text-gray-900">Easy Booking</h3>
          <p class="text-gray-600">Book appointments in just a few clicks with real-time availability.</p>
        </div>

        <!-- Feature 3 -->
        <div class="bg-white p-6 rounded-lg shadow transition-all duration-300 card-hover" data-aos="zoom-in"
          data-aos-delay="300">
          <div class="rounded-full bg-primary-100 w-14 h-14 flex items-center justify-center mb-4">
            <i class="fas fa-bell text-primary-600 text-xl"></i>
          </div>
          <h3 class="text-xl font-semibold mb-2 text-gray-900">Reminders</h3>
          <p class="text-gray-600">Never miss an appointment with our automated SMS and email reminders.</p>
        </div>

        <!-- Feature 4 -->
        <div class="bg-white p-6 rounded-lg shadow transition-all duration-300 card-hover" data-aos="zoom-in"
          data-aos-delay="400">
          <div class="rounded-full bg-primary-100 w-14 h-14 flex items-center justify-center mb-4">
            <i class="fas fa-star text-primary-600 text-xl"></i>
          </div>
          <h3 class="text-xl font-semibold mb-2 text-gray-900">Reviews & Ratings</h3>
          <p class="text-gray-600">Read honest reviews and ratings from other customers to find the best barber.</p>
        </div>

        <!-- Feature 5 -->
        <div class="bg-white p-6 rounded-lg shadow transition-all duration-300 card-hover" data-aos="zoom-in"
          data-aos-delay="500">
          <div class="rounded-full bg-primary-100 w-14 h-14 flex items-center justify-center mb-4">
            <i class="fas fa-percent text-primary-600 text-xl"></i>
          </div>
          <h3 class="text-xl font-semibold mb-2 text-gray-900">Exclusive Offers</h3>
          <p class="text-gray-600">Access special discounts and promotions from participating barbers.</p>
        </div>

        <!-- Feature 6 -->
        <div class="bg-white p-6 rounded-lg shadow transition-all duration-300 card-hover" data-aos="zoom-in"
          data-aos-delay="600">
          <div class="rounded-full bg-primary-100 w-14 h-14 flex items-center justify-center mb-4">
            <i class="fas fa-shield-alt text-primary-600 text-xl"></i>
          </div>
          <h3 class="text-xl font-semibold mb-2 text-gray-900">Secure Payments</h3>
          <p class="text-gray-600">Pay securely online or in-person with multiple payment options.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- How It Works -->
  <section id="how-it-works" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16" data-aos="fade-up">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">How It Works</h2>
        <p class="max-w-xl mx-auto text-gray-600">Three simple steps to get your perfect haircut</p>
      </div>

      <div class="flex flex-col md:flex-row justify-between items-center space-y-8 md:space-y-0 md:space-x-8">
        <!-- Step 1 -->
        <div class="flex flex-col items-center text-center w-full md:w-1/3" data-aos="fade-right" data-aos-delay="100">
          <div
            class="bg-primary-100 text-primary-600 rounded-full w-16 h-16 flex items-center justify-center text-xl font-bold mb-4 transform transition-all hover:scale-110 hover:bg-primary-200">
            1</div>
          <h3 class="text-xl font-semibold mb-2">Search</h3>
          <p class="text-gray-600">Find barbers near you by location, price, reviews or availability</p>
        </div>

        <div class="hidden md:block text-gray-300 animate-pulse">
          <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
              clip-rule="evenodd"></path>
          </svg>
        </div>

        <!-- Step 2 -->
        <div class="flex flex-col items-center text-center w-full md:w-1/3" data-aos="fade-up" data-aos-delay="200">
          <div
            class="bg-primary-100 text-primary-600 rounded-full w-16 h-16 flex items-center justify-center text-xl font-bold mb-4 transform transition-all hover:scale-110 hover:bg-primary-200">
            2</div>
          <h3 class="text-xl font-semibold mb-2">Book</h3>
          <p class="text-gray-600">Select your barber, service and preferred time slot</p>
        </div>

        <div class="hidden md:block text-gray-300 animate-pulse">
          <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
              clip-rule="evenodd"></path>
          </svg>
        </div>

        <!-- Step 3 -->
        <div class="flex flex-col items-center text-center w-full md:w-1/3" data-aos="fade-left" data-aos-delay="300">
          <div
            class="bg-primary-100 text-primary-600 rounded-full w-16 h-16 flex items-center justify-center text-xl font-bold mb-4 transform transition-all hover:scale-110 hover:bg-primary-200">
            3</div>
          <h3 class="text-xl font-semibold mb-2">Enjoy</h3>
          <p class="text-gray-600">Show up at your appointment time and enjoy your perfect cut</p>
        </div>
      </div>

      <div class="mt-16 text-center" data-aos="zoom-in" data-aos-delay="400">
        <a href="/register"
          class="bg-primary-600 text-white px-8 py-3 rounded-md font-medium inline-block hover:bg-primary-700 transition-all transform hover:scale-105 shadow-md">Get
          Started Now</a>
      </div>
    </div>
  </section>

  <!-- Testimonials -->
  <section id="testimonials" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16" data-aos="fade-up">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">What Customers Say</h2>
        <p class="max-w-xl mx-auto text-gray-600">Join thousands of satisfied users</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Testimonial 1 -->
        <div
          class="bg-white p-6 rounded-lg shadow-md testimonial-card transform transition-all hover:-translate-y-2 hover:shadow-lg"
          data-aos="flip-left" data-aos-delay="100">
          <div class="flex items-center mb-4">
            <div class="text-yellow-400 flex">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <span class="ml-2 text-gray-600">5.0</span>
          </div>
          <p class="text-gray-600 mb-6">"I used to waste so much time waiting at my local barbershop. With CutBook, I
            just book my slot and show up right on time. It's been a game-changer!"</p>
          <div class="flex items-center">
            <div
              class="bg-gradient-to-br from-primary-200 to-primary-300 rounded-full w-12 h-12 flex items-center justify-center mr-3">
              <span class="text-primary-600 font-bold">MJ</span>
            </div>
            <div>
              <h4 class="font-medium">Michael Johnson</h4>
              <p class="text-sm text-gray-500">Regular Customer</p>
            </div>
          </div>
        </div>

        <!-- Testimonial 2 -->
        <div
          class="bg-white p-6 rounded-lg shadow-md testimonial-card transform transition-all hover:-translate-y-2 hover:shadow-lg"
          data-aos="flip-left" data-aos-delay="200">
          <div class="flex items-center mb-4">
            <div class="text-yellow-400 flex">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
            </div>
            <span class="ml-2 text-gray-600">4.5</span>
          </div>
          <p class="text-gray-600 mb-6">"As a barbershop owner, this platform has helped me organize my appointments and
            attract new customers. The notification system keeps no-shows to a minimum."</p>
          <div class="flex items-center">
            <div
              class="bg-gradient-to-br from-primary-200 to-primary-300 rounded-full w-12 h-12 flex items-center justify-center mr-3">
              <span class="text-primary-600 font-bold">RW</span>
            </div>
            <div>
              <h4 class="font-medium">Robert Wilson</h4>
              <p class="text-sm text-gray-500">Barbershop Owner</p>
            </div>
          </div>
        </div>

        <!-- Testimonial 3 -->
        <div
          class="bg-white p-6 rounded-lg shadow-md testimonial-card transform transition-all hover:-translate-y-2 hover:shadow-lg"
          data-aos="flip-left" data-aos-delay="300">
          <div class="flex items-center mb-4">
            <div class="text-yellow-400 flex">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <span class="ml-2 text-gray-600">5.0</span>
          </div>
          <p class="text-gray-600 mb-6">"I travel a lot for work and finding good barbers used to be hit or miss. Now I
            can check ratings and book in advance wherever I go. Love this service!"</p>
          <div class="flex items-center">
            <div
              class="bg-gradient-to-br from-primary-200 to-primary-300 rounded-full w-12 h-12 flex items-center justify-center mr-3">
              <span class="text-primary-600 font-bold">DT</span>
            </div>
            <div>
              <h4 class="font-medium">David Thompson</h4>
              <p class="text-sm text-gray-500">Business Traveler</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="py-20 bg-primary-600 text-white relative overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-white rounded-full opacity-10 -mr-32 -mt-32"
      data-aos="fade-down-left"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-primary-400 rounded-full opacity-20 -ml-40 -mb-40"
      data-aos="fade-up-right"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
      <h2 class="text-3xl font-bold mb-6" data-aos="zoom-in">Ready for your next great haircut?</h2>
      <p class="text-lg mb-8 max-w-2xl mx-auto" data-aos="zoom-in" data-aos-delay="100">Join thousands of customers who
        have already simplified their barber booking experience with CutBook.</p>
      <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
        <a href="/register"
          class="bg-white text-primary-700 px-8 py-3 rounded-md font-medium inline-block hover:bg-gray-100 transition-all transform hover:scale-105 shadow-lg"
          data-aos="fade-up" data-aos-delay="200">Get Started</a>
        <a href="/barbers"
          class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-md font-medium inline-block hover:bg-white hover:text-primary-700 transition-all transform hover:scale-105"
          data-aos="fade-up" data-aos-delay="300">Find Barbers</a>
      </div>
    </div>
  </section>
@endsection

  

 @section('additional_scripts')
  <!-- JavaScript -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    // Initialize AOS animation
    AOS.init({
      once: true,
      duration: 800,
    });

    // Mobile menu toggle
    document.getElementById('open-menu').addEventListener('click', function () {
      document.getElementById('mobile-menu').classList.remove('hidden');
    });

    document.getElementById('close-menu').addEventListener('click', function () {
      document.getElementById('mobile-menu').classList.add('hidden');
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.getElementById('mobile-menu').classList.add('hidden');

        document.querySelector(this.getAttribute('href')).scrollIntoView({
          behavior: 'smooth'
        });
      });
    });
  </script>
 @endsection 

 
