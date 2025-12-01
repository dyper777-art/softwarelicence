@extends('frontend.layout.master')

@section('content')

    <x-top-padding></x-top-padding>

    <div class="container-xxl py-6">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                    <div class="row img-twice position-relative h-100">
                        <div class="col-6">
                            <img class="img-fluid rounded" src="{{ asset('assets/img/autodesk.jpg') }}" alt="">
                        </div>
                        <div class="col-6 align-self-end">
                            <img class="img-fluid rounded" src="{{ asset('assets/img/maxoncinema.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                    <div class="h-100">
                        <p class="text-primary text-uppercase mb-2">// About Us</p>
                        <h1 class="display-6 mb-4">Delivering Authentic Software Licenses Worldwide</h1>
                        <p>We provide genuine software licenses for Windows, Microsoft Office, Adobe Suite, Antivirus, and more. Our solutions are secure, reliable, and instantly accessible.</p>
                        <p>Whether for businesses or personal use, our platform ensures fast activation, competitive pricing, and trusted support to meet all your digital software needs.</p>
                        <div class="row g-2 mb-4">
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Secure Licensing
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Instant Delivery
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Affordable Pricing
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>24/7 Support
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
