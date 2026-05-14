<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mhm.co</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,300&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --black: #0a0a0a;
            --white: #fafafa;
            --gray-soft: #f2f2f0;
            --gray-mid: #d4d4d0;
            --accent: #e8e0d0;
            --ink: #1a1a1a;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: var(--white);
            color: var(--black);
            antialiased: true;
            overflow-x: hidden;
        }

        /* ── PAGE LOAD CURTAIN ── */
        #curtain {
            position: fixed;
            inset: 0;
            background: var(--black);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: curtainDrop 0.7s cubic-bezier(0.77, 0, 0.18, 1) 1.2s forwards;
        }
        #curtain .logo-reveal {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(3rem, 10vw, 7rem);
            color: var(--white);
            letter-spacing: 0.12em;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeUp 0.6s ease 0.2s forwards;
        }
        @keyframes curtainDrop {
            to { transform: translateY(-100%); }
        }
        @keyframes fadeUp {
            to { opacity: 1; transform: translateY(0); }
        }

        /* ── HEADER ── */
        #main-header {
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1),
                        box-shadow 0.3s ease,
                        background 0.3s ease;
        }
        .header-hide { transform: translateY(-100%); }

        .nav-link {
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            letter-spacing: 0.05em;
            text-transform: lowercase;
            position: relative;
            color: var(--ink);
            text-decoration: none;
            padding-bottom: 2px;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 0;
            height: 1px;
            background: var(--black);
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .nav-link:hover::after { width: 100%; }

        /* ── SITE LOGO ── */
        .site-logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px;
            letter-spacing: 0.15em;
            text-decoration: none;
            color: var(--black);
            transition: opacity 0.2s;
        }
        .site-logo:hover { opacity: 0.5; }

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
            transition: width 0.5s cubic-bezier(0.4, 0, 0.2, 1),
                        background 0.3s,
                        border-color 0.3s,
                        box-shadow 0.3s;
        }
        .search-input::placeholder { color: #999; }
        .search-input:focus {
            width: 420px;
            background: #fff;
            border-color: var(--black);
            box-shadow: 4px 4px 0px var(--black);
        }
        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            transition: color 0.2s;
            pointer-events: none;
        }
        .search-wrap:focus-within .search-icon { color: var(--black); }

        /* ── HERO GRID ── */
        .hero-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6px;
            margin-bottom: 80px;
        }
        .hero-img-wrap {
            overflow: hidden;
            position: relative;
        }
        .hero-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.9s cubic-bezier(0.4, 0, 0.2, 1);
            display: block;
        }
        .hero-img-wrap:hover img { transform: scale(1.04); }

        /* Overlay badge */
        .hero-img-wrap .badge {
            position: absolute;
            bottom: 20px;
            left: 20px;
            background: rgba(10,10,10,0.85);
            color: #fff;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 13px;
            letter-spacing: 0.2em;
            padding: 6px 14px;
            opacity: 0;
            transform: translateY(6px);
            transition: opacity 0.3s, transform 0.3s;
        }
        .hero-img-wrap:hover .badge {
            opacity: 1;
            transform: translateY(0);
        }

        /* ── SECTION HEADINGS ── */
        .section-title-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: var(--black);
            margin-bottom: 28px;
        }
        .section-title-link h2 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(26px, 3vw, 36px);
            letter-spacing: 0.1em;
            line-height: 1;
            transition: opacity 0.2s;
        }
        .section-title-link:hover h2 { opacity: 0.5; }
        .section-title-link .arrow-icon {
            width: 18px;
            height: 18px;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            flex-shrink: 0;
        }
        .section-title-link:hover .arrow-icon { transform: translateX(6px); }

        /* ── PRODUCT CARD ── */
        .product-card {
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
        }
        .product-img-box {
            width: 100%;
            aspect-ratio: 1;
            background: var(--gray-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
            transition: background 0.3s;
        }
        .product-img-box::after {
            content: '';
            position: absolute;
            inset: 0;
            border: 1px solid transparent;
            transition: border-color 0.3s;
        }
        .product-card:hover .product-img-box {
            background: #ebebeb;
        }
        .product-card:hover .product-img-box::after {
            border-color: var(--gray-mid);
        }
        .product-img-box img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 28px;
            mix-blend-mode: multiply;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .product-card:hover .product-img-box img {
            transform: scale(1.1) translateY(-3px);
        }
        .product-info { margin-top: 14px; }
        .product-name {
            font-family: 'DM Sans', sans-serif;
            font-size: 11px;
            font-weight: 400;
            text-transform: lowercase;
            letter-spacing: 0.01em;
            line-height: 1.5;
            color: #555;
        }
        .product-price {
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            font-weight: 500;
            margin-top: 5px;
            color: var(--black);
            letter-spacing: 0.02em;
        }

        /* ── FULL-WIDTH BANNER ── */
        .banner-full {
            width: 100%;
            height: 420px;
            overflow: hidden;
            margin-bottom: 64px;
            position: relative;
        }
        .banner-full img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 1.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .banner-full:hover img { transform: scale(1.03); }
        .banner-full .banner-label {
            position: absolute;
            top: 50%;
            left: 60px;
            transform: translateY(-50%);
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(40px, 7vw, 90px);
            color: rgba(255,255,255,0.15);
            letter-spacing: 0.1em;
            pointer-events: none;
            user-select: none;
        }

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
            font-size: 52px;
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
            color: #888;
            max-width: 320px;
            margin-bottom: 40px;
        }
        .footer-social a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border: 1px solid #333;
            color: #888;
            transition: border-color 0.2s, color 0.2s, background 0.2s;
            margin-right: 8px;
        }
        .footer-social a:hover {
            border-color: var(--white);
            color: var(--white);
        }
        .footer-contact {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            letter-spacing: 0.08em;
            color: var(--white);
            text-decoration: none;
            display: inline-block;
            margin-top: 32px;
            padding-bottom: 3px;
            border-bottom: 1px solid #333;
            transition: border-color 0.2s, color 0.2s;
        }
        .footer-contact:hover {
            color: #ccc;
            border-color: #666;
        }
        .footer-form input,
        .footer-form textarea {
            width: 100%;
            background: transparent;
            border: none;
            border-bottom: 1px solid #333;
            padding: 12px 0;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            color: var(--white);
            outline: none;
            transition: border-color 0.3s;
            margin-bottom: 4px;
        }
        .footer-form input::placeholder,
        .footer-form textarea::placeholder { color: #555; }
        .footer-form input:focus,
        .footer-form textarea:focus { border-bottom-color: var(--white); }
        .footer-form textarea { resize: none; margin-top: 8px; }
        .footer-form .field-wrap { margin-bottom: 16px; }
        .footer-submit {
            background: var(--white);
            color: var(--black);
            border: none;
            font-family: 'DM Mono', monospace;
            font-size: 12px;
            letter-spacing: 0.1em;
            text-transform: lowercase;
            padding: 14px 40px;
            cursor: pointer;
            margin-top: 16px;
            transition: background 0.2s, color 0.2s, transform 0.15s;
        }
        .footer-submit:hover {
            background: var(--gray-mid);
            transform: translateY(-1px);
        }
        .footer-submit:active { transform: translateY(0); }

        /* ── SCROLL REVEAL ── */
        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.7s cubic-bezier(0.4,0,0.2,1),
                        transform 0.7s cubic-bezier(0.4,0,0.2,1);
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Stagger children */
        .stagger-children > * {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s cubic-bezier(0.4,0,0.2,1),
                        transform 0.5s cubic-bezier(0.4,0,0.2,1);
        }
        .stagger-children.visible > *:nth-child(1)  { opacity:1; transform:none; transition-delay: 0.05s; }
        .stagger-children.visible > *:nth-child(2)  { opacity:1; transform:none; transition-delay: 0.10s; }
        .stagger-children.visible > *:nth-child(3)  { opacity:1; transform:none; transition-delay: 0.15s; }
        .stagger-children.visible > *:nth-child(4)  { opacity:1; transform:none; transition-delay: 0.20s; }
        .stagger-children.visible > *:nth-child(5)  { opacity:1; transform:none; transition-delay: 0.25s; }
        .stagger-children.visible > *:nth-child(6)  { opacity:1; transform:none; transition-delay: 0.30s; }
        .stagger-children.visible > *:nth-child(7)  { opacity:1; transform:none; transition-delay: 0.35s; }
        .stagger-children.visible > *:nth-child(8)  { opacity:1; transform:none; transition-delay: 0.40s; }
        .stagger-children.visible > *:nth-child(9)  { opacity:1; transform:none; transition-delay: 0.45s; }
        .stagger-children.visible > *:nth-child(10) { opacity:1; transform:none; transition-delay: 0.50s; }

        /* ── MARQUEE TICKER ── */
        .marquee-wrap {
            overflow: hidden;
            background: var(--black);
            padding: 10px 0;
            margin-bottom: 0;
        }
        .marquee-track {
            display: flex;
            width: max-content;
            animation: marqueeScroll 22s linear infinite;
        }
        .marquee-track span {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 13px;
            letter-spacing: 0.25em;
            color: var(--white);
            padding: 0 32px;
            white-space: nowrap;
        }
        .marquee-track span.dot {
            color: #555;
            padding: 0 4px;
        }
        @keyframes marqueeScroll {
            from { transform: translateX(0); }
            to   { transform: translateX(-50%); }
        }

        /* ── "OTHER COLLECTIONS" divider ── */
        .divider-line {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 20px;
            margin-bottom: 32px;
        }
        .divider-line::before,
        .divider-line::after {
            content: '';
            height: 1px;
            background: var(--gray-mid);
        }
        .divider-line span {
            font-family: 'DM Mono', monospace;
            font-size: 10px;
            letter-spacing: 0.2em;
            color: #aaa;
            text-transform: uppercase;
            white-space: nowrap;
        }

        /* ── EMPTY STATE ── */
        .empty-state {
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            color: #bbb;
            letter-spacing: 0.05em;
        }

        /* ── ICON BUTTONS ── */
        .icon-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--ink);
            transition: opacity 0.2s;
        }
        .icon-btn:hover { opacity: 0.4; }

        /* ── AUTH LINK ── */
        .auth-link {
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            letter-spacing: 0.05em;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            color: var(--ink);
            transition: opacity 0.2s;
        }
        .auth-link:hover { opacity: 0.4; }

        /* Success banner */
        .success-bar {
            background: var(--white);
            color: var(--black);
            padding: 8px 16px;
            font-family: 'DM Mono', monospace;
            font-size: 10px;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            text-align: center;
            border: 1px solid var(--gray-mid);
            margin-bottom: 16px;
        }

        @media (max-width: 768px) {
            .hero-grid { grid-template-columns: 1fr; }
            .footer-inner { grid-template-columns: 1fr; gap: 48px; }
            .search-input:focus { width: 260px; }
        }
    </style>
