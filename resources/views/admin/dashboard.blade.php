@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@push('styles')
<style>
    .stats-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:1.5rem; margin-bottom:2rem; }
    .stat-box { background:#fff; border-radius:18px; padding:1.75rem; border:1px solid #eef2ee; box-shadow:0 2px 12px rgba(0,0,0,.04); position:relative; overflow:hidden; transition:transform .2s; }
    .stat-box:hover { transform:translateY(-3px); }
    .stat-box::before { content:''; position:absolute; top:0; left:0; right:0; height:4px; border-radius:18px 18px 0 0; }
    .stat-box.green::before { background:linear-gradient(to right,#1a4731,#52b788); }
    .stat-box.gold::before { background:linear-gradient(to right,#c9a227,#e8c547); }
    .stat-box.blue::before { background:linear-gradient(to right,#3b82f6,#60a5fa); }
    .stat-box.purple::before { background:linear-gradient(to right,#7c3aed,#a78bfa); }
    .stat-icon { width:48px; height:48px; border-radius:14px; display:flex; align-items:center; justify-content:center; font-size:1.5rem; margin-bottom:1rem; }
    .stat-icon.green { background:#d1fae5; }
    .stat-icon.gold { background:#fef9c3; }
    .stat-icon.blue { background:#dbeafe; }
    .stat-icon.purple { background:#ede9fe; }
    .stat-val { font-size:2rem; font-weight:800; color:#0d2318; line-height:1; margin-bottom:.4rem; }
    .stat-lbl { font-size:.82rem; color:#9ca3af; font-weight:500; }

    .grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:1.5rem; }
    .card { background:#fff; border-radius:18px; border:1px solid #eef2ee; box-shadow:0 2px 12px rgba(0,0,0,.04); overflow:hidden; }
    .card-header { padding:1.25rem 1.75rem; border-bottom:1px solid #f0f4f0; display:flex; align-items:center; justify-content:space-between; }
    .card-title { font-size:.95rem; font-weight:700; color:#0d2318; }
    .card-link { font-size:.8rem; color:#1a4731; font-weight:600; text-decoration:none; }
    .card-link:hover { color:#c9a227; }
    .table { width:100%; border-collapse:collapse; font-size:.85rem; }
    .table th { background:#f8faf9; color:#9ca3af; font-size:.72rem; letter-spacing:1px; text-transform:uppercase; padding:.85rem 1.25rem; text-align:left; font-weight:700; }
    .table td { padding:.85rem 1.25rem; border-bottom:1px solid #f0f4f0; color:#374151; }
    .table tr:last-child td { border-bottom:none; }
    .badge { display:inline-block; padding:.25rem .75rem; border-radius:50px; font-size:.73rem; font-weight:700; }
    .badge-green { background:#d1fae5; color:#065f46; }
    .badge-gold { background:#fef9c3; color:#92400e; }
    @media(max-width:1024px){ .stats-grid{grid-template-columns:repeat(2,1fr);} .grid-2{grid-template-columns:1fr;} }
    @media(max-width:600px){ .stats-grid{grid-template-columns:1fr 1fr;} }
</style>
@endpush

@section('content')

{{-- Greeting --}}
<div style="margin-bottom:2rem">
    <h1 style="font-size:1.6rem;font-weight:800;color:#0d2318">Selamat Datang, {{ auth()->user()->name }}! 👋</h1>
    <p style="color:#9ca3af;font-size:.9rem;margin-top:.3rem">{{ now()->translatedFormat('l, d F Y') }} — Semoga hari ini penuh berkah.</p>
</div>

{{-- Stats --}}
<div class="stats-grid">
    <div class="stat-box green">
        <div class="stat-icon green">📅</div>
        <div class="stat-val">{{ $totalEvents }}</div>
        <div class="stat-lbl">Total Event</div>
    </div>
    <div class="stat-box gold">
        <div class="stat-icon gold">💚</div>
        <div class="stat-val">{{ $totalDonations }}</div>
        <div class="stat-lbl">Data Donasi</div>
    </div>
    <div class="stat-box blue">
        <div class="stat-icon blue">💰</div>
        <div class="stat-val">Rp {{ number_format($totalDonasi, 0, ',', '.') }}</div>
        <div class="stat-lbl">Total Donasi</div>
    </div>
    <div class="stat-box purple">
        <div class="stat-icon purple">📁</div>
        <div class="stat-val">{{ $totalKeuangan }}</div>
        <div class="stat-lbl">Laporan Keuangan</div>
    </div>
</div>

{{-- Tables --}}
<div class="grid-2">
    {{-- Recent Events --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">📅 Event Terbaru</span>
            <a href="{{ route('admin.events.index') }}" class="card-link">Lihat Semua →</a>
        </div>
        @if($recentEvents->isEmpty())
            <div style="padding:2rem;text-align:center;color:#9ca3af;font-size:.9rem">Belum ada event</div>
        @else
            <table class="table">
                <thead><tr><th>Judul</th><th>Tanggal</th></tr></thead>
                <tbody>
                    @foreach($recentEvents as $e)
                    <tr>
                        <td style="font-weight:600;color:#0d2318">{{ Str::limit($e->judul, 35) }}</td>
                        <td><span class="badge badge-green">{{ $e->tanggal->format('d M Y') }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    {{-- Recent Donations --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">💚 Donasi Terbaru</span>
            <a href="{{ route('admin.donations.index') }}" class="card-link">Lihat Semua →</a>
        </div>
        @if($recentDonations->isEmpty())
            <div style="padding:2rem;text-align:center;color:#9ca3af;font-size:.9rem">Belum ada data donasi</div>
        @else
            <table class="table">
                <thead><tr><th>Nama</th><th>Nominal</th></tr></thead>
                <tbody>
                    @foreach($recentDonations as $d)
                    <tr>
                        <td style="font-weight:600;color:#0d2318">{{ $d->nama_donatur }}</td>
                        <td><span class="badge badge-gold">Rp {{ number_format($d->nominal, 0, ',', '.') }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

@endsection
