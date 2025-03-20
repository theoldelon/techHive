<div class="container-fluid">
    <div class="row">
        <!-- Toggle Button for Sidebar (Mobile) -->
        <div class="d-flex justify-content-start d-lg-none mb-3">
            <button
                class="btn btn-primary"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu"
                aria-expanded="false"
                aria-controls="sidebarMenu"
            >
                ☰ Menu
            </button>
        </div>

        <!-- Sidebar -->
        <nav
            id="sidebarMenu"
            class="collapse d-lg-block sidebar bg-white"
        >
            <div class="position-sticky">
                <div class="list-group list-group-flush mx-3 mt-4"> 
                    <a href="{{ route('chatify') }}" 
                       class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('chatify') ? 'active' : '' }}">
                        <i class="fas fa-comment fa-fw me-3"></i><span>Chat</span>
                    </a>
                    <!-- Role-Based Links (Client Role) -->
                    @if (Auth::user()->role == 'user')
                        <a href="{{ route('account.client-verify') }}" 
                           class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('account.client-verify') ? 'active' : '' }}">
                            <i class="fas fa-check-circle fa-fw me-3"></i><span>Verify Now</span>
                        </a>
                        @if(Auth::user()->client && Auth::user()->client->isVerified == 1)
                            <a href="{{ route('account.createJob') }}" 
                               class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('account.createJob') ? 'active' : '' }}">
                                <i class="fas fa-briefcase fa-fw me-3"></i><span>Post a Job</span>
                            </a>
                            <a href="{{ route('account.myJobs') }}" 
                               class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('account.myJobs') ? 'active' : '' }}">
                                <i class="fas fa-folder fa-fw me-3"></i><span>My Jobs</span>
                            </a>
                            <a href="{{ route('account.hires') }}" 
                               class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('account.hires') ? 'active' : '' }}">
                                <i class="fas fa-user-plus fa-fw me-3"></i><span>Hired Freelancers</span>
                            </a>
                        @endif
                    @endif

                    <!-- Role-Based Links (Freelancer Role) -->
                    @if (Auth::user()->role == 'freelancer')
                        <a href="{{ route('freelancer.verify-now') }}" 
                           class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('freelancer.verify-now') ? 'active' : '' }}">
                            <i class="fas fa-check-circle fa-fw me-3"></i><span>Verify Now</span>
                        </a>
                        @if(Auth::user()->freelancer && Auth::user()->freelancer->isVerified == 1)
                            <a href="{{ route('account.myJobApplications') }}" 
                               class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('account.myJobApplications') ? 'active' : '' }}">
                                <i class="fas fa-clipboard-list fa-fw me-3"></i><span>Jobs Applied</span>
                            </a>
                        @endif
                    @endif

                    <!-- Admin Links (For Admin Users) -->
                    @if (Auth::user()->role == 'admin')
                        <a href="{{ route('admin.users') }}" 
                           class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                            <i class="fas fa-users me-2"></i>Users
                        </a>
                        <a href="{{ route('admin.client-verifications.list') }}" 
                           class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.client-verifications.list') ? 'active' : '' }}">
                            <i class="fas fa-check-circle me-2"></i>Client Verification
                        </a>
                        <a href="{{ route('admin.jobs.jobs-list') }}" 
                           class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.jobs.jobs-list') ? 'active' : '' }}">
                            <i class="fas fa-briefcase me-2"></i>Jobs
                        </a>
                        <a href="{{ route('admin.jobs.jobApplications') }}" 
                           class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.jobs.jobApplications') ? 'active' : '' }}">
                            <i class="fas fa-clipboard-list me-2"></i>Job Applications
                        </a>
                        <a href="{{ route('admin.hires.hires-list') }}" 
                           class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.hires.hires-list') ? 'active' : '' }}">
                            <i class="fas fa-users-cog me-2"></i>Hires
                        </a>
                        <a href="{{ route('admin.requests.list') }}" 
                           class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.requests.list') ? 'active' : '' }}">
                            <i class="fa-solid fa-bell me-2"></i>Requests
                        </a>
                        <a href="{{ route('admin.payments.list') }}" 
                           class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.payments.list') ? 'active' : '' }}">
                           <i class="fa-solid fa-peso-sign me-2"></i>Payments
                        </a>
                        <a href="{{ route('admin.freelancer-verifications.list') }}" 
                           class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.freelancer-verifications.list') ? 'active' : '' }}">
                            <i class="fas fa-check-circle me-2"></i>Freelancer Verification
                        </a>
                        <a href="{{ route('admin.contacts.contacts-list') }}" 
                           class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.contacts.contacts-list') ? 'active' : '' }}">
                            <i class="fas fa-address-book me-2"></i>Contacts
                        </a>
                    @endif
                </div>
            </div>
        </nav>
    </div>
</div>
