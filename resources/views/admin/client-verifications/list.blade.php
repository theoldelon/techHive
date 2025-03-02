@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-tachometer-alt"></i> Admin</a></li>
                            <li class="breadcrumb-item active">Clients Verification Requests</li>
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
                                    <h3 class="fs-4 mb-1">Clients Verification Requests</h3>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="flex-grow-1">
                                    <form method="GET" action="{{ route('admin.client-verifications.list') }}">
                                        <div class="input-group">
                                            <input 
                                                value="{{ Request::get('keyword') }}" 
                                                type="text" 
                                                name="keyword" 
                                                id="keyword" 
                                                placeholder="Search a Client Verification Request" 
                                                class="form-control"
                                            >
                                            <button type="submit" class="btn btn-outline-secondary">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <div class="ms-3">
                                    <form method="GET" action="{{ route('admin.client-verifications.list') }}">
                                        <button type="submit" class="btn btn-secondary">
                                            <i class="fa fa-refresh"></i> Reset
                                        </button>
                                    </form>
                                </div>                                 
                            </div>

                            <!-- Sorting Dropdown moved to the right -->
                            <div class="d-flex justify-content-end mb-4">
                                <div class="w-auto">
                                    <form method="GET" action="{{ route('admin.client-verifications.list') }}">
                                        <select name="sort" id="sort" class="form-select" onchange="this.form.submit()">
                                            <option value="1" {{ (Request::get('sort') == '1' ? 'selected' : '') }}>Latest</option>
                                            <option value="0" {{ (Request::get('sort') == '0' ? 'selected' : '') }}>Oldest</option>
                                            <option value="2" {{ (Request::get('sort') == '2' ? 'selected' : '') }}>Verified</option>
                                            <option value="3" {{ (Request::get('sort') == '3' ? 'selected' : '') }}>Pending</option>
                                        </select>
                                    </form>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="bg-light">
                                        <tr>
                                            <th scope="col">Request ID</th>
                                            <th scope="col">Client ID</th>
                                            <th scope="col">Client Name</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Request Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-0">
                                        @if ($clients->isNotEmpty())
                                            @foreach ($clients as $client)
                                                <tr>
                                                    <td>{{ $client->id }}</td>
                                                    <td>{{ $client->user->id ?? 'N/A' }}</td>
                                                    <td>{{ $client->user->name ?? 'N/A' }}</td>
                                                    <td>
                                                        @if ($client->isVerified == 1)
                                                            <p class="text-success"><i class="fa fa-check-circle"></i> Verified</p>
                                                        @else
                                                            <p class="text-warning"><i class="fa fa-hourglass-half"></i> Pending</p>
                                                        @endif
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($client->created_at)->format('d M, Y') }}</td>
                                                    <td>
                                                        <div class="action-dots float-start">
                                                            <button class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li>
                                                                    <a class="dropdown-item" href="{{ route('admin.client-verifications.edit',$client->id) }}">
                                                                        <i class="fa fa-edit" aria-hidden="true"></i> Edit
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);" onclick="deleteVerification({{ $client->id }})">
                                                                        <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="10" class="text-center text-danger"><i class="fa fa-exclamation-circle"></i> No Client Verification Requests Found!</td>
                                            </tr>
                                        @endif
                                    </tbody>                                       
                                </table>
                            </div>

                            <div>
                                {{ $clients->appends(['keyword' => Request::get('keyword'), 'sort' => Request::get('sort')])->links() }}
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
        function redirectToSort() {
            const sortValue = document.getElementById('sort').value;
            const baseUrl = window.location.href.split('?')[0]; // Get URL without query parameters
            window.location.href = `${baseUrl}?sort=${sortValue}`; // Reload page with new sort
        }

        // Delete Client Verification Request
        function deleteVerification(id) {
            if (confirm("Are you sure you want to delete this Client Verification Request?")) {
                $.ajax({
                    url: `/admin/client-verifications/${id}`, // Include the ID in the URL
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}' // Include CSRF token
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status) {
                            alert('Client Verification Request Deleted Successfully!');
                            location.reload();
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        alert('Something went wrong! Please try again.');
                    }
                });
            }
        }
    </script>

    <script type="text/javascript">
        // JavaScript function to trigger page reload when sort value changes
        function sortVerificationRequests() {
            var sortValue = document.getElementById('sort').value;
            var currentUrl = window.location.href;
            var newUrl = new URL(currentUrl);
            newUrl.searchParams.set('sort', sortValue);  // Update the sort query parameter
            window.location.href = newUrl.toString();  // Reload the page with the updated sort
        }
    </script>
@endsection
