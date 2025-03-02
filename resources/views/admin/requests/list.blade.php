@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item active">All Requests</li>
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
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="fs-4 mb-1">All Requests</h3>
                                </div> 
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="flex-grow-1">
                                    <form method="GET" action="{{ route('admin.requests.list') }}">
                                        <div class="input-group">
                                            <input 
                                                value="{{ Request::get('keyword') }}" 
                                                type="text" 
                                                name="keyword" 
                                                id="keyword" 
                                                placeholder="Search a Payment Transaction" 
                                                class="form-control"
                                            >
                                            <button type="submit" class="btn btn-outline-secondary">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                
                                <div class="ms-3">
                                    <form method="GET" action="{{ route('admin.requests.list') }}">
                                        <input type="hidden" name="sort" value="{{ Request::get('sort') }}">
                                        <button type="submit" class="btn btn-secondary">
                                            <i class="fa fa-refresh"></i> Reset
                                        </button>
                                    </form>
                                </div>
                            </div>      

                            <div class="d-flex justify-content-end mb-4">
                                <div class="col-6 col-md-2">
                                    <div class="align-end">
                                        <select name="sort" id="sort" class="form-control" onchange="sortRequests()">
                                            <option value="3" {{ (Request::get('sort') == '3') ? 'selected' : ''}}>Latest</option>
                                            <option value="2" {{ (Request::get('sort') == '2') ? 'selected' : ''}}>Oldest</option>
                                            <option value="1" {{ (Request::get('sort') == '1') ? 'selected' : ''}}>Paid</option>
                                            <option value="0" {{ (Request::get('sort') == '0') ? 'selected' : ''}}>Pending</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="bg-light">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Job ID</th>
                                            <th scope="col">Job Title</th>
                                            <th scope="col">Client Name</th>
                                            <th scope="col">Requested Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-0">
                                        @if ($requests->isNotEmpty())
                                            @foreach ($requests as $request)
                                                <tr>
                                                    <td>{{ $request->id }}</td>
                                                    <td>{{ $request->job_id }}</td>
                                                    <td>{{ $request->job_title }}</td>
                                                    <td>
                                                        @if($request->user)
                                                            {{ $request->user->name }} <!-- Access the user's name -->
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>                                                                                                       
                                                    <td>{{ \Carbon\Carbon::parse($request->request_date)->format('d M, Y') }}</td>
                                                    <td>
                                                        @if ($request->isPaid == 1)
                                                            <p class="text-success"><i class="fa fa-check-circle"></i> Paid</p>
                                                        @else
                                                            <p class="text-warning"><i class="fa fa-hourglass-half"></i> Pending</p>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="action-dots">
                                                            <button class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li><a class="dropdown-item" href="{{ route('admin.requests.edit', $request->id) }}"><i class="fa fa-eye" aria-hidden="true"></i> View</a></li>
                                                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="deleteRequest({{ $request->id }})"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="10" class="text-center text-danger">Payment Transaction Not Found!</td>
                                            </tr>
                                        @endif
                                    </tbody> 
                                </table>
                            </div>
                            
                            <div>
                                {{ $requests->appends(['keyword' => Request::get('keyword'), 'sort' => Request::get('sort')])->links() }}
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
        // JavaScript function to trigger page reload when sort value changes
        function sortRequests() {
            var sortValue = document.getElementById('sort').value;
            var currentUrl = window.location.href;
            var newUrl = new URL(currentUrl);
            newUrl.searchParams.set('sort', sortValue);  // Update the sort query parameter
            window.location.href = newUrl.toString();  // Reload the page with the updated sort
        }
    </script>
@endsection
