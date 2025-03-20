@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item active">Users</li>
                            <li class="breadcrumb-item active">Create User</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    @include('front.account.sidebar')
                </div>

                <div class="col-lg-9">
                    @include('front.message')
                    <form action="" id="createUserForm" name="createUserForm">
                        <div class="card border-0 shadow mb-4">
                            <div class="card-body card-form p-4">
                                <h3 class="fs-4 mb-1">Create User</h3>
                                <div class="row">
                                    <div class="col-sm">
                                        <label for="name" class="mb-2">Name<span class="req">*</span></label>
                                        <input type="text" placeholder="John Doe" id="name" name="name" class="form-control">
                                        <p></p>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm">
                                        <label for="" class="mb-2">Email<span class="req">*</span></label>
                                        <input type="email" placeholder="johndoe@email.com" id="email" name="email" class="form-control">
                                        <p></p>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Role<span class="req">*</span></label>
                                        <select name="role" id="role" class="form-select">
                                            <option value="">Select User Role</option>
                                            @if ($roles->isNotEmpty())
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role }}" {{ $user->role === $role ? 'selected' : '' }}>{{ ucfirst($role) }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <p></p>
                                    </div>
                                </div>
        
                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Password *</label>
                                        <input type="password" placeholder="Password" id="password" name="password" class="form-control">
                                        <p></p>
                                    </div>
        
                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Confirm Password<span class="req">*</span></label>
                                        <input type="password" placeholder="Confirm Password" id="confirmPassword" name="confirmPassword" class="form-control">
                                        <p></p>
                                    </div>
                                </div>
                                
                            </div> 
                            <div class="card-footer  p-4">
                                <button type="submit" class="btn btn-primary">Create User</button>
                            </div>   
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script type="text/javascript">
        $("#createUserForm").submit(function(e){
            e.preventDefault();

            $("button[type='submit']").prop('disabled',true)
            $.ajax({
                url:'{{ route("admin.users.processRegister") }}',
                type: 'post',
                dataType: 'json',
                data: $("#createUserForm").serializeArray(),
                success: function(response) {
                    $("button[type='submit']").prop('disabled',false)
                    if(response.status == true) {

                        $("#name").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('')

                        $("#email").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('')
                            
                        $("#role").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('')

                        $("#password").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('')

                        $("#confirmPassword").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('')

                        window.location.href="{{ route('admin.users') }}";

                    } else {
                        var errors = response.errors;

                        if (errors.name) {
                                $("#name").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.name)
                            } else {
                                $("#name").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('')
                            }

                        if (errors.email) {
                                $("#email").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.email)
                            } else {
                                $("#email").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('')
                            }

                        if (errors.role) {
                                $("#role").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.role)
                            } else {
                                $("#role").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('')
                            }

                        if (errors.password) {
                                $("#password").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.password)
                            } else {
                                $("#password").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('')
                            }

                        if (errors.confirmPassword) {
                                $("#confirmPassword").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.confirmPassword)
                            } else {
                                $("#confirmPassword").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('')
                            }

                    }

                }
            });
        });
    </script>
@endsection