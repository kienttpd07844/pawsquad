<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\Attribute_SetControllerAdmin;
use App\Http\Controllers\Admin\AttributesControllerAdmin;
use App\Http\Controllers\Admin\BrandsControllerAdmin;
use App\Http\Controllers\Admin\CategoryControllerAdmin;
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

            Route::middleware(['role:9,10'])->prefix('attributes-sets')->name('attributes_sets.')->group(
                function () {
                    Route::match(['get', 'post'], '/', [Attribute_SetControllerAdmin::class, 'index'])->name('index');
                    Route::match(['get', 'post'], '/parent/{id?}', [Attribute_SetControllerAdmin::class, 'parent'])->name('parent')->where(['id' => '[0-9]+']);
                    Route::get('add', [Attribute_SetControllerAdmin::class, 'add'])->name('addAttribute_Set');
                    Route::post('add', [Attribute_SetControllerAdmin::class, 'postAdd'])->name('postAddAttribute_Set');
                    Route::get('edit/{id?}', [Attribute_SetControllerAdmin::class, 'edit'])->name('editAttribute_Set')->where(['id' => '[0-9]+']);
                    Route::put('edit/{id?}', [Attribute_SetControllerAdmin::class, 'postEdit'])->name('postEditAttribute_Set');
                    Route::get('delete/{id?}', [Attribute_SetControllerAdmin::class, 'delete'])->name('deleteAttribute_Set')->where(['id' => '[0-9]+']);
                }
            );

            Route::middleware(['role:9,10'])->prefix('attributes')->name('attributes.')->group(
                function () {
                    Route::match(['get', 'post'], '/', [AttributesControllerAdmin::class, 'index'])->name('index');
                    Route::get('add', [AttributesControllerAdmin::class, 'add'])->name('addAttribute');
                    Route::post('add', [AttributesControllerAdmin::class, 'postAdd'])->name('postAddAttribute');
                    Route::get('edit/{id?}', [AttributesControllerAdmin::class, 'edit'])->name('editAttribute')->where(['id' => '[0-9]+']);
                    Route::put('edit/{id?}', [AttributesControllerAdmin::class, 'postEdit'])->name('postEditAttribute');
                    Route::get('delete/{id?}', [AttributesControllerAdmin::class, 'delete'])->name('deleteAttribute')->where(['id' => '[0-9]+']);
                }
            );

            Route::middleware(['role:10'])->prefix('category')->name('category.')->group(
                function () {
                    Route::match(['get', 'post'], '/', [CategoryControllerAdmin::class, 'index'])->name('index');
                    Route::match(['get', 'post'], '/parent/{id?}', [CategoryControllerAdmin::class, 'parent'])->name('parent')->where(['id' => '[0-9]+']);
                    Route::match(['get', 'post'], '/trashed', [CategoryControllerAdmin::class, 'trashed'])->name('trashed');
                    Route::get('restore/{id?}', [CategoryControllerAdmin::class, 'restore'])->name('restoreBrands')->where(['id' => '[0-9]+']);
                    Route::get('add', [CategoryControllerAdmin::class, 'add'])->name('addCategory');
                    Route::post('add', [CategoryControllerAdmin::class, 'postAdd'])->name('postAddCategory');
                    Route::get('edit/{id?}', [CategoryControllerAdmin::class, 'edit'])->name('editCategory')->where(['id' => '[0-9]+']);
                    Route::put('edit/{id?}', [CategoryControllerAdmin::class, 'postEdit'])->name('postEditCategory');
                    Route::get('delete/{id?}', [CategoryControllerAdmin::class, 'delete'])->name('deleteCategory')->where(['id' => '[0-9]+']);
                }
            );
            Route::middleware(['role:10'])->prefix('brands')->name('brands.')->group(
                function () {
                    Route::match(['get', 'post'], '/', [BrandsControllerAdmin::class, 'index'])->name('index');
                    Route::match(['get', 'post'], '/trashed', [BrandsControllerAdmin::class, 'trashed'])->name('trashed');
                    Route::get('restore/{id?}', [BrandsControllerAdmin::class, 'restore'])->name('restoreBrands')->where(['id' => '[0-9]+']);
                    Route::get('add', [BrandsControllerAdmin::class, 'add'])->name('addBrands');
                    Route::post('add', [BrandsControllerAdmin::class, 'postAdd'])->name('postAddBrands');
                    Route::get('edit/{id?}', [BrandsControllerAdmin::class, 'edit'])->name('editBrands')->where(['id' => '[0-9]+']);
                    Route::put('edit/{id?}', [BrandsControllerAdmin::class, 'postEdit'])->name('postEditBrands');
                    Route::get('delete/{id?}', [BrandsControllerAdmin::class, 'delete'])->name('deleteBrands')->where(['id' => '[0-9]+']);
                }
            );
        });
    });


});
