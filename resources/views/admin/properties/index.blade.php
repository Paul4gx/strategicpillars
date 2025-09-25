@extends('admin.layouts.app')

@section('title', 'Properties')

@section('content')
<h3>Properties</h3>
<div class="text-content">Manage all properties here.</div>
<div class="mb-3" style="text-align: right;">
    <a href="{{ route('admin.properties.create') }}" class="tf-button-default"><i class="flaticon-plus"></i> Add New Property</a>
</div>
<div class="wg-box pl-44">
    <div class="table-listing-properties mb-40">
        <div class="head">
            <div class="item"><div class="text">Listing Title</div></div>
            <div class="item"><div class="text">Price</div></div>
            <div class="item"><div class="text">Status</div></div>
            <div class="item"><div class="text">Location</div></div>
            <div class="item"><div class="text">Action</div></div>
        </div>
        <ul>
            @forelse($properties as $property)
                <li>
                    <div class="my-properties-item item">
                        <div>
                            <div class="property">
                                <div class="image">
                                    @if($property->images->first())
                                        <img src="{{ asset('uploads/properties/' . $property->images->first()->image_path) }}" alt="{{ $property->title }}" style="width: 80px; height: 60px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('template/images/house/property-1.jpg') }}" alt="No Image" style="width: 80px; height: 60px; object-fit: cover;">
                                    @endif
                                </div>
                                <div>
                                    <div class="price">₦{{ number_format($property->price, 2) }}</div>
                                    <div class="title">
                                        <a href="{{ route('admin.properties.show', $property) }}">{{ $property->title }}</a>
                                    </div>
                                    <div class="location">
                                        <div class="icon"><i class="flaticon-location"></i></div>
                                        <p>{{ $property->address }}, {{ $property->city }}, {{ $property->state }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="box-status">{{ ucfirst($property->status) }}</div>
                        </div>
                        <div>
                            <p>{{ $property->city }}</p>
                        </div>
                        <div>
                            <ul class="wg-icon">
                                <li class="edit-btns">
                                    <a href="{{ route('admin.properties.edit', $property) }}"><i class="flaticon-edit"></i></a>
                                </li>
                                <li class="delete-btns">
                                    <form action="{{ route('admin.properties.destroy', $property) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background:none; border:none; color:#d9534f;"><i class="flaticon-delete"></i></button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            @empty
                <li><div class="my-properties-item item">No properties found.</div></li>
            @endforelse
        </ul>
    </div>
    <div class="pagination justify-center">
        {{ $properties->links() }}
    </div>
</div>
@endsection 