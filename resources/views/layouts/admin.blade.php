<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — Masjid Al-Ikhlas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family:'Poppins',sans-serif; }
        .sidebar { width:260px; min-height:100vh; background:linear-gradient(180deg,#081810 0%,#0f2d1c 100%); position:fixed; left:0; top:0; bottom:0; z-index:100; display:flex; flex-direction:column; }
        .sidebar-brand { padding:1.75rem 1.5rem; border-bottom:1px solid rgba(255,255,255,.08); }
        .sidebar-brand-name { color:#fff; font-weight:700; font-size:1rem; }
        .sidebar-brand-sub { color:#c9a227; font-size:.65rem; letter-spacing:2px; text-transform:uppercase; }
        .sidebar-nav { padding:1.5rem 1rem; flex:1; }
        .nav-section-title { font-size:.65rem; letter-spacing:2px; text-transform:uppercase; color:rgba(255,255,255,.3); padding:.5rem .75rem; margin-top:.5rem; }
        .nav-item { display:flex; align-items:center; gap:.75rem; padding:.7rem .75rem; border-radius:12px; color:rgba(255,255,255,.65); text-decoration:none; font-size:.875rem; font-weight:500; transition:all .2s; margin-bottom:.25rem; }
        .nav-item:hover { background:rgba(255,255,255,.08); color:#fff; }
        .nav-item.active { background:rgba(201,162,39,.15); color:#e8c547; border:1px solid rgba(201,162,39,.25); }
        .nav-item-icon { width:22px; text-align:center; font-size:1rem; }
        .sidebar-footer { padding:1.25rem 1.5rem; border-top:1px solid rgba(255,255,255,.08); }
        .sidebar-user { display:flex; align-items:center; gap:.75rem; margin-bottom:1rem; }
        .sidebar-avatar { width:36px; height:36px; background:#c9a227; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:700; color:#081810; font-size:.9rem; }
        .sidebar-username { color:#fff; font-size:.85rem; font-weight:600; }
        .sidebar-role { color:rgba(255,255,255,.45); font-size:.7rem; }
        .btn-logout { display:flex; align-items:center; gap:.5rem; width:100%; padding:.6rem .75rem; border-radius:10px; background:rgba(255,80,80,.1); color:rgba(255,120,120,.9); border:1px solid rgba(255,80,80,.15); font-size:.83rem; font-weight:600; cursor:pointer; font-family:inherit; transition:all .2s; text-decoration:none; }
        .btn-logout:hover { background:rgba(255,80,80,.2); }

        .main-content { margin-left:260px; min-height:100vh; background:#f8faf9; }
        .topbar { background:#fff; border-bottom:1px solid #eef2ee; padding:1rem 2rem; display:flex; align-items:center; justify-content:space-between; position:sticky; top:0; z-index:50; }
        .topbar-title { font-size:1.1rem; font-weight:700; color:#0d2318; }
        .topbar-breadcrumb { font-size:.8rem; color:#9ca3af; }
        .topbar-right { display:flex; align-items:center; gap:1rem; }
        .btn-view-site { background:#1a4731; color:#fff; padding:.45rem 1rem; border-radius:8px; font-size:.82rem; font-weight:600; text-decoration:none; transition:background .2s; }
        .btn-view-site:hover { background:#2d6a4f; }

        .page-content { padding:2rem; }
        .alert-success { background:#d1fae5; border:1px solid #6ee7b7; color:#065f46; padding:1rem 1.5rem; border-radius:12px; margin-bottom:1.5rem; font-size:.9rem; display:flex; align-items:center; gap:.75rem; }
        .alert-error { background:#fee2e2; border:1px solid #fca5a5; color:#991b1b; padding:1rem 1.5rem; border-radius:12px; margin-bottom:1.5rem; font-size:.9rem; }
        @media(max-width:768px){ .sidebar{transform:translateX(-100%);transition:transform .3s;} .main-content{margin-left:0;} }
    </style>
    @stack('styles')
</head>
<body>

{{-- Sidebar --}}
<aside class="sidebar">
    <div class="sidebar-brand">
        <div style="display:flex;align-items:center;gap:.7rem;margin-bottom:.25rem">
            <div style="width:36px;height:36px;background:#c9a227;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.1rem">🕌</div>
            <div>
                <div class="sidebar-brand-name">Al-Ikhlas</div>
                <div class="sidebar-brand-sub">Admin Panel</div>
            </div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-title">Menu Utama</div>

        <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="nav-item-icon">📊</span> Dashboard
        </a>
        <a href="{{ route('admin.events.index') }}" class="nav-item {{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
            <span class="nav-item-icon">📅</span> Kelola Event
        </a>
        <a href="{{ route('admin.donations.index') }}" class="nav-item {{ request()->routeIs('admin.donations.*') ? 'active' : '' }}">
            <span class="nav-item-icon">💚</span> Data Donasi
        </a>
        <a href="{{ route('admin.keuangan.index') }}" class="nav-item {{ request()->routeIs('admin.keuangan.*') ? 'active' : '' }}">
            <span class="nav-item-icon">📊</span> Laporan Keuangan
        </a>

        <div class="nav-section-title" style="margin-top:1.5rem">Akun</div>
        <a href="{{ route('admin.profile.edit') }}" class="nav-item {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
            <span class="nav-item-icon">👤</span> Profil
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="sidebar-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <div class="sidebar-username">{{ auth()->user()->name }}</div>
                <div class="sidebar-role">Administrator</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">🚪 Keluar</button>
        </form>
    </div>
</aside>

{{-- Main Content --}}
<div class="main-content">
    {{-- Topbar --}}
    <div class="topbar">
        <div>
            <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
            <div class="topbar-breadcrumb">Admin / @yield('breadcrumb', 'Dashboard')</div>
        </div>
        <div class="topbar-right">
            <a href="{{ route('home') }}" class="btn-view-site" target="_blank">🌐 Lihat Website</a>
        </div>
    </div>

    <div class="page-content">
        {{-- Flash messages --}}
        @if(session('success'))
            <div class="alert-success">✅ {{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert-error">
                <ul style="margin:0;padding-left:1.25rem">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
</div>

@stack('scripts')
</body>
</html>
