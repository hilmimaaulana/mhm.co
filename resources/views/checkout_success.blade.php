<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mhm.co | payment instruction</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,700;0,800;1,800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #F8F8F8;
        }
        .heading-brand { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            letter-spacing: -0.05em;
            line-height: 0.9;
        }
        .btn-shadow {
            box-shadow: 0 15px 30px -5px rgba(0,0,0,0.1);
        }
        .card-border {
            border: 1px solid rgba(0,0,0,0.04);
        }
        ::selection {
            background: #000;
            color: #fff;
        }
    </style>
</head>
<body class="text-black antialiased lowercase">

    <div class="min-h-screen flex items-center justify-center p-6">
        <div class="max-w-[380px] w-full bg-white rounded-[2.5rem] overflow-hidden shadow-[0_30px_60px_-10px_rgba(0,0,0,0.08)] card-border">
            
            {{-- Header Section --}}
            <div class="pt-12 pb-8 px-8 text-center">
                <div class="mb-6 relative inline-block">
                    <div class="w-16 h-16 bg-black rounded-full flex items-center justify-center z-10 relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
                
                <div class="space-y-0.5">
                    <h1 class="heading-brand italic text-3xl font-[800] uppercase block">pesanan</h1>
                    <h1 class="heading-brand italic text-3xl font-[800] uppercase block text-black/10">berhasil!</h1>
                </div>
                
                <div class="mt-5 inline-flex items-center gap-2 px-3 py-1 bg-zinc-100 rounded-full">
                    <p class="text-[9px] text-zinc-500 font-bold uppercase tracking-[0.15em]">invoice #mhm{{ rand(1000, 9999) }}</p>
                </div>
            </div>

            {{-- Info Tagihan --}}
            <div class="px-8 pb-6">
                <div class="bg-zinc-900 rounded-[2rem] p-6 text-white relative overflow-hidden shadow-xl">
                    <div class="relative z-10 text-center">
                        <span class="text-[8px] text-zinc-500 uppercase font-black tracking-[0.2em] mb-1 block">total tagihan</span>
                        <h2 class="text-2xl font-bold tracking-tight mb-4">rp {{ number_format($total, 0, ',', '.') }}</h2>
                        
                        <div class="w-full h-[1px] bg-white/5 mb-4"></div>
                        
                        <div class="flex flex-col items-center">
                            <span class="text-[7px] text-zinc-500 uppercase font-bold tracking-widest mb-1.5">batas waktu pembayaran</span>
                            <div class="px-4 py-1.5 bg-white/10 rounded-xl border border-white/5">
                                <p class="text-sm font-black tracking-[0.15em] font-mono" id="timer">23:59:59</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Detail Pembayaran --}}
            <div class="px-8 pb-10 space-y-6">
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-[9px] text-zinc-400 uppercase font-black tracking-widest">instruksi</span>
                        <span class="h-[1px] flex-1 bg-zinc-50 ml-3"></span>
                    </div>

                    <div class="bg-white border border-zinc-100 rounded-2xl p-5 hover:border-black transition-colors duration-300">
                        @if(strtolower($paymentMethod) == 'qris / gopay')
                            <div class="flex flex-col">
                                <span class="text-[8px] text-zinc-400 uppercase font-bold mb-0.5">qris / e-wallet</span>
                                <span class="text-lg font-black tracking-tight text-black select-all">0857-2782-9063</span>
                                <div class="mt-2.5 flex items-center gap-2">
                                    <span class="w-1 h-1 bg-zinc-300 rounded-full"></span>
                                    <span class="text-[9px] text-zinc-500 font-medium uppercase tracking-wider">a.n mhm store official</span>
                                </div>
                            </div>
                        @else
                            <div class="flex flex-col">
                                <span class="text-[8px] text-zinc-400 uppercase font-bold mb-0.5">bank {{ $paymentMethod }}</span>
                                <span class="text-lg font-black tracking-tight text-black select-all">8801 0812 3456 7890</span>
                                <div class="mt-2.5 flex items-center gap-2">
                                    <span class="w-1 h-1 bg-zinc-300 rounded-full"></span>
                                    <span class="text-[9px] text-zinc-500 font-medium uppercase tracking-wider">a.n mhm store official</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="space-y-3">
                    <button onclick="window.print()" class="w-full bg-black text-white text-[10px] font-bold uppercase py-4 rounded-xl tracking-[0.15em] hover:opacity-90 active:scale-[0.98] transition-all btn-shadow">
                        simpan instruksi
                    </button>
                    
                    <a href="{{ url('/') }}" class="flex items-center justify-center gap-2 w-full py-2 text-zinc-400 hover:text-black transition-colors duration-300">
                        <span class="text-[9px] font-bold uppercase tracking-[0.15em]">kembali beranda</span>
                    </a>
                </div>

                <p class="text-[8px] text-zinc-300 text-center uppercase tracking-widest leading-relaxed">
                    pesanan otomatis batal jika waktu habis.
                </p>
            </div>
        </div>
    </div>

    <script>
        function startTimer(duration, display) {
            var timer = duration, hours, minutes, seconds;
            setInterval(function () {
                hours = parseInt(timer / 3600, 10);
                minutes = parseInt((timer % 3600) / 60, 10);
                seconds = parseInt(timer % 60, 10);

                hours = hours < 10 ? "0" + hours : hours;
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = hours + ":" + minutes + ":" + seconds;

                if (--timer < 0) {
                    timer = 0;
                    display.textContent = "00:00:00";
                }
            }, 1000);
        }

        window.onload = function () {
            var display = document.querySelector('#timer');
            startTimer(24 * 60 * 60, display);
        };
    </script>
</body>
</html>