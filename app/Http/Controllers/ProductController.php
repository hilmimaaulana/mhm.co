<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Konstruktor untuk proteksi akses.
     * Ini memastikan fungsi tertentu hanya bisa diakses jika sudah login.
     */
    public function __construct()
    {
        // Fungsi admin dan checkout hanya untuk user yang login
        $this->middleware('auth')->only([
            'adminIndex', 'adminOrders', 'add', 'store', 'edit', 'update', 'destroy',
            'checkoutPayment', 'processCheckout', 'myOrders', 'rateOrder', 'updatePaymentStatus', 'updateOrderStatus'
        ]);
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $products = Product::when($search, function ($query, $search) {
            return $query->where('nama', 'LIKE', '%' . $search . '%')
                         ->orWhere('deskripsi', 'LIKE', '%' . $search . '%');
        })
        ->latest()
        ->get();

        return view('welcome', compact('products'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
        
        $products = Product::where('nama', 'LIKE', "%{$query}%")
                    ->orWhere('deskripsi', 'LIKE', "%{$query}%")
                    ->latest()
                    ->get();

        return view('search_results', compact('products', 'query'));
    }

    public function category($name)
    {
        $products = Product::where('nama', 'LIKE', '%' . $name . '%')
                    ->orWhere('deskripsi', 'LIKE', '%' . $name . '%')
                    ->latest()
                    ->get();
        
        return view('category_products', compact('products', 'name'));
    }

    public function vansLanding()
    {
        $vansAuthentic = Product::where('nama', 'LIKE', '%Vans Authentic%')->latest()->take(5)->get();
        $vansClassic   = Product::where('nama', 'LIKE', '%Vans Classic%')->latest()->take(5)->get();
        $vansEra       = Product::where('nama', 'LIKE', '%Vans Era%')->latest()->take(5)->get();
        $vansSkate     = Product::where('nama', 'LIKE', '%Vans Skate%')->orWhere('nama', 'LIKE', '%Sk8%')->latest()->take(5)->get();
        $vansKnu       = Product::where('nama', 'LIKE', '%Vans Knu%')->latest()->take(5)->get();
        $vansCollab    = Product::where('nama', 'LIKE', '%Collab%')->where('nama', 'LIKE', '%Vans%')->latest()->take(5)->get();

        $bannerTop    = 'vansbanner1.webp'; 
        $bannerBottom = 'vansbanner3.webp'; 
        $bannerSplitLeft  = 'vans01.jpg';
        $bannerSplitRight = 'vansbanner2.jpg';
        $bannerSplitLeft2  = 'vansknubanner.webp'; 
        $bannerSplitRight2 = 'banner1.webp';

        return view('category_products_vans', compact(
            'vansAuthentic', 'vansClassic', 'vansEra', 'vansSkate', 'vansKnu', 'vansCollab', 
            'bannerTop', 'bannerBottom', 'bannerSplitLeft', 'bannerSplitRight',
            'bannerSplitLeft2', 'bannerSplitRight2'
        ));
    }

    public function converseLanding()
    {
        $chuckTaylor = Product::where('nama', 'LIKE', '%Chuck Taylor%')->latest()->take(5)->get();
        $oneStar     = Product::where('nama', 'LIKE', '%One Star%')->latest()->take(5)->get();
        $runStar     = Product::where('nama', 'LIKE', '%Run Star%')->latest()->take(5)->get(); 
        $allConverse = Product::where('nama', 'LIKE', '%Converse%')->latest()->take(5)->get();

        return view('category_products_converse', compact(
            'chuckTaylor', 'oneStar', 'runStar', 'allConverse'
        ));
    }

    public function chuckTaylorLanding() {
        $chuckTaylor = Product::where('nama', 'LIKE', '%Chuck Taylor%')->latest()->get();
        return view('category_chuck_taylor', compact('chuckTaylor'));
    }

    public function allStarLanding() {
        $allStar = Product::where('nama', 'LIKE', '%All Star%')->latest()->get();
        return view('category_converse_allstar', compact('allStar'));
    }

    public function oneStarLanding() {
        $oneStar = Product::where('nama', 'LIKE', '%One Star%')->latest()->get();
        return view('category_one_star', compact('oneStar'));
    }

    public function runStarLanding() {
        $runStar = Product::where('nama', 'LIKE', '%Run Star%')
                          ->orWhere('nama', 'LIKE', '%RunStar%')
                          ->latest()->get();
        return view('category_run_star', compact('runStar'));
    }

    public function thrasherLanding()
    {
        $magazines = Product::where('nama', 'LIKE', '%Thrasher%')
                            ->where('nama', 'LIKE', '%Magazine%')
                            ->latest()->take(5)->get();

        $tshirts = Product::where('nama', 'LIKE', '%Thrasher%')
                          ->where(function($q) {
                              $q->where('nama', 'LIKE', '%T-Shirt%')
                                ->orWhere('nama', 'LIKE', '%Kaos%');
                          })->latest()->take(5)->get();

        $jackets = Product::where('nama', 'LIKE', '%Thrasher%')
                          ->where(function($q) {
                              $q->where('nama', 'LIKE', '%Hoodie%')
                                ->orWhere('nama', 'LIKE', '%Jacket%')
                                ->orWhere('nama', 'LIKE', '%Jaket%');
                          })->latest()->take(5)->get();

        $bannerThrasherTop    = 'thrasherbanner3.webp';
        $bannerThrasherBottom = 'thrasherbanner4.jpg';

        return view('category_products_thrasher', compact(
            'magazines', 'tshirts', 'jackets', 
            'bannerThrasherTop', 'bannerThrasherBottom'
        ));
    }

    public function thrasherMagazine() {
        $thrasherMag = Product::where('nama', 'LIKE', '%Thrasher%')->where('nama', 'LIKE', '%Magazine%')->latest()->get();
        return view('category_thrasher_magazine', compact('thrasherMag'));
    }

    public function thrasherBaju() {
        $thrasherTshirt = Product::where('nama', 'LIKE', '%Thrasher%')->where(function($q) {
            $q->where('nama', 'LIKE', '%T-Shirt%')->orWhere('nama', 'LIKE', '%Kaos%');
        })->latest()->get();
        return view('category_thrasher_baju', compact('thrasherTshirt'));
    }

    public function thrasherJacket() {
        $thrasherHoodie = Product::where('nama', 'LIKE', '%Thrasher%')->where(function($q) {
            $q->where('nama', 'LIKE', '%Hoodie%')->orWhere('nama', 'LIKE', '%Jacket%')->orWhere('nama', 'LIKE', '%Jaket%');
        })->latest()->get();
        return view('category_thrasher_jacket', compact('thrasherHoodie'));
    }

    public function limitedLanding()
    {
        $limitedProducts = Product::where('nama', 'LIKE', '%Limited%')->latest()->get();
        $bannerLimitedTop = 'limited_hero.jpg';
        return view('category_products_limited', compact('limitedProducts', 'bannerLimitedTop'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $relatedProducts = Product::where('id', '!=', $id)->limit(4)->get();
        return view('show', compact('product', 'relatedProducts'));
    }

    // --- ADMIN SECTION ---
    public function adminIndex()
    {
        $products = Product::latest()->get();
        return view('admin_index', compact('products'));
    }

    public function adminOrders()
    {
        $orders = Order::with(['product', 'user'])->latest()->get(); 
        return view('admin_orders', compact('orders'));
    }

    public function updatePaymentStatus($id, $status)
    {
        $order = Order::findOrFail($id);
        $order->update(['payment_status' => $status]);
        return redirect()->back()->with('success', 'Status pembayaran diperbarui!');
    }

    public function updateOrderStatus($id, $status)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => $status]);
        return redirect()->back()->with('success', "Status pesanan diperbarui!");
    }

    public function add()
    {
        return view('admin_add');
    }

    public function store(Request $request)
    {
        // Validasi diubah dari 'image' menjadi 'string' agar bisa menampung URL teks luar
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'gambar' => 'required|string',
            'gambar_belakang' => 'nullable|string'
        ]);

        $data = $request->only(['nama', 'harga', 'deskripsi']);

        // Mengambil data input string URL langsung tanpa proses penyimpanan file fisik ke server
        if ($request->filled('gambar')) {
            $data['gambar'] = $request->input('gambar');
        }

        if ($request->filled('gambar_belakang')) {
            $data['gambar_belakang'] = $request->input('gambar_belakang');
        }

        // FIX UTAMA: Otomatis inject data 'kategori' berdasarkan text nama produk agar sinkron dengan query Toko/Landing Page
        $namaLower = strtolower($request->nama);
        if (str_contains($namaLower, 'vans')) {
            $data['kategori'] = 'vans';
        } elseif (str_contains($namaLower, 'converse')) {
            $data['kategori'] = 'converse';
        } elseif (str_contains($namaLower, 'thrasher')) {
            $data['kategori'] = 'thrasher';
        } else {
            $data['kategori'] = 'others';
        }

        Product::create($data);
        return redirect('/admin')->with('success', 'Produk berhasil ditambah!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin_edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        // Validasi diubah menjadi string URL opsional agar lancar di Vercel
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'gambar' => 'nullable|string',
            'gambar_belakang' => 'nullable|string'
        ]);

        $product = Product::findOrFail($id);
        $data = $request->only(['nama', 'harga', 'deskripsi']);

        // Langsung timpa data string link URL di database tanpa fungsi unlink file fisik
        if ($request->filled('gambar')) {
            $data['gambar'] = $request->input('gambar');
        }

        if ($request->filled('gambar_belakang')) {
            $data['gambar_belakang'] = $request->input('gambar_belakang');
        }

        // Amankan update kategori juga ketika nama di-edit admin
        $namaLower = strtolower($request->nama);
        if (str_contains($namaLower, 'vans')) {
            $data['kategori'] = 'vans';
        } elseif (str_contains($namaLower, 'converse')) {
            $data['kategori'] = 'converse';
        } elseif (str_contains($namaLower, 'thrasher')) {
            $data['kategori'] = 'thrasher';
        } else {
            $data['kategori'] = 'others';
        }

        $product->update($data);
        return redirect('/admin')->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        // Menghapus fungsi unlink() karena file disimpan berbentuk URL, menghindari error Read-Only Vercel
        $product->delete();
        return redirect('/admin')->with('success', 'Produk berhasil dihapus!');
    }

    // --- CART & CHECKOUT ---
    public function addToCart(Request $request, $id)
    {
        $request->validate(['size' => 'required'], ['size.required' => 'Pilih ukuran sepatu!']);

        $product = Product::findOrFail($id);
        $size = $request->input('size'); 
        $cart_id = $id . '_' . $size;
        $cart = session()->get('cart', []);

        if(isset($cart[$cart_id])) {
            $cart[$cart_id]['quantity']++;
        } else {
            $cart[$cart_id] = [
                "product_id" => $id,
                "nama" => $product->nama,
                "quantity" => 1,
                "harga" => (int) $product->harga,
                "gambar" => $product->gambar,
                "size" => $size
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.show')->with('success', 'Produk masuk keranjang!');
    }

    public function showCart()
    {
        $cartItems = session()->get('cart', []);
        $totalPrice = collect($cartItems)->sum(function($item) {
            return $item['harga'] * $item['quantity'];
        });
        return view('cart_index', compact('cartItems', 'totalPrice'));
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Produk dihapus!');
    }

    public function checkoutPayment()
    {
        $cart = session()->get('cart');
        if(!$cart || count($cart) == 0) {
            return redirect('/')->with('error', 'Keranjang kosong!');
        }
        return view('checkout_payment');
    }

    public function processCheckout(Request $request)
    {
        $request->validate(['payment_method' => 'required']);
        $cart = session()->get('cart');
        
        /** * FIX: Mengubah redirect()->route('index') menjadi redirect('/') 
         * untuk menghindari error 'Route [index] not defined'
         */
        if(!$cart || count($cart) == 0) return redirect('/');

        $payment = $request->input('payment_method');
        $totalTagihan = 0; 

        // Generate satu ID pesanan unik untuk satu transaksi
        $transactionGroup = 'MHM-' . strtoupper(uniqid());

        foreach($cart as $item) {
            $totalTagihan += $item['harga'] * $item['quantity']; 
            Order::create([
                'user_id'           => Auth::id(), 
                'product_id'        => $item['product_id'], 
                'nama_produk'       => $item['nama'],
                'size'              => $item['size'],
                'harga'             => $item['harga'],
                'quantity'          => $item['quantity'],
                'status'            => 'pending',
                'metode_pembayaran' => $payment,
                'payment_status'    => 'belum lunas'
            ]);
        }

        session()->forget('cart');
        
        return view('checkout_success', [
            'paymentMethod' => $payment,
            'total' => $totalTagihan,
            'orderId' => $transactionGroup
        ]);
    }

    public function myOrders()
    {
        // Menambahkan with('product') agar lebih efisien
        $orders = Order::with('product')->where('user_id', Auth::id())->latest()->get();
        return view('user_orders', compact('orders'));
    }

    public function rateOrder(Request $request, $id)
    {
        $request->validate(['rating' => 'required|integer|min:1|max:5']);
        
        // Proteksi agar user hanya bisa rate pesanannya sendiri
        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $order->update(['rating' => $request->rating]);
        
        return redirect()->back()->with('success', 'Terima kasih atas ratingnya!');
    }
}