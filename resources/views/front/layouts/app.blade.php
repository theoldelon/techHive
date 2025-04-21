<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TechHive - Job Portal Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/hire-details.css') }}">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ti-icons@0.1.2/css/themify-icons.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">

    <!-- Customized Bootstrap Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/ui/trumbowyg.min.css" integrity="sha512-Fm8kRNVGCBZn0sPmwJbVXlqfJmPC13zRsMElZenX6v721g/H7OukJd8XzDEBRQ2FSATK8xNF9UYvzsCtUpfeJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	
    <!-- Template Stylesheet -->
    <link rel="stylesheet" ="{{ asset('assets/css/style2.css') }}">
</head>
<body data-instant-intensity="mousedown">
<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg shadow p-3" id="navbar" style="background-color: #defcff">
<!-- Branding -->
<a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center text-center py-0 px-3 px-lg-5">
    <h1 class="m-0 text-primary fw-semibold" style="font-size: 1.5rem;">
        <img src="{{ asset('assets/images/logo.png') }}" 
             alt="TechHive Logo" 
             style="width: 3rem; height: 3rem; border-radius: 50%;" 
             class="me-2 logo-enhanced">
        TechHive
    </h1>
</a>

    <!-- Toggler for Mobile -->
    <button class="navbar-toggler me-4" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" 
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar Links -->
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <!-- Navigation Links -->
            <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->routeIs('home') ? 'active fw-bold text-primary' : '' }}">
                <i class="fas fa-home mb-1"></i>
                <span>Home</span>
            </a>
            <a href="{{ route('jobs') }}" class="nav-item nav-link {{ request()->routeIs('jobs') ? 'active fw-bold text-primary' : '' }}">
                <i class="fas fa-briefcase mb-1"></i>
                <span>Jobs</span>
            </a>
            <!-- These links will only show if the user is logged in -->
            {{-- <a href="{{ route('browseFreelancers') }}" class="nav-item nav-link {{ request()->routeIs('browseFreelancers') ? 'active fw-bold text-primary' : '' }}">
                <i class="fas fa-users mb-1"></i>
                <span>Team</span> <!-- Changed text here -->
            </a> --}}
            
            <a href="{{ route('about') }}" class="nav-item nav-link {{ request()->routeIs('about') ? 'active fw-bold text-primary' : '' }}">
                <i class="fas fa-info-circle mb-1"></i>
                <span>About</span>
            </a>
            <a href="{{ route('contact') }}" class="nav-item nav-link {{ request()->routeIs('contact') ? 'active fw-bold text-primary' : '' }}">
                <i class="fas fa-envelope mb-1"></i>
                <span>Contact</span>
            </a>
        </div>
        
        
        <style>
            /* Adjust navbar height and padding */
            .navbar-nav {
                padding-top: 5px; /* Reduce top padding */
                padding-bottom: 5px; /* Reduce bottom padding */
                margin: 0; /* Remove any margin around navbar */
            }

            /* Style for each navigation item */
            .navbar-nav .nav-item {
                display: flex;
                flex-direction: column;
                align-items: center; /* Align icons and text vertically */
                justify-content: center;
                text-align: center;
                margin: 0 10px; /* Reduce horizontal space between items */
            }

            /* Adjust icon styling */
            .navbar-nav .nav-link i {
                font-size: 20px; /* Reduce icon size */
                margin-bottom: 5px; /* Space between icon and text */
                padding: 3px; /* Less padding around the icon */
            }

            /* Adjust text size and spacing */
            .navbar-nav .nav-link span {
                font-size: 12px; /* Smaller text size */
                display: block; /* Ensure the text is below the icon */
                padding: 2px 0; /* Add minimal vertical padding for spacing */
            }

            /* Add space around the active link */
            .navbar-nav .nav-link.active {
                margin-top: 3px; /* Reduce space on top of active link */
                margin-bottom: 3px; /* Reduce space below active link */
            }

            /* Add hover effects to the icons and links for better interactivity */
            .navbar-nav .nav-link:hover {
                text-decoration: none; /* Remove underline on hover */
                color: #007bff; /* Change link color on hover */
            }

            .navbar-nav .nav-link.active {
                color: #007bff; /* Active state color */
                font-weight: bold; /* Make active text bold */
            }
        </style>
        <!-- Authentication Dropdown -->
        <div class="dropdown ms-lg-3" style="margin-right: 50px;">
            <button class="btn btn-secondary dropdown-toggle position-relative" 
                    type="button" id="authDropdown" 
                    data-bs-toggle="dropdown" aria-expanded="false"
                    style="border-radius: 20px;">
                <i class="fas fa-user me-2"></i>{{ Auth::check() ? Auth::user()->name : 'Account' }}
                <!-- Notification Badge -->
            </button>

