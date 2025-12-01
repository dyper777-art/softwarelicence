@extends('frontend.layout.master')

@section('content')
    <x-top-padding></x-top-padding>

    <div class="container-xxl py-6">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s"
                    style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                    <h1 class="display-6 mb-4">Profile</h1>
                    <div class="row gy-5 gx-4">
                        <div class="col-sm-12 wow fadeIn" data-wow-delay="0.1s"
                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                    <i class="fa fa-user text-white"></i>
                                </div>
                                <h5 class="mb-0">{{ Auth::user()->name }}</h5>

                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                    <i class="fa fa-envelope text-white"></i>
                                </div>
                                <h5 class="mb-0">{{ Auth::user()->email }}</h5>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                    <i class="fa fa-calendar text-white"></i>
                                </div>
                                <h5 class="mb-0">{{ Auth::user()->created_at }}</h5>
                            </div>
                        </div>
                        <div class="col-sm-12 wow fadeIn" data-wow-delay="0.4s"
                            style="visibility: visible; animation-delay: 0.4s; animation-name: fadeIn;">
                            <div class="d-flex align-items-center mb-3">
                                <form id="myForm" action="{{ route('logout') }}" class="sign-form" method="post">
                                    @csrf
                                    <a href="#" onclick="document.getElementById('myForm').submit();"
                                        class="btn btn-danger mt-5">
                                        Logout
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
