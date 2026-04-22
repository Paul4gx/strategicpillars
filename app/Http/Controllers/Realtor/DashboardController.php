<?php

namespace App\Http\Controllers\Realtor;

use App\Http\Controllers\Controller;
use App\Models\Property;

class DashboardController extends Controller
{
    public function index()
    {
        $propertyCount = Property::query()->where('user_id', auth()->id())->count();

        return view('realtor.dashboard', compact('propertyCount'));
    }
}
