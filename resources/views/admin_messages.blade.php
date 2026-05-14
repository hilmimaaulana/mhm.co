<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mhm.co | inbox messages</title>
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
                <a href="{{ route('admin.orders') }}" class="flex items-center gap-3 px-4 py-3 text-zinc-500 hover:text-black hover:bg-zinc-50 rounded-xl transition">
                    <i data-lucide="shopping-bag" class="w-4 h-4"></i> order history
                </a>
                <a href="{{ route('admin.messages') }}" class="flex items-center gap-3 px-4 py-3 font-bold bg-zinc-900 text-white rounded-xl shadow-lg shadow-black/10 transition">
                    <i data-lucide="mail" class="w-4 h-4"></i> inbox messages
                </a>
            </nav>

            <div class="pt-6 border-t text-[11px] text-zinc-400 italic">
                &copy; 2026 mhm.co admin
            </div>
        </aside>

        <div id="overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/20 backdrop-blur-sm z-40 hidden lg:hidden"></div>

        <main class="flex-1 p-6 lg:p-12 w-full overflow-hidden">
            <header class="mb-10">
                <h1 class="text-4xl font-extrabold tracking-tight text-zinc-900 leading-tight">customer messages</h1>
                <p class="text-zinc-500 text-sm mt-1">baca pesan dan feedback langsung dari pelanggan kamu.</p>
            </header>

            {{-- Summary Card --}}
            <div class="mb-8">
                <div class="bg-white inline-flex items-center gap-4 p-5 rounded-3xl border border-zinc-100 shadow-sm">
                    <div class="p-3 bg-zinc-100 text-zinc-900 rounded-2xl">
                        <i data-lucide="inbox" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase font-bold tracking-widest text-zinc-400">total inbox</p>
                        <p class="text-xl font-extrabold">{{ count($messages) }} messages</p>
                    </div>
                </div>
            </div>
            
            {{-- Table Container --}}
            <div class="bg-white rounded-3xl border border-zinc-100 shadow-xl shadow-zinc-200/50 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-zinc-50/50">
                                <th class="p-6 text-[10px] font-bold uppercase tracking-[0.2em] text-zinc-400 border-b border-zinc-100">received date</th>
                                <th class="p-6 text-[10px] font-bold uppercase tracking-[0.2em] text-zinc-400 border-b border-zinc-100">sender info</th>
                                <th class="p-6 text-[10px] font-bold uppercase tracking-[0.2em] text-zinc-400 border-b border-zinc-100">message content</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-50">
                            @forelse($messages as $msg)
                            <tr class="hover:bg-zinc-50/80 transition-colors group">
                                <td class="p-6 whitespace-nowrap">
                                    <div class="flex items-center gap-2 text-zinc-400 italic text-[12px]">
                                        <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                                        {{ $msg->created_at->format('d M Y') }}
                                    </div>
                                </td>
                                <td class="p-6">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-zinc-900 text-sm uppercase tracking-tight group-hover:text-black transition-colors">{{ $msg->name }}</span>
                                        <span class="text-[11px] text-zinc-400 font-medium lowercase flex items-center gap-1 mt-1">
                                            <i data-lucide="at-sign" class="w-3 h-3"></i> {{ $msg->email }}
                                        </span>
                                    </div>
                                </td>
                                <td class="p-6 max-w-md">
                                    <div class="bg-zinc-50 group-hover:bg-white border border-transparent group-hover:border-zinc-100 p-4 rounded-2xl transition-all">
                                        <p class="text-[13px] leading-relaxed text-zinc-600 italic">
                                            "{{ $msg->message }}"
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="p-24 text-center">
                                    <div class="bg-zinc-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i data-lucide="message-square-off" class="w-10 h-10 text-zinc-300"></i>
                                    </div>
                                    <h3 class="text-zinc-900 font-bold">Inbox is empty</h3>
                                    <p class="text-zinc-400 text-sm italic">Belum ada pesan dari pelanggan saat ini.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <footer class="mt-12 text-center lg:text-left">
                <a href="/admin" class="group inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[0.2em] text-zinc-400 hover:text-black transition">
                    <i data-lucide="chevron-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i> 
                    back to dashboard
                </a>
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