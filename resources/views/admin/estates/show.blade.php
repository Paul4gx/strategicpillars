@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Estate Details</h1>
    <div class="card mb-4">
        <div class="card-body">
            <h4>{{ $estate->name }}</h4>
            <p>{{ $estate->description }}</p>
            <p><strong>City:</strong> {{ $estate->city }}</p>
            <p><strong>State:</strong> {{ $estate->state }}</p>
            <p><strong>Status:</strong> {{ ucfirst($estate->status) }}</p>
            <p><strong>Amenities:</strong> {{ $estate->amenities ? implode(', ', $estate->amenities) : '-' }}</p>
            @if($estate->cover_image)
                <div class="mb-3">
                    <strong>Cover Image:</strong><br>
                    <img src="{{ asset('storage/uploads/estates/covers/'.$estate->cover_image) }}" alt="Cover" style="max-width:200px;">
                </div>
            @endif
            @if($estate->images->count())
                <div class="mb-3">
                    <strong>Gallery:</strong><br>
                    @foreach($estate->images as $image)
                        <img src="{{ asset('storage/uploads/estates/gallery/'.$image->image_path) }}" alt="Gallery" style="height:60px;" class="mr-2 mb-2">
                    @endforeach
                </div>
            @endif
            @if($estate->map_embed)
                <div class="mb-3">
                    <strong>Map:</strong><br>
                    {!! $estate->map_embed !!}
                </div>
            @endif
        </div>
    </div>
    <a href="{{ route('estates.index') }}" class="btn btn-secondary">Back to Estates</a>
</div>
@endsection 