@extends('front.layouts.app')

@section('main')
    <section class="section-5">
        <div class="container my-5">
            <div class="py-lg-2">&nbsp;</div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <div class="card shadow border-0 p-5">
                        <h1 class="h3">Freelancer Register</h1>
                        <form action="" name="freelancerRegistrationForm" id="freelancerRegistrationForm">
                            @csrf
                            <input type="hidden" name="role" value="{{ request('role') }}">
                            
                            <div class="mb-3">
                                <label for="name" class="mb-2">Name*</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="John Doe">
                                <p></p>
                            </div> 

                            <div class="mb-3">
                                <label for="email" class="mb-2">Email*</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="johndoe@email.com">
                                <p></p>
                            </div> 

                            <div class="mb-3">
                                <label for="password" class="mb-2">Password*</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="********">
                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                        <i class="bi bi-eye-slash" id="passwordIcon"></i>
                                    </button>
                                </div>
                                <p></p>
                            </div> 

                            <div class="mb-3">
                                <label for="confirmPassword" class="mb-2">Confirm Password*</label>
                                <div class="input-group">
                                    <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="********">
                                    <button type="button" class="btn btn-outline-secondary" id="toggleConfirmPassword">
                                        <i class="bi bi-eye-slash" id="confirmPasswordIcon"></i>
                                    </button>
                                </div>
                                <p></p>
                            </div> 

                        <!-- I agree to the Terms and Conditions -->
                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror" 
                                   id="terms" name="terms" required>
                            <label class="form-check-label" for="terms">I agree to the <a href="{{ route('terms.conditions') }}" class="text-decoration-none">Terms and Conditions</a></label>
                            @error('terms')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        
                            <button class="btn btn-primary mt-2">Register</button>
                        </form>                    
                    </div>
                    <div class="mt-4 text-center">
                        <p>Have an account? <a href="{{ route('account.login') }}">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const passwordIcon = document.getElementById('passwordIcon');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                passwordIcon.classList.remove('bi-eye-slash');
                passwordIcon.classList.add('bi-eye');
            } else {
                passwordField.type = 'password';
                passwordIcon.classList.remove('bi-eye');
                passwordIcon.classList.add('bi-eye-slash');
            }
        });

        document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
            const confirmPasswordField = document.getElementById('confirmPassword');
            const confirmPasswordIcon = document.getElementById('confirmPasswordIcon');

            if (confirmPasswordField.type === 'password') {
                confirmPasswordField.type = 'text';
                confirmPasswordIcon.classList.remove('bi-eye-slash');
                confirmPasswordIcon.classList.add('bi-eye');
            } else {
                confirmPasswordField.type = 'password';
                confirmPasswordIcon.classList.remove('bi-eye');
                confirmPasswordIcon.classList.add('bi-eye-slash');
            }
        });

        // Handle the form submission via AJAX
        function handleErrors(errors, fields) {
            fields.forEach(field => {
                if (errors[field]) {
                    $(`#${field}`).addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors[field]);
                } else {
                    $(`#${field}`).removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');
                }
            });
        }

        $("#freelancerRegistrationForm").submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route("account.processFreelancerRegistration") }}',
                type: 'post',
                data: $("#freelancerRegistrationForm").serializeArray(),
                dataType: 'json',
                success: function(response) {
                    const fields = ['name', 'email', 'password', 'confirmPassword'];
                    if (response.status == false) {
                        handleErrors(response.errors, fields);
                    } else {
                        fields.forEach(field => $(`#${field}`).removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html(''));
                        window.location.href = '{{ route("account.login") }}';
                    }
                }
            });
        });
    </script>
@endsection
