@php
    // Kita buat variabel untuk memudahkan pengecekan kategori
    $categoryName = strtolower($name);
@endphp

{{-- 
    LOGIKA PEMILIHAN HALAMAN KHUSUS:
    Mengecek nama kategori dan memanggil file yang sesuai di folder views
--}}

@if(str_contains($categoryName, 'authentic'))
    @include('vans-authentic')

@elseif(str_contains($categoryName, 'classic'))
    @include('vans-classic')

@elseif(str_contains($categoryName, 'era'))
    @include('vans-era')

@elseif(str_contains($categoryName, 'knu'))
    @include('vans-knu')

@elseif(str_contains($categoryName, 'skate'))
    @include('vans-skate')

@else
    {{-- 
        DESAIN DEFAULT: 
        Digunakan jika kategori tidak terdaftar atau belum dibuatkan file khususnya.
        Desain ini menggabungkan estetika show.blade.php
    --}}
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>shop {{ $name }} - mhm.co</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
        <style>body { font-family: 'Inter', sans-serif; }</style>
    </head>
    <body class="bg-white text-black antialiased">

        {{-- HEADER --}}
        <header class="w-full pt-8 pb-4 border-b border-gray-100 sticky top-0 bg-white z-50">
            <div class="max-w-[1400px] mx-auto px-10 flex justify-between items-center">
                {{-- BACK SEKARANG KE HALAMAN VANS --}}
                <a href="{{ route('category.vans') }}" class="text-[12px] font-bold uppercase tracking-widest hover:opacity-50 transition">back</a>
                <a href="/" class="text-[20px] font-bold tracking-[0.3em] uppercase">mhm.co</a>
                <div class="w-10"></div>
            </div>
        </header>

        <main class="max-w-[1400px] mx-auto px-10 py-16">
            {{-- Title Kategori dengan gaya show.blade.php --}}
            <div class="mb-16">
                <h1 class="text-[60px] md:text-[80px] font-black tracking-tighter uppercase leading-none">{{ $name }}</h1>
                <p class="text-gray-400 mt-4 lowercase italic font-medium">showing all {{ $products->count() }} products for {{ $name }}</p>
            </div>

            {{-- Grid Produk --}}
            @if($products->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-4 gap-x-8 gap-y-12">
                    @foreach($products as $product)
                    <a href="{{ route('product.show', $product->id) }}" class="group flex flex-col">
                        <div class="w-full aspect-square bg-[#F5F5F5] flex items-center justify-center overflow-hidden transition-all group-hover:bg-[#EEEEEE]">
                            <img src="{{ asset('img/' . $product->gambar) }}" 
                                 class="w-full h-full object-contain p-8 mix-blend-multiply group-hover:scale-105 transition duration-500"
                                 alt="{{ $product->nama }}">
                        </div>
                        <div class="mt-4">
                            <h3 class="text-[13px] font-bold uppercase tracking-tight leading-tight">{{ $product->nama }}</h3>
                            <p class="text-[13px] font-bold mt-1 tracking-widest text-gray-500">Rp. {{ number_format($product->harga, 0, ',', '.') }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>
            @else
                <div class="py-20 text-center">
                    <p class="text-gray-400 italic">no products found for "{{ $name }}"</p>
                </div>
            @endif
        </main>

        <footer class="py-20 text-center border-t border-gray-100 bg-white">
            <p class="text-[10px] text-gray-400 uppercase tracking-[0.5em]">mhm.co &copy; 2026</p>
        </footer>

    </body>
    </html>
@endif