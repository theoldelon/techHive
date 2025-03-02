@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Client Verify</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    @include('front.account.sidebar')
                </div>
                <form action="" method="post" id="clientVerify" name="clientVerify" enctype="multipart/form-data" class="col-lg-9">
                    @include('front.message')
                    <div>
                        @if (Auth::user()->role == 'user')
                            <div class="card border-0 shadow mb-4">
                                <div class="card-body p-4">

                                    <h3 class="fs-4 mb-1">Profile Picture</h3>
                                    <div class="mb-4">
                                        <label for="profile_picture" class="form-label mb-2">Picture of your Valid ID</label>
                                        <p>Please provide a Clear Image Copy of your Profile Picture.</p>
                                        <input type="file" name="profile_picture" id="profile_picture" class="form-control @error('profile_picture') is-invalid @enderror">
                                        @error('profile_picture')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <h3 class="fs-4 mb-1">Credentials</h3>
                                    <div class="mb-4">
                                        <label for="valid_id" class="form-label mb-2">Picture of your Valid ID</label>
                                        <p>Please provide a Clear Image Copy of your Valid ID.</p>
                                        <input type="file" name="valid_id" id="valid_id" class="form-control @error('valid_id') is-invalid @enderror">
                                        @error('valid_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="selfie_with_id" class="mb-2">Selfie with Valid ID</label>
                                        <p>Please provide a Clear Image of your Selfie with your Valid ID.</p>
                                        <input type="file" name="selfie_with_id" id="selfie_with_id" class="form-control @error('selfie_with_id') is-invalid @enderror">
                                        @error('selfie_with_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="business_permit" class="mb-2">Business Permit</label>
                                        <p>Please provide a Clear Image Copy of your Business Permit.</p>
                                        <input type="file" name="business_permit" id="business_permit" class="form-control @error('business_permit') is-invalid @enderror">
                                        @error('business_permit')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="dti_registration" class="mb-2">DTI Registration</label>
                                        <p>Please provide a Clear Image Copy of your DTI Registration.</p>
                                        <input type="file" name="dti_registration" id="dti_registration" class="form-control @error('dti_registration') is-invalid @enderror">
                                        @error('dti_registration')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="sec_registration" class="mb-2">SEC Registration</label>
                                        <p>Please provide a Clear Image Copy of your SEC Registration.</p>
                                        <input type="file" name="sec_registration" id="sec_registration" class="form-control @error('sec_registration') is-invalid @enderror">
                                        @error('sec_registration')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @else
                            <p>Only freelancers can verify credentials.</p>
                        @endif

                        <div class="card border-0 shadow mb-4">
                            <div class="card-body p-4">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
<script type="text/javascript">
    $("#clientVerify").submit(function(e) {
        e.preventDefault();

        // Create FormData object
        let formData = new FormData(this);

        $.ajax({
            url: '{{ route("account.client-verify.verifyCredentials") }}',
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.status === true) {
                    // Use Auth::user()->id to get the current user's ID dynamically
                    window.location.href = "{{ route('account.show', ['id' => auth()->user()->id]) }}";
                } else {
                    var errors = response.errors;

                    // Loop through each field's error and display it
                    ["valid_id", "selfie_with_id", "business_permit", "dti_registration", "sec_registration"].forEach(function(field) {
                        if (errors[field]) {
                            $("#" + field).addClass('is-invalid');
                            $("#" + field)
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors[field][0]);
                        } else {
                            $("#" + field).removeClass('is-invalid');
                            $("#" + field)
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('');
                        }
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
                alert("Something went wrong. Please make sure to provide the requested file type.");
            }
        });
    });
</script>
@endsection