<!-- Dropdown Menu -->
<ul class="dropdown-menu shadow border-0 rounded" aria-labelledby="authDropdown" style="background-color: #ddfbfd">
    @if (!Auth::check())
        <!-- Guest Links -->
        <li><a class="dropdown-item" href="{{ route('account.login') }}"><i class="fas fa-sign-in-alt me-2"></i>Login</a></li>
        <li><a class="dropdown-item" href="{{ route('account.registration') }}"><i class="fas fa-user-plus me-2"></i>Register</a></li>
    @else
    <!-- Post a Job for User/Admin -->
        @if (Auth::user()->role == 'user' || Auth::user()->role == 'admin')
            @if (Auth::user()->client && Auth::user()->client->isVerified == 1)
                <li><a class="dropdown-item" href="{{ route('account.createJob') }}"><i class="fas fa-plus me-2"></i>Post a Job</a></li>
            @endif
        @endif

        <!-- Freelancer Account Link -->
        @if (Auth::user()->role == 'freelancer')
            <p class="dropdown-item text-center">
                <img src="{{ asset('assets/images/wave.png') }}" class="w-10 h-10" style="width: 20px; height: 20px;"> Hi, Freelancer!
            </p>
        @endif

        @if (Auth::user()->role == 'user')
            <p class="dropdown-item text-center">
                <img src="{{ asset('assets/images/wave.png') }}" class="w-10 h-10" style="width: 20px; height: 20px;"> Hi, Client!
            </p>
        @endif

        <li><hr class="dropdown-divider"></li>

        <!-- Notifications Link -->
        {{-- <li>
            <a class="dropdown-item" href="#">
                <i class="fas fa-bell me-2"></i> Notifications
            </a>
        </li> --}}

        <li><a class="dropdown-item" href="{{ route('account.show', ['id' => Auth::user()->id]) }}"><i class="fas fa-user-circle me-2"></i>My Account</a></li>

        <!-- Messages Link -->
        <li>
            <a class="dropdown-item" href="{{ route('chatify') }}">
                <i class="fas fa-comment fa-fw me-3"></i><span>Chat</span>
            </a>
        </li>

        <li><hr class="dropdown-divider"></li>
                <!-- Admin Dashboard Link -->
                @if (Auth::user()->role == 'admin')
                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Admin Dashboard</a></li>
            @endif
        <!-- Logout Link -->
        <li>
            <a class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#logoutModal" style="cursor: pointer;">
                <i class="fas fa-sign-out-alt me-2"></i>Logout
            </a>
        </li>
        

    @endif
</ul>

        </div>
    </div>
</nav>
<!-- Navbar End -->


@yield('main')

<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to log out?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title pb-0" id="exampleModalLabel">Change Profile Picture</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="profilePicForm" name="profilePicForm" action="" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Profile Image</label>
                <input type="file" class="form-control" id="image"  name="image">
				<p class="text-danger" id="image-error"></p>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mx-3">Update</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Footer Start -->
