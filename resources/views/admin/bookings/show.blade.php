@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Booking Details</h1>
    <div class="card mb-4">
        <div class="card-body">
            <h4>Property: {{ $booking->property->title ?? '-' }}</h4>
            <p><strong>Guest:</strong> {{ $booking->guest_name }}</p>
            <p><strong>Phone:</strong> {{ $booking->guest_phone }}</p>
            <p><strong>Email:</strong> {{ $booking->guest_email }}</p>
            <p><strong>Check-in:</strong> {{ $booking->check_in }}</p>
            <p><strong>Check-out:</strong> {{ $booking->check_out }}</p>
            <p><strong>Guests:</strong> {{ $booking->guests_count }}</p>
            <p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
            <p><strong>Payment:</strong> {{ ucfirst($booking->payment_status) }}</p>
        </div>
    </div>
    <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Back to Bookings</a>
</div>
@endsection 