<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mhm.co | admin dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar-active { border-right: 3px solid black; background: #fcfcfc; }
        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); transition: transform 0.3s ease; }
            .sidebar.open { transform: translateX(0); }
        }
    </style>
</head>
<body class="bg-[#F4F7F6] text-zinc-900 antialiased">
    
    <header class="lg:hidden bg-white border-b p-4 flex justify-between items-center sticky top-0 z-50">
        <div class="font-bold text-xl tracking-tighter">mhm.co</div>
        <button onclick="toggleSidebar()" class="p-2 bg-black text-white rounded-lg">
            <i data-lucide="menu" class="w-6 h-6"></i>
        </button>
    </header>

    <div class="flex min-h-screen relative">
        <aside id="sidebar" class="sidebar fixed inset-y-0 left-0 w-72 bg-white border-r z-50 lg:translate-x-0 lg:static flex flex-col p-8">
            <div class="hidden lg:block font-extrabold text-2xl tracking-tighter mb-12 italic">mhm.co</div>
            
            <nav class="flex flex-col gap-2 text-[14px] flex-1">
                <p class="text-[10px] uppercase tracking-[0.2em] text-zinc-400 font-bold mb-2">main menu</p>
                <a href="/" class="flex items-center gap-3 px-4 py-3 text-zinc-500 hover:text-black hover:bg-zinc-50 rounded-xl transition">
                    <i data-lucide="external-link" class="w-4 h-4"></i> view store
                </a>
                <a href="/admin" class="flex items-center gap-3 px-4 py-3 font-bold bg-zinc-100 text-black rounded-xl border-l-4 border-black">
                    <i data-lucide="package" class="w-4 h-4"></i> all products
                </a>
                <a href="/admin/add" class="flex items-center gap-3 px-4 py-3 text-zinc-500 hover:text-black hover:bg-zinc-50 rounded-xl transition">
                    <i data-lucide="plus-circle" class="w-4 h-4"></i> add product
                </a>
                
                <p class="text-[10px] uppercase tracking-[0.2em] text-zinc-400 font-bold mt-6 mb-2">transactions</p>
                <a href="{{ route('admin.orders') }}" class="flex items-center gap-3 px-4 py-3 text-zinc-500 hover:text-black hover:bg-zinc-50 rounded-xl transition">
                    <i data-lucide="shopping-bag" class="w-4 h-4"></i> order history
                </a>
                <a href="{{ route('admin.messages') }}" class="flex items-center gap-3 px-4 py-3 text-zinc-500 hover:text-black hover:bg-zinc-50 rounded-xl transition">
                    <i data-lucide="mail" class="w-4 h-4"></i> inbox messages
                </a>
            </nav>

            <div class="pt-6 border-t">
                <div class="bg-zinc-900 rounded-2xl p-4 text-white">
                    <p class="text-[10px] opacity-60 uppercase font-bold tracking-widest">logged in as</p>
                    <p class="font-medium truncate">{{ Auth::user()->name ?? 'admin' }}</p>
                </div>
            </div>
        </aside>

        <div id="overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/20 backdrop-blur-sm z-40 hidden lg:hidden"></div>

        <main class="flex-1 p-6 lg:p-12 w-full overflow-hidden">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
                <div>
                    <h1 class="text-3xl font-extrabold tracking-tight text-zinc-900">manage products</h1>
                    <p class="text-zinc-500 text-sm mt-1">overview of your store inventory and items.</p>
                </div>
                
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.orders') }}" class="flex items-center gap-2 text-[12px] font-bold uppercase tracking-wider bg-white border border-zinc-200 px-5 py-3 rounded-full hover:bg-zinc-50 transition shadow-sm">
                        <i data-lucide="eye" class="w-4 h-4"></i> view orders
                    </a>
                    <a href="/admin/add" class="flex items-center gap-2 text-[12px] font-bold uppercase tracking-wider bg-black text-white px-5 py-3 rounded-full hover:bg-zinc-800 transition shadow-lg shadow-black/10">
                        <i data-lucide="plus" class="w-4 h-4"></i> new product
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 flex items-center gap-3 bg-emerald-50 border border-emerald-100 text-emerald-700 px-4 py-3 rounded-2xl animate-fade-in">
                    <i data-lucide="check-circle" class="w-5 h-5"></i>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
            @endif
            
            <div class="bg-white rounded-3xl border border-zinc-100 shadow-xl shadow-zinc-200/50 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-zinc-50/50">
                                <th class="p-6 text-[10px] font-bold uppercase tracking-[0.2em] text-zinc-400 border-b border-zinc-100">product info</th>
                                <th class="p-6 text-[10px] font-bold uppercase tracking-[0.2em] text-zinc-400 border-b border-zinc-100">category</th>
                                <th class="p-6 text-[10px] font-bold uppercase tracking-[0.2em] text-zinc-400 border-b border-zinc-100">price</th>
                                <th class="p-6 text-[10px] font-bold uppercase tracking-[0.2em] text-zinc-400 border-b border-zinc-100 text-right">actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-50">
                            @foreach($products as $item)
                            <tr class="hover:bg-zinc-50/80 transition-colors group">
                                <td class="p-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-14 h-14 rounded-2xl bg-zinc-100 flex-shrink-0 overflow-hidden border border-zinc-100 group-hover:scale-105 transition-transform">
                                            <img src="{{ asset('img/' . $item->gambar) }}" class="w-full h-full object-cover p-2">
                                        </div>
                                        <div>
                                            <p class="font-bold text-zinc-900 group-hover:text-black transition-colors">{{ $item->nama }}</p>
                                            <p class="text-[11px] text-zinc-400 font-medium">id: #PROD-{{ $item->id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-6">
                                    @php
                                        $cat = 'Other';
                                        $color = 'bg-zinc-100 text-zinc-500';
                                        if(stripos($item->nama, 'vans') !== false) { $cat = 'Vans'; $color = 'bg-red-50 text-red-600'; }
                                        elseif(stripos($item->nama, 'converse') !== false) { $cat = 'Converse'; $color = 'bg-blue-50 text-blue-600'; }
                                        elseif(stripos($item->nama, 'thrasher') !== false) { $cat = 'Thrasher'; $color = 'bg-orange-50 text-orange-600'; }
                                    @endphp
                                    <span class="{{ $color }} px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">
                                        {{ $cat }}
                                    </span>
                                </td>
                                <td class="p-6 font-bold text-zinc-900">
                                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </td>
                                <td class="p-6">
                                    <div class="flex justify-end gap-2">
                                        <a href="/admin/edit/{{ $item->id }}" class="p-2 text-zinc-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit Product">
                                            <i data-lucide="edit-3" class="w-5 h-5"></i>
                                        </a>
                                        <form action="/admin/delete/{{ $item->id }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2 text-zinc-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Delete Product">
                                                <i data-lucide="trash-2" class="w-5 h-5"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($products->isEmpty())
                    <div class="py-24 text-center">
                        <div class="bg-zinc-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="package-search" class="w-10 h-10 text-zinc-300"></i>
                        </div>
                        <h3 class="text-zinc-900 font-bold">No products found</h3>
                        <p class="text-zinc-400 text-sm italic">Start building your catalog by adding your first product.</p>
                    </div>
                @endif
            </div>
            
            <footer class="mt-12 text-center lg:text-left">
                <p class="text-zinc-400 text-[11px] font-medium tracking-widest uppercase">&copy; 2026 mhm.co dashboard &bull; built with passion</p>
            </footer>
        </main>
    </div>

    <script>
        // Initialize Lucide Icons
        lucide.createIcons();

        // Toggle Mobile Sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('hidden');
        }
    </script>
</body>
</html>