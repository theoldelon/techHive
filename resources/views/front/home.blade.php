@extends('front.layouts.app')

@section('main')
<section class="section-0 lazy d-flex align-items-center text-white py-5" style="min-height: 100vh; position: relative;">
    <video autoplay muted loop playsinline class="position-absolute w-100 h-100" style="object-fit: cover; z-index: -1;">
        <source src="{{ asset('assets/images/videoCall.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="container">
        <div class="row align-items-center text-center text-xl-start">
            <div class="col-12 col-xl-8">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(43, 57, 64, .5);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h1 class="display-3 text-white animated slideInDown mb-4">Empowering Filipino Talent.</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-2">"Connecting clients with skilled Filipino freelancers to bring visions to life."</p>
                                <a href="{{ route('jobs') }}" class="btn search-btn py-md-3 px-md-5 animated slideInRight p-2" style="background-color: rgb(51, 130, 221);  color: rgb(255, 255, 255);">Search Job</a>
                                <a href="{{ route('browseFreelancers') }}" class="btn search-btn py-md-3 px-md-5 animated slideInRight p-2" style="background-color: rgb(133, 139, 160);  color: rgb(255, 255, 255); margin-left: 15px;">Search Freelancers</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="section-1 py-5 "> 
    <div class="container">
        <div class="card border-0 shadow p-5">
            <form action="{{ route('jobs') }}" method="GET">
                <div class="row">
                    <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                        <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Keywords">
                    </div>

                    <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                        <input type="text" class="form-control" name="location" id="location" placeholder="Location">
                    </div>

                    <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                        <select name="category" id="category" class="form-control">
                            <option value="">Select a Category</option>
                        @if ($newCategories->isNotEmpty())
                            @foreach ($newCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        @endif
                        </select>
                    </div>
                    
                    <div class=" col-md-3 mb-xs-3 mb-sm-3 mb-lg-0">
                        <div class="d-grid gap-2">
                            {{-- <a href="{{ route('') }}" class="btn btn-primary btn-block">Search</a> --}}
                            <button type="submit" class="btn btn-primary btn-block">Search</button>
                        </div>
                        
                    </div>
                </div>           
            </form> 
        </div>
    </div>
</section>



<section class="section-2 bg-2 py-5">
    <div class="container">
        <!-- Section Heading -->
        <div class="text-center mb-5">
            <h2 class="display-4 text-primary">Explore Job Categories</h2>
            <p class="lead text-gray">
                Browse through a variety of job categories to find the right fit for your skills and interests. 
                Whether you're looking for opportunities in marketing, customer service, or design, we've got you covered.
            </p>
        </div>

        <!-- Categories Grid -->
        <div class="row pt-5">
            @if ($categories->isNotEmpty())
                @foreach ($categories as $category)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <a href="{{ route('jobs', ['category' => $category->id]) }}" class="text-decoration-none">
                            <div class="single-category rounded p-4 shadow-lg bg-white text-center">
                                <!-- Dynamic Icon for each category (can be expanded to use icons from the database) -->
                                <i class="fa fa-3x {{ $category->icon ?? 'fa-briefcase' }} text-primary mb-3"></i>

                                <h4 class="pb-2 text-dark">{{ $category->name }}</h4>
                                
                                <!-- Placeholder for available positions -->
                                <p class="text-gray mb-0">
                                    {{ $category->available_positions ?? '0' }} Available Positions
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center">
                    <p class="text-light">No categories available at the moment. Please check back later.</p>
                </div>
            @endif
        </div>
    </div>
</section>

<section class="section-3 py-5">
    <div class="container">
        <h2 class="display-4 text-primary text-center mb-5">Jobs</h2>
        
        <!-- Nav Pills for Tabs -->
        <ul class="nav nav-pills justify-content-center text-center border-bottom mb-5">
            <li class="nav-item">
                <a class="nav-link px-4 py-3 text-uppercase fs-5 active" data-bs-toggle="pill" href="#tab-1">
                    <strong>Featured</strong>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-4 py-3 text-uppercase fs-5" data-bs-toggle="pill" href="#tab-2">
                    <strong>Latest</strong>
                </a>
            </li>
        </ul>
        
        <!-- Tab Content -->
        <div class="tab-content">
            <!-- Featured Jobs Tab -->
            <div id="tab-1" class="tab-pane fade show active">
                <div class="row pt-5">
                    <div class="job_listing_area">
                        <div class="job_lists">
                            <div class="row g-4">
                                @if ($featuredJobs->isNotEmpty())
                                    @foreach ($featuredJobs as $featuredJob)
                                        <div class="col-12">
                                            <div class="job-item p-4 mb-4">
                                                <div class="row g-4">
                                                    <!-- Job Logo and Details -->
                                                    <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                                        <img class="flex-shrink-0 img-fluid border rounded" src="{{ $featuredJob->company_logo }}" alt="Company Logo" style="width: 80px; height: 80px;">
                                                        <div class="text-start ps-4">
                                                            <h5 class="mb-3">{{ $featuredJob->title }}</h5>
                                                            <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $featuredJob->location }}</span>
                                                            <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>{{ $featuredJob->jobType->name }}</span>
                                                            <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>{{ $featuredJob->salary ?? 'Negotiable' }}</span>
                                                        </div>
                                                    </div>

                                                    <!-- Buttons and Deadline -->
                                                    <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                                        <div class="d-flex mb-3">
                                                            <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a>
                                                            <a class="btn btn-primary" href="{{ route('jobDetail', $featuredJob->id) }}">Apply Now</a>
                                                        </div>
                                                        <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: {{ $featuredJob->deadline ?? 'N/A' }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-12 text-center">
                                        <p class="text-muted">No featured jobs available at the moment. Please check back later.</p>
                                    </div>
                                @endif
                            </div>
                            <!-- Pagination -->
                            <div class="text-center">
                                {{ $featuredJobs->links() }}
                            </div>
                            <!-- Browse More Jobs Button -->
                            <div class="text-center mt-4 mb-4">
                                <a class="btn btn-primary" style="padding-bottom: 30px" href="{{ route('jobs') }}">Browse More Jobs</a>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>

            <!-- Latest Jobs Tab -->
            <div id="tab-2" class="tab-pane fade">
                <div class="row pt-5">
                    <div class="job_listing_area">
                        <div class="job_lists">
                            <div class="row g-4">
                                @if ($latestJobs->isNotEmpty())
                                    @foreach ($latestJobs as $latestJob)
                                        <div class="col-12">
                                            <div class="job-item p-4 mb-4">
                                                <div class="row g-4">
                                                    <!-- Job Logo and Details -->
                                                    <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                                        <img class="flex-shrink-0 img-fluid border rounded" src="{{ $latestJob->company_logo }}" alt="Company Logo" style="width: 80px; height: 80px;">
                                                        <div class="text-start ps-4">
                                                            <h5 class="mb-3">{{ $latestJob->title }}</h5>
                                                            <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $latestJob->location }}</span>
                                                            <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>{{ $latestJob->jobType->name }}</span>
                                                            <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>{{ $latestJob->salary ?? 'Negotiable' }}</span>
                                                        </div>
                                                    </div>

                                                    <!-- Buttons and Deadline -->
                                                    <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                                        <div class="d-flex mb-3">
                                                            <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a>
                                                            <a class="btn btn-primary" style="padding-bottom: 35px" href="{{ route('jobDetail', $latestJob->id) }}">Apply Now</a>
                                                        </div>
                                                        <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: {{ $latestJob->deadline ?? 'N/A' }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-12 text-center">
                                        <p class="text-muted">No latest jobs available at the moment. Please check back later.</p>
                                    </div>
                                @endif
                            </div>
                            <!-- Pagination -->
                            <div class="text-center">
                                {{ $latestJobs->links() }}
                            </div>
                            <!-- Browse More Jobs Button -->
                            <div class="text-center mt-4 mb-4">
                                <a class="btn btn-primary" style="padding-bottom: 30px" href="{{ route('jobs') }}">Browse More Jobs</a>
                            </div>
                                                     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection