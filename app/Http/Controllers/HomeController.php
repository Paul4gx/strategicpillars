<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Estate;
use App\Models\TeamMember;
// use App\Models\Shortlet; // Uncomment if you have a Shortlet model
// use App\Models\Interior; // Uncomment if you have an Interior model

class HomeController extends Controller
{
    public function index()
    {

        $featuredProperties = Property::with('images')->where('featured', true)->latest()->take(6)->get();
        // dd($featuredProperties);
        $featuredEstates = Estate::latest()->take(3)->get();
        $featuredShortlets = []; // Shortlet::where('featured', true)->latest()->take(3)->get();
        $interiorShowcase = []; // Interior::latest()->take(4)->get();
        $agents = TeamMember::latest()->get();

        return view('home', compact('featuredProperties', 'featuredEstates', 'featuredShortlets', 'interiorShowcase', 'agents'));
    }
} 