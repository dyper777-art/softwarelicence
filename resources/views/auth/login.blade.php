@extends('frontend.layout.master')

@section('content')
    <x-top-padding></x-top-padding>

    <div class="container-xxl py-6">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px; visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                {{-- <p class="text-primary text-uppercase mb-2">Login</p> --}}
                <h1 class="display-6 mb-4">LOGIN</h1>
            </div>
            <div class="row g-0 justify-content-center">
                <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                    <p class="text-center mb-4">
                        @if($errors->any())
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif
                    </p>
                    <form action="{{ route('login') }}" method="post" >
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-sharkid="__1" data-sharklabel="email">
                                    <label for="email">Your Email</label>
                                <shark-icon-container data-sharkidcontainer="__1" style="position: absolute;"></shark-icon-container></div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="password" class="form-control" name="password" id="subject" placeholder="Password" data-sharkid="__2">
                                    <label for="subject">Password</label>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button class="btn btn-primary rounded-pill py-3 px-5" type="submit">Login</button>
                            </div>
                        </div>
                    </form>
                    <a href="{{ route('register') }}" class="btn btn-primary rounded-pill py-3 px-5">Create Account <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

@endsection
