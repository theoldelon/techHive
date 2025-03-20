@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.jobs.jobs-list') }}">Hires</a></li>
                            <li class="breadcrumb-item active">Hire Transaction Details</li>
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
                    <form action="{{ route('account.updateHires', ['hireId' => $hire->id]) }}" method="POST" id="editHireForm" name="editHireForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card border-0 shadow mb-4 ">
                            <div class="card-body card-form p-4">
                                <div class="col-12 px-0 mb-4"> 
                                    <div class="d-flex justify-content-between" style="gap: 20px;">
                                        <div class="box-left" style="flex: 1;"> 
                                            <div class="d-flex pb-2"> 
                                                <p class="fw-bold h7" style="font-weight: 600; font-size: 1.2rem; color: #575757;">
                                                    Transaction ID: 
                                                </p>
                                            </div> 
                                            <h2 class="bold">
                                                {{ $hire ? $hire->id : '' }}                                            
                                            </h2>
                                        </div> 
                                
                                        <div class="box-right" style="flex: 1;"> 
                                            <div class="d-flex pb-2"> 
                                                <p class="fw-bold h7" style="font-weight: 600; font-size: 1.2rem; color: #575757;">
                                                    Freelancer ID:  
                                                </p>
                                            </div>
                                            <h2 class="bold">
                                                {{ $freelancer ? $freelancer->id : '' }}
                                            </h2>
                                        </div> 
                                    </div>                                           
                                </div> 

                                <div class="row justify-content-center mb-4">
                                    <div class="col-12 col-md-6">
                                        <div class="mb-4">
                                            <label for="firstName" class="mb-2 d-block text-center" style="font-weight: 600; font-size: 1.2rem; color: #575757;">Freelancer Name</label>
                                            <input value="{{ $freelancer ? $freelancer->name : '' }}" type="text" id="id" name="id" class="form-control text-center fw-semibold" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-between mb-4">
                                    <!-- Salary Section -->
                                    <div class="w-50 pe-2">
                                        <div class="p-3 border rounded shadow-sm h-100">
                                            <p class="text-muted fw-bold h6 mb-0 pb-3">SALARY</p>
                                            <p class="h4 fw-bold d-flex align-items-center">
                                                <i class="fa-solid fa-peso-sign me-2"></i>
                                                @if (!empty($job->salary))
                                                    {{ $job->salary }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                
                                                                        <!-- Company box (right side) -->
                                                                        <div class="box-right w-50 ps-3">
                                                                            <div class="col-md-12 ps-0"> 
                                                                                <p class="ps-3 textmuted fw-bold h6 mb-0 pb-3  text-primary" style="font-size: 17px;">Company</p> 
                                                                                <p class="h1 fw-bold d-flex" style="font-size: 15px; color:#575757;">
                                                                                    @if (!empty($job->company_name))
                                                                                        {{ $job->company_name }}
                                                                                    @endif
                                                                                    @if (!empty($job->company_location))
                                                                                        {{ $job->company_location }}
                                                                                    @endif
                                                                                    @if (!empty($job->company_website))
                                                                                        {{ $job->company_website }}
                                                                                    @endif
                                                                                </p>
                                                                            </div>
                                                                        </div>

                                    
                                </div>                                        

                                <div class="col-12 mb-4 d-flex">
                                    <!-- Employer box (left side) -->
                                    <div class="box-left w-50 pe-3">
                                        <div class="col-md-12 ps-0"> 
                                            <p class="ps-3 textmuted fw-bold h6 mb-0 pb-3">Employer</p> 
                                            <p class="h1 fw-bold d-flex">
                                                @if (!empty($client->firstName))
                                                    {{ $client->firstName }}
                                                @endif
                                                @if (!empty($client->midName))
                                                    {{ $client->midName }}
                                                @endif
                                                @if (!empty($client->lastName))
                                                    {{ $client->lastName }}
                                                @endif
                                                @if (!empty($client->location))
                                                    {{ $client->location }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                
                                    <!-- Project Progress Section -->
                                    <div class="w-50 ps-2">
                                        <div class="p-3 border rounded shadow-sm h-100">
                                            <p class="fw-bold h7 mb-2">
                                                <span>Project Progress</span> Link
                                            </p>
                                            <input type="text" name="progress_link" value="{{ $hire->progress_link }}" placeholder="Freelancer Project Progress Link" id="progress_link" class="text-center form-control text-dark" readonly>
                                            <button class="btn btn-primary" id="clipboard" onclick="myFunction()">Copy Link</button>
                                        </div>
                                    </div>
                                </div>                                                                                                                      

                                <div class="col-12 px-0 mb-4 d-flex justify-content-between">
                                    <!-- Interview and Assessment Link (Left) -->
                                    <div class="box-right w-48 pe-2">
                                        <div class="p-3 border rounded shadow-sm">
                                            <p class="fw-bold h6 mb-3">Interview and Assessment Link</p>
                                            <div class="d-flex align-items-center">
                                                <input type="text" value="{{ $hire->assessment_link }}" name="assessment_link" id="assessment_link" class="form-control me-2" placeholder="Enter Interview or Assessment Link Here" style="max-width: 75%; color: gray;">
                                            </div>
                                        </div>
                                    </div>
                                
                                    <!-- Hire Status Status (Right) -->
                                    <div class="mb-4 col-md-6 ps-2">
                                        <label class="mb-2 fw-bold h7" for="jobStatus">Hire Status</label>
                                        <div id="jobStatus">
                                            <div class="form-check">
                                                <input {{ ($hire->hire_status == 3) ? 'checked' : '' }} class="form-check-input" type="radio" value="3" id="hire_status-hired" name="hire_status"> 
                                                <label class="form-check-label" for="hire_status-hired">
                                                    Hired
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input {{ ($hire->hire_status == 2) ? 'checked' : '' }} class="form-check-input" type="radio" value="2" id="hire_status-final-interview" name="hire_status">
                                                <label class="form-check-label" for="hire_status-final-interview">
                                                    Final Interview
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input {{ ($hire->hire_status == 1) ? 'checked' : '' }} class="form-check-input" type="radio" value="1" id="hire_status-assessment" name="hire_status">
                                                <label class="form-check-label" for="hire_status-assessment">
                                                    Assessment
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input {{ ($hire->hire_status == 0) ? 'checked' : '' }} class="form-check-input" type="radio" value="0" id="hire_status-initial-interview" name="hire_status">
                                                <label class="form-check-label" for="hire_status-initial-interview">
                                                    Initial Interview
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>            

                                <div class="d-flex justify-content-end pt-3">
                                    <button type="submit" class="btn btn-primary me-2 p-2">Update Request</button>
                                    <a href="{{ route('account.hires') }}" class="btn btn-outline-danger p-2">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>

                    @if ($hire->payment && $hire->payment->isPaid == 1)
                        <!-- Centered Button to Open the Modal -->
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#myModal">Paid!</button>
                        </div>
                    @else
                        <!-- Centered Button to Open the Modal -->
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-info btn-lg" data-bs-toggle="modal" data-bs-target="#myModal">Pay Now</button>
                        </div>

                        <!-- Modal -->
                        <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content p-3">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel">Payment Form</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ route('account.sendPayment') }}" class="p-3" enctype="multipart/form-data">
                                        @csrf
                                        <!-- Hidden input for hire_id with fallback value -->
                                        <input type="hidden" name="hire_id" value="{{ $hire ? $hire->id : '' }}">
                                        
                                        <input type="hidden" name="employer_id" value="{{ $hire ? $hire->employer->id : '' }}">
                                        
                                        <!-- Fixed typo in freelancer_id -->
                                        <input type="hidden" name="freelancer_id" value="{{ $hire ? $hire->freelancer->id : '' }}">
                                    
                                        <div class="mb-4 mt-4">
                                            <!-- Pay to -->
                                            <label for="send_to" class="text-center form-label fw-bold h7">Send To</label>
                                            <input type="text" value="Gcash - Dan Rikster Dizon Abangan" name="send_to_name" id="send_to_name" class="form-control text-dark mb-2 text-center" readonly>
                                            <input type="text" value="09920628141" name="send_to_number" id="send_to_number" class="form-control text-dark text-center mb-2" readonly>
                                            <small class="text-danger">Note: A Service Fee of 1% will be applied to all transactions.</small>
                                        </div>
                                    
                                        <div class="mb-4 text-center">
                                            <label for="amount_payable" class="form-label fw-bold h7">Breakdown</label>
                                        </div>
                                    
                                        <div class="mb-4">
                                            <!-- Amount Payable -->
                                            <label for="job_salary" class="form-label fw-bold h7">Job Salary</label>
                                            <input type="text" value="{{ $job->salary }}" name="job_salary" id="job_salary" class="form-control text-dark text-center" readonly>
                                        </div>
                                    
                                        <div class="mb-4">
                                            <!-- Amount Payable -->
                                            <label for="service_fee" class="form-label fw-bold h7">Service Fee</label>
                                            <input type="text" value="{{ $job->salary * .05 }}" name="service_fee" id="service_fee" class="form-control text-dark text-center" readonly>
                                        </div>
                                    
                                        <div class="mb-4">
                                            <!-- Amount Payable -->
                                            <label for="amount_payable" class="form-label fw-bold h7">Amount Payable</label>
                                            <input type="text" value="{{ $job->salary + $job->salary * .05 }}" name="amount_payable" id="amount_payable" class="form-control text-dark text-center" readonly>
                                        </div>
                                    
                                        <div class="mb-4">
                                            <!-- Payment ID -->
                                            <label for="reference_id" class="form-label fw-bold h7">Payment ID</label>
                                            <input type="text" name="reference_id" id="reference_id" class="form-control text-dark">
                                        </div>
                                    
                                        <div class="mb-4">
                                            <!-- Payment Method -->
                                            <label for="payment_method" class="form-label fw-bold h7">Payment Method</label>
                                            <select name="payment_method" id="payment_method" class="form-select text-dark">
                                                <option value="2" @if(old('payment_method') == 2) selected @endif>Gcash</option>
                                                <option value="1" @if(old('payment_method') == 1) selected @endif>Paypal</option>
                                                <option value="0" @if(old('payment_method') == 0) selected @endif>Bank Transfer</option>
                                            </select>
                                        </div>
                                        
                                        <div class="mb-4">
                                            <!-- Bank Name (only for Bank Transfer) -->
                                            <label for="bank_name" class="form-label fw-bold h7">If Bank Transfer - Bank Name</label>
                                            <input type="text" name="bank_name" id="bank_name" class="form-control text-dark">
                                        </div>
                                    
                                        <div class="mb-4">
                                            <!-- Transaction Image -->
                                            <label for="proof" class="form-label fw-bold h7">Transaction Image</label>
                                            <input type="file" name="proof" id="proof" class="form-control text-dark">
                                        </div>
                                    
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                                                
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>


    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            const paymentMethodElement = document.getElementById('payment_method');
            const sendToNameElement = document.getElementById('send_to_name');
            const sendToNumberElement = document.getElementById('send_to_number');

            paymentMethodElement.addEventListener('change', () => {
                if (paymentMethodElement.value === '1') { // Paypal
                    sendToNameElement.value = 'Paypal - Dan Rikster Dizon Abangan';
                    sendToNumberElement.value = 'danriksterabangan@gmail.com';
                } else if (paymentMethodElement.value === '2') { // Gcash
                    sendToNameElement.value = 'Gcash - Dan Rikster Dizon Abangan';
                    sendToNumberElement.value = '09920628141';
                } else if (paymentMethodElement.value === '0') { // Bank Transfer
                    sendToNameElement.value = 'Gcash - Dan Rikster Dizon Abangan';
                    sendToNumberElement.value = '09920628141';
                } else { // Default/Other
                    sendToNameElement.value = '';
                    sendToNumberElement.value = '';
                }
            });
        });
    </script>    
@endsection

@section('customJs')
    <script type="text/javascript">
        const copyButton = document.getElementById('clipboard');
                copyButton.addEventListener('click', (event) => {
                    event.preventDefault(); // Prevent the form submission or page reload

                    // Get the text field for the progress link
                    const copyText = document.getElementById('progress_link');

                    if (copyText) {
                        // Copy the text to the clipboard
                        navigator.clipboard.writeText(copyText.value)
                            .then(() => {
                                alert("Copied the link: " + copyText.value);
                            })
                            .catch(err => {
                                console.error("Failed to copy: ", err);
                                alert("Failed to copy the link.");
                            });
                    } else {
                        alert("Progress link input not found.");
                    }
            });
    </script>
@endsection