@extends('front.layouts.app')

@section('main')
<!-- Breadcrumb Section -->
<section class="breadcrumb-area section-padding img-bg-2">
    <div class="overlay"></div>
    <div class="container">
        <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
            <div class="section-heading">
                <h2 class="section__title text-white">Recover Password</h2>
            </div>
            <ul
                class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li>Pages</li>
                <li>Recover Password</li>
            </ul>
        </div>
    </div>
</section>
<section class="contact-area section--padding position-relative">
    <!-- Decorative Shapes -->
    <span class="ring-shape ring-shape-1"></span>
    <span class="ring-shape ring-shape-2"></span>
    <span class="ring-shape ring-shape-3"></span>
    <span class="ring-shape ring-shape-4"></span>
    <span class="ring-shape ring-shape-5"></span>
    <span class="ring-shape ring-shape-6"></span>
    <span class="ring-shape ring-shape-7"></span>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 mx-auto">
                <div class="card card-item">
                    <div class="card-body">
                        <h3 class="card-title fs-24 lh-35 pb-2">Reset Password!</h3>


                        <div class="card-body">
                            @if (session('status'))
                                <div id="success-message" class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                        </div>

                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">

                                <!-- Email Input -->
                                <div class="form-group">
                                    <label class="label-text">Email Address</label>
                                    <div class="form-group">
                                        <input id="email" type="email"
                                            class="form-control form--control @error('email') is-invalid @enderror"
                                            name="email" value="{{ $email ?? old('email') }}" required>
                                        <span class="la la-user input-icon"></span>
                                        {{-- @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror --}}
                                    </div>
                                </div>
                                <!-- Password Input -->
                                <div class="form-group">
                                    <label class="label-text">Password</label>
                                    <div class="form-group">
                                        <input id="password" type="password"
                                            class="form-control form--control @error('password') is-invalid @enderror"
                                            name="password" required>
                                        <span class="la la-lock input-icon"></span>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Confirm Password Input -->
                                <div class="form-group">
                                    <label class="label-text">Confirm Password</label>
                                    <div class="form-group">
                                        <input id="password_confirmation" type="password"
                                            class="form-control form--control" name="password_confirmation" required>
                                        <span class="la la-lock input-icon"></span>
                                    </div>
                                    <div class="form-group mb-0">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Reset Password') }}
                                        </button>
                                        <a href="{{ route('user.login') }}" class="btn btn-primary mb-0 float-end">
                                            Login Now
                                        </a>
                                        @if ($errors->has('email'))
                                            <div class="mt-2 text-danger">
                                                {{ $errors->first('email') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection

@section('customJs')
@endsection