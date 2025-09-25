<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estate;
use App\Models\Property;

class EstateController extends Controller
{
    public function index()
    {
        $estates = Estate::latest()->paginate(12);
        return view('estates.index', compact('estates'));
    }

    public function show($slug)
    {
        $estate = Estate::where('slug', $slug)->with('images')->firstOrFail();
        $properties = Property::where('estate_id', $estate->id)->latest()->get();
        return view('estates.show', compact('estate', 'properties'));
    }
} 