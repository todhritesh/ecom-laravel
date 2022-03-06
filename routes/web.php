<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::prefix('admin')->group(function(){
    Route::resource('category',CategoryController::class);
    Route::resource('product',ProductController::class);

});


Route::post("/add/to/cart/{pid?}",[OrderController::class,"addToCart"]);
Route::post("/remove/from/cart/{pid?}",[OrderController::class,"removeFromCart"]);

//buy now
Route::post("/buy/now/{pid?}",[OrderController::class,"buyNow"]);

//checkout
Route::get("/checkout/{oid?}",[OrderController::class,"checkout"])->name('checkout');


//payment
Route::get('razorpay-payment', [PaymentController::class, 'create'])->name('pay.with.razorpay'); // create payment
Route::post('payment', [PaymentController::class, 'payment'])->name('payment'); //accept paymetnt

require __DIR__.'/auth.php';
