@extends('layouts.admin')
@section('title', 'Kelola Event')
@section('page-title', 'Kelola Event')
@section('breadcrumb', 'Event')

@push('styles')
<style>
    /* ── Header ── */
    .page-header {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;
    }
    .btn-primary {
        background: linear-gradient(135deg, #1a4731, #2d6a4f);
        color: #fff; padding: .7rem 1.4rem; border-radius: 12px;
        font-size: .88rem; font-weight: 700; text-decoration: none;
        transition: all .2s; display: inline-flex; align-items: center;
        gap: .5rem; border: none; cursor: pointer; font-family: inherit;
    }
    .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(26,71,49,.3); }

    /* ── Search bar ── */
    .search-wrap {
        display: flex; gap: .75rem; margin-bottom: 1.5rem; flex-wrap: wrap; align-items: center;
    }
    .search-input {
        padding: .6rem 1rem .6rem 2.5rem; border: 1.5px solid #e5e7eb; border-radius: 10px;
        font-size: .875rem; font-family: inherit; color: #374151; outline: none;
        background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%239ca3af' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.099zm-5.242 1.656a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11z'/%3E%3C/svg%3E") no-repeat .75rem center;
        width: 280px; transition: border-color .2s;
    }
    .search-input:focus { border-color: #1a4731; box-shadow: 0 0 0 3px rgba(26,71,49,.08); }
    .filter-select {
        padding: .6rem 1rem; border: 1.5px solid #e5e7eb; border-radius: 10px;
        font-size: .875rem; font-family: inherit; color: #374151; outline: none;
        background: #fff; cursor: pointer; transition: border-color .2s;
    }
    .filter-select:focus { border-color: #1a4731; }
    .count-badge {
        font-size: .82rem; color: #9ca3af; font-weight: 500;
        margin-left: auto; white-space: nowrap;
    }

    /* ── Card Grid ── */
    .events-grid {
        display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 1.25rem;
    }
    .event-card {
        background: #fff; border-radius: 18px; border: 1px solid #eef2ee;
        box-shadow: 0 2px 12px rgba(0,0,0,.04); overflow: hidden;
        transition: transform .2s, box-shadow .2s; display: flex; flex-direction: column;
    }
    .event-card:hover { transform: translateY(-4px); box-shadow: 0 8px 30px rgba(0,0,0,.1); }

    .event-card-img {
        width: 100%; height: 180px; object-fit: cover; display: block;
    }
    .event-card-img-placeholder {
        width: 100%; height: 180px;
        background: linear-gradient(135deg, #0d2318 0%, #1a4731 50%, #2d6a4f 100%);
        display: flex; align-items: center; justify-content: center;
        font-size: 3.5rem;
    }

    .event-card-body { padding: 1.25rem; flex: 1; display: flex; flex-direction: column; }

    .event-card-meta {
        display: flex; align-items: center; gap: .5rem; margin-bottom: .75rem; flex-wrap: wrap;
    }
    .badge-status {
        display: inline-flex; align-items: center; gap: .3rem;
        padding: .3rem .75rem; border-radius: 50px; font-size: .73rem; font-weight: 700;
    }
    .badge-upcoming { background: #d1fae5; color: #065f46; }
    .badge-past     { background: #f3f4f6; color: #6b7280; }
    .badge-today    { background: #fef3c7; color: #92400e; }

    .badge-date {
        display: inline-flex; align-items: center; gap: .3rem;
        font-size: .75rem; color: #6b7280; font-weight: 500;
    }

    .event-card-title {
        font-size: 1rem; font-weight: 800; color: #0d2318;
        margin-bottom: .4rem; line-height: 1.4;
    }
    .event-card-desc {
        font-size: .83rem; color: #9ca3af; line-height: 1.5; flex: 1;
        margin-bottom: .75rem;
    }
    .event-card-lokasi {
        font-size: .8rem; color: #6b7280; margin-bottom: 1rem;
        display: flex; align-items: center; gap: .35rem;
    }

    .event-card-actions {
        display: flex; gap: .5rem; border-top: 1px solid #f0f4f0;
        padding-top: 1rem; margin-top: auto;
    }
    .btn-edit {
        flex: 1; background: #dbeafe; color: #1d4ed8; padding: .55rem 1rem;
        border-radius: 10px; font-size: .82rem; font-weight: 700;
        border: 1px solid #93c5fd; text-decoration: none;
        transition: all .2s; display: inline-flex; align-items: center;
        justify-content: center; gap: .4rem;
    }
    .btn-edit:hover { background: #1d4ed8; color: #fff; border-color: #1d4ed8; }
    .btn-danger {
        flex: 1; background: #fee2e2; color: #dc2626; padding: .55rem 1rem;
        border-radius: 10px; font-size: .82rem; font-weight: 700;
        border: 1px solid #fca5a5; cursor: pointer; font-family: inherit;
        transition: all .2s; display: inline-flex; align-items: center;
        justify-content: center; gap: .4rem;
    }
    .btn-danger:hover { background: #dc2626; color: #fff; border-color: #dc2626; }

    /* ── Empty state ── */
    .empty-state {
        background: #fff; border-radius: 18px; border: 1px solid #eef2ee;
        padding: 5rem 2rem; text-align: center; color: #9ca3af;
    }

    /* ── Delete Modal ── */
    .modal-overlay {
        position: fixed; inset: 0; background: rgba(0,0,0,.5);
        backdrop-filter: blur(4px); display: none; align-items: center;
        justify-content: center; z-index: 1000; padding: 1rem;
    }
    .modal-overlay.active { display: flex; }
    .modal-box {
        background: #fff; border-radius: 24px; padding: 2rem;
        max-width: 420px; width: 100%; text-align: center;
        animation: modalIn .25s ease;
        box-shadow: 0 20px 60px rgba(0,0,0,.2);
    }
    @keyframes modalIn {
        from { opacity: 0; transform: scale(.9) translateY(10px); }
        to   { opacity: 1; transform: scale(1) translateY(0); }
    }
    .modal-icon {
        width: 64px; height: 64px; background: #fee2e2; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.75rem; margin: 0 auto 1.25rem;
    }
    .modal-title { font-size: 1.15rem; font-weight: 800; color: #0d2318; margin-bottom: .5rem; }
    .modal-desc  { font-size: .88rem; color: #6b7280; margin-bottom: 1.5rem; line-height: 1.5; }
    .modal-event-name {
        background: #f8faf9; border-radius: 10px; padding: .6rem 1rem;
        font-size: .88rem; font-weight: 700; color: #0d2318; margin-bottom: 1.5rem;
    }
    .modal-actions { display: flex; gap: .75rem; }
    .btn-cancel {
        flex: 1; padding: .7rem; border-radius: 12px; background: #f3f4f6;
        color: #374151; font-size: .9rem; font-weight: 700; border: none;
        cursor: pointer; font-family: inherit; transition: background .2s;
    }
    .btn-cancel:hover { background: #e5e7eb; }
    .btn-confirm-del {
        flex: 1; padding: .7rem; border-radius: 12px;
        background: linear-gradient(135deg, #dc2626, #b91c1c);
        color: #fff; font-size: .9rem; font-weight: 700; border: none;
        cursor: pointer; font-family: inherit; transition: all .2s;
    }
    .btn-confirm-del:hover { box-shadow: 0 4px 14px rgba(220,38,38,.4); }

    /* ── No-search-result ── */
    .no-result { display: none; padding: 3rem 1rem; text-align: center; color: #9ca3af; }

    @media(max-width:640px) {
        .events-grid { grid-template-columns: 1fr; }
        .search-input { width: 100%; }
    }
</style>
@endpush

@section('content')

{{-- Header --}}
<div class="page-header">
    <div>
        <h2 style="font-size:1.4rem;font-weight:800;color:#0d2318">📅 Kelola Event</h2>
        <p style="font-size:.85rem;color:#9ca3af;margin-top:.2rem">
            Kelola kegiatan dan acara yang ditampilkan di website publik
        </p>
    </div>
    <a href="{{ route('admin.events.create') }}" class="btn-primary">➕ Tambah Event</a>
</div>

{{-- Search & Filter --}}
<div class="search-wrap">
    <input
        type="text"
        id="searchInput"
        class="search-input"
        placeholder="Cari judul atau lokasi event..."
        oninput="filterEvents()"
    >
    <select id="statusFilter" class="filter-select" onchange="filterEvents()">
        <option value="all">Semua Status</option>
        <option value="upcoming">Akan Datang</option>
        <option value="today">Hari Ini</option>
        <option value="past">Sudah Lewat</option>
    </select>
    <span class="count-badge" id="countBadge">
        {{ $events->count() }} event
    </span>
</div>

@if($events->isEmpty())
    <div class="empty-state">
        <div style="font-size:4rem;margin-bottom:1rem;opacity:.4">📅</div>
        <p style="font-weight:700;font-size:1.05rem;color:#374151;margin-bottom:.4rem">Belum ada event</p>
        <p style="font-size:.875rem;margin-bottom:1.5rem">Tambahkan event pertama untuk ditampilkan di website!</p>
        <a href="{{ route('admin.events.create') }}" class="btn-primary" style="display:inline-flex">➕ Tambah Event Sekarang</a>
    </div>
@else

    {{-- Card Grid --}}
    <div class="events-grid" id="eventsGrid">
        @foreach($events as $event)
        @php
            $today    = now()->toDateString();
            $eventDay = $event->tanggal->toDateString();
            if ($eventDay === $today) {
                $statusClass = 'badge-today';
                $statusLabel = '🌟 Hari Ini';
                $statusKey   = 'today';
            } elseif ($eventDay > $today) {
                $statusClass = 'badge-upcoming';
                $statusLabel = '🕒 Akan Datang';
                $statusKey   = 'upcoming';
            } else {
                $statusClass = 'badge-past';
                $statusLabel = '✓ Selesai';
                $statusKey   = 'past';
            }
        @endphp

        <div class="event-card"
             data-title="{{ strtolower($event->judul) }}"
             data-lokasi="{{ strtolower($event->lokasi ?? '') }}"
             data-status="{{ $statusKey }}">

            {{-- Gambar --}}
            @if($event->gambar)
                <img src="{{ Storage::url($event->gambar) }}" class="event-card-img" alt="{{ $event->judul }}">
            @else
                <div class="event-card-img-placeholder">📅</div>
            @endif

            <div class="event-card-body">
                {{-- Meta --}}
                <div class="event-card-meta">
                    <span class="badge-status {{ $statusClass }}">{{ $statusLabel }}</span>
                    <span class="badge-date">📆 {{ $event->tanggal->format('d M Y') }}</span>
                </div>

                {{-- Judul & Deskripsi --}}
                <div class="event-card-title">{{ $event->judul }}</div>
                <div class="event-card-desc">{{ Str::limit($event->deskripsi, 90) }}</div>

                {{-- Lokasi --}}
                @if($event->lokasi)
                <div class="event-card-lokasi">
                    📍 {{ $event->lokasi }}
                </div>
                @endif

                {{-- Aksi --}}
                <div class="event-card-actions">
                    <a href="{{ route('admin.events.edit', $event) }}" class="btn-edit">✏️ Edit</a>
                    <button
                        type="button"
                        class="btn-danger"
                        onclick="openDeleteModal({{ $event->id }}, '{{ addslashes($event->judul) }}')"
                    >🗑️ Hapus</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="no-result" id="noResult">
        <div style="font-size:3rem;margin-bottom:.75rem">🔍</div>
        <p style="font-weight:700;color:#374151">Event tidak ditemukan</p>
        <p style="font-size:.875rem">Coba kata kunci lain</p>
    </div>

@endif

{{-- Delete Modal --}}
<div class="modal-overlay" id="deleteModal">
    <div class="modal-box">
        <div class="modal-icon">🗑️</div>
        <div class="modal-title">Hapus Event?</div>
        <div class="modal-desc">Tindakan ini tidak dapat dibatalkan. Event berikut akan dihapus secara permanen.</div>
        <div class="modal-event-name" id="modalEventName">—</div>
        <div class="modal-actions">
            <button type="button" class="btn-cancel" onclick="closeDeleteModal()">Batal</button>
            <button type="button" class="btn-confirm-del" id="confirmDeleteBtn">Ya, Hapus!</button>
        </div>
    </div>
</div>

{{-- Hidden delete forms --}}
@foreach($events as $event)
<form id="deleteForm{{ $event->id }}"
      method="POST"
      action="{{ route('admin.events.destroy', $event) }}"
      style="display:none">
    @csrf
    @method('DELETE')
</form>
@endforeach

@endsection

@push('scripts')
<script>
// ─── Modal Delete ────────────────────────────────────────────────
let targetFormId = null;

function openDeleteModal(id, name) {
    targetFormId = id;
    document.getElementById('modalEventName').textContent = name;
    document.getElementById('deleteModal').classList.add('active');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.remove('active');
    targetFormId = null;
}

document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
    if (targetFormId) {
        document.getElementById('deleteForm' + targetFormId).submit();
    }
});

// Close modal when clicking overlay background
document.getElementById('deleteModal').addEventListener('click', function (e) {
    if (e.target === this) closeDeleteModal();
});

// ─── Search & Filter ─────────────────────────────────────────────
function filterEvents() {
    const query  = document.getElementById('searchInput').value.toLowerCase().trim();
    const status = document.getElementById('statusFilter').value;
    const cards  = document.querySelectorAll('#eventsGrid .event-card');
    let visible  = 0;

    cards.forEach(card => {
        const title  = card.dataset.title  || '';
        const lokasi = card.dataset.lokasi || '';
        const cStatus = card.dataset.status || '';

        const matchText   = title.includes(query) || lokasi.includes(query);
        const matchStatus = status === 'all' || cStatus === status;

        if (matchText && matchStatus) {
            card.style.display = '';
            visible++;
        } else {
            card.style.display = 'none';
        }
    });

    document.getElementById('countBadge').textContent = visible + ' event';
    document.getElementById('noResult').style.display = visible === 0 ? 'block' : 'none';
}
</script>
@endpush
