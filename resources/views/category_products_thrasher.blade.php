<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thrasher Collection - mhm.co</title>
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

        /* ── SCROLL PROGRESS ── */
        #scroll-bar {
            position: fixed; top: 0; left: 0;
            height: 2px; background: var(--red);
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

        /* ── MARQUEE ── */
        @keyframes marquee { from { transform: translateX(0); } to { transform: translateX(-50%); } }
        .marquee-track {
            display: flex; width: max-content;
            animation: marquee 18s linear infinite;
        }
        .marquee-track:hover { animation-play-state: paused; }
        .marquee-track span {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 12px; letter-spacing: 0.28em;
            color: var(--white); padding: 0 28px; white-space: nowrap;
        }
        .marquee-track span.dot { color: #555; padding: 0 4px; }

        /* ── HEADER ── */
        #main-header { transition: transform 0.4s cubic-bezier(0.4,0,0.2,1), box-shadow 0.3s; }
        .header-hide { transform: translateY(-100%); }

        /* ── LOGO ── */
        .site-logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px; letter-spacing: 0.15em;
            color: var(--black); text-decoration: none;
            transition: opacity 0.2s;
        }
        .site-logo:hover { opacity: 0.45; }

        /* ── NAV ── */
        .nav-link {
            font-family: 'DM Mono', monospace;
            font-size: 11px; letter-spacing: 0.05em; text-transform: lowercase;
            color: var(--ink); text-decoration: none;
            position: relative; padding-bottom: 2px; transition: opacity 0.2s;
        }
        .nav-link::after {
            content: ''; position: absolute; bottom: -1px; left: 0;
            width: 0; height: 1px; background: var(--black);
            transition: width 0.3s cubic-bezier(0.4,0,0.2,1);
        }
        .nav-link:hover::after { width: 100%; }
        .nav-active {
            font-family: 'DM Mono', monospace;
            font-size: 11px; letter-spacing: 0.05em; text-transform: lowercase;
            color: var(--black); font-weight: 600; text-decoration: none;
            border-bottom: 1.5px solid var(--black); padding-bottom: 1px;
        }

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
        .auth-name {
            font-family: 'DM Mono', monospace; font-size: 10px;
            letter-spacing: 0.05em; color: #888;
        }
        .logout-btn {
            background: none; border: none; cursor: pointer;
            display: inline-flex; align-items: center;
            color: var(--ink); transition: opacity 0.2s; padding: 0;
        }
        .logout-btn:hover { opacity: 0.4; }

        /* ── SEARCH ── */
        .search-wrap { position: relative; }
        .search-input {
            font-family: 'DM Mono', monospace; font-size: 11px;
            width: 280px; background: var(--gray-soft);
            border: 1px solid transparent; border-radius: 2px;
            padding: 9px 16px 9px 36px; letter-spacing: 0.03em; color: var(--ink);
            outline: none;
            transition: width 0.5s cubic-bezier(0.4,0,0.2,1), background 0.3s, border-color 0.3s, box-shadow 0.3s;
        }
        .search-input::placeholder { color: #999; }
        .search-input:focus {
            width: 440px; background: #fff;
            border-color: var(--black);
            box-shadow: 4px 4px 0px var(--black);
        }
        .search-icon {
            position: absolute; left: 12px; top: 50%; transform: translateY(-50%);
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
        .delay-2 { animation-delay: 0.12s; }
        .delay-3 { animation-delay: 0.20s; }
        .delay-4 { animation-delay: 0.28s; }
        .delay-5 { animation-delay: 0.36s; }

        /* ── HERO CATEGORY — Thrasher flame accent ── */
        .hero-cat {
            position: relative; height: 320px; overflow: hidden;
            background: var(--black); margin-bottom: 60px;
            display: flex; align-items: center;
        }
        .hero-cat-bg {
            position: absolute; inset: 0;
            background: linear-gradient(110deg, #0a0a0a 38%, #2a0800 100%);
        }
        /* red streak accent */
        .hero-cat-streak {
            position: absolute; top: 0; right: 0;
            width: 38%; height: 100%;
            background: linear-gradient(to left, rgba(200,40,30,0.12), transparent);
            pointer-events: none;
        }
        .hero-cat-title {
            position: relative; z-index: 2;
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(72px, 14vw, 170px);
            letter-spacing: 0.06em; color: rgba(255,255,255,0.05);
            user-select: none; white-space: nowrap;
            padding-left: 40px; line-height: 1;
        }
        .hero-cat-label {
            position: absolute; z-index: 3;
            left: 40px; bottom: 36px;
        }
        .hero-cat-label h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(36px, 6vw, 68px);
            letter-spacing: 0.12em; color: var(--white);
            line-height: 1; margin: 0;
        }
        .hero-cat-label h1 span { color: var(--red); }
        .hero-cat-label p {
            font-family: 'DM Mono', monospace; font-size: 11px;
            letter-spacing: 0.2em; color: #666;
            margin-top: 8px; text-transform: uppercase;
        }
        .hero-cat-count {
            position: absolute; z-index: 3; right: 40px; bottom: 36px;
            font-family: 'DM Mono', monospace; font-size: 10px;
            letter-spacing: 0.15em; color: #444; text-transform: uppercase;
        }

        /* ── SEARCH RESULTS HEADER ── */
        .search-header {
            text-align: center; margin-bottom: 48px;
        }
        .search-header h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(26px, 4vw, 42px);
            letter-spacing: 0.1em; font-style: italic;
        }
        .search-header h1 span { color: #aaa; }
        .search-header a {
            font-family: 'DM Mono', monospace; font-size: 10px;
            letter-spacing: 0.2em; text-transform: uppercase;
            color: var(--black); text-decoration: none;
            border-bottom: 1px solid var(--black); padding-bottom: 1px;
            margin-top: 10px; display: inline-block;
            transition: opacity 0.2s;
        }
        .search-header a:hover { opacity: 0.45; }

        /* ── BANNER ── */
        .banner-wrap { overflow: hidden; position: relative; }
        .banner-img {
            width: 100%; height: 100%; object-fit: cover; display: block;
            transition: transform 1s cubic-bezier(0.4,0,0.2,1);
        }
        .banner-wrap:hover .banner-img { transform: scale(1.05); }

        /* split banner left overlay */
        .banner-text-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.65) 0%, transparent 55%);
            display: flex; flex-direction: column;
            justify-content: flex-end; padding: 28px 28px;
            pointer-events: none;
            transition: background 0.4s;
        }
        .banner-wrap:hover .banner-text-overlay {
            background: linear-gradient(to top, rgba(0,0,0,0.4) 0%, transparent 60%);
        }
        .banner-subtitle {
            font-family: 'DM Mono', monospace; font-size: 10px;
            letter-spacing: 0.3em; color: rgba(255,255,255,0.6);
            text-transform: uppercase; margin-bottom: 6px;
        }
        .banner-title-text {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(28px, 4vw, 52px);
            letter-spacing: 0.1em; color: var(--white);
            font-style: italic; line-height: 1;
        }

        /* full banner center overlay */
        .banner-center-overlay {
            position: absolute; inset: 0;
            background: rgba(0,0,0,0.32);
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; text-align: center;
            transition: background 0.4s; pointer-events: none;
        }
        .banner-wrap:hover .banner-center-overlay { background: rgba(0,0,0,0.16); }
        .banner-center-subtitle {
            font-family: 'DM Mono', monospace; font-size: 10px;
            letter-spacing: 0.4em; color: rgba(255,255,255,0.7);
            text-transform: uppercase; margin-bottom: 10px;
        }
        .banner-center-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(44px, 7vw, 90px);
            letter-spacing: 0.12em; color: var(--white);
            font-style: italic; line-height: 1;
        }

        /* ── SECTION HEADING ── */
        .section-title-link {
            display: inline-flex; align-items: center; gap: 10px;
            text-decoration: none; color: var(--black);
            margin-bottom: 24px;
        }
        .section-dot { width: 5px; height: 5px; border-radius: 50%; background: var(--red); flex-shrink: 0; }
        .section-title-link h2 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(22px, 2.5vw, 32px);
            letter-spacing: 0.12em; font-style: italic; line-height: 1;
            transition: opacity 0.2s;
        }
        .section-title-link:hover h2 { opacity: 0.5; }
        .arrow-icon { width: 15px; height: 15px; transition: transform 0.3s cubic-bezier(0.4,0,0.2,1); flex-shrink: 0; }
        .section-title-link:hover .arrow-icon { transform: translateX(5px); }

        /* ── PRODUCT CARD ── */
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
            padding: 20px; mix-blend-mode: multiply;
            transition: transform 0.6s cubic-bezier(0.4,0,0.2,1);
        }
        .product-card:hover .product-img-box img { transform: scale(1.1) translateY(-3px); }

        /* "Add to Cart" chip */
        .cart-chip {
            position: absolute; bottom: 12px; left: 50%; transform: translateX(-50%) translateY(6px);
            background: var(--black); color: var(--white);
            font-family: 'DM Mono', monospace; font-size: 8px;
            letter-spacing: 0.15em; text-transform: uppercase;
            padding: 5px 14px; white-space: nowrap;
            opacity: 0;
            transition: opacity 0.25s, transform 0.25s;
        }
        .product-card:hover .cart-chip { opacity: 1; transform: translateX(-50%) translateY(0); }

        .product-name {
            font-family: 'DM Sans', sans-serif; font-size: 11px;
            font-weight: 500; text-transform: uppercase;
            letter-spacing: 0.04em; line-height: 1.4; color: #555; margin-top: 12px;
        }
        .product-price {
            font-family: 'DM Mono', monospace; font-size: 11px;
            font-weight: 500; color: var(--black); margin-top: 5px; letter-spacing: 0.02em;
        }
        .empty-state {
            font-family: 'DM Mono', monospace; font-size: 11px; color: #bbb; letter-spacing: 0.05em;
        }

        /* ── SCROLL REVEAL ── */
        .reveal { opacity: 0; transform: translateY(26px); transition: opacity 0.65s ease, transform 0.65s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .stagger-item { opacity: 0; transform: translateY(18px); transition: opacity 0.5s ease, transform 0.5s ease; }
        .stagger-item.visible { opacity: 1; transform: translateY(0); }

        /* ── FOOTER ── */
        footer { background: var(--black); color: var(--white); padding: 80px 0 60px; margin-top: 60px; }
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
                    <a href="{{ route('category.vans') }}" class="nav-link fade-up delay-1">vans</a>
                    <a href="{{ route('category.converse') }}" class="nav-link fade-up delay-2">converse</a>
                    <a href="{{ route('category.thrasher') }}" class="nav-active fade-up delay-3">thrasher</a>
                    <a href="{{ route('category.show', 'limited') }}" class="nav-link fade-up delay-4" style="white-space:nowrap">limited edition</a>
                </nav>

                <div class="flex justify-end items-center gap-5 fade-up delay-5">
                    @auth
                        <div class="flex items-center gap-3">
                            <a href="{{ route('user.index') }}" class="icon-btn" style="gap:6px">
                                <span class="auth-name">{{ Auth::user()->name }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                            </a>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="logout-btn" title="Logout">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="auth-link">
                            masuk
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-4 h-4">
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
                        id="search-input"
                        type="text"
                        value="{{ request('search') }}"
                        placeholder="search thrasher magazine, flame logo, hoodie..."
                        autocomplete="off"
                        class="search-input"
                    >
                </form>
            </div>
        </div>
    </header>

    <!-- MARQUEE -->
    <div style="overflow:hidden;background:var(--black);padding:10px 0">
        <div class="marquee-track">
            <span>SKATE AND DESTROY</span><span class="dot">·</span>
            <span>THRASHER MAGAZINE</span><span class="dot">·</span>
            <span>FLAME LOGO SERIES</span><span class="dot">·</span>
            <span>SKATE GOAT COLLECTION</span><span class="dot">·</span>
            <span>SKATE AND DESTROY</span><span class="dot">·</span>
            <span>THRASHER MAGAZINE</span><span class="dot">·</span>
            <span>FLAME LOGO SERIES</span><span class="dot">·</span>
            <span>SKATE GOAT COLLECTION</span><span class="dot">·</span>
        </div>
    </div>

    <!-- HERO CATEGORY -->
    <div class="hero-cat fade-up delay-2">
        <div class="hero-cat-bg"></div>
        <div class="hero-cat-streak"></div>
        <div class="hero-cat-title">THRASHER</div>
        <div class="hero-cat-label">
            <h1>THRAS<span>HER</span></h1>
            <p>skate and destroy — since 1981</p>
        </div>
        <div class="hero-cat-count">mhm.co / collections</div>
    </div>

    <!-- MAIN -->
    <main class="max-w-[1400px] mx-auto px-10">

        @php
            $search = request('search');
            $isSearch = !empty($search);

            $magazines = $magazines ?? collect();
            $tshirts = $tshirts ?? collect();
            $jackets = $jackets ?? collect();

            if ($isSearch) {
                $filteredMagazines = $magazines->filter(fn($p) => stripos($p->nama, $search) !== false)->values();
                $filteredTshirts   = $tshirts->filter(fn($p) => stripos($p->nama, $search) !== false)->values();
                $filteredJackets   = $jackets->filter(fn($p) => stripos($p->nama, $search) !== false)->values();
            } else {
                $filteredMagazines = $magazines;
                $filteredTshirts   = $tshirts;
                $filteredJackets   = $jackets;
            }

            $sections = [
                [
                    'title'        => 'magazine',
                    'data'         => $filteredMagazines,
                    'route'        => 'category.thrasher.magazine',
                    'banner_type'  => 'split',
                    'banner_img_1' => 'foto3.jpg',
                    'banner_img_2' => 'thrasherbanner4.jpg',
                    'subtitle'     => 'skate and destroy'
                ],
                [
                    'title'        => 't-shirts',
                    'data'         => $filteredTshirts,
                    'route'        => 'category.thrasher.tshirt',
                    'banner_type'  => 'full',
                    'banner_img_1' => 'shirt1.webp',
                    'subtitle'     => 'authentic series'
                ],
                [
                    'title'        => 'jackets',
                    'data'         => $filteredJackets,
                    'route'        => 'category.thrasher.jacket',
                    'banner_type'  => 'full',
                    'banner_img_1' => 'bannerjaket1.jpg',
                    'subtitle'     => 'skate goat series'
                ]
            ];
        @endphp

        @if($isSearch)
            <div class="search-header reveal">
                <h1>results for: <span>"{{ $search }}"</span></h1>
                <a href="{{ route('category.thrasher') }}">← clear filter</a>
            </div>
        @endif

        @foreach($sections as $section)

            @if(!$isSearch)
                <div class="reveal" style="margin-bottom:48px">
                    @if($section['banner_type'] == 'split')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-[6px]">
                            <div class="banner-wrap" style="height:500px">
                                <img src="{{ asset('img/' . $section['banner_img_1']) }}" class="banner-img" alt="">
                                <div class="banner-text-overlay">
                                    <p class="banner-subtitle">{{ $section['subtitle'] }}</p>
                                    <h2 class="banner-title-text">{{ $section['title'] }}</h2>
                                </div>
                            </div>
                            <div class="banner-wrap" style="height:500px">
                                <img src="{{ asset('img/' . ($section['banner_img_2'] ?? $section['banner_img_1'])) }}" class="banner-img" alt="">
                            </div>
                        </div>
                    @else
                        <div class="banner-wrap" style="height:550px">
                            <img src="{{ asset('img/' . $section['banner_img_1']) }}" class="banner-img" alt="">
                            <div class="banner-center-overlay">
                                <p class="banner-center-subtitle">{{ $section['subtitle'] }}</p>
                                <h2 class="banner-center-title">{{ $section['title'] }}</h2>
                            </div>
                        </div>
                    @endif
                </div>
            @endif

            @if($section['data']->isNotEmpty())
            <section style="margin-bottom:80px">
                <div class="reveal">
                    <a href="{{ route($section['route']) }}" class="section-title-link">
                        <span class="section-dot"></span>
                        <h2>{{ $section['title'] }}</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="arrow-icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-x-5 gap-y-10">
                    @foreach($section['data'] as $product)
                        <a href="{{ route('product.show', $product->id) }}" class="product-card stagger-item">
                            <div class="product-img-box">
                                <img src="{{ asset('img/' . $product->gambar) }}" alt="{{ $product->nama }}">
                                <span class="cart-chip">Add to Cart</span>
                            </div>
                            <p class="product-name">{{ $product->nama }}</p>
                            <p class="product-price">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                        </a>
                    @endforeach
                </div>
            </section>
            @endif

        @endforeach

        @if($isSearch && $filteredMagazines->isEmpty() && $filteredTshirts->isEmpty() && $filteredJackets->isEmpty())
            <div style="padding:80px 0;text-align:center">
                <p class="empty-state">No Thrasher products match your search "{{ $search }}".</p>
            </div>
        @endif

    </main>

    <!-- FOOTER -->
    <footer>
        <div class="footer-inner">
            <div>
                <a href="/" class="footer-logo">mhm.co</a>
                <p class="footer-desc">find us at the nearest offline store and also we provide various online stores such as instagram, telegram, and tiktok.</p>

                @php
                    $sosmed = [
                        'instagram' => 'https://www.instagram.com/hilmimaaulana/',
                        'telegram'  => 'https://t.me/username_kamu',
                        'tiktok'    => '/https://www.tiktok.com/@hhhhhh.232323'
                    ];
                @endphp

                <div class="footer-social flex">
                    <a href="{{ $sosmed['instagram'] }}" target="_blank" aria-label="Instagram">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.332 3.608 1.308.975.975 1.247 2.242 1.308 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.062 1.366-.332 2.633-1.308 3.608-.975.975-2.242 1.247-3.608 1.308-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.062-2.633-.332-3.608-1.308-.975-.975-1.247-2.242-1.308-3.608-.058-1.266-.07-1.646-.07-4.85s.012-3.584.07-4.85c.062-1.366.332-2.633 1.308-3.608.975-.975 2.242-1.247 3.608-1.308 1.266-.058 1.646-.07 4.85-.07zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c.796 0 1.441.645 1.441 1.44s-.645 1.44-1.441 1.44c-.795 0-1.439-.645-1.439-1.44s.644-1.44 1.439-1.44z"/></svg>
                    </a>
                    <a href="{{ $sosmed['telegram'] }}" target="_blank" aria-label="Telegram">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5.891 8.146l-2.003 9.464c-.149.659-.541.823-1.091.515l-3.051-2.251-1.472 1.417c-.163.163-.3.298-.614.298l.218-3.102 5.645-5.101c.246-.219-.054-.341-.381-.123l-6.979 4.4z"/></svg>
                    </a>
                    <a href="{{ $sosmed['tiktok'] }}" target="_blank" aria-label="TikTok">
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
            <span class="footer-copy">thrasher collection</span>
        </div>
    </footer>

    <script>
        // ── SCROLL PROGRESS + HEADER + BACK TO TOP ──
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
        });

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
                    siblings.forEach((el, i) => { setTimeout(() => el.classList.add('visible'), i * 75); });
                    staggerObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.stagger-item:first-child').forEach(el => staggerObserver.observe(el));
    </script>
</body>
</html>