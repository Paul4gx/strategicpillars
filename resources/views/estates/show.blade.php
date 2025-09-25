@extends('layouts.app')

@section('title', $estate->name . ' | Strategic Pillars')
@section('meta_description', Str::limit($estate->description, 150))

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-7">
                <img src="{{ $estate->cover_image_url ?? asset('template/images/house/featured-1.jpg') }}" class="img-fluid rounded mb-3" alt="{{ $estate->name }}">
            </div>
            <div class="col-md-5">
                <h1>{{ $estate->name }}</h1>
                <p>{{ $estate->description }}</p>
                <p><strong>Status:</strong> {{ ucfirst($estate->status) }}</p>
                <p><strong>Location:</strong> {{ $estate->city }}, {{ $estate->state }}</p>
                <p><strong>Amenities:</strong> {{ $estate->amenities ? implode(', ', $estate->amenities) : '-' }}</p>
                @if($estate->map_embed)
                    <div class="mb-3">
                        {!! $estate->map_embed !!}
                    </div>
                @endif
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <h4>Properties in this Estate</h4>
                <div class="row">
                    @forelse($properties as $property)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <img src="{{ $property->main_image_url ?? asset('template/images/house/featured-1.jpg') }}" class="card-img-top" alt="{{ $property->title }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $property->title }}</h5>
                                    <p class="card-text">₦{{ number_format($property->price) }}</p>
                                    <a href="{{ route('properties.show', $property->slug) }}" class="btn btn-outline-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p>No properties found in this estate.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 