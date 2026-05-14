<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController; 
use App\Models\Message; 
use Illuminate\Http\Request; 

/*
|--------------------------------------------------------------------------
| Web Routes - mhm.co Project
|--------------------------------------------------------------------------
*/

// 1. Halaman Utama (Home)
// PERBAIKAN: Nama dirubah dari 'home' menjadi 'index' agar sesuai dengan redirect di Controller
Route::get('/', [ProductController::class, 'index'])->name('index');

// --- 2. FITUR PENCARIAN GLOBAL ---
Route::get('/search', [ProductController::class, 'search'])->name('search'); 
Route::get('/search/results', [ProductController::class, 'search'])->name('search.index');
Route::get('/search/products', [ProductController::class, 'search'])->name('product.search');

// --- 3. RUTE BRAND SPESIFIK ---

// KATEGORI LIMITED
Route::get('/category/limited', [ProductController::class, 'limitedLanding'])->name('category.limited');

// Rute Coming Soon untuk link Limited Edition
Route::get('/limited-edition', function () {
    return view('limited_edition');
})->name('limited.soon');

// VANS
Route::get('/category/vans', [ProductController::class, 'vansLanding'])->name('category.vans');

// CONVERSE & SUB-KATEGORI
Route::get('/category/converse/chuck-taylor', [ProductController::class, 'chuckTaylorLanding'])->name('category.converse.chucktaylor');
Route::get('/category/converse/all-star', [ProductController::class, 'allStarLanding'])->name('category.converse.allstar');
Route::get('/category/converse/one-star', [ProductController::class, 'oneStarLanding'])->name('category.converse.onestar');
Route::get('/category/converse/run-star', [ProductController::class, 'runStarLanding'])->name('category.converse.runstar');
Route::get('/category/converse', [ProductController::class, 'converseLanding'])->name('category.converse');

// THRASHER & SUB-KATEGORI
Route::get('/category/thrasher/magazine', [ProductController::class, 'thrasherMagazine'])->name('category.thrasher.magazine');
Route::get('/category/thrasher/tshirt', [ProductController::class, 'thrasherBaju'])->name('category.thrasher.tshirt'); 
Route::get('/category/thrasher/jacket', [ProductController::class, 'thrasherJacket'])->name('category.thrasher.jacket');
Route::get('/category/thrasher', [ProductController::class, 'thrasherLanding'])->name('category.thrasher');

// --- 4. RUTE DINAMIS CATEGORY ---
Route::get('/category/{name}', [ProductController::class, 'category'])->name('category.show');

// 5. Halaman Detail Produk
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// --- 6. FITUR AUTENTIKASI ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 7. Fitur Keranjang, Checkout, Profile & My Orders (Wajib Login)
Route::middleware(['auth'])->group(function () {
    Route::post('/cart/add/{id}', [ProductController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [ProductController::class, 'showCart'])->name('cart.show');
    Route::delete('/cart/remove/{id}', [ProductController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/checkout/payment', [ProductController::class, 'checkoutPayment'])->name('checkout.payment');
    Route::post('/checkout/process', [ProductController::class, 'processCheckout'])->name('checkout.process');
    
    // Dashboard & Profile
    Route::get('/dashboard', [ProductController::class, 'myOrders'])->name('dashboard');
    
    // Rute profile.edit
    Route::get('/profile/edit', function() {
        return view('user_orders'); 
    })->name('profile.edit');

    Route::get('/profile', [ProductController::class, 'myOrders'])->name('user.index');
    Route::get('/my-orders', [ProductController::class, 'myOrders'])->name('my.orders');
    Route::get('/orders-list', [ProductController::class, 'myOrders'])->name('user.orders');
    
    Route::post('/my-orders/{id}/rate', [ProductController::class, 'rateOrder'])->name('user.orders.rate');
});

// 8. Fitur Kirim Pesan (Contact Us Footer)
Route::post('/send-message', function (Request $request) {
    $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email',
        'message' => 'required',
    ]);
    Message::create([
        'name'    => $request->name,
        'email'   => $request->email,
        'message' => $request->message,
    ]);
    return redirect()->back()->with('success', 'Pesan berhasil dikirim!');
})->name('message.send');

// 9. Grouping Fitur Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [ProductController::class, 'adminIndex'])->name('admin.index'); 
    Route::get('/orders', [ProductController::class, 'adminOrders'])->name('admin.orders');
    
    Route::post('/orders/{id}/payment/{status}', [ProductController::class, 'updatePaymentStatus'])->name('admin.orders.updatePayment');
    Route::get('/orders/{id}/status/{status}', [ProductController::class, 'updateOrderStatus'])->name('admin.order.status');
    
    Route::get('/add', [ProductController::class, 'add'])->name('admin.add'); 
    Route::post('/store', [ProductController::class, 'store'])->name('admin.store'); 
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('admin.edit'); 
    Route::put('/update/{id}', [ProductController::class, 'update'])->name('admin.update'); 
    Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('admin.delete'); 

    Route::get('/messages', function() {
        $messages = Message::latest()->get();
        return view('admin_messages', compact('messages')); 
    })->name('admin.messages');
});

// 10. Fitur Reset Keranjang
Route::get('/clear-cart', function () {
    session()->forget('cart');
    return "Keranjang berhasil dibersihkan! Silahkan kembali ke <a href='/'>Beranda</a>.";
})->name('cart.clear');