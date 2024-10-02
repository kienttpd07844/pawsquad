<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('/gioi-thieu',[AboutController::class,'index'])->name('about');

Route::get('/dich-vu/{slug}',[ServiceController::class,'index'])->name('service');

Route::get('/san-pham',[ProductController::class,'all'])->name('product');
Route::get('/san-pham/{slug}',[ProductController::class,'list'])->name('list.product');

Route::get('/gio-hang',[CartController::class,'index'])->name('cart');
Route::get('/thanh-toan',[CheckoutController::class,'index'])->name('checkout');

Route::get('/thuong-hieu',[BrandController::class,'index'])->name('brand');

Route::get('/tin-tuc',[BlogController::class,'all'])->name('blog');
Route::get('/tin-tuc/{slug}',[BlogController::class,'detail'])->name('detail.blog');

Route::get('/dang-nhap',[LoginController::class,'index'])->name('login');
Route::get('/dang-xuat',[LoginController::class,'index'])->name('logout');
Route::get('/dang-ky',[SignUpController::class,'index'])->name('signup');
Route::get('/quen-mat-khau',[ForgotPasswordController::class,'index'])->name('forgotpassword');

Route::get('/yeu-thich',[WishlistController::class,'index'])->name('wishlist');

Route::get('/tai-khoan',[UserController::class,'index'])->name('account');
