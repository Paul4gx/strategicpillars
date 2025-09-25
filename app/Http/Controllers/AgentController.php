<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamMember;

class AgentController extends Controller
{
    public function index()
    {
        $agents = TeamMember::orderBy('sort_order')->get();
        return view('agents', compact('agents'));
    }
} 