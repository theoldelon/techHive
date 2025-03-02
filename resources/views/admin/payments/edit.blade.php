@extends('front.layouts.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">Payments</a></li>
                        <li class="breadcrumb-item active">Edit Payment</li>
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
                <div class="card border-0 shadow mb-4">
                    <div class="card-body card-form">
                        <form action="{{ route('admin.payments.update', $payment->id) }}" method="POST" id="paymentForm" name="paymentForm" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div>
                                <div class="card border-0 shadow mb-4">
                                    <div class="card-body p-4">
                                        <h3 class="fs-4 mb-1">Edit Payment</h3>

                                        <!-- Payment ID and Hire Transaction ID -->
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <label for="id" class="mb-2">Payment ID</label>
                                                <input value="{{ $payment->id }}" type="text" id="id" name="id" class="form-control" readonly>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label for="hire_id" class="mb-2">Hire Transaction ID</label>
                                                <input value="{{ $payment->hire->id }}" type="text" id="hire_id" name="hire_id" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label for="employer_name" class="mb-2">Employer Name</label>
                                            <input type="text" name="employer_name" id="employer_name" placeholder="John Doe" class="form-control" value="{{ $payment->employer->name }}" readonly>
                                        </div>

                                        <div class="mb-4">
                                            <label for="freelancer_name" class="mb-2">Freelancer Name</label>
                                            <input type="text" name="freelancer_name" id="freelancer_name" placeholder="John Doe" class="form-control" value="{{ $payment->freelancer->name }}" readonly>
                                        </div>

                                        <!-- Amount Payable and Reference ID -->
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <label for="amount_payable" class="mb-2">Amount Payable</label>
                                                <input value="{{ $payment->amount_payable }}" type="text" id="amount_payable" name="amount_payable" class="form-control" readonly>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label for="reference_id" class="mb-2">Reference ID</label>
                                                <input value="{{ $payment->reference_id }}" type="text" id="reference_id" name="reference_id" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <!-- Bank Name and Payment Method -->
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <label for="bank_name" class="mb-2">Bank Name</label>
                                                <input value="{{ $payment->bank_name }}" type="text" id="bank_name" name="bank_name" class="form-control" readonly>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <label for="payment_method" class="mb-2">Payment Method</label>
                                            
                                                @php
                                                    // Assign payment method text to a variable
                                                    $paymentMethodText = 'Unknown'; // Default value
                                            
                                                    if ($payment->payment_method === 0) {
                                                        $paymentMethodText = 'Bank Transfer';
                                                    } elseif ($payment->payment_method === 1) {
                                                        $paymentMethodText = 'Paypal';
                                                    } elseif ($payment->payment_method === 2) {
                                                        $paymentMethodText = 'Gcash';
                                                    }
                                                @endphp
                                            
                                                <input 
                                                    value="{{ $paymentMethodText }}" 
                                                    type="text" 
                                                    id="payment_method" 
                                                    name="payment_method" 
                                                    class="form-control" 
                                                    readonly
                                                >
                                            </div>
                                        </div>

                                        <!-- Payment Status -->
                                        <div class="mb-4 col-md-6">
                                            <div class="form-check-inline">
                                                <label for="isPaid" class="mb-2">Payment Status:</label>
                                                <input {{ ($payment->isPaid == 1) ? 'checked' : '' }} class="form-check-input" type="radio" value="1" id="isPaid-paid" name="isPaid">
                                                <label class="form-check-label" for="isPaid">Paid</label>
                                            </div>

                                            <div class="form-check-inline">
                                                <input {{ ($payment->isPaid == 0) ? 'checked' : '' }} class="form-check-input" type="radio" value="0" id="isPaid-pending" name="isPaid">
                                                <label class="form-check-label" for="isPaid">Pending</label>
                                            </div>
                                        </div>
                                        <!-- Proof Modal -->
                                        <div class="modal fade" id="proofModal" tabindex="-1" aria-labelledby="proofModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="proofModalLabel">Payment Proof</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @if(Storage::disk('public')->exists($payment->proof)) <!-- Check if the file exists in the 'public' disk -->
                                                            <img src="{{ asset('storage/' . $payment->proof) }}" alt="Payment Proof" class="img-fluid" id="proofImage" data-bs-toggle="modal" data-bs-target="#proofModal">
                                                        @else
                                                            <p>No proof available.</p>
                                                        @endif
                                                    </div>            
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Image Thumbnails -->
                                        <div class="bg-image hover-overlay ripple shadow-1-strong rounded" data-ripple-color="light" style="cursor: pointer;">
                                            @if ($payment->proof)
                                                <img src="{{ asset('storage/' . $payment->proof) }}" style="height: 400px; width:400px" id="openModal" data-bs-toggle="modal" data-bs-target="#proofModal">
                                            @else
                                                <p>No proof uploaded.</p>
                                            @endif
                                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.2);"></div>
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
            </div>
        </div>
    </div>
</section>


<script type="text/javascript">
    document.getElementById('openProofModal').addEventListener('click', function() {
        var modal = new bootstrap.Modal(document.getElementById('proofModal'));
        modal.show();
    });
</script>
@endsection
