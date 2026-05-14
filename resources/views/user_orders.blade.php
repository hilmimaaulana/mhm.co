<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - mhm.co</title>
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
        .delay-1 { animation-delay: 0.06s; }
        .delay-2 { animation-delay: 0.14s; }
        .delay-3 { animation-delay: 0.22s; }
        .delay-4 { animation-delay: 0.30s; }

        /* ── HEADER ── */
        .site-header {
            background: var(--black);
            border-bottom: 1px solid #1a1a1a;
            padding: 18px clamp(16px,5vw,40px);
            position: sticky; top: 0; z-index: 50;
        }
        .header-inner {
            max-width: 1200px; margin: 0 auto;
            display: flex; justify-content: space-between; align-items: center;
        }
        .site-logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 20px; letter-spacing: 0.15em;
            color: var(--white); text-decoration: none;
            transition: opacity 0.2s;
        }
        .site-logo:hover { opacity: 0.5; }
        .logout-btn {
            font-family: 'DM Mono', monospace;
            font-size: 10px; letter-spacing: 0.15em; text-transform: uppercase;
            color: #c8281e; background: none; border: 1px solid #2a2a2a;
            padding: 6px 14px; cursor: pointer;
            transition: background 0.2s, color 0.2s, border-color 0.2s;
        }
        .logout-btn:hover { background: #c8281e; color: var(--white); border-color: #c8281e; }

        /* ── MAIN LAYOUT ── */
        .main-wrap {
            max-width: 1200px; margin: 0 auto;
            padding: clamp(24px,6vw,56px) clamp(16px,5vw,40px);
        }

        /* ── PAGE TITLE ── */
        .page-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(32px, 6vw, 52px);
            letter-spacing: 0.1em; font-style: italic; line-height: 1;
            margin-bottom: 6px;
        }
        .page-subtitle {
            font-family: 'DM Mono', monospace; font-size: 11px;
            letter-spacing: 0.1em; color: var(--muted); text-transform: lowercase;
        }

        /* ── SUCCESS BANNER ── */
        .success-bar {
            background: var(--black); color: var(--white);
            font-family: 'DM Mono', monospace; font-size: 10px;
            letter-spacing: 0.2em; text-transform: uppercase;
            padding: 12px 16px; margin-bottom: 24px;
        }

        /* ── GRID ── */
        .profile-grid {
            display: grid;
            grid-template-columns: 260px 1fr;
            gap: clamp(20px, 4vw, 48px);
            margin-top: clamp(28px, 4vw, 48px);
        }
        @media (max-width: 768px) {
            .profile-grid { grid-template-columns: 1fr; }
        }

        /* ── SIDEBAR CARD ── */
        .sidebar-card {
            background: var(--white);
            border: 1px solid #e8e8e6;
            padding: clamp(20px, 3vw, 32px);
            position: sticky; top: 72px;
            align-self: start;
        }
        @media (max-width: 768px) {
            .sidebar-card { position: static; }
        }

        /* Avatar */
        .avatar {
            width: 56px; height: 56px;
            background: var(--black);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 20px;
        }
        .avatar span {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px; letter-spacing: 0.1em;
            color: var(--white);
        }
        .user-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px; letter-spacing: 0.08em; line-height: 1;
            margin-bottom: 4px;
        }
        .user-email {
            font-family: 'DM Mono', monospace; font-size: 10px;
            color: var(--muted); letter-spacing: 0.05em;
            word-break: break-all;
        }
        .sidebar-divider {
            border: none; border-top: 1px solid #ebebeb;
            margin: 20px 0;
        }
        .meta-label {
            font-family: 'DM Mono', monospace; font-size: 9px;
            letter-spacing: 0.2em; text-transform: uppercase; color: var(--gray-mid);
            display: block; margin-bottom: 6px;
        }
        .meta-value {
            font-family: 'DM Mono', monospace; font-size: 12px;
            color: var(--ink);
        }

        /* stat pills */
        .stat-row {
            display: flex; gap: 8px; margin-top: 16px; flex-wrap: wrap;
        }
        .stat-pill {
            background: var(--bg); border: 1px solid #e8e8e6;
            padding: 8px 12px; flex: 1; min-width: 0;
        }
        .stat-pill-num {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px; letter-spacing: 0.06em; line-height: 1;
        }
        .stat-pill-label {
            font-family: 'DM Mono', monospace; font-size: 9px;
            letter-spacing: 0.1em; text-transform: uppercase; color: var(--muted);
            margin-top: 2px;
        }

        /* ── ORDERS SECTION ── */
        .section-heading {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(18px, 3vw, 24px);
            letter-spacing: 0.1em; font-style: italic;
            margin-bottom: clamp(16px, 3vw, 28px);
        }

        /* ── ORDER CARD ── */
        .order-card {
            background: var(--white);
            border: 1px solid #e8e8e6;
            padding: clamp(16px, 3vw, 28px);
            margin-bottom: 12px;
            transition: box-shadow 0.25s, border-color 0.25s;
        }
        .order-card:hover { box-shadow: 0 4px 24px rgba(0,0,0,0.06); border-color: #ccc; }

        .order-card-inner {
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: clamp(12px, 2vw, 24px);
            align-items: start;
        }
        @media (max-width: 600px) {
            .order-card-inner { grid-template-columns: auto 1fr; }
            .order-card-meta { grid-column: 1 / -1; border-top: 1px solid #f0f0f0; padding-top: 12px; }
        }

        /* Product thumbnail */
        .product-thumb {
            width: clamp(72px, 12vw, 88px);
            height: clamp(72px, 12vw, 88px);
            background: var(--gray-soft);
            display: flex; align-items: center; justify-content: center;
            overflow: hidden; flex-shrink: 0;
        }
        .product-thumb img {
            width: 80%; height: 80%; object-fit: contain; mix-blend-mode: multiply;
        }

        /* Product info */
        .order-date {
            font-family: 'DM Mono', monospace; font-size: 9px;
            letter-spacing: 0.15em; text-transform: uppercase; color: var(--gray-mid);
            margin-bottom: 6px;
        }
        .order-product-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(15px, 2.5vw, 18px);
            letter-spacing: 0.06em; font-style: italic; line-height: 1.1;
            margin-bottom: 6px;
        }
        .order-detail {
            font-family: 'DM Mono', monospace; font-size: 10px;
            letter-spacing: 0.05em; color: var(--muted);
            margin-bottom: 6px;
        }
        .order-price {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(16px, 2.5vw, 20px);
            letter-spacing: 0.06em;
        }

        /* Meta column */
        .order-card-meta {
            display: flex; flex-direction: column; gap: 14px;
            min-width: clamp(140px, 20vw, 200px);
        }
        .meta-group { }
        .meta-group-label {
            font-family: 'DM Mono', monospace; font-size: 9px;
            letter-spacing: 0.2em; text-transform: uppercase; color: var(--gray-mid);
            margin-bottom: 4px;
        }

        /* Payment status */
        .payment-paid {
            font-family: 'DM Mono', monospace; font-size: 11px;
            font-weight: 500; color: #16a34a; letter-spacing: 0.05em;
        }
        .payment-pending {
            font-family: 'DM Mono', monospace; font-size: 11px;
            font-weight: 500; color: #d97706; letter-spacing: 0.05em;
        }

        /* Tracking badge */
        .tracking-badge {
            display: inline-block;
            font-family: 'DM Mono', monospace; font-size: 9px;
            letter-spacing: 0.1em; text-transform: uppercase;
            padding: 5px 10px; font-weight: 500;
        }
        .badge-pending  { background: #f0f0f0; color: #888; }
        .badge-dikemas  { background: #fef3c7; color: #92400e; }
        .badge-dikirim  { background: #dbeafe; color: #1d4ed8; }
        .badge-tiba     { background: var(--black); color: var(--white); }

        /* Rating */
        .rating-form {
            display: flex; align-items: center; gap: 6px; flex-wrap: wrap;
        }
        .rating-select {
            font-family: 'DM Mono', monospace; font-size: 10px;
            border: 1px solid #e0e0de; padding: 5px 8px;
            background: var(--white); color: var(--ink);
            outline: none; cursor: pointer;
            transition: border-color 0.2s;
        }
        .rating-select:focus { border-color: var(--black); }
        .rating-btn {
            font-family: 'DM Mono', monospace; font-size: 9px;
            letter-spacing: 0.12em; text-transform: uppercase;
            background: var(--black); color: var(--white);
            border: none; padding: 6px 14px; cursor: pointer;
            transition: background 0.2s;
        }
        .rating-btn:hover { background: #333; }
        .rating-done {
            font-family: 'DM Mono', monospace; font-size: 11px;
            color: #ca8a04; letter-spacing: 0.05em;
        }

        /* ── EMPTY STATE ── */
        .empty-state {
            text-align: center;
            padding: clamp(48px, 10vw, 80px) 20px;
            border: 2px dashed #e0e0de;
            background: var(--white);
        }
        .empty-state-icon {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 64px; letter-spacing: 0.1em; color: #e8e8e6;
            line-height: 1; margin-bottom: 16px;
        }
        .empty-state p {
            font-family: 'DM Mono', monospace; font-size: 11px;
            color: var(--muted); letter-spacing: 0.1em;
        }

        /* ── SCROLL REVEAL ── */
        .reveal { opacity: 0; transform: translateY(20px); transition: opacity 0.55s ease, transform 0.55s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        /* stagger order cards */
        .order-card {
            opacity: 0; transform: translateY(16px);
            transition: opacity 0.5s ease, transform 0.5s ease,
                        box-shadow 0.25s, border-color 0.25s;
        }
        .order-card.visible { opacity: 1; transform: translateY(0); }

        /* ── FOOTER ── */
        .site-footer {
            text-align: center;
            padding: clamp(24px,4vw,40px) clamp(16px,5vw,40px);
            border-top: 1px solid #e8e8e6;
            margin-top: clamp(40px,6vw,80px);
        }
        .site-footer p {
            font-family: 'DM Mono', monospace; font-size: 10px;
            letter-spacing: 0.25em; text-transform: uppercase; color: var(--gray-mid);
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <header class="site-header">
        <div class="header-inner">
            <a href="/" class="site-logo">mhm.co</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">logout</button>
            </form>
        </div>
    </header>

    <main class="main-wrap">

        <!-- PAGE TITLE -->
        <div class="fade-up delay-1">
            <h1 class="page-title">Profile Account</h1>
            <p class="page-subtitle">manage your orders and track your shipments.</p>
        </div>

        <!-- SUCCESS BANNER -->
        @if(session('success'))
            <div class="success-bar fade-up delay-2">{{ session('success') }}</div>
        @endif

        <div class="profile-grid">

            <!-- ── SIDEBAR ── -->
            <aside class="fade-up delay-2">
                <div class="sidebar-card">

                    <div class="avatar">
                        <span>{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>

                    <h3 class="user-name">{{ Auth::user()->name }}</h3>
                    <p class="user-email">{{ Auth::user()->email }}</p>

                    <hr class="sidebar-divider">

                    <span class="meta-label">member since</span>
                    <span class="meta-value">{{ Auth::user()->created_at->format('M Y') }}</span>

                    <div class="stat-row">
                        <div class="stat-pill">
                            <div class="stat-pill-num">{{ $orders->count() }}</div>
                            <div class="stat-pill-label">orders</div>
                        </div>
                        <div class="stat-pill">
                            <div class="stat-pill-num">{{ $orders->where('payment_status','lunas')->count() }}</div>
                            <div class="stat-pill-label">paid</div>
                        </div>
                    </div>

                </div>
            </aside>

            <!-- ── ORDERS ── -->
            <div>
                <h2 class="section-heading fade-up delay-3">Your Shopping History</h2>

                @forelse($orders as $order)
                <div class="order-card">
                    <div class="order-card-inner">

                        <!-- Thumbnail -->
                        <div class="product-thumb">
                            @if($order->product && $order->product->gambar)
                                <img src="{{ asset('img/' . $order->product->gambar) }}" alt="{{ $order->nama_produk }}">
                            @else
                                <img src="{{ asset('img/default_shoe.png') }}" alt="default" style="opacity:0.2;width:60%;height:60%;object-fit:contain">
                            @endif
                        </div>

                        <!-- Info -->
                        <div>
                            <p class="order-date">{{ $order->created_at->format('d M Y') }}</p>
                            <h4 class="order-product-name">{{ $order->nama_produk }}</h4>
                            <p class="order-detail">size: {{ $order->size }} &nbsp;·&nbsp; qty: {{ $order->quantity }}</p>
                            <p class="order-price">Rp {{ number_format($order->harga * $order->quantity, 0, ',', '.') }}</p>
                        </div>

                        <!-- Meta -->
                        <div class="order-card-meta">

                            <!-- Payment -->
                            <div class="meta-group">
                                <p class="meta-group-label">payment</p>
                                <span class="{{ $order->payment_status == 'lunas' ? 'payment-paid' : 'payment-pending' }}">
                                    {{ $order->payment_status }}
                                </span>
                            </div>

                            <!-- Tracking -->
                            <div class="meta-group">
                                <p class="meta-group-label">tracking</p>
                                @php
                                    $statusLabels = [
                                        'pending' => ['label' => 'menunggu konfirmasi', 'class' => 'badge-pending'],
                                        'dikemas' => ['label' => 'sedang dikemas',      'class' => 'badge-dikemas'],
                                        'dikirim' => ['label' => 'dalam perjalanan',    'class' => 'badge-dikirim'],
                                        'tiba'    => ['label' => 'pesanan telah tiba',  'class' => 'badge-tiba'],
                                    ];
                                    $currentStatus = $statusLabels[$order->status] ?? $statusLabels['pending'];
                                @endphp
                                <span class="tracking-badge {{ $currentStatus['class'] }}">
                                    {{ $currentStatus['label'] }}
                                </span>
                            </div>

                            <!-- Rating -->
                            <div class="meta-group">
                                <p class="meta-group-label">rating</p>
                                @if(!$order->rating)
                                    <form action="{{ route('user.orders.rate', $order->id) }}" method="POST" class="rating-form">
                                        @csrf
                                        <select name="rating" class="rating-select">
                                            <option value="5">5 ★</option>
                                            <option value="4">4 ★</option>
                                            <option value="3">3 ★</option>
                                            <option value="2">2 ★</option>
                                            <option value="1">1 ★</option>
                                        </select>
                                        <button type="submit" class="rating-btn">rate</button>
                                    </form>
                                @else
                                    <span class="rating-done">{{ $order->rating }} / 5 ★</span>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
                @empty
                <div class="empty-state fade-up delay-4">
                    <div class="empty-state-icon">BAG</div>
                    <p>you haven't ordered anything yet.</p>
                </div>
                @endforelse

            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="site-footer">
        <p>&copy; 2026 mhm.co — worldwide shipping</p>
    </footer>

    <script>
        // ── SCROLL REVEAL ──
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.06 });
        document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

        // ── STAGGER ORDER CARDS ──
        const cards = document.querySelectorAll('.order-card');
        const cardObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // stagger siblings
                    const allCards = document.querySelectorAll('.order-card');
                    allCards.forEach((card, i) => {
                        setTimeout(() => card.classList.add('visible'), i * 80);
                    });
                    cardObserver.disconnect();
                }
            });
        }, { threshold: 0.04 });
        if (cards.length > 0) cardObserver.observe(cards[0]);
        else document.querySelectorAll('.order-card').forEach(c => c.classList.add('visible'));
    </script>
</body>
</html>