<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Livewire\CreateOrder;
use App\Http\Livewire\ShoppingCart;
use App\Http\Controllers\OrderController;
use App\Http\Livewire\PaymentOrder;
use App\Models\Order;

Route::get('/',HomeController::class)->name('home');

Route::get('search',SearchController::class)->name('search');

Route::get('categories/{category}',[CategoryController::class,'show'])->name('categories.show');

Route::get('products/{product}',[ProductController::class,'show'])->name('products.show');

Route::get('shopping-cart',ShoppingCart::class)->name('shopping-cart');

/*En RouteServiceProvider cambio la ruta de dashboard a '/'
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');*/

Route::middleware(['auth'])->group(function ()
{
    Route::get('orders/create', CreateOrder::class)->name('orders.create');

    /*MercadoPago*/
    Route::get('orders/{order}/pay',[OrderController::class,'payOrderMercadoPago'])->name('orders.pay.mercadopago');
    /*Pypal*/
    Route::get('orders/{order}/payment', PaymentOrder::class)->name('orders.payment');

    Route::get('orders',[OrderController::class,'index'])->name('orders.index');
    /*Si trabajará con weebhocks tendría que ser post*/
    Route::get('orders/{order}',[OrderController::class,'show'])->name('orders.show');
});







