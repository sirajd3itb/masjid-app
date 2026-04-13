@extends('layouts.admin')
@section('title', 'Data Donasi')
@section('page-title', 'Data Donasi')
@section('breadcrumb', 'Donasi')

@push('styles')
<style>
    .page-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:1.5rem; flex-wrap:wrap; gap:1rem; }
    .btn-primary { background:linear-gradient(135deg,#1a4731,#2d6a4f); color:#fff; padding:.65rem 1.4rem; border-radius:12px; font-size:.88rem; font-weight:700; text-decoration:none; transition:all .2s; display:inline-flex; align-items:center; gap:.5rem; border:none; cursor:pointer; font-family:inherit; }
    .btn-primary:hover { transform:translateY(-2px); box-shadow:0 6px 20px rgba(26,71,49,.3); }
    .btn-danger { background:#fee2e2; color:#dc2626; padding:.45rem .9rem; border-radius:8px; font-size:.8rem; font-weight:700; border:1px solid #fca5a5; cursor:pointer; font-family:inherit; transition:all .2s; }
    .btn-danger:hover { background:#dc2626; color:#fff; }
    .total-card { background:linear-gradient(135deg,#1a4731,#2d6a4f); color:#fff; border-radius:18px; padding:1.75rem 2rem; margin-bottom:1.5rem; display:flex; align-items:center; justify-content:space-between; }
    .total-amount { font-size:2rem; font-weight:800; }
    .total-label { font-size:.85rem; color:rgba(255,255,255,.7); margin-top:.25rem; }
    .card { background:#fff; border-radius:18px; border:1px solid #eef2ee; box-shadow:0 2px 12px rgba(0,0,0,.04); overflow:hidden; }
    .table { width:100%; border-collapse:collapse; font-size:.875rem; }
    .table th { background:#f8faf9; color:#9ca3af; font-size:.72rem; letter-spacing:1px; text-transform:uppercase; padding:1rem 1.5rem; text-align:left; font-weight:700; }
    .table td { padding:1rem 1.5rem; border-bottom:1px solid #f0f4f0; color:#374151; }
    .table tr:last-child td { border-bottom:none; }
    .table tr:hover td { background:#fafcfa; }
    .badge { padding:.3rem .8rem; border-radius:50px; font-size:.75rem; font-weight:700; }
    .badge-gold { background:#fef9c3; color:#92400e; }
    .badge-metode { background:#dbeafe; color:#1d4ed8; }
    .empty-state { padding:4rem 2rem; text-align:center; color:#9ca3af; }
</style>
@endpush

@section('content')
<div class="page-header">
    <div>
        <h2 style="font-size:1.4rem;font-weight:800;color:#0d2318">Data Donasi</h2>
        <p style="font-size:.85rem;color:#9ca3af;margin-top:.2rem">Daftar seluruh donasi yang masuk ke Masjid Al-Ikhlas</p>
    </div>
    <a href="{{ route('admin.donations.create') }}" class="btn-primary">➕ Tambah Donasi</a>
</div>

<div class="total-card">
    <div>
        <div class="total-label">💰 Total Donasi Keseluruhan</div>
        <div class="total-amount">Rp {{ number_format($totalDonasi, 0, ',', '.') }}</div>
    </div>
    <div style="font-size:3rem;opacity:.3">💚</div>
</div>

<div class="card">
    @if($donations->isEmpty())
        <div class="empty-state">
            <div style="font-size:3.5rem;opacity:.4;margin-bottom:1rem">💚</div>
            <p style="font-weight:600;color:#6b7280">Belum ada data donasi</p>
        </div>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Donatur</th>
                    <th>Nominal</th>
                    <th>Metode</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($donations as $i => $d)
                <tr>
                    <td style="color:#9ca3af">{{ $i + 1 }}</td>
                    <td style="font-weight:700;color:#0d2318">{{ $d->nama_donatur }}</td>
                    <td><span class="badge badge-gold">Rp {{ number_format($d->nominal, 0, ',', '.') }}</span></td>
                    <td><span class="badge badge-metode">{{ $d->metode }}</span></td>
                    <td style="color:#6b7280;font-size:.85rem">{{ $d->tanggal->format('d M Y') }}</td>
                    <td style="color:#6b7280;font-size:.85rem">{{ $d->keterangan ?? '-' }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.donations.destroy', $d) }}" onsubmit="return confirm('Hapus data donasi ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-danger">🗑️ Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
