<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mhm.co | order history</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); transition: transform 0.3s ease; }
            .sidebar.open { transform: translateX(0); }
        }
    </style>
</head>
<body class="bg-[#F4F7F6] text-zinc-900 antialiased">

    <header class="lg:hidden bg-white border-b p-4 flex justify-between items-center sticky top-0 z-50">
        <div class="font-bold text-xl tracking-tighter uppercase italic">mhm.co</div>
        <button onclick="toggleSidebar()" class="p-2 bg-black text-white rounded-lg">
            <i data-lucide="menu" class="w-6 h-6"></i>
        </button>
    </header>

    <div class="flex min-h-screen relative">
        <aside id="sidebar" class="sidebar fixed inset-y-0 left-0 w-72 bg-white border-r z-50 lg:translate-x-0 lg:static flex flex-col p-8">
            <div class="hidden lg:block font-extrabold text-2xl tracking-tighter mb-12 italic uppercase text-black">mhm.co</div>
            
            <nav class="flex flex-col gap-2 text-[14px] flex-1">
                <p class="text-[10px] uppercase tracking-[0.2em] text-zinc-400 font-bold mb-2">main menu</p>
                <a href="/" class="flex items-center gap-3 px-4 py-3 text-zinc-500 hover:text-black hover:bg-zinc-50 rounded-xl transition">
                    <i data-lucide="external-link" class="w-4 h-4"></i> view store
                </a>
                <a href="/admin" class="flex items-center gap-3 px-4 py-3 text-zinc-500 hover:text-black hover:bg-zinc-50 rounded-xl transition">
                    <i data-lucide="package" class="w-4 h-4"></i> all products
                </a>
                <a href="/admin/add" class="flex items-center gap-3 px-4 py-3 text-zinc-500 hover:text-black hover:bg-zinc-50 rounded-xl transition">
                    <i data-lucide="plus-circle" class="w-4 h-4"></i> add product
                </a>
                
                <p class="text-[10px] uppercase tracking-[0.2em] text-zinc-400 font-bold mt-6 mb-2">transactions</p>
                <a href="{{ route('admin.orders') }}" class="flex items-center gap-3 px-4 py-3 font-bold bg-zinc-900 text-white rounded-xl shadow-lg shadow-black/10 transition">
                    <i data-lucide="shopping-bag" class="w-4 h-4"></i> order history
                </a>
                <a href="{{ route('admin.messages') }}" class="flex items-center gap-3 px-4 py-3 text-zinc-500 hover:text-black hover:bg-zinc-50 rounded-xl transition">
                    <i data-lucide="mail" class="w-4 h-4"></i> inbox messages
                </a>
            </nav>

            <div class="pt-6 border-t">
                <p class="text-[10px] text-zinc-400 italic">&copy; 2026 mhm.co system</p>
            </div>
        </aside>

        <div id="overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/20 backdrop-blur-sm z-40 hidden lg:hidden"></div>

        <main class="flex-1 p-6 lg:p-12 w-full overflow-hidden">
            <header class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mb-10">
                <div>
                    <h1 class="text-4xl font-extrabold tracking-tight text-zinc-900">order history</h1>
                    <p class="text-zinc-500 text-sm mt-1">laporan pesanan masuk dan status pengiriman.</p>
                </div>
                <div class="text-left md:text-right">
                    <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest bg-white border border-zinc-200 px-3 py-1.5 rounded-full inline-block">
                        last update: {{ date('H:i') }}
                    </p>
                </div>
            </header>

            {{-- Notifikasi Sukses --}}
            @if(session('success'))
                <div class="mb-8 flex items-center gap-3 bg-emerald-50 border border-emerald-100 text-emerald-700 px-5 py-4 rounded-2xl animate-fade-in shadow-sm">
                    <i data-lucide="check-circle" class="w-5 h-5"></i>
                    <span class="text-sm font-semibold uppercase tracking-wide">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Card Statistik --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10">
                <div class="bg-white p-6 rounded-3xl border border-zinc-100 shadow-xl shadow-zinc-200/50">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl"><i data-lucide="list"></i></div>
                        <div>
                            <span class="text-[10px] text-zinc-400 uppercase font-bold tracking-widest">total orders</span>
                            <p class="text-2xl font-extrabold text-zinc-900">{{ count($orders) }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-zinc-100 shadow-xl shadow-zinc-200/50">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-emerald-50 text-emerald-600 rounded-2xl"><i data-lucide="wallet"></i></div>
                        <div>
                            <span class="text-[10px] text-zinc-400 uppercase font-bold tracking-widest">revenue estimate</span>
                            <p class="text-2xl font-extrabold text-zinc-900">Rp {{ number_format($orders->sum(fn($o) => (int)$o->harga * (int)$o->quantity), 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-zinc-100 shadow-xl shadow-zinc-200/50">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-amber-50 text-amber-600 rounded-2xl"><i data-lucide="check-square"></i></div>
                        <div>
                            <span class="text-[10px] text-zinc-400 uppercase font-bold tracking-widest">paid orders</span>
                            <p class="text-2xl font-extrabold text-zinc-900">{{ $orders->where('payment_status', 'lunas')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabel Pesanan --}}
            <div class="bg-white rounded-3xl border border-zinc-100 shadow-xl shadow-zinc-200/50 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-zinc-50/50">
                                <th class="p-6 text-[10px] font-bold uppercase tracking-[0.2em] text-zinc-400 border-b border-zinc-100">customer & date</th>
                                <th class="p-6 text-[10px] font-bold uppercase tracking-[0.2em] text-zinc-400 border-b border-zinc-100">product details</th>
                                <th class="p-6 text-[10px] font-bold uppercase tracking-[0.2em] text-zinc-400 border-b border-zinc-100">total</th>
                                <th class="p-6 text-[10px] font-bold uppercase tracking-[0.2em] text-zinc-400 border-b border-zinc-100 text-center">payment</th>
                                <th class="p-6 text-[10px] font-bold uppercase tracking-[0.2em] text-zinc-400 border-b border-zinc-100 text-center">shipping action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-50">
                            @forelse($orders as $order)
                            <tr class="hover:bg-zinc-50/80 transition group">
                                <td class="p-6">
                                    <p class="font-bold text-zinc-900 uppercase leading-none">{{ $order->user->name ?? 'Guest' }}</p>
                                    <p class="text-[11px] text-zinc-400 mt-1.5 font-medium italic">{{ $order->created_at->format('d M, H:i') }}</p>
                                </td>
                                <td class="p-6">
                                    <p class="text-sm font-bold uppercase text-zinc-800">{{ $order->nama_produk }}</p>
                                    <div class="flex gap-2 mt-1">
                                        <span class="text-[9px] font-bold px-2 py-0.5 bg-zinc-100 rounded text-zinc-500 uppercase">Size: {{ $order->size }}</span>
                                        <span class="text-[9px] font-bold px-2 py-0.5 bg-zinc-100 rounded text-zinc-500 uppercase">Qty: {{ $order->quantity }}x</span>
                                    </div>
                                </td>
                                <td class="p-6 font-bold text-zinc-900 text-sm">
                                    Rp {{ number_format($order->harga * $order->quantity, 0, ',', '.') }}
                                </td>
                                
                                <td class="p-6 text-center">
                                    @if($order->payment_status == 'lunas')
                                        <span class="inline-flex items-center gap-1 px-3 py-1.5 text-[9px] font-bold uppercase tracking-widest bg-emerald-100 text-emerald-700 rounded-full">
                                            <i data-lucide="check" class="w-3 h-3"></i> lunas
                                        </span>
                                    @else
                                        <form action="{{ route('admin.orders.updatePayment', [$order->id, 'lunas']) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="px-4 py-2 text-[9px] font-bold uppercase tracking-widest bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-all border border-red-100">
                                                konfirmasi bayar
                                            </button>
                                        </form>
                                    @endif
                                </td>

                                <td class="p-6">
                                    <div class="flex flex-col items-center gap-2">
                                        @if($order->status == 'pending')
                                            <a href="{{ route('admin.order.status', [$order->id, 'dikemas']) }}" class="w-full max-w-[120px] py-2 text-[9px] font-bold uppercase bg-amber-500 text-white rounded-xl text-center hover:bg-amber-600 transition shadow-lg shadow-amber-200/50">
                                                kemas barang
                                            </a>
                                        @elseif($order->status == 'dikemas')
                                            <span class="text-[9px] font-bold text-amber-600 uppercase mb-1">📦 dikemas</span>
                                            <a href="{{ route('admin.order.status', [$order->id, 'dikirim']) }}" class="w-full max-w-[120px] py-2 text-[9px] font-bold uppercase bg-blue-500 text-white rounded-xl text-center hover:bg-blue-600 transition shadow-lg shadow-blue-200/50">
                                                kirim barang
                                            </a>
                                        @elseif($order->status == 'dikirim')
                                            <span class="text-[9px] font-bold text-blue-600 uppercase mb-1">🚚 dikirim</span>
                                            <a href="{{ route('admin.order.status', [$order->id, 'tiba']) }}" class="w-full max-w-[120px] py-2 text-[9px] font-bold uppercase bg-emerald-600 text-white rounded-xl text-center hover:bg-emerald-700 transition shadow-lg shadow-emerald-200/50">
                                                konfirmasi tiba
                                            </a>
                                        @elseif($order->status == 'tiba')
                                            <span class="inline-flex items-center gap-1.5 px-4 py-2 text-[9px] font-bold uppercase tracking-widest bg-zinc-900 text-white rounded-xl">
                                                <i data-lucide="check-circle-2" class="w-3 h-3 text-emerald-400"></i> selesai
                                            </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-24 text-center">
                                    <div class="bg-zinc-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i data-lucide="ghost" class="w-10 h-10 text-zinc-300"></i>
                                    </div>
                                    <h3 class="text-zinc-900 font-bold">No orders yet</h3>
                                    <p class="text-zinc-400 text-sm italic">Belum ada riwayat pesanan yang masuk.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-12 flex justify-center lg:justify-start">
                <a href="/admin" class="group inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[0.2em] text-zinc-400 hover:text-black transition">
                    <i data-lucide="chevron-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i> 
                    back to dashboard
                </a>
            </div>
        </main>
    </div>

    <script>
        lucide.createIcons();
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('hidden');
        }
    </script>
</body>
</html>