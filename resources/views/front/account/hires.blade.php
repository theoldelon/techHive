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
                <!-- Rating & Review Modal -->
                <div class="modal fade" id="ratingReviewModal" tabindex="-1" aria-labelledby="ratingReviewModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ratingReviewModalLabel">Rate & Review</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="review-form">
                                    @csrf
                                    <input type="hidden" name="freelancer_id" id="modal-freelancer-id">
                                    <input type="hidden" name="rating" id="ratingValue">
                                
                                    <div class="mb-3">
                                        <label class="form-label">Rating:</label>
                                        <div id="starRating">
                                            <i class="fa-regular fa-star" data-value="1"></i>
                                            <i class="fa-regular fa-star" data-value="2"></i>
                                            <i class="fa-regular fa-star" data-value="3"></i>
                                            <i class="fa-regular fa-star" data-value="4"></i>
                                            <i class="fa-regular fa-star" data-value="5"></i>
                                        </div>
                                        <span class="text-danger text-sm d-none" id="rating-error"></span>
                                    </div>
                                
                                    <div class="mb-3">
                                        <label for="review" class="form-label">Your Review:</label>
                                        <textarea class="form-control" name="review" id="review" rows="3"></textarea>
                                        <span class="text-danger text-sm d-none" id="review-error"></span>
                                    </div>
                                
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Submit Review</button>
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
                                                                </li>
                                                                <li>
                                                                   {{-- <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ratingReviewModal" data-jobid="{{ $hire->id }}" data-freelancerid="{{ $hire->freelancer->id }}">
                                                                        <i class="fa fa-star" aria-hidden="true"></i> Rate & Review
                                                                    </a>
                                                                    --}}
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
<script>
document.addEventListener("DOMContentLoaded", function () {
    const reviewForm = document.getElementById("review-form");
    const stars = document.querySelectorAll("#starRating i");
    const ratingInput = document.getElementById("ratingValue");

    if (!reviewForm) return;

    // Highlight stars on hover
    stars.forEach(star => {
        star.addEventListener("mouseover", function () {
            const value = this.getAttribute("data-value");
            stars.forEach(s => s.classList.remove("fa-solid"));
            for (let i = 0; i < value; i++) {
                stars[i].classList.add("fa-solid");
            }
        });

        star.addEventListener("mouseleave", function () {
            const selectedValue = ratingInput.value;
            stars.forEach(s => s.classList.remove("fa-solid"));
            for (let i = 0; i < selectedValue; i++) {
                stars[i].classList.add("fa-solid");
            }
        });

        // Click to select rating
        star.addEventListener("click", function () {
            const value = this.getAttribute("data-value");
            ratingInput.value = value;
            stars.forEach(s => s.classList.remove("fa-solid"));
            for (let i = 0; i < value; i++) {
                stars[i].classList.add("fa-solid");
            }
        });
    });

    // AJAX Submission for Review Form
    reviewForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const submitButton = reviewForm.querySelector("button[type='submit']");
        const ratingError = document.getElementById('rating-error');
        const reviewError = document.getElementById('review-error');

        // Clear previous errors
        ratingError.classList.add('d-none');
        reviewError.classList.add('d-none');

        // Validate inputs before sending request
        if (!ratingInput.value) {
            ratingError.textContent = "Rating is required.";
            ratingError.classList.remove('d-none');
            return;
        }

        const reviewText = document.querySelector('textarea[name="review"]').value.trim();
        if (!reviewText) {
            reviewError.textContent = "Review is required.";
            reviewError.classList.remove('d-none');
            return;
        }

        let formData = new FormData(reviewForm);
        submitButton.disabled = true; // Prevent multiple submissions

        fetch("", {  // Ensure the route name matches your route
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                "Accept": "application/json"
            }
        })
        .then(response => response.json())
        .then(data => {
            submitButton.disabled = false;

            if (data.status) {
                alert("Review submitted successfully!");
                reviewForm.reset();
                stars.forEach(s => s.classList.remove("fa-solid"));
                setTimeout(() => {
                    location.reload();  // Refresh the page after submission
                }, 1000);
            } else {
                if (data.errors) {
                    if (data.errors.rating) {
                        ratingError.textContent = data.errors.rating[0];
                        ratingError.classList.remove('d-none');
                    }
                    if (data.errors.review) {
                        reviewError.textContent = data.errors.review[0];
                        reviewError.classList.remove('d-none');
                    }
                } else {
                    alert(data.message || "An error occurred. Please try again.");
                }
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred while submitting your review.");
            submitButton.disabled = false;
        });
    });
});
</script>
@endsection
