<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vans Collection - mhm.co</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,300&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --black: #0a0a0a;
            --white: #fafafa;
            --gray-soft: #f2f2f0;
            --gray-mid: #d4d4d0;
            --ink: #1a1a1a;
        }

        * { box-sizing: border-box; }
        ::-webkit-scrollbar { display: none; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--white);
            color: var(--black);
            overflow-x: hidden;
        }

        /* ── SCROLL PROGRESS ── */
        #scroll-bar {
            position: fixed;
            top: 0; left: 0;
            height: 2px;
            background: var(--black);
            z-index: 9999;
            width: 0%;
            transition: width 0.08s linear;
        }

        /* ── BACK TO TOP ── */
        #back-top {
            position: fixed;
            bottom: 32px; right: 32px;
            width: 42px; height: 42px;
            background: var(--black);
            color: var(--white);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            opacity: 0;
            transform: translateY(14px);
            transition: opacity 0.3s ease, transform 0.3s ease, background 0.2s;
            z-index: 100;
            border: none;
        }
        #back-top.show { opacity: 1; transform: translateY(0); }
        #back-top:hover { background: #333; }

        /* ── MARQUEE ── */
        @keyframes marquee { from { transform: translateX(0); } to { transform: translateX(-50%); } }
        .marquee-track {
            display: flex;
            width: max-content;
            animation: marquee 20s linear infinite;
        }
        .marquee-track:hover { animation-play-state: paused; }
        .marquee-track span {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 12px;
            letter-spacing: 0.28em;
            color: var(--white);
            padding: 0 28px;
            white-space: nowrap;
        }
        .marquee-track span.dot { color: #555; padding: 0 4px; }

        /* ── HEADER ── */
        #main-header {
            transition: transform 0.4s cubic-bezier(0.4,0,0.2,1),
                        box-shadow 0.3s ease,
                        background 0.3s;
        }
        .header-hide { transform: translateY(-100%); }

        /* ── LOGO ── */
        .site-logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px;
            letter-spacing: 0.15em;
            color: var(--black);
            text-decoration: none;
            transition: opacity 0.2s;
        }
        .site-logo:hover { opacity: 0.45; }

        /* ── NAV ── */
        .nav-link {
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            letter-spacing: 0.05em;
            text-transform: lowercase;
            color: var(--ink);
            text-decoration: none;
            position: relative;
            padding-bottom: 2px;
            transition: opacity 0.2s;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -1px; left: 0;
            width: 0; height: 1px;
            background: var(--black);
            transition: width 0.3s cubic-bezier(0.4,0,0.2,1);
        }
        .nav-link:hover { opacity: 1; }
        .nav-link:hover::after { width: 100%; }
        .nav-active {
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            letter-spacing: 0.05em;
            text-transform: lowercase;
            color: var(--black);
            font-weight: 600;
            text-decoration: none;
            border-bottom: 1.5px solid var(--black);
            padding-bottom: 1px;
        }

        /* ── AUTH / ICON ── */
        .icon-btn {
            display: inline-flex; align-items: center; justify-content: center;
            color: var(--ink);
            transition: opacity 0.2s;
            text-decoration: none;
        }
        .icon-btn:hover { opacity: 0.4; }
        .auth-link {
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            letter-spacing: 0.05em;
            display: inline-flex; align-items: center; gap: 5px;
            text-decoration: none;
            color: var(--ink);
            transition: opacity 0.2s;
        }
        .auth-link:hover { opacity: 0.4; }
        .auth-greeting {
            font-family: 'DM Mono', monospace;
            font-size: 10px;
            letter-spacing: 0.05em;
            color: #888;
            font-style: italic;
        }

        /* ── SEARCH ── */
        .search-wrap { position: relative; }
        .search-input {
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            width: 280px;
            background: var(--gray-soft);
            border: 1px solid transparent;
            border-radius: 2px;
            padding: 9px 16px 9px 36px;
            letter-spacing: 0.03em;
            color: var(--ink);
            outline: none;
            transition: width 0.5s cubic-bezier(0.4,0,0.2,1),
                        background 0.3s, border-color 0.3s, box-shadow 0.3s;
        }
        .search-input::placeholder { color: #999; }
        .search-input:focus {
            width: 420px;
            background: #fff;
            border-color: var(--black);
            box-shadow: 4px 4px 0px var(--black);
        }
        .search-icon {
            position: absolute; left: 12px; top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            transition: color 0.2s;
            pointer-events: none;
        }
        .search-wrap:focus-within .search-icon { color: var(--black); }

        /* ── PAGE LOAD FADE-UP ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up { opacity: 0; animation: fadeUp 0.65s cubic-bezier(0.4,0,0.2,1) forwards; }
        .delay-1 { animation-delay: 0.05s; }
        .delay-2 { animation-delay: 0.12s; }
        .delay-3 { animation-delay: 0.20s; }
        .delay-4 { animation-delay: 0.28s; }
        .delay-5 { animation-delay: 0.36s; }

        /* ── HERO CATEGORY BANNER ── */
        .hero-cat {
            position: relative;
            height: 320px;
            overflow: hidden;
            background: var(--black);
            margin-bottom: 60px;
            display: flex;
            align-items: center;
        }
        .hero-cat-bg {
            position: absolute; inset: 0;
            background: linear-gradient(100deg, #0a0a0a 45%, #2a2520 100%);
        }
        .hero-cat-title {
            position: relative;
            z-index: 2;
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(72px, 13vw, 160px);
            letter-spacing: 0.06em;
            color: rgba(255,255,255,0.07);
            user-select: none;
            white-space: nowrap;
            padding-left: 40px;
            line-height: 1;
        }
        .hero-cat-label {
            position: absolute;
            z-index: 3;
            left: 40px;
            bottom: 36px;
        }
        .hero-cat-label h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(38px, 6vw, 72px);
            letter-spacing: 0.12em;
            color: var(--white);
            line-height: 1;
            margin: 0;
        }
        .hero-cat-label p {
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            letter-spacing: 0.2em;
            color: #777;
            margin-top: 8px;
            text-transform: uppercase;
        }
        .hero-cat-count {
            position: absolute;
            z-index: 3;
            right: 40px;
            bottom: 36px;
            font-family: 'DM Mono', monospace;
            font-size: 10px;
            letter-spacing: 0.15em;
            color: #555;
            text-transform: uppercase;
        }

        /* ── SECTION HEADING ── */
        .section-title-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: var(--black);
            margin-bottom: 24px;
        }
        .section-title-link h2 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(22px, 2.5vw, 30px);
            letter-spacing: 0.12em;
            font-style: italic;
            line-height: 1;
            transition: opacity 0.2s;
        }
        .section-title-link:hover h2 { opacity: 0.5; }
        .section-title-link .arrow-icon {
            width: 15px; height: 15px;
            transition: transform 0.3s cubic-bezier(0.4,0,0.2,1);
            flex-shrink: 0;
        }
        .section-title-link:hover .arrow-icon { transform: translateX(5px); }
        .section-dot {
            width: 5px; height: 5px;
            border-radius: 50%;
            background: var(--black);
            flex-shrink: 0;
        }

        /* ── BANNER ── */
        .banner-wrap { overflow: hidden; position: relative; }
        .banner-img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 1s cubic-bezier(0.4,0,0.2,1);
            display: block;
        }
        .banner-wrap:hover .banner-img { transform: scale(1.04); }
        .banner-overlay-text {
            position: absolute;
            bottom: 24px; left: 24px;
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(28px, 5vw, 64px);
            color: rgba(255,255,255,0.1);
            letter-spacing: 0.1em;
            pointer-events: none;
            user-select: none;
        }

        /* ── PRODUCT CARD ── */
        .product-card {
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
        }
        .product-img-box {
            width: 100%; aspect-ratio: 1;
            background: var(--gray-soft);
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
            position: relative;
            transition: background 0.3s;
        }
        .product-img-box::after {
            content: '';
            position: absolute; inset: 0;
            border: 1px solid transparent;
            transition: border-color 0.3s;
            pointer-events: none;
        }
        .product-card:hover .product-img-box { background: #eaeaea; }
        .product-card:hover .product-img-box::after { border-color: var(--gray-mid); }
        .product-img-box img {
            width: 100%; height: 100%;
            object-fit: contain;
            padding: 28px;
            mix-blend-mode: multiply;
            transition: transform 0.6s cubic-bezier(0.4,0,0.2,1);
        }
        .product-card:hover .product-img-box img { transform: scale(1.12) translateY(-3px); }
        .product-name {
            font-family: 'DM Sans', sans-serif;
            font-size: 11px;
            font-weight: 400;
            text-transform: lowercase;
            line-height: 1.5;
            color: #555;
            margin-top: 12px;
        }
        .product-price {
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            font-weight: 500;
            color: var(--black);
            margin-top: 4px;
            letter-spacing: 0.02em;
        }
        .empty-state {
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            color: #bbb;
            letter-spacing: 0.05em;
        }

        /* ── SCROLL REVEAL ── */
        .reveal {
            opacity: 0;
            transform: translateY(26px);
            transition: opacity 0.65s ease, transform 0.65s ease;
        }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        .stagger-item {
            opacity: 0;
            transform: translateY(18px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        .stagger-item.visible { opacity: 1; transform: translateY(0); }

        /* ── FOOTER ── */
        footer {
            background: var(--black);
            color: var(--white);
            padding: 80px 0 60px;
            margin-top: 60px;
        }
        .footer-inner {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 40px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
        }
        .footer-logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 48px;
            letter-spacing: 0.12em;
            color: var(--white);
            display: block;
            margin-bottom: 20px;
            text-decoration: none;
            transition: opacity 0.2s;
        }
        .footer-logo:hover { opacity: 0.5; }
        .footer-desc {
            font-size: 13px;
            line-height: 1.8;
            color: #777;
            max-width: 320px;
            margin-bottom: 36px;
        }
        .footer-social a {
            display: inline-flex; align-items: center; justify-content: center;
            width: 38px; height: 38px;
            border: 1px solid #2a2a2a;
            color: #666;
            transition: border-color 0.2s, color 0.2s;
            margin-right: 8px;
            text-decoration: none;
        }
        .footer-social a:hover { border-color: var(--white); color: var(--white); }
        .footer-site-link {
            font-family: 'DM Mono', monospace;
            font-size: 12px;
            letter-spacing: 0.1em;
            color: #555;
            text-decoration: none;
            display: block;
            margin-top: 28px;
            transition: color 0.2s;
        }
        .footer-site-link:hover { color: var(--white); }
        .footer-form input,
        .footer-form textarea {
            width: 100%;
            background: transparent;
            border: none;
            border-bottom: 1px solid #2a2a2a;
            padding: 12px 0;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            color: var(--white);
            outline: none;
            transition: border-color 0.3s;
            margin-bottom: 4px;
        }
        .footer-form input::placeholder,
        .footer-form textarea::placeholder { color: #444; }
        .footer-form input:focus,
        .footer-form textarea:focus { border-bottom-color: var(--white); }
        .footer-form textarea { resize: none; margin-top: 8px; }
        .footer-form .field-wrap { margin-bottom: 14px; }
        .footer-submit {
            background: var(--white);
            color: var(--black);
            border: none;
            font-family: 'DM Mono', monospace;
            font-size: 12px;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 14px 40px;
            cursor: pointer;
            margin-top: 16px;
            transition: background 0.2s, transform 0.15s;
        }
        .footer-submit:hover { background: var(--gray-mid); transform: translateY(-1px); }
        .footer-submit:active { transform: translateY(0); }
        .footer-bottom {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 40px;
            margin-top: 60px;
            padding-top: 28px;
            border-top: 1px solid #1a1a1a;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .footer-copy {
            font-family: 'DM Mono', monospace;
            font-size: 10px;
            letter-spacing: 0.12em;
            color: #3a3a3a;
            text-transform: uppercase;
        }

        @media (max-width: 768px) {
            .footer-inner { grid-template-columns: 1fr; gap: 48px; }
            .hero-cat-title { font-size: 72px; }
            .search-input:focus { width: 260px; }
        }
    </style>
</head>
<body>

    <div id="scroll-bar"></div>

    <button id="back-top" aria-label="Back to top" onclick="window.scrollTo({top:0,behavior:'smooth'})">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5"/>
        </svg>
    </button>

    <!-- HEADER -->
    <header id="main-header" class="w-full pt-6 pb-5 sticky top-0 bg-white z-50 border-b border-transparent transition-all duration-300">
        <div class="max-w-[1400px] mx-auto px-10">
            <div class="grid grid-cols-3 items-center mb-6">

                <div class="flex justify-start">
                    <a href="/" class="site-logo fade-up delay-1">mhm.co</a>
                </div>

                <nav class="flex justify-center gap-8">
                    <a href="{{ route('category.vans') }}" class="nav-active fade-up delay-1">vans</a>
                    <a href="{{ route('category.show', 'converse') }}" class="nav-link fade-up delay-2">converse</a>
                    <a href="{{ route('category.show', 'thrasher') }}" class="nav-link fade-up delay-3">thrasher</a>
                    <a href="{{ route('category.show', 'limited') }}" class="nav-link fade-up delay-4" style="white-space:nowrap">limited edition</a>
                </nav>

                <div class="flex justify-end items-center gap-5 fade-up delay-5">
                    @auth
                        <a href="{{ route('user.index') }}" class="icon-btn" style="gap:6px">
                            <span class="auth-greeting">hi, {{ Auth::user()->name }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="auth-link">
                            masuk
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </a>
                    @endauth
                    <a href="{{ route('cart.show') }}" class="icon-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121 0 2.118-.401 2.582-1.242l4.117-7.31c.425-.756-.122-1.692-1.026-1.692H5.156M7.5 14.25 5.85 21.435m11.15-7.185 1.65 7.185m-10.8-1.875a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0ZM18 19.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="flex justify-center fade-up delay-5">
                <form action="{{ route('product.search') }}" method="GET" class="search-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 search-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    <input
                        name="search"
                        id="product-search"
                        type="text"
                        placeholder="search product (e.g. vans, hoodie, shoes...)"
                        class="search-input"
                    >
                </form>
            </div>
        </div>
    </header>

    <!-- MARQUEE -->
    <div style="overflow:hidden;background:var(--black);padding:10px 0">
        <div class="marquee-track">
            <span>VANS AUTHENTIC</span><span class="dot">·</span>
            <span>VANS CLASSIC</span><span class="dot">·</span>
            <span>VANS ERA</span><span class="dot">·</span>
            <span>VANS SKATE &amp; </span><span class="dot">·</span>
            <span>VANS KNU SKOOL</span><span class="dot">·</span>
            <span>VANS COLLABORATION</span><span class="dot">·</span>
            <span>VANS AUTHENTIC</span><span class="dot">·</span>
            <span>VANS CLASSIC</span><span class="dot">·</span>
            <span>VANS ERA</span><span class="dot">·</span>
            <span>VANS SKATE &amp; </span><span class="dot">·</span>
            <span>VANS KNU SKOOL</span><span class="dot">·</span>
            <span>VANS COLLABORATION</span><span class="dot">·</span>
        </div>
    </div>

    <!-- HERO CATEGORY BANNER -->
    <div class="hero-cat fade-up delay-2">
        <div class="hero-cat-bg"></div>
        <div class="hero-cat-title">VANS</div>
        <div class="hero-cat-label">
            <h1>VANS</h1>
            <p>since 1966 — skate culture &amp; beyond</p>
        </div>
        <div class="hero-cat-count">mhm.co / collections</div>
    </div>

    <main class="max-w-[1400px] mx-auto px-10">

        @php
            $sections = [
                ['title' => 'vans authentic', 'slug' => 'vans authentic', 'data' => $vansAuthentic, 'banner' => 'full', 'banner_file' => $bannerTop],
                ['title' => 'vans classic', 'slug' => 'vans classic', 'data' => $vansClassic, 'banner' => 'split', 'banner_file' => [$bannerSplitLeft, $bannerSplitRight]],
                ['title' => 'vans era', 'slug' => 'vans era', 'data' => $vansEra, 'banner' => 'none', 'banner_file' => ''],
                ['title' => 'vans skate & sk8-hi', 'slug' => 'vans skate', 'data' => $vansSkate, 'banner' => 'full', 'banner_file' => $bannerBottom],
                ['title' => 'vans knu skool', 'slug' => 'vans knu', 'data' => $vansKnu, 'banner' => 'split', 'banner_file' => [$bannerSplitLeft2, $bannerSplitRight2]],
                ['title' => 'vans collaboration', 'slug' => 'collab', 'data' => $vansCollab, 'banner' => 'none', 'banner_file' => ''],
            ];
        @endphp

        @foreach($sections as $section)

            @if($section['banner'] == 'full')
                <div class="banner-wrap reveal" style="width:100%;height:420px;margin-bottom:56px">
                    <img src="{{ asset('img/' . $section['banner_file']) }}" class="banner-img" alt="">
                    <span class="banner-overlay-text">{{ strtoupper($section['title']) }}</span>
                </div>

            @elseif($section['banner'] == 'split')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-[6px] reveal" style="margin-bottom:56px">
                    <div class="banner-wrap" style="height:360px">
                        <img src="{{ asset('img/' . $section['banner_file'][0]) }}" class="banner-img" alt="">
                    </div>
                    <div class="banner-wrap" style="height:360px">
                        <img src="{{ asset('img/' . $section['banner_file'][1]) }}" class="banner-img" alt="">
                    </div>
                </div>
            @endif

            <section style="margin-bottom:80px">
                <div class="reveal">
                    <a href="{{ route('category.show', $section['slug']) }}" class="section-title-link">
                        <span class="section-dot"></span>
                        <h2>{{ $section['title'] }}</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="arrow-icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-x-5 gap-y-10">
                    @forelse($section['data'] as $product)
                    <a href="{{ route('product.show', $product->id) }}" class="product-card stagger-item">
                        <div class="product-img-box">
                            <img src="{{ asset('img/' . $product->gambar) }}" alt="{{ $product->nama }}">
                        </div>
                        <p class="product-name">{{ $product->nama }}</p>
                        <p class="product-price">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                    </a>
                    @empty
                    <p class="empty-state">no items found.</p>
                    @endforelse
                </div>
            </section>

        @endforeach
    </main>

    <!-- FOOTER -->
    <footer>
        <div class="footer-inner">
            <div>
                <a href="/" class="footer-logo">mhm.co</a>
                <p class="footer-desc">find us at the nearest offline store and also we provide various online stores such as instagram, telegram, and tiktok.</p>

                <div class="footer-social flex">
                    <a href="https://www.instagram.com/hilmimaaulana/" target="_blank" aria-label="Instagram">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.332 3.608 1.308.975.975 1.247 2.242 1.308 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.062 1.366-.332 2.633-1.308 3.608-.975.975-2.242 1.247-3.608 1.308-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.062-2.633-.332-3.608-1.308-.975-.975-1.247-2.242-1.308-3.608-.058-1.266-.07-1.646-.07-4.85s.012-3.584.07-4.85c.062-1.366.332-2.633 1.308-3.608.975-.975 2.242-1.247 3.608-1.308 1.266-.058 1.646-.07 4.85-.07zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c.796 0 1.441.645 1.441 1.44s-.645 1.44-1.441 1.44c-.795 0-1.439-.645-1.439-1.44s.644-1.44 1.439-1.44z"/></svg>
                    </a>
                    <a href="URL_TELEGRAM_DISINI" target="_blank" aria-label="Telegram">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5.891 8.146l-2.003 9.464c-.149.659-.541.823-1.091.515l-3.051-2.251-1.472 1.417c-.163.163-.3.298-.614.298l.218-3.102 5.645-5.101c.246-.219-.054-.341-.381-.123l-6.979 4.4z"/></svg>
                    </a>
                    <a href="https://www.tiktok.com/@hhhhhh.232323" target="_blank" aria-label="TikTok">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 448 512"><path d="M448 209.91a210.06 210.06 0 0 1-122.77-39.25V349.38A162.55 162.55 0 1 1 185 188.31V278.2a74.62 74.62 0 1 0 52.23 71.18V0l88 0a121.18 121.18 0 0 0 1.86 22.17h0A122.18 122.18 0 0 0 381 102.39a121.43 121.43 0 0 0 67 20.14Z"/></svg>
                    </a>
                </div>

                <a href="/" class="footer-site-link">www.mhm.co</a>
            </div>

            <form action="{{ route('message.send') }}" method="POST" class="footer-form flex flex-col">
                @csrf
                <div class="field-wrap">
                    <input type="text" name="name" placeholder="name" required>
                </div>
                <div class="field-wrap">
                    <input type="email" name="email" placeholder="email" required>
                </div>
                <div class="field-wrap">
                    <textarea name="message" rows="5" placeholder="message" required></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="footer-submit">submit</button>
                </div>
            </form>
        </div>

        <div class="footer-bottom">
            <span class="footer-copy">© 2025 mhm.co — all rights reserved</span>
            <span class="footer-copy">vans collection</span>
        </div>
    </footer>

    <script>
        // ── SCROLL PROGRESS + HEADER HIDE + BACK TO TOP ──
        let lastScrollTop = 0;
        const header   = document.getElementById("main-header");
        const scrollBar = document.getElementById("scroll-bar");
        const backTop  = document.getElementById("back-top");
        const docH = () => document.documentElement.scrollHeight - window.innerHeight;

        window.addEventListener("scroll", function () {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            scrollBar.style.width = (scrollTop / docH() * 100) + "%";

            if (scrollTop > lastScrollTop && scrollTop > 100) {
                header.classList.add("header-hide");
            } else {
                header.classList.remove("header-hide");
                if (scrollTop > 50) header.classList.add("border-gray-100", "shadow-sm");
                else header.classList.remove("border-gray-100", "shadow-sm");
            }

            if (scrollTop > 400) backTop.classList.add("show");
            else backTop.classList.remove("show");

            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        }, false);

        // ── SCROLL REVEAL ──
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08 });
        document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

        // ── STAGGER CARDS ──
        const staggerObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const siblings = entry.target.parentElement.querySelectorAll('.stagger-item');
                    siblings.forEach((el, i) => {
                        setTimeout(() => el.classList.add('visible'), i * 70);
                    });
                    staggerObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.stagger-item:first-child').forEach(el => staggerObserver.observe(el));
    </script>
</body>
</html>