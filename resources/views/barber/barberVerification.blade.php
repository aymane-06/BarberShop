@extends('layouts.auth')

@section('additional_styles')
<style>
    /* Style definitions remain unchanged */
    body {
        font-family: 'Poppins', sans-serif;
        scroll-behavior: smooth;
    }
    /* ... all other styles ... */
</style>
@endsection

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Alert Banner -->
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-8 rounded-md shadow-sm scale-in">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-yellow-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        Your barbershop is pending verification. Please complete the verification process to access your dashboard.
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header -->
            <div class="hero-gradient px-6 py-8 sm:p-10 sm:pb-6">
                <div class="flex justify-between items-center flex-wrap">
                    <div>
                        <h2 class="text-2xl leading-8 font-bold text-black text-shadow">Barbershop Verification</h2>
                        <p class="mt-2 text-base text-gray-700">Complete these steps to verify your barbershop and access your dashboard</p>
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <span class="inline-flex rounded-md shadow-sm"></span></span>
                            <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-primary-700 bg-white hover:bg-gray-100 focus:outline-none focus:border-primary-300 focus:shadow-outline-primary transition ease-in-out duration-150">
                                <i class="fas fa-home mr-2"></i> Return to Homepage
                            </a>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="px-6 py-8 sm:p-10"></div>
                <div class="mb-8 text-center">
                    <div class="mx-auto w-32 h-32 mb-6 rounded-full bg-primary-100 flex items-center justify-center">
                        <i class="fas fa-store-alt text-primary-600 text-5xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Your barbershop is under review</h3>
                    <p class="text-gray-600">We're currently reviewing your information to verify your barbershop status.</p>
                </div>

                <!-- Verification Steps -->
                <div class="space-y-6 mt-10">
                    <!-- Step 1: Registration -->
                    <div class="verification-step completed">
                        <div class="flex items-center">
                            <div class="step-number flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center mr-4 shadow-sm">
                                <i class="fas fa-check"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-medium text-gray-900">Registration Complete</h4>
                                <p class="text-sm text-gray-500">You've successfully created your account</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Email Verification -->
                    <div class="verification-step {{ Auth::user()->email_verified_at ? 'completed' : 'active' }}">
                        <div class="flex items-center">
                            <div class="step-number flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center mr-4 shadow-sm">
                                @if(Auth::user()->email_verified_at)
                                    <i class="fas fa-check"></i>
                                @else
                                    <i class="fas fa-envelope"></i>
                                @endif
                            </div>
                            <div>
                                <h4 class="text-lg font-medium text-gray-900">Email Verification</h4>
                                <p class="text-sm text-gray-500">
                                    @if(Auth::user()->email_verified_at)
                                        Your email address has been verified
                                    @else
                                        Please check your inbox and verify your email address
                                    @endif
                                </p>
                            </div>
                            @if(!Auth::user()->email_verified_at)
                                <div class="ml-auto">
                                    <form method="POST" action="">
                                        @csrf
                                        <button type="submit" class="text-primary-600 hover:text-primary-800 text-sm font-medium">
                                            Resend verification email
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Step 3: Create Barbershop -->
                    <div class="verification-step {{ isset(auth()->user()->barbershop) ? 'completed' : 'active' }}">
                        <div class="flex items-center">
                            <div class="step-number flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center mr-4 shadow-sm">
                                @if(isset(auth()->user()->barbershop))
                                    <i class="fas fa-check"></i>
                                @else
                                    <i class="fas fa-store"></i>
                                @endif
                            </div>
                            <div>
                                <h4 class="text-lg font-medium text-gray-900">Barbershop Setup</h4>
                                <p class="text-sm text-gray-500">
                                    @if(isset(auth()->user()->barbershop))
                                        You've successfully set up your barbershop
                                    @else
                                        Create your barbershop profile to continue
                                    @endif
                                </p>
                            </div>
                            @if(!isset(auth()->user()->barbershop))
                                <div class="ml-auto">
                                    <a href="{{ route('barber.barbershop.create') }}" class="text-primary-600 hover:text-primary-800 text-sm font-medium">
                                        Create barbershop
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Step 4: Document Verification -->
                    <div class="verification-step {{ isset($documents) && $documents->count() > 0 ? 'completed' : (isset(auth()->user()->barbershop) ? 'active' : 'pending') }}">
                        <div class="flex items-center">
                            <div class="step-number flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center mr-4 shadow-sm">
                                @if(isset($documents) && $documents->count() > 0)
                                    <i class="fas fa-check"></i>
                                @elseif(isset(auth()->user()->barbershop))
                                    <i class="fas fa-file-alt"></i>
                                @else
                                    <i class="fas fa-clock"></i>
                                @endif
                            </div>
                            <div>
                                <h4 class="text-lg font-medium text-gray-900">Document Verification</h4>
                                <p class="text-sm text-gray-500">
                                    @if(isset($documents) && $documents->count() > 0)
                                        Your documents have been submitted for review
                                    @elseif(isset(auth()->user()->barbershop))
                                        Upload required documents to verify your barbershop status
                                    @else
                                        Complete previous steps first
                                    @endif
                                </p>
                            </div>
                            @if(isset(auth()->user()->barbershop) && (!isset($documents) || $documents->count() == 0))
                                <div class="ml-auto">
                                    <a href="" class="text-primary-600 hover:text-primary-800 text-sm font-medium">
                                        Upload documents
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Step 5: Admin Review -->
                    <div class="verification-step {{ auth()->user()->barbershop->is_verified ? 'completed' : 'pending' }}">
                        <div class="flex items-center">
                            <div class="step-number flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center mr-4 shadow-sm">
                                @if(auth()->user()->barbershop->is_verified)
                                    <i class="fas fa-check"></i>
                                @else
                                    <i class="fas fa-user-shield"></i>
                                @endif
                            </div>
                            <div>
                                <h4 class="text-lg font-medium text-gray-900">Admin Review</h4>
                                <p class="text-sm text-gray-500">
                                    @if(auth()->user()->barbershop->is_verified)
                                        {{ auth()->user()}}
                                        Your barbershop has been verified by our team
                                    @else
                                        Our team will review your information and documents
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Current Status -->
                <div class="mt-12 bg-gray-50 rounded-lg p-6 fade-in">
                    <div class="flex items-center"></div>
                        <div class="flex-shrink-0">
                            @if(auth()->user()->barbershop->is_verified)
                                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                                    <i class="fas fa-check text-green-600 text-xl"></i>
                                </div>
                            @else
                                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                                    <i class="fas fa-hourglass-half text-blue-600 text-xl"></i>
                                </div>
                            @endif
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-medium text-gray-900">
                                @if(auth()->user()->barbershop->is_verified)
                                    Verification Complete!
                                @else
                                    Verification in Progress
                                @endif
                            </h4>
                            <p class="text-gray-600">
                                @if(auth()->user()->barbershop->is_verified)
                                    Your barbershop has been fully verified. You can now access your barbershop dashboard.
                                @else
                                    We're currently reviewing your information. This typically takes 1-3 business days.
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-8 flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    @if(auth()->user()->barbershop->is_verified)
                        <a href="{{ route('barber.dashboard') }}" class="btn-shine w-full bg-primary-600 hover:bg-primary-700 text-white py-3 px-6 rounded-md font-medium transition-colors shadow-md text-center">
                            Access Dashboard
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    @else
                        <button disabled class="w-full bg-gray-300 text-gray-600 py-3 px-6 rounded-md font-medium shadow-md text-center cursor-not-allowed">
                            Dashboard Access Pending
                            <i class="fas fa-lock ml-2"></i>
                        </button>
                        <a href="" class="w-full border border-primary-600 text-primary-600 hover:bg-primary-50 py-3 px-6 rounded-md font-medium transition-colors text-center">
                            <i class="fas fa-question-circle mr-2"></i>
                            Need Help?
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="mt-10 card-hover bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-semibold mb-4">Frequently Asked Questions</h3>
            <div class="space-y-4">
                <div>
                    <h4 class="font-medium text-primary-700">How long does verification take?</h4>
                    <p class="mt-1 text-sm text-gray-600">Verification typically takes 1-3 business days after all required documents are submitted.</p>
                </div>
                <div>
                    <h4 class="font-medium text-primary-700">What documents do I need to provide?</h4>
                    <p class="mt-1 text-sm text-gray-600">You'll need to provide business registration, proof of ownership, and any applicable licenses for your barbershop.</p>
                </div>
                <div>
                    <h4 class="font-medium text-primary-700">What if my verification is rejected?</h4>
                    <p class="mt-1 text-sm text-gray-600">If your verification is rejected, you'll receive an email explaining why and instructions on how to resubmit.</p>
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
