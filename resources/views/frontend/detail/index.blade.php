@extends('frontend.layout.master')

@section('content')
    <x-top-padding></x-top-padding>

    <div class="container-xxl py-6">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                    <div class="row img-twice position-relative h-100">
                        <div class="col-12 align-self-end">
                            <img class="img-fluid rounded" src="{{ asset($product->image) }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                    <div class="h-100">
                        <p class="text-primary text-uppercase mb-2">Detail</p>
                        <h1 class="display-6 mb-4">{{ $product->name }}</h1>
                        <h3>${{ $product->price }}</h3>
                        <p>{{ $product->description }}</p>

                        <a class="btn btn-primary rounded-pill py-3 px-5" href="{{ route('service') }}">Go To Services</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
