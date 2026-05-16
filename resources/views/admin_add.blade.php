<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mhm.co | add product</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); }
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
            <div class="hidden lg:block font-extrabold text-2xl tracking-tighter mb-12 italic uppercase">mhm.co</div>
            
            <nav class="flex flex-col gap-2 text-[14px] flex-1">
                <p class="text-[10px] uppercase tracking-[0.2em] text-zinc-400 font-bold mb-2">admin menu</p>
                <a href="/" class="flex items-center gap-3 px-4 py-3 text-zinc-500 hover:text-black hover:bg-zinc-50 rounded-xl transition">
                    <i data-lucide="external-link" class="w-4 h-4"></i> view store
                </a>
                <a href="/admin" class="flex items-center gap-3 px-4 py-3 text-zinc-500 hover:text-black hover:bg-zinc-50 rounded-xl transition">
                    <i data-lucide="package" class="w-4 h-4"></i> all products
                </a>
                <a href="/admin/orders" class="flex items-center gap-3 px-4 py-3 text-zinc-500 hover:text-black hover:bg-zinc-50 rounded-xl transition">
                    <i data-lucide="shopping-bag" class="w-4 h-4"></i> order history
                </a>
                <a href="/admin/add" class="flex items-center gap-3 px-4 py-3 font-bold bg-zinc-900 text-white rounded-xl shadow-lg shadow-black/10 transition">
                    <i data-lucide="plus-circle" class="w-4 h-4"></i> add product
                </a>
                <a href="{{ route('admin.messages') }}" class="flex items-center gap-3 px-4 py-3 text-zinc-500 hover:text-black hover:bg-zinc-50 rounded-xl transition">
                    <i data-lucide="mail" class="w-4 h-4"></i> inbox messages
                </a>
            </nav>

            <div class="pt-6 border-t text-[11px] text-zinc-400 italic">
                &copy; 2026 mhm.co system
            </div>
        </aside>

        <div id="overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/20 backdrop-blur-sm z-40 hidden lg:hidden"></div>

        <main class="flex-1 p-6 lg:p-12 w-full max-w-5xl mx-auto overflow-hidden">
            <header class="mb-10">
                <a href="/admin" class="inline-flex items-center gap-2 text-zinc-400 hover:text-black transition text-sm mb-4">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i> back to list
                </a>
                <h1 class="text-4xl font-extrabold tracking-tight text-zinc-900">add new product</h1>
                <p class="text-zinc-500 mt-2">tambahkan item baru ke koleksi mhm.co</p>
            </header>

            <form action="/admin/store" method="POST" class="space-y-8">
                @csrf
                
                <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                    <div class="xl:col-span-2 space-y-6">
                        <div class="bg-white p-8 rounded-3xl border border-zinc-100 shadow-xl shadow-zinc-200/50">
                            <h2 class="text-lg font-bold mb-6 flex items-center gap-2">
                                <i data-lucide="info" class="w-5 h-5 text-zinc-400"></i> product information
                            </h2>
                            
                            <div class="space-y-5">
                                <div class="flex flex-col gap-2">
                                    <label class="text-[11px] font-bold uppercase tracking-widest text-zinc-400">product name</label>
                                    <input type="text" name="nama" required placeholder="ex: Vans Authentic Off White" 
                                        class="w-full bg-zinc-50 border border-zinc-200 px-4 py-3.5 rounded-xl text-sm focus:ring-2 focus:ring-black focus:border-black outline-none transition">
                                    <p class="text-[10px] text-zinc-400 italic font-medium">auto-category: 'vans', 'converse', or 'thrasher'</p>
                                </div>

                                <div class="flex flex-col gap-2">
                                    <label class="text-[11px] font-bold uppercase tracking-widest text-zinc-400">price (idr)</label>
                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 font-bold text-zinc-400 text-sm">Rp</span>
                                        <input type="number" name="harga" required placeholder="850.000" 
                                            class="w-full bg-zinc-50 border border-zinc-200 pl-11 pr-4 py-3.5 rounded-xl text-sm focus:ring-2 focus:ring-black focus:border-black outline-none transition">
                                    </div>
                                </div>

                                <div class="flex flex-col gap-2">
                                    <label class="text-[11px] font-bold uppercase tracking-widest text-zinc-400">detailed description</label>
                                    <textarea name="deskripsi" rows="5" required placeholder="Describe material, fit, and vibes..." 
                                        class="w-full bg-zinc-50 border border-zinc-200 p-4 rounded-xl text-sm focus:ring-2 focus:ring-black focus:border-black outline-none transition resize-none"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-white p-8 rounded-3xl border border-zinc-100 shadow-xl shadow-zinc-200/50">
                            <h2 class="text-lg font-bold mb-6 flex items-center gap-2">
                                <i data-lucide="image" class="w-5 h-5 text-zinc-400"></i> product media
                            </h2>

                            <div class="space-y-6">
                                <div class="space-y-3">
                                    <label class="text-[11px] font-bold uppercase tracking-widest text-zinc-400 block">front view image url</label>
                                    <input type="text" name="gambar" required oninput="previewUrlImage(this, 'preview-front')" placeholder="Paste Direct Link (ex: https://i.ibb.co/xyz.jpg)" 
                                        class="w-full bg-zinc-50 border border-zinc-200 px-4 py-2.5 rounded-xl text-xs focus:ring-2 focus:ring-black focus:border-black outline-none transition">
                                    
                                    <div class="border-2 border-dashed border-zinc-200 rounded-2xl p-4 bg-zinc-50 transition min-h-[140px] flex flex-col items-center justify-center overflow-hidden">
                                        <div id="preview-front" class="w-full flex flex-col items-center justify-center text-center">
                                            <i data-lucide="camera" class="w-8 h-8 text-zinc-300 mb-2"></i>
                                            <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-tighter">Waiting for URL...</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-3">
                                    <label class="text-[11px] font-bold uppercase tracking-widest text-zinc-400 block">back view image url</label>
                                    <input type="text" name="gambar_belakang" oninput="previewUrlImage(this, 'preview-back')" placeholder="Paste Direct Link (ex: https://i.ibb.co/abc.jpg)" 
                                        class="w-full bg-zinc-50 border border-zinc-200 px-4 py-2.5 rounded-xl text-xs focus:ring-2 focus:ring-black focus:border-black outline-none transition">
                                    
                                    <div class="border-2 border-dashed border-zinc-200 rounded-2xl p-4 bg-zinc-50 transition min-h-[140px] flex flex-col items-center justify-center overflow-hidden">
                                        <div id="preview-back" class="w-full flex flex-col items-center justify-center text-center">
                                            <i data-lucide="camera" class="w-8 h-8 text-zinc-300 mb-2"></i>
                                            <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-tighter">Waiting for URL...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4 pt-4">
                            <button type="submit" class="w-full bg-black text-white py-4 rounded-2xl font-bold uppercase tracking-widest text-xs hover:bg-zinc-800 transition transform active:scale-95 shadow-xl shadow-black/10 flex items-center justify-center gap-2">
                                <i data-lucide="send" class="w-4 h-4"></i> publish product
                            </button>
                            <a href="/admin" class="w-full inline-flex items-center justify-center py-4 rounded-2xl font-bold uppercase tracking-widest text-xs border border-zinc-200 text-zinc-400 hover:text-black hover:bg-white transition">
                                cancel process
                            </a>
                        </div>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-100 p-4 rounded-2xl">
                        <div class="flex items-center gap-2 text-red-600 mb-2">
                            <i data-lucide="alert-circle" class="w-4 h-4"></i>
                            <span class="font-bold text-xs uppercase tracking-widest">fix errors below:</span>
                        </div>
                        <ul class="text-red-500 text-xs font-medium list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
        </main>
    </div>

    <script>
        // Initialize Icons
        lucide.createIcons();

        // Sidebar Toggle
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('hidden');
        }

        // FIX: Logika Baru untuk mendeteksi teks string URL Gambar secara Real-Time
        function previewUrlImage(input, previewId) {
            const previewContainer = document.getElementById(previewId);
            const urlString = input.value.trim();
            
            if (urlString !== "") {
                previewContainer.innerHTML = `
                    <img src="${urlString}" class="w-full h-32 object-contain rounded-lg" onerror="imageLoadError(this, '${previewId}')">
                    <span class="text-[9px] text-emerald-500 font-bold uppercase mt-2">Link Sync Successfully</span>
                `;
            } else {
                // Balikkan ke kondisi kosong jika input dihapus
                previewContainer.innerHTML = `
                    <i data-lucide="camera" class="w-8 h-8 text-zinc-300 mb-2"></i>
                    <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-tighter">Waiting for URL...</span>
                `;
                lucide.createIcons();
            }
        }

        // Fitur penangan pelindung jika link mati atau typo
        function imageLoadError(img, previewId) {
            const previewContainer = document.getElementById(previewId);
            previewContainer.innerHTML = `
                <i data-lucide="alert-triangle" class="w-8 h-8 text-amber-500 mb-2"></i>
                <span class="text-[10px] font-bold text-amber-500 uppercase tracking-tighter">Invalid Image Link / URL Error</span>
            `;
            lucide.createIcons();
        }
    </script>
</body>
</html>