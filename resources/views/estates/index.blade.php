@extends('layouts.app')

@section('title', 'Estates | Strategic Pillars')
@section('meta_description', 'Browse all estates developed by Strategic Pillars in Lagos.')

@section('content')
<section class="py-5 bg-light">
    <div class="container">
        <h1 class="mb-4 text-center">Our Estates</h1>
        <div class="row">
            @forelse($estates as $estate)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ $estate->cover_image_url ?? asset('template/images/house/featured-1.jpg') }}" class="card-img-top" alt="{{ $estate->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $estate->name }}</h5>
                            <p class="card-text">{{ Str::limit($estate->description, 80) }}</p>
                            <a href="{{ route('estates.show', $estate->slug) }}" class="btn btn-outline-primary">View Details</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No estates found.</p>
                </div>
            @endforelse
        </div>
        <div class="mt-4">
            {{ $estates->links() }}
        </div>
    </div>
</section>
@endsection 