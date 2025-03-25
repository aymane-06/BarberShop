@extends('layouts.auth')

@section('additional_styles')
<style>
    body {
        font-family: 'Poppins', sans-serif;
        scroll-behavior: smooth;
    }
    .hero-gradient {
        background: linear-gradient(135deg, rgba(109, 40, 217, 0.95) 0%, rgba(91, 33, 182, 0.8) 100%);
    }
    .form-gradient {
        background: linear-gradient(145deg, #ffffff 0%, #f5f3ff 100%);
    }
    .floating {
        animation: float 6s ease-in-out infinite;
    }
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
        100% { transform: translateY(0px); }
    }
    .pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: .7; }
    }
    .btn-shine {
        position: relative;
        overflow: hidden;
    }
    .btn-shine::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        bottom: -50%;
        left: -50%;
        background: linear-gradient(to bottom, rgba(229, 172, 142, 0), rgba(255, 255, 255, 0.5) 50%, rgba(229, 172, 142, 0));
        transform: rotateZ(60deg) translate(-5em, 7.5em);
        animation: shine 3s infinite;
    }
    @keyframes shine {
        0% { transform: rotateZ(60deg) translate(-5em, 7.5em); }
        100% { transform: rotateZ(60deg) translate(5em, -7.5em); }
    }
    .scale-in {
        animation: scaleIn 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
    }
    @keyframes scaleIn {
        0% { transform: scale(0.8); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }
    .bounce-in {
        animation: bounceIn 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
    }
    @keyframes bounceIn {
        0% { transform: scale(0.3); opacity: 0; }
        50% { transform: scale(1.05); }
        70% { transform: scale(0.9); }
        100% { transform: scale(1); opacity: 1; }
    }
    .fade-in {
        animation: fadeIn 0.8s ease-out forwards;
    }
    @keyframes fadeIn {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }
    .fade-in-up {
        animation: fadeInUp 0.6s cubic-bezier(0.39, 0.575, 0.565, 1) forwards;
    }
    @keyframes fadeInUp {
        0% { transform: translateY(20px); opacity: 0; }
        100% { transform: translateY(0); opacity: 1; }
    }
    .envelope-animation {
        animation: envelope-bounce 2s infinite ease-in-out;
    }
    @keyframes envelope-bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-15px); }
    }
</style>
@endsection

@section('content')
<div class="flex-grow flex items-center justify-center px-4 py-10">
    <div class="w-full max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <!-- Left Column - Email Verification Instructions -->
        <div class="form-gradient p-8 rounded-xl shadow-lg scale-in" data-aos="fade-right">
            <div class="text-center mb-8">
                <div class="flex flex-col items-center justify-center mb-6">
                    <div class="h-24 w-24 relative mb-4 envelope-animation">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#6d28d9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Check Your Email</h1>
                    <p class="text-gray-600">We've sent a verification link to your email address.</p>
                </div>
                
                <div class="mb-6 p-4 bg-blue-50 text-blue-700 rounded-lg fade-in">
                    <p>Please check your inbox and click on the verification link to activate your account. If you don't see the email, please check your spam folder.</p>
                </div>

                <div class="space-y-4">
                    <form action="{{ route('verification.send') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-shine w-full bg-primary-600 hover:bg-primary-700 text-white py-3 px-6 rounded-lg font-medium transition-colors shadow-md">
                            Resend Verification Email
                            <i class="fas fa-envelope ml-2"></i>
                        </button>
                    </form>

                    @if (session('status'))
                        <div class="p-4 bg-green-50 text-green-700 rounded-lg fade-in">
                            <p>{{ session('status') }}</p>
                        </div>
                    @endif

                    <a href="{{ route('login') }}" class="block w-full py-3 px-6 text-center text-primary-600 hover:text-primary-800 font-medium">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Login
                    </a>
                </div>
            </div>
        </div>

        <!-- Right Column - Image and Text -->
        <div class="hidden md:block relative" data-aos="fade-left">
            <div class="hero-gradient rounded-xl p-8 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white rounded-full opacity-10 transform translate-x-10 -translate-y-10 pulse"></div>
                <div class="absolute bottom-0 left-0 w-40 h-40 bg-primary-400 rounded-full opacity-20 transform -translate-x-10 translate-y-10 pulse"></div>
                
                <div class="relative z-10 mb-8">
                    <h2 class="text-2xl font-bold mb-4 fade-in-up">Almost There!</h2>
                    <p class="mb-6 fade-in-up" style="animation-delay: 0.1s;">Verify your email to unlock all the premium features of CutBook.</p>
                    <ul class="space-y-3">
                        <li class="flex items-center fade-in-up" style="animation-delay: 0.2s;">
                            <i class="fas fa-check-circle text-green-300 mr-2"></i>
                            <span>Email verification keeps your account secure</span>
                        </li>
                        <li class="flex items-center fade-in-up" style="animation-delay: 0.3s;">
                            <i class="fas fa-check-circle text-green-300 mr-2"></i>
                            <span>Access all booking features once verified</span>
                        </li>
                        <li class="flex items-center fade-in-up" style="animation-delay: 0.4s;">
                            <i class="fas fa-check-circle text-green-300 mr-2"></i>
                            <span>Receive important notifications about appointments</span>
                        </li>
                    </ul>
                </div>

                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1585747860715-2ba37e788b70?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&h=350&q=80" 
                         alt="Email Verification" 
                         class="rounded-lg shadow-lg w-full h-48 object-cover floating">
                </div>

                <div class="mt-6 bg-white bg-opacity-20 p-4 rounded-lg backdrop-filter backdrop-blur-sm fade-in-up" style="animation-delay: 0.5s;">
                    <p class="italic font-light">"Verifying your email ensures you never miss an appointment notification." - CutBook Team</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('additional_scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    // Initialize AOS animation
    AOS.init({
        once: true,
        duration: 800,
    });
</script>
@endsection