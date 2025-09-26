@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<h3>Welcome, {{ auth()->user()->name ?? 'Admin' }}</h3>
<div class="text-content">We are glad to see you again!</div>

<div class="grid-section-4 mb-20">
    <div class="wg-box">
        <div class="box-icon style-1 type-row">
            <div class="content">
                <a href="{{ route('admin.properties.index') }}" class="title">{{ $totalProperties }}</a>
                <div class="text-content">Properties</div>
            </div>
            <div class="icon has-ellipse">
                <i class="flaticon-home-2"></i>
            </div>
        </div>
    </div>
    <div class="wg-box">
        <div class="box-icon style-1 type-row">
            <div class="content">
                <a href="{{ route('admin.bookings.index') }}" class="title">{{ $totalBookings }}</a>
                <div class="text-content">Bookings</div>
            </div>
            <div class="icon has-ellipse">
                <i class="flaticon-chat-bubble"></i>
            </div>
        </div>
    </div>
    <div class="wg-box">
        <div class="box-icon style-1 type-row">
            <div class="content">
                <a href="{{ route('admin.estates.index') }}" class="title">{{ $totalEstates }}</a>
                <div class="text-content">Estates</div>
            </div>
            <div class="icon has-ellipse">
                <i class="flaticon-layers-1"></i>
            </div>
        </div>
    </div>
    <div class="wg-box">
        <div class="box-icon style-1 type-row">
            <div class="content">
                <a href="{{ route('admin.team.index') }}" class="title">{{ $totalTeamMembers }}</a>
                <div class="text-content">Team Members</div>
            </div>
            <div class="icon has-ellipse">
                <i class="flaticon-user"></i>
            </div>
        </div>
    </div>
</div>

<div class="grid-section-1">
    <div class="wg-box pl-44 w-100">
        <h4>Recent Properties</h4>
        <ul class="wrap-recent-activities">
            @forelse($recentProperties as $property)
                <li class="recent-activities-item">
                    <div class="image"></div>
                    <p><span>{{ $property->title }}</span> ({{ $property->status }})</p>
                </li>
            @empty
                <li>No recent properties.</li>
            @endforelse
        </ul>
    </div>
    {{-- <div class="wg-box">
        <h4>Recent Bookings</h4>
        <ul class="wrap-recent-activities">
            @forelse($recentBookings as $booking)
                <li class="recent-activities-item">
                    <div class="image"></div>
                    <p>{{ $booking->guest_name }} booked <span>{{ $booking->property->title ?? 'Property' }}</span> ({{ $booking->status }})</p>
                </li>
            @empty
                <li>No recent bookings.</li>
            @endforelse
        </ul>
    </div> --}}
</div>
@endsection 