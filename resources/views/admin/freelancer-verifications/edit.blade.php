@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.jobs.jobs-list') }}">Freelancer Verification Requests</a></li>
                            <li class="breadcrumb-item active">Process Request</li>
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
                    <form action="{{ route('admin.freelancer-verifications.update', $freelancer->id) }}" method="POST" id="editVerificationForm" name="editVerificationForm" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="card border-0 shadow mb-4 ">
                            <div class="card-body card-form p-4">
                                <h3 class="fs-4 mb-1">Update Freelancer Verification Request</h3>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="id" class="mb-2">Request ID</label>
                                        <input value="{{ $freelancer->id }}" type="text" id="id" name="id" class="form-control" readonly>
                                    </div>

                                    <div class="col-md-6  mb-4">
                                        <label for="freelancer_id" class="mb-2">Freelancer ID</label>
                                        <input value="{{ $freelancer->user->id }}" type="text" id="freelancer_id" name="freelancer_id" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-4 col-md-4">
                                        <label for="firstName" class="mb-2">Freelancer Name</label>
                                        <input value="{{ $freelancer->user->name }}" type="text" id="firstName" name="firstName" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <div class="form-check">
                                            <input {{ ($freelancer->isFeatured == 1) ? 'checked' : '' }} class="form-check-input" type="checkbox" value="1" id="isFeatured" name="isFeatured">
                                            <label class="form-check-label" for="isFeatured">
                                              Featured
                                            </label>
                                        </div>
                                    </div>

                                    <div class="mb-4 col-md-6">
                                        <div class="form-check-inline">
                                            <label for="isVerified" class="mb-2">Verification Status: </label>
                                            <input {{ ($freelancer->isVerified == 1) ? 'checked' : '' }} class="form-check-input" type="radio" value="1" id="isVerified-active" name="isVerified">
                                            <label class="form-check-label" for="isVerified">
                                              Verified
                                            </label>
                                        </div>
                                        
                                        <div class="form-check-inline">
                                            <input {{ ($freelancer->isVerified == 0) ? 'checked' : '' }} class="form-check-input" type="radio" value="0" id="isVerified-block" name="isVerified">
                                            <label class="form-check-label" for="isVerified">
                                              Pending
                                            </label>
                                        </div>                                      
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <!-- Link to view the resume -->
                                    <a href="{{ route('admin.freelancer-verifications.view-resume', $freelancer->id) }}" class="btn btn-primary" target="_blank">View Resume</a>
                                </div>

                                <div class="mb-4">
                                    <label for="valid_id" class="mb-2">Valid ID</label>
                                    <div class="bg-image hover-overlay ripple shadow-1-strong rounded" data-ripple-color="light" style="cursor: pointer;">
                                        <img src="{{ $freelancer->valid_id }}" style="height: 400px" class="w-50" id="openModal" />
                                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.2);"></div>
                                    </div>
                                </div>

                                <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModal1Label" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <img src="{{ $freelancer->valid_id }}" class="w-100" alt="Freelancer Valid ID" />
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="selfie_with_id" class="mb-2">Selfie with Valid ID</label>
                                    <div class="bg-image hover-overlay ripple shadow-1-strong rounded" data-ripple-color="light" style="cursor: pointer;">
                                        <img src="{{ $freelancer->selfie_with_id }}" class="w-50" id="openSelfieModal" />
                                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.2);"></div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="diploma" class="mb-2">Diploma</label>
                                    <div class="bg-image hover-overlay ripple shadow-1-strong rounded" data-ripple-color="light" style="cursor: pointer;">
                                        <img src="{{ $freelancer->diploma }}"  style="height: 400px" class="w-50" id="openDiplomaModal" />
                                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.2);"></div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="certificate" class="mb-2">Certificate</label>
                                    <div class="bg-image hover-overlay ripple shadow-1-strong rounded" data-ripple-color="light" style="cursor: pointer;">
                                        <img src="{{ $freelancer->certificate }}" style="height: 400px" class="w-50" id="openCertificateModal" />
                                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.2);"></div>
                                    </div>
                                </div>

                                <div class="modal fade" id="selfieModal" tabindex="-1" aria-labelledby="selfieModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <img src="{{ $freelancer->selfie_with_id }}" class="w-100" alt="Selfie with Valid ID" />
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="diplomaModal" tabindex="-1" aria-labelledby="diplomaModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <img src="{{ $freelancer->diploma }}" class="w-100" alt="Diploma" />
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="certificateModal" tabindex="-1" aria-labelledby="certificateModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <img src="{{ $freelancer->certificate }}" class="w-100" alt="Certificate" />
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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

    <script type="text/javascript">
        document.getElementById('openModal').addEventListener('click', function() {
            var modal = new bootstrap.Modal(document.getElementById('exampleModal1'));
            modal.show();
        });

        document.getElementById('openSelfieModal').addEventListener('click', function() {
            var modal = new bootstrap.Modal(document.getElementById('selfieModal'));
            modal.show();
        });

        document.getElementById('openDiplomaModal').addEventListener('click', function() {
            var modal = new bootstrap.Modal(document.getElementById('diplomaModal'));
            modal.show();
        });

        document.getElementById('openCertificateModal').addEventListener('click', function() {
            var modal = new bootstrap.Modal(document.getElementById('certificateModal'));
            modal.show();
        });
    </script>
@endsection
