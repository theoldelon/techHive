@extends('front.layouts.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <!-- Breadcrumb -->
        <div class="row mb-4">
            <div class="col">
                @if (Auth::check())
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-primary text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Me</li>
                    </ol>
                </nav>
                @endif
               
            </div>
        </div>

        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                @include('front.account.sidebar')
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                @include('front.message')

                <!-- About Me Section -->
                <div class="card border-0 shadow-sm mb-4 rounded-4">
                    <div class="card-body p-5">
                        <h2 class="h1 text-primary mb-4">About Me</h2>
                        
                        <!-- Profile Picture -->
                        <div class="text-center mb-4">
                            @if($user->freelancer && $user->freelancer->isVerified == 1)
                                <img src="{{ asset($user->freelancer->profile_picture) }}" 
                                     alt="Profile Picture" 
                                     class="rounded-circle img-fluid shadow-sm" 
                                     style="width: 200px; height: 200px; object-fit: cover; border: 4px solid #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);" />
                            @endif
                        </div>
                        

                        <div class="text-center mb-4">
                            @if ($user->role == 'user')
                                @if ($user->client && $user->client->isVerified == 1)
                                    <img src="{{ asset($user->client->profile_picture) }}" 
                                         alt="Profile Picture" 
                                         class="rounded-circle img-fluid shadow-sm" 
                                         style="width: 200px; height: 200px; object-fit: cover; border: 4px solid #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);" />
                                @endif
                            @endif
                        </div>
                        
                        <!-- Name and Designation -->
                        <div class="text-center">
                            <div class="">
                                <h4 class="mb-0 fw-bold">
                                    {{ $user->name }} 
                                    @if ($user->freelancer && $user->freelancer->isVerified == 1)
                                        <img src="{{ asset('assets/images/verified.png') }}" alt="Verified Freelancer" class="ms-2" style="width: 20px; height: 20px;">
                                    @endif
                            
                                    <!-- Show verified image beside the name if the user/client is verified -->
                                    @if ($user->client && $user->client->isVerified == 1)
                                        <img src="{{ asset('assets/images/verified.png') }}" alt="Verified Client" class="ms-2" style="width: 20px; height: 20px;">
                                    @endif 
                                </h4>
                            </div>
                            
                            <p class="text-muted fs-6 mb-2">{{ $user->designation ?? 'No designation provided' }}</p>
                        </div>
                        

                        <!-- About Content -->
                        <div class="text-center mt-4 text-secondary">
                          {!! nl2br($user->about) !!}
                        </div>
                    </div>
                </div>

                <!-- Education Section -->
                <div class="card border-0 shadow-sm mb-4 rounded-4">
                    <div class="card-body p-5">
                        <h2 class="text-primary mb-4">Education</h2>
                        <div class="row g-4">
                            @foreach ([['icon' => 'ti-bookmark-alt', 'title' => 'Education', 'value' => Auth::user()?->education],
                                       ['icon' => 'ti-pencil-alt', 'title' => 'Career Start', 'value' => Auth::user()?->career_start],
                                       ['icon' => 'ti-medall-alt', 'title' => 'Experience', 'value' => Auth::user()?->experience]] as $item)
                                <div class="col-sm-6 col-lg-4">
                                    <div class="card text-center border-0 rounded-3 shadow-sm h-100">
                                        <div class="card-body">
                                            <i class="{{ $item['icon'] }} icon-box bg-primary text-white rounded-circle p-3 fs-4 mb-3"></i>
                                            <h5 class="h6 fw-bold">{{ $item['title'] }}</h5>
                                            <p class="text-muted small mb-0">{{ $item['value'] ?? "No {$item['title']} provided" }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

<!-- Certificates & Other Info Section -->
<div class="card border-0 shadow-sm mb-4 rounded-4">
    <div class="card-body p-4">
        <h2 class="text-primary mb-4">Other Info</h2>
        <div class="text-secondary mb-4 text-center">
            {!! nl2br($user->other) !!}
        </div>

        <div class="d-flex flex-column">

            @php
                // Helper function to ensure proper URL formatting
                function ($url) {
                    if ($url && !preg_match('/^http(s)?:\/\//', $url)) {
                        return 'http://' . $url;
                    }
                    return $url;
                }
            @endphp

            <!-- Portfolio Link -->
            <a href="{{ ($user->portfolio) }}" target="_blank" class="card shadow-sm border-0 rounded-3 mb-3 social-card" style="background-color: #f1e3a1; transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease; text-decoration: none;">
                <div class="card-body text-center p-4" style="color: white;">
                    <i class="fas fa-globe fa-lg text-warning mb-3" style="color: white;"></i>
                    <h5 class="card-title fs-6 fw-bold">Portfolio</h5>
                    <p class="card-text">
                        <span class="text-dark fs-7">{{ $user->portfolio }}</span>
                    </p>
                </div>
            </a>

            <!-- Facebook Link -->
            <a href="{{ ($user->facebook) }}" target="_blank" class="card shadow-sm border-0 rounded-3 mb-3 social-card" style="background-color: #3b5998; transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease; text-decoration: none;">
                <div class="card-body text-center p-4" style="color: white;">
                    <i class="fab fa-facebook-f fa-lg" style="color: white;"></i>
                    <h5 class="card-title fs-6 fw-bold">Facebook</h5>
                    <p class="card-text">
                        <span class="text-dark fs-7">{{ $user->facebook }}</span>
                    </p>
                </div>
            </a>

            <!-- Instagram Link -->
            <a href="{{ ($user->instagram) }}" target="_blank" class="card shadow-sm border-0 rounded-3 mb-3 social-card" style="background-color: #ac2bac; transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease; text-decoration: none;">
                <div class="card-body text-center p-4" style="color: white;">
                    <i class="fab fa-instagram fa-lg" style="color: white;"></i>
                    <h5 class="card-title fs-6 fw-bold">Instagram</h5>
                    <p class="card-text">
                        <span class="text-dark fs-7">{{ $user->instagram }}</span>
                    </p>
                </div>
            </a>

            <!-- Twitter Link -->
            <a href="{{ ($user->twitter) }}" target="_blank" class="card shadow-sm border-0 rounded-3 mb-3 social-card" style="background-color: #55acee; transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease; text-decoration: none;">
                <div class="card-body text-center p-4" style="color: white;">
                    <i class="fab fa-twitter fa-lg" style="color: white;"></i>
                    <h5 class="card-title fs-6 fw-bold">Twitter</h5>
                    <p class="card-text">
                        <span class="text-dark fs-7">{{ $user->twitter }}</span>
                    </p>
                </div>
            </a>

            <!-- TikTok Link -->
            <a href="{{ ($user->tiktok) }}" target="_blank" class="card shadow-sm border-0 rounded-3 mb-3 social-card" style="background-color: #000000; transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease; text-decoration: none;">
                <div class="card-body text-center p-4" style="color: white;">
                    <i class="fab fa-tiktok fa-lg" style="color: white;"></i>
                    <h5 class="card-title fs-6 fw-bold">TikTok</h5>
                    <p class="card-text">
                        <span class="text-dark fs-7">{{ $user->tiktok }}</span>
                    </p>
                </div>
            </a>

            <!-- YouTube Link -->
            <a href="{{ ($user->youtube) }}" target="_blank" class="card shadow-sm border-0 rounded-3 mb-3 social-card" style="background-color: #ff0000; transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease; text-decoration: none;">
                <div class="card-body text-center p-4" style="color: white;">
                    <i class="fab fa-youtube fa-lg" style="color: white;"></i>
                    <h5 class="card-title fs-6 fw-bold">YouTube</h5>
                    <p class="card-text">
                        <span class="text-dark fs-7">{{ $user->youtube }}</span>
                    </p>
                </div>
            </a>

            <!-- GitHub Link -->
            <a href="{{ ($user->github) }}" target="_blank" class="card shadow-sm border-0 rounded-3 mb-3 social-card" style="background-color: #333333; transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease; text-decoration: none;">
                <div class="card-body text-center p-4" style="color: white;">
                    <i class="fab fa-github fa-lg" style="color: white;"></i>
                    <h5 class="card-title fs-6 fw-bold">GitHub</h5>
                    <p class="card-text">
                        <span class="text-dark fs-7">{{ $user->github }}</span>
                    </p>
                </div>
            </a>
        </div>
    </div>
</div>


                
            </div>
        </div>
    </div>
</section>

@endsection

@section('customCss')
<style>
    .breadcrumb a {
        text-decoration: none;
    }
    .icon-box {
        width: 50px;
        height: 50px;
        line-height: 50px;
    }
    .custom-progress {
        height: 12px;
        background-color: #e9ecef;
    }
    .custom-bar {
        transition: width 0.4s ease;
    }
</style>
@endsection

@section('customJs')
<script>
    // Add any custom interactivity here if needed
</script>
@endsection
