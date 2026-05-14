<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mhm.co | edit product</title>
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
                <p class="text-[10px] uppercase tracking-[0.2em] text-zinc-400 font-bold mb-2">management</p>
                <a href="/admin" class="flex items-center gap-3 px-4 py-3 font-bold bg-zinc-100 text-black rounded-xl transition">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i> back to list
                </a>
                <a href="/" class="flex items-center gap-3 px-4 py-3 text-zinc-500 hover:text-black hover:bg-zinc-50 rounded-xl transition">
                    <i data-lucide="external-link" class="w-4 h-4"></i> view store
                </a>
            </nav>

            <div class="pt-6 border-t">
                <p class="text-[10px] text-zinc-400 italic">&copy; 2026 mhm.co admin</p>
            </div>
        </aside>

        <div id="overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/20 backdrop-blur-sm z-40 hidden lg:hidden"></div>

        <main class="flex-1 p-6 lg:p-12 w-full max-w-4xl mx-auto">
            <header class="mb-10">
                <div class="flex items-center gap-2 text-zinc-400 text-sm mb-2 uppercase tracking-widest font-bold">
                    <i data-lucide="edit-3" class="w-4 h-4"></i> product editor
                </div>
                <h1 class="text-4xl font-extrabold tracking-tight text-zinc-900">edit product details</h1>
                <p class="text-zinc-500 mt-2 font-medium">perbarui informasi produk ID: #{{ $product->id }}</p>
            </header>

            <div class="bg-white rounded-3xl border border-zinc-100 shadow-xl shadow-zinc-200/50 overflow-hidden">
                <form action="/admin/update/{{ $product->id }}" method="POST" class="p-8 lg:p-12 space-y-8">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-6">
                            <div class="flex flex-col gap-2">
                                <label class="text-[11px] font-bold text-zinc-400 uppercase tracking-widest flex items-center gap-2">
                                    <i data-lucide="tag" class="w-3 h-3"></i> product name
                                </label>
                                <input type="text" name="nama" value="{{ $product->nama }}" required 
                                    placeholder="Enter product name"
                                    class="w-full bg-zinc-50 border border-zinc-200 px-4 py-4 rounded-2xl text-sm focus:ring-2 focus:ring-black focus:border-black outline-none transition font-medium">
                            </div>

                            <div class="flex flex-col gap-2">
                                <label class="text-[11px] font-bold text-zinc-400 uppercase tracking-widest flex items-center gap-2">
                                    <i data-lucide="dollar-sign" class="w-3 h-3"></i> price (idr)
                                </label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 font-bold text-zinc-400 text-sm">Rp</span>
                                    <input type="number" name="harga" value="{{ $product->harga }}" required 
                                        class="w-full bg-zinc-50 border border-zinc-200 pl-12 pr-4 py-4 rounded-2xl text-sm focus:ring-2 focus:ring-black focus:border-black outline-none transition font-medium">
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div class="flex flex-col gap-2">
                                <label class="text-[11px] font-bold text-zinc-400 uppercase tracking-widest flex items-center gap-2">
                                    <i data-lucide="image" class="w-3 h-3"></i> image filename
                                </label>
                                <input type="text" name="gambar" value="{{ $product->gambar }}" required 
                                    placeholder="example.jpg"
                                    class="w-full bg-zinc-50 border border-zinc-200 px-4 py-4 rounded-2xl text-sm focus:ring-2 focus:ring-black focus:border-black outline-none transition font-mono text-zinc-600">
                                <p class="text-[10px] text-zinc-400 italic font-medium">*pastikan file gambar sudah tersedia di folder storage.</p>
                            </div>

                            <div class="p-4 bg-zinc-50 rounded-2xl border border-dashed border-zinc-200 flex items-center gap-4">
                                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center border shadow-sm">
                                    <i data-lucide="box" class="w-6 h-6 text-zinc-300"></i>
                                </div>
                                <div class="text-[11px]">
                                    <p class="font-bold uppercase">current asset</p>
                                    <p class="text-zinc-400 truncate w-32">{{ $product->gambar }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-8 border-t border-zinc-100 flex flex-col sm:flex-row gap-4">
                        <button type="submit" class="flex-1 bg-black text-white px-10 py-4 rounded-2xl font-bold uppercase tracking-widest text-xs hover:bg-zinc-800 transition transform active:scale-95 shadow-lg shadow-black/10 flex items-center justify-center gap-2">
                            <i data-lucide="save" class="w-4 h-4"></i> save changes
                        </button>
                        <a href="/admin" class="flex-1 sm:flex-none inline-flex items-center justify-center px-10 py-4 rounded-2xl font-bold uppercase tracking-widest text-xs border border-zinc-200 text-zinc-400 hover:text-black hover:bg-white transition">
                            cancel
                        </a>
                    </div>
                </form>
            </div>
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