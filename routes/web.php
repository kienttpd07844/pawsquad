<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\HomeControllerAdmin;
use App\Http\Controllers\Admin\UploadControllerAdmin;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Auth;
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

Route::middleware(['checkaccount'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/dang-ky', [SignUpController::class, 'index'])->name('signup');
    Route::post('/dang-ky', [SignUpController::class, 'postSignup'])->name('postSignup');

    Route::get('/dang-nhap', [LoginController::class, 'index'])->name('login');
    Route::post('/dang-nhap', [LoginController::class, 'postLogin'])->name('postLogin');

    Route::get('/quen-mat-khau', [ForgotPasswordController::class, 'index'])->name('forgotpassword');
    Route::post('/quen-mat-khau', [ForgotPasswordController::class, 'postForgotPassword'])->name('postForgotPassword');

    Route::get('/resetpassword', [ResetPasswordController::class, 'index'])->name('password.reset');
    Route::post('/resetpassword', [ResetPasswordController::class, 'postReset'])->name('postResetPassword');

    Route::get('/gioi-thieu', [AboutController::class, 'index'])->name('about');

    Route::get('/dich-vu/{slug}', [ServiceController::class, 'index'])->name('service');

    Route::get('/san-pham', [ProductController::class, 'all'])->name('product');
    Route::get('/san-pham/{slug}', [ProductController::class, 'list'])->name('list.product');

    Route::get('/gio-hang', [CartController::class, 'index'])->name('cart');
    Route::get('/thanh-toan', [CheckoutController::class, 'index'])->name('checkout');

    Route::get('/thuong-hieu', [BrandController::class, 'index'])->name('brand');

    Route::get('/tin-tuc', [BlogController::class, 'all'])->name('blog');
    Route::get('/tin-tuc/{slug}', [BlogController::class, 'detail'])->name('detail.blog');

    Route::get('/yeu-thich', [WishlistController::class, 'index'])->name('wishlist');

    Route::controller(SocialController::class)->group(function ($router) {
        $router->pattern('provider', 'google');
        Route::get('/dang-nhap/{provider}', 'getProviderTargetUrl')->name('login.google');
        Route::get('{provider}/callback', 'handleProviderCallback');
    });
    Route::middleware(['auth'])->group(function () {
        Route::get('/dang-xuat', [LoginController::class, 'logout'])->name('logout');

        Route::get('/tai-khoan', [UserController::class, 'index'])->name('account');
        Route::post('/tai-khoan', [UserController::class, 'postEdit'])->name('postEditAccount');

        Route::get('/email/xac-minh/{id}/{hash}', [UserController::class, 'checkVerify'])->name('verification.verify');
        Route::get('/tai-khoan/xac-minh', [UserController::class, 'verify'])->name('verify');
        Route::post('/tai-khoan/xac-minh', [UserController::class, 'postVerify'])->name('postVerify');
    });
    Route::middleware(['role:1,9,10'])->group(function () {
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/', [HomeControllerAdmin::class, 'index'])->name('home');

            Route::prefix('file')->name('file.')->group(
                function () {
                    Route::post('/upload', [UploadControllerAdmin::class, 'upload'])->name('uploadImage');
                    Route::post('/upload1', [UploadControllerAdmin::class, 'upload1'])->name('uploadImage1');
                    Route::get('/deleteimage1', [UploadControllerAdmin::class, 'delete1'])->name('deleteImage1');
                    Route::get('/deleteimage2', [UploadControllerAdmin::class, 'delete2'])->name('deleteImage2');
                    Route::get('/deleteimage', [UploadControllerAdmin::class, 'delete'])->name('deleteImage');
                    Route::get('/getimage', [UploadControllerAdmin::class, 'getimage'])->name('getOldImage');
                    Route::get('/getimage1', [UploadControllerAdmin::class, 'getimage1'])->name('getOldImage1');
                    Route::get('/get-file-info', [UploadControllerAdmin::class, 'getFile'])->name('get-file-info');
                }
            );
        });
    });


});
