<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Booking;
use App\Models\Estate;
use App\Models\TeamMember;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProperties = Property::count();
        $totalBookings = Booking::count();
        $totalEstates = Estate::count();
        $totalTeamMembers = TeamMember::count();
        $recentBookings = Booking::latest()->take(5)->get();
        $recentProperties = Property::latest()->take(5)->get();

        return view('admin.dashboard.index', compact(
            'totalProperties',
            'totalBookings',
            'totalEstates',
            'totalTeamMembers',
            'recentBookings',
            'recentProperties'
        ));
    }
}
