<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\AOrderController;
use App\Http\Controllers\Frontend\UserController1;

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;

// use App\Http\Controllers\Admin\OrderController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();


Route::controller(FrontendController::class)->group(function () {
    Route::get('/','index');
    Route::get('/collections','categories');
    Route::get('/collections/{category_slug}','products');
    Route::get('/collections/{category_slug}/{product_slug}','productsView');
    
    Route::get('/new-arrivals','newArrival');
    Route::get('/featured-products','featuredProducts');

    Route::get('/search','searchProducts');
});

Route::middleware(['auth'])->group(function(){
    Route::get('wishlist',[WishlistController::class,'index']);
    Route::get('cart',[CartController::class,'index']);
    Route::get('checkout',[CheckoutController::class,'index']);
    
    Route::get('orders',[OrderController::class,'index']);
    Route::get('orders/{orderId}',[OrderController::class,'show']);

    Route::get('profile',[UserController1::class,'index']);
    Route::post('profile',[UserController1::class,'updateUserDetails']);


});
Route::get('thank-you',[FrontendController::class,'thankyou']);


Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->middleware('auth','isAdmin')->group(function(){
    Route::get('dashboard',[DashboardController::class,'index']); 
    
    Route::get('settings',[SettingController::class,'index']);
    Route::post('settings',[SettingController::class,'store']);

    Route::controller(SliderController::class)->group(function () {
        Route::get('sliders','index');
        Route::get('sliders/create','create');
        Route::post('sliders/create','store');
        Route::get('sliders/{slider}/edit','edit');
        Route::put('sliders/{slider}','update');
        Route::get('sliders/{slider}/delete','destroy');
        
    });
    // Category Route
    
    Route::controller(CategoryController::class)->group(function () {
        Route::get('category','index');
        Route::get('category/create','create')->name('category.create');
        Route::post('category','store');
        Route::get('category/{category}/edit','edit');
        Route::put('category/{category}','update');
    });
    
    // Product Route
    Route::controller(ProductController::class)->group(function () {
        Route::get('products','index');
        Route::get('products/create','create');
        Route::post('products','store');
        Route::get('products/{id}/edit','edit');
        Route::put('products/{id}','update');
        Route::get('product-image/{id}/delete','destroyImage');
        Route::get('products/{id}/delete','destroy');

        Route::post('/product-color/{prod_color_id}','updateProdColorQty');
        Route::get('/product-color/{prod_color_id}/delete','deleteProdColor');
    });
    Route::controller(ColorController::class)->group(function () {
        Route::get('/colors','index');
        Route::get('/colors/create','create');
        Route::post('/colors/create','store');
        Route::get('/colors/{color}/edit','edit');
        Route::put('/colors/{color_id}','update');
        Route::get('/colors/{color_id}/delete','destroy');
        

        
    });
    // Order
    Route::controller(AOrderController::class)->group(function () {
        Route::get('/orders','index');
        Route::get('/orders/{orderId}','show');
        Route::put('/orders/{orderId}','updateOrderStatus');

        Route::get('/invoice/{orderId}','viewInvoice');
        Route::get('/invoice/{orderId}/generate','generateInvoice');
        
        Route::get('/invoice/{orderId}/mail','mailInvoice');

    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/users','index');
        Route::get('/users/create','create');
        Route::post('/users','store');
        Route::get('/users/{user_id}/edit','edit');
        Route::put('/users/{user_id}','update');
        Route::get('/users/{user_id}/delete','destroy');
    });
    Route::get('/brands',[BrandController::class,'index']);
});