@extends('layouts.app')

@section('additional_styles')
<style>
    body {
        font-family: 'Poppins', sans-serif;
        scroll-behavior: smooth;
    }
    
    .hero-gradient {
        background: linear-gradient(135deg, rgba(109, 40, 217, 0.95) 0%, rgba(91, 33, 182, 0.8) 100%);
        position: relative;
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
    
    .terms-card {
        transition: all 0.3s ease;
        border-left: 4px solid #7c3aed;
    }
    
    .terms-card:hover {
        box-shadow: 0 4px 12px rgba(124, 58, 237, 0.1);
        transform: translateX(2px);
    }
    
    .primary-btn {
        transition: all 0.3s ease;
        background-image: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%);
    }
    
    .primary-btn:hover:not([disabled]) {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(109, 40, 217, 0.25);
    }
</style>
@endsection

@section('content')
<section class="relative overflow-hidden"></section>
    <div class="hero-gradient text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-24">
            <div class="text-center" data-aos="fade-up" data-aos-duration="1000">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight text-shadow">Join Our Elite Barber Network</h1>
                <p class="text-lg md:text-xl mb-8 text-white z-30 relative max-w-2xl mx-auto">Connect with customers, manage bookings, and grow your business with the #1 barber booking platform</p>
                <a href="#terms" class="inline-block bg-white text-primary-700 px-8 py-3 rounded-full font-medium shadow-lg hover:shadow-xl transition-all transform hover:scale-105 animate-pulse">
                    Learn More
                </a>
            </div>
        </div>
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-yellow-400 rounded-full opacity-20 blur-xl"></div>
        <div class="absolute top-1/4 -left-20 w-60 h-60 bg-blue-500 rounded-full opacity-10 blur-xl"></div>
    </div>
    <div class="absolute bottom-0 left-0 right-0">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"></svg>
            <path fill="#f8fafc" fill-opacity="1" d="M0,192L48,170.7C96,149,192,107,288,112C384,117,480,171,576,186.7C672,203,768,181,864,165.3C960,149,1056,139,1152,144C1248,149,1344,171,1392,181.3L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</section>

<section id="terms" class="py-20 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up"></div>
            <h2 class="text-3xl font-bold text-gray-900">Partnership Terms & Conditions</h2>
            <p class="text-gray-600 mt-3">Review our simple terms before joining our professional network</p>
        </div>
        
        <div class="bg-white rounded-xl shadow-xl overflow-hidden" data-aos="fade-up" data-aos-delay="100">
            <div class="p-6 md:p-10">
                <div class="prose max-w-none text-gray-700 mb-8">
                    <p class="mb-6 text-lg">Before joining CutBook as a barber partner, please review these essential terms:</p>
                    
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="bg-gray-50 p-6 rounded-xl terms-card">
                            <div class="flex items-center mb-4">
                                <div class="bg-primary-100 p-3 rounded-full text-primary-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold ml-4">Registration Requirements</h3>
                            </div>
                            <ul class="list-disc pl-5 space-y-2">
                                <li>Valid professional barber license/certification</li>
                                <li>Business registration documents</li>
                                <li>Proof of identity</li>
                                <li>Professional photos and service description</li>
                            </ul>
                        </div>
                        
                        <div class="bg-gray-50 p-6 rounded-xl terms-card">
                            <div class="flex items-center mb-4">
                                <div class="bg-primary-100 p-3 rounded-full text-primary-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"></svg>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold ml-4">Commission Structure</h3>
                            </div>
                            <p class="mb-2">10% commission fee per booking, covering:</p>
                            <ul class="list-disc pl-5 space-y-2">
                                <li>Complete booking system</li>
                                <li>Marketing and promotion</li>
                                <li>Payment processing</li>
                                <li>Premium customer support</li>
                            </ul>
                        </div>
                        
                        <div class="bg-gray-50 p-6 rounded-xl terms-card">
                            <div class="flex items-center mb-4">
                                <div class="bg-primary-100 p-3 rounded-full text-primary-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"></svg>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold ml-4">Quality Standards</h3>
                            </div>
                            <ul class="list-disc pl-5 space-y-2">
                                <li>Maintain professional service quality</li>
                                <li>Honor all platform appointments</li>
                                <li>Keep availability calendar updated</li>
                                <li>Respond to inquiries within 24 hours</li>
                            </ul>
                        </div>
                        
                        <div class="bg-gray-50 p-6 rounded-xl terms-card">
                            <div class="flex items-center mb-4">
                                <div class="bg-primary-100 p-3 rounded-full text-primary-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold ml-4">Cancellation Policy</h3>
                            </div>
                            <ul class="list-disc pl-5 space-y-2"></ul>
                                <li>24-hour advance notice for cancellations</li>
                                <li>Penalties for repeated cancellations</li>
                                <li>Special considerations for emergencies</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="mt-8 bg-primary-50 p-6 rounded-xl border border-primary-200">
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary-600 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"></svg></svg>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="ml-3 text-primary-800"></p>
                                <span class="font-medium">Important:</span> Payments are processed weekly via direct deposit to your registered bank account. View detailed reports in your dashboard. Either party may terminate with 30 days notice.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="mb-8 flex items-center bg-gray-50 p-4 rounded-lg border border-gray-200">
                <form action="{{ route("barber.barberJoin.submit") }}" method="POST">
                    @csrf
                    <input type="checkbox" id="agree-terms" name="agree-terms" class="h-5 w-5 text-primary-600 rounded border-gray-300 focus:ring-primary-500" required>
                    <label for="agree-terms" class="ml-3 text-gray-700 font-medium">I have read and agree to the Terms & Conditions</label>
                    </div>
                
                    <div class="flex flex-col sm:flex-row sm:justify-between gap-4">
                    <button type="submit"  id="join-btn" class="primary-btn text-white px-8 py-3 rounded-lg font-medium text-center shadow-lg opacity-50 cursor-not-allowed flex justify-center items-center" disabled>
                        <span>Join as a Professional Barber</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    
                </form>

                    <a href="/" class="bg-transparent border border-gray-300 text-gray-700 px-8 py-3 rounded-lg font-medium text-center hover:bg-gray-50 transition-all">
                        Cancel
                    </a>
                </div>
                
            </div>
        </div>
    </div>
</section>
@endsection

@section('additional_scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    // Initialize AOS animation with better settings
    AOS.init({
        once: true,
        duration: 800,
        easing: 'ease-out-cubic',
        delay: 100,
    });
    
    // Handle checkbox toggle for button activation with animation
    document.getElementById('agree-terms').addEventListener('change', function() {
        const joinBtn = document.getElementById('join-btn');
        
        if (this.checked) {
            joinBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            joinBtn.classList.add('animate-pulse');
            setTimeout(() => {
                joinBtn.classList.remove('animate-pulse');
            }, 1000);
            joinBtn.removeAttribute('disabled');
        } else {
            joinBtn.classList.add('opacity-50', 'cursor-not-allowed');
            joinBtn.setAttribute('disabled', 'disabled');
        }
    });
    
    // Smooth scroll for "Learn More" button
    document.querySelector('a[href="#terms"]').addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelector('#terms').scrollIntoView({
            behavior: 'smooth'
        });
    });
</script>
@endsection
