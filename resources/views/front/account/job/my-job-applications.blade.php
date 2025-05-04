@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Account Settings</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    @include('front.account.sidebar')
                </div>
                <!-- Review Modal -->
                <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="reviewModalLabel">Submit a Review</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="jobReviewForm" name="jobReviewForm">
                                    @foreach ($jobApplications as $jobApplication)
                                        <input type="hidden" name="job_id" value="{{ $jobApplication->job->id }}">
                                    @endforeach
                                    <!-- Star Rating -->
                                    <div class="mb-3">
                                        <label class="form-label">Rating:</label>
                                        <div id="starRating">
                                            <i class="far fa-star" data-value="1"></i>
                                            <i class="far fa-star" data-value="2"></i>
                                            <i class="far fa-star" data-value="3"></i>
                                            <i class="far fa-star" data-value="4"></i>
                                            <i class="far fa-star" data-value="5"></i>
                                        </div>
                                        <input type="hidden" name="rating" id="ratingValue">
                                    </div>

                                    <!-- Review Comment -->
                                    <div class="mb-3">
                                        <label class="form-label">Your Review:</label>
                                        <textarea class="form-control" name="review" rows="3" required></textarea>
                                        <p class="invalid-feedback" id="review-error"></p>
                                    </div>

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success">Submit Review</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    @include('front.message')
                    <div class="card border-0 shadow mb-4 p-3">
                        <div class="card-body card-form">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="fs-4 mb-1">Jobs Applied</h3>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="bg-light">
                                        <tr>
                                            <th scope="col">Title</th>
                                            <th scope="col">Applied Date</th>
                                            <th scope="col">Applicants</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-0">
                                        @if ($jobApplications->isNotEmpty())
                                            @foreach ($jobApplications as $jobApplication)
                                                <tr class="active">
                                                    <td>
                                                        <div class="job-name fw-500">{{ $jobApplication->job->title }}</div>
                                                        <div class="info1">{{ $jobApplication->job->jobType->name }} &#8226; {{ $jobApplication->job->location }}</div>
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($jobApplication->applied_date)->format('d M, Y') }}</td>
                                                    <td>{{ $jobApplication->job->applications->count() }} Applicants</td>
                                                    <td>
                                                        @if ($jobApplication->job->status == 1)
                                                            <div class="job-status text-capitalize">Active</div>
                                                        @else
                                                            <div class="job-status text-capitalize">Blocked</div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="action-dots float-start">
                                                            <button href="#" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#reviewModal">
                                                                    <i class="fa fa-star" aria-hidden="true"></i> Submit a Review</button>
                                                                    <li><a href="{{ route('freelancer.hire-details', $jobApplication->id) }}" class="dropdown-item">
                                                                        <i class="fa fa-eye" aria-hidden="true"></i> View</a>
                                                                    </li>   
                                                                <li><a class="dropdown-item" href="{{ route('jobDetail', $jobApplication->job_id) }}">
                                                                    <i class="fa fa-briefcase" aria-hidden="true"></i> Visit</a>
                                                                </li>
                                                                <li><a class="dropdown-item" href="#" onclick="removeJob({{ $jobApplication->id }})">
                                                                    <i class="fa fa-trash" aria-hidden="true"></i> Remove</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5">No Job Applications Yet. Apply Now!</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                {{ $jobApplications->links() }}
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
    // Capture the star rating
    $(document).ready(function() {
        $('#starRating i').on('click', function() {
            var rating = $(this).data('value');
            $('#ratingValue').val(rating); // Set rating in hidden input
            $('#starRating i').removeClass('fas').addClass('far'); // Reset all stars
            $('#starRating i').each(function(index) {
                if (index < rating) {
                    $(this).removeClass('far').addClass('fas'); // Fill up to selected star
                }
            });
        });
    });

    // Remove Job Application
    function removeJob(id) {
        if (confirm("Are you sure you want to remove your application from this Job?")) {
            $.ajax({
                url: '{{ route("account.removeJobs") }}',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success: function(response) {
                    window.location.href = "{{ route('account.myJobApplications') }}";
                }
            });
        }
    }
  // Submit Review via AJAX
  $("#jobReviewForm").submit(function(e) {
    e.preventDefault();
    
    // Before sending the AJAX request, ensure the rating is set properly
    var ratingValue = $('#ratingValue').val(); // This is where the selected rating value is stored
    if (!ratingValue) {
        alert("Please select a rating.");
        return; // Prevent submission if rating is not selected
    }

    $.ajax({
        url: '{{ route("job.saveReview") }}',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data: $("#jobReviewForm").serializeArray(), // Serialize the form
        success: function(response) {
            console.log('Response:', response); // Log the response

            if (response.status == false) {
                // Handle validation errors
                if (response.errors) {
                    var errors = response.errors;
                    if (errors.review) {
                        $("textarea[name='review']").addClass("is-invalid");
                        $("#review-error").html(errors.review[0]);
                    } else {
                        $("textarea[name='review']").removeClass('is-invalid');
                        $("#review-error").html('');
                    }

                    if (errors.rating) {
                        $("#rating-error").html(errors.rating[0]);
                    }
                }

                // Handle the custom error when the user has already reviewed the job
                if (response.message) {
                    alert(response.message); // Show the alert message for duplicate reviews
                }
            } else {
                // Success - handle response and show success message
                alert(response.message);  // Display success message in alert

                // Reload the page after the alert is closed
                window.location.reload();  // Reload the page
            }
        },
        error: function(xhr, status, error) {
            console.log("Error: ", xhr.responseText); // Log any AJAX errors for debugging
        }
    });
});


</script>
@endsection
