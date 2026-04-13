<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Event;
use App\Models\Keuangan;

class AdminController extends Controller
{
    public function index()
    {
        $totalEvents     = Event::count();
        $totalDonations  = Donation::count();
        $totalDonasi     = Donation::sum('nominal');
        $totalKeuangan   = Keuangan::count();
        $recentEvents    = Event::latest()->take(5)->get();
        $recentDonations = Donation::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalEvents', 'totalDonations', 'totalDonasi',
            'totalKeuangan', 'recentEvents', 'recentDonations'
        ));
    }
}
