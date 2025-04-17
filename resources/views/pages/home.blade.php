@extends('layouts.app')

@section('additional_styles')
<style>
  *{
    scroll-behavior: smooth;
  }
  .text-shadow {
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
  }
  .animate-fade-in-down {
    animation: fade-in-down 1s ease-out;
  }
  .animate-fade-in {
    animation: fade-in 1.5s ease-out;
  }
  @keyframes fade-in-down {
    0% {
      opacity: 0;
      transform: translateY(-20px);
    }
    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }
  @keyframes fade-in {
    0% {
      opacity: 0;
    }
    100% {
      opacity: 1;
    }
  }
  
  /* Responsive improvements */
  @media (max-width: 640px) {
    .hero-content h1 {
      font-size: 2.5rem;
    }
    .hero-content p {
      font-size: 1rem;
    }
  }
</style>
@endsection

@section('content')
<!-- Hero Section with Video Background -->
<section class="relative overflow-hidden min-h-screen flex items-center">
  <!-- Video Background -->
  <div class="absolute inset-0 w-full h-full z-0 overflow-hidden">
    <video class="absolute inset-0 w-full h-full object-cover" autoplay muted loop playsinline>
      <source src="{{ asset('Videos/hero.mp4') }}" type="video/mp4">
    </video>
    <!-- <img src="{{ asset('Videos/Gen-4 Turbo  3775727470.mp4.gif') }}" 
         alt="Luxury barbershop interior" 
         class="absolute inset-0 w-full h-full object-cover"
         onerror="this.onerror=null; this.style.display='none'; document.getElementById('fallback-image').style.display='block';">
    <img id="fallback-image" 
         src="{{ asset('images/barbershop-bg.jpg') }}" 
         alt="Barbershop" 
         class="absolute inset-0 w-full h-full object-cover" 
         style="display: none;"> -->
    <div class="absolute inset-0 bg-gradient-to-r from-black/80 to-primary-900/70 z-10"></div>
  </div>

  <!-- Content overlay -->
  <div class="relative z-20 container mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
    <div class="flex flex-col lg:flex-row items-center gap-10">
      <div class="w-full lg:w-3/5 text-white hero-content" data-aos="fade-right" data-aos-duration="1200">
        <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-6 leading-tight text-shadow animate-fade-in-down">
          <span class="text-transparent bg-clip-text bg-gradient-to-r from-white to-primary-200">Style</span> Your Confidence
        </h1>
        <p class="text-lg sm:text-xl mb-8 text-gray-100 max-w-lg animate-fade-in">Discover expert barbers who transform not just your look, but your entire experience. Book your perfect cut in seconds.</p>
        
        <div class="flex flex-col sm:flex-row gap-4 mb-10">
          @guest
          <a href="/register" 
            class="group bg-white text-primary-700 px-6 py-4 rounded-md font-medium text-center shadow-lg hover:bg-primary-600 hover:text-white transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
            <span>Find Your Barber</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 group-hover:translate-x-1 transition-transform" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
          </a>
          @endguest
          @if (Auth::user()?->role !== 'barber')
          <a href="{{ route('barber.barberJoin') }}"
            class="group backdrop-blur-md bg-primary-600/50 hover:bg-primary-600 border-2 border-primary-400 text-white px-6 py-3.5 rounded-md font-medium text-center transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
            <i class="fas fa-cut mr-2"></i>
            <span>Join as a Barber</span>
          </a>
          @endif
        </div>
        
        <!-- Scroll indicator for larger screens -->
        <div class="hidden md:block">
          <a href="#features" class="inline-flex items-center text-white/80 hover:text-white transition-colors">
            <span class="mr-2">Explore Features</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
          </a>
        </div>
      </div>
      
      <!-- Floating appointment card -->
      <div class="w-full lg:w-2/5" data-aos="fade-up" data-aos-delay="300">
        <div class="relative">
          <div class="absolute -top-10 -right-10 w-32 h-32 bg-primary-400 rounded-full opacity-20 animate-pulse hidden lg:block"></div>
          <div class="backdrop-blur-lg bg-white/10 p-6 rounded-xl border border-white/20 shadow-2xl transition-all duration-500 hover:shadow-primary-500/30">
        <h3 class="text-lg font-semibold text-white mb-4">Find Your Perfect Barber</h3>
        
        <!-- Location Search -->
        <div class="mb-4">
          <label for="location" class="block text-white text-sm mb-2">Your Location</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
          <i class="fas fa-map-marker-alt text-gray-400"></i>
            </div>
            <input type="text" id="location" name="location" placeholder="Enter your city or zip code" 
               class="w-full py-3 pl-10 pr-4 bg-white/20 border border-white/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 text-white placeholder-gray-300">
          </div>
        </div>
        
        <!-- Date Selection -->
        <div class="mb-4">
          <label for="date" class="block text-white text-sm mb-2">Preferred Date</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
          <i class="fas fa-calendar text-gray-400"></i>
            </div>
            <input type="date" id="date" name="date" 
               class="w-full py-3 pl-10 pr-4 bg-white/20 border border-white/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 text-white">
          </div>
        </div>
        
        <!-- Quick Date Selection -->
        <div class="flex space-x-2 mb-4">
              <label class="relative flex-1 group">
                <input type="radio" name="quick_date" value="{{ date('Y-m-d') }}" class="peer sr-only">
                <div class="flex-1 bg-white/20 hover:bg-primary-600/50 peer-checked:bg-primary-600/50 text-white text-sm py-2 rounded-lg transition-colors text-center cursor-pointer w-full">
                  Today
                </div>
              </label>
              <label class="relative flex-1 group">
                <input type="radio" name="quick_date" value="{{ date('Y-m-d', strtotime('+1 day')) }}" class="peer sr-only">
                <div class="flex-1 bg-white/20 hover:bg-primary-600/50 peer-checked:bg-primary-600/50 text-white text-sm py-2 rounded-lg transition-colors text-center cursor-pointer w-full">
                  Tomorrow
                </div>
              </label>
              <label class="relative flex-1 group">
                <input type="radio" name="quick_date" value="{{ date('Y-m-d', strtotime('+7 day')) }}" class="peer sr-only">
                <div class="flex-1 bg-white/20 hover:bg-primary-600/50 peer-checked:bg-primary-600/50 text-white text-sm py-2 rounded-lg transition-colors text-center cursor-pointer w-full">
                  Next Week
                </div>
              </label>
        </div>

        <button class="w-full bg-white text-primary-700 py-3 rounded-md font-medium hover:bg-primary-50 transition-colors flex items-center justify-center">
          <i class="fas fa-search mr-2"></i>
          Find Available Barbers
        </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- Features Section -->
