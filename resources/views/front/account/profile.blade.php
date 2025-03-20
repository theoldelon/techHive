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
                <form action="" method="post" id="userForm" name="userForm" class="col-lg-9">
                    @include('front.message')
                    <div>
                        <div class="card border-0 shadow mb-4">
                            <div class="card-body p-4">
                                <h3 class="fs-4 mb-1">My Profile</h3>
                                    <div class="mb-4">
                                        <label for="name" class="form-label mb-2">Full Name</label>
                                        <input 
                                            type="text" 
                                            name="name" 
                                            id="name" 
                                            placeholder="Enter your full name" 
                                            class="form-control @error('name') is-invalid @enderror" 
                                            value="{{ old('name', $user->name) }}"
                                            required 
                                        >
                                    </div>

                                    <div class="mb-4">
                                        <label for="" class="mb-2">Designation</label>
                                        <input type="text" name="designation" id="designation" placeholder="Designation" value="{{ $user->designation }}" class="form-control">
                                    </div>

                                    @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <label for="about" class="mb-2">About Me</label>
                                        <textarea class="textarea" name="about" id="about" cols="5" rows="5" placeholder="About Me" value="{{ $user->about }}"></textarea>
                                        <p></p>
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 shadow mb-4">
                            <div class="card-body  p-4">
                                <h3 class="fs-4 mb-1">Contacts</h3>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Email</label>
                                    <input type="text" name="email" id="email" placeholder="johndoe@email.com" value="{{ $user->email }}" class="form-control">
                                    <p></p>
                                </div>

                                <div class="mb-4">
                                    <label for="" class="mb-2">Mobile</label>
                                    <input type="number" name="mobile" id="mobile" placeholder="Mobile" value="{{ $user->mobile }}" class="form-control">
                                </div>   
                            </div>
                        </div>

                        {{-- About --}}
                        <div class="card border-0 shadow mb-4">
                            <div class="card-body  p-4">
                                <h3 class="fs-4 mb-1">More Info</h3>
                                <div class="mb-4">

                                <div class="mb-4">
                                    <label for="education" class="mb-2">Education</label>
                                    <input type="text" name="education" id="education" placeholder="Education" value="{{ $user->education }}" class="form-control">
                                </div>

                                <div class="mb-4">
                                    <label for="career_start" class="mb-2">Career Start</label>
                                    <input type="text" name="career_start" id="career_start" placeholder="Career Start" value="{{ $user->career_start }}" class="form-control">
                                </div>   

                                <div class="mb-4">
                                    <label for="experience" class="mb-2">Experience</label>
                                    <input type="text" name="experience" id="experience" placeholder="Experience" value="{{ $user->experience }}" class="form-control">
                                </div>   

                                <div class="mb-4">
                                    <label for="other" class="mb-2">Other Info</label>
                                    <textarea class="textarea" name="other" id="other" cols="5" rows="5" placeholder="Other Info" value="{{ $user->other }}"></textarea>
                                    <p></p>
                                </div>
                            </div>
                        </div>

