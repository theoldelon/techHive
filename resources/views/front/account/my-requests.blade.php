@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">My Requests</li>
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
                    <div class="card border-0 shadow mb-4 p-3">
                        <div class="card-body card-form">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="fs-4 mb-1 me-2">My Requests</h3>
                                </div>
                                
                                <div>
                                    <button type="button" class="btn btn-info btn-lg" data-bs-toggle="modal" data-bs-target="#myModal">Feature a Job</button>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content p-3">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myModalLabel">Payment Form</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="POST" action="{{ route('account.featureRequest') }}" class="p-3" enctype="multipart/form-data">
                                            @csrf
                                            <small class="text-danger">Note: Your Job will only be featured for 30 days.</small>

                                            <div class="mb-4 mt-4">
                                                <!-- Pay to -->
                                                <label for="send_to" class="text-center form-label fw-bold h7">Send To</label>
                                                <input type="text" value="Gcash - Dan Rikster Dizon Abangan" name="send_to_name" id="send_to_name" class="form-control text-dark mb-2 text-center" readonly>
                                                <input type="text" value="09920628141" name="send_to_number" id="send_to_number" class="form-control text-dark text-center mb-2" readonly>
                                            </div>

                                            <div class="mb-4">
                                                <!-- Job ID -->
                                                <label for="job_id" class="form-label fw-bold h7">Job ID</label>
                                                <input type="number" value="" placeholder="Enter Job ID Here" name="job_id" id="job_id" class="form-control text-dark text-center">
                                            </div>

                                            <div class="mb-4">
                                                <!-- Job Title -->
                                                <label for="job_title" class="form-label fw-bold h7">Job Title</label>
                                                <input type="text" value="" placeholder="Enter Job Title Here" name="job_title" id="job_title" class="form-control text-dark text-center">
                                            </div>
                                        
                                            <div class="mb-4">
                                                <!-- Amount Payable -->
                                                <label for="amount_payable" class="form-label fw-bold h7">Amount Payable</label>
                                                <input type="text" value="₱199" name="amount_payable" id="amount_payable" class="form-control text-dark text-center" readonly>
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
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Requests Table -->
                            <div class="table-responsive">
                                <table class="table">
                                    <thead style="background-color: rgb(155, 245, 245)">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Job ID</th>
                                            <th scope="col">Job Title</th>
                                            <th scope="col">Requested Date</th>
                                            <th scope="col">Status</th>
                                            {{-- <th scope="col">Payment</th> --}}                                        </tr>
                                    </thead>
                                    <tbody class="border-0">
                                        @if ($requests->isNotEmpty())
                                            @foreach ($requests as $request)
                                                <tr class="active">
                                                    <td>{{ $request->id }}</td>
                                                    <td>{{ $request->job_id }}</td>
                                                    <td>{{ $request->job_title }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($request->request_date)->format('d M, Y') }}</td>
                                                    <td>
                                                        @if ($request->isPaid == 1)
                                                            <div class="request-status text-capitalize" style="color: green;"><i class="fa fa-check-circle"></i> Approved</div>
                                                        @else
                                                            <div class="request-status text-capitalize" style="color: red;">Pending</div> 
                                                        @endif
                                                    </td>
                                                    {{-- <td>
                                                        @if ($request->isPaid == 1)
                                                            <p class="text-success"><i class="fa fa-check-circle"></i> Paid</p>
                                                        @else
                                                            <p class="text-warning"><i class="fa fa-hourglass-half"></i> Pending</p>
                                                        @endif
                                                    </td> --}}
                        
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>  
                                </table>
                            </div>
                            <div>
                                {{ $requests->links() }}
                            </div>
                        </div>
                    </div> 
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
                    sendToNameElement.value = 'Bank - Dan Rikster Dizon Abangan';
                    sendToNumberElement.value = 'Bank Account #123456789';
                } else { // Default/Other
                    sendToNameElement.value = '';
                    sendToNumberElement.value = '';
                }
            });
        });
    </script>    
@endsection
