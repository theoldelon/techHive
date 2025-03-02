@extends('front.layouts.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.jobs.jobs-list') }}">Clients</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Client Verification Requests</li>
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
                <form action="{{ route('admin.client-verifications.update', $client->id) }}" method="POST" id="editClientVerificationForm" name="editClientVerificationForm" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card border-0 shadow mb-4">
                        <div class="card-body card-form p-4">
                            <h3 class="fs-4 mb-3 text-primary">Update Client Verification Request</h3>

                            <!-- Request ID and Client ID -->
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="id" class="mb-2">Request ID</label>
                                    <input value="{{ $client->id }}" type="text" id="id" name="id" class="form-control" readonly>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="freelancer_id" class="mb-2">Client ID</label>
                                    <input value="{{ $client->user->id }}" type="text" id="freelancer_id" name="freelancer_id" class="form-control" readonly>
                                </div>
                            </div>

                            <!-- Client Name -->
                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label for="name" class="mb-2">Client Name</label>
                                    <input value="{{ $client->user->name }}" type="text" id="name" name="name" class="form-control" readonly>
                                </div>
                            </div>

                            <!-- Featured and Verification Status -->
                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <div class="form-check">
                                        <input {{ ($client->isFeatured == 1) ? 'checked' : '' }} class="form-check-input" type="checkbox" value="1" id="isFeatured" name="isFeatured">
                                        <label class="form-check-label" for="isFeatured">
                                          Featured
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-4 col-md-6">
                                    <label for="isVerified" class="mb-2">Verification Status:</label>
                                    <div class="form-check form-check-inline">
                                        <input {{ ($client->isVerified == 1) ? 'checked' : '' }} class="form-check-input" type="radio" value="1" id="isVerified-active" name="isVerified">
                                        <label class="form-check-label" for="isVerified-active">
                                          Verified
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input {{ ($client->isVerified == 0) ? 'checked' : '' }} class="form-check-input" type="radio" value="0" id="isVerified-pending" name="isVerified">
                                        <label class="form-check-label" for="isVerified-pending">
                                          Pending
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- File Uploads with Modal Previews -->
                            @foreach (['valid_id', 'selfie_with_id', 'business_permit', 'dti_registration', 'sec_registration'] as $document)
                                <div class="mb-4">
                                    <label for="{{ $document }}" class="mb-2">{{ ucfirst(str_replace('_', ' ', $document)) }}</label>
                                    <div class="bg-image hover-overlay ripple shadow-1-strong rounded" data-ripple-color="light" style="cursor: pointer;">
                                        <img src="{{ $client->$document }}" style="height: 400px" class="w-50" id="open{{ ucfirst($document) }}Modal" data-bs-toggle="modal" data-bs-target="#{{ $document }}Modal" />
                                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.2);"></div>
                                    </div>
                                </div>

                                <!-- Modal for Document Preview -->
                                <div class="modal fade" id="{{ $document }}Modal" tabindex="-1" aria-labelledby="{{ $document }}ModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <img src="{{ $client->$document }}" class="w-100" alt="{{ ucfirst(str_replace('_', ' ', $document)) }}" />
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Submit and Cancel Buttons -->
                            <div class="d-flex justify-content-end pt-3">
                                <button type="submit" class="btn btn-primary me-2">Update Request</button>
                                <a href="{{ route('admin.freelancer-verifications.list') }}" class="btn btn-outline-danger">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

    <script>
        document.getElementById('openModal').addEventListener('click', function() {
            var modal = new bootstrap.Modal(document.getElementById('validIdModal'));
            modal.show();
        });

        document.getElementById('openSelfieModal').addEventListener('click', function() {
            var modal = new bootstrap.Modal(document.getElementById('selfieModal'));
            modal.show();
        });

        document.getElementById('openBusinessPermitModal').addEventListener('click', function() {
            var modal = new bootstrap.Modal(document.getElementById('businessPermitModal'));
            modal.show();
        });

        document.getElementById('opendtiRegistrationModal').addEventListener('click', function() {
            var modal = new bootstrap.Modal(document.getElementById('dtiRegistrationModal'));
            modal.show();
        });

        document.getElementById('opensecRegistrationModal').addEventListener('click', function() {
            var modal = new bootstrap.Modal(document.getElementById('secRegistrationModal'));
            modal.show();
        });
    </script>
@endsection
