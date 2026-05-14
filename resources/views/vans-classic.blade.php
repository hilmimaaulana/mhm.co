<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vans Classic - mhm.co</title>
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
            position: fixed; top: 0; left: 0;
            height: 2px; background: var(--black);
            z-index: 9999; width: 0%;
            transition: width 0.08s linear;
        }

        /* ── BACK TO TOP ── */
        #back-top {
            position: fixed; bottom: 32px; right: 32px;
            width: 42px; height: 42px;
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
            font-size: 22px; letter-spacing: 0.15em;
            color: var(--black); text-decoration: none;
            transition: opacity 0.2s;
        }
        .site-logo:hover { opacity: 0.45; }

        /* ── BACK LINK ── */
        .back-link {
            font-family: 'DM Mono', monospace;
            font-size: 10px; letter-spacing: 0.15em; text-transform: uppercase;
            color: var(--ink); text-decoration: none;
            display: inline-flex; align-items: center; gap: 7px;
            transition: opacity 0.2s;
        }
        .back-link:hover { opacity: 0.4; }
        .back-link svg { transition: transform 0.25s cubic-bezier(0.4,0,0.2,1); }
        .back-link:hover svg { transform: translateX(-3px); }

        /* ── AUTH / ICONS ── */
        .icon-btn {
            display: inline-flex; align-items: center; justify-content: center;
            color: var(--ink); transition: opacity 0.2s; text-decoration: none;
        }
        .icon-btn:hover { opacity: 0.4; }
        .auth-link {
            font-family: 'DM Mono', monospace; font-size: 11px; letter-spacing: 0.05em;
            display: inline-flex; align-items: center; gap: 5px;
            text-decoration: none; color: var(--ink); transition: opacity 0.2s;
        }
        .auth-link:hover { opacity: 0.4; }
        .auth-greeting {
            font-family: 'DM Mono', monospace; font-size: 10px;
            letter-spacing: 0.05em; color: #888; font-style: italic;
        }

        /* ── SEARCH ── */
        .search-wrap { position: relative; }
        .search-input {
            font-family: 'DM Mono', monospace; font-size: 11px;
            width: 240px; background: var(--gray-soft);
            border: 1px solid transparent; border-radius: 2px;
            padding: 8px 14px 8px 34px; letter-spacing: 0.03em; color: var(--ink);
            outline: none;
            transition: width 0.5s cubic-bezier(0.4,0,0.2,1), background 0.3s, border-color 0.3s, box-shadow 0.3s;
        }
        .search-input::placeholder { color: #999; }
        .search-input:focus {
            width: 380px; background: #fff;
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
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up { opacity: 0; animation: fadeUp 0.65s cubic-bezier(0.4,0,0.2,1) forwards; }
        .delay-1 { animation-delay: 0.05s; }
        .delay-2 { animation-delay: 0.14s; }
        .delay-3 { animation-delay: 0.23s; }

        /* ── HERO BANNER ── */
        .hero-banner-wrap {
            position: relative; overflow: hidden;
            height: clamp(280px, 38vw, 500px);
            margin-top: 16px; margin-bottom: 0;
            background: var(--black);
        }
        .hero-banner-wrap img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 1.2s cubic-bezier(0.4,0,0.2,1);
            display: block; opacity: 0.85;
        }
        .hero-banner-wrap:hover img { transform: scale(1.03); }

        /* bottom gradient & text */
        .hero-banner-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.55) 0%, transparent 50%);
            pointer-events: none;
        }
        .hero-banner-text {
            position: absolute; bottom: 0; left: 0; right: 0;
            padding: 36px 40px;
            display: flex; align-items: flex-end; justify-content: space-between;
        }
        .hero-banner-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(44px, 7vw, 88px);
            letter-spacing: 0.1em; line-height: 1;
            color: var(--white);
        }
        .hero-banner-title span { color: rgba(255,255,255,0.25); }
        .hero-banner-sub {
            font-family: 'DM Mono', monospace; font-size: 10px;
            letter-spacing: 0.25em; color: rgba(255,255,255,0.55);
            text-transform: uppercase; text-align: right;
        }

        /* ── PAGE TITLE SECTION ── */
        .page-title-wrap {
            padding: 36px 0 32px;
            border-bottom: 1px solid #ebebeb;
            margin-bottom: 48px;
            display: flex; align-items: flex-end; justify-content: space-between;
        }
        .page-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(32px, 5vw, 56px);
            letter-spacing: 0.08em; line-height: 1;
            font-style: italic;
        }
        .page-title span { color: var(--gray-mid); }
        .product-count {
            font-family: 'DM Mono', monospace; font-size: 10px;
            letter-spacing: 0.15em; color: #aaa; text-transform: uppercase;
            padding-bottom: 4px;
        }

        /* ── PRODUCT CARD ── */
        .product-card { text-decoration: none; color: inherit; display: flex; flex-direction: column; }
        .product-img-box {
            width: 100%; aspect-ratio: 1;
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
            padding: 28px; mix-blend-mode: multiply;
            transition: transform 0.6s cubic-bezier(0.4,0,0.2,1);
        }
        .product-card:hover .product-img-box img { transform: scale(1.1) translateY(-3px); }

        /* number badge on hover */
        .product-img-box .hover-num {
            position: absolute; top: 12px; right: 12px;
            font-family: 'DM Mono', monospace; font-size: 9px;
            letter-spacing: 0.1em; color: #aaa;
            opacity: 0; transition: opacity 0.25s;
        }
        .product-card:hover .hover-num { opacity: 1; }

        .product-name {
            font-family: 'DM Sans', sans-serif; font-size: 11px;
            font-weight: 400; text-transform: lowercase;
            line-height: 1.5; color: #555; margin-top: 12px;
            letter-spacing: 0.01em;
        }
        .product-price {
            font-family: 'DM Mono', monospace; font-size: 11px;
            font-weight: 500; color: var(--black); margin-top: 4px;
            letter-spacing: 0.06em; text-transform: uppercase;
        }

        /* ── EMPTY STATE ── */
        .empty-wrap {
            padding: 100px 0; text-align: center;
        }
        .empty-wrap p {
            font-family: 'DM Mono', monospace; font-size: 12px;
            color: #bbb; letter-spacing: 0.1em; text-transform: lowercase;
        }

        /* ── SCROLL REVEAL ── */
        .reveal { opacity: 0; transform: translateY(26px); transition: opacity 0.65s ease, transform 0.65s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .stagger-item { opacity: 0; transform: translateY(18px); transition: opacity 0.5s ease, transform 0.5s ease; }
        .stagger-item.visible { opacity: 1; transform: translateY(0); }

        /* ── FOOTER ── */
        footer { background: var(--black); color: var(--white); padding: 80px 0 60px; margin-top: 80px; }
        .footer-inner {
            max-width: 1400px; margin: 0 auto; padding: 0 40px;
            display: grid; grid-template-columns: 1fr 1fr; gap: 80px;
        }
        .footer-logo {
            font-family: 'Bebas Neue', sans-serif; font-size: 48px;
            letter-spacing: 0.12em; color: var(--white);
            display: block; margin-bottom: 20px;
            text-decoration: none; transition: opacity 0.2s;
        }
        .footer-logo:hover { opacity: 0.5; }
        .footer-desc { font-size: 13px; line-height: 1.8; color: #777; max-width: 320px; margin-bottom: 36px; }
        .footer-social a {
            display: inline-flex; align-items: center; justify-content: center;
            width: 38px; height: 38px; border: 1px solid #2a2a2a;
            color: #666; transition: border-color 0.2s, color 0.2s;
            margin-right: 8px; text-decoration: none;
        }
        .footer-social a:hover { border-color: var(--white); color: var(--white); }
        .footer-contact {
            font-family: 'Bebas Neue', sans-serif; font-size: 30px;
            letter-spacing: 0.08em; color: var(--white); text-decoration: none;
            display: inline-block; margin-top: 28px;
            border-bottom: 1px solid #2a2a2a; padding-bottom: 2px;
            transition: border-color 0.2s, color 0.2s;
        }
        .footer-contact:hover { color: #ccc; border-color: #666; }
        .footer-site-link {
            font-family: 'DM Mono', monospace; font-size: 12px;
            letter-spacing: 0.1em; color: #555; text-decoration: none;
            display: block; margin-top: 20px; transition: color 0.2s;
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
        .footer-form .field-wrap { margin-bottom: 14px; }
        .footer-submit {
            background: var(--white); color: var(--black); border: none;
            font-family: 'DM Mono', monospace; font-size: 12px;
            letter-spacing: 0.12em; text-transform: uppercase;
            padding: 14px 40px; cursor: pointer; margin-top: 16px;
            transition: background 0.2s, transform 0.15s;
        }
        .footer-submit:hover { background: var(--gray-mid); transform: translateY(-1px); }
        .footer-submit:active { transform: translateY(0); }
        .footer-bottom {
            max-width: 1400px; margin: 0 auto; padding: 0 40px;
            margin-top: 60px; padding-top: 28px;
            border-top: 1px solid #1a1a1a;
            display: flex; justify-content: space-between; align-items: center;
        }
        .footer-copy {
            font-family: 'DM Mono', monospace; font-size: 10px;
            letter-spacing: 0.12em; color: #3a3a3a; text-transform: uppercase;
        }

        @media (max-width: 768px) {
            .footer-inner { grid-template-columns: 1fr; gap: 48px; }
            .search-input:focus { width: 240px; }
            .hero-banner-text { padding: 24px 20px; }
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
            <div class="grid grid-cols-3 items-center mb-5">

                <!-- LEFT: Back -->
                <div class="flex justify-start fade-up delay-1">
                    <a href="{{ route('category.vans') }}" class="back-link">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                        back
                    </a>
                </div>

                <!-- CENTER: Logo -->
                <div class="flex justify-center fade-up delay-1">
                    <a href="/" class="site-logo">mhm.co</a>
                </div>

                <!-- RIGHT: Auth + Cart -->
                <div class="flex justify-end items-center gap-5 fade-up delay-2">
                    @auth
                        <a href="{{ route('user.orders') }}" class="auth-link">
                            <span class="auth-greeting">hi, {{ Auth::user()->name }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
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

                    <a href="{{ route('cart.show') }}" class="icon-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121 0 2.118-.401 2.582-1.242l4.117-7.31c.425-.756-.122-1.692-1.026-1.692H5.156M7.5 14.25 5.85 21.435m11.15-7.185 1.65 7.185m-10.8-1.875a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0ZM18 19.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- SEARCH -->
            <div class="flex justify-center fade-up delay-3">
                <form action="{{ route('search') }}" method="GET" class="search-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 search-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    <input
                        id="product-search"
                        name="search"
                        type="text"
                        placeholder="search classic series..."
                        class="search-input"
                    >
                </form>
            </div>
        </div>
    </header>

    <!-- HERO BANNER -->
    <div class="hero-banner-wrap fade-up delay-2">
        <img src="{{ asset('img/vansclassicbanner.jpg') }}" alt="Vans Classic Hero">
        <div class="hero-banner-overlay"></div>
        <div class="hero-banner-text">
            <h1 class="hero-banner-title">VANS CLASSIC<span> SERIES</span></h1>
            <p class="hero-banner-sub">mhm.co / vans<br>classic collection</p>
        </div>
    </div>

    <!-- MAIN -->
    <main class="max-w-[1400px] mx-auto px-10">

        <!-- PAGE TITLE -->
        <div class="page-title-wrap reveal">
            <h2 class="page-title">Vans Classic <span>Series</span></h2>
            @if($products->count() > 0)
                <span class="product-count">{{ $products->count() }} item{{ $products->count() > 1 ? 's' : '' }}</span>
            @endif
        </div>

        <!-- PRODUCT GRID -->
        @if($products->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-x-5 gap-y-10 mb-32">
                @foreach($products as $i => $product)
                <a href="{{ route('product.show', $product->id) }}" class="product-card stagger-item">
                    <div class="product-img-box">
                        <img src="{{ asset('img/' . $product->gambar) }}" alt="{{ $product->nama }}">
                        <span class="hover-num">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <p class="product-name">{{ $product->nama }}</p>
                    <p class="product-price">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                </a>
                @endforeach
            </div>
        @else
            <div class="empty-wrap">
                <p>no classic items found in vault.</p>
            </div>
        @endif

    </main>

    <!-- FOOTER -->
    <footer>
        <div class="footer-inner">
            <div>
                <a href="/" class="footer-logo">mhm.co</a>
                <p class="footer-desc">find us at the nearest offline store and also we provide various online stores such as instagram, telegram, and tiktok.</p>

                <div class="footer-social flex">
                    <a href="https://instagram.com/akun_kamu" target="_blank" aria-label="Instagram">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.332 3.608 1.308.975.975 1.247 2.242 1.308 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.062 1.366-.332 2.633-1.308 3.608-.975.975-2.242 1.247-3.608 1.308-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.062-2.633-.332-3.608-1.308-.975-.975-1.247-2.242-1.308-3.608-.058-1.266-.07-1.646-.07-4.85s.012-3.584.07-4.85c.062-1.366.332-2.633 1.308-3.608.975-.975 2.242-1.247 3.608-1.308 1.266-.058 1.646-.07 4.85-.07zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c.796 0 1.441.645 1.441 1.44s-.645 1.44-1.441 1.44c-.795 0-1.439-.645-1.439-1.44s.644-1.44 1.439-1.44z"/></svg>
                    </a>
                    <a href="https://t.me/akun_kamu" target="_blank" aria-label="Telegram">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5.891 8.146l-2.003 9.464c-.149.659-.541.823-1.091.515l-3.051-2.251-1.472 1.417c-.163.163-.3.298-.614.298l.218-3.102 5.645-5.101c.246-.219-.054-.341-.381-.123l-6.979 4.4z"/></svg>
                    </a>
                    <a href="https://www.tiktok.com/@hhhhhh.232323" target="_blank" aria-label="TikTok">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 448 512"><path d="M448 209.91a210.06 210.06 0 0 1-122.77-39.25V349.38A162.55 162.55 0 1 1 185 188.31V278.2a74.62 74.62 0 1 0 52.23 71.18V0l88 0a121.18 121.18 0 0 0 1.86 22.17h0A122.18 122.18 0 0 0 381 102.39a121.43 121.43 0 0 0 67 20.14Z"/></svg>
                    </a>
                </div>

                <a href="/" class="footer-site-link">www.mhm.co</a>
                <a href="https://wa.me/6281234567890" target="_blank" class="footer-contact">contact us →</a>
            </div>

            <form action="{{ route('message.send') }}" method="POST" class="footer-form flex flex-col">
                @csrf
                <div class="field-wrap"><input type="text" name="name" placeholder="name" required></div>
                <div class="field-wrap"><input type="email" name="email" placeholder="email" required></div>
                <div class="field-wrap"><textarea name="message" rows="5" placeholder="message" required></textarea></div>
                <div class="flex justify-end">
                    <button type="submit" class="footer-submit">submit</button>
                </div>
            </form>
        </div>

        <div class="footer-bottom">
            <span class="footer-copy">© 2025 mhm.co — all rights reserved</span>
            <span class="footer-copy">vans classic series</span>
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
            if (scrollTop > 400) backTop.classList.add("show");
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
                    siblings.forEach((el, i) => { setTimeout(() => el.classList.add('visible'), i * 70); });
                    staggerObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08 });
        document.querySelectorAll('.stagger-item:first-child').forEach(el => staggerObserver.observe(el));

        // ── SEARCH — preserve original routing logic ──
        const searchInput = document.getElementById('product-search');
        searchInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const query = this.value.trim();
                if (query) {
                    window.location.href = "{{ route('search') }}?search=" + encodeURIComponent(query);
                }
            }
        });
    </script>
</body>
</html>