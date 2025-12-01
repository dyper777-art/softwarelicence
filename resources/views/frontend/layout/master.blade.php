<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Index - Impact Bootstrap Template</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    @include('frontend.layout.style')

    <!-- =======================================================
  * Template Name: Impact
  * Template URL: https://bootstrapmade.com/impact-bootstrap-business-website-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    @include('frontend.layout.header')

    @if (Route::currentRouteName() == 'home')
        <!-- Carousel Start -->
        <div class="container-fluid p-0 pb-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="owl-carousel header-carousel position-relative">
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src=" {{ asset('assets/img/main.webp') }} " alt="">
                    <div class="owl-carousel-inner">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-lg-8">
                                    <p class="text-primary text-uppercase fw-bold mb-2">Trusted Software Licenses</p>
                                    <h1 class="display-1 text-light mb-4 animated slideInDown">Genuine Software for Your Business</h1>
                                    <p class="text-light fs-5 mb-4 pb-3"> Get 100% authentic licenses for Windows, Microsoft Office, Adobe products, Antivirus,
                            and professional tools at the best price. Fast delivery and secure activation guaranteed.</p>
                                    <a href="" class="btn btn-primary rounded-pill py-3 px-5">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel End -->
    @endif



    @yield('content')


    @include('frontend.layout.footer')

    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>

    @include('frontend.layout.jsshop')

</body>

</html>
