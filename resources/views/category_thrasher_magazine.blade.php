<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thrasher Magazine - mhm.co</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,300&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --black: #0a0a0a;
            --white: #fafafa;
            --gray-soft: #f2f2f0;
            --gray-mid: #d4d4d0;
            --ink: #1a1a1a;
            --red: #c8281e;
        }

        * { box-sizing: border-box; }
        ::-webkit-scrollbar { display: none; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--white);
            color: var(--black);
            overflow-x: hidden;
        }

        /* ── SCROLL PROGRESS — red for Thrasher ── */
        #scroll-bar {
            position: fixed; top: 0; left: 0;
            height: 2px; background: var(--red);
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
        #main-header { transition: transform 0.3s ease-in-out, box-shadow 0.3s; }
        .header-hide { transform: translateY(-100%); }

        /* ── LOGO ── */
        .site-logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 20px; letter-spacing: 0.15em;
            color: var(--black); text-decoration: none;
            transition: opacity 0.2s;
        }
        .site-logo:hover { opacity: 0.45; }

        /* ── BACK LINK ── */
        .back-link {
            font-family: 'DM Mono', monospace;
            font-size: 10px; letter-spacing: 0.15em; text-transform: uppercase;
            color: var(--ink); text-decoration: none;
            display: inline-flex; align-items: center; gap: 6px;
            transition: opacity 0.2s; white-space: nowrap;
        }
        .back-link:hover { opacity: 0.4; }
        .back-link svg { transition: transform 0.25s cubic-bezier(0.4,0,0.2,1); flex-shrink: 0; }
        .back-link:hover svg { transform: translateX(-3px); }

        /* ── AUTH / ICONS ── */
        .icon-btn {
            display: inline-flex; align-items: center; justify-content: center;
            color: var(--ink); transition: opacity 0.2s; text-decoration: none; flex-shrink: 0;
        }
        .icon-btn:hover { opacity: 0.4; }
        .auth-link {
            font-family: 'DM Mono', monospace; font-size: 10px; letter-spacing: 0.05em;
            display: inline-flex; align-items: center; gap: 4px;
            text-decoration: none; color: var(--ink); transition: opacity 0.2s; white-space: nowrap;
        }
        .auth-link:hover { opacity: 0.4; }
        .auth-name {
            font-family: 'DM Mono', monospace; font-size: 10px;
            letter-spacing: 0.03em; color: #888;
        }

        /* ── SEARCH ── */
        .search-wrap { position: relative; width: 100%; max-width: 340px; }
        .search-input {
            font-family: 'DM Mono', monospace; font-size: 11px;
            width: 100%; background: var(--gray-soft);
            border: 1px solid transparent; border-radius: 2px;
            padding: 8px 14px 8px 34px; letter-spacing: 0.03em; color: var(--ink);
            outline: none;
            transition: background 0.3s, border-color 0.3s, box-shadow 0.3s;
        }
        .search-input::placeholder { color: #999; }
        .search-input:focus {
            background: #fff;
            border-color: var(--black);
            box-shadow: 4px 4px 0px var(--black);
        }
        .search-icon {
            position: absolute; left: 11px; top: 50%; transform: translateY(-50%);
            color: #aaa; transition: color 0.2s; pointer-events: none;
        }
        .search-wrap:focus-within .search-icon { color: var(--black); }

        /* ── PAGE LOAD FADE ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up { opacity: 0; animation: fadeUp 0.6s cubic-bezier(0.4,0,0.2,1) forwards; }
        .delay-1 { animation-delay: 0.05s; }
        .delay-2 { animation-delay: 0.14s; }
        .delay-3 { animation-delay: 0.22s; }

        /* ── HERO BANNER — dark with red accent for Thrasher ── */
        .hero-banner-wrap {
            position: relative; overflow: hidden;
            height: clamp(240px, 45vw, 480px);
            background: var(--black);
        }
        .hero-banner-wrap img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 1.4s cubic-bezier(0.4,0,0.2,1);
            display: block; opacity: 0.75;
        }
        .hero-banner-wrap:hover img { transform: scale(1.04); }
        .hero-banner-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.75) 0%, rgba(0,0,0,0.15) 55%, transparent 100%);
            pointer-events: none;
        }
        /* red streak */
        .hero-red-streak {
            position: absolute; inset: 0;
            background: linear-gradient(to left, rgba(200,40,30,0.1), transparent 60%);
            pointer-events: none;
        }
        .hero-banner-text {
            position: absolute; bottom: 0; left: 0; right: 0;
            padding: clamp(16px, 4vw, 40px);
            display: flex; align-items: flex-end; justify-content: space-between; gap: 12px;
        }
        .hero-banner-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(38px, 7vw, 88px);
            letter-spacing: 0.08em; line-height: 1;
            color: var(--white); font-style: italic;
        }
        .hero-banner-title span { color: var(--red); }
        .hero-banner-sub {
            font-family: 'DM Mono', monospace;
            font-size: clamp(9px, 1.2vw, 11px);
            letter-spacing: 0.22em; color: rgba(255,255,255,0.45);
            text-transform: uppercase; text-align: right;
            flex-shrink: 0; line-height: 1.6;
        }

        /* ── PAGE TITLE ── */
        .page-title-wrap {
            padding: clamp(20px, 4vw, 36px) 0 clamp(16px, 3vw, 28px);
            border-bottom: 1px solid #ebebeb; margin-bottom: clamp(24px, 4vw, 44px);
            display: flex; align-items: flex-end; justify-content: space-between; gap: 12px;
        }
        .page-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(24px, 5vw, 52px);
            letter-spacing: 0.08em; line-height: 1; font-style: italic;
        }
        .page-title span { color: var(--red); }
        .product-count {
            font-family: 'DM Mono', monospace; font-size: 10px;
            letter-spacing: 0.15em; color: #aaa; text-transform: uppercase;
            padding-bottom: 4px; flex-shrink: 0;
        }

        /* ── PRODUCT CARD — 3/4 aspect for magazine ── */
        .product-card { text-decoration: none; color: inherit; display: flex; flex-direction: column; }
        .product-img-box {
            width: 100%; aspect-ratio: 3/4;
            background: var(--gray-soft);
            display: flex; align-items: center; justify-content: center;
            overflow: hidden; position: relative;
            transition: background 0.3s;
        }
        .product-img-box::after {
            content: ''; position: absolute; inset: 0;
            border: 1px solid transparent;
            transition: border-color 0.3s; pointer-events: none;
        }
        .product-card:hover .product-img-box { background: #eaeaea; }
        .product-card:hover .product-img-box::after { border-color: var(--gray-mid); }
        .product-img-box img {
            width: 100%; height: 100%; object-fit: contain;
            padding: clamp(10px, 2vw, 18px); mix-blend-mode: multiply;
            transition: transform 0.7s cubic-bezier(0.4,0,0.2,1);
        }
        .product-card:hover .product-img-box img { transform: scale(1.06); }

        /* "Read More" chip */
        .read-chip {
            position: absolute; top: 10px; left: 10px;
            background: var(--black); color: var(--white);
            font-family: 'DM Mono', monospace; font-size: 8px;
            letter-spacing: 0.15em; text-transform: uppercase;
            padding: 4px 10px;
            opacity: 0; transform: translateY(-4px);
            transition: opacity 0.25s, transform 0.25s;
        }
        .product-card:hover .read-chip { opacity: 1; transform: translateY(0); }

        .product-name {
            font-family: 'DM Mono', monospace; font-size: 10px;
            font-weight: 500; text-transform: uppercase;
            letter-spacing: 0.06em; line-height: 1.4;
            color: var(--black); margin-top: 10px; font-style: italic;
        }
        .product-price {
            font-family: 'DM Mono', monospace; font-size: 10px;
            color: #888; margin-top: 4px;
            letter-spacing: 0.06em; text-transform: uppercase;
        }

        /* ── EMPTY STATE ── */
        .empty-wrap {
            padding: clamp(48px, 10vw, 100px) 0; text-align: center;
            border: 2px dashed #ebebeb; margin-bottom: clamp(32px, 6vw, 64px);
        }
        .empty-wrap p {
            font-family: 'DM Mono', monospace; font-size: 11px;
            color: #bbb; letter-spacing: 0.1em;
        }

        /* ── SCROLL REVEAL ── */
        .reveal { opacity: 0; transform: translateY(24px); transition: opacity 0.6s ease, transform 0.6s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .stagger-item { opacity: 0; transform: translateY(16px); transition: opacity 0.5s ease, transform 0.5s ease; }
        .stagger-item.visible { opacity: 1; transform: translateY(0); }

        /* ── FOOTER — dark ── */
        footer { background: var(--black); color: var(--white); padding: clamp(48px,8vw,80px) 0 clamp(40px,6vw,60px); margin-top: clamp(40px,8vw,80px); }
        .footer-inner {
            max-width: 1400px; margin: 0 auto;
            padding: 0 clamp(16px,5vw,40px);
            display: grid; grid-template-columns: 1fr 1fr;
            gap: clamp(32px,6vw,80px);
        }
        @media (max-width: 640px) { .footer-inner { grid-template-columns: 1fr; } }
        .footer-logo {
            font-family: 'Bebas Neue', sans-serif; font-size: clamp(36px,8vw,48px);
            letter-spacing: 0.12em; color: var(--white);
            display: block; margin-bottom: 16px;
            text-decoration: none; transition: opacity 0.2s;
        }
        .footer-logo:hover { opacity: 0.5; }
        .footer-tagline {
            font-family: 'DM Mono', monospace; font-size: 10px;
            letter-spacing: 0.15em; color: var(--red);
            text-transform: uppercase; margin-bottom: 12px;
        }
        .footer-desc { font-size: 13px; line-height: 1.8; color: #777; max-width: 320px; margin-bottom: 32px; font-style: italic; }
        .footer-social a {
            display: inline-flex; align-items: center; justify-content: center;
            width: 36px; height: 36px; border: 1px solid #2a2a2a;
            color: #666; transition: border-color 0.2s, color 0.2s;
            margin-right: 8px; text-decoration: none;
        }
        .footer-social a:hover { border-color: var(--white); color: var(--white); }
        .footer-contact {
            font-family: 'Bebas Neue', sans-serif; font-size: clamp(22px,4vw,30px);
            letter-spacing: 0.08em; color: var(--white); text-decoration: none;
            display: inline-block; margin-top: 24px;
            border-bottom: 1px solid #2a2a2a; padding-bottom: 2px;
            transition: border-color 0.2s, color 0.2s;
        }
        .footer-contact:hover { color: #ccc; border-color: #666; }
        .footer-site-link {
            font-family: 'DM Mono', monospace; font-size: 11px;
            letter-spacing: 0.1em; color: #555; text-decoration: none;
            display: block; margin-top: 18px; transition: color 0.2s; font-style: italic;
        }
        .footer-site-link:hover { color: var(--white); }
        .footer-form input,
        .footer-form textarea {
            width: 100%; background: transparent;
            border: none; border-bottom: 1px solid #2a2a2a;
            padding: 12px 0; font-family: 'DM Sans', sans-serif;
            font-size: 13px; color: var(--white);
            outline: none; transition: border-color 0.3s; margin-bottom: 4px;
        }
        .footer-form input::placeholder,
        .footer-form textarea::placeholder { color: #444; }
        .footer-form input:focus,
        .footer-form textarea:focus { border-bottom-color: var(--white); }
        .footer-form textarea { resize: none; margin-top: 8px; }
        .footer-form .field-wrap { margin-bottom: 12px; }
        .footer-submit {
            background: var(--white); color: var(--black); border: none;
            font-family: 'DM Mono', monospace; font-size: 11px;
            letter-spacing: 0.12em; text-transform: uppercase;
            padding: 13px clamp(24px,5vw,40px); cursor: pointer; margin-top: 14px;
            transition: background 0.2s, transform 0.15s; width: 100%;
        }
        .footer-submit:hover { background: var(--gray-mid); transform: translateY(-1px); }
        .footer-submit:active { transform: translateY(0); }
        .footer-bottom {
            max-width: 1400px; margin: 0 auto;
            padding: 0 clamp(16px,5vw,40px);
            margin-top: 48px; padding-top: 24px;
            border-top: 1px solid #1a1a1a;
            display: flex; justify-content: space-between; align-items: center;
            flex-wrap: wrap; gap: 8px;
        }
        .footer-copy {
            font-family: 'DM Mono', monospace; font-size: 10px;
            letter-spacing: 0.1em; color: #3a3a3a; text-transform: uppercase;
        }

        /* ── MOBILE SPECIFICS ── */
        @media (max-width: 480px) {
            .auth-name { display: none; }
            .hero-banner-sub { display: none; }
        }
        @media (max-width: 360px) {
            .back-link span { display: none; }
        }
    </style>
</head>

@php
    // KONTROL PANEL SOSMED
    $ig_username = "mhm.co";
    $tg_username = "mhm_co";
    $tt_username = "mhm.co";
    $wa_number   = "6281234567890";
@endphp

<body>

    <div id="scroll-bar"></div>

    <button id="back-top" aria-label="Back to top" onclick="window.scrollTo({top:0,behavior:'smooth'})">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5"/>
        </svg>
    </button>

    <!-- HEADER -->
    <header id="main-header" class="w-full pt-4 pb-3 sticky top-0 bg-white z-50 border-b border-transparent transition-all duration-300">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 md:px-10">
            <div class="grid grid-cols-3 items-center mb-3 sm:mb-4">

                <!-- LEFT: Back -->
                <div class="flex justify-start fade-up delay-1">
                    <a href="{{ route('category.thrasher') }}" class="back-link">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                        <span>back</span>
                    </a>
                </div>

                <!-- CENTER: Logo -->
                <div class="flex justify-center fade-up delay-1">
                    <a href="/" class="site-logo">mhm.co</a>
                </div>

                <!-- RIGHT: Auth + Cart -->
                <div class="flex justify-end items-center gap-3 sm:gap-4 fade-up delay-2">
                    @auth
                        <a href="/profile" class="auth-link">
                            <span class="auth-name">{{ Auth::user()->name }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </a>
                    @else
                        <a href="/login" class="auth-link">
                            <span class="hidden sm:inline auth-name">masuk</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
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

            <!-- SEARCH -->
            <div class="flex justify-center pb-1 fade-up delay-3">
                <form action="{{ route('search') }}" method="GET" class="search-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 search-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    <input
                        id="product-search"
                        name="search"
                        type="text"
                        placeholder="search magazine..."
                        class="search-input"
                    >
                </form>
            </div>
        </div>
    </header>

    <!-- HERO BANNER -->
    <div class="hero-banner-wrap fade-up delay-2">
        <img src="{{ asset('img/thrasherbanner3.webp') }}" alt="Thrasher Magazine Hero">
        <div class="hero-banner-overlay"></div>
        <div class="hero-red-streak"></div>
        <div class="hero-banner-text">
            <h1 class="hero-banner-title">Skate<br><span>Mag</span></h1>
            <p class="hero-banner-sub">mhm.co / thrasher<br>magazine archive</p>
        </div>
    </div>

    <!-- MAIN -->
    <main class="max-w-[1400px] mx-auto px-4 sm:px-6 md:px-10 mb-12 sm:mb-20">

        <!-- PAGE TITLE -->
        <div class="page-title-wrap reveal">
            <h2 class="page-title">Thrasher <span>Magazine</span></h2>
            @if($thrasherMag->count() > 0)
                <span class="product-count">{{ $thrasherMag->count() }} item{{ $thrasherMag->count() > 1 ? 's' : '' }}</span>
            @endif
        </div>

        <!-- PRODUCT GRID -->
        @if($thrasherMag->count() > 0)
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-x-4 sm:gap-x-5 gap-y-8 sm:gap-y-10">
                @foreach($thrasherMag as $product)
                <a href="{{ route('product.show', $product->id) }}" class="product-card stagger-item">
                    <div class="product-img-box">
                        <img src="{{ asset('img/' . $product->gambar) }}" alt="{{ $product->nama }}">
                        <span class="read-chip">Read More</span>
                    </div>
                    <p class="product-name">{{ $product->nama }}</p>
                    <p class="product-price">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                </a>
                @endforeach
            </div>
        @else
            <div class="empty-wrap">
                <p>magazine collection is currently empty.</p>
            </div>
        @endif

    </main>

    <!-- FOOTER -->
    <footer>
        <div class="footer-inner">
            <div>
                <a href="/" class="footer-logo">mhm.co</a>
                <p class="footer-tagline">skate and destroy</p>
                <p class="footer-desc">exclusive archive of the world's most iconic skateboarding magazine.</p>

                <div class="footer-social flex">
                    <a href="https://www.instagram.com/hilmimaaulana/{{ $ig_username }}" target="_blank" aria-label="Instagram">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.332 3.608 1.308.975.975 1.247 2.242 1.308 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.062 1.366-.332 2.633-1.308 3.608-.975.975-2.242 1.247-3.608 1.308-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.062-2.633-.332-3.608-1.308-.975-.975-1.247-2.242-1.308-3.608-.058-1.266-.07-1.646-.07-4.85s.012-3.584.07-4.85c.062-1.366.332-2.633 1.308-3.608.975-.975 2.242-1.247 3.608-1.308 1.266-.058 1.646-.07 4.85-.07zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c.796 0 1.441.645 1.441 1.44s-.645 1.44-1.441 1.44c-.795 0-1.439-.645-1.439-1.44s.644-1.44 1.439-1.44z"/></svg>
                    </a>
                    <a href="https://t.me/{{ $tg_username }}" target="_blank" aria-label="Telegram">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5.891 8.146l-2.003 9.464c-.149.659-.541.823-1.091.515l-3.051-2.251-1.472 1.417c-.163.163-.3.298-.614.298l.218-3.102 5.645-5.101c.246-.219-.054-.341-.381-.123l-6.979 4.4z"/></svg>
                    </a>
                    <a href="https://www.tiktok.com/@hhhhhh.232323{{ $tt_username }}" target="_blank" aria-label="TikTok">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 448 512"><path d="M448 209.91a210.06 210.06 0 0 1-122.77-39.25V349.38A162.55 162.55 0 1 1 185 188.31V278.2a74.62 74.62 0 1 0 52.23 71.18V0l88 0a121.18 121.18 0 0 0 1.86 22.17h0A122.18 122.18 0 0 0 381 102.39a121.43 121.43 0 0 0 67 20.14Z"/></svg>
                    </a>
                </div>

                <a href="/" class="footer-site-link">www.mhm.co</a>
                <a href="https://wa.me/{{ $wa_number }}" target="_blank" class="footer-contact">contact us →</a>
            </div>

            <form action="{{ route('message.send') }}" method="POST" class="footer-form flex flex-col">
                @csrf
                <div class="field-wrap"><input type="text" name="name" placeholder="name" required></div>
                <div class="field-wrap"><input type="email" name="email" placeholder="email" required></div>
                <div class="field-wrap"><textarea name="message" rows="5" placeholder="message" required></textarea></div>
                <div class="flex justify-end">
                    <button type="submit" class="footer-submit">send</button>
                </div>
            </form>
        </div>

        <div class="footer-bottom">
            <span class="footer-copy">© 2025 mhm.co — all rights reserved</span>
            <span class="footer-copy">thrasher magazine</span>
        </div>
    </footer>

    <script>
        // ── SCROLL PROGRESS + HEADER HIDE + BACK TO TOP ──
        let lastScrollTop = 0;
        const header    = document.getElementById("main-header");
        const scrollBar = document.getElementById("scroll-bar");
        const backTop   = document.getElementById("back-top");
        const docH = () => document.documentElement.scrollHeight - window.innerHeight;

        window.addEventListener("scroll", function () {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            scrollBar.style.width = (scrollTop / docH() * 100) + "%";
            if (scrollTop > lastScrollTop && scrollTop > 100) { header.classList.add("header-hide"); }
            else {
                header.classList.remove("header-hide");
                if (scrollTop > 50) header.classList.add("border-gray-100", "shadow-sm");
                else header.classList.remove("border-gray-100", "shadow-sm");
            }
            if (scrollTop > 300) backTop.classList.add("show");
            else backTop.classList.remove("show");
            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        }, false);

        // ── SCROLL REVEAL ──
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) { entry.target.classList.add('visible'); revealObserver.unobserve(entry.target); }
            });
        }, { threshold: 0.08 });
        document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

        // ── STAGGER CARDS ──
        const staggerObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const siblings = entry.target.parentElement.querySelectorAll('.stagger-item');
                    siblings.forEach((el, i) => { setTimeout(() => el.classList.add('visible'), i * 65); });
                    staggerObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.06 });
        document.querySelectorAll('.stagger-item:first-child').forEach(el => staggerObserver.observe(el));

        // ── SEARCH — preserve original logic ──
        const searchInput = document.getElementById('product-search');
        searchInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.closest('form').submit();
            }
        });
    </script>
</body>
</html>