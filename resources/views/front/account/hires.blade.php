@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Hired Freelancers</li>
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
                                <div>
                                    <h3 class="fs-4 mb-1">Hired Freelancers Transactions</h3>
                                </div>

                                <div class="col-6 col-md-2">
                                    <div class="w-full flex justify-end"> <!-- Flexbox for alignment -->
                                        <select name="sort" id="sort" class="form-select" onchange="redirectToSort()">
                                            <option value="1" {{ request('sort', '1') == '1' ? 'selected' : '' }}>Latest</option>
                                            <option value="0" {{ request('sort') == '0' ? 'selected' : '' }}>Oldest</option>
                                        </select>                                                                                                           
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table ">
                                    <thead class="" style="background-color: rgb(155, 245, 245)">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Freelancer Name</th>
                                            <th scope="col">Mobile</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Hired Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Payment</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-0">
                                        @if ($hires->isNotEmpty())
                                            @foreach ($hires as $hire)
                                                <tr class="active">
                                                    <td>
                                                        <div class="job-name fw-500">{{ $hire->id }}</div>
                                                    </td>
                                                    <td>
                                                        <div class="job-name fw-500">{{ $hire->job->title }}</div>
                                                    </td>
                                                    <td>{{ $hire->freelancer->name }}</td>
                                                    <td>{{ $hire->freelancer->mobile }}</td>
                                                    <td>{{ $hire->freelancer->email }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($hire->hired_date)->format('d M, Y') }}</td>
                                                    <td>
                                                        @if ($hire->job->status == 1)
                                                            <div class="job-status text-capitalize" style="color: green">Active</div>
                                                        @else
                                                            <div class="job-status text-capitalize" style="color: red">Blocked</div> 
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($hire->payment && $hire->payment->isPaid == 1)
                                                            <div class="job-status text-capitalize" style="color: green">Paid</div>
                                                        @else
                                                            <div class="job-status text-capitalize" style="color: red">Pending</div>
                                                        @endif
                                                    </td>                                                    
                                                    <td>
                                                        <div class="action-dots float-start">
                                                            <button href="#" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li>
                                                                    <a class="dropdown-item" href="{{ route('account.editHires', ['hireId' => $hire->id]) }}">
                                                                        <i class="fa fa-eye" aria-hidden="true"></i> View
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="{{ route('jobDetail', $hire->job_id) }}"> 
                                                                        <i class="fa fa-briefcase" aria-hidden="true"></i> Visit
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="text-center">
                                                <td colspan="9">No Hire Transaction Yet.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                    
                                </table>
                            </div>
                            <div>
                                {{ $hires->links() }}
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
<script type="text/javascript">
    // Redirect to sort on change
    function redirectToSort() {
        const sortValue = document.getElementById('sort').value;
        const baseUrl = window.location.href.split('?')[0]; // Get URL without query parameters
        window.location.href = `${baseUrl}?sort=${sortValue}`;
    }

</script>
@endsection