<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Estate;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::with('images');
        
        // Keyword search
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('short_description', 'like', "%{$keyword}%")
                  ->orWhere('long_description', 'like', "%{$keyword}%")
                  ->orWhere('address', 'like', "%{$keyword}%")
                  ->orWhere('city', 'like', "%{$keyword}%");
            });
        }
        
        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Property type filter
        if ($request->filled('type')) {
            $query->where('property_type', $request->type);
        }
        
        // Estate filter
        if ($request->filled('estate')) {
            $query->where('estate_id', $request->estate);
        }
        
        // City filter
        if ($request->filled('city')) {
            $query->where('city', 'like', "%{$request->city}%");
        }
        
        // Bedrooms filter
        if ($request->filled('bedrooms')) {
            $query->where('bedrooms', '>=', $request->bedrooms);
        }
        
        // Bathrooms filter
        if ($request->filled('bathrooms')) {
            $query->where('bathrooms', '>=', $request->bathrooms);
        }
        
        // Area filters
        if ($request->filled('min_area')) {
            $query->where('area', '>=', $request->min_area);
        }
        if ($request->filled('max_area')) {
            $query->where('area', '<=', $request->max_area);
        }
        
        // Price filters
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
        
        // Amenities filter
        if ($request->filled('amenities')) {
            $amenities = is_array($request->amenities) ? $request->amenities : [$request->amenities];
            $query->where(function($q) use ($amenities) {
                foreach ($amenities as $amenity) {
                    $q->orWhereJsonContains('property_features', $amenity);
                }
            });
        }
        
        $properties = $query->latest()->paginate(12);
        $estates = Estate::all();
        
        // Get unique cities for filter dropdown
        $cities = Property::select('city')->whereNotNull('city')->distinct()->pluck('city');
        
        // Get unique property types for filter dropdown
        $propertyTypes = Property::select('property_type')->distinct()->pluck('property_type');
        
        return view('properties.index', compact('properties', 'estates', 'cities', 'propertyTypes'));
    }

    public function show($slug)
    {
        $property = Property::where('slug', $slug)->with(['images', 'estate'])->firstOrFail();
        
        // Get similar properties (same property type, excluding current property, limit to 4)
        $similarProperties = Property::with('images')
            ->where('property_type', $property->property_type)
            ->where('id', '!=', $property->id)
            ->where('status', '!=', 'sold')
            ->where('status', '!=', 'rented')
            ->latest()
            ->take(4)
            ->get();
            
        return view('properties.show', compact('property', 'similarProperties'));
    }
        public function home()
    {

        $featuredProperties = Property::with('images')->where('featured', true)->latest()->take(6)->get();
        // dd($featuredProperties);
        $featuredEstates = Estate::latest()->take(3)->get();
        $featuredShortlets = []; // Shortlet::where('featured', true)->latest()->take(3)->get();
        $interiorShowcase = []; // Interior::latest()->take(4)->get();

        return view('properties.home', compact('featuredProperties', 'featuredEstates', 'featuredShortlets', 'interiorShowcase'));
    }
} 