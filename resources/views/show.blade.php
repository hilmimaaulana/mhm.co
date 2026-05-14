<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $product->nama }} - mhm.co</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,300&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --black: #0a0a0a;
            --white: #fafafa;
            --gray-soft: #f2f2f0;
            --gray-mid: #d4d4d0;
            --ink: #1a1a1a;
            --muted: #999;
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
            position: fixed; top: 0; left: 0;
            height: 2px; background: var(--black);
            z-index: 9999; width: 0%;
            transition: width 0.08s linear;
        }

        /* ── BACK TO TOP ── */
        #back-top {
            position: fixed; bottom: 24px; right: 24px;
            width: 40px; height: 40px;
            background: var(--black); color: var(--white);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; border: none;
            opacity: 0; transform: translateY(14px);
            transition: opacity 0.3s, transform 0.3s, background 0.2s;
            z-index: 100;
        }
        #back-top.show { opacity: 1; transform: translateY(0); }
        #back-top:hover { background: #333; }

        /* ── HEADER ── */
        #main-header { transition: transform 0.4s cubic-bezier(0.4,0,0.2,1), box-shadow 0.3s; }
        .header-hide { transform: translateY(-100%); }

        /* Logo */
        .site-logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 20px; letter-spacing: 0.15em;
            color: var(--black); text-decoration: none;
            transition: opacity 0.2s;
        }
        .site-logo:hover { opacity: 0.45; }

        /* Search reveal */
        .search-wrap { position: relative; display: flex; align-items: center; }
        .search-input-hidden {
            font-family: 'DM Mono', monospace; font-size: 11px;
            border: none; border-bottom: 1px solid var(--black); outline: none;
            background: transparent; color: var(--ink);
            width: 0; opacity: 0; padding-bottom: 2px;
            transition: width 0.35s cubic-bezier(0.4,0,0.2,1), opacity 0.3s;
        }
        .search-wrap:focus-within .search-input-hidden,
        .search-wrap:hover .search-input-hidden {
            width: 120px; opacity: 1;
        }
        .search-btn { background: none; border: none; cursor: pointer; color: var(--ink); transition: opacity 0.2s; padding: 0; display: flex; }
        .search-btn:hover { opacity: 0.4; }

        /* Auth */
        .auth-text { font-family: 'DM Mono', monospace; font-size: 10px; letter-spacing: 0.05em; color: #888; font-style: italic; }
        .auth-link { font-family: 'DM Mono', monospace; font-size: 10px; letter-spacing: 0.08em; text-decoration: none; color: var(--ink); transition: opacity 0.2s; }
        .auth-link:hover { opacity: 0.4; }
        .logout-inline { font-family: 'DM Mono', monospace; font-size: 10px; letter-spacing: 0.08em; background: none; border: none; cursor: pointer; color: var(--ink); transition: opacity 0.2s; padding: 0; }
        .logout-inline:hover { opacity: 0.4; }

        /* Cart icon */
        .cart-icon-wrap { position: relative; }
        .cart-icon-wrap a { color: var(--ink); transition: opacity 0.2s; display: flex; }
        .cart-icon-wrap a:hover { opacity: 0.4; }
        .cart-badge {
            position: absolute; top: -7px; right: -7px;
            background: var(--black); color: var(--white);
            font-family: 'DM Mono', monospace; font-size: 8px;
            width: 16px; height: 16px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 0; font-weight: 600;
        }

        /* Hamburger */
        .ham-btn { display: flex; flex-direction: column; gap: 4px; cursor: pointer; background: none; border: none; padding: 0; transition: opacity 0.2s; }
        .ham-btn:hover { opacity: 0.4; }
        .ham-line { width: 22px; height: 2px; background: var(--black); transition: transform 0.3s, opacity 0.3s; }
        .ham-line:last-child { width: 14px; }

        /* ── FADE UP ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up { opacity: 0; animation: fadeUp 0.65s cubic-bezier(0.4,0,0.2,1) forwards; }
        .d1 { animation-delay: 0.05s; }
        .d2 { animation-delay: 0.14s; }
        .d3 { animation-delay: 0.22s; }
        .d4 { animation-delay: 0.30s; }
        .d5 { animation-delay: 0.38s; }
        .d6 { animation-delay: 0.46s; }

        /* ── ALERTS ── */
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .alert-anim { animation: slideDown 0.35s ease forwards; }
        .alert-success {
            background: var(--black); color: var(--white);
            font-family: 'DM Mono', monospace; font-size: 10px;
            letter-spacing: 0.18em; text-transform: uppercase;
            padding: 12px 16px; margin-bottom: 28px;
            display: flex; justify-content: space-between; align-items: center; gap: 12px;
        }
        .alert-error {
            background: #c8281e; color: var(--white);
            font-family: 'DM Mono', monospace; font-size: 10px;
            letter-spacing: 0.18em; text-transform: uppercase;
            padding: 12px 16px; margin-bottom: 28px;
        }
        .alert-view-link {
            font-family: 'DM Mono', monospace; font-size: 10px;
            letter-spacing: 0.1em; color: var(--white);
            text-underline-offset: 3px; transition: opacity 0.2s;
            white-space: nowrap;
        }
        .alert-view-link:hover { opacity: 0.6; }

        /* ── PRODUCT LAYOUT ── */
        .product-grid {
            display: grid;
            grid-template-columns: 72px 1fr 1fr;
            gap: clamp(16px,3vw,40px);
            align-items: start;
        }
        @media (max-width: 860px) {
            .product-grid {
                grid-template-columns: 1fr 1fr;
                grid-template-rows: auto auto;
            }
            .thumb-col { display: none; } /* hide vertical thumbs on mobile */
            .main-img-col { grid-column: 1 / 2; }
            .info-col { grid-column: 2 / 3; }
        }
        @media (max-width: 600px) {
            .product-grid {
                grid-template-columns: 1fr;
            }
            .main-img-col { grid-column: 1; }
            .info-col { grid-column: 1; }
            /* show thumb row on small screens */
            .thumb-row { display: flex !important; }
        }

        /* Thumbs (vertical) */
        .thumb-col { display: flex; flex-direction: column; gap: 8px; }
        .thumb {
            width: 100%; aspect-ratio: 1;
            object-fit: contain; background: var(--gray-soft);
            padding: 6px; cursor: pointer;
            border: 1px solid #e0e0de;
            transition: border-color 0.2s, transform 0.2s;
        }
        .thumb:hover { transform: translateY(-2px); border-color: var(--black); }
        .thumb.active { border-color: var(--black); }

        /* Thumb row (mobile) */
        .thumb-row {
            display: none;
            gap: 8px; margin-top: 10px;
        }
        .thumb-row .thumb {
            width: clamp(48px,12vw,64px);
            flex-shrink: 0;
        }

        /* Main image */
        #main-img-wrap {
            width: 100%; aspect-ratio: 4/5;
            background: var(--gray-soft);
            display: flex; align-items: center; justify-content: center;
            overflow: hidden; padding: clamp(16px,4vw,32px);
        }
        #mainImage {
            width: 100%; height: 100%; object-fit: contain; mix-blend-mode: multiply;
            transition: opacity 0.25s, transform 0.55s cubic-bezier(0.4,0,0.2,1);
        }
        #mainImage.loading { opacity: 0; transform: scale(0.97); }
        #main-img-wrap:hover #mainImage:not(.loading) { transform: scale(1.05); }

        /* ── INFO COLUMN ── */
        .breadcrumb {
            font-family: 'DM Mono', monospace; font-size: 10px;
            letter-spacing: 0.08em; color: var(--muted); text-transform: lowercase;
            margin-bottom: 16px;
        }
        .breadcrumb a { color: var(--muted); text-decoration: none; transition: color 0.2s; }
        .breadcrumb a:hover { color: var(--black); }
        .breadcrumb span { margin: 0 6px; }

        .product-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(26px, 4vw, 38px);
            letter-spacing: 0.08em; font-style: italic; line-height: 1.05;
            margin-bottom: 10px;
        }
        .product-price {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(22px, 3.5vw, 30px);
            letter-spacing: 0.06em; margin-bottom: 28px;
        }

        /* Section divider */
        .info-divider { border: none; border-top: 1px solid #ebebeb; margin: 20px 0; }

        /* Size label */
        .size-label {
            font-family: 'DM Mono', monospace; font-size: 10px;
            letter-spacing: 0.18em; text-transform: uppercase; color: var(--muted);
            margin-bottom: 12px; display: block;
        }

        /* Size buttons */
        .size-grid-shoe { display: grid; grid-template-columns: repeat(7, 1fr); gap: 5px; }
        .size-grid-apparel { display: flex; flex-wrap: wrap; gap: 6px; }
        @media (max-width: 480px) {
            .size-grid-shoe { grid-template-columns: repeat(5, 1fr); }
        }
        .size-btn {
            font-family: 'DM Mono', monospace; font-size: 11px;
            height: 40px; border: 1px solid #e0e0de;
            background: var(--white); color: var(--ink);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            transition: background 0.15s, border-color 0.15s, transform 0.15s, box-shadow 0.15s;
        }
        .size-btn-apparel { min-width: 52px; padding: 0 10px; }
        .size-btn:hover { border-color: var(--black); transform: translateY(-1px); }
        .size-btn.selected { background: var(--black); color: var(--white); border-color: var(--black); box-shadow: 0 4px 12px rgba(0,0,0,0.15); }

        /* Add to cart button */
        .btn-cart {
            width: 100%;
            font-family: 'DM Mono', monospace; font-size: 11px;
            letter-spacing: 0.18em; text-transform: uppercase;
            background: var(--black); color: var(--white);
            border: none; padding: clamp(14px,3vw,18px) 20px;
            cursor: pointer; position: relative; overflow: hidden;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s, letter-spacing 0.2s;
            margin-bottom: clamp(16px,3vw,28px);
        }
        .btn-cart:hover { background: #222; box-shadow: 0 6px 20px rgba(0,0,0,0.2); letter-spacing: 0.22em; }
        .btn-cart:active { transform: scale(0.99); }

        /* Ripple */
        .ripple {
            position: absolute; border-radius: 50%;
            background: rgba(255,255,255,0.22);
            transform: scale(0);
            animation: rippleAnim 0.55s linear;
            pointer-events: none;
        }
        @keyframes rippleAnim { to { transform: scale(4); opacity: 0; } }

        /* Description */
        .desc-label {
            font-family: 'DM Mono', monospace; font-size: 10px;
            letter-spacing: 0.18em; text-transform: uppercase;
            margin-bottom: 10px; display: block;
        }
        .desc-text {
            font-size: 13px; line-height: 1.75; color: #666;
        }

        /* ── RELATED PRODUCTS ── */
        .related-section { margin-top: clamp(48px,8vw,100px); }
        .related-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(22px,4vw,32px); letter-spacing: 0.12em;
            text-align: center; margin-bottom: clamp(24px,4vw,48px);
        }
        .related-card { text-decoration: none; color: inherit; display: flex; flex-direction: column; }
        .related-thumb {
            width: 100%; aspect-ratio: 1;
            background: var(--gray-soft);
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
            transition: background 0.3s;
        }
        .related-card:hover .related-thumb { background: #eaeaea; }
        .related-img {
            width: 100%; height: 100%; object-fit: contain;
            padding: clamp(12px,3vw,24px); mix-blend-mode: multiply;
            transition: transform 0.55s cubic-bezier(0.4,0,0.2,1);
        }
        .related-card:hover .related-img { transform: scale(1.1); }
        .related-name {
            font-family: 'DM Sans', sans-serif; font-size: 11px;
            text-transform: lowercase; letter-spacing: 0.01em; color: #666;
            margin-top: 10px; text-align: center;
        }
        .related-price {
            font-family: 'DM Mono', monospace; font-size: 11px;
            font-weight: 500; text-align: center; margin-top: 4px;
        }

        /* ── SCROLL REVEAL ── */
        .reveal { opacity: 0; transform: translateY(22px); transition: opacity 0.6s ease, transform 0.6s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .stagger-item { opacity: 0; transform: translateY(14px); transition: opacity 0.45s ease, transform 0.45s ease; }
        .stagger-item.visible { opacity: 1; transform: translateY(0); }

        /* ── FOOTER ── */
        footer { background: var(--black); color: var(--white); padding: clamp(48px,8vw,80px) 0 clamp(40px,6vw,60px); margin-top: clamp(48px,8vw,80px); }
        .footer-inner {
            max-width: 1400px; margin: 0 auto;
            padding: 0 clamp(16px,5vw,40px);
            display: grid; grid-template-columns: 1fr 1fr;
            gap: clamp(32px,6vw,80px);
        }
        @media (max-width: 640px) { .footer-inner { grid-template-columns: 1fr; } }
        .footer-logo { font-family: 'Bebas Neue', sans-serif; font-size: clamp(36px,8vw,48px); letter-spacing: 0.12em; color: var(--white); display: block; margin-bottom: 16px; text-decoration: none; transition: opacity 0.2s; }
        .footer-logo:hover { opacity: 0.5; }
        .footer-desc { font-size: 13px; line-height: 1.8; color: #777; max-width: 320px; margin-bottom: 32px; }
        .footer-social-pills { display: flex; gap: 8px; margin-bottom: 20px; }
        .footer-social-pill { background: #1a1a1a; color: #666; font-family: 'DM Mono', monospace; font-size: 9px; letter-spacing: 0.1em; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; transition: background 0.2s, color 0.2s; cursor: pointer; text-decoration: none; }
        .footer-social-pill:hover { background: var(--white); color: var(--black); }
        .footer-site { font-family: 'DM Mono', monospace; font-size: 11px; letter-spacing: 0.1em; color: #555; text-decoration: underline; display: block; margin-bottom: 16px; transition: color 0.2s; cursor: pointer; }
        .footer-site:hover { color: var(--white); }
        .footer-contact { font-family: 'Bebas Neue', sans-serif; font-size: clamp(22px,4vw,30px); letter-spacing: 0.1em; color: var(--white); border-bottom: 1px solid #2a2a2a; display: inline-block; padding-bottom: 2px; cursor: pointer; transition: color 0.2s, border-color 0.2s; }
        .footer-contact:hover { color: #ccc; border-color: #555; }
        .footer-form input, .footer-form textarea { width: 100%; background: transparent; border: none; border-bottom: 1px solid #2a2a2a; padding: 12px 0; font-family: 'DM Sans', sans-serif; font-size: 13px; color: var(--white); outline: none; transition: border-color 0.3s; margin-bottom: 4px; }
        .footer-form input::placeholder, .footer-form textarea::placeholder { color: #444; }
        .footer-form input:focus, .footer-form textarea:focus { border-bottom-color: var(--white); }
        .footer-form textarea { resize: none; margin-top: 8px; }
        .footer-form .field-wrap { margin-bottom: 12px; }
        .footer-submit { background: var(--white); color: var(--black); border: none; font-family: 'DM Mono', monospace; font-size: 11px; letter-spacing: 0.12em; text-transform: uppercase; padding: 13px 40px; cursor: pointer; width: 100%; margin-top: 14px; transition: background 0.2s, transform 0.15s; }
        .footer-submit:hover { background: var(--gray-mid); transform: translateY(-1px); }
        .footer-bottom { max-width: 1400px; margin: 0 auto; padding: 0 clamp(16px,5vw,40px); margin-top: 48px; padding-top: 24px; border-top: 1px solid #1a1a1a; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px; }
        .footer-copy { font-family: 'DM Mono', monospace; font-size: 10px; letter-spacing: 0.1em; color: #3a3a3a; text-transform: uppercase; }
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
    <header id="main-header" class="w-full pt-5 pb-4 border-b border-gray-100 sticky top-0 bg-white z-50">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 md:px-10 grid grid-cols-3 items-center">

            <!-- Left: hamburger -->
            <div class="flex justify-start">
                <button class="ham-btn" aria-label="Menu">
                    <div class="ham-line"></div>
                    <div class="ham-line"></div>
                    <div class="ham-line" style="width:14px"></div>
                </button>
            </div>

            <!-- Center: logo -->
            <div class="flex justify-center">
                <a href="/" class="site-logo fade-up d1">mhm.co</a>
            </div>

            <!-- Right: search, auth, cart -->
            <div class="flex justify-end items-center gap-3 sm:gap-5 fade-up d1">

                <!-- Search -->
                <form action="{{ route('home') }}" method="GET" class="search-wrap">
                    <input type="text" name="search" placeholder="search..."
                        class="search-input-hidden" autocomplete="off">
                    <button type="submit" class="search-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>
                </form>

                <!-- Auth -->
                @auth
                    <div class="hidden sm:flex items-center gap-3">
                        <span class="auth-text">hi, {{ Auth::user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="logout-inline">logout</button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="auth-link hidden sm:inline">masuk</a>
                @endauth

                <!-- Cart -->
                <div class="cart-icon-wrap">
                    <a href="{{ route('cart.show') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </a>
                    @if(session('cart') && count(session('cart')) > 0)
                        <span class="cart-badge">{{ count(session('cart')) }}</span>
                    @endif
                </div>
            </div>
        </div>
    </header>

    <!-- MAIN -->
    <main class="max-w-[1200px] mx-auto px-4 sm:px-6 md:px-10 py-10 sm:py-16">

        @php
            $isShoe = stripos($product->nama, 'shoes') !== false ||
                      stripos($product->nama, 'vans') !== false ||
                      stripos($product->nama, 'converse') !== false;
            $isMagazine = stripos($product->nama, 'magazine') !== false ||
                          stripos($product->nama, 'majalah') !== false ||
                          stripos($product->nama, 'series') !== false ||
                          stripos($product->nama, 'zine') !== false;
        @endphp

        <!-- Alerts -->
        @if(session('success'))
            <div class="alert-anim alert-success">
                <span>{{ session('success') }}</span>
                <a href="{{ route('cart.show') }}" class="alert-view-link underline">view cart →</a>
            </div>
        @endif

        @if($errors->any() && !$isMagazine)
            <div class="alert-anim alert-error">
                {{ $isShoe ? 'Silahkan pilih ukuran sepatu terlebih dahulu!' : 'Silahkan pilih ukuran terlebih dahulu!' }}
            </div>
        @endif

        <!-- PRODUCT GRID -->
        <div class="product-grid">

            <!-- Thumbs (desktop vertical) -->
            <div class="thumb-col fade-up d1">
                <img src="{{ asset('img/' . $product->gambar) }}"
                     onclick="changeImage('{{ asset('img/' . $product->gambar) }}', this)"
                     class="thumb active" alt="{{ $product->nama }}">
                @if($product->gambar_belakang)
                <img src="{{ asset('img/' . $product->gambar_belakang) }}"
                     onclick="changeImage('{{ asset('img/' . $product->gambar_belakang) }}', this)"
                     class="thumb" alt="{{ $product->nama }} back">
                @endif
            </div>

            <!-- Main image + mobile thumbs -->
            <div class="main-img-col fade-up d2">
                <div id="main-img-wrap">
                    <img id="mainImage" src="{{ asset('img/' . $product->gambar) }}" alt="{{ $product->nama }}">
                </div>
                <!-- Thumb row for mobile -->
                <div class="thumb-row">
                    <img src="{{ asset('img/' . $product->gambar) }}"
                         onclick="changeImage('{{ asset('img/' . $product->gambar) }}', this)"
                         class="thumb active" alt="{{ $product->nama }}">
                    @if($product->gambar_belakang)
                    <img src="{{ asset('img/' . $product->gambar_belakang) }}"
                         onclick="changeImage('{{ asset('img/' . $product->gambar_belakang) }}', this)"
                         class="thumb" alt="{{ $product->nama }} back">
                    @endif
                </div>
            </div>

            <!-- Info -->
            <div class="info-col">

                <p class="breadcrumb fade-up d2">
                    <a href="/">home</a><span>/</span>{{ $product->nama }}
                </p>

                <h1 class="product-name fade-up d3">{{ $product->nama }}</h1>
                <p class="product-price fade-up d3">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>

                <hr class="info-divider fade-up d3">

                @if(!$isMagazine)
                <div class="mb-6 fade-up d4">
                    <span class="size-label">Select Size</span>

                    @if($isShoe)
                        <div class="size-grid-shoe">
                            @foreach(range(35, 48) as $size)
                            <button type="button" onclick="selectSize(this, '{{ $size }}')" class="size-btn">
                                {{ $size }}
                            </button>
                            @endforeach
                        </div>
                    @else
                        <div class="size-grid-apparel">
                            @foreach(['S', 'M', 'L', 'XL', 'XXL', 'XXXL'] as $size)
                            <button type="button" onclick="selectSize(this, '{{ $size }}')" class="size-btn size-btn-apparel">
                                {{ $size }}
                            </button>
                            @endforeach
                        </div>
                    @endif
                </div>
                @endif

                <form id="add-to-cart-form" action="{{ route('cart.add', $product->id) }}" method="POST" class="fade-up d5">
                    @csrf
                    <input type="hidden" name="size" id="selectedSize" value="{{ $isMagazine ? 'All Size' : '' }}">
                    <button type="submit" id="cart-btn" class="btn-cart">
                        Add to Shopping Cart
                    </button>
                </form>

                <div class="fade-up d6">
                    <span class="desc-label">Description</span>
                    <p class="desc-text">{{ $product->deskripsi ?? 'No description available for this product.' }}</p>
                </div>

            </div>
        </div>

        <!-- RELATED PRODUCTS -->
        <section class="related-section reveal">
            <h2 class="related-title">Related Products</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-x-5 gap-y-8">
                @foreach($relatedProducts as $related)
                <a href="{{ route('product.show', $related->id) }}" class="related-card stagger-item">
                    <div class="related-thumb">
                        <img src="{{ asset('img/' . $related->gambar) }}" class="related-img" alt="{{ $related->nama }}">
                    </div>
                    <p class="related-name">{{ $related->nama }}</p>
                    <p class="related-price">Rp {{ number_format($related->harga, 0, ',', '.') }}</p>
                </a>
                @endforeach
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <footer>
        <div class="footer-inner">
            <div>
                <a href="/" class="footer-logo">mhm.co</a>
                <p class="footer-desc">find us at the nearest offline store and also we provide various online stores such as Instagram, Telegram, TikTok, and also this website itself.</p>
                <div class="footer-social-pills">
                    <span class="footer-social-pill">ig</span>
                    <span class="footer-social-pill">tg</span>
                    <span class="footer-social-pill">tk</span>
                </div>
                <span class="footer-site">www.mhm.co</span>
                <span class="footer-contact">contact us?</span>
            </div>
            <form action="{{ route('message.send') }}" method="POST" class="footer-form flex flex-col">
                @csrf
                <div class="field-wrap"><input type="text" name="name" placeholder="name" required></div>
                <div class="field-wrap"><input type="email" name="email" placeholder="email" required></div>
                <div class="field-wrap"><textarea name="message" rows="5" placeholder="type your message here" required></textarea></div>
                <div class="flex justify-end">
                    <button type="submit" class="footer-submit">submit</button>
                </div>
            </form>
        </div>
        <div class="footer-bottom">
            <span class="footer-copy">© {{ date('Y') }} mhm.co — all rights reserved</span>
            <span class="footer-copy">{{ $product->nama }}</span>
        </div>
    </footer>

    <script>
        // Pass PHP vars to JS — UNCHANGED
        const isMagazine = {{ $isMagazine ? 'true' : 'false' }};
        const isShoe     = {{ $isShoe ? 'true' : 'false' }};

        /* ── Scroll progress + header hide + back to top ── */
        let lastScrollTop = 0;
        const header    = document.getElementById("main-header");
        const scrollBar = document.getElementById("scroll-bar");
        const backTop   = document.getElementById("back-top");
        const docH = () => document.documentElement.scrollHeight - window.innerHeight;

        window.addEventListener("scroll", function () {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            scrollBar.style.width = (scrollTop / docH() * 100) + "%";
            if (scrollTop > lastScrollTop && scrollTop > 100) header.classList.add("header-hide");
            else {
                header.classList.remove("header-hide");
                if (scrollTop > 50) header.classList.add("shadow-sm");
                else header.classList.remove("shadow-sm");
            }
            if (scrollTop > 400) backTop.classList.add("show");
            else backTop.classList.remove("show");
            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        }, false);

        /* ── changeImage — ORIGINAL LOGIC PRESERVED ── */
        function changeImage(src, clickedThumb) {
            const mainImg = document.getElementById('mainImage');
            mainImg.classList.add('loading');
            setTimeout(() => {
                mainImg.src = src;
                mainImg.classList.remove('loading');
            }, 220);
            document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
            if (clickedThumb) clickedThumb.classList.add('active');
        }

        /* ── selectSize — ORIGINAL LOGIC PRESERVED ── */
        function selectSize(btn, sizeValue) {
            document.querySelectorAll('.size-btn').forEach(b => {
                b.classList.remove('selected');
            });
            btn.classList.add('selected');
            document.getElementById('selectedSize').value = sizeValue;
        }

        /* ── Form submit validation — ORIGINAL LOGIC PRESERVED ── */
        document.getElementById('add-to-cart-form').addEventListener('submit', function (e) {
            if (!isMagazine) {
                const size = document.getElementById('selectedSize').value;
                if (!size) {
                    e.preventDefault();
                    const msg = isShoe
                        ? 'Silahkan pilih ukuran sepatu terlebih dahulu!'
                        : 'Silahkan pilih ukuran terlebih dahulu!';
                    let existingAlert = document.getElementById('size-alert');
                    if (!existingAlert) {
                        existingAlert = document.createElement('div');
                        existingAlert.id = 'size-alert';
                        existingAlert.className = 'alert-anim alert-error';
                        const main = document.querySelector('main');
                        main.insertBefore(existingAlert, main.firstChild);
                    }
                    existingAlert.textContent = msg;
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            }
        });

        /* ── Ripple — ORIGINAL LOGIC PRESERVED ── */
        document.getElementById('cart-btn').addEventListener('click', function (e) {
            const btn = this;
            const ripple = document.createElement('span');
            ripple.classList.add('ripple');
            const rect = btn.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left  = (e.clientX - rect.left  - size / 2) + 'px';
            ripple.style.top   = (e.clientY - rect.top   - size / 2) + 'px';
            btn.appendChild(ripple);
            setTimeout(() => ripple.remove(), 600);
        });

        /* ── Scroll reveal ── */
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) { entry.target.classList.add('visible'); revealObserver.unobserve(entry.target); }
            });
        }, { threshold: 0.08 });
        document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

        /* ── Stagger related ── */
        const staggerObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const siblings = entry.target.parentElement.querySelectorAll('.stagger-item');
                    siblings.forEach((el, i) => setTimeout(() => el.classList.add('visible'), i * 80));
                    staggerObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.stagger-item:first-child').forEach(el => staggerObserver.observe(el));
    </script>
</body>
</html>