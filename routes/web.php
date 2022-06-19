<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\VariationController;
use App\Http\Controllers\FrontEnd\CheckoutController;
use App\Http\Controllers\FrontEnd\OrderConfirmationController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\FrontEnd\ShopController;
use App\Http\Livewire\FrontEnd\CartComponent;
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
})->name('welcome');

Route::get('/shop/{category:slug}', [ShopController::class, 'categoryShow'])->name('shop.category.show');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/products/{product:slug}', [ShopController::class, 'show'])->name('shop.show');

Route::get('/cart', CartComponent::class)->name('cart.index');

Route::get('/checkout', CheckoutController::class)->name('checkout');

Route::get('/orders/{order:uuid}/confirmation', OrderConfirmationController::class)->name('orders.confirmation');

Route::group(['middleware' => 'auth', 'verified'], function(){
    
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    
    //Buyers routes
    Route::get('/orders', OrderController::class)->name('orders');

    //Admin routes
    Route::group(['middleware' => ['role:super-admin|admin|seller'], 'prefix' => 'admin', 'as' => 'admin.'], function(){ //'middleware' => ['role:admin'], 
        
        //Admin Dashboard
        Route::get('/', [AdminController::class, 'index'])->name('index');

        //Delete Photo
        Route::get('products/{productId}/photos/{photoId}/delete', [ProductController::class, 'deletePhoto'])->name('products.deletePhoto');

        //Controller Route
        Route::resources([
            'products' => ProductController::class,
            'categories' => CategoryController::class,
            'tags' => TagController::class,
            'variations' => VariationController::class,
            'attributes' => AttributeController::class,
            'orders' => AdminOrderController::class,
        ]);
    });
});

require __DIR__.'/auth.php';
