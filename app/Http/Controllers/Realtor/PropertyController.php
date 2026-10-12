<?php

namespace App\Http\Controllers\Realtor;

use App\Http\Controllers\Concerns\OptimizesPropertyImages;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePropertyDataRequest;
use App\Http\Requests\StorePropertyImageRequest;
use App\Http\Requests\UpdatePropertyDataRequest;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PropertyController extends Controller
{
    use OptimizesPropertyImages;

    public function index()
    {
        $this->authorize('viewAny', Property::class);

        $properties = Property::query()
            ->with('images')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('admin.properties.index', [
            'properties' => $properties,
            'portal' => 'realtor',
        ]);
    }

    public function store(StorePropertyDataRequest $request)
    {
        try {
            $validated = $request->validated();

            $property = new Property($validated);
            $property->user_id = $request->user()->id;
            $property->slug = Str::slug($request->title).'-'.uniqid();
            $property->featured = $request->has('featured');

            if ($request->hasFile('brochure')) {
                $brochurePath = $request->file('brochure')->store('uploads/brochures', 'public');
                $property->brochure = basename($brochurePath);
            }

            $property->save();

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    try {
                        $filename = uniqid().'_'.time().'.jpg';
                        $optimizedImage = $this->optimizeImage($image, 1200, 900, 85);
                        Storage::disk('public')->put('uploads/properties/'.$filename, $optimizedImage);
                        $thumbnailImage = $this->createThumbnail($image, 300, 300, 80);
                        Storage::disk('public')->put('uploads/properties/thumbnails/'.$filename, $thumbnailImage);
                        $property->images()->create(['image_path' => $filename]);
                    } catch (\Exception $imageError) {
                        Log::error('Realtor image processing error: '.$imageError->getMessage(), [
                            'property_id' => $property->id,
                            'error' => $imageError->getTraceAsString(),
                        ]);
                        continue;
                    }
                }
            }

            return redirect()->route('realtor.properties.index')->with('success', 'Property created successfully!');
        } catch (\Exception $e) {
            Log::error('Realtor property creation error: '.$e->getMessage(), [
                'user_id' => $request->user()->id,
                'error' => $e->getTraceAsString(),
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create property. Please check your input and try again.');
        }
    }

    public function update(UpdatePropertyDataRequest $request, Property $property)
    {
        $validated = $request->validated();

        $property->fill($validated);
        $property->featured = $request->has('featured');

        if ($request->hasFile('brochure')) {
            $brochurePath = $request->file('brochure')->store('uploads/brochures', 'public');
            $property->brochure = basename($brochurePath);
        }

        $property->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = uniqid().'_'.time().'.jpg';
                $optimizedImage = $this->optimizeImage($image, 1200, 900, 85);
                Storage::disk('public')->put('uploads/properties/'.$filename, $optimizedImage);
                $thumbnailImage = $this->createThumbnail($image, 300, 300, 80);
                Storage::disk('public')->put('uploads/properties/thumbnails/'.$filename, $thumbnailImage);
                $property->images()->create(['image_path' => $filename]);
            }
        }

        return redirect()->route('realtor.properties.edit', $property)->with('success', 'Property updated successfully!');
    }

    public function create()
    {
        $this->authorize('create', Property::class);

        $estates = \App\Models\Estate::all();
        $propertyApi = [
            'storeData' => route('realtor.properties.store-data'),
            'storeImagesBase' => url('/realtor/properties/store-images'),
            'index' => route('realtor.properties.index'),
            'formAction' => route('realtor.properties.store'),
        ];

        return view('admin.properties.create', compact('estates', 'propertyApi'));
    }

    public function storeData(StorePropertyDataRequest $request)
    {
        try {
            $validated = $request->validated();

            $property = new Property($validated);
            $property->user_id = $request->user()->id;
            $property->slug = Str::slug($request->title).'-'.uniqid();
            $property->featured = $request->has('featured');

            if ($request->hasFile('brochure')) {
                $brochurePath = $request->file('brochure')->store('uploads/brochures', 'public');
                $property->brochure = basename($brochurePath);
            }

            $property->save();

            return response()->json([
                'success' => true,
                'property_id' => $property->id,
                'message' => 'Property data saved successfully!',
            ]);
        } catch (\Exception $e) {
            Log::error('Realtor property data creation error: '.$e->getMessage(), [
                'user_id' => $request->user()->id,
                'error' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to save property data: '.$e->getMessage(),
            ], 500);
        }
    }

    public function storeImages(StorePropertyImageRequest $request, Property $property)
    {
        try {
            $image = $request->file('image');
            $filename = uniqid().'_'.time().'.jpg';

            $optimizedImage = $this->optimizeImage($image, 1200, 900, 85);
            Storage::disk('public')->put('uploads/properties/'.$filename, $optimizedImage);

            $thumbnailImage = $this->createThumbnail($image, 300, 300, 80);
            Storage::disk('public')->put('uploads/properties/thumbnails/'.$filename, $thumbnailImage);

            $property->images()->create(['image_path' => $filename]);

            return response()->json([
                'success' => true,
                'message' => 'Image uploaded successfully',
                'filename' => $filename,
            ]);
        } catch (\Exception $e) {
            Log::error('Realtor image upload error: '.$e->getMessage(), [
                'property_id' => $property->id,
                'error' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to upload image: '.$e->getMessage(),
            ], 500);
        }
    }

    public function edit(Property $property)
    {
        $this->authorize('update', $property);

        $property->load('images');
        $estates = \App\Models\Estate::all();
        $propertyApi = [
            'updateData' => route('realtor.properties.update-data', $property),
            'storeImagesBase' => url('/realtor/properties/store-images'),
            'deleteImageBase' => url('/realtor/properties/image'),
            'index' => route('realtor.properties.index'),
            'formAction' => route('realtor.properties.update', $property),
        ];

        return view('admin.properties.edit', compact('property', 'estates', 'propertyApi'));
    }

    public function updateData(UpdatePropertyDataRequest $request, Property $property)
    {
        try {
            $validated = $request->validated();

            $property->fill($validated);
            $property->featured = $request->has('featured');

            if ($request->hasFile('brochure')) {
                if ($property->brochure) {
                    Storage::disk('public')->delete('uploads/brochures/'.$property->brochure);
                }
                $brochurePath = $request->file('brochure')->store('uploads/brochures', 'public');
                $property->brochure = basename($brochurePath);
            }

            $property->save();

            return response()->json([
                'success' => true,
                'property_id' => $property->id,
                'message' => 'Property data updated successfully!',
            ]);
        } catch (\Exception $e) {
            Log::error('Realtor property data update error: '.$e->getMessage(), [
                'property_id' => $property->id,
                'error' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update property data: '.$e->getMessage(),
            ], 500);
        }
    }

    public function destroy(Property $property)
    {
        $this->authorize('delete', $property);

        try {
            foreach ($property->images as $propertyImage) {
                Storage::disk('public')->delete('uploads/properties/'.$propertyImage->image_path);
                Storage::disk('public')->delete('uploads/properties/thumbnails/'.$propertyImage->image_path);
                $propertyImage->delete();
            }

            if ($property->brochure) {
                Storage::disk('public')->delete('uploads/brochures/'.$property->brochure);
            }

            $property->delete();

            return redirect()->route('realtor.properties.index')
                ->with('success', 'Property deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Realtor property deletion error: '.$e->getMessage(), [
                'property_id' => $property->id,
                'error' => $e->getTraceAsString(),
            ]);

            return redirect()->back()
                ->with('error', 'Failed to delete property. Please try again.');
        }
    }

    public function deleteImage(PropertyImage $image)
    {
        $property = $image->property;
        $this->authorize('deleteImage', $property);

        Storage::disk('public')->delete('uploads/properties/'.$image->image_path);
        Storage::disk('public')->delete('uploads/properties/thumbnails/'.$image->image_path);
        $image->delete();

        return redirect()->route('realtor.properties.edit', $property)->with('success', 'Image deleted successfully!');
    }
}
