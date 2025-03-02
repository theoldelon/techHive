@extends('front.layouts.app')

@section('main')

    <!-- Header Start -->
    <div class="container-xxl py-5 bg-dark page-header mb-5" style="background-image:url('{{ asset('assets/images/banner-1.jpg') }}'); background-position: center; background-repeat: no-repeat; background-size: cover;">
        <div class="container my-5 pt-5 pb-4 text-center">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Privacy & Policy</h1>
            <p class="text-white fs-5">Please read our privacy policy and terms of use carefully before using this website.</p>
        </div>
    </div>
    <!-- Header End -->

    <!-- Privacy & Policy Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <!-- Row 1: Image on the Right, Text on the Left -->
            <div class="row g-5 mb-5">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="row g-0 about-bg rounded overflow-hidden shadow-lg">
                        <div class="col-12 text-start">
                            <img class="img-fluid w-100 rounded" src="{{ asset('assets/images/banner-1.jpg') }}" alt="Privacy Image" style="object-fit: cover;">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="mb-4 text-primary">Welcome to TechHive Privacy & Policy</h1>
                    <p class="mb-4 fs-5 text-muted">By using our website, you agree to comply with the privacy and policies outlined below. If you do not agree, please refrain from using this website.</p>
                    <h4>Effective Date: November 28, 2024</h4>
                </div>
            </div>

            <!-- Row 2: Image on the Left, Text on the Right -->
            <div class="row g-5 mb-5">
                <div class="col-lg-6 wow fadeIn p-5" data-wow-delay="0.1s">
                    <h3>1. Data Collection & Usage</h3>
                    <p>We collect personal information when you use our website, such as:</p>
                    <ul class="mb-4 text-muted">
                        <li><i class="fa fa-check text-primary me-3"></i>Your name and contact details when you register or fill out forms.</li>
                        <li><i class="fa fa-check text-primary me-3"></i>Browsing data and cookies to enhance user experience and personalize content.</li>
                        <li><i class="fa fa-check text-primary me-3"></i>Payment information if you make purchases or donations on our site.</li>
                    </ul>
                    <p>We use this information for the purposes of providing services, improving the website, and for marketing communications (with your consent).</p>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <div class="row g-0 about-bg rounded overflow-hidden shadow-lg">
                        <div class="col-12 text-start">
                            <img class="img-fluid w-100 rounded" src="{{ asset('assets/images/banner-2.jpg') }}" alt="Image 2" style="object-fit: cover;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 3: Image on the Right, Text on the Left -->
            <div class="row g-5 mb-5">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="row g-0 about-bg rounded overflow-hidden shadow-lg">
                        <div class="col-12 text-start">
                            <img class="img-fluid w-100 rounded" src="{{ asset('assets/images/banner3.jpg') }}" alt="Image 3" style="object-fit: cover;">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn p-5" data-wow-delay="0.5s">
                    <h3>2. How We Protect Your Information</h3>
                    <p>We take data protection seriously. We use secure servers, encryption technologies, and other security measures to protect your personal data.</p>
                </div>
            </div>

            <!-- Row 4: Image on the Left, Text on the Right -->
            <div class="row g-5 mb-5">
                <div class="col-lg-6 wow fadeIn p-5" data-wow-delay="0.1s">
                    <h3>3. Payment Policy</h3>
                    <p>Our payment policy ensures a safe and transparent transaction process. When making a payment:</p>
                    <ul class="mb-4 text-muted">
                        <li><i class="fa fa-check text-primary me-3"></i>We accept credit/debit cards and other payment methods as listed on the site.</li>
                        <li><i class="fa fa-check text-primary me-3"></i>Payments are non-refundable unless stated otherwise in specific terms.</li>
                    </ul>
                    <p>By proceeding with a payment, you acknowledge and agree to these payment terms. If you experience any issues with payments, please contact our support team.</p>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <div class="row g-0 about-bg rounded overflow-hidden shadow-lg">
                        <div class="col-12 text-start">
                            <img class="img-fluid w-100 rounded" src="{{ asset('assets/images/banner4.jpg') }}" alt="Payment Image" style="object-fit: cover;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 5: Data Retention -->
            <div class="row g-5 mb-5">
                <div class="col-lg-6 wow fadeIn p-5" data-wow-delay="0.1s">
                    <h3>4. Data Retention</h3>
                    <p>We retain your personal information only for as long as necessary to fulfill the purposes outlined in this Privacy Policy, unless a longer retention period is required by law.</p>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <div class="row g-0 about-bg rounded overflow-hidden shadow-lg">
                        <div class="col-12 text-start">
                            <img class="img-fluid w-100 rounded" src="{{ asset('assets/images/banner5.jpg') }}" alt="Image 5" style="object-fit: cover;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 6: User Rights and Choices -->
            <div class="row g-5 mb-5">
                <div class="col-lg-6 wow fadeIn p-5" data-wow-delay="0.1s">
                    <h3>5. Your Rights</h3>
                    <p>You have the right to:</p>
                    <ul class="mb-4 text-muted">
                        <li><i class="fa fa-check text-primary me-3"></i>Access the personal information we hold about you.</li>
                        <li><i class="fa fa-check text-primary me-3"></i>Request corrections to any inaccuracies in your information.</li>
                        <li><i class="fa fa-check text-primary me-3"></i>Request the deletion of your personal information (subject to certain legal exceptions).</li>
                    </ul>
                    <p>If you would like to exercise any of these rights, please contact our support team.</p>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <div class="row g-0 about-bg rounded overflow-hidden shadow-lg">
                        <div class="col-12 text-start">
                            <img class="img-fluid w-100 rounded" src="{{ asset('assets/images/banner6.jpg') }}" alt="User Rights" style="object-fit: cover;">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Privacy & Policy End -->

@endsection

@section('customJs')
@endsection
