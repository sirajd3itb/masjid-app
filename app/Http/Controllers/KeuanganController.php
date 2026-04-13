<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KeuanganController extends Controller
{
    public function index()
    {
        $keuangan = Keuangan::latest()->get();
        return view('admin.keuangan.index', compact('keuangan'));
    }

    public function create()
    {
        return view('admin.keuangan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'periode'   => 'required|string|max:100',
            'file'      => 'required|file|mimes:pdf,xlsx,xls,csv|max:10240',
        ]);

        $file = $request->file('file');
        $path = $file->store('keuangan', 'public');

        Keuangan::create([
            'judul'     => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'periode'   => $validated['periode'],
            'file_path' => $path,
            'file_name' => $file->getClientOriginalName(),
        ]);

        return redirect()->route('admin.keuangan.index')
            ->with('success', 'Laporan keuangan berhasil diunggah!');
    }

    public function destroy(Keuangan $keuangan)
    {
        Storage::disk('public')->delete($keuangan->file_path);
        $keuangan->delete();

        return redirect()->route('admin.keuangan.index')
            ->with('success', 'Laporan keuangan berhasil dihapus!');
    }
}
