<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = \App\Models\Property::with('images')->latest()->paginate(10);
        return view('admin.properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $estates = \App\Models\Estate::all();
        return view('admin.properties.create', compact('estates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'long_description' => 'nullable|string',
            'status' => 'required|in:available,sold,rented,off-plan,upcoming',
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'property_type' => 'required|string|max:255',
            'bedrooms' => 'nullable|integer',
            'bathrooms' => 'nullable|integer',
            'parking_spaces' => 'nullable|integer',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'estate_id' => 'nullable|exists:estates,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'featured' => 'nullable|boolean',
            'video_link' => 'nullable|string|max:255',
            'brochure' => 'nullable|file|mimes:pdf',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:255',
            'year_built' => 'nullable|integer|min:1900|max:2030',
            'area' => 'nullable|integer|min:1',
            'property_features' => 'nullable|array',
            'property_features.*' => 'string|max:255',
            'building_type' => 'nullable|in:office,home,complex,others',
        ]);

        $property = new \App\Models\Property($validated);
        $property->slug = Str::slug($request->title) . '-' . uniqid();
        $property->featured = $request->has('featured');

        // Handle brochure upload
        if ($request->hasFile('brochure')) {
            $brochurePath = $request->file('brochure')->store('uploads/brochures', 'public');
            $property->brochure = basename($brochurePath);
        }

        $property->save();

        // Handle images upload
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('uploads/properties', 'public');
                $property->images()->create([
                    'image_path' => basename($imagePath)
                ]);
            }
        }

        return redirect()->route('admin.properties.index')->with('success', 'Property created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $property = \App\Models\Property::with('images')->findOrFail($id);
        $estates = \App\Models\Estate::all();
        return view('admin.properties.edit', compact('property', 'estates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $property = \App\Models\Property::with('images')->findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'long_description' => 'nullable|string',
            'status' => 'required|in:available,sold,rented,off-plan,upcoming',
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'property_type' => 'required|string|max:255',
            'bedrooms' => 'nullable|integer',
            'bathrooms' => 'nullable|integer',
            'parking_spaces' => 'nullable|integer',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'estate_id' => 'nullable|exists:estates,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'featured' => 'nullable|boolean',
            'video_link' => 'nullable|string|max:255',
            'brochure' => 'nullable|file|mimes:pdf',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:255',
            'year_built' => 'nullable|integer|min:1900|max:2030',
            'area' => 'nullable|integer|min:1',
            'property_features' => 'nullable|array',
            'property_features.*' => 'string|max:255',
            'building_type' => 'nullable|in:office,home,complex,others',
        ]);

        $property->fill($validated);
        $property->featured = $request->has('featured');

        // Handle brochure replacement
        if ($request->hasFile('brochure')) {
            $brochurePath = $request->file('brochure')->store('uploads/brochures', 'public');
            $property->brochure = basename($brochurePath);
        }

        $property->save();

        // Handle new images upload
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('uploads/properties', 'public');
                $property->images()->create([
                    'image_path' => basename($imagePath)
                ]);
            }
        }

        return redirect()->route('admin.properties.edit', $property)->with('success', 'Property updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        //
    }

    public function deleteImage($id)
    {
        $image = \App\Models\PropertyImage::findOrFail($id);
        $property = $image->property;
        // Delete the file from storage
        Storage::disk('public')->delete('uploads/properties/' . $image->image_path);
        $image->delete();
        return redirect()->route('admin.properties.edit', $property)->with('success', 'Image deleted successfully!');
    }
}
