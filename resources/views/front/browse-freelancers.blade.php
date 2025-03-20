@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">

                <div class="col-lg-9">
                    @include('front.message')
                    <div class="card border-0 shadow mb-4"></div>
                </div>

                <div class="container py-5">
                    <h2 class="text-center mb-4">Meet the Team</h2>

                    <div class="row">
                        <!-- Team Member Card 1 -->
                        <div class="col-md-3 mb-4">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#teamModal1" class="card shadow-sm text-decoration-none">
                                <img src="{{ asset('assets/images/banner-1.jpg') }}" class="card-img-top" alt="Team Member Image">
                                <div class="card-body">
                                    <h5 class="card-title">Jeremy Taraya</h5>
                                    <p class="card-text">
                                        <strong>Role:</strong> Dev Palit
                                    </p>
                                </div>
                            </a>
                        </div>

                        <!-- Team Member Card 2 -->
                        <div class="col-md-3 mb-4">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#teamModal2" class="card shadow-sm text-decoration-none">
                                <img src="https://via.placeholder.com/150" class="card-img-top" alt="Team Member Image">
                                <div class="card-body">
                                    <h5 class="card-title">Lance Repollo</h5>
                                    <p class="card-text">
                                        <strong>Role:</strong> Graphic Designer
                                    </p>
                                </div>
                            </a>
                        </div>

                        <!-- Team Member Card 3 -->
                        <div class="col-md-3 mb-4">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#teamModal3" class="card shadow-sm text-decoration-none">
                                <img src="https://via.placeholder.com/150" class="card-img-top" alt="Team Member Image">
                                <div class="card-body">
                                    <h5 class="card-title">Jean Paca</h5>
                                    <p class="card-text">
                                        <strong>Role:</strong> Data Analyst
                                    </p>
                                </div>
                            </a>
                        </div>

                        <!-- Team Member Card 4 -->
                        <div class="col-md-3 mb-4">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#teamModal4" class="card shadow-sm text-decoration-none">
                                <img src="https://via.placeholder.com/150" class="card-img-top" alt="Team Member Image">
                                <div class="card-body">
                                    <h5 class="card-title">Dan Rixter</h5>
                                    <p class="card-text">
                                        <strong>Role:</strong> Project Manager
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Modal for Team Member 1 -->
                    <div class="modal fade" id="teamModal1" tabindex="-1" aria-labelledby="teamModalLabel1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="teamModalLabel1">John Doe - Web Developer</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <!-- Team member image in the modal -->
                                            <img src="https://via.placeholder.com/150" class="img-fluid" alt="Team Member Image">
                                        </div>
                                        <div class="col-md-8">
                                            <h6>Bio:</h6>
                                            <p>John is an experienced web developer with over 5 years of experience in building modern websites and web applications. He specializes in PHP, Laravel, and JavaScript.</p>
                                            <p><strong>Contact:</strong> john.doe@example.com</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for Team Member 2 -->
                    <div class="modal fade" id="teamModal2" tabindex="-1" aria-labelledby="teamModalLabel2" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="teamModalLabel2">Jane Smith - Graphic Designer</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <!-- Team member image in the modal -->
                                            <img src="https://via.placeholder.com/150" class="img-fluid" alt="Team Member Image">
                                        </div>
                                        <div class="col-md-8">
                                            <h6>Bio:</h6>
                                            <p>Jane is a creative graphic designer with expertise in creating visually appealing designs for websites, logos, and print media. She excels in Adobe Photoshop and Illustrator.</p>
                                            <p><strong>Contact:</strong> jane.smith@example.com</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for Team Member 3 -->
                    <div class="modal fade" id="teamModal3" tabindex="-1" aria-labelledby="teamModalLabel3" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="teamModalLabel3">Mark Johnson - Data Analyst</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <!-- Team member image in the modal -->
                                            <img src="https://via.placeholder.com/150" class="img-fluid" alt="Team Member Image">
                                        </div>
                                        <div class="col-md-8">
                                            <h6>Bio:</h6>
                                            <p>Mark is a data analyst with expertise in Python, SQL, and data visualization. He works with businesses to interpret complex data and derive actionable insights.</p>
                                            <p><strong>Contact:</strong> mark.johnson@example.com</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for Team Member 4 -->
                    <div class="modal fade" id="teamModal4" tabindex="-1" aria-labelledby="teamModalLabel4" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="teamModalLabel4">Emily White - Project Manager</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <!-- Team member image in the modal -->
                                            <img src="https://via.placeholder.com/150" class="img-fluid" alt="Team Member Image">
                                        </div>
                                        <div class="col-md-8">
                                            <h6>Bio:</h6>
                                            <p>Emily is a highly organized project manager with expertise in overseeing the development of web and mobile applications. She ensures that projects are delivered on time and within budget.</p>
                                            <p><strong>Contact:</strong> emily.white@example.com</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection

@section('customJs')

@endsection
