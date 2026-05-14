<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - mhm.co</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { display: none; }
        
        .fade-up { opacity: 0; animation: fadeUp 0.65s cubic-bezier(0.4,0,0.2,1) forwards; }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        
        .product-card { transition: transform 0.3s ease; }
        .product-card:hover { transform: translateY(-4px); }
        .product-img { transition: transform 0.55s cubic-bezier(0.4,0,0.2,1); }
        .product-card:hover .product-img { transform: scale(1.12); }
        
        .nav-link { position: relative; }
        .nav-link::after { content: ''; position: absolute; bottom: -2px; left: 0; width: 0; height: 1px; background: #000; transition: width 0.3s ease; }
        .nav-link:hover::after { width: 100%; }
    </style>
</head>
<body class="bg-white text-black antialiased overflow-x-hidden">

    <header class="w-full pt-8 pb-4 sticky top-0 bg-white z-50 border-b border-gray-100">
        <div class="max-w-[1400px] mx-auto px-10">
            <div class="grid grid-cols-3 items-center mb-8">
                <div class="flex justify-start">
                    <a href="{{ url('/') }}" class="text-[18px] font-bold tracking-tighter uppercase">mhm.co</a>
                </div>
                <nav class="flex justify-center gap-8 text-[13px] lowercase tracking-tight">
                    <a href="{{ route('category.vans') }}" class="nav-link">vans</a>
                    <a href="{{ route('category.show', 'converse') }}" class="nav-link">converse</a>
                    <a href="{{ route('category.show', 'thrasher') }}" class="nav-link">thrasher</a>
                    <a href="{{ route('category.show', 'limited') }}" class="nav-link">limited edition</a>
                </nav>
                <div class="flex justify-end items-center gap-6 text-[13px] lowercase">
                    @auth
                        <a href="#" class="flex items-center gap-2 font-medium">hi, {{ Auth::user()->name }}</a>
                    @else
                        <a href="{{ route('login') }}" class="flex items-center gap-2">masuk</a>
                    @endauth
                    <a href="{{ route('cart.show') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.112 16.826a2.25 2.25 0 0 1-2.247 2.398H5.03a2.25 2.25 0 0 1-2.247-2.398L3.894 8.507a2.25 2.25 0 0 1 2.247-2.247h11.712a2.25 2.25 0 0 1 2.247 2.247Z" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="flex justify-center pb-4">
                <form action="{{ route('product.search') }}" method="GET" class="relative">
                    <input 
                        name="search" 
                        value="{{ request('search') }}"
                        type="text" 
                        placeholder="search product..." 
                        class="w-[450px] bg-[#F2F2F2] border border-black rounded-full py-2 px-10 text-center text-[12px] outline-none"
                    >
                    <button type="submit" class="absolute left-4 top-1/2 -translate-y-1/2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main class="max-w-[1400px] mx-auto px-10 mt-12 mb-24">
        <div class="mb-10">
            <h1 class="text-[18px] font-bold lowercase italic">
                search results for: "{{ request('search') }}"
            </h1>
            <p class="text-[12px] text-gray-500">{{ $products->count() }} items found</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-x-6 gap-y-12">
            @forelse($products as $product)
                <a href="{{ route('product.show', $product->id) }}" class="product-card flex flex-col fade-up">
                    <div class="w-full aspect-square bg-[#F5F5F5] flex items-center justify-center overflow-hidden">
                        <img src="{{ asset('img/' . $product->gambar) }}" class="product-img w-full h-full object-contain p-8 mix-blend-multiply">
                    </div>
                    <div class="mt-4">
                        <h3 class="text-[11px] lowercase tracking-tight leading-tight">{{ $product->nama }}</h3>
                        <p class="text-[11px] font-bold mt-1">IDR {{ number_format($product->harga, 0, ',', '.') }}</p>
                    </div>
                </a>
            @empty
                <div class="col-span-full py-20 text-center">
                    <p class="text-gray-400 italic text-[13px] lowercase">no products matched your search.</p>
                    <a href="{{ url('/') }}" class="text-[11px] underline mt-4 block">back to home</a>
                </div>
            @endforelse
        </div>
    </main>

    <footer class="max-w-[1400px] mx-auto px-10 py-10 border-t border-gray-100 text-center">
        <a href="{{ url('/') }}" class="text-[10px] text-gray-400 tracking-[0.5em] uppercase italic hover:text-black transition-colors">
            mhm.co &copy; 2026
        </a>
    </footer>

</body>
</html>