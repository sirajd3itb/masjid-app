@extends('layouts.admin')
@section('title', 'Tambah Donasi')
@section('page-title', 'Tambah Donasi')
@section('breadcrumb', 'Donasi / Tambah')

@push('styles')
<style>
    .form-card { background:#fff; border-radius:18px; border:1px solid #eef2ee; box-shadow:0 2px 12px rgba(0,0,0,.04); padding:2rem; max-width:700px; }
    .form-group { margin-bottom:1.5rem; }
    .form-label { display:block; font-size:.85rem; font-weight:700; color:#374151; margin-bottom:.5rem; }
    .form-input { width:100%; padding:.75rem 1rem; border:1.5px solid #e5e7eb; border-radius:12px; font-size:.9rem; font-family:inherit; color:#374151; transition:border-color .2s; outline:none; background:#fafafa; }
    .form-input:focus { border-color:#1a4731; background:#fff; box-shadow:0 0 0 3px rgba(26,71,49,.08); }
    textarea.form-input { resize:vertical; min-height:100px; }
    .form-row { display:grid; grid-template-columns:1fr 1fr; gap:1.5rem; }
    .btn-primary { background:linear-gradient(135deg,#1a4731,#2d6a4f); color:#fff; padding:.75rem 1.75rem; border-radius:12px; font-size:.9rem; font-weight:700; border:none; cursor:pointer; font-family:inherit; transition:all .2s; display:inline-flex; align-items:center; gap:.5rem; }
    .btn-primary:hover { transform:translateY(-2px); box-shadow:0 6px 20px rgba(26,71,49,.3); }
    .btn-back { color:#6b7280; text-decoration:none; font-size:.88rem; font-weight:600; display:inline-flex; align-items:center; gap:.4rem; margin-bottom:1.5rem; }
    .btn-back:hover { color:#1a4731; }
    .error-msg { font-size:.78rem; color:#dc2626; margin-top:.3rem; }
</style>
@endpush

@section('content')
<a href="{{ route('admin.donations.index') }}" class="btn-back">← Kembali ke Data Donasi</a>

<div class="form-card">
    <h2 style="font-size:1.25rem;font-weight:800;color:#0d2318;margin-bottom:1.75rem">➕ Input Data Donasi</h2>

    <form method="POST" action="{{ route('admin.donations.store') }}">
        @csrf
        <div class="form-group">
            <label class="form-label">Nama Donatur <span style="color:#dc2626">*</span></label>
            <input type="text" name="nama_donatur" class="form-input" value="{{ old('nama_donatur') }}" placeholder="Nama donatur / Hamba Allah" required>
            @error('nama_donatur')<div class="error-msg">{{ $message }}</div>@enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Nominal (Rp) <span style="color:#dc2626">*</span></label>
                <input type="number" name="nominal" class="form-input" value="{{ old('nominal') }}" placeholder="50000" min="1" required>
                @error('nominal')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Metode Transfer <span style="color:#dc2626">*</span></label>
                <select name="metode" class="form-input" required>
                    <option value="">-- Pilih Metode --</option>
                    <option value="BCA" {{ old('metode')=='BCA'?'selected':'' }}>Transfer Bank BCA</option>
                    <option value="BNI" {{ old('metode')=='BNI'?'selected':'' }}>Transfer Bank BNI</option>
                    <option value="BRI" {{ old('metode')=='BRI'?'selected':'' }}>Transfer Bank BRI</option>
                    <option value="Mandiri" {{ old('metode')=='Mandiri'?'selected':'' }}>Transfer Mandiri</option>
                    <option value="DANA" {{ old('metode')=='DANA'?'selected':'' }}>DANA</option>
                    <option value="OVO" {{ old('metode')=='OVO'?'selected':'' }}>OVO</option>
                    <option value="GoPay" {{ old('metode')=='GoPay'?'selected':'' }}>GoPay</option>
                    <option value="Cash" {{ old('metode')=='Cash'?'selected':'' }}>Tunai / Cash</option>
                    <option value="Lainnya" {{ old('metode')=='Lainnya'?'selected':'' }}>Lainnya</option>
                </select>
                @error('metode')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Tanggal <span style="color:#dc2626">*</span></label>
            <input type="date" name="tanggal" class="form-input" value="{{ old('tanggal', date('Y-m-d')) }}" required>
            @error('tanggal')<div class="error-msg">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-input" placeholder="Catatan tambahan...">{{ old('keterangan') }}</textarea>
            @error('keterangan')<div class="error-msg">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn-primary">💾 Simpan Data Donasi</button>
    </form>
</div>
@endsection
