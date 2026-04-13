@extends('layouts.admin')
@section('title', 'Upload Laporan Keuangan')
@section('page-title', 'Upload Laporan')
@section('breadcrumb', 'Keuangan / Upload')

@push('styles')
<style>
    .form-card { background:#fff; border-radius:18px; border:1px solid #eef2ee; box-shadow:0 2px 12px rgba(0,0,0,.04); padding:2rem; max-width:700px; }
    .form-group { margin-bottom:1.5rem; }
    .form-label { display:block; font-size:.85rem; font-weight:700; color:#374151; margin-bottom:.5rem; }
    .form-input { width:100%; padding:.75rem 1rem; border:1.5px solid #e5e7eb; border-radius:12px; font-size:.9rem; font-family:inherit; color:#374151; transition:border-color .2s; outline:none; background:#fafafa; }
    .form-input:focus { border-color:#1a4731; background:#fff; box-shadow:0 0 0 3px rgba(26,71,49,.08); }
    textarea.form-input { resize:vertical; min-height:100px; }
    .btn-primary { background:linear-gradient(135deg,#1a4731,#2d6a4f); color:#fff; padding:.75rem 1.75rem; border-radius:12px; font-size:.9rem; font-weight:700; border:none; cursor:pointer; font-family:inherit; transition:all .2s; display:inline-flex; align-items:center; gap:.5rem; }
    .btn-primary:hover { transform:translateY(-2px); box-shadow:0 6px 20px rgba(26,71,49,.3); }
    .btn-back { color:#6b7280; text-decoration:none; font-size:.88rem; font-weight:600; display:inline-flex; align-items:center; gap:.4rem; margin-bottom:1.5rem; }
    .btn-back:hover { color:#1a4731; }
    .error-msg { font-size:.78rem; color:#dc2626; margin-top:.3rem; }
    .form-hint { font-size:.78rem; color:#9ca3af; margin-top:.3rem; }
    .upload-box { border:2px dashed #d1fae5; border-radius:14px; padding:2rem; text-align:center; background:#f8fdf9; transition:all .2s; cursor:pointer; }
    .upload-box:hover { border-color:#1a4731; background:#f0faf5; }
</style>
@endpush

@section('content')
<a href="{{ route('admin.keuangan.index') }}" class="btn-back">← Kembali ke Laporan Keuangan</a>

<div class="form-card">
    <h2 style="font-size:1.25rem;font-weight:800;color:#0d2318;margin-bottom:1.75rem">⬆️ Upload Laporan Keuangan</h2>

    <form method="POST" action="{{ route('admin.keuangan.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="form-label">Judul Laporan <span style="color:#dc2626">*</span></label>
            <input type="text" name="judul" class="form-input" value="{{ old('judul') }}" placeholder="Contoh: Laporan Keuangan Bulanan Januari 2026" required>
            @error('judul')<div class="error-msg">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Periode <span style="color:#dc2626">*</span></label>
            <input type="text" name="periode" class="form-input" value="{{ old('periode') }}" placeholder="Contoh: Januari 2026 / Q1 2026" required>
            @error('periode')<div class="error-msg">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-input" placeholder="Keterangan singkat tentang laporan ini...">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')<div class="error-msg">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">File Laporan <span style="color:#dc2626">*</span></label>
            <label class="upload-box" for="fileInput">
                <div style="font-size:2.5rem;margin-bottom:.75rem">📁</div>
                <div style="font-weight:700;color:#1a4731;margin-bottom:.35rem">Klik untuk pilih file</div>
                <div style="font-size:.82rem;color:#9ca3af" id="fileName">atau seret file ke sini</div>
            </label>
            <input type="file" name="file" id="fileInput" class="form-input" accept=".pdf,.xlsx,.xls,.csv" required style="display:none" onchange="showFileName(this)">
            <div class="form-hint">📄 Format: PDF, Excel (xlsx, xls), atau CSV. Maks 10MB</div>
            @error('file')<div class="error-msg">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn-primary">⬆️ Upload Laporan</button>
    </form>
</div>

@push('scripts')
<script>
function showFileName(input){
    const el = document.getElementById('fileName');
    if(input.files && input.files[0]){
        el.textContent = '✅ ' + input.files[0].name;
        el.style.color = '#1a4731';
        el.style.fontWeight = '600';
    }
}
</script>
@endpush
@endsection