{{-- Portfolio and Socials --}}
<div class="card border-0 shadow mb-4">
    <div class="card-body p-4">
        <h3 class="fs-4 mb-1">Credentials and Socials</h3>

        {{-- Portfolio Link --}}
        <div class="mb-4">
            <label for="portfolio" class="mb-2">Portfolio</label>
            <input type="url" name="portfolio" id="portfolio" placeholder="https://johndoe.com" value="{{ $user->portfolio }}" class="form-control">
            <a href="{{ (filter_var($user->portfolio, FILTER_VALIDATE_URL)) ? $user->portfolio : 'http://' . $user->portfolio }}" target="_blank" class="d-block mt-2 text-dark text-decoration-none" id="portfolio-link"></a>
            <p class="invalid-feedback" id="portfolio-warning">Please enter a valid URL.</p>
        </div>

        {{-- Facebook Link --}}
        <div class="mb-4">
            <label for="facebook" class="mb-2">Facebook</label>
            <input type="url" name="facebook" id="facebook" placeholder="https://www.facebook.com/JohnDoe" value="{{ $user->facebook }}" class="form-control">
            <a href="{{ (filter_var($user->facebook, FILTER_VALIDATE_URL)) ? $user->facebook : 'http://' . $user->facebook }}" target="_blank" class="d-block mt-2 text-dark text-decoration-none" id="facebook-link"></a>
            <p class="invalid-feedback" id="facebook-warning">Please enter a valid URL.</p>
        </div>

        {{-- Instagram Link --}}
        <div class="mb-4">
            <label for="instagram" class="mb-2">Instagram</label>
            <input type="url" name="instagram" id="instagram" placeholder="https://www.instagram.com/JohnDoe" value="{{ $user->instagram }}" class="form-control">
            <a href="{{ (filter_var($user->instagram, FILTER_VALIDATE_URL)) ? $user->instagram : 'http://' . $user->instagram }}" target="_blank" class="d-block mt-2 text-dark text-decoration-none" id="instagram-link"></a>
            <p class="invalid-feedback" id="instagram-warning">Please enter a valid URL.</p>
        </div>

        {{-- Twitter Link --}}
        <div class="mb-4">
            <label for="twitter" class="mb-2">X</label>
            <input type="url" name="twitter" id="twitter" placeholder="https://www.x.com/JohnDoe" value="{{ $user->twitter }}" class="form-control">
            <a href="{{ (filter_var($user->twitter, FILTER_VALIDATE_URL)) ? $user->twitter : 'http://' . $user->twitter }}" target="_blank" class="d-block mt-2 text-dark text-decoration-none" id="twitter-link"></a>
            <p class="invalid-feedback" id="twitter-warning">Please enter a valid URL.</p>
        </div>

        {{-- TikTok Link --}}
        <div class="mb-4">
            <label for="tiktok" class="mb-2">TikTok</label>
            <input type="url" name="tiktok" id="tiktok" placeholder="https://www.tiktok.com/JohnDoe" value="{{ $user->tiktok }}" class="form-control">
            <a href="{{ (filter_var($user->tiktok, FILTER_VALIDATE_URL)) ? $user->tiktok : 'http://' . $user->tiktok }}" target="_blank" class="d-block mt-2 text-dark text-decoration-none" id="tiktok-link"></a>
            <p class="invalid-feedback" id="tiktok-warning">Please enter a valid URL.</p>
        </div>

        {{-- YouTube Link --}}
        <div class="mb-4">
            <label for="youtube" class="mb-2">YouTube</label>
            <input type="url" name="youtube" id="youtube" placeholder="https://www.youtube.com/JohnDoe" value="{{ $user->youtube }}" class="form-control">
            <a href="{{ (filter_var($user->youtube, FILTER_VALIDATE_URL)) ? $user->youtube : 'http://' . $user->youtube }}" target="_blank" class="d-block mt-2 text-dark text-decoration-none" id="youtube-link"></a>
            <p class="invalid-feedback" id="youtube-warning">Please enter a valid URL.</p>
        </div>

        {{-- GitHub Link --}}
        <div class="mb-4">
            <label for="github" class="mb-2">GitHub</label>
            <input type="url" name="github" id="github" placeholder="https://github.com/JohnDoe" value="{{ $user->github }}" class="form-control">
            <a href="{{ (filter_var($user->github, FILTER_VALIDATE_URL)) ? $user->github : 'http://' . $user->github }}" target="_blank" class="d-block mt-2 text-dark text-decoration-none" id="github-link"></a>
            <p class="invalid-feedback" id="github-warning">Please enter a valid URL.</p>
        </div>

    </div>
</div>

                            <div class="card-body p-4">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
<script type="text/javascript">
    // Handle form submission via AJAX
    $("#userForm").submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: '{{ route("account.updateProfile") }}',
            type: 'put',
            dataType: 'json',
            data: $("#userForm").serializeArray(),
            success: function(response) {
                if (response.status == true) {
                    // Clear any previous error classes or messages
                    $(".form-control").removeClass('is-invalid');
                    $(".invalid-feedback").removeClass('invalid-feedback').html('');

                    // Redirect on success
                    window.location.href = "{{ route('account.show', ['id' => Auth::user()->id]) }}";
                } else {
                    // Handle validation errors
                    var errors = response.errors;

                    // Loop through each field and handle errors
                    handleFieldErrors(errors);

                    // Handle social media URL validation
                    handleUrlErrors(errors);
                }
            },
            error: function(xhr, status, error) {
                // You can handle any error responses here (network issues, server errors, etc.)
                console.log("Error: " + error);
                alert("An error occurred. Please try again.");
            }
        });
    });

    // Consolidated error handler for form fields
    function handleFieldErrors(errors) {
        // Handle each form field error using the handleError function
        const fields = [
            'name', 'email', 'designation', 'mobile', 'about', 'education', 'career_start', 'experience', 'other'
        ];

        fields.forEach(function(field) {
            handleError(field, errors);
        });
    }

    // Handle specific errors related to URL fields (e.g., social media links)
    function handleUrlErrors(errors) {
        const urlFields = ['portfolio', 'facebook', 'instagram', 'twitter', 'tiktok', 'youtube', 'github'];
        urlFields.forEach(function(field) {
            handleError(field, errors);
        });
    }

    // General error handler for a given field
    function handleError(field, errors) {
        if (errors[field]) {
            $("#" + field).addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors[field][0]);
        } else {
            $("#" + field).removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
        }
    }

    // Validate URLs dynamically on blur
    $(document).ready(function() {
        $("input[type='url']").on('blur', function() {
            var url = $(this).val();
            var fieldId = $(this).attr('id');
            var warningTextId = "#" + fieldId + "-warning"; // e.g., #portfolio-warning

            // Show or hide the warning based on URL validity
            if (!isValidUrl(url)) {
                $(warningTextId).show();  // Show warning if URL is invalid
            } else {
                $(warningTextId).hide();  // Hide warning if URL is valid
            }
        });

        // Helper function to validate URLs
        function isValidUrl(url) {
            var pattern = new RegExp('^(https?://)?([a-z0-9-]+\.)+[a-z0-9]{2,6}(/.*)?$', 'i');
            return pattern.test(url);
        }
    });
</script>
@endsection
