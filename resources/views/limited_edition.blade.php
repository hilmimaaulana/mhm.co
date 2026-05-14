<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Limited Edition - mhm.co</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #000; color: #fff; }
        .glitch {
            font-weight: 900;
            text-transform: uppercase;
            position: relative;
            text-shadow: 0.05em 0 0 rgba(255, 0, 0, 0.75), -0.025em -0.05em 0 rgba(0, 255, 0, 0.75), 0.025em 0.05em 0 rgba(0, 0, 255, 0.75);
            animation: glitch 500ms infinite;
        }
        @keyframes glitch {
            0% { text-shadow: 0.05em 0 0 rgba(255, 0, 0, 0.75), -0.05em -0.025em 0 rgba(0, 255, 0, 0.75), -0.025em 0.05em 0 rgba(0, 0, 255, 0.75); }
            50% { text-shadow: 0.025em 0.05em 0 rgba(255, 0, 0, 0.75), 0.05em 0 0 rgba(0, 255, 0, 0.75), 0 -0.05em 0 rgba(0, 0, 255, 0.75); }
            100% { text-shadow: -0.025em 0 0 rgba(255, 0, 0, 0.75), -0.025em -0.025em 0 rgba(0, 255, 0, 0.75), -0.025em -0.05em 0 rgba(0, 0, 255, 0.75); }
        }
    </style>
</head>
<body class="h-screen flex items-center justify-center relative overflow-hidden">
    <div class="text-center z-10 px-6">
        <h2 class="text-zinc-500 tracking-[0.8em] uppercase text-[10px] md:text-[12px] mb-4">mhm.co exclusive drop</h2>
        <h1 class="glitch text-[50px] md:text-[100px] leading-none mb-6 italic">Coming<br>Soon</h1>
        <div class="w-24 h-1 bg-red-600 mx-auto mb-8"></div>
        <p class="text-zinc-400 text-[12px] md:text-[14px] tracking-[0.3em] uppercase mb-12 max-w-lg mx-auto">
            Our most exclusive collection is currently under heavy construction. Stay tuned.
        </p>
        <a href="/" class="inline-block border border-zinc-700 text-zinc-400 px-10 py-3 text-[11px] font-bold uppercase tracking-[0.3em] hover:bg-white hover:text-black hover:border-white transition-all duration-500">
            Back to Home
        </a>
    </div>
    <div class="absolute inset-0 opacity-10" style="background-image: linear-gradient(#333 1px, transparent 1px), linear-gradient(90deg, #333 1px, transparent 1px); background-size: 50px 50px;"></div>
</body>
</html>