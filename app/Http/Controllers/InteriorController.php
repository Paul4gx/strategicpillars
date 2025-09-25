<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Interior; // Uncomment if you have an Interior model

class InteriorController extends Controller
{
    public function index(Request $request)
    {
        $interiors = []; // Interior::latest()->paginate(12);
        return view('interiors.index', compact('interiors'));
    }

    public function show($slug)
    {
        $interior = null; // Interior::where('slug', $slug)->firstOrFail();
        return view('interiors.show', compact('interior'));
    }
} 