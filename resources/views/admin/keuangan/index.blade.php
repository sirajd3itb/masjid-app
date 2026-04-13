@extends('layouts.admin')
@section('title', 'Laporan Keuangan')
@section('page-title', 'Laporan Keuangan')
@section('breadcrumb', 'Keuangan')

@push('styles')
<style>
    .page-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:1.5rem; flex-wrap:wrap; gap:1rem; }
    .btn-primary { background:linear-gradient(135deg,#1a4731,#2d6a4f); color:#fff; padding:.65rem 1.4rem; border-radius:12px; font-size:.88rem; font-weight:700; text-decoration:none; transition:all .2s; display:inline-flex; align-items:center; gap:.5rem; border:none; cursor:pointer; font-family:inherit; }
    .btn-primary:hover { transform:translateY(-2px); box-shadow:0 6px 20px rgba(26,71,49,.3); }
    .btn-danger { background:#fee2e2; color:#dc2626; padding:.45rem .9rem; border-radius:8px; font-size:.8rem; font-weight:700; border:1px solid #fca5a5; cursor:pointer; font-family:inherit; transition:all .2s; }
    .btn-danger:hover { background:#dc2626; color:#fff; }
    .btn-download { background:#dbeafe; color:#1d4ed8; padding:.45rem .9rem; border-radius:8px; font-size:.8rem; font-weight:700; border:1px solid #93c5fd; text-decoration:none; transition:all .2s; display:inline-block; }
    .btn-download:hover { background:#1d4ed8; color:#fff; }
    .files-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(300px,1fr)); gap:1.5rem; }
    .file-card { background:#fff; border-radius:18px; border:1px solid #eef2ee; box-shadow:0 2px 12px rgba(0,0,0,.04); padding:1.75rem; transition:all .25s; }
    .file-card:hover { transform:translateY(-3px); box-shadow:0 8px 30px rgba(0,0,0,.1); }
    .file-icon { width:56px; height:56px; border-radius:14px; display:flex; align-items:center; justify-content:center; font-size:1.75rem; margin-bottom:1.25rem; }
    .file-icon.pdf { background:#fee2e2; }
    .file-icon.excel { background:#d1fae5; }
    .file-icon.other { background:#dbeafe; }
    .file-title { font-size:1rem; font-weight:700; color:#0d2318; margin-bottom:.4rem; }
    .file-meta { font-size:.78rem; color:#9ca3af; margin-bottom:.25rem; }
    .file-desc { font-size:.85rem; color:#6b7280; margin:1rem 0; line-height:1.6; }
    .file-actions { display:flex; gap:.75rem; align-items:center; margin-top:1rem; }
    .badge-periode { background:#fef9c3; color:#92400e; padding:.3rem .75rem; border-radius:50px; font-size:.75rem; font-weight:700; display:inline-block; margin-bottom:.75rem; }
    .empty-state { background:#fff; border-radius:18px; border:1px solid #eef2ee; padding:5rem 2rem; text-align:center; color:#9ca3af; }
</style>
@endpush

@section('content')
<div class="page-header">
    <div>
        <h2 style="font-size:1.4rem;font-weight:800;color:#0d2318">Laporan Keuangan</h2>
        <p style="font-size:.85rem;color:#9ca3af;margin-top:.2rem">Upload dan kelola dokumen laporan keuangan masjid</p>
    </div>
    <a href="{{ route('admin.keuangan.create') }}" class="btn-primary">⬆️ Upload Laporan</a>
</div>

@if($keuangan->isEmpty())
    <div class="empty-state">
        <div style="font-size:3.5rem;opacity:.4;margin-bottom:1rem">📁</div>
        <p style="font-weight:600;color:#6b7280">Belum ada laporan keuangan</p>
        <p style="font-size:.88rem;margin-top:.5rem">Upload laporan keuangan pertama untuk transparansi jamaah</p>
    </div>
@else
    <div class="files-grid">
        @foreach($keuangan as $k)
        @php
            $ext = strtolower(pathinfo($k->file_name, PATHINFO_EXTENSION));
            $iconClass = $ext === 'pdf' ? 'pdf' : ($ext === 'xlsx' || $ext === 'xls' ? 'excel' : 'other');
            $icon = $ext === 'pdf' ? '📄' : ($ext === 'xlsx' || $ext === 'xls' ? '📊' : '📁');
        @endphp
        <div class="file-card">
            <div class="file-icon {{ $iconClass }}">{{ $icon }}</div>
            <div class="badge-periode">📅 {{ $k->periode }}</div>
            <div class="file-title">{{ $k->judul }}</div>
            <div class="file-meta">📎 {{ $k->file_name }}</div>
            <div class="file-meta">🕒 Diunggah {{ $k->created_at->diffForHumans() }}</div>
            @if($k->deskripsi)
                <div class="file-desc">{{ $k->deskripsi }}</div>
            @endif
            <div class="file-actions">
                <a href="{{ Storage::url($k->file_path) }}" target="_blank" class="btn-download">⬇️ Download</a>
                <form method="POST" action="{{ route('admin.keuangan.destroy', $k) }}" onsubmit="return confirm('Hapus laporan ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-danger">🗑️ Hapus</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
@endif
@endsection