</head>
<body>

    <!-- PAGE LOAD CURTAIN -->
    <div id="curtain">
        <span class="logo-reveal">mhm.co</span>
    </div>

    <!-- MARQUEE TICKER -->
    <div class="marquee-wrap">
        <div class="marquee-track" id="marquee-track">
            <span>VANS</span><span class="dot">·</span>
            <span>CONVERSE</span><span class="dot">·</span>
            <span>THRASHER</span><span class="dot">·</span>
            <span>LIMITED EDITION</span><span class="dot">·</span>
            <span>SKATEBOARD CULTURE</span><span class="dot">·</span>
            <span>STREET WEAR</span><span class="dot">·</span>
            <span>MHM.CO</span><span class="dot">·</span>
            <!-- duplicate for seamless loop -->
            <span>VANS</span><span class="dot">·</span>
            <span>CONVERSE</span><span class="dot">·</span>
            <span>THRASHER</span><span class="dot">·</span>
            <span>LIMITED EDITION</span><span class="dot">·</span>
            <span>SKATEBOARD CULTURE</span><span class="dot">·</span>
            <span>STREET WEAR</span><span class="dot">·</span>
            <span>MHM.CO</span><span class="dot">·</span>
        </div>
    </div>

    <!-- HEADER -->
    <header id="main-header" class="w-full pt-6 pb-5 sticky top-0 bg-white z-50 border-b border-transparent transition-all duration-300">
        <div class="max-w-[1400px] mx-auto px-10">
            <div class="grid grid-cols-3 items-center mb-6">
                <div class="flex justify-start">
                    <a href="/" class="site-logo">mhm.co</a>
                </div>

                {{-- NAVBAR --}}
                <div class="flex justify-center gap-8">
                    <a href="{{ route('category.show', 'vans') }}" class="nav-link">vans</a>
                    <a href="{{ route('category.show', 'converse') }}" class="nav-link">converse</a>
                    <a href="{{ route('category.show', 'thrasher') }}" class="nav-link">thrasher</a>
                    <a href="{{ route('limited.soon') }}" class="nav-link" style="white-space:nowrap">limited edition</a>
                </div>

                <div class="flex justify-end items-center gap-5">
                    @auth
                        <a href="{{ route('user.orders') }}" class="icon-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </a>
                    @else
                        <a href="/login" class="auth-link">
                            masuk
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </a>
                    @endauth

                    <a href="/cart" class="icon-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121 0 2.118-.401 2.582-1.242l4.117-7.31c.425-.756-.122-1.692-1.026-1.692H5.156M7.5 14.25 5.85 21.435m11.15-7.185 1.65 7.185m-10.8-1.875a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0ZM18 19.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="flex justify-center">
                <form action="{{ route('search') }}" method="GET" class="search-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 search-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    <input
                        id="product-search"
                        name="search"
                        type="text"
                        placeholder="search product (e.g. vans, hoodie, shoes...)"
                        value="{{ request('search') }}"
                        class="search-input"
                    >
                </form>
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="max-w-[1400px] mx-auto px-10 mt-10">

        <!-- HERO GRID -->
        <div class="hero-grid reveal mb-16">
            <div class="hero-img-wrap" style="height:460px">
                <img src="{{ asset('img/vans01.jpg') }}" alt="Vans">
                <span class="badge">VANS COLLECTION</span>
            </div>
            <div class="hero-img-wrap" style="height:460px">
                <img src="{{ asset('img/vansbanner1.jpg') }}" alt="Banner">
                <span class="badge">NEW ARRIVALS</span>
            </div>
        </div>

        @php
            $vans = $products->filter(fn($i) => stripos($i->nama, 'vans') !== false);
            $converse = $products->filter(fn($i) => stripos($i->nama, 'converse') !== false);
            $thrasher = $products->filter(fn($i) => stripos($i->nama, 'thrasher') !== false);
            $others = $products->reject(function ($item) {
                return stripos($item->nama, 'vans') !== false ||
                       stripos($item->nama, 'converse') !== false ||
                       stripos($item->nama, 'thrasher') !== false;
            });
        @endphp

        <!-- VANS SECTION -->
        <section class="mb-20">
            <div class="reveal">
                <a href="{{ route('category.show', 'vans') }}" class="section-title-link">
                    <h2>Vans Shoes</h2>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="arrow-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-x-5 gap-y-10 stagger-children">
                @forelse($vans as $item)
                <a href="{{ route('product.show', $item->id) }}" class="product-card">
                    <div class="product-img-box">
                        <img src="{{ asset('img/' . $item->gambar) }}" alt="{{ $item->nama }}">
                    </div>
                    <div class="product-info">
                        <p class="product-name">{{ $item->nama }}</p>
                        <p class="product-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                    </div>
                </a>
                @empty
                <p class="empty-state">no vans products yet.</p>
                @endforelse
            </div>
        </section>

        <!-- BANNER 1 -->
        <div class="banner-full reveal">
            <img src="{{ asset('img/banner3.jpg') }}" alt="Banner">
            <span class="banner-label">STREET</span>
        </div>

        <!-- CONVERSE SECTION -->
        <section class="mb-20">
            <div class="reveal">
                <a href="{{ route('category.show', 'converse') }}" class="section-title-link">
                    <h2>Converse Shoes</h2>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="arrow-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-x-5 gap-y-10 stagger-children">
                @forelse($converse as $item)
                <a href="{{ route('product.show', $item->id) }}" class="product-card">
                    <div class="product-img-box">
                        <img src="{{ asset('img/' . $item->gambar) }}" alt="{{ $item->nama }}">
                    </div>
                    <div class="product-info">
                        <p class="product-name">{{ $item->nama }}</p>
                        <p class="product-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                    </div>
                </a>
                @empty
                <p class="empty-state">no converse products yet.</p>
                @endforelse
            </div>
        </section>

        <!-- BANNER 2 -->
        <div class="banner-full reveal">
            <img src="{{ asset('img/thrasherbanner4.jpg') }}" alt="Thrasher Banner">
            <span class="banner-label">THRASHER</span>
        </div>

        <!-- THRASHER SECTION -->
        <section class="mb-24">
            <div class="reveal">
                <a href="{{ route('category.show', 'thrasher') }}" class="section-title-link">
                    <h2>Thrasher</h2>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="arrow-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-x-5 gap-y-10 stagger-children">
                @forelse($thrasher as $item)
                <a href="{{ route('product.show', $item->id) }}" class="product-card">
                    <div class="product-img-box">
                        <img src="{{ asset('img/' . $item->gambar) }}" alt="{{ $item->nama }}">
                    </div>
                    <div class="product-info">
                        <p class="product-name">{{ $item->nama }}</p>
                        <p class="product-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                    </div>
                </a>
                @empty
                <p class="empty-state">no thrasher products yet.</p>
                @endforelse
            </div>
        </section>

        <!-- OTHER COLLECTIONS -->
        <section class="mb-24">
            <div class="reveal divider-line">
                <span></span>
                <span>other collections</span>
                <span></span>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-x-5 gap-y-10 stagger-children">
                @forelse($others as $item)
                <a href="{{ route('product.show', $item->id) }}" class="product-card">
                    <div class="product-img-box">
                        <img src="{{ asset('img/' . $item->gambar) }}" alt="{{ $item->nama }}">
                    </div>
                    <div class="product-info">
                        <p class="product-name">{{ $item->nama }}</p>
                        <p class="product-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                    </div>
                </a>
                @empty
                <p class="empty-state">no other products found.</p>
                @endforelse
            </div>
        </section>

    </main>

    <!-- FOOTER -->
    <footer>
        <div class="footer-inner">
            <div>
                <a href="/" class="footer-logo">mhm.co</a>
                <p class="footer-desc">find us at the nearest offline store and also we provide various online stores such as instagram, telegram, and tiktok.</p>

                <div class="footer-social flex">
                    <a href="https://www.instagram.com/hilmimaaulana" target="_blank" aria-label="Instagram">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.332 3.608 1.308.975.975 1.247 2.242 1.308 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.062 1.366-.332 2.633-1.308 3.608-.975.975-2.242 1.247-3.608 1.308-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.062-2.633-.332-3.608-1.308-.975-.975-1.247-2.242-1.308-3.608-.058-1.266-.07-1.646-.07-4.85s.012-3.584.07-4.85c.062-1.366.332-2.633 1.308-3.608.975-.975 2.242-1.247 3.608-1.308 1.266-.058 1.646-.07 4.85-.07zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c.796 0 1.441.645 1.441 1.44s-.645 1.44-1.441 1.44c-.795 0-1.439-.645-1.439-1.44s.644-1.44 1.439-1.44z"/></svg>
                    </a>
                    <a href="https://t.me/@B444tozar" target="_blank" aria-label="Telegram">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5.891 8.146l-2.003 9.464c-.149.659-.541.823-1.091.515l-3.051-2.251-1.472 1.417c-.163.163-.3.298-.614.298l.218-3.102 5.645-5.101c.246-.219-.054-.341-.381-.123l-6.979 4.4z"/></svg>
                    </a>
                    <a href="https://www.tiktok.com/@hhhhhh.232323" target="_blank" aria-label="TikTok">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 448 512"><path d="M448 209.91a210.06 210.06 0 0 1-122.77-39.25V349.38A162.55 162.55 0 1 1 185 188.31V278.2a74.62 74.62 0 1 0 52.23 71.18V0l88 0a121.18 121.18 0 0 0 1.86 22.17h0A122.18 122.18 0 0 0 381 102.39a121.43 121.43 0 0 0 67 20.14Z"/></svg>
                    </a>
                </div>

                <a href="https://wa.me/6285727829063" target="_blank" class="footer-contact">contact us →</a>
            </div>

            <form action="{{ route('message.send') }}" method="POST" class="footer-form flex flex-col">
                @csrf
                @if(session('success'))
                    <div class="success-bar">{{ session('success') }}</div>
                @endif
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

        <div class="max-w-[1400px] mx-auto px-10 mt-16 pt-8 border-t border-[#1e1e1e] flex justify-between items-center">
            <span style="font-family:'DM Mono',monospace;font-size:10px;color:#444;letter-spacing:0.1em">© 2025 MHM.CO — ALL RIGHTS RESERVED</span>
            <a href="/" style="font-family:'DM Mono',monospace;font-size:10px;color:#444;letter-spacing:0.1em;text-decoration:none">www.mhm.co</a>
        </div>
    </footer>

    <script>
        // ── REMOVE CURTAIN AFTER ANIMATION ──
        setTimeout(() => {
            const curtain = document.getElementById('curtain');
            if (curtain) curtain.remove();
        }, 2200);

        // ── SCROLL HIDE/SHOW HEADER ──
        let lastScrollTop = 0;
        const header = document.getElementById("main-header");
        window.addEventListener("scroll", function () {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            if (scrollTop > lastScrollTop && scrollTop > 100) {
                header.classList.add("header-hide");
            } else {
                header.classList.remove("header-hide");
                if (scrollTop > 50) header.classList.add("border-gray-100", "shadow-sm");
                else header.classList.remove("border-gray-100", "shadow-sm");
            }
            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        }, false);

        // ── INTERSECTION OBSERVER — SCROLL REVEAL ──
        const revealEls = document.querySelectorAll('.reveal, .stagger-children');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

        revealEls.forEach(el => observer.observe(el));

        // ── SEARCH — preserve original routing logic ──
        const searchInput = document.getElementById('product-search');
        searchInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const query = this.value.toLowerCase().trim();
                if (query.length > 0) {
                    if (query === 'vans')         { window.location.href = "{{ route('category.show', 'vans') }}"; }
                    else if (query === 'converse') { window.location.href = "{{ route('category.show', 'converse') }}"; }
                    else if (query === 'thrasher') { window.location.href = "{{ route('category.show', 'thrasher') }}"; }
                    else { this.closest('form').submit(); }
                }
            }
        });
    </script>
</body>
</html>