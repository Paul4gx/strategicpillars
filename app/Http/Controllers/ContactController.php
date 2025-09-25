<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('company.contact');
    }

    public function send(Request $request)
    {
        // Validate and send message (stub)
        // You can implement mail or DB save here
        return back()->with('success', 'Message sent!');
    }
} 