<section id="features" class="py-12 md:py-20 bg-gray-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-10 md:mb-16">
      <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-4" data-aos="fade-up">Why Choose Our Platform</h2>
      <p class="text-base sm:text-lg text-gray-600 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">We've reimagined the barbershop experience from booking to checkout.</p>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 md:gap-10">
      <div class="bg-white p-6 md:p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow" data-aos="fade-up" data-aos-delay="150">
        <div class="bg-primary-100 text-primary-600 w-14 h-14 rounded-full flex items-center justify-center mb-5">
          <i class="fas fa-calendar-alt text-2xl"></i>
        </div>
        <h3 class="text-xl font-semibold mb-3 text-gray-900">Easy Scheduling</h3>
        <p class="text-gray-600">Book appointments with your favorite barber in seconds, 24/7. No more waiting on hold or showing up to a packed shop.</p>
      </div>
      
      <div class="bg-white p-6 md:p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow" data-aos="fade-up" data-aos-delay="300">
        <div class="bg-primary-100 text-primary-600 w-14 h-14 rounded-full flex items-center justify-center mb-5">
          <i class="fas fa-map-marker-alt text-2xl"></i>
        </div>
        <h3 class="text-xl font-semibold mb-3 text-gray-900">Find Local Experts</h3>
        <p class="text-gray-600">Discover top-rated barbers in your area with our advanced search filters, reviews, and portfolio galleries.</p>
      </div>
      
      <div class="bg-white p-6 md:p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow" data-aos="fade-up" data-aos-delay="450">
        <div class="bg-primary-100 text-primary-600 w-14 h-14 rounded-full flex items-center justify-center mb-5">
          <i class="fas fa-bell text-2xl"></i>
        </div>
        <h3 class="text-xl font-semibold mb-3 text-gray-900">Smart Reminders</h3>
        <p class="text-gray-600">Never miss an appointment with personalized reminders and easy rescheduling when life gets in the way.</p>
      </div>
    </div>
  </div>
</section>

<!-- Services Section -->
<section class="py-12 md:py-20 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row items-center">
      <div class="w-full md:w-1/2 md:pr-6 lg:pr-12 mb-10 md:mb-0" data-aos="fade-right">
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-4 md:mb-6">Premium Services for Every Style</h2>
        <p class="text-base sm:text-lg text-gray-600 mb-6 md:mb-8">From classic cuts to modern styles, our network of professional barbers offers a wide range of services to keep you looking your best.</p>
        
        <div class="space-y-4">
          <div class="flex items-start">
            <div class="flex-shrink-0 bg-primary-100 rounded-full p-2 mr-4">
              <i class="fas fa-cut text-primary-600"></i>
            </div>
            <div>
              <h3 class="font-semibold text-gray-900">Classic Haircuts</h3>
              <p class="text-gray-600">Professional precision cuts tailored to your face shape and style.</p>
            </div>
          </div>
          
          <div class="flex items-start">
            <div class="flex-shrink-0 bg-primary-100 rounded-full p-2 mr-4">
              <i class="fas fa-ruler text-primary-600"></i>
            </div>
            <div>
              <h3 class="font-semibold text-gray-900">Beard Trimming & Shaping</h3>
              <p class="text-gray-600">Expert grooming to keep your facial hair looking intentional and sharp.</p>
            </div>
          </div>
          
          <div class="flex items-start">
            <div class="flex-shrink-0 bg-primary-100 rounded-full p-2 mr-4">
              <i class="fas fa-spa text-primary-600"></i>
            </div>
            <div>
              <h3 class="font-semibold text-gray-900">Hot Towel Shaves</h3>
              <p class="text-gray-600">Enjoy the luxury of a traditional hot towel shave for the smoothest finish.</p>
            </div>
          </div>
        </div>
        
        <a href="#" class="inline-block mt-6 md:mt-8 bg-primary-600 text-white px-6 py-3 rounded-md font-medium hover:bg-primary-700 transition-colors">
          View All Services
        </a>
      </div>
      
      <div class="w-full md:w-1/2" data-aos="fade-left">
        <div class="grid grid-cols-2 gap-3 md:gap-4">
          <div>
            <img src="" alt="Haircut service" class="rounded-lg shadow-md mb-3 md:mb-4 h-48 md:h-64 w-full object-cover">
            <img src="" alt="Beard trimming" class="rounded-lg shadow-md h-32 md:h-40 w-full object-cover">
          </div>
          <div class="pt-5 md:pt-10">
            <img src="" alt="Hot towel shave" class="rounded-lg shadow-md mb-3 md:mb-4 h-32 md:h-40 w-full object-cover">
            <img src="" alt="Styling" class="rounded-lg shadow-md h-48 md:h-64 w-full object-cover">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Testimonials Section -->
