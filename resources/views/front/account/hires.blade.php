@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Hired Freelancers</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    @include('front.account.sidebar')
                </div>
                <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="reviewModalLabel">Submit a Review</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="userReviewForm" name="userReviewForm" method="POST" action="{{ route('reviews.store') }}">
                                    @csrf
                                @foreach ($hires as $hire)
                                    <input type="hidden" name="freelancer_id" value="{{ $hire->freelancer->id }}">
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
                                    <h3 class="fs-4 mb-1">Hired Freelancers Transactions</h3>
                                </div>

                                <div class="col-6 col-md-2">
                                    <div class="w-full flex justify-end"> <!-- Flexbox for alignment -->
                                        <select name="sort" id="sort" class="form-select" onchange="redirectToSort()">
                                            <option value="1" {{ request('sort', '1') == '1' ? 'selected' : '' }}>Latest</option>
                                            <option value="0" {{ request('sort') == '0' ? 'selected' : '' }}>Oldest</option>
                                        </select>                                                                                                           
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table ">
                                    <thead class="" style="background-color: rgb(155, 245, 245)">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Freelancer Name</th>
                                            <th scope="col">Mobile</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Hired Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Payment</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-0">
                                        @if ($hires->isNotEmpty())
                                            @foreach ($hires as $hire)
                                                <tr class="active">
                                                    <td>
                                                        <div class="job-name fw-500">{{ $hire->id }}</div>
                                                    </td>
                                                    <td>
                                                        <div class="job-name fw-500">{{ $hire->job->title }}</div>
                                                    </td>
                                                    <td>{{ $hire->freelancer->name }}</td>
                                                    <td>{{ $hire->freelancer->mobile }}</td>
                                                    <td>{{ $hire->freelancer->email }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($hire->hired_date)->format('d M, Y') }}</td>
                                                    <td>
                                                        @if ($hire->job->status == 1)
                                                            <div class="job-status text-capitalize" style="color: green">Active</div>
                                                        @else
                                                            <div class="job-status text-capitalize" style="color: red">Blocked</div> 
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($hire->payment && $hire->payment->isPaid == 1)
                                                            <div class="job-status text-capitalize" style="color: green">Paid</div>
                                                        @else
                                                            <div class="job-status text-capitalize" style="color: red">Pending</div>
                                                        @endif
                                                    </td>                                                    
                                                    <td>
                                                        <div class="action-dots float-start">
                                                            <button href="#" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li>
                                                                    <a class="dropdown-item" href="{{ route('account.editHires', ['hireId' => $hire->id]) }}">
                                                                        <i class="fa fa-eye" aria-hidden="true"></i> View
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="{{ route('jobDetail', $hire->job_id) }}"> 
                                                                        <i class="fa fa-briefcase" aria-hidden="true"></i> Visit
                                                                    </a>
                                                                </li>```php
@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Hired Freelancers</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    @include('front.account.sidebar')
                </div>
                <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="reviewModalLabel">Submit a Review</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="userReviewForm" name="userReviewForm" method="POST" action="{{ route('reviews.store') }}">
                                    @csrf
                                    <input type="hidden" name="freelancer_id" id="freelancerId">
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
                                    <h3 class="fs-4 mb-1">Hired Freelancers Transactions</h3>
                                </div>
                                <div class="col-6 col-md-2">
                                    <div class="w-full flex justify-end">
                                        <select name="sort" id="sort" class="form-select" onchange="redirectToSort()">
                                            <option value="1" {{ request('sort', '1') == '1' ? 'selected' : '' }}>Latest</option>
                                            <option value="0" {{ request('sort') == '0' ? 'selected' : '' }}>Oldest</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="" style="background-color: rgb(155, 245, 245)">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Freelancer Name</th>
                                            <th scope="col">Mobile</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Hired Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Payment</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-0">
                                        @if ($hires->isNotEmpty())
                                            @foreach ($hires as $hire)
                                                <tr class="active">
                                                    <td>
                                                        <div class="job-name fw-500">{{ $hire->id }}</div>
                                                    </td>
                                                    <td>
                                                        <div class="job-name fw-500">{{ $hire->job->title }}</div>
                                                    </td>
                                                    <td>{{ $hire->freelancer->name }}</td>
                                                    <td>{{ $hire->freelancer->mobile }}</td>
                                                    <td>{{ $hire->freelancer->email }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($hire->hired_date)->format('d M, Y') }}</td>
                                                    <td>
                                                        @if ($hire->job->status == 1)
                                                            <div class="job-status text-capitalize" style="color: green">Active</div>
                                                        @else
                                                            <div class="job-status text-capitalize" style="color: red">Blocked</div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($hire->payment && $hire->payment->isPaid == 1)
                                                            <div class="job-status text-capitalize" style="color: green">Paid</div>
                                                        @else
                                                            <div class="job-status text-capitalize" style="color: red">Pending</div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="action-dots float-start">
                                                            <button href="#" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li>
                                                                    <a class="dropdown-item" href="{{ route('account.editHires', ['hireId' => $hire->id]) }}">
                                                                        <i class="fa fa-eye" aria-hidden="true"></i> View
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="{{ route('jobDetail', $hire->job_id) }}">
                                                                        <i class="fa fa-briefcase" aria-hidden="true"></i> Visit
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <button class="dropdown-item review-button" data-bs-toggle="modal" data-bs-target="#reviewModal" data-freelancer-id="{{ $hire->freelancer->id }}">
                                                                        <i class="fa fa-star" aria-hidden="true"></i> Review
                                                                    </button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="text-center">
                                                <td colspan="9">No Hire Transaction Yet.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                {{ $hires->links() }}
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
        // Redirect to sort on change
        function redirectToSort() {
            const sortValue = document.getElementById('sort').value;
            const baseUrl = window.location.href.split('?')[0]; // Get URL without query parameters
            window.location.href = `${baseUrl}?sort=${sortValue}`;
        }

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

        // Submit Review via AJAX
        $("#userReviewForm").submit(function(e) {
            e.preventDefault();

            // Before sending the AJAX request, ensure the rating is set properly
            var ratingValue = $('#ratingValue').val(); // This is where the selected rating value is stored
            if (!ratingValue) {
                alert("Please select a rating.");
                return; // Prevent submission if rating is not selected
            }

            $.ajax({
                url: '{{ route("reviews.store") }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: $("#userReviewForm").serializeArray(), // Serialize the form
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
                                $("#rating-error").html(errors  
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="text-center">
                                                <td colspan="9">No Hire Transaction Yet.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                    
                                </table>
                            </div>
                            <div>
                                {{ $hires->links() }}
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
    // Redirect to sort on change
    function redirectToSort() {
        const sortValue = document.getElementById('sort').value;
        const baseUrl = window.location.href.split('?')[0]; // Get URL without query parameters
        window.location.href = `${baseUrl}?sort=${sortValue}`;
    }
    
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
    
// Submit Review via AJAX
$("#userReviewForm").submit(function(e) {
    e.preventDefault();
    
    // Before sending the AJAX request, ensure the rating is set properly
    var ratingValue = $('#ratingValue').val(); // This is where the selected rating value is stored
    if (!ratingValue) {
        alert("Please select a rating.");
        return; // Prevent submission if rating is not selected
    }

    $.ajax({
        url: '{{ route("reviews.store") }}',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data: $("#userReviewForm").serializeArray(), // Serialize the form
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

                // Handle the custom error when the user has already reviewed
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

// Set the freelancer_id dynamically when opening the modal
$(document).on("click", ".review-button", function () {
    var freelancerId = $(this).data("freelancer-id");
    $("#freelancerId").val(freelancerId);
});


</script>
@endsection