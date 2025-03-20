@extends('front.layouts.app')

@section('main')

    <!-- Header Start -->
    <div class="container-xxl py-5 bg-dark page-header mb-5" style="background-image:url('{{ asset('assets/images/banner-1.jpg') }}'); background-position: center; background-repeat: no-repeat; background-size: cover;">
        <div class="container my-5 pt-5 pb-4 text-center">
            <h1 class="display-3 text-white mb-3 animated slideInDown">About Us</h1>
            <p class="text-white fs-5">Discover who we are and how we can help you!</p>
        </div>
    </div>
    <!-- Header End -->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <!-- Image Section -->
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="row g-0 about-bg rounded overflow-hidden shadow-lg">
                        <div class="col-6 text-start">
                            <img class="img-fluid w-100 rounded" src="{{ asset('assets/images/banner-1.jpg') }}" alt="About Image 1" style="object-fit: cover;">
                        </div>
                        <div class="col-6 text-start">
                            <img class="img-fluid rounded" src="{{ asset('assets/images/banner-2.jpg') }}" alt="About Image 2" style="object-fit: cover; width: 85%; margin-top: 15%;">
                        </div>
                        <div class="col-6 text-end">
                            <img class="img-fluid rounded" src="{{ asset('assets/images/banner3.jpg') }}" alt="About Image 3" style="object-fit: cover; width: 85%;">
                        </div>
                        <div class="col-6 text-end">
                            <img class="img-fluid w-100 rounded" src="{{ asset('assets/images/banner4.jpg') }}" alt="About Image 4" style="object-fit: cover;">
                        </div>
                    </div>
                </div>

                <!-- Text Section -->
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="mb-4 text-primary">We Help You Get the Best Job and Find Top Talent</h1>
                    <p class="mb-4 fs-5 text-muted">We connect job seekers with top employers to build successful careers. Our platform makes it easy for you to find the perfect job or the perfect candidate.</p>
                    <ul class="mb-4 text-muted">
                        <li><i class="fa fa-check text-primary me-3"></i>Discover the best job opportunities</li>
                        <li><i class="fa fa-check text-primary me-3"></i>Find top talents to grow your business</li>
                        <li><i class="fa fa-check text-primary me-3"></i>Seamless experience with easy-to-use tools</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

@endsection

@section('customJs')
@endsection
