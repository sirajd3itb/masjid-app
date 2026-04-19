@extends('layouts.admin')
@section('title', 'Tambah Event')
@section('page-title', 'Tambah Event')
@section('breadcrumb', 'Event / Tambah')

@push('styles')
<style>
    .form-wrapper { max-width: 800px; }
    .btn-back {
        display: inline-flex; align-items: center; gap: .4rem;
        color: #6b7280; text-decoration: none; font-size: .88rem;
        font-weight: 600; margin-bottom: 1.5rem; transition: color .2s;
    }
    .btn-back:hover { color: #1a4731; }

    .form-card {
        background: #fff; border-radius: 20px; border: 1px solid #eef2ee;
        box-shadow: 0 2px 16px rgba(0,0,0,.05); overflow: hidden;
    }
    .form-card-header {
        padding: 1.5rem 2rem; border-bottom: 1px solid #f0f4f0;
        background: linear-gradient(135deg, #f8faf9, #fff);
        display: flex; align-items: center; gap: .75rem;
    }
    .form-card-icon {
        width: 44px; height: 44px; background: linear-gradient(135deg,#1a4731,#2d6a4f);
        border-radius: 12px; display: flex; align-items: center;
        justify-content: center; font-size: 1.2rem;
    }
    .form-card-body { padding: 2rem; }

    .form-group { margin-bottom: 1.4rem; }
    .form-label {
        display: block; font-size: .83rem; font-weight: 700;
        color: #374151; margin-bottom: .5rem; letter-spacing: .01em;
    }
    .form-label .required { color: #dc2626; margin-left: 2px; }
    .form-input {
        width: 100%; padding: .75rem 1rem; border: 1.5px solid #e5e7eb;
        border-radius: 12px; font-size: .9rem; font-family: inherit;
        color: #374151; background: #fafafa; outline: none;
        transition: border-color .2s, box-shadow .2s; box-sizing: border-box;
    }
    .form-input:focus {
        border-color: #1a4731; background: #fff;
        box-shadow: 0 0 0 3px rgba(26,71,49,.08);
    }
    textarea.form-input { resize: vertical; min-height: 130px; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }
    .form-hint { font-size: .78rem; color: #9ca3af; margin-top: .35rem; }
    .error-msg { font-size: .78rem; color: #dc2626; margin-top: .35rem; font-weight: 600; }

    /* File upload area */
    .upload-area {
        border: 2px dashed #d1fae5; border-radius: 14px; padding: 1.5rem;
        text-align: center; cursor: pointer; transition: all .2s;
        background: #f0fdf4; position: relative;
    }
    .upload-area:hover { border-color: #1a4731; background: #ecfdf5; }
    .upload-area input[type=file] {
        position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%;
    }
    .upload-icon { font-size: 2rem; margin-bottom: .5rem; }
    .upload-text { font-size: .85rem; color: #374151; font-weight: 600; }
    .upload-hint { font-size: .78rem; color: #9ca3af; margin-top: .25rem; }

    /* Preview */
    .img-preview-wrap {
        margin-top: 1rem; display: none; position: relative; width: fit-content;
    }
    .img-preview-wrap img {
        width: 200px; height: 140px; object-fit: cover; border-radius: 12px;
        border: 2px solid #d1fae5; display: block;
    }
    .img-preview-remove {
        position: absolute; top: -8px; right: -8px; width: 24px; height: 24px;
        background: #dc2626; border-radius: 50%; border: none; cursor: pointer;
        color: #fff; font-size: .75rem; display: flex; align-items: center;
        justify-content: center; font-weight: 700; transition: background .2s;
    }
    .img-preview-remove:hover { background: #b91c1c; }

    /* Action bar */
    .form-actions {
        display: flex; align-items: center; gap: 1rem;
        padding-top: 1.5rem; border-top: 1px solid #f0f4f0; margin-top: .5rem;
    }
    .btn-submit {
        background: linear-gradient(135deg, #1a4731, #2d6a4f);
        color: #fff; padding: .8rem 2rem; border-radius: 12px;
        font-size: .9rem; font-weight: 700; border: none; cursor: pointer;
        font-family: inherit; transition: all .2s;
        display: inline-flex; align-items: center; gap: .5rem;
    }
    .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(26,71,49,.3); }
    .btn-reset {
        color: #6b7280; font-size: .875rem; font-weight: 600; background: none;
        border: 1.5px solid #e5e7eb; padding: .75rem 1.25rem; border-radius: 12px;
        cursor: pointer; font-family: inherit; transition: all .2s;
    }
    .btn-reset:hover { border-color: #9ca3af; color: #374151; }

    @media(max-width:640px) {
        .form-row { grid-template-columns: 1fr; }
        .form-card-body { padding: 1.25rem; }
    }
</style>
@endpush

@section('content')
<div class="form-wrapper">
    <a href="{{ route('admin.events.index') }}" class="btn-back">
        ← Kembali ke Daftar Event
    </a>

    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-icon">➕</div>
            <div>
                <div style="font-size:1.05rem;font-weight:800;color:#0d2318">Tambah Event Baru</div>
                <div style="font-size:.8rem;color:#9ca3af">Isi detail kegiatan yang akan ditampilkan di website</div>
            </div>
        </div>

        <div class="form-card-body">
            <form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data" id="eventForm">
                @csrf

                {{-- Judul --}}
                <div class="form-group">
                    <label class="form-label">Judul Event <span class="required">*</span></label>
                    <input
                        type="text" name="judul" class="form-input"
                        value="{{ old('judul') }}"
                        placeholder="Contoh: Pengajian Rutin Malam Jumat"
                        required
                    >
                    @error('judul')<div class="error-msg">⚠ {{ $message }}</div>@enderror
                </div>

                {{-- Deskripsi --}}
                <div class="form-group">
                    <label class="form-label">Deskripsi <span class="required">*</span></label>
                    <textarea
                        name="deskripsi" class="form-input"
                        placeholder="Jelaskan detail kegiatan, pembicara, target peserta, dll."
                        required
                    >{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')<div class="error-msg">⚠ {{ $message }}</div>@enderror
                </div>

                {{-- Tanggal & Lokasi --}}
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Tanggal <span class="required">*</span></label>
                        <input
                            type="date" name="tanggal" class="form-input"
                            value="{{ old('tanggal') }}" required
                        >
                        @error('tanggal')<div class="error-msg">⚠ {{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Lokasi</label>
                        <input
                            type="text" name="lokasi" class="form-input"
                            value="{{ old('lokasi') }}"
                            placeholder="Contoh: Aula Utama Masjid"
                        >
                        @error('lokasi')<div class="error-msg">⚠ {{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Gambar --}}
                <div class="form-group">
                    <label class="form-label">Gambar Event</label>
                    <div class="upload-area" id="uploadArea">
                        <input
                            type="file" name="gambar" id="gambarInput"
                            accept="image/jpeg,image/png,image/webp"
                            onchange="previewImg(this)"
                        >
                        <div class="upload-icon">🖼️</div>
                        <div class="upload-text">Klik atau seret gambar ke sini</div>
                        <div class="upload-hint">JPG, PNG, WEBP — Maks. 2 MB</div>
                    </div>
                    <div class="img-preview-wrap" id="previewWrap">
                        <img id="imgPreview" src="" alt="preview">
                        <button type="button" class="img-preview-remove" onclick="removePreview()" title="Hapus gambar">✕</button>
                    </div>
                    @error('gambar')<div class="error-msg">⚠ {{ $message }}</div>@enderror
                </div>

                {{-- Actions --}}
                <div class="form-actions">
                    <button type="submit" class="btn-submit">💾 Simpan Event</button>
                    <button type="reset" class="btn-reset" onclick="removePreview()">Bersihkan Form</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewImg(input) {
    const wrap = document.getElementById('previewWrap');
    const img  = document.getElementById('imgPreview');
    const area = document.getElementById('uploadArea');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            img.src = e.target.result;
            wrap.style.display = 'block';
            area.style.borderStyle = 'solid';
            area.style.borderColor = '#1a4731';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function removePreview() {
    const wrap  = document.getElementById('previewWrap');
    const img   = document.getElementById('imgPreview');
    const input = document.getElementById('gambarInput');
    const area  = document.getElementById('uploadArea');

    img.src = '';
    wrap.style.display = 'none';
    input.value = '';
    area.style.borderStyle = 'dashed';
    area.style.borderColor = '#d1fae5';
}
</script>
@endpush
