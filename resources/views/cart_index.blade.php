<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Your Cart - mhm.co</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,300&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --black: #0a0a0a;
            --white: #fafafa;
            --bg: #f4f4f2;
            --gray-soft: #f0f0ee;
            --gray-mid: #d4d4d0;
            --ink: #1a1a1a;
            --muted: #999;
        }

        * { box-sizing: border-box; }
        ::-webkit-scrollbar { display: none; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--black);
            overflow-x: hidden;
        }

        /* ── PAGE LOAD FADE ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up { opacity: 0; animation: fadeUp 0.6s cubic-bezier(0.4,0,0.2,1) forwards; }
        .delay-1 { animation-delay: 0.05s; }
        .delay-2 { animation-delay: 0.12s; }
        .delay-3 { animation-delay: 0.20s; }
        .delay-4 { animation-delay: 0.28s; }

        /* ── HEADER ── */
        .site-header {
            background: var(--white);
            border-bottom: 1px solid #e8e8e6;
            padding: 18px clamp(16px,5vw,40px);
        }
        .header-inner {
            max-width: 1000px; margin: 0 auto;
            display: flex; justify-content: space-between; align-items: center;
        }
        .site-logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 20px; letter-spacing: 0.15em;
            color: var(--black); text-decoration: none;
            transition: opacity 0.2s;
        }
        .site-logo:hover { opacity: 0.45; }
        .continue-link {
            font-family: 'DM Mono', monospace; font-size: 10px;
            letter-spacing: 0.15em; text-transform: lowercase;
            color: var(--ink); text-decoration: none;
            border-bottom: 1px solid var(--black); padding-bottom: 1px;
            transition: opacity 0.2s;
        }
        .continue-link:hover { opacity: 0.4; }

        /* ── MAIN ── */
        .main-wrap {
            max-width: 1000px; margin: 0 auto;
            padding: clamp(24px,6vw,56px) clamp(16px,5vw,40px);
        }

        /* ── PAGE HEADER ── */
        .page-header {
            display: flex; justify-content: space-between; align-items: flex-end;
            margin-bottom: clamp(24px,4vw,48px);
            flex-wrap: wrap; gap: 8px;
        }
        .page-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(28px, 6vw, 48px);
            letter-spacing: 0.1em; line-height: 1;
        }
        .page-subtitle {
            font-family: 'DM Mono', monospace; font-size: 10px;
            letter-spacing: 0.12em; color: var(--muted);
            text-transform: lowercase; padding-bottom: 4px;
        }

        /* ── SUCCESS BAR ── */
        .success-bar {
            background: var(--black); color: var(--white);
            font-family: 'DM Mono', monospace; font-size: 10px;
            letter-spacing: 0.2em; text-transform: uppercase;
            padding: 12px 16px; margin-bottom: 24px;
        }

        /* ── CART ITEM ── */
        .cart-item {
            background: var(--white);
            border: 1px solid #e8e8e6;
            padding: clamp(14px,3vw,24px);
            margin-bottom: 8px;
            display: grid;
            grid-template-columns: auto 1fr auto;
            align-items: center;
            gap: clamp(12px,2vw,24px);
            opacity: 0; transform: translateY(14px);
            transition: opacity 0.5s ease, transform 0.5s ease,
                        box-shadow 0.25s, border-color 0.25s;
        }
        .cart-item.visible { opacity: 1; transform: translateY(0); }
        .cart-item:hover { box-shadow: 0 4px 20px rgba(0,0,0,0.06); border-color: #ccc; }

        @media (max-width: 540px) {
            .cart-item {
                grid-template-columns: auto 1fr;
                grid-template-rows: auto auto;
            }
            .cart-item-actions {
                grid-column: 1 / -1;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding-top: 10px;
                border-top: 1px solid #f0f0ee;
            }
        }

        /* Thumbnail */
        .item-thumb {
            width: clamp(64px,12vw,88px);
            height: clamp(64px,12vw,88px);
            background: var(--gray-soft);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; overflow: hidden;
        }
        .item-thumb img {
            width: 85%; height: 85%;
            object-fit: contain; mix-blend-mode: multiply;
            transition: transform 0.5s cubic-bezier(0.4,0,0.2,1);
        }
        .cart-item:hover .item-thumb img { transform: scale(1.08); }

        /* Info */
        .item-info { min-width: 0; }
        .item-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(14px,2.5vw,18px);
            letter-spacing: 0.06em; font-style: italic; line-height: 1.1;
            margin-bottom: 4px;
            /* truncate long names */
            overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
        }
        .item-size {
            font-family: 'DM Mono', monospace; font-size: 10px;
            letter-spacing: 0.1em; text-transform: uppercase; color: var(--muted);
            margin-bottom: 3px;
        }
        .item-unit-price {
            font-family: 'DM Mono', monospace; font-size: 10px;
            letter-spacing: 0.05em; color: #bbb;
        }

        /* Actions column */
        .cart-item-actions {
            display: flex; align-items: center;
            gap: clamp(12px,2vw,28px); flex-shrink: 0;
        }
        .action-group { display: flex; flex-direction: column; align-items: flex-end; }
        .action-label {
            font-family: 'DM Mono', monospace; font-size: 9px;
            letter-spacing: 0.15em; text-transform: uppercase; color: var(--gray-mid);
            margin-bottom: 4px;
        }
        .action-value {
            font-family: 'DM Mono', monospace; font-size: 12px;
            color: var(--ink); letter-spacing: 0.04em;
        }
        .action-subtotal {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(14px,2vw,18px);
            letter-spacing: 0.06em;
        }

        /* Delete btn */
        .delete-btn {
            background: none; border: none; cursor: pointer;
            color: var(--gray-mid); padding: 4px;
            transition: color 0.2s, transform 0.2s;
            display: flex; align-items: center;
        }
        .delete-btn:hover { color: #c8281e; transform: scale(1.15); }

        /* ── DIVIDER ── */
        .cart-divider {
            border: none; border-top: 1px solid #e8e8e6;
            margin: clamp(16px,3vw,28px) 0;
        }

        /* ── ORDER SUMMARY ── */
        .summary-wrap {
            background: var(--white);
            border: 1px solid #e8e8e6;
            padding: clamp(20px,3vw,32px);
            margin-top: clamp(16px,3vw,28px);
        }
        .summary-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 18px; letter-spacing: 0.1em;
            margin-bottom: 20px;
        }
        .summary-row {
            display: flex; justify-content: space-between; align-items: baseline;
            margin-bottom: 10px;
        }
        .summary-row-label {
            font-family: 'DM Mono', monospace; font-size: 10px;
            letter-spacing: 0.1em; text-transform: uppercase; color: var(--muted);
        }
        .summary-row-value {
            font-family: 'DM Mono', monospace; font-size: 11px; color: var(--ink);
        }
        .summary-total-row {
            display: flex; justify-content: space-between; align-items: baseline;
            border-top: 1px solid #e8e8e6; padding-top: 16px; margin-top: 8px;
        }
        .summary-total-label {
            font-family: 'DM Mono', monospace; font-size: 11px;
            letter-spacing: 0.12em; text-transform: uppercase;
        }
        .summary-total-value {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(22px, 4vw, 30px);
            letter-spacing: 0.06em;
        }

        /* CTA buttons */
        .cta-row {
            display: flex; gap: 10px; margin-top: clamp(16px,3vw,24px);
            flex-wrap: wrap;
        }
        .btn-secondary {
            font-family: 'DM Mono', monospace; font-size: 10px;
            letter-spacing: 0.14em; text-transform: uppercase;
            padding: 14px 20px; border: 1px solid var(--black);
            background: transparent; color: var(--ink);
            text-decoration: none; text-align: center;
            transition: background 0.2s, color 0.2s;
            white-space: nowrap;
        }
        .btn-secondary:hover { background: var(--black); color: var(--white); }
        .btn-primary {
            font-family: 'DM Mono', monospace; font-size: 10px;
            letter-spacing: 0.14em; text-transform: uppercase;
            padding: 14px clamp(20px,4vw,40px);
            background: var(--black); color: var(--white);
            text-decoration: none; text-align: center; flex: 1;
            transition: background 0.2s, transform 0.15s;
            white-space: nowrap;
        }
        .btn-primary:hover { background: #333; transform: translateY(-1px); }
        .btn-primary:active { transform: translateY(0); }

        /* ── EMPTY STATE ── */
        .empty-wrap {
            background: var(--white);
            border: 2px dashed #e0e0de;
            padding: clamp(48px,12vw,100px) 20px;
            text-align: center;
        }
        .empty-icon {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(48px,10vw,80px);
            letter-spacing: 0.1em; color: #e0e0de;
            line-height: 1; margin-bottom: 16px;
        }
        .empty-text {
            font-family: 'DM Mono', monospace; font-size: 11px;
            letter-spacing: 0.1em; color: var(--muted); margin-bottom: 28px;
        }
        .btn-start {
            font-family: 'DM Mono', monospace; font-size: 10px;
            letter-spacing: 0.15em; text-transform: uppercase;
            background: var(--black); color: var(--white);
            padding: 14px 32px; text-decoration: none;
            display: inline-block;
            transition: background 0.2s, transform 0.15s;
        }
        .btn-start:hover { background: #333; transform: translateY(-1px); }

        /* ── SCROLL REVEAL ── */
        .reveal { opacity: 0; transform: translateY(18px); transition: opacity 0.55s ease, transform 0.55s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        /* ── FOOTER ── */
        .site-footer {
            text-align: center;
            padding: clamp(20px,4vw,40px) clamp(16px,5vw,40px);
            border-top: 1px solid #e8e8e6;
            margin-top: clamp(40px,6vw,80px);
        }
        .site-footer p {
            font-family: 'DM Mono', monospace; font-size: 10px;
            letter-spacing: 0.2em; text-transform: uppercase; color: var(--gray-mid);
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <header class="site-header fade-up delay-1">
        <div class="header-inner">
            <a href="/" class="site-logo">mhm.co</a>
            <a href="/" class="continue-link">← continue shopping</a>
        </div>
    </header>

    <main class="main-wrap">

        <!-- PAGE HEADER -->
        <div class="page-header fade-up delay-1">
            <h1 class="page-title">Shopping Cart</h1>
            @if(session('cart') && count(session('cart')) > 0)
                <span class="page-subtitle">review your items before checkout</span>
            @endif
        </div>

        <!-- SUCCESS -->
        @if(session('success'))
            <div class="success-bar fade-up delay-2">{{ session('success') }}</div>
        @endif

        @if(session('cart') && count(session('cart')) > 0)

            <!-- CART ITEMS -->
            <div id="cart-list">
                @php $total = 0 @endphp
                @foreach(session('cart') as $id => $details)
                    @php
                        $subtotal = ($details['harga'] ?? 0) * ($details['quantity'] ?? 0);
                        $total += $subtotal;
                        $isMagazine = stripos($details['nama'] ?? '', 'magazine') !== false ||
                                      stripos($details['nama'] ?? '', 'thrasher t-funk') !== false;
                    @endphp
                    <div class="cart-item">

                        <!-- Thumbnail -->
                        <div class="item-thumb">
                            <img src="{{ asset('img/' . ($details['gambar'] ?? '')) }}" alt="{{ $details['nama'] ?? '' }}">
                        </div>

                        <!-- Info -->
                        <div class="item-info">
                            <h3 class="item-name" title="{{ $details['nama'] ?? 'Unknown Product' }}">
                                {{ $details['nama'] ?? 'Unknown Product' }}
                            </h3>
                            @if(!$isMagazine)
                                <p class="item-size">size: {{ $details['size'] ?? 'N/A' }}</p>
                            @endif
                            <p class="item-unit-price">Rp {{ number_format($details['harga'] ?? 0, 0, ',', '.') }} / pcs</p>
                        </div>

                        <!-- Actions -->
                        <div class="cart-item-actions">
                            <div class="action-group">
                                <span class="action-label">qty</span>
                                <span class="action-value">{{ $details['quantity'] ?? 0 }}</span>
                            </div>
                            <div class="action-group">
                                <span class="action-label">subtotal</span>
                                <span class="action-subtotal">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" onclick="return confirm('Remove this item from cart?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </form>
                        </div>

                    </div>
                @endforeach
            </div>

            <!-- ORDER SUMMARY -->
            <div class="summary-wrap reveal">
                <h2 class="summary-title">Order Summary</h2>

                <div class="summary-row">
                    <span class="summary-row-label">{{ count(session('cart')) }} item{{ count(session('cart')) > 1 ? 's' : '' }}</span>
                    <span class="summary-row-value">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <div class="summary-row">
                    <span class="summary-row-label">shipping</span>
                    <span class="summary-row-value" style="color:#aaa">calculated at checkout</span>
                </div>

                <div class="summary-total-row">
                    <span class="summary-total-label">Total</span>
                    <span class="summary-total-value">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>

                <div class="cta-row">
                    <a href="/" class="btn-secondary">Back to Shop</a>
                    <a href="{{ route('checkout.payment') }}" class="btn-primary">Checkout Now →</a>
                </div>
            </div>

        @else

            <!-- EMPTY STATE -->
            <div class="empty-wrap fade-up delay-3">
                <div class="empty-icon">BAG</div>
                <p class="empty-text">your shopping bag is currently empty.</p>
                <a href="/" class="btn-start">Start Shopping</a>
            </div>

        @endif

    </main>

    <!-- FOOTER -->
    <footer class="site-footer">
        <p>&copy; {{ date('Y') }} mhm.co — all rights reserved</p>
    </footer>

    <script>
        // ── STAGGER CART ITEMS ──
        const items = document.querySelectorAll('.cart-item');
        items.forEach((item, i) => {
            setTimeout(() => item.classList.add('visible'), i * 80);
        });

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
    </script>
</body>
</html>