<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masjid Al-Ikhlas — Rumah Allah Yang Mulia</title>
    <meta name="description" content="Masjid Al-Ikhlas — masjid yang melayani jamaah dengan penuh keikhlasan di Kota Jakarta. Temukan jadwal sholat, kegiatan, dan informasi donasi.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Amiri:wght@400;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --gd: #081810;
            --gp: #1a4731;
            --gm: #2d6a4f;
            --gl: #52b788;
            --gold: #c9a227;
            --gold-l: #e8c547;
            --cream: #fdf8f0;
            --white: #ffffff;
        }
        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
        html { scroll-behavior: smooth; }
        body { font-family:'Poppins',sans-serif; background:var(--cream); color:#1a2e1f; overflow-x:hidden; }

        /* ── NAVBAR ── */
        .navbar {
            position:fixed; top:0; left:0; right:0; z-index:999;
            padding:1rem 2.5rem; display:flex; align-items:center; justify-content:space-between;
            transition:all .4s ease;
        }
        .navbar.scrolled {
            background:rgba(8,24,16,.95); backdrop-filter:blur(12px);
            box-shadow:0 4px 30px rgba(0,0,0,.4);
        }
        .nav-brand { display:flex; align-items:center; gap:.75rem; text-decoration:none; }
        .nav-icon {
            width:42px; height:42px; background:var(--gold); border-radius:50%;
            display:flex; align-items:center; justify-content:center; font-size:1.3rem;
        }
        .nav-name { font-size:1rem; font-weight:700; color:#fff; line-height:1.1; }
        .nav-sub { font-size:.6rem; color:var(--gold-l); letter-spacing:2px; text-transform:uppercase; }
        .nav-links { display:flex; align-items:center; gap:2rem; list-style:none; }
        .nav-links a { color:rgba(255,255,255,.8); text-decoration:none; font-size:.88rem; font-weight:500; transition:color .2s; }
        .nav-links a:hover { color:var(--gold-l); }
        .btn-nav-admin {
            background:var(--gold) !important; color:var(--gd) !important;
            padding:.45rem 1.2rem !important; border-radius:50px;
            font-weight:700 !important; font-size:.82rem !important;
            transition:all .2s !important;
        }
        .btn-nav-admin:hover { background:var(--gold-l) !important; transform:translateY(-1px); }
        .hamburger { display:none; flex-direction:column; gap:5px; cursor:pointer; background:none; border:none; }
        .hamburger span { width:24px; height:2px; background:white; border-radius:2px; transition:all .3s; }

        /* ── HERO ── */
        .hero {
            min-height:100vh; position:relative; display:flex; flex-direction:column;
            align-items:center; justify-content:center; overflow:hidden; color:#fff;
            background: radial-gradient(ellipse at 20% 40%, #0f3320 0%, #081810 40%),
                        radial-gradient(ellipse at 80% 60%, #1a4731 0%, #081810 60%);
        }
        .hero-orb1 { position:absolute; top:-20%; left:-10%; width:600px; height:600px; background:radial-gradient(circle,rgba(201,162,39,.12),transparent 70%); border-radius:50%; }
        .hero-orb2 { position:absolute; bottom:-15%; right:-5%; width:500px; height:500px; background:radial-gradient(circle,rgba(45,106,79,.25),transparent 70%); border-radius:50%; }

        /* Stars */
        .stars { position:absolute; inset:0; overflow:hidden; pointer-events:none; }
        .star { position:absolute; width:2px; height:2px; background:#fff; border-radius:50%; }

        /* Mosque silhouette */
        .mosque-svg { position:absolute; bottom:0; left:0; right:0; z-index:1; opacity:.12; }

        .hero-content { position:relative; z-index:2; text-align:center; padding:2rem; max-width:820px; }
        .hero-arabic { font-family:'Amiri',serif; font-size:3rem; color:var(--gold-l); margin-bottom:.5rem; direction:rtl; line-height:1.6; }
        .hero-badge { font-size:.75rem; letter-spacing:4px; text-transform:uppercase; color:var(--gold); margin-bottom:1.25rem; font-weight:600; }
        .hero-name {
            font-size:clamp(2.8rem,7vw,5rem); font-weight:800; line-height:1.05; margin-bottom:1.25rem;
            background:linear-gradient(135deg,#fff 30%,var(--gold-l));
            -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
        }
        .hero-desc { font-size:1.05rem; color:rgba(255,255,255,.72); max-width:540px; margin:0 auto 2.5rem; line-height:1.85; }
        .hero-btns { display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; }
        .btn-gold {
            background:var(--gold); color:var(--gd); padding:.9rem 2rem; border-radius:50px;
            font-weight:700; font-size:.95rem; text-decoration:none; transition:all .3s;
            box-shadow:0 4px 20px rgba(201,162,39,.35);
        }
        .btn-gold:hover { background:var(--gold-l); transform:translateY(-3px); box-shadow:0 8px 30px rgba(201,162,39,.5); }
        .btn-ghost {
            border:2px solid rgba(255,255,255,.3); color:#fff; padding:.9rem 2rem;
            border-radius:50px; font-weight:600; font-size:.95rem; text-decoration:none; transition:all .3s;
        }
        .btn-ghost:hover { border-color:var(--gold); color:var(--gold-l); }

        /* Prayer box in hero */
        .hero-prayer {
            position:relative; z-index:2; margin-top:3rem;
            background:rgba(255,255,255,.07); backdrop-filter:blur(10px);
            border:1px solid rgba(255,255,255,.12); border-radius:20px;
            padding:1.25rem 2rem; display:flex; gap:2.5rem; flex-wrap:wrap; justify-content:center;
        }
        .hp-item { text-align:center; min-width:70px; }
        .hp-item.active .hp-name, .hp-item.active .hp-time { color:var(--gold-l); }
        .hp-dot { width:6px; height:6px; border-radius:50%; background:var(--gold-l); margin:3px auto 0; animation:pulse-dot 1.2s infinite; }
        @keyframes pulse-dot { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:0;transform:scale(1.5)} }
        .hp-name { font-size:.68rem; letter-spacing:1.5px; text-transform:uppercase; color:rgba(255,255,255,.55); font-weight:600; }
        .hp-time { font-size:1.05rem; font-weight:700; color:#fff; margin-top:2px; }

        /* Scroll indicator */
        .scroll-ind {
            position:absolute; bottom:2rem; left:50%; transform:translateX(-50%);
            z-index:2; display:flex; flex-direction:column; align-items:center; gap:.5rem;
            color:rgba(255,255,255,.4); font-size:.65rem; letter-spacing:2px; text-transform:uppercase;
        }
        .scroll-mouse { width:26px; height:42px; border:2px solid rgba(255,255,255,.25); border-radius:13px; position:relative; }
        .scroll-mouse::after {
            content:''; position:absolute; top:6px; left:50%; transform:translateX(-50%);
            width:4px; height:8px; background:rgba(255,255,255,.5); border-radius:2px;
            animation:scrollAnim 1.6s infinite;
        }
        @keyframes scrollAnim { 0%{top:6px;opacity:1} 100%{top:24px;opacity:0} }

        /* ── SECTIONS ── */
        section { padding:5rem 2rem; }
        .container { max-width:1180px; margin:0 auto; }
        .section-badge {
            display:inline-block; background:rgba(26,71,49,.1); color:var(--gp);
            padding:.4rem 1.25rem; border-radius:50px; font-size:.75rem; font-weight:700;
            letter-spacing:2px; text-transform:uppercase; margin-bottom:1rem;
            border:1px solid rgba(26,71,49,.2);
        }
        .section-title { font-size:clamp(1.8rem,4vw,2.7rem); font-weight:800; color:#0d2318; line-height:1.15; margin-bottom:1rem; }
        .section-desc { font-size:.97rem; color:#5c7060; line-height:1.85; max-width:580px; }
        .gold-bar { width:55px; height:4px; background:linear-gradient(to right,var(--gold),var(--gold-l)); border-radius:2px; margin:1rem 0 1.75rem; }
        .fade-up { opacity:0; transform:translateY(30px); transition:opacity .7s ease,transform .7s ease; }
        .fade-up.visible { opacity:1; transform:translateY(0); }

        /* ── ABOUT ── */
        .about-section { background:var(--cream); }
        .about-grid { display:grid; grid-template-columns:1fr 1fr; gap:5rem; align-items:center; }
        .about-mosaic {
            position:relative; aspect-ratio:1; background:linear-gradient(145deg,var(--gp),var(--gd));
            border-radius:32px; overflow:hidden; display:flex; align-items:center; justify-content:center;
        }
        .about-mosaic::before {
            content:''; position:absolute; inset:0;
            background-image:repeating-linear-gradient(45deg,transparent,transparent 25px,rgba(255,255,255,.03) 25px,rgba(255,255,255,.03) 50px),
                             repeating-linear-gradient(-45deg,transparent,transparent 25px,rgba(255,255,255,.03) 25px,rgba(255,255,255,.03) 50px);
        }
        .about-mosque-icon { font-size:8rem; opacity:.35; position:relative; z-index:1; }
        .about-stats { display:grid; grid-template-columns:1fr 1fr; gap:1.25rem; margin-top:2.5rem; }
        .stat-card {
            background:#fff; border-radius:18px; padding:1.5rem; border:1px solid rgba(201,162,39,.2);
            box-shadow:0 4px 20px rgba(0,0,0,.05); transition:transform .25s;
        }
        .stat-card:hover { transform:translateY(-4px); }
        .stat-number { font-size:2.2rem; font-weight:800; color:var(--gp); line-height:1; }
        .stat-unit { font-size:1rem; }
        .stat-label { font-size:.82rem; color:#7a9179; margin-top:.35rem; }

        /* ── PRAYER TIMES ── */
        .prayer-section { background:linear-gradient(135deg,var(--gd) 0%,var(--gp) 100%); color:#fff; }
        .prayer-section .section-badge { background:rgba(255,255,255,.1); color:var(--gold-l); border-color:rgba(255,255,255,.15); }
        .prayer-section .section-title { color:#fff; }
        .prayer-section .section-desc { color:rgba(255,255,255,.65); }
        .prayer-grid { display:grid; grid-template-columns:repeat(5,1fr); gap:1rem; margin-top:3rem; }
        .prayer-card {
            background:rgba(255,255,255,.07); border:1px solid rgba(255,255,255,.1);
            border-radius:22px; padding:2rem 1rem; text-align:center; transition:all .3s;
        }
        .prayer-card:hover { background:rgba(201,162,39,.12); border-color:rgba(201,162,39,.5); transform:translateY(-4px); }
        .prayer-card.active-prayer { background:rgba(201,162,39,.15); border-color:var(--gold); }
        .prayer-icon { font-size:2rem; margin-bottom:1rem; }
        .prayer-card-name { font-size:.75rem; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; color:rgba(255,255,255,.55); margin-bottom:.5rem; }
        .prayer-card.active-prayer .prayer-card-name { color:var(--gold-l); }
        .prayer-card-time { font-size:1.5rem; font-weight:700; color:#fff; }
        .prayer-card.active-prayer .prayer-card-time { color:var(--gold-l); }
        .prayer-next {
            margin-top:2.5rem; text-align:center;
            background:rgba(255,255,255,.07); border:1px solid rgba(201,162,39,.3);
            border-radius:14px; padding:1.1rem 2rem; display:inline-block; color:rgba(255,255,255,.8); font-size:.9rem;
        }
        .prayer-next strong { color:var(--gold-l); }
        .prayer-loading { color:rgba(255,255,255,.5); font-size:.9rem; margin-top:1rem; }

        /* ── EVENTS ── */
        .events-section { background:#fff; }
        .events-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(330px,1fr)); gap:2rem; margin-top:3rem; }
        .event-card {
            background:#fff; border-radius:22px; overflow:hidden;
            box-shadow:0 4px 25px rgba(0,0,0,.07); border:1px solid #f0f0f0;
            transition:all .35s; display:flex; flex-direction:column;
        }
        .event-card:hover { transform:translateY(-7px); box-shadow:0 14px 45px rgba(0,0,0,.14); }
        .event-top-bar { height:6px; background:linear-gradient(to right,var(--gp),var(--gold)); }
        .event-body { padding:1.75rem; flex:1; display:flex; flex-direction:column; }
        .event-date-badge {
            display:inline-flex; align-items:center; gap:.45rem;
            background:rgba(26,71,49,.09); color:var(--gp);
            padding:.35rem .9rem; border-radius:50px; font-size:.78rem; font-weight:700; margin-bottom:1rem;
        }
        .event-title { font-size:1.1rem; font-weight:700; color:#0d2318; margin-bottom:.75rem; line-height:1.4; }
        .event-desc { font-size:.88rem; color:#6b7280; line-height:1.75; margin-bottom:1rem; flex:1; display:-webkit-box; -webkit-line-clamp:3; -webkit-box-orient:vertical; overflow:hidden; }
        .event-location { display:flex; align-items:center; gap:.45rem; font-size:.82rem; color:#9ca3af; margin-top:auto; }
        .empty-state { text-align:center; padding:5rem 2rem; color:#aaa; }
        .empty-icon { font-size:4rem; margin-bottom:1rem; opacity:.4; }

        /* ── DONATION ── */
        .donation-section {
            background:linear-gradient(140deg,var(--gd) 0%,#0f3626 60%,var(--gp) 100%);
            color:#fff; position:relative; overflow:hidden;
        }
        .donation-section::before {
            content:''; position:absolute; top:-30%; right:-5%; width:500px; height:500px;
            background:radial-gradient(circle,rgba(201,162,39,.1),transparent 70%); border-radius:50%;
        }
        .donation-section .section-badge { background:rgba(255,255,255,.08); color:var(--gold-l); border-color:rgba(255,255,255,.15); }
        .donation-section .section-title { color:#fff; }
        .donation-section .section-desc { color:rgba(255,255,255,.65); }
        .donation-grid { display:grid; grid-template-columns:1fr 1fr; gap:4rem; align-items:start; margin-top:3rem; }
        .bank-card {
            background:rgba(255,255,255,.07); backdrop-filter:blur(5px);
            border:1px solid rgba(255,255,255,.12); border-radius:20px;
            padding:1.75rem 2rem; margin-bottom:1.25rem; transition:all .3s;
        }
        .bank-card:hover { background:rgba(255,255,255,.12); border-color:rgba(201,162,39,.4); }
        .bank-label { font-size:.7rem; letter-spacing:2px; text-transform:uppercase; color:var(--gold); font-weight:700; margin-bottom:.4rem; }
        .bank-number { font-size:1.6rem; font-weight:800; letter-spacing:3px; color:#fff; }
        .bank-holder { font-size:.88rem; color:rgba(255,255,255,.6); margin-top:.3rem; }
        .copy-btn {
            background:transparent; border:1px solid rgba(201,162,39,.5); color:var(--gold-l);
            padding:.4rem 1rem; border-radius:50px; font-size:.78rem; font-weight:600;
            cursor:pointer; transition:all .2s; margin-top:1rem; font-family:inherit;
        }
        .copy-btn:hover { background:rgba(201,162,39,.15); }
        .donation-steps { list-style:none; }
        .donation-step { display:flex; gap:1.25rem; margin-bottom:1.75rem; align-items:flex-start; }
        .step-num {
            width:40px; height:40px; min-width:40px; background:var(--gold); color:var(--gd);
            border-radius:50%; display:flex; align-items:center; justify-content:center;
            font-weight:800; font-size:.9rem;
        }
        .step-text h4 { font-weight:600; margin-bottom:.25rem; font-size:.95rem; }
        .step-text p { font-size:.87rem; color:rgba(255,255,255,.6); line-height:1.65; }

        /* ── CONTACT ── */
        .contact-section { background:var(--cream); }
        .contact-grid { display:grid; grid-template-columns:1fr 1.6fr; gap:4rem; align-items:start; }
        .contact-items { margin-top:2rem; }
        .contact-item { display:flex; gap:1rem; margin-bottom:1.75rem; }
        .contact-icon-box {
            width:50px; height:50px; min-width:50px;
            background:linear-gradient(135deg,var(--gp),var(--gm));
            border-radius:14px; display:flex; align-items:center; justify-content:center;
            font-size:1.3rem; color:#fff;
        }
        .contact-text h4 { font-weight:700; color:#0d2318; margin-bottom:.25rem; }
        .contact-text p { font-size:.9rem; color:#6b7280; line-height:1.65; }
        .map-box {
            border-radius:24px; overflow:hidden; height:400px;
            box-shadow:0 8px 40px rgba(0,0,0,.14); border:3px solid #fff;
        }
        .map-box iframe { width:100%; height:100%; border:none; }

        /* ── FOOTER ── */
        .footer { background:var(--gd); color:#fff; padding:4rem 2rem 2rem; }
        .footer-inner { max-width:1180px; margin:0 auto; display:grid; grid-template-columns:2fr 1fr 1fr; gap:3rem; }
        .footer-desc { color:rgba(255,255,255,.55); font-size:.9rem; line-height:1.85; margin-top:1rem; max-width:310px; }
        .footer-col-title { font-size:.75rem; letter-spacing:2px; text-transform:uppercase; color:var(--gold); font-weight:700; margin-bottom:1.25rem; }
        .footer-links { list-style:none; }
        .footer-links li { margin-bottom:.75rem; }
        .footer-links a { color:rgba(255,255,255,.55); text-decoration:none; font-size:.9rem; transition:color .2s; }
        .footer-links a:hover { color:var(--gold-l); }
        .footer-bottom { max-width:1180px; margin:3rem auto 0; padding-top:1.5rem; border-top:1px solid rgba(255,255,255,.08); text-align:center; color:rgba(255,255,255,.35); font-size:.83rem; }

        /* ── RESPONSIVE ── */
        @media(max-width:1024px) {
            .prayer-grid { grid-template-columns:repeat(3,1fr); }
        }
        @media(max-width:768px) {
            .nav-links { display:none; }
            .hamburger { display:flex; }
            .mobile-menu {
                position:fixed; inset:0; background:rgba(8,24,16,.97); z-index:1000;
                display:flex; flex-direction:column; align-items:center; justify-content:center; gap:2rem;
            }
            .mobile-menu a { color:#fff; font-size:1.3rem; font-weight:600; text-decoration:none; }
            .about-grid, .donation-grid, .contact-grid, .footer-inner { grid-template-columns:1fr; }
            .about-grid { gap:2.5rem; }
            .donation-grid { gap:2.5rem; }
            .contact-grid { gap:2.5rem; }
            .prayer-grid { grid-template-columns:repeat(3,1fr); gap:.75rem; }
            .hero-prayer { gap:1.5rem; }
            .map-box { height:280px; }
            .footer-inner { grid-template-columns:1fr; gap:2rem; }
        }
        @media(max-width:480px) {
            .prayer-grid { grid-template-columns:repeat(2,1fr); }
            .about-stats { grid-template-columns:1fr 1fr; }
        }
    </style>
</head>
<body>

{{-- ═══════════════════════════════════════════════
     NAVBAR
═══════════════════════════════════════════════ --}}
<nav class="navbar" id="navbar">
    <a href="#" class="nav-brand">
        <div class="nav-icon">🕌</div>
        <div>
            <div class="nav-name">Masjid Al-Ikhlas</div>
            <div class="nav-sub">Rumah Allah Yang Mulia</div>
        </div>
    </a>

    <ul class="nav-links" id="navLinks">
        <li><a href="#tentang">Tentang</a></li>
        <li><a href="#jadwal">Jadwal Sholat</a></li>
        <li><a href="#kegiatan">Kegiatan</a></li>
        <li><a href="#donasi">Donasi</a></li>
        <li><a href="#kontak">Kontak</a></li>
        @auth
            <li><a href="{{ route('admin.dashboard') }}" class="btn-nav-admin">Admin Panel</a></li>
        @else
            <li><a href="{{ route('login') }}" class="btn-nav-admin">Login Admin</a></li>
        @endauth
    </ul>

    <button class="hamburger" id="hamburger" aria-label="Menu">
        <span></span><span></span><span></span>
    </button>
</nav>

{{-- Mobile menu --}}
<div class="mobile-menu" id="mobileMenu" style="display:none">
    <button onclick="closeMobile()" style="position:absolute;top:1.5rem;right:2rem;background:none;border:none;font-size:2rem;color:white;cursor:pointer">✕</button>
    <a href="#tentang" onclick="closeMobile()">Tentang</a>
    <a href="#jadwal" onclick="closeMobile()">Jadwal Sholat</a>
    <a href="#kegiatan" onclick="closeMobile()">Kegiatan</a>
    <a href="#donasi" onclick="closeMobile()">Donasi</a>
    <a href="#kontak" onclick="closeMobile()">Kontak</a>
    @auth
        <a href="{{ route('admin.dashboard') }}" style="color:var(--gold-l)">Admin Panel →</a>
    @else
        <a href="{{ route('login') }}" style="color:var(--gold-l)">Login Admin →</a>
    @endauth
</div>

{{-- ═══════════════════════════════════════════════
     HERO
═══════════════════════════════════════════════ --}}
<section class="hero" id="hero">
    <div class="hero-orb1"></div>
    <div class="hero-orb2"></div>

    {{-- Stars --}}
    <div class="stars" id="stars"></div>

    {{-- Mosque silhouette --}}
    <svg class="mosque-svg" viewBox="0 0 1440 280" xmlns="http://www.w3.org/2000/svg" fill="white">
        <!-- Left small minaret -->
        <rect x="220" y="180" width="22" height="100"/>
        <polygon points="209,180 231,110 253,180"/>
        <!-- Right small minaret -->
        <rect x="1198" y="180" width="22" height="100"/>
        <polygon points="1187,180 1209,110 1231,180"/>
        <!-- Left main minaret -->
        <rect x="410" y="120" width="32" height="160"/>
        <polygon points="397,120 426,42 455,120"/>
        <!-- Right main minaret -->
        <rect x="998" y="120" width="32" height="160"/>
        <polygon points="985,120 1014,42 1043,120"/>
        <!-- Main building -->
        <rect x="370" y="200" width="700" height="80"/>
        <!-- Side domes -->
        <path d="M465,202 Q465,155 530,140 Q595,155 595,202Z"/>
        <path d="M845,202 Q845,155 910,140 Q975,155 975,202Z"/>
        <!-- Main dome -->
        <path d="M545,204 Q545,80 720,40 Q895,80 895,204Z"/>
        <!-- Gate -->
        <path d="M675,280 L675,225 Q720,200 765,225 L765,280Z" fill="rgba(0,0,0,0.4)"/>
        <!-- Arches -->
        <path d="M420,280 L420,235 Q445,215 470,235 L470,280Z" fill="rgba(0,0,0,0.2)"/>
        <path d="M480,280 L480,235 Q505,215 530,235 L530,280Z" fill="rgba(0,0,0,0.2)"/>
        <path d="M910,280 L910,235 Q935,215 960,235 L960,280Z" fill="rgba(0,0,0,0.2)"/>
        <path d="M970,280 L970,235 Q995,215 1020,235 L1020,280Z" fill="rgba(0,0,0,0.2)"/>
        <!-- Ground line -->
        <rect x="0" y="275" width="1440" height="5" fill="rgba(201,162,39,0.6)"/>
    </svg>

    <div class="hero-content">
        <div class="hero-arabic fade-up" style="transition-delay:.1s">بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ</div>
        <div class="hero-badge fade-up" style="transition-delay:.2s">✦ Selamat Datang ✦</div>
        <h1 class="hero-name fade-up" style="transition-delay:.3s">Masjid Al-Ikhlas</h1>
        <p class="hero-desc fade-up" style="transition-delay:.4s">
            Tempat ibadah, belajar, dan silaturahmi bagi seluruh umat Muslim.
            Hadir melayani jamaah dengan penuh keikhlasan dan kasih sayang.
        </p>
        <div class="hero-btns fade-up" style="transition-delay:.5s">
            <a href="#kegiatan" class="btn-gold">📅 Lihat Kegiatan</a>
            <a href="#donasi" class="btn-ghost">💚 Donasi Sekarang</a>
        </div>
    </div>

    {{-- Prayer times mini widget --}}
    <div class="hero-prayer fade-up" id="heroPrayer" style="transition-delay:.6s">
        <div class="hp-item" id="hp-subuh">
            <div class="hp-name">Subuh</div>
            <div class="hp-time" id="t-subuh">--:--</div>
        </div>
        <div class="hp-item" id="hp-dzuhur">
            <div class="hp-name">Dzuhur</div>
            <div class="hp-time" id="t-dzuhur">--:--</div>
        </div>
        <div class="hp-item" id="hp-ashar">
            <div class="hp-name">Ashar</div>
            <div class="hp-time" id="t-ashar">--:--</div>
        </div>
        <div class="hp-item" id="hp-maghrib">
            <div class="hp-name">Maghrib</div>
            <div class="hp-time" id="t-maghrib">--:--</div>
        </div>
        <div class="hp-item" id="hp-isya">
            <div class="hp-name">Isya</div>
            <div class="hp-time" id="t-isya">--:--</div>
        </div>
    </div>

    <div class="scroll-ind">
        <div class="scroll-mouse"></div>
        <span>Scroll</span>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     TENTANG
═══════════════════════════════════════════════ --}}
<section class="about-section" id="tentang">
    <div class="container">
        <div class="about-grid">
            <div>
                <span class="section-badge fade-up">🕌 Tentang Kami</span>
                <h2 class="section-title fade-up">Mengenal Lebih Dekat<br>Masjid Kami</h2>
                <div class="gold-bar fade-up"></div>
                <p class="section-desc fade-up">
                    Masjid Al-Ikhlas didirikan pada tahun 1985 sebagai pusat kegiatan ibadah dan sosial masyarakat.
                    Selama lebih dari 39 tahun, kami telah menjadi rumah bagi ribuan jamaah yang mencari ketenangan,
                    ilmu, dan kebersamaan dalam naungan rahmat Allah SWT.
                </p>
                <p class="section-desc fade-up" style="margin-top:1rem">
                    Dengan fasilitas modern dan pengelolaan yang transparan, kami terus berkomitmen untuk
                    memberikan pelayanan terbaik bagi jamaah dan masyarakat sekitar.
                </p>
                <div class="about-stats fade-up">
                    <div class="stat-card">
                        <div class="stat-number">39<span class="stat-unit">+</span></div>
                        <div class="stat-label">Tahun Berdiri</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">1.500<span class="stat-unit">+</span></div>
                        <div class="stat-label">Kapasitas Jamaah</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">12<span class="stat-unit">+</span></div>
                        <div class="stat-label">Program Rutin</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">5<span class="stat-unit">×</span></div>
                        <div class="stat-label">Sholat Berjamaah/Hari</div>
                    </div>
                </div>
            </div>
            <div class="about-mosaic fade-up">
                <div class="about-mosque-icon">🕌</div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     JADWAL SHOLAT
═══════════════════════════════════════════════ --}}
<section class="prayer-section" id="jadwal">
    <div class="container">
        <div style="text-align:center">
            <span class="section-badge fade-up">🕐 Jadwal Sholat</span>
            <h2 class="section-title fade-up">Waktu Sholat Hari Ini</h2>
            <div class="gold-bar fade-up" style="margin:1rem auto 1rem"></div>
            <p class="section-desc fade-up" style="margin:0 auto">
                Jadwal sholat untuk wilayah Jakarta dan sekitarnya.
                <span id="prayerDate" style="color:var(--gold-l);font-weight:600"></span>
            </p>
        </div>

        <div class="prayer-grid fade-up" id="prayerGrid">
            @foreach([['Subuh','🌙','subuh'],['Dzuhur','☀️','dhuhr'],['Ashar','⛅','asr'],['Maghrib','🌅','maghrib'],['Isya','🌃','isha']] as $p)
            <div class="prayer-card" id="pc-{{ $p[2] }}">
                <div class="prayer-icon">{{ $p[1] }}</div>
                <div class="prayer-card-name">{{ $p[0] }}</div>
                <div class="prayer-card-time" id="pc-t-{{ $p[2] }}">--:--</div>
            </div>
            @endforeach
        </div>

        <div style="text-align:center;margin-top:2.5rem">
            <div class="prayer-next fade-up" id="prayerNext">
                ⏰ Memuat jadwal sholat...
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     KEGIATAN / EVENTS
═══════════════════════════════════════════════ --}}
<section class="events-section" id="kegiatan">
    <div class="container">
        <div style="display:flex;justify-content:space-between;align-items:flex-end;flex-wrap:wrap;gap:1rem;margin-bottom:0">
            <div>
                <span class="section-badge fade-up">📅 Kegiatan</span>
                <h2 class="section-title fade-up">Kegiatan & Agenda Masjid</h2>
                <div class="gold-bar fade-up"></div>
                <p class="section-desc fade-up">Program dan kegiatan yang akan segera berlangsung di Masjid Al-Ikhlas.</p>
            </div>
        </div>

        @if($events->isEmpty())
            <div class="empty-state fade-up">
                <div class="empty-icon">📅</div>
                <h3 style="color:#aaa;font-weight:600;margin-bottom:.5rem">Belum Ada Kegiatan</h3>
                <p style="font-size:.9rem">Kegiatan akan segera ditambahkan. Pantau terus!</p>
            </div>
        @else
            <div class="events-grid">
                @foreach($events as $event)
                <div class="event-card fade-up">
                    @if($event->gambar)
                        <img src="{{ Storage::url($event->gambar) }}" alt="{{ $event->judul }}" style="width:100%;height:200px;object-fit:cover;">
                    @else
                        <div class="event-top-bar"></div>
                    @endif
                    <div class="event-body">
                        <span class="event-date-badge">
                            📆 {{ $event->tanggal->translatedFormat('d F Y') }}
                        </span>
                        <h3 class="event-title">{{ $event->judul }}</h3>
                        <p class="event-desc">{{ $event->deskripsi }}</p>
                        @if($event->lokasi)
                        <div class="event-location">
                            <span>📍</span> <span>{{ $event->lokasi }}</span>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     DONASI
═══════════════════════════════════════════════ --}}
<section class="donation-section" id="donasi">
    <div class="container">
        <div style="text-align:center;margin-bottom:0">
            <span class="section-badge fade-up">💚 Donasi</span>
            <h2 class="section-title fade-up">Dukung Kemakmuran Masjid</h2>
            <div class="gold-bar fade-up" style="margin:1rem auto"></div>
            <p class="section-desc fade-up" style="margin:0 auto">
                Setiap donasi Anda akan digunakan untuk kemajuan dan kemakmuran Masjid Al-Ikhlas.
                Semua transaksi transparan dan dapat dipertanggungjawabkan.
            </p>
        </div>

        <div class="donation-grid fade-up">
            <div>
                <h3 style="font-size:1.2rem;font-weight:700;margin-bottom:1.5rem;color:rgba(255,255,255,.9)">Rekening Donasi</h3>

                <div class="bank-card">
                    <div class="bank-label">🏦 Bank BCA</div>
                    <div class="bank-number">1234 5678 90</div>
                    <div class="bank-holder">a.n. Masjid Al-Ikhlas</div>
                    <button class="copy-btn" onclick="copyText('1234567890','bca')">📋 Salin Nomor Rekening</button>
                    <div id="toast-bca" style="font-size:.78rem;color:var(--gold-l);margin-top:.5rem;display:none">✓ Disalin!</div>
                </div>

                <div class="bank-card">
                    <div class="bank-label">🏦 Bank BNI Syariah</div>
                    <div class="bank-number">0987 6543 21</div>
                    <div class="bank-holder">a.n. Masjid Al-Ikhlas</div>
                    <button class="copy-btn" onclick="copyText('0987654321','bni')">📋 Salin Nomor Rekening</button>
                    <div id="toast-bni" style="font-size:.78rem;color:var(--gold-l);margin-top:.5rem;display:none">✓ Disalin!</div>
                </div>
            </div>

            <div>
                <h3 style="font-size:1.2rem;font-weight:700;margin-bottom:1.5rem;color:rgba(255,255,255,.9)">Cara Berdonasi</h3>
                <ul class="donation-steps">
                    <li class="donation-step">
                        <div class="step-num">1</div>
                        <div class="step-text">
                            <h4>Pilih Rekening</h4>
                            <p>Pilih rekening bank yang tersedia di sebelah kiri atau gunakan m-banking Anda.</p>
                        </div>
                    </li>
                    <li class="donation-step">
                        <div class="step-num">2</div>
                        <div class="step-text">
                            <h4>Transfer Donasi</h4>
                            <p>Transfer nominal donasi sesuai kemampuan Anda. Tidak ada minimum donasi.</p>
                        </div>
                    </li>
                    <li class="donation-step">
                        <div class="step-num">3</div>
                        <div class="step-text">
                            <h4>Kirim Konfirmasi</h4>
                            <p>Hubungi pengurus masjid melalui WhatsApp dengan menyertakan bukti transfer.</p>
                        </div>
                    </li>
                    <li class="donation-step">
                        <div class="step-num">4</div>
                        <div class="step-text">
                            <h4>Jazākallāh Khairan</h4>
                            <p>Donasi Anda akan tercatat dan laporan keuangan tersedia untuk semua jamaah.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     KONTAK
═══════════════════════════════════════════════ --}}
<section class="contact-section" id="kontak">
    <div class="container">
        <div class="contact-grid">
            <div>
                <span class="section-badge fade-up">📍 Kontak</span>
                <h2 class="section-title fade-up">Temukan Kami</h2>
                <div class="gold-bar fade-up"></div>
                <p class="section-desc fade-up">Kami selalu terbuka untuk menerima kunjungan dan pertanyaan dari jamaah.</p>

                <div class="contact-items">
                    <div class="contact-item fade-up">
                        <div class="contact-icon-box">📍</div>
                        <div class="contact-text">
                            <h4>Alamat</h4>
                            <p>Jl. Contoh No. 123, Kelurahan Contoh<br>Kecamatan Contoh, Jakarta 12345</p>
                        </div>
                    </div>
                    <div class="contact-item fade-up">
                        <div class="contact-icon-box">📞</div>
                        <div class="contact-text">
                            <h4>Telepon / WhatsApp</h4>
                            <p>+62 812 3456 7890</p>
                        </div>
                    </div>
                    <div class="contact-item fade-up">
                        <div class="contact-icon-box">✉️</div>
                        <div class="contact-text">
                            <h4>Email</h4>
                            <p>info@masjidalIkhlas.com</p>
                        </div>
                    </div>
                    <div class="contact-item fade-up">
                        <div class="contact-icon-box">🕌</div>
                        <div class="contact-text">
                            <h4>Jam Operasional</h4>
                            <p>Setiap hari, mulai Subuh hingga Isya<br>dan kegiatan malam</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="map-box fade-up">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.666617871073!2d106.82699987499!3d-6.175392160037!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5390917b759%3A0x6b45e67356080477!2sMonumen%20Nasional!5e0!3m2!1sid!2sid!4v1707924000000!5m2!1sid!2sid"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     FOOTER
═══════════════════════════════════════════════ --}}
<footer class="footer">
    <div class="footer-inner">
        <div>
            <div style="display:flex;align-items:center;gap:.75rem">
                <div style="width:42px;height:42px;background:var(--gold);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.3rem">🕌</div>
                <div>
                    <div style="font-weight:700;font-size:1rem">Masjid Al-Ikhlas</div>
                    <div style="font-size:.6rem;color:var(--gold);letter-spacing:2px;text-transform:uppercase">Rumah Allah Yang Mulia</div>
                </div>
            </div>
            <p class="footer-desc">
                Melayani jamaah dengan penuh keikhlasan sejak 1985.
                Bersama membangun masjid yang makmur, ilmu yang bermanfaat, dan umat yang bersatu.
            </p>
        </div>
        <div>
            <div class="footer-col-title">Navigasi</div>
            <ul class="footer-links">
                <li><a href="#tentang">Tentang Masjid</a></li>
                <li><a href="#jadwal">Jadwal Sholat</a></li>
                <li><a href="#kegiatan">Kegiatan</a></li>
                <li><a href="#donasi">Donasi</a></li>
                <li><a href="#kontak">Kontak</a></li>
            </ul>
        </div>
        <div>
            <div class="footer-col-title">Informasi</div>
            <ul class="footer-links">
                <li><a href="#">Profil Masjid</a></li>
                <li><a href="#">Pengurus</a></li>
                <li><a href="#">Laporan Keuangan</a></li>
                <li><a href="{{ route('login') }}">Login Admin</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© {{ date('Y') }} Masjid Al-Ikhlas. Semua hak dilindungi. Dibuat dengan ❤️ untuk kemakmuran masjid.</p>
    </div>
</footer>

<script>
// ── Stars
(function(){
    const c = document.getElementById('stars');
    for(let i=0;i<80;i++){
        const s = document.createElement('div');
        s.className = 'star';
        s.style.cssText = `left:${Math.random()*100}%;top:${Math.random()*100}%;width:${Math.random()*2.5+1}px;height:${Math.random()*2.5+1}px;animation-delay:${Math.random()*3}s;animation-duration:${Math.random()*2+1.5}s;opacity:${Math.random()*.7+.3}`;
        c.appendChild(s);
    }
})();

// ── Navbar scroll
window.addEventListener('scroll', function(){
    document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 60);
});

// ── Hamburger
document.getElementById('hamburger').addEventListener('click', function(){
    document.getElementById('mobileMenu').style.display = 'flex';
});
function closeMobile(){ document.getElementById('mobileMenu').style.display = 'none'; }

// ── FadeUp on scroll
const observer = new IntersectionObserver(entries => {
    entries.forEach(e => { if(e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.12 });
document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
// Trigger hero elements immediately
setTimeout(()=>{ document.querySelectorAll('.hero .fade-up').forEach(el=>el.classList.add('visible')); }, 100);

// ── Prayer Times API
const PRAYER_NAMES = {
    Fajr:'subuh', Dhuhr:'dhuhr', Asr:'asr', Maghrib:'maghrib', Isha:'isha'
};
const PRAYER_LABEL = {
    Fajr:'Subuh', Dhuhr:'Dzuhur', Asr:'Ashar', Maghrib:'Maghrib', Isha:'Isya'
};
const HP_IDS = {
    Fajr:'subuh', Dhuhr:'dzuhur', Asr:'ashar', Maghrib:'maghrib', Isha:'isya'
};

async function loadPrayer(){
    try {
        const today = new Date();
        const d = today.getDate(), m = today.getMonth()+1, y = today.getFullYear();
        document.getElementById('prayerDate').textContent = today.toLocaleDateString('id-ID',{weekday:'long',year:'numeric',month:'long',day:'numeric'});

        const res = await fetch(`https://api.aladhan.com/v1/timingsByCity/${d}-${m}-${y}?city=Jakarta&country=Indonesia&method=11`);
        const data = await res.json();
        if(data.code !== 200) return;
        const t = data.data.timings;

        // Fill prayer cards
        document.getElementById('pc-t-subuh').textContent    = t.Fajr;
        document.getElementById('pc-t-dhuhr').textContent    = t.Dhuhr;
        document.getElementById('pc-t-asr').textContent      = t.Asr;
        document.getElementById('pc-t-maghrib').textContent  = t.Maghrib;
        document.getElementById('pc-t-isha').textContent     = t.Isha;

        // Fill hero widget
        document.getElementById('t-subuh').textContent   = t.Fajr;
        document.getElementById('t-dzuhur').textContent  = t.Dhuhr;
        document.getElementById('t-ashar').textContent   = t.Asr;
        document.getElementById('t-maghrib').textContent = t.Maghrib;
        document.getElementById('t-isya').textContent    = t.Isha;

        // Find current/next prayer
        const now = today.getHours() * 60 + today.getMinutes();
        const prayers = [
            {name:'Fajr',    time:t.Fajr,    id:'subuh',   hid:'subuh'},
            {name:'Dhuhr',   time:t.Dhuhr,   id:'dhuhr',   hid:'dzuhur'},
            {name:'Asr',     time:t.Asr,     id:'asr',     hid:'ashar'},
            {name:'Maghrib', time:t.Maghrib, id:'maghrib', hid:'maghrib'},
            {name:'Isha',    time:t.Isha,    id:'isha',    hid:'isya'},
        ];
        const toMin = s => { const [h,m] = s.split(':').map(Number); return h*60+m; };
        let next = null;
        for(const p of prayers){
            const pm = toMin(p.time);
            if(pm > now){ next = p; break; }
        }
        if(!next) next = prayers[0];

        // Highlight
        document.getElementById('pc-'+next.id)?.classList.add('active-prayer');
        document.getElementById('hp-'+next.hid)?.classList.add('active');
        const hpEl = document.getElementById('hp-'+next.hid);
        if(hpEl && !hpEl.querySelector('.hp-dot')){ const d=document.createElement('div'); d.className='hp-dot'; hpEl.appendChild(d); }

        // Countdown
        const diff = toMin(next.time) - now;
        const h = Math.floor(diff/60), m2 = diff%60;
        document.getElementById('prayerNext').innerHTML =
            `⏰ Sholat <strong>${PRAYER_LABEL[next.name]}</strong> dalam <strong>${h>0?h+' jam ':''} ${m2} menit</strong> (${next.time})`;

    } catch(e){ console.log('Prayer API error:',e); document.getElementById('prayerNext').textContent='Gagal memuat jadwal. Cek koneksi internet.'; }
}
loadPrayer();

// ── Copy button
function copyText(text, id){
    navigator.clipboard.writeText(text).then(()=>{
        const t = document.getElementById('toast-'+id);
        t.style.display='block';
        setTimeout(()=>t.style.display='none', 2500);
    });
}
</script>
</body>
</html>
