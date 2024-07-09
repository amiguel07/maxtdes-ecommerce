<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Livewire\Admin\BrandController;
use App\Http\Livewire\Admin\CreateProduct;
use App\Http\Livewire\Admin\DepartmentController;
use App\Http\Livewire\Admin\DistrictCity;
use App\Http\Livewire\Admin\EditProduct;
use App\Http\Livewire\Admin\ShowCategory;
use App\Http\Livewire\Admin\ShowDepartment;
use App\Http\Livewire\Admin\ShowProducts;
use App\Http\Livewire\Admin\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Admin\CarouselController;
use App\Http\Livewire\Admin\PaymentController;

Route::get('/', ShowProducts::class)->name('admin.index');

Route::get('products/create', CreateProduct::class)->name('admin.products.create');

Route::get('products/{product}/edit', EditProduct::class)->name('admin.products.edit');

Route::post('products/{product}/files', [ProductController::class,'files'])->name('admin.products.files');

Route::get('categories', [CategoryController::class,'index'])->name('admin.categories.index');

Route::get('categories/{category}', ShowCategory::class)->name('admin.categories.show');



Route::get('orders',[OrderController::class,'index'])->name('admin.orders.index');

Route::get('orders/{order}',[OrderController::class,'show'])->name('admin.orders.show');

Route::get('departments', DepartmentController::class)->name('admin.departments.index');
Route::get('departments/{department}', ShowDepartment::class)->name('admin.departments.show');

Route::get('cities/{city}', DistrictCity::class)->name('admin.cities.show');

Route::get('users', UserController::class)->name('admin.users.index');

// Carousel

Route::get('carousels', CarouselController::class)->name('admin.carousels.index');

// Payment

Route::get('payments', PaymentController::class)->name('admin.payments.index');