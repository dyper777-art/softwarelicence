@extends('frontend.layout.master')

@section('content')

    <!-- Team Section -->

    <div class="container-xxl bg-light my-6 py-6 pt-0">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px; visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                <h1 class="display-6 mb-4 pt-5">Our New Services</h1>
            </div>
            <div class="row g-4">

                  @foreach ($products as $product)
                    <x-service-card :product="$product"></x-service-card>
                @endforeach

            </div>
        </div>
    </div>

    <section id="pricing" class="pricing section">

        <!-- Section Title -->
        <div class="container section-title aos-init aos-animate" data-aos="fade-up">
            <div class="text-center">
                <a class="btn btn-primary rounded-pill py-3 px-5" href="">Read More</a>
            </div>
        </div><!-- End Section Title -->

    </section>
@endsection
