<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardConroller;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductConroller;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['isValidUser'])->group(function () {

    Route::get('/', [FrontendController::class, 'home'])->name('home');

    Route::get('/about', [FrontendController::class, 'about'])->name('about');

    Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');

    Route::get('/shop', [FrontendController::class, 'shop'])->name('shop');

    Route::get('/unauthorized', [FrontendController::class, 'unauthorized_acess'])->name('unauthorized');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});



Route::middleware(['auth', 'validRole:3'])->group(function () {
    // Route::get('/cart/page', [CartController::class, 'Cart'])->name('cart.page');

    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'getCart'])->name('cart.get');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeCartItem'])->name('cart.remove');
    Route::put('/cart/update/{id}', [CartController::class, 'updateCartItem'])->name('cart.update');

    Route::post('/order/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
});


Route::get('/signup', [AuthController::class, 'signup'])->name('signuppage');
Route::post('/login', [AuthController::class, 'login_req'])->name('login.req');
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('/signup/req', [AuthController::class, 'signup_req'])->name('signup.req');


Route::middleware(['auth', 'validRole:1,'])->group(function () {
    Route::get('/dashboard', [DashboardConroller::class, 'dashboardpage'])->name('dashboard.page');

    Route::get('category/page', [DashboardConroller::class, 'category_crud_page'])->name('category.page');
    Route::resource('categories', CategoryController::class);
    Route::get('trash/categories', [CategoryController::class, 'trash_data'])->name('trash.categories');
    Route::get('restore/category/{id}', [CategoryController::class, 'restore_category'])->name('restore.category');
    Route::get('permanent/delete/category/{id}', [CategoryController::class, 'force_delete'])->name('permanent.delete.category');

});
Route::middleware(['auth', 'validRole:2'])->group(function () {
    Route::resource('product', ProductConroller::class);
    Route::get('/dashboard/productcrud', [DashboardConroller::class, 'productcrudpage'])->name('product.crud.page');
    Route::get('trash/products', [ProductConroller::class, 'trash_products'])->name('trash.products');
    Route::get('restore/product/{id}', [ProductConroller::class, 'restore_product'])->name('restore.product');
    Route::get('permanent/delete/product/{id}', [ProductConroller::class, 'force_delete'])->name('permanent.delete.product');

    Route::get('/orders/page', [OrderController::class, 'orderpage'])->name('orders.page');
    Route::get('/orders', [OrderController::class, 'getOrders'])->name('orders');
    Route::get('/order/items/{id}', [OrderController::class, 'getOrderItems'])->name('order.items');
    Route::get('orders/approve/{id}', [OrderController::class, 'approveOrder'])->name('orders.approve');
    Route::get('/orders/reject{id}', [OrderController::class, 'rejectOrder'])->name('orders.reject');
});
