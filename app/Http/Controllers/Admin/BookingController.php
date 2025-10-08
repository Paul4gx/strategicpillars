<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = \App\Models\Booking::with('property')->latest()->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $shortletTypes = config('property_types.shortlet_types', []);
        $properties = \App\Models\Property::whereIn('property_type', $shortletTypes)->get();
        return view('admin.bookings.create', compact('properties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'guest_name' => 'required|string|max:255',
            'guest_phone' => 'required|string|max:255',
            'guest_email' => 'required|email|max:255',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after_or_equal:check_in',
            'guests_count' => 'required|integer|min:1',
            'status' => 'required|in:pending,confirmed,completed',
            'payment_status' => 'required|in:paid,unpaid',
        ]);

        \App\Models\Booking::create($validated);
        return redirect()->route('admin.bookings.index')->with('success', 'Booking created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        $booking->load('property');
        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $shortletTypes = config('property_types.shortlet_types', []);
        $properties = \App\Models\Property::whereIn('property_type', $shortletTypes)->get();
        return view('admin.bookings.edit', compact('booking', 'properties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'guest_name' => 'required|string|max:255',
            'guest_phone' => 'required|string|max:255',
            'guest_email' => 'required|email|max:255',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after_or_equal:check_in',
            'guests_count' => 'required|integer|min:1',
            'status' => 'required|in:pending,confirmed,completed',
            'payment_status' => 'required|in:paid,unpaid',
        ]);

        $booking->update($validated);
        return redirect()->route('admin.bookings.edit', $booking)->with('success', 'Booking updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted successfully!');
    }

    // Block dates logic (simple array for now)
    public function blockDates(Request $request, $propertyId)
    {
        $property = \App\Models\Property::findOrFail($propertyId);
        $blocked = $request->input('blocked_dates', []); // array of dates
        // Store as JSON in a meta field or a separate table if needed (not implemented here)
        // $property->blocked_dates = json_encode($blocked);
        // $property->save();
        return back()->with('success', 'Blocked dates updated (demo, not persisted).');
    }
}
