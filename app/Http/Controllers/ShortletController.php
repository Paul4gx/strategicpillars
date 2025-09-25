<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class ShortletController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::with('images')->where('property_type', 'Shortlet');
        
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
        
        // Price filters (using price as nightly rate)
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
        
        $shortlets = $query->latest()->paginate(12);
        
        // Get unique cities for filter dropdown
        $cities = Property::select('city')->where('property_type', 'Shortlet')->whereNotNull('city')->distinct()->pluck('city');
        
        return view('shortlets.index', compact('shortlets', 'cities'));
    }

    public function show($slug)
    {
        $shortlet = Property::where('slug', $slug)->where('property_type', 'Shortlet')->with(['images', 'estate'])->firstOrFail();
        
        // Get similar shortlets (same property type, excluding current shortlet, limit to 4)
        $similarShortlets = Property::with('images')
            ->where('property_type', 'Shortlet')
            ->where('id', '!=', $shortlet->id)
            ->where('status', '!=', 'sold')
            ->where('status', '!=', 'rented')
            ->latest()
            ->take(4)
            ->get();
            
        return view('shortlets.show', compact('shortlet', 'similarShortlets'));
    }
} 