<section class="py-12 md:py-20 bg-gradient-to-r from-primary-900 to-primary-700 text-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-10 md:mb-16">
      <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4" data-aos="fade-up">What Our Customers Say</h2>
      <p class="text-base sm:text-lg text-primary-100 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">Real stories from satisfied customers who have found their perfect barber through our platform.</p>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 md:gap-8">
      <div class="bg-white/10 backdrop-blur-lg p-6 md:p-8 rounded-xl border border-white/20" data-aos="fade-up" data-aos-delay="150">
        <div class="text-primary-200 mb-4">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <p class="mb-6 italic">"I've never had such an easy time finding a great barber. The platform made it simple to see portfolio work and read real reviews."</p>
        <div class="flex items-center">
          <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Customer" class="w-12 h-12 rounded-full mr-4">
          <div>
            <h4 class="font-semibold">Marcus Thompson</h4>
            <p class="text-primary-200 text-sm">Loyal customer since 2022</p>
          </div>
        </div>
      </div>
      
      <div class="bg-white/10 backdrop-blur-lg p-6 md:p-8 rounded-xl border border-white/20" data-aos="fade-up" data-aos-delay="300">
        <div class="text-primary-200 mb-4">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <p class="mb-6 italic">"The convenience of booking appointments online has been a game changer. No more waiting around or guessing when my barber has an opening."</p>
        <div class="flex items-center">
          <img src="https://randomuser.me/api/portraits/men/78.jpg" alt="Customer" class="w-12 h-12 rounded-full mr-4">
          <div>
            <h4 class="font-semibold">Alex Rodriguez</h4>
            <p class="text-primary-200 text-sm">Loyal customer since 2021</p>
          </div>
        </div>
      </div>
      
      <div class="bg-white/10 backdrop-blur-lg p-6 md:p-8 rounded-xl border border-white/20" data-aos="fade-up" data-aos-delay="450">
        <div class="text-primary-200 mb-4">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star-half-alt"></i>
        </div>
        <p class="mb-6 italic">"I moved to a new city and was worried about finding a good barber. This platform made it so easy to find someone who specializes in my hair type."</p>
        <div class="flex items-center">
          <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Customer" class="w-12 h-12 rounded-full mr-4">
          <div>
            <h4 class="font-semibold">Jamal Wilson</h4>
            <p class="text-primary-200 text-sm">Loyal customer since 2023</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA Section -->
<section class="py-12 md:py-20 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-primary-50 rounded-2xl p-6 sm:p-10 md:p-16 relative overflow-hidden" data-aos="fade-up">
      <div class="absolute right-0 top-0 w-full h-full overflow-hidden opacity-10">
        <img src="https://images.unsplash.com/photo-1621354241566-f0954fa3402c" alt="Background pattern" class="w-full h-full object-cover">
      </div>
      
      <div class="relative z-10 w-full md:w-3/5">
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-4 md:mb-6">Ready for Your Next Great Haircut?</h2>
        <p class="text-base sm:text-lg text-gray-600 mb-6 md:mb-8">Join thousands of satisfied customers who have found their perfect barber. Book your appointment today and experience the difference.</p>
        
        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
          <a href="/register" class="inline-block bg-primary-600 text-white px-6 py-3 rounded-md font-medium hover:bg-primary-700 transition-colors text-center">
            Find a Barber Near You
          </a>
          <a href="{{ route('barber.barberJoin') }}" class="inline-block bg-white text-primary-700 border-2 border-primary-600 px-6 py-3 rounded-md font-medium hover:bg-primary-50 transition-colors text-center">
            Join as a Barber
          </a>
        </div>
      </div>
    </div>
  </div>
</section>


@endsection

@section('additional_scripts')
<!-- AOS Animation Library Initialization -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    AOS.init({
      once: true,
      disable: 'phone',
      duration: 700,
      easing: 'ease-out-cubic',
    });
  });
</script>
@endsection
