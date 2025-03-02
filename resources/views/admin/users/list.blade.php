@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item active">All Users</li>
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
                                    <h3 class="fs-4 mb-1">All Users</h3>
                                </div> 
                                <div style="margin-top: -10px;">
                                    <a class="btn btn-primary me-2" href="{{ route('admin.users.create') }}" type="submit">
                                        <i class="fa fa-plus"></i> Create User
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="flex-grow-1">
                                    <form method="GET" action="{{ route('admin.users') }}">
                                        <div class="input-group">
                                            <input 
                                                value="{{ Request::get('keyword') }}" 
                                                type="text" 
                                                name="keyword" 
                                                id="keyword" 
                                                placeholder="Search a User" 
                                                class="form-control"
                                            >
                                            <button type="submit" class="btn btn-outline-secondary">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                
                                <div class="ms-3">
                                    <form method="GET" action="{{ route('admin.users') }}">
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
                                        <select name="sort" id="sort" class="form-control" onchange="sortUsers()">
                                            <option value="3" {{ (Request::get('sort') == '3') ? 'selected' : ''}}>All Users</option>
                                            <option value="2" {{ (Request::get('sort') == '2') ? 'selected' : ''}}>Admins</option>
                                            <option value="1" {{ (Request::get('sort') == '1') ? 'selected' : ''}}>Freelancers</option>
                                            <option value="0" {{ (Request::get('sort') == '0') ? 'selected' : ''}}>Users/Clients</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="bg-light">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Mobile</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-0">
                                        @if ($users->isNotEmpty())
                                            @foreach ($users as $user)
                                                <tr class="active">
                                                    <td>{{ $user->id }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->mobile }}</td>
                                                    <td>{{ $user->role }}</td>
                                                    <td>
                                                        @if ($user->isActive == 1)
                                                            <p class="text-success"><i class="fa fa-check-circle"></i> Active</p>
                                                        @else
                                                            <p class="text-danger"><i class="fa fa-ban"></i> Blocked</p>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="action-dots">
                                                            <button class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li><a class="dropdown-item" href="{{ route('account.show', $user->id) }}"><i class="fa fa-eye" aria-hidden="true"></i> View</a></li>
                                                                <li><a class="dropdown-item" href="{{ route('admin.users.edit', $user->id) }}"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a></li>
                                                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="deleteUser({{ $user->id }})"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="9" class="text-center text-danger"><i class="fa fa-exclamation-circle"></i> User Not Found!</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            
                            <div>
                                {{ $users->appends(['keyword' => Request::get('keyword'), 'sort' => Request::get('sort')])->links() }}
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
        function sortUsers() {
            var sortValue = document.getElementById('sort').value;
            var currentUrl = window.location.href;
            var newUrl = new URL(currentUrl);
            newUrl.searchParams.set('sort', sortValue);  // Update the sort query parameter
            window.location.href = newUrl.toString();  // Reload the page with the updated sort
        }
    </script>
@endsection
