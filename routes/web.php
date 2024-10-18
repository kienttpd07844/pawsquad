<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\Admin\Attribute_SetControllerAdmin;
use App\Http\Controllers\Admin\AttributesControllerAdmin;
use App\Http\Controllers\Admin\BrandsControllerAdmin;
use App\Http\Controllers\Admin\CategoryControllerAdmin;
use App\Http\Controllers\Admin\EmailControllerAdmin;
use App\Http\Controllers\Admin\HomeControllerAdmin;
use App\Http\Controllers\Admin\ProductControllerAdmin;
use App\Http\Controllers\Admin\UploadControllerAdmin;
use App\Http\Controllers\Admin\VariationsControllerAdmin;
use App\Http\Controllers\Admin\VariationValuesControllerAdmin;
use App\Http\Controllers\Admin\VoucherControllerAdmin;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatController;
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
    Route::get('/san-pham/{slug}', [ProductController::class, 'detail'])->where('slug', '^(?!loc$).*')->name('product.detail');
    Route::get('/san-pham/loc', [ProductController::class, 'filter'])->name('filter.product');
    Route::post('/san-pham/thong-tin', [ProductController::class, 'showInfo'])->name('showInfo.product');
    Route::post('/san-pham/thong-tin-bien-the', [ProductController::class, 'getVariationInfo'])->name('showVariationInfo.product');
    Route::get('/danh-muc/{slug}', [CategoryController::class, 'list'])->name('list.category');
    Route::get('/danh-muc/loc/{slug}', [CategoryController::class, 'filter'])->name('filter.category');

    Route::get('/gio-hang', [CartController::class, 'index'])->name('cart');
    Route::post('/gio-hang/them', [CartController::class, 'add'])->name('carts.add');
    Route::post('/gio-hang/cap-nhat', [CartController::class, 'update'])->name('carts.update');
    Route::post('/gio-hang/ap-dung-ma-giam-gia', [CartController::class, 'applyCoupon'])->name('carts.applyCoupon');
    Route::get('/gio-hang/xoa-ma-giam-gia', [CartController::class, 'clearCoupon'])->name('carts.clearCoupon');
    Route::post('/gio-hang/thong-tin-ma-giam-gia', [CartController::class, 'infoCoupon'])->name('carts.infoCoupon');
    Route::get('/gio-hang/danh-sach-ma-giam-gia', [CartController::class, 'getCoupon'])->name('carts.getCoupon');

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

        Route::get('/thanh-toan', [CheckoutController::class, 'index'])->name('checkout');
        Route::post('/thanh-toan', [CheckoutController::class, 'complete'])->name('checkout.complete');
        Route::post('/thanh-toan/vnpay', [CheckoutController::class, 'payWithVNPAY'])->name('checkout.payWithVNPAY');
        Route::get('/thanh-toan/vnpay/kiem-tra', [CheckoutController::class, 'checkPayVNPAY'])->name('checkout.checkPayVNPAY');
        
        Route::get('/dia-chi/save-all', [AddressController::class, 'fetchAndSaveAddresses'])->name('fetchAndSaveAddress');
        Route::post('/dia-chi/luu', [AddressController::class, 'store'])->name('address.store');
        Route::post('/dia-chi/sua', [AddressController::class, 'edit'])->name('address.edit');
        Route::post('/dia-chi/cap-nhat', [AddressController::class, 'update'])->name('address.update');
        Route::get('/dia-chi/xoa/{id}', [AddressController::class, 'delete'])->name('address.delete');
        Route::post('/dia-chi/huyen', [AddressController::class, 'getDistrict'])->name('address.getDistrict');
        Route::post('/dia-chi/xa', [AddressController::class, 'getWard'])->name('address.getWard');
        Route::post('/dia-chi/thon', [AddressController::class, 'getVillage'])->name('address.getVillage');
    });
    Route::get('emails/theme/{id?}', [EmailControllerAdmin::class, 'getTheme'])->name('admin.emails.getTheme')->where(['id' => '[0-9]+']);
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
                    Route::get('restore/{id?}', [CategoryControllerAdmin::class, 'restore'])->name('restoreCategory')->where(['id' => '[0-9]+']);
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
            Route::middleware(['role:10'])->prefix('variations')->name('variations.')->group(
                function () {
                    Route::match(['get', 'post'], '/', [VariationsControllerAdmin::class, 'index'])->name('index');
                    Route::match(['get', 'post'], '/parent/{id?}', [VariationsControllerAdmin::class, 'parent'])->name('parent')->where(['id' => '[0-9]+']);
                    Route::match(['get', 'post'], '/trashed', [VariationsControllerAdmin::class, 'trashed'])->name('trashed');
                    Route::get('restore/{id?}', [VariationsControllerAdmin::class, 'restore'])->name('restoreVariations')->where(['id' => '[0-9]+']);
                    Route::get('add', [VariationsControllerAdmin::class, 'add'])->name('addVariations');
                    Route::post('add', [VariationsControllerAdmin::class, 'postAdd'])->name('postAddVariations');
                    Route::get('edit/{id?}', [VariationsControllerAdmin::class, 'edit'])->name('editVariations')->where(['id' => '[0-9]+']);
                    Route::put('edit/{id?}', [VariationsControllerAdmin::class, 'postEdit'])->name('postEditVariations');
                    Route::get('delete/{id?}', [VariationsControllerAdmin::class, 'delete'])->name('deleteVariations')->where(['id' => '[0-9]+']);
                }
            );
            Route::middleware(['role:10'])->prefix('variations-values')->name('variations-values.')->group(
                function () {
                    Route::match(['get', 'post'], '/', [VariationValuesControllerAdmin::class, 'index'])->name('index');
                    Route::get('add', [VariationValuesControllerAdmin::class, 'add'])->name('addVariationValues');
                    Route::post('add', [VariationValuesControllerAdmin::class, 'postAdd'])->name('postAddVariationValues');
                    Route::get('edit/{id?}', [VariationValuesControllerAdmin::class, 'edit'])->name('editVariationValues')->where(['id' => '[0-9]+']);
                    Route::put('edit/{id?}', [VariationValuesControllerAdmin::class, 'postEdit'])->name('postEditVariationValues');
                }
            );

            Route::middleware(['role:10'])->prefix('vouchers')->name('vouchers.')->group(
                function () {
                    Route::match(['get', 'post'], '/', [VoucherControllerAdmin::class, 'index'])->name('index');
                    Route::match(['get', 'post'], '/history', [VoucherControllerAdmin::class, 'history'])->name('history');
                    Route::get('add', [VoucherControllerAdmin::class, 'add'])->name('addVouchers');
                    Route::post('add', [VoucherControllerAdmin::class, 'postAdd'])->name('postAddVouchers');
                    Route::get('edit/{id?}', [VoucherControllerAdmin::class, 'edit'])->name('editVouchers')->where(['id' => '[0-9]+']);
                    Route::put('edit/{id?}', [VoucherControllerAdmin::class, 'postEdit'])->name('postEditVouchers');
                    Route::get('delete/{id?}', [VoucherControllerAdmin::class, 'delete'])->name('deleteVouchers')->where(['id' => '[0-9]+']);
                }
            );

            Route::middleware(['role:9,10'])->prefix('products')->name('products.')->group(
                function () {
                    Route::match(['get', 'post'], '/', [ProductControllerAdmin::class, 'index'])->name('index');
                    Route::match(['get', 'post'], '/parent/{id?}', [ProductControllerAdmin::class, 'parent'])->name('parent')->where(['id' => '[0-9]+']);
                    Route::match(['get', 'post'], '/trashed', [ProductControllerAdmin::class, 'trashed'])->name('trashed');
                    Route::get('restore/{id?}', [ProductControllerAdmin::class, 'restore'])->name('restoreProduct')->where(['id' => '[0-9]+']);
                    Route::get('add', [ProductControllerAdmin::class, 'add'])->name('addProduct');
                    Route::post('add', [ProductControllerAdmin::class, 'postAdd'])->name('postAddProduct');
                    Route::get('edit/{id?}', [ProductControllerAdmin::class, 'edit'])->name('editProduct')->where(['id' => '[0-9]+']);
                    Route::post('edit/{id?}', [ProductControllerAdmin::class, 'postEdit'])->name('postEditProduct');
                    Route::get('delete/{id?}', [ProductControllerAdmin::class, 'delete'])->name('deleteProduct')->where(['id' => '[0-9]+']);

                    Route::post('/get-variation-values', [ProductControllerAdmin::class, 'getVariationValues'])->name('getVariationValues');
                    Route::post('/new-variation', [ProductControllerAdmin::class, 'getNewVariation'])->name('newVariation');
                    Route::post('/variation-combination', [ProductControllerAdmin::class, 'generateVariationCombinations'])->name('generateVariationCombinations');
                    Route::get('/get-attribute', [ProductControllerAdmin::class, 'attribute'])->name('get_attribute');
                    Route::get('/get-attributeset', [ProductControllerAdmin::class, 'attributeset'])->name('get_attributeset');
                    Route::get('/get-attribute-edit/{id?}', [ProductControllerAdmin::class, 'get_attribute_edit'])->name('get_attribute_edit');
                }
            );

            Route::middleware(['role:10'])->prefix('emails')->name('emails.')->group(
                function () {
                    Route::match(['get', 'post'], '/', [EmailControllerAdmin::class, 'index'])->name('index');
                    Route::get('edit/{id?}', [EmailControllerAdmin::class, 'edit'])->name('editEmail')->where(['id' => '[0-9]+']);
                    Route::post('edit/{id?}', [EmailControllerAdmin::class, 'postEdit'])->name('postEditEmail');
                    Route::post('uploadAsset', [EmailControllerAdmin::class, 'uploadAsset'])->name('uploadAsset');
                }
            );
        });
    });
});
