@extends('front.layouts.blocked-layout')

@section('main')
    <section class="section-5 bg-2">
        @include('front.message')
        <div class="card border-0 shadow">
            <div class="txt1">ACCOUNT SUSPENDED</div>
            <div class="txt2">It seems like you have violated our community guidelines. This account has been suspended.</div>
                
            <div class="logo">
                {{-- <img src="http://blog.codepen.io/wp-content/uploads/2012/06/Black-Large.png" width="200px"> --}}
                <h1>TechHive</h1>
            </div>

            <div id="orbit-system">
                <div class="system">
                    <div class="satellite-orbit">
                        <div class="satellite">SUSPENDED</div>
                    </div>
                        <div class="planet"><img src="http://orig02.deviantart.net/69ab/f/2013/106/0/4/sad_man_by_agiq-d61wk0d.png" height="200px"></div>
                </div>
            </div>

            <div class="txt3">For more information please </div>
            <div class="options">
                <a class="btn btn-primary me-2 mt-3" href="#" type="submit">Contact Us</a>
                <p class="txt3 mt-3">Or</p>
                <a class="btn btn-outline-primary me-2 mb-4" href="{{ route('home') }}" type="submit">Return Home</a>
            </div>					
        </div>
    </section>
@endsection

@section('customJs')
@endsection
