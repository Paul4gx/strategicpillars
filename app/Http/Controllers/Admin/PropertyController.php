<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Log;

class PropertyController extends Controller
{
    /**
     * Image manager instance
     */
    protected $imageManager;

    public function __construct()
    {
        $this->imageManager = new ImageManager(new Driver());
    }

    /**
     * Optimize and resize image
     */
    protected function optimizeImage($imageFile, $maxWidth = 1200, $maxHeight = 900, $quality = 85)
    {
        try {
            // Increase memory limit temporarily for image processing
            $originalMemoryLimit = ini_get('memory_limit');
            ini_set('memory_limit', '512M');
            
            $image = $this->imageManager->read($imageFile);
            
            // Resize image while maintaining aspect ratio
            $image->scaleDown($maxWidth, $maxHeight);
            
            // Optimize quality and encode to string
            $result = $image->toJpeg($quality)->toString();
            
            // Restore original memory limit
            ini_set('memory_limit', $originalMemoryLimit);
            
            return $result;
        } catch (\Exception $e) {
            // Restore original memory limit in case of error
            ini_set('memory_limit', $originalMemoryLimit ?? '128M');
            throw $e;
        }
    }

    /**
     * Create thumbnail
     */
    protected function createThumbnail($imageFile, $width = 300, $height = 300, $quality = 80)
    {
        try {
            // Increase memory limit temporarily for image processing
            $originalMemoryLimit = ini_get('memory_limit');
            ini_set('memory_limit', '512M');
            
            $image = $this->imageManager->read($imageFile);
            
            // Resize and crop to exact dimensions for thumbnail
            $image->cover($width, $height);
            
            // Optimize quality and encode to string
            $result = $image->toJpeg($quality)->toString();
            
            // Restore original memory limit
            ini_set('memory_limit', $originalMemoryLimit);
            
            return $result;
        } catch (\Exception $e) {
            // Restore original memory limit in case of error
            ini_set('memory_limit', $originalMemoryLimit ?? '128M');
            throw $e;
        }
    }

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
     * Store property data only (Step 1 of two-step process)
     */
    public function storeData(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'short_description' => 'nullable|string|max:255',
                'long_description' => 'nullable|string',
                'status' => 'required|in:available,sold,rented,off-plan,upcoming',
                'price' => 'required|numeric',
                'currency' => 'required|in:NGN,USD',
                'discount_price' => 'nullable|numeric',
                'property_type' => 'required|string|in:' . implode(',', array_keys(config('property_types.flat_list'))),
                'bedrooms' => 'nullable|integer',
                'bathrooms' => 'nullable|integer',
                'parking_spaces' => 'nullable|integer',
                'address' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255',
                'state' => 'nullable|string|max:255',
                'estate_id' => 'nullable|exists:estates,id',
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

            return response()->json([
                'success' => true,
                'property_id' => $property->id,
                'message' => 'Property data saved successfully!'
            ]);

        } catch (\Exception $e) {
            Log::error('Property data creation error: ' . $e->getMessage(), [
                'request_data' => $request->except(['brochure']),
                'error' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to save property data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store images for existing property (Step 2 of two-step process)
     */
    public function storeImages(Request $request, $propertyId)
    {
        try {
            $property = \App\Models\Property::findOrFail($propertyId);
            
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240' // 10MB max - matches existing system
            ]);

            $image = $request->file('image');
            $filename = uniqid() . '_' . time() . '.jpg';
            
            // Optimize image with same settings as existing system
            $optimizedImage = $this->optimizeImage($image, 1200, 900, 85);
            $mainImagePath = 'uploads/properties/' . $filename;
            Storage::disk('public')->put($mainImagePath, $optimizedImage);
            
            // Create thumbnail with same settings as existing system
            $thumbnailImage = $this->createThumbnail($image, 300, 300, 80);
            $thumbnailPath = 'uploads/properties/thumbnails/' . $filename;
            Storage::disk('public')->put($thumbnailPath, $thumbnailImage);
            
            $property->images()->create(['image_path' => $filename]);

            return response()->json([
                'success' => true,
                'message' => 'Image uploaded successfully',
                'filename' => $filename
            ]);

        } catch (\Exception $e) {
            Log::error('Image upload error: ' . $e->getMessage(), [
                'property_id' => $propertyId,
                'error' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload image: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage (Legacy method - kept for compatibility)
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'short_description' => 'nullable|string|max:255',
                'long_description' => 'nullable|string',
                'status' => 'required|in:available,sold,rented,off-plan,upcoming',
                'price' => 'required|numeric',
                'currency' => 'required|in:NGN,USD',
                'discount_price' => 'nullable|numeric',
                'property_type' => 'required|string|in:' . implode(',', array_keys(config('property_types.flat_list'))),
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

            // Handle images upload with optimization - wrapped in try-catch for better error handling
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    try {
                        // Generate unique filename
                        $filename = uniqid() . '_' . time() . '.jpg';
                        
                        // Optimize main image with error handling
                        $optimizedImage = $this->optimizeImage($image, 1200, 900, 85);
                        $mainImagePath = 'uploads/properties/' . $filename;
                        Storage::disk('public')->put($mainImagePath, $optimizedImage);
                        
                        // Create thumbnail with error handling
                        $thumbnailImage = $this->createThumbnail($image, 300, 300, 80);
                        $thumbnailPath = 'uploads/properties/thumbnails/' . $filename;
                        Storage::disk('public')->put($thumbnailPath, $thumbnailImage);
                        
                        $property->images()->create([
                            'image_path' => $filename
                        ]);
                    } catch (\Exception $imageError) {
                        Log::error('Image processing error: ' . $imageError->getMessage(), [
                            'property_id' => $property->id,
                            'filename' => $image->getClientOriginalName(),
                            'error' => $imageError->getTraceAsString()
                        ]);
                        
                        // Continue with other images even if one fails
                        continue;
                    }
                }
            }

            return redirect()->route('admin.properties.index')->with('success', 'Property created successfully!');
            
        } catch (\Exception $e) {
            Log::error('Property creation error: ' . $e->getMessage(), [
                'request_data' => $request->except(['images', 'brochure']),
                'error' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create property. Please check your input and try again.');
        }
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
     * Update property data only (Step 1 of two-step edit process)
     */
    public function updateData(Request $request, $id)
    {
        try {
            $property = \App\Models\Property::findOrFail($id);
            
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'short_description' => 'nullable|string|max:255',
                'long_description' => 'nullable|string',
                'status' => 'required|in:available,sold,rented,off-plan,upcoming',
                'price' => 'required|numeric',
                'currency' => 'required|in:NGN,USD',
                'discount_price' => 'nullable|numeric',
                'property_type' => 'required|string|in:' . implode(',', array_keys(config('property_types.flat_list'))),
                'bedrooms' => 'nullable|integer',
                'bathrooms' => 'nullable|integer',
                'parking_spaces' => 'nullable|integer',
                'address' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255',
                'state' => 'nullable|string|max:255',
                'estate_id' => 'nullable|exists:estates,id',
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

            // Update property data
            $property->fill($validated);
            $property->featured = $request->has('featured');

            // Handle brochure upload
            if ($request->hasFile('brochure')) {
                // Delete old brochure if exists
                if ($property->brochure) {
                    Storage::disk('public')->delete('uploads/brochures/' . $property->brochure);
                }
                $brochurePath = $request->file('brochure')->store('uploads/brochures', 'public');
                $property->brochure = basename($brochurePath);
            }

            $property->save();

            return response()->json([
                'success' => true,
                'property_id' => $property->id,
                'message' => 'Property data updated successfully!'
            ]);

        } catch (\Exception $e) {
            Log::error('Property data update error: ' . $e->getMessage(), [
                'property_id' => $id,
                'request_data' => $request->except(['brochure']),
                'error' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to update property data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage (Legacy method - kept for compatibility)
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
            'currency' => 'required|in:NGN,USD',
            'discount_price' => 'nullable|numeric',
            'property_type' => 'required|string|in:' . implode(',', array_keys(config('property_types.flat_list'))),
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

        // Handle new images upload with optimization
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Generate unique filename
                $filename = uniqid() . '_' . time() . '.jpg';
                
                // Optimize main image
                $optimizedImage = $this->optimizeImage($image, 1200, 900, 85);
                $mainImagePath = 'uploads/properties/' . $filename;
                Storage::disk('public')->put($mainImagePath, $optimizedImage);
                
                // Create thumbnail
                $thumbnailImage = $this->createThumbnail($image, 300, 300, 80);
                $thumbnailPath = 'uploads/properties/thumbnails/' . $filename;
                Storage::disk('public')->put($thumbnailPath, $thumbnailImage);
                
                $property->images()->create([
                    'image_path' => $filename
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
        try {
            // Delete all associated images and their files
            foreach ($property->images as $image) {
                // Delete the main image and thumbnail from storage
                Storage::disk('public')->delete('uploads/properties/' . $image->image_path);
                Storage::disk('public')->delete('uploads/properties/thumbnails/' . $image->image_path);
                
                // Delete the image record
                $image->delete();
            }
            
            // Delete brochure if it exists
            if ($property->brochure) {
                Storage::disk('public')->delete('uploads/brochures/' . $property->brochure);
            }
            
            // Delete the property
            $property->delete();
            
            return redirect()->route('admin.properties.index')
                ->with('success', 'Property deleted successfully!');
                
        } catch (\Exception $e) {
            Log::error('Property deletion error: ' . $e->getMessage(), [
                'property_id' => $property->id,
                'error' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->with('error', 'Failed to delete property. Please try again.');
        }
    }

    public function deleteImage($id)
    {
        $image = \App\Models\PropertyImage::findOrFail($id);
        $property = $image->property;
        
        // Delete the main image and thumbnail from storage
        Storage::disk('public')->delete('uploads/properties/' . $image->image_path);
        Storage::disk('public')->delete('uploads/properties/thumbnails/' . $image->image_path);
        
        $image->delete();
        return redirect()->route('admin.properties.edit', $property)->with('success', 'Image deleted successfully!');
    }
}
