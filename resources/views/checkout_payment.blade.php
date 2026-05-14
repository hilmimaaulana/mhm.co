<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mhm.co | payment method</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@1,800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .heading-brand { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            font-style: italic;
            font-weight: 800;
            letter-spacing: -0.05em;
        }
        .btn-pay {
            letter-spacing: 0.15em;
        }
    </style>
</head>
<body class="bg-[#F4F4F4] antialiased lowercase">
    <div class="max-w-md mx-auto min-h-screen flex flex-col justify-center p-6">
        
        @if(session('error'))
            <div class="mb-6 p-4 bg-black text-white text-[10px] tracking-[0.2em] font-bold uppercase animate-pulse">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 border border-red-200 bg-red-50 text-red-600 text-[10px] tracking-[0.2em] font-bold uppercase">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="bg-white p-8 md:p-10 shadow-[0_20px_50px_rgba(0,0,0,0.05)] rounded-sm border border-gray-50">
            <header class="mb-10 text-center">
                <h2 class="heading-brand text-4xl text-black uppercase leading-none">select</h2>
                <h2 class="heading-brand text-4xl text-black uppercase leading-none opacity-20">payment</h2>
            </header>
            
            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <label class="relative block cursor-pointer group">
                        <input type="radio" name="payment_method" value="BNI Transfer" checked class="hidden peer">
                        
                        <div class="flex flex-col p-6 border-2 border-gray-100 rounded-xl transition-all duration-300 
                                    peer-checked:border-black peer-checked:bg-zinc-50 group-hover:border-zinc-300">
                            
                            <div class="relative z-10">
                                <p class="text-[14px] font-black uppercase tracking-widest transition-all">BNI Transfer</p>
                                <p class="text-[10px] text-gray-400 uppercase tracking-tighter mt-1">manual verification (1x24h)</p>
                            </div>
                        </div>
                    </label>

                    <label class="relative block cursor-pointer group">
                        <input type="radio" name="payment_method" value="QRIS / GOPAY" class="hidden peer">
                        
                        <div class="flex flex-col p-6 border-2 border-gray-100 rounded-xl transition-all duration-300 
                                    peer-checked:border-black peer-checked:bg-zinc-50 group-hover:border-zinc-300">
                            
                            <div class="relative z-10">
                                <p class="text-[14px] font-black uppercase tracking-widest transition-all">QRIS / GOPAY</p>
                                <p class="text-[10px] text-gray-400 uppercase tracking-tighter mt-1">instant activation</p>
                            </div>
                        </div>
                    </label>
                </div>

                <button type="submit" class="btn-pay w-full mt-10 bg-black text-white py-5 rounded-sm text-[12px] font-black uppercase hover:bg-zinc-800 transition-all active:scale-[0.98] shadow-xl shadow-zinc-200">
                    CONFIRM & CHECKOUT
                </button>
            </form>
            
            <div class="mt-10 flex justify-center">
                <a href="/cart" class="text-[11px] font-bold text-gray-400 uppercase tracking-[0.2em] hover:text-black transition-all flex items-center gap-2 group">
                    <span class="group-hover:-translate-x-1 transition-transform inline-block text-lg">←</span> 
                    return to cart
                </a>
            </div>
        </div>

        <footer class="mt-10 text-center">
            <p class="text-[10px] text-gray-400 uppercase tracking-[0.4em] font-medium">© 2026 mhm.co / street couture access</p>
        </footer>
    </div>
</body>
</html>