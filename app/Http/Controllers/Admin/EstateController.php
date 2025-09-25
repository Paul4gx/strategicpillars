<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Estate;
use Illuminate\Http\Request;

class EstateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estates = \App\Models\Estate::with('images')->latest()->paginate(10);
        return view('admin.estates.index', compact('estates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $amenitiesList = ['Pool', 'Gym', 'Security', 'Playground', 'Parking', 'Clubhouse'];
        return view('admin.estates.create', compact('amenitiesList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'map_embed' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'status' => 'required|in:completed,developing,upcoming',
            'amenities' => 'nullable|array',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
        ]);

        $estate = new \App\Models\Estate($validated);
        $estate->slug = \Illuminate\Support\Str::slug($request->name) . '-' . uniqid();
        $estate->amenities = $request->input('amenities', []);

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('uploads/estates/covers', 'public');
            $estate->cover_image = basename($coverPath);
        }

        $estate->save();

        // Handle gallery images upload
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $imagePath = $image->store('uploads/estates/gallery', 'public');
                $estate->images()->create([
                    'image_path' => basename($imagePath)
                ]);
            }
        }

        return redirect()->route('admin.estates.index')->with('success', 'Estate created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Estate $estate)
    {
        $estate->load('images');
        return view('admin.estates.show', compact('estate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estate $estate)
    {
        $estate->load('images');
        $amenitiesList = ['Pool', 'Gym', 'Security', 'Playground', 'Parking', 'Clubhouse'];
        return view('admin.estates.edit', compact('estate', 'amenitiesList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estate $estate)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'map_embed' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'status' => 'required|in:completed,developing,upcoming',
            'amenities' => 'nullable|array',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
        ]);

        $estate->fill($validated);
        $estate->amenities = $request->input('amenities', []);

        // Handle cover image replacement
        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('uploads/estates/covers', 'public');
            $estate->cover_image = basename($coverPath);
        }

        $estate->save();

        // Handle new gallery images upload
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $imagePath = $image->store('uploads/estates/gallery', 'public');
                $estate->images()->create([
                    'image_path' => basename($imagePath)
                ]);
            }
        }

        return redirect()->route('admin.estates.edit', $estate)->with('success', 'Estate updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estate $estate)
    {
        $estate->delete();
        return redirect()->route('admin.estates.index')->with('success', 'Estate deleted successfully!');
    }

    public function deleteImage($id)
    {
        $image = \App\Models\EstateImage::findOrFail($id);
        $estate = $image->estate;
        \Illuminate\Support\Facades\Storage::disk('public')->delete('uploads/estates/gallery/' . $image->image_path);
        $image->delete();
        return redirect()->route('admin.estates.edit', $estate)->with('success', 'Image deleted successfully!');
    }
}
