@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2 py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.jobs.jobs-list') }}">Contacts</a></li>
                            <li class="breadcrumb-item active" aria-current="page">View Message</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    @include('admin.sidebar')
                </div>

                <div class="col-lg-9">
                    @include('front.message')

                    <form action="#" method="POST" id="editVerificationForm" name="editVerificationForm" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        
                        <div class="card border-0 shadow mb-4">
                            <div class="card-body card-form p-4">
                                <h3 class="fs-4 mb-4">View Message</h3>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="name" class="mb-2 fw-semibold">Full Name</label>
                                        <input value="{{ $contact->name }}" type="text" id="name" name="name" class="form-control" readonly>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="email" class="mb-2 fw-semibold">Email</label>
                                        <input value="{{ $contact->email }}" type="text" id="email" name="email" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <label for="subject" class="mb-2 fw-semibold">Subject</label>
                                        <input value="{{ $contact->subject }}" type="text" id="subject" name="subject" class="form-control text-center" readonly>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <label for="message" class="mb-2 fw-semibold">Message</label>
                                        <textarea id="message" name="message" class="form-control" rows="6" readonly>{{ $contact->message }}</textarea>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end pt-3">
                                    <a href="{{ route('chatify') }}" target="_blank" class="btn btn-primary me-2">
                                        <i class="bi bi-chat-left-dots"></i> Respond
                                    </a>
                                    <a href="{{ route('admin.contacts.contacts-list') }}" class="btn btn-outline-danger">
                                        <i class="bi bi-x-circle"></i> Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
