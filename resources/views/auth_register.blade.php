<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mhm.co | create account</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .float-icon { animation: float 3.5s ease-in-out infinite; }
    </style>
</head>
<body class="bg-[#F4F7F6] text-zinc-900 antialiased flex items-center justify-center min-h-screen p-6">

    <div class="w-full max-w-md my-10">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-white text-black rounded-2xl mb-6 shadow-xl shadow-zinc-200/50 float-icon border border-zinc-100">
                <i data-lucide="user-plus" class="w-8 h-8"></i>
            </div>
            <h1 class="text-4xl font-extrabold tracking-tighter uppercase italic text-black">mhm.co</h1>
            <p class="text-zinc-500 text-sm mt-2 font-medium italic">bergabunglah dengan komunitas kami.</p>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-zinc-200/50 border border-zinc-100 overflow-hidden">
            <form action="/register" method="POST" class="p-8 lg:p-12 space-y-5">
                @csrf
                
                <div class="space-y-2">
                    <label class="text-[11px] font-bold uppercase tracking-[0.2em] text-zinc-400 ml-1">Full Name</label>
                    <div class="relative group">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-zinc-400 group-focus-within:text-black transition-colors">
                            <i data-lucide="user" class="w-4 h-4"></i>
                        </div>
                        <input type="text" name="name" required autofocus
                            placeholder="alex mbois"
                            class="w-full bg-zinc-50 border border-zinc-200 pl-12 pr-4 py-4 rounded-2xl text-sm focus:ring-2 focus:ring-black focus:border-black outline-none transition font-medium">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[11px] font-bold uppercase tracking-[0.2em] text-zinc-400 ml-1">Email Address</label>
                    <div class="relative group">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-zinc-400 group-focus-within:text-black transition-colors">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                        </div>
                        <input type="email" name="email" required
                            placeholder="nama@email.com"
                            class="w-full bg-zinc-50 border border-zinc-200 pl-12 pr-4 py-4 rounded-2xl text-sm focus:ring-2 focus:ring-black focus:border-black outline-none transition font-medium">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[11px] font-bold uppercase tracking-[0.2em] text-zinc-400 ml-1">Password</label>
                    <div class="relative group">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-zinc-400 group-focus-within:text-black transition-colors">
                            <i data-lucide="key-round" class="w-4 h-4"></i>
                        </div>
                        <input type="password" name="password" required 
                            placeholder="••••••••"
                            class="w-full bg-zinc-50 border border-zinc-200 pl-12 pr-4 py-4 rounded-2xl text-sm focus:ring-2 focus:ring-black focus:border-black outline-none transition font-medium">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[11px] font-bold uppercase tracking-[0.2em] text-zinc-400 ml-1">Confirm Password</label>
                    <div class="relative group">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-zinc-400 group-focus-within:text-black transition-colors">
                            <i data-lucide="shield-check" class="w-4 h-4"></i>
                        </div>
                        <input type="password" name="password_confirmation" required 
                            placeholder="••••••••"
                            class="w-full bg-zinc-50 border border-zinc-200 pl-12 pr-4 py-4 rounded-2xl text-sm focus:ring-2 focus:ring-black focus:border-black outline-none transition font-medium">
                    </div>
                </div>

                @if($errors->any())
                    <div class="bg-red-50 p-4 rounded-2xl border border-red-100 flex items-center gap-3 animate-pulse">
                        <i data-lucide="alert-circle" class="w-4 h-4 text-red-500"></i>
                        <p class="text-red-600 text-[11px] font-bold uppercase leading-tight">{{ $errors->first() }}</p>
                    </div>
                @endif

                <button type="submit" class="w-full bg-black text-white py-4 rounded-2xl font-bold uppercase tracking-[0.2em] text-[11px] hover:bg-zinc-800 transition transform active:scale-95 shadow-xl shadow-black/20 flex items-center justify-center gap-2">
                    register now
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </button>
                
                <div class="pt-6 mt-4 border-t border-zinc-50 text-center">
                    <p class="text-[11px] text-zinc-400 font-bold uppercase tracking-widest">
                        sudah memiliki akun? 
                        <a href="/login" class="text-black underline underline-offset-4 hover:text-zinc-600 transition-colors">login disini</a>
                    </p>
                </div>
            </form>
        </div>

        <div class="text-center mt-8">
            <a href="/" class="inline-flex items-center gap-2 text-[10px] font-bold text-zinc-400 hover:text-black transition-all uppercase tracking-[0.3em] group">
                <i data-lucide="chevron-left" class="w-3 h-3 group-hover:-translate-x-1 transition-transform"></i>
                kembali ke toko
            </a>
        </div>
    </div>

    <script>
        // Initialize Icons
        lucide.createIcons();
    </script>
</body>
</html>