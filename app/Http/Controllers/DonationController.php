<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index()
    {
        $donations  = Donation::latest()->get();
        $totalDonasi = Donation::sum('nominal');
        return view('admin.donations.index', compact('donations', 'totalDonasi'));
    }

    public function create()
    {
        return view('admin.donations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_donatur' => 'required|string|max:255',
            'nominal'      => 'required|integer|min:1',
            'metode'       => 'required|string|max:100',
            'keterangan'   => 'nullable|string',
            'tanggal'      => 'required|date',
        ]);

        Donation::create($validated);

        return redirect()->route('admin.donations.index')
            ->with('success', 'Data donasi berhasil ditambahkan!');
    }

    public function destroy(Donation $donation)
    {
        $donation->delete();
        return redirect()->route('admin.donations.index')
            ->with('success', 'Data donasi berhasil dihapus!');
    }
}
