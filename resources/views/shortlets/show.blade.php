@extends('layouts.app')

@section('title', $shortlet->title . ' | Strategic Pillars')
@section('meta_description', Str::limit($shortlet->description, 150))

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div id="shortletGallery" class="carousel slide mb-4" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($shortlet->images ?? [] as $key => $image)
                            <div class="carousel-item @if($key==0) active @endif">
                                <img src="{{ asset('storage/uploads/shortlets/' . $image->image_path) }}" class="d-block w-100" alt="Shortlet Image">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#shortletGallery" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#shortletGallery" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-md-5">
                <h1>{{ $shortlet->title }}</h1>
                <p class="lead">₦{{ number_format($shortlet->nightly_rate) }} / night</p>
                <p><i class="flaticon-location"></i> {{ $shortlet->location }}</p>
                <ul class="list-inline mb-3">
                    <li class="list-inline-item"><i class="flaticon-bed"></i> {{ $shortlet->bedrooms }} Beds</li>
                    <li class="list-inline-item"><i class="flaticon-bath"></i> {{ $shortlet->bathrooms }} Baths</li>
                </ul>
                <p>{{ $shortlet->description }}</p>
                <a href="#booking" class="btn btn-primary mt-3">Book Now</a>
            </div>
        </div>
    </div>
</section>
@endsection 