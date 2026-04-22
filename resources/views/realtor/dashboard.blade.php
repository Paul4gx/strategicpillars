@extends('realtor.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="wg-box" style="max-width: 720px;">
    <h3 class="mb-10">Welcome, {{ auth()->user()->name }}</h3>
    <p class="text-muted mb-20">{{ auth()->user()->realty_display_name ? auth()->user()->realty_display_name : 'Complete your profile to polish how you appear on listings.' }}</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-3">
        <div class="col-md-6">
            <div class="border rounded p-20 h-100">
                <div class="text-muted small">Your active listings</div>
                <div class="fs-2 fw-bold">{{ $propertyCount }}</div>
                <a href="{{ route('realtor.properties.index') }}" class="tf-button-default mt-15 d-inline-block">Manage properties</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="border rounded p-20 h-100">
                <div class="text-muted small">Profile</div>
                <p class="mb-15">Update how buyers see you on property pages and the agents directory.</p>
                <a href="{{ route('realtor.onboarding.edit') }}" class="tf-button-default d-inline-block">Edit profile</a>
            </div>
        </div>
    </div>
</div>
@endsection
