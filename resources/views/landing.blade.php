<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mhm.co | Streetwear Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-white text-black">

    <nav class="flex items-center justify-between px-10 py-5 border-b border-gray-100 text-sm font-medium">
        <div class="text-2xl font-black tracking-tighter cursor-pointer" onclick="window.location='/'">mhm.co</div>
        <div class="hidden md:flex space-x-10 lowercase">
            <a href="/category/man" class="hover:text-gray-400 transition">man</a>
            <a href="/category/woman" class="hover:text-gray-400 transition">woman</a>
            <a href="/category/kids" class="hover:text-gray-400 transition">kids</a>
            <a href="#" class="text-red-600 font-bold underline underline-offset-4">limited edition</a>
        </div>
        <div class="flex items-center space-x-5">
            @auth
                <div class="flex items-center space-x-4 lowercase">
                    <span class="text-gray-400 text-xs italic">hi, {{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="hover:text-red-500 transition text-[13px] font-bold">logout</button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="flex items-center space-x-2 cursor-pointer hover:text-gray-400 transition">
                    <span>masuk</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                </a>
            @endauth
            
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
        </div>
    </nav>

    <div class="flex justify-center my-8">
        <input type="text" placeholder="found product" class="bg-[#e2e2e2] rounded-full px-10 py-2 w-full max-w-md text-center outline-none text-sm placeholder:text-gray-500">
    </div>

    <div class="px-10 mb-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-gray-200 h-[400px] overflow-hidden">
                <img src="{{ asset('img/banner1.webp') }}" class="w-full h-full object-cover">
            </div>
            <div class="bg-gray-200 h-[400px] overflow-hidden">
                <img src="{{ asset('img/banner2.jpg') }}" class="w-full h-full object-cover">
            </div>
        </div>
    </div>

    <section class="px-10 mb-20">
        <h2 class="text-xl font-bold mb-6">Vans shoes</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach($products->where('category', 'vans') as $item)
            <div class="group cursor-pointer text-left" onclick="window.location='/product/{{ $item->id }}'">
                <div class="bg-[#f3f3f3] aspect-square flex items-center justify-center p-6 mb-4">
                    <img src="{{ asset('img/' . $item->gambar) }}" class="w-full object-contain group-hover:scale-110 transition duration-300">
                </div>
                <h3 class="text-[10px] uppercase tracking-widest font-bold text-gray-800 leading-tight">{{ $item->nama }}</h3>
                <p class="text-xs font-bold mt-1 text-gray-600">Rp. {{ number_format($item->harga, 0, ',', '.') }}</p>
            </div>
            @endforeach
        </div>
    </section>

    <section class="px-10 mb-20">
        <div class="flex items-center space-x-3 mb-8 cursor-pointer" onclick="window.location='/category/converse'">
            <h2 class="text-xl font-bold">Converse shoes</h2>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach($products->where('category', 'converse') as $item)
            <div class="group cursor-pointer" onclick="window.location='/product/{{ $item->id }}'">
                <div class="bg-[#f3f3f3] aspect-square flex items-center justify-center p-6 mb-4">
                    <img src="{{ asset('img/' . $item->gambar) }}" class="w-full object-contain">
                </div>
                <h3 class="text-[10px] uppercase tracking-widest font-bold">{{ $item->nama }}</h3>
                <p class="text-xs font-bold mt-1">Rp. {{ number_format($item->harga, 0, ',', '.') }}</p>
            </div>
            @endforeach
        </div>
    </section>

    <div class="px-10 mb-12">
        <div class="bg-black py-20 flex justify-center items-center">
            <h1 class="text-white text-7xl font-black italic tracking-tighter">THRASHER</h1>
        </div>
    </div>

    <section class="px-10 mb-20">
        <div class="flex items-center space-x-3 mb-8 text-xl font-bold italic cursor-pointer" onclick="window.location='/category/thrasher'">
            <h2>Thrasher</h2>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-10">
            @foreach($products->where('category', 'thrasher') as $item)
            <div class="text-center group cursor-pointer" onclick="window.location='/product/{{ $item->id }}'">
                <img src="{{ asset('img/' . $item->gambar) }}" class="w-full bg-[#f3f3f3] p-4 mb-4">
                <h3 class="text-[11px] uppercase font-bold tracking-wider">{{ $item->nama }}</h3>
                <p class="font-bold text-sm">Rp. {{ number_format($item->harga, 0, ',', '.') }}</p>
            </div>
            @endforeach
        </div>
    </section>

    <footer class="grid grid-cols-1 md:grid-cols-2 gap-20 px-10 py-20 border-t mt-20">
        <div>
            <h2 class="text-2xl font-black mb-6">find us at</h2>
            <p class="text-gray-500 text-sm leading-relaxed max-w-sm lowercase">
                find us at the nearest offline store and also we provide various online stores such as Instagram, telegram, Twitter, TikTok, and also this website itself.
            </p>
            <p class="mt-20 font-bold text-gray-400">www.mhm.co</p>
            <h2 class="text-2xl font-black mt-2 italic lowercase">contact us?</h2>
            
            @if(session('success'))
                <p class="mt-4 text-green-600 font-bold text-sm italic">{{ session('success') }}</p>
            @endif
        </div>

        <form action="{{ route('message.send') }}" method="POST" class="space-y-4">
            @csrf
            <input type="text" name="name" placeholder="name" required class="w-full bg-[#e2e2e2] p-4 outline-none text-sm font-medium lowercase">
            <input type="email" name="email" placeholder="email" required class="w-full bg-[#e2e2e2] p-4 outline-none text-sm font-medium lowercase">
            <textarea name="message" placeholder="type your message here" required class="w-full bg-[#e2e2e2] p-4 h-40 outline-none text-sm font-medium lowercase"></textarea>
            <button type="submit" class="bg-black text-white px-12 py-3 font-bold text-sm tracking-widest hover:bg-gray-800 transition">SUBMIT</button>
        </form>
    </footer>

</body>
</html>