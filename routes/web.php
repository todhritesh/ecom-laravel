<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
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
})->middleware(['auth','verified'])->name('dashboard');


Route::prefix('admin')->group(function(){
    Route::resource('category',CategoryController::class);
    Route::resource('product',ProductController::class);

});


Route::get("/",[HomeController::class,"index"])->name('index');

Route::get("/products",[ProductController::class,"index"])->name("product.index");
Route::get("/pro/singleView/{id}",[ProductController::class,"singleView"])->name("product.singleView");

Route::get("/category/{id}",[CategoryController::class,"index"])->name("category.index");

Route::get("/cart",[HomeController::class,"cart"])->name("cart");

Route::get("/checkout",[HomeController::class,"checkout"])->name("checkout");



require __DIR__.'/auth.php';
