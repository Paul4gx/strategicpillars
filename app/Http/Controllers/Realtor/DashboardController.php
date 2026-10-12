<?php

namespace App\Http\Controllers\Realtor;

use App\Http\Controllers\Controller;
use App\Models\Estate;
use App\Models\Property;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $totalProperties = Property::query()->where('user_id', $userId)->count();
        $totalBookings = 0;
        $totalEstates = Estate::count();
        $totalTeamMembers = 0;
        $recentBookings = collect();
        $recentProperties = Property::query()
            ->where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard.index', [
            'portal' => 'realtor',
            'totalProperties' => $totalProperties,
            'totalBookings' => $totalBookings,
            'totalEstates' => $totalEstates,
            'totalTeamMembers' => $totalTeamMembers,
            'recentBookings' => $recentBookings,
            'recentProperties' => $recentProperties,
        ]);
    }
}
