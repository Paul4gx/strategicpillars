@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Booking</h1>
    <form action="{{ route('bookings.update', $booking) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="property_id">Property</label>
                    <select name="property_id" class="form-control" required>
                        <option value="">Select property</option>
                        @foreach($properties as $property)
                            <option value="{{ $property->id }}" @if(old('property_id', $booking->property_id)==$property->id) selected @endif>{{ $property->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="guest_name">Guest Name</label>
                    <input type="text" name="guest_name" class="form-control" value="{{ old('guest_name', $booking->guest_name) }}" required>
                </div>
                <div class="form-group">
                    <label for="guest_phone">Guest Phone</label>
                    <input type="text" name="guest_phone" class="form-control" value="{{ old('guest_phone', $booking->guest_phone) }}" required>
                </div>
                <div class="form-group">
                    <label for="guest_email">Guest Email</label>
                    <input type="email" name="guest_email" class="form-control" value="{{ old('guest_email', $booking->guest_email) }}" required>
                </div>
                <div class="form-group">
                    <label for="check_in">Check-in Date</label>
                    <input type="date" name="check_in" class="form-control" value="{{ old('check_in', $booking->check_in) }}" required>
                </div>
                <div class="form-group">
                    <label for="check_out">Check-out Date</label>
                    <input type="date" name="check_out" class="form-control" value="{{ old('check_out', $booking->check_out) }}" required>
                </div>
                <div class="form-group">
                    <label for="guests_count">Number of Guests</label>
                    <input type="number" name="guests_count" class="form-control" value="{{ old('guests_count', $booking->guests_count) }}" min="1" required>
                </div>
                <div class="form-group">
                    <label for="status">Booking Status</label>
                    <select name="status" class="form-control" required>
                        <option value="pending" @if(old('status', $booking->status)=='pending') selected @endif>Pending</option>
                        <option value="confirmed" @if(old('status', $booking->status)=='confirmed') selected @endif>Confirmed</option>
                        <option value="completed" @if(old('status', $booking->status)=='completed') selected @endif>Completed</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="payment_status">Payment Status</label>
                    <select name="payment_status" class="form-control" required>
                        <option value="unpaid" @if(old('payment_status', $booking->payment_status)=='unpaid') selected @endif>Unpaid</option>
                        <option value="paid" @if(old('payment_status', $booking->payment_status)=='paid') selected @endif>Paid</option>
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update Booking</button>
    </form>
</div>
@endsection 