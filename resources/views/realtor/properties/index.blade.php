@extends('realtor.layouts.app')

@section('title', 'My listings')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="admin-header mb-20">
    <div class="header-content">
        <h3>Your properties</h3>
        <div class="text-content">Listings attributed to your account</div>
    </div>
    <div class="header-actions">
        <a href="{{ route('realtor.properties.create') }}" class="tf-button-default">
            <i class="flaticon-plus"></i> Add property
        </a>
    </div>
</div>

<div class="properties-grid">
    @forelse($properties as $property)
        <x-admin-property-card
            :property="$property"
            :editRoute="route('realtor.properties.edit', $property)"
            :destroyRoute="route('realtor.properties.destroy', $property)"
        />
    @empty
        <div class="wg-box text-center py-40">
            <p class="mb-15">You have not created any listings yet.</p>
            <a href="{{ route('realtor.properties.create') }}" class="tf-button-primary">Add your first property</a>
        </div>
    @endforelse
</div>

@if($properties->hasPages())
    <div class="pagination-wrapper mt-20">
        {{ $properties->links() }}
    </div>
@endif
@endsection
