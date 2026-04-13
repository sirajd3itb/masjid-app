@extends('layouts.admin')
@section('title', 'Tambah Event')
@section('page-title', 'Tambah Event')
@section('breadcrumb', 'Event / Tambah')

@push('styles')
<style>
    .form-card { background:#fff; border-radius:18px; border:1px solid #eef2ee; box-shadow:0 2px 12px rgba(0,0,0,.04); padding:2rem; max-width:760px; }
    .form-group { margin-bottom:1.5rem; }
    .form-label { display:block; font-size:.85rem; font-weight:700; color:#374151; margin-bottom:.5rem; }
    .form-input { width:100%; padding:.75rem 1rem; border:1.5px solid #e5e7eb; border-radius:12px; font-size:.9rem; font-family:inherit; color:#374151; transition:border-color .2s; outline:none; background:#fafafa; }
    .form-input:focus { border-color:#1a4731; background:#fff; box-shadow:0 0 0 3px rgba(26,71,49,.08); }
    textarea.form-input { resize:vertical; min-height:130px; }
    .form-row { display:grid; grid-template-columns:1fr 1fr; gap:1.5rem; }
    .btn-primary { background:linear-gradient(135deg,#1a4731,#2d6a4f); color:#fff; padding:.75rem 1.75rem; border-radius:12px; font-size:.9rem; font-weight:700; border:none; cursor:pointer; font-family:inherit; transition:all .2s; display:inline-flex; align-items:center; gap:.5rem; }
    .btn-primary:hover { transform:translateY(-2px); box-shadow:0 6px 20px rgba(26,71,49,.3); }
    .btn-back { color:#6b7280; text-decoration:none; font-size:.88rem; font-weight:600; display:inline-flex; align-items:center; gap:.4rem; margin-bottom:1.5rem; }
    .btn-back:hover { color:#1a4731; }
    .img-preview { width:120px; height:90px; object-fit:cover; border-radius:10px; margin-top:.75rem; display:none; border:2px solid #d1fae5; }
    .form-hint { font-size:.78rem; color:#9ca3af; margin-top:.3rem; }
    .error-msg { font-size:.78rem; color:#dc2626; margin-top:.3rem; }
</style>
@endpush

@section('content')
<a href="{{ route('admin.events.index') }}" class="btn-back">← Kembali ke Daftar Event</a>

<div class="form-card">
    <h2 style="font-size:1.25rem;font-weight:800;color:#0d2318;margin-bottom:1.75rem">➕ Tambah Event Baru</h2>

    <form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="form-label">Judul Event <span style="color:#dc2626">*</span></label>
            <input type="text" name="judul" class="form-input" value="{{ old('judul') }}" placeholder="Contoh: Pengajian Rutin Malam Jumat" required>
            @error('judul')<div class="error-msg">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Deskripsi <span style="color:#dc2626">*</span></label>
            <textarea name="deskripsi" class="form-input" placeholder="Jelaskan detail kegiatan...">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')<div class="error-msg">{{ $message }}</div>@enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Tanggal <span style="color:#dc2626">*</span></label>
                <input type="date" name="tanggal" class="form-input" value="{{ old('tanggal') }}" required>
                @error('tanggal')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Lokasi</label>
                <input type="text" name="lokasi" class="form-input" value="{{ old('lokasi') }}" placeholder="Contoh: Aula Utama Masjid">
                @error('lokasi')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Gambar Event</label>
            <input type="file" name="gambar" class="form-input" accept="image/*" onchange="previewImg(this)">
            <div class="form-hint">Format: JPG, PNG, WEBP. Maks 2MB</div>
            <img id="imgPreview" class="img-preview" src="" alt="preview">
            @error('gambar')<div class="error-msg">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn-primary">💾 Simpan Event</button>
    </form>
</div>

@push('scripts')
<script>
function previewImg(input){
    const img = document.getElementById('imgPreview');
    if(input.files && input.files[0]){
        const reader = new FileReader();
        reader.onload = e => { img.src = e.target.result; img.style.display='block'; };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
@endsection
