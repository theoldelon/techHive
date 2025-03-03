@extends('front.layouts.app')

@section('main')
<section class="section-4 bg-2">    
    <div class="container pt-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('jobs') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;Back to Jobs</a></li>
                    </ol>
                </nav>
            </div>
        </div> 
    </div>
    <div class="container job_details_area">
        <div class="row pb-5">
            <div class="col-md-8">
                @include('front.message') 

                <div class="border-0 p-3">
                    <div class="job_listing_area">
                        <div class="job-item p-4 border rounded shadow">
                            <!-- Job Info (Logo, Title, Location, Type, Salary) -->
                            <div class="row g-4">
                                <div class="col-12 mb-4 d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid border rounded" src="{{ $job->company_logo ?? 'default-logo.jpg' }}" alt="{{ $job->company_name }}" style="width: 80px; height: 80px;">
                                    <div class="text-start ps-4">
                                        <h5 class="mb-3 text-dark">{{ $job->title }}</h5>
                                        <span class="text-truncate me-3">
                                            <i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $job->location }}
                                        </span>
                                        <span class="text-truncate me-3">
                                            <i class="far fa-clock text-primary me-2"></i> Full Time
                                        </span>
                                        <span class="text-truncate me-0">
                                            <i class="far fa-money-bill-alt text-primary me-2"></i> $50,000 - $70,000
                                        </span>
                            
                                        {{-- Hardcoded Rating --}}
                                        <div class="mt-2">
                                            <span class="text-warning">
                                                @php
                                                    $averageRating = $job->reviews->avg('rating') ?? 0;
                                                    $totalReviews = $job->reviews->count();
                                                    $fullStars = floor($averageRating);
                                                    $halfStar = ($averageRating - $fullStars) >= 0.5;
                                                @endphp
                                        
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $fullStars)
                                                        <i class="fas fa-star"></i>
                                                    @elseif ($halfStar && $i == ($fullStars + 1))
                                                        <i class="fas fa-star-half-alt"></i>
                                                    @else
                                                        <i class="far fa-star"></i>
                                                    @endif
                                                @endfor
                                            </span>
                                            
                                            <span class="text-muted ms-2">
                                                ({{ number_format($averageRating, 1) }}/5 based on {{ $totalReviews }} reviews)
                                            </span>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                            
                            
                        <!-- Job Description and Details -->
                        <div class="descript_wrap mt-4">
                            <h4><i aria-hidden="true"></i> Job Description</h4>
                            <span style="color: gray; display: block; margin-bottom: 30px;">{!! nl2br($job->description) !!}</span>

                            @if (!empty($job->responsibility))
                                <div class="single_wrap mt-3">
                                    <h4><i  aria-hidden="true"></i> Responsibility</h4>
                                    <span style="color: gray; display: block; margin-bottom: 30px;">{!! nl2br($job->responsibility) !!}</span>
                                </div>
                            @endif

                            @if (!empty($job->qualifications))
                                <div class="single_wrap mt-3">
                                    <h4><i  aria-hidden="true"></i> Qualifications</h4>
                                    <span style="color: gray; display: block; margin-bottom: 30px;">{!! nl2br($job->qualifications) !!}</span>
                                </div>
                            @endif

                            @if (!empty($job->benefits))
                                <div class="single_wrap mt-3">
                                    <h4><i  aria-hidden="true"></i> Benefits</h4>
                                    <span style="color: gray; display: block; margin-bottom: 30px;">{!! nl2br($job->benefits) !!}</span>
                                </div>
                            @endif
                        </div>

                            <!-- Action Buttons -->
                            <div class="pt-3 text-end">
                                @if (Auth::check())
                                    <a href="#" onclick="saveTheJob({{ $job->id }})" class="btn btn-outline-dark">
                                        <i class="fa fa-save" aria-hidden="true"></i> Save Job
                                    </a>
                                @else
                                    <a href="javascript:void(0);" class="btn btn-outline-dark disabled">
                                        <i class="fa fa-sign-in-alt" aria-hidden="true"></i> Login to Save
                                    </a>
                                @endif
                
                                @if (Auth::check())
                                    @php
                                        $freelancer = Auth::user()->freelancer;
                                    @endphp
                                    @if ($freelancer && $freelancer->isVerified == 1)
                                        <a href="#" onclick="applyJob({{ $job->id }})" class="btn btn-primary">
                                            <i class="fa fa-paper-plane" aria-hidden="true"></i> Apply
                                        </a>
                                    @else
                                        <a href="javascript:void(0);" class="btn btn-primary disabled">
                                            <i class="fa fa-exclamation-circle" aria-hidden="true"></i> Please verify first to apply
                                        </a>
                                    @endif
                                @else
                                    <a href="javascript:void(0);" class="btn btn-primary disabled">
                                        <i class="fa fa-sign-in-alt" aria-hidden="true"></i> Login to Apply
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                            

                @if (Auth::user())
                    @if (Auth::user()->id == $job->user_id)
                        <div class="card shadow border-0 mt-4">
                            <div class="job_details_header">
                                <div class="single_jobs white-bg d-flex justify-content-between">
                                    <div class="jobs_left d-flex align-items-center">
                                        <div class="jobs_conetent">
                                            <h4>Applicants</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="descript_wrap white-bg">
                                <table class="table table-striped">
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Applied Date</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    @if ($applications->isNotEmpty())
                                        @foreach ($applications as $application)
                                            <tr>
                                                <td>{{ $application->user->firstName }}</td>
                                                <td>{{ $application->user->lastName }}</td>
                                                <td>{{ $application->user->email }}</td>
                                                <td>{{ $application->user->mobile }}</td>
                                                <td>{{ \Carbon\Carbon::parse($application->applied_date)->format('d M, Y') }}</td>
                                                <td>
                                                    <a href="{{ route('account.show', ['id' => $application->user->id]) }}" class="btn btn-secondary">
                                                        <i class="fa fa-user" aria-hidden="true"></i> Visit
                                                    </a>
                                                    <a href="#" onclick="hireFreelancer({{ $application->id }}, {{ $job->id }}, {{ $application->user->id }})" class="btn btn-primary">
                                                        <i class="fa fa-check-circle" aria-hidden="true"></i> Hire
                                                    </a>
                                                </td>                                           
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6">No Applicants Yet.</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    @endif
                @endif
            </div>

            <div class="col-md-4">
                <div class="card shadow border-0 p-4">
                    <div class="job_sumary">
                        <div class="summery_header pb-1 pt-4 ">
                            <h3>Job Summary</h3>
                        </div>
                        <div class="job_content pt-3">
                            <ul class="list-unstyled" style="color: gray">
                                <li><i class="fa fa-calendar-alt pb-3" aria-hidden="true"></i> Published By: <a href="{{ route('account.show', ['id' => $job->user->id]) }}"><span>{{ $job->user->name }}</span></a></li>


                                <li><i class="fa fa-calendar-alt pb-3" aria-hidden="true"></i> Published on: <span>{{ Carbon\Carbon::parse($job->created_at)->format('d, M Y') }}</span></li>
                                <li><i class="fa fa-users pb-3" aria-hidden="true"></i> Vacancy: <span>{{ $job->vacancy }}</span></li>
                                
                                @if (!empty($job->salary))
                                    <li><i class="fa fa-dollar-sign pb-3" aria-hidden="true"></i> Salary: <span>{{ $job->salary }}</span></li>
                                @endif

                                <li><i class="fa fa-map-marker-alt pb-3" aria-hidden="true"></i> Location: <span>{{ $job->location }}</span></li>
                                <li><i class="fa fa-briefcase pb-3" aria-hidden="true"></i> Job Nature: <span>{{ $job->jobType->name }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card shadow border-0 p-4 mt-4">
                    <div class="job_sumary">
                        <div class="summery_header pb-1 pt-4">
                            <h3>Company Details</h3>
                        </div>
                        <div class="job_content pt-3">
                            <ul class="list-unstyled" style="color: gray">
                                <li><i class="fa fa-building pb-3" aria-hidden="true"></i> Name: <span>{{ $job->company_name }}</span></li>
                                @if (!empty($job->company_location))
                                    <li><i class="fa fa-map-marker-alt pb-3" aria-hidden="true"></i> Location: <span>{{ $job->company_location }}</span></li>
                                @endif

                                @if (!empty($job->company_website))
                                    <li><i class="fa fa-globe pb-3" aria-hidden="true"></i> Website: <span><a href="{{ $job->company_website }}" target="_blank">{{ $job->company_website }}</a></span></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card shadow border-0 p-4 mt-4">
                    <div class="job_summary">
                        <div class="summary_header pb-1 pt-4">
                            <h3 class="text-lg font-semibold">Rating and Reviews</h3>
                        </div>
                
                        {{-- Display Reviews --}}
                        <div class="mt-3">
                            <h6 class="fw-bold text-gray-700">User Reviews:</h6>
                            <ul class="list-none space-y-3 mt-2" id="review-list">
                                @if($job->reviews->count() > 0)
                                    @foreach($job->reviews as $review)
                                        <li class="border-b pb-3">
                                            <strong class="text-blue-600">{{ $review->user->name }}</strong>
                                            <span class="text-yellow-500">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class="{{ $i <= $review->rating ? 'fas fa-star' : 'far fa-star' }}"></i>
                                                @endfor
                                            </span>
                                            <p class="text-gray-600 mt-1">{{ $review->review }}</p>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="text-gray-500">No reviews yet.</li>
                                @endif
                            </ul>
                        </div>
                
                    
                    </div>
                </div>
                


            </div>
        </div>
    </div>
</section>
@endsection


@section('customJs')
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            
            function hireFreelancer(applicationId, jobId, freelancerId) {
                console.log("Application ID:", applicationId);
                console.log("Job ID:", jobId);
                console.log("Freelancer ID:", freelancerId);

                if (!confirm("Are you sure you want to hire this Freelancer?")) return;

                $.ajax({
                    url: '{{ route("hireFreelancer") }}',
                    type: 'POST',
                    data: {
                        job_id: jobId,
                        freelancer_id: freelancerId,
                        application_id: applicationId,
                        _token: document.querySelector('meta[name="csrf-token"]').content
                    },
                    dataType: 'json',
                    success: function (response) {
                        alert(response.message);
                        if (response.status) location.reload();
                    },
                    error: function (xhr) {
                        console.error("Error:", xhr.responseText);
                        alert("An error occurred while hiring the freelancer.");
                    }
                });
            }

            function applyJob(id) {
                if (!confirm("Are you sure you want to apply for this job?")) return;

                $.ajax({
                    url: '{{ route("applyJob") }}',
                    type: 'POST',
                    data: {
                        id: id,
                        _token: document.querySelector('meta[name="csrf-token"]').content
                    },
                    dataType: 'json',
                    success: function () {
                        window.location.href = "{{ url()->current() }}";
                    },
                    error: function (xhr) {
                        console.error("Error:", xhr.responseText);
                    }
                });
            }

            function saveTheJob(id) {
                $.ajax({
                    url: '{{ route("saveTheJob") }}',
                    type: 'POST',
                    data: {
                        id: id,
                        _token: document.querySelector('meta[name="csrf-token"]').content
                    },
                    dataType: 'json',
                    success: function () {
                        window.location.href = "{{ url()->current() }}";
                    },
                    error: function (xhr) {
                        console.error("Error:", xhr.responseText);
                    }
                });
            }

            // Handle Review Form Submission (with Error Handling)
            let reviewForm = document.getElementById('review-form');
            if (reviewForm) {
                reviewForm.addEventListener('submit', function (e) {
                    e.preventDefault();

                    let formData = new FormData(this);
                    let submitButton = reviewForm.querySelector("button");

                    submitButton.textContent = "Submitting...";
                    submitButton.disabled = true;

                    fetch("{{ route('job.saveReview') }}", {
                        method: "POST",
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        submitButton.textContent = "Submit Review";
                        submitButton.disabled = false;

                        if (data.status) {
                            alert(data.message);
                            location.reload();
                        } else {
                            alert("Error: " + (data.message || JSON.stringify(data.errors)));
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        submitButton.textContent = "Submit Review";
                        submitButton.disabled = false;
                    });
                });
            }

            // Expose functions globally
            window.hireFreelancer = hireFreelancer;
            window.applyJob = applyJob;
            window.saveTheJob = saveTheJob;
        });
    </script>
@endsection
