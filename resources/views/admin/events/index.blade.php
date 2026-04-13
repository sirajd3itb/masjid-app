@extends('layouts.admin')
@section('title', 'Kelola Event')
@section('page-title', 'Kelola Event')
@section('breadcrumb', 'Event')

@push('styles')
<style>
    .page-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:1.5rem; }
    .btn-primary { background:linear-gradient(135deg,#1a4731,#2d6a4f); color:#fff; padding:.65rem 1.4rem; border-radius:12px; font-size:.88rem; font-weight:700; text-decoration:none; transition:all .2s; display:inline-flex; align-items:center; gap:.5rem; border:none; cursor:pointer; font-family:inherit; }
    .btn-primary:hover { transform:translateY(-2px); box-shadow:0 6px 20px rgba(26,71,49,.3); }
    .btn-danger { background:#fee2e2; color:#dc2626; padding:.5rem 1rem; border-radius:8px; font-size:.82rem; font-weight:700; border:1px solid #fca5a5; cursor:pointer; font-family:inherit; transition:all .2s; }
    .btn-danger:hover { background:#dc2626; color:#fff; }
    .btn-edit { background:#dbeafe; color:#1d4ed8; padding:.5rem 1rem; border-radius:8px; font-size:.82rem; font-weight:700; border:1px solid #93c5fd; text-decoration:none; transition:all .2s; display:inline-block; }
    .btn-edit:hover { background:#1d4ed8; color:#fff; }
    .card { background:#fff; border-radius:18px; border:1px solid #eef2ee; box-shadow:0 2px 12px rgba(0,0,0,.04); overflow:hidden; }
    .table { width:100%; border-collapse:collapse; font-size:.875rem; }
    .table th { background:#f8faf9; color:#9ca3af; font-size:.72rem; letter-spacing:1px; text-transform:uppercase; padding:1rem 1.5rem; text-align:left; font-weight:700; }
    .table td { padding:1rem 1.5rem; border-bottom:1px solid #f0f4f0; color:#374151; vertical-align:middle; }
    .table tr:last-child td { border-bottom:none; }
    .table tr:hover td { background:#fafcfa; }
    .event-thumb { width:60px; height:45px; border-radius:8px; object-fit:cover; }
    .event-thumb-placeholder { width:60px; height:45px; border-radius:8px; background:linear-gradient(135deg,#1a4731,#52b788); display:flex; align-items:center; justify-content:center; font-size:1.25rem; }
    .badge-date { background:#d1fae5; color:#065f46; padding:.3rem .75rem; border-radius:50px; font-size:.75rem; font-weight:700; white-space:nowrap; }
    .empty-state { padding:4rem 2rem; text-align:center; color:#9ca3af; }
    .empty-icon { font-size:3.5rem; margin-bottom:1rem; opacity:.5; }
</style>
@endpush

@section('content')
<div class="page-header">
    <div>
        <h2 style="font-size:1.4rem;font-weight:800;color:#0d2318">Event Masjid</h2>
        <p style="font-size:.85rem;color:#9ca3af;margin-top:.2rem">Kelola kegiatan dan acara yang ditampilkan di website</p>
    </div>
    <a href="{{ route('admin.events.create') }}" class="btn-primary">➕ Tambah Event</a>
</div>

<div class="card">
    @if($events->isEmpty())
        <div class="empty-state">
            <div class="empty-icon">📅</div>
            <p style="font-weight:600;color:#6b7280">Belum ada event. Tambah event pertama!</p>
        </div>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Lokasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr>
                    <td>
                        @if($event->gambar)
                            <img src="{{ Storage::url($event->gambar) }}" class="event-thumb" alt="gambar">
                        @else
                            <div class="event-thumb-placeholder">📅</div>
                        @endif
                    </td>
                    <td>
                        <div style="font-weight:700;color:#0d2318">{{ $event->judul }}</div>
                        <div style="font-size:.8rem;color:#9ca3af;margin-top:.25rem">{{ Str::limit($event->deskripsi, 60) }}</div>
                    </td>
                    <td><span class="badge-date">{{ $event->tanggal->format('d M Y') }}</span></td>
                    <td style="color:#6b7280;font-size:.85rem">{{ $event->lokasi ?? '-' }}</td>
                    <td>
                        <div style="display:flex;gap:.5rem;align-items:center">
                            <a href="{{ route('admin.events.edit', $event) }}" class="btn-edit">✏️ Edit</a>
                            <form method="POST" action="{{ route('admin.events.destroy', $event) }}" onsubmit="return confirm('Hapus event ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-danger">🗑️ Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
