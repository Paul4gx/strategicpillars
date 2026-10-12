<?php

namespace App\Http\Controllers\Realtor;

use App\Http\Controllers\Controller;
use App\Models\Estate;
use App\Models\EstateImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EstateController extends Controller
{
    public function index()
    {
        $estates = Estate::with('images')->latest()->paginate(10);

        return view('admin.estates.index', ['estates' => $estates, 'portal' => 'realtor']);
    }

    public function create()
    {
        $amenitiesList = ['Pool', 'Gym', 'Security', 'Playground', 'Parking', 'Clubhouse'];

        return view('admin.estates.create', compact('amenitiesList'));
    }

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

        $estate = new Estate($validated);
        $estate->slug = Str::slug($request->name).'-'.uniqid();
        $estate->amenities = $request->input('amenities', []);

        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('uploads/estates/covers', 'public');
            $estate->cover_image = basename($coverPath);
        }

        $estate->save();

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $imagePath = $image->store('uploads/estates/gallery', 'public');
                $estate->images()->create([
                    'image_path' => basename($imagePath),
                ]);
            }
        }

        return redirect()->route('realtor.estates.index')->with('success', 'Estate created successfully!');
    }

    public function show(Estate $estate)
    {
        $estate->load('images');

        return view('admin.estates.show', compact('estate'));
    }

    public function edit(Estate $estate)
    {
        $estate->load('images');
        $amenitiesList = ['Pool', 'Gym', 'Security', 'Playground', 'Parking', 'Clubhouse'];

        return view('admin.estates.edit', compact('estate', 'amenitiesList'));
    }

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

        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('uploads/estates/covers', 'public');
            $estate->cover_image = basename($coverPath);
        }

        $estate->save();

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $imagePath = $image->store('uploads/estates/gallery', 'public');
                $estate->images()->create([
                    'image_path' => basename($imagePath),
                ]);
            }
        }

        return redirect()->route('realtor.estates.edit', $estate)->with('success', 'Estate updated successfully!');
    }

    public function deleteImage($id)
    {
        $image = EstateImage::findOrFail($id);
        $estate = $image->estate;
        Storage::disk('public')->delete('uploads/estates/gallery/'.$image->image_path);
        $image->delete();

        return redirect()->route('realtor.estates.edit', $estate)->with('success', 'Image deleted successfully!');
    }
}