<div class="container-fluid bg-dark text-white footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <!-- Company Section -->
            <div class="col-lg-3 col-md-6 text-start">
                <h5 class="text-white mb-4">Company</h5>
                <ul class="list-unstyled">
                    <li><a class="d-block text-gray" href="{{ route('about') }}" style="padding: 0; transition: color 0.3s; text-decoration: none;">About Us</a></li>
                    <li><a class="d-block text-gray" href="{{ route('contact') }}" style="padding: 0; transition: color 0.3s; text-decoration: none;">Contact Us</a></li>
                    <li><a class="d-block text-gray" href="{{ route('terms.conditions') }}" style="padding: 0; transition: color 0.3s; text-decoration: none;">Terms & Conditions</a></li>
                </ul>
            </div>                           

            <!-- Quick Links Section -->
            <div class="col-lg-3 col-md-6 text-start">
                <h5 class="text-white mb-4">Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a class="d-block text-gray" href="{{ route('privacy.policy') }}" style="padding: 0; transition: color 0.3s; text-decoration: none;">Privacy Policy</a></li>
                    <li><a class="d-block text-gray" href="{{ route('jobs') }}" style="padding: 0; transition: color 0.3s; text-decoration: none;">Jobs</a></li>
                    <li><a class="d-block text-gray" href="{{ route('browseFreelancers') }}" style="padding: 0; transition: color 0.3s; text-decoration: none;">Team Members</a></li>
                </ul>
            </div>

            <!-- Contact Section -->
            <div class="col-lg-3 col-md-6">
                <h5 class="text-white mb-4">Contact</h5>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>South Poblacion, City of Naga, Cebu</p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>09916387846</p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i>Techhive28@gmail.com</p>
                <div class="d-flex pt-2">
                    <a class="btn btn-outline-light btn-social me-2" href="https://www.instagram.com/techhive_officialpage?igsh=NWtsOHp4enhhODgw" style="transition: background-color 0.3s;">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="btn btn-outline-light btn-social me-2" href="https://www.facebook.com/profile.php?id=61569693745246&mibextid=ZbWKwL" style="transition: background-color 0.3s;">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="btn btn-outline-light btn-social me-2" href="mailto:Techhive28@gmail.com" style="transition: background-color 0.3s;">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>
                
            </div>

            <!-- Google Map Section -->
            <div class="col-lg-3 col-md-6">
                <h5 class="text-white mb-4">Find Us</h5>
                <!-- Google Map -->
                <div class="col-md-12 wow fadeInUp" data-wow-delay="0.1s">
                    <iframe class="position-relative rounded w-100" 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3926.710194522518!2d123.75248552964338!3d10.204173299703045!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a97853a1ef0a53%3A0x33c142d07a44658a!2sProfessional%20Academy%20of%20the%20Philippines!5e0!3m2!1sen!2sph!4v1731950104790!5m2!1sen!2sph" 
                        frameborder="0" style="min-height: 400px; border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom Section -->
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom text-gray" href="#" style="transition: color 0.3s; text-decoration: none;">TechHive</a>, All Rights Reserved. 
                    Designed By <a class="border-bottom text-gray" href="https://techive.danabangan.online" style="transition: color 0.3s; text-decoration: none;">TechHive</a>.
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<style>
    /* Custom styles for gray links */
    .text-gray {
        color: #ffffff; /* Gray color */
        text-decoration: none; /* Remove underlines */
        transition: color 0.3s;
    }

    /* Hover effect for links */
    .text-gray:hover {
        color: #666; /* Darker gray on hover */
    }

    .footer a:hover {
        color: #666 !important; /* Ensure all links in footer darken on hover */
    }
</style>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@yield('customJs')

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS (Ensure it matches the CSS version) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Additional Libraries -->
<script src="{{ asset('js/wow/wow.min.js') }}"></script>
<script src="{{ asset('js/easing/easing.min.js') }}"></script>
<script src="{{ asset('js/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('js/owl.  sel.min.js') }}"></script>

<!-- Trumbowyg (Text Editor) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/trumbowyg.min.js" 
        integrity="sha512-YJgZG+6o3xSc0k5wv774GS+W1gx0vuSI/kr0E0UylL/Qg/noNspPtYwHPN9q6n59CTR/uhgXfjDXLTRI+uIryg==" 
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Custom and Template Scripts -->
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>



<script>
	$('.textarea').trumbowyg();

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$("#profilePicForm").submit(function(e){
		e.preventDefault();

		var formData = new FormData(this);

		$.ajax({
			url: '{{ route("account.updateProfilePic") }}',
			type: 'post',
			data: formData,
			dataType: 'json',
			contentType: false,
			processData: false,
			success: function(response) {
				if(response.status == false) {
					var errors = response.errors;
					if (errors.image) {
						$("#image-error").html(errors.image)
					}
				} else {
					window.location.href = '{{ url()->current() }}'
				}
			}
		});
	});
</script>
</body>
</html>