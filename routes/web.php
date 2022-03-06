<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::prefix('admin')->group(function(){
    Route::resource('category',CategoryController::class);
    Route::resource('product',ProductController::class);

});

//login


Route::get("/",[HomeController::class,"index"])->name('index');

Route::get("/products",[ProductController::class,"index"])->name("product.index");
Route::get("/pro/singleView/{id}",[ProductController::class,"singleView"])->name("product.singleView");

Route::get("/category/{id}",[CategoryController::class,"index"])->name("category.index");

Route::get("/cart",[HomeController::class,"cart"])->name("cart");

Route::get("/checkoutPage",[HomeController::class,"checkout"])->name("checkoutPage");



Route::group(['middleware'=>['LoginMiddleware']],function(){

    Route::get("/add/to/cart/{pid?}",[OrderController::class,"addToCart"])->name('addToCart');
});



//dhritesh


Route::get("/remove/from/cart/{pid?}",[OrderController::class,"removeFromCart"])->name('removeFromCart');

//buy now
Route::get("/buy/now/{pid?}",[OrderController::class,"buyNow"])->name('buy_now');

//checkout
Route::get("/checkout/{oid?}",[OrderController::class,"checkout"])->name('checkout');


//payment
Route::get('razorpay-payment', [PaymentController::class, 'create'])->name('pay.with.razorpay'); // create payment
Route::post('payment', [PaymentController::class, 'payment'])->name('payment'); //accept paymetnt



require __DIR__.'/auth.php';
