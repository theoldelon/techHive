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
                            <div class="row card-body p-4">
                                <h3 class="fs-4 mb-1">My Profile</h3>
                                <div class="col-sm mb-4">
                                    <label for="" class="mb-2">First Name</label>
                                    <input readonly type="text" name="firstName" id="firstName" placeholder="John" class="form-control" value="{{ $user->firstName }}">
                                    <p></p>
                                </div>

                                <div class="col-sm mb-4">
                                    <label for="" class="mb-2">Middle name</label>
                                    <input readonly type="text" name="midName" id="midName" placeholder="Smith" class="form-control" value="{{  $user->midName }}">
                                    <p></p>
                                </div>

                                <div class="col-sm mb-4">
                                    <label for="" class="mb-2">Last Name</label>
                                    <input readonly type="text" name="lastName" id="lastName" placeholder="Doe" class="form-control" value="{{ $user->lastName }}">
                                    <p></p>
                                </div>
                            </div>

                            <div class="row card-body p-4">
                                <div class="col-sm mb-4">
                                    <label for="" class="mb-2">Email*</label>
                                    <input readonly type="text" name="email" id="email" placeholder="johndoe@email.com" value="{{ $user->email }}" class="form-control">
                                    <p></p>
                                </div>

                                <div class="col-sm mb-4">
                                    <label for="" class="mb-2">Mobile</label>
                                    <input readonly type="number" name="mobile" id="mobile" placeholder="Mobile" value="{{ $user->mobile }}" class="form-control">
                                </div>   

                                <div class="mb-4">
                                    <label for="" class="mb-2">Designation</label>
                                    <input readonly type="text" name="designation" id="designation" placeholder="Designation" value="{{ $user->designation }}" class="form-control">
                                </div>
                            </div>
                        </div>

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
@endsection