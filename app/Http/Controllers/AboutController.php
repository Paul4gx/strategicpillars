<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Interior; // Uncomment if you have an Interior model

class AboutController extends Controller
{
    public function index()
    {
        $interiorPortfolio = []; // Interior::latest()->take(6)->get();
        return view('company.about', compact('interiorPortfolio'));
    }
} 