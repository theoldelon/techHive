@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2 py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4 bg-light">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Hired Job Transaction</li>
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
                    <form action="{{ route('freelancer.updateLink', ['id' => $hire->id]) }}" method="POST" id="editHireForm" name="editHireForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card border-0 shadow mb-4">
                            <div class="container">
                                <div class="row m-0">
                                    <div class="col">
                                        <div class="row mb-4">
                                            <div class="col-12 px-0 mb-4">
                                                <div class="d-flex justify-content-between" style="gap: 20px;">
                                                    <div class="box-left" style="flex: 1;">
                                                        <div class="d-flex pb-2">
                                                            <p class="fw-bold h6" style="font-weight: 600; font-size: 1.2rem; color: #575757;">
                                                                Job Posting ID:
                                                            </p>
                                                        </div>
                                                        <h2 class="fw-bold">
                                                            {{ $transaction->id }}
                                                        </h2>
                                                    </div>

                                                    <div class="box-right" style="flex: 1;">
                                                        <div class="d-flex pb-2">
                                                            <p class="fw-bold h6" style="font-weight: 600; font-size: 1.2rem; color: #575757;">
                                                                Transaction ID:
                                                            </p>
                                                        </div>
                                                        <h2 class="fw-bold" style="color: #333">
                                                            {{ $transaction->job_id }}
                                                        </h2>
                                                    </div>

                                                    <div class="box-right" style="flex: 1;">
                                                        <div class="d-flex pb-2">
                                                            <p class="fw-bold h6" style="font-weight: 600; font-size: 1.2rem; color: #575757;">
                                                                Employer ID:
                                                            </p>
                                                        </div>
                                                        <h2 class="fw-bold">
                                                            {{ $transaction->employer->id }}
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Add Hidden Input for hire_status -->
                                            <input type="hidden" name="hire_status" value="{{ old('hire_status', $hire->hire_status) }}">

                                            <div class="row justify-content-center mb-4">
                                                <div class="col-12 col-md-6">
                                                    <div class="mb-4">
                                                        <label for="firstName" class="mb-2 d-block text-center" style="font-weight: 600; font-size: 1.2rem; color: #575757;">Employer Name</label>
                                                        <input value="{{ $transaction ? $transaction->employer->name : '' }}" type="text" id="firstName" name="firstName" class="form-control text-center fw-semibold" style="font-size: 20px" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 d-flex justify-content-between mb-4">
                                                <!-- Salary Section -->
                                                <div class="w-50 pe-2 mb-3">
                                                    <div class="p-3 border rounded shadow-sm h-100">
                                                        <p class="text-muted fw-bold h6 mb-0 pb-3">EXPECTED SALARY</p>
                                                        <p class="h4 fw-bold d-flex align-items-center">
                                                            <i class="fa-solid fa-peso-sign me-2"></i>
                                                            @if (!empty($job->salary))
                                                                {{ $job->salary }}
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>

                                                 <!-- Company Information (Right) -->
                                                 <div class="col-md-6 ps-3 mb-3">
                                                    <div class="p-4 border rounded shadow-sm h-100 bg-light">
                                                        <p class="fw-bold h6 mb-3 text-primary">Company Information</p>
                                                        <p class="h5 fw-semibold text-dark mb-2">
                                                            @if (!empty($job->company_name))
                                                                <span class="d-block text-secondary mb-2" style="font-size: 15px">Company Name: <span class="fw-normal" style="font-size: 15px">{{ $job->company_name }}</span></span>
                                                            @endif
                                                            @if (!empty($job->company_location))
                                                                <span class="d-block text-secondary mb-2" style="font-size: 15px">Location: <span class="fw-normal" style="font-size: 15px">{{ $job->company_location }}</span></span>
                                                            @endif
                                                            @if (!empty($job->company_website))
                                                                <span class="d-block text-secondary mb-2" style="font-size: 15px">Website: <span class="fw-normal" style="font-size: 15px"><a href="{{ $job->company_website }}" target="_blank" class="text-decoration-none">{{ $job->company_website }}</a></span></span>
                                                            @endif
                                                        </p>
                                                    </div>
                                                 </div>
                                            </div>

                                            <div class="col-12 px-0 mb-4">
                                                <div class="row">
                                                    
                                                    <!-- Interview and Assessment Link (Left) -->
                                                    <div class="col-md-6 pe-3 mb-3">
                                                        <div class="p-3 border rounded shadow-sm h-100">
                                                            <p class="fw-bold h6 mb-2">Interview and Assessment Link</p>
                                                            <div class="d-flex align-items-center">
                                                                <input type="text" name="" value="{{ $hire->assessment_link }}" id="myInput" class="form-control text-center me-2" readonly>
                                                                <button class="btn btn-primary" id="clipboard" onclick="myFunction()">Copy Link</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Project Progress Section -->
                                                    <div class="w-50 ps-2 mb-3">
                                                        <div class="p-3 border rounded shadow-sm h-100">
                                                            <p class="fw-bold h6 mb-2">
                                                                Project Progress Link
                                                            </p>
                                                            <input type="text" name="progress_link" placeholder="Freelancer Project Progress Link" id="progress_link" class="form-control text-dark text-center" value="{{ old('progress_link', $hire->progress_link) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 px-0 rounded" style="background: #6b8a8d;">
                                                <div class="box-right">
                                                    <div class="d-flex mb-2">
                                                        <p class="fw-bold">Hire Status</p>
                                                    </div>
                                                    <div class="row">
                                                        <div class="progress-track">
                                                            <ul id="progressbar">
                                                                <li class="step0 {{ $hire->hire_status >= 0 ? 'active' : '' }}" id="step1" style="font-size: 0.85rem;">Initial Interview</li>
                                                                <li class="step0 {{ $hire->hire_status >= 1 ? 'active' : '' }} text-center" id="step2" style="font-size: 0.85rem;">Assessment</li>
                                                                <li class="step0 {{ $hire->hire_status >= 2 ? 'active' : '' }} text-right text-end" id="step3" style="font-size: 0.85rem;">Final Interview</li>
                                                                <li class="step0 {{ $hire->hire_status == 3 ? 'active' : '' }} text-right text-end" id="step4" style="font-size: 0.85rem;">Hired</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end pt-3" style="padding-bottom: 20px; margin-right: 15px">
                                <button type="submit" class="btn btn-primary me-2 p-2">Update</button>
                                <a href="{{ route('account.myJobApplications') }}" class="btn btn-outline-danger p-2">Cancel</a>
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
        function myFunction() {
            event.preventDefault();
            
            // Get the text field
            var copyText = document.getElementById("myInput");

            // Select the text field
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.value);

            // Alert the copied text
            alert("Copied the text: " + copyText.value);
        }
    </script>
@endsection
