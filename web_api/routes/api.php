<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\GaleryController;
use App\Http\Controllers\OrderController;

Route::group([
    'prefix' => 'auth'
], function ($router) {
    //đăng nhập
    Route::post('login', [AuthController::class, 'login']);
    //đăng xuất
    Route::post('logout', [AuthController::class, 'logout'])->middleware('check_login');
    //lấy thông tin người dùng
    Route::get('profile', [AuthController::class, 'profile'])->middleware('check_login');
    //Sửa thông tin người dùng
    Route::patch('update-profile',[AuthController::class,'updateProfile'])->middleware('check_login');
    //đăng kí người dùng (user)
    Route::post('register', [AuthController::class, 'registerUser']);
    //đăng kí admin
    Route::post('register-admin', [AuthController::class, 'registerAdmin'])->middleware('check_login');
    //đổi mật khẩu
    Route::patch('change-password', [AuthController::class, 'changePassword'])->middleware('check_login');
});


Route::group([
    'prefix' => 'forgot-password'
], function ($router) {
    // API gửi OTP
    Route::post('send-otp', [EmailController::class, 'sendOtp']);
    //API xác nhận OTOP
    Route::post('verify-otp', [EmailController::class, 'verifyOtp']);
    //API đổi mk
    Route::patch('reset-password', [AuthController::class, 'resetPassword']);
});

Route::group([
    'prefix' => 'admin',
], function ($router) {
    // lấy danh sách theo role
    Route::get('all-users/{role_id}', [AdminController::class, 'getUsers']);
});

Route::group([

], function ($router) {
    // lấy danh sách danh mục sản phẩm
    Route::get('category', [CategoryController::class, 'index']);
    //lấy 1 danh mục cụ thể
    Route::get('category/{id}', [CategoryController::class, 'show']);
    //thêm mới danh mục
    Route::post('category', [CategoryController::class, 'store'])->middleware(['admin', 'check_login']);
    //sửa danh mục
    Route::patch('category/{id}', [CategoryController::class, 'update'])->middleware(['admin', 'check_login']);
    //xóa danh mục
    Route::delete('category/{id}', [CategoryController::class, 'destroy'])->middleware(['admin', 'check_login']);
});

Route::group([

], function ($router) {
    // lấy danh sách sản phẩm
    Route::get('product', [ProductController::class, 'index']);
    // lấy full danh sách sản phẩm
    Route::get('all-product', [ProductController::class, 'showAll']);
    //lấy 1 sản phẩm cụ thể
    Route::get('product/{id}', [ProductController::class, 'show']);
    //thêm mới sản phẩm
    Route::post('product', [ProductController::class, 'store'])->middleware(['admin']);
    //sửa sản phẩm
    Route::patch('product/{id}', [ProductController::class, 'update'])->middleware(['admin']);
    //sửa sản phẩm
    Route::post('product/thumbnail/{id}', [ProductController::class, 'updateThumbnail'])->middleware(['admin']);
    //xóa sản phẩm
    Route::delete('product/{id}', [ProductController::class, 'destroy'])->middleware(['admin', 'check_login']);
});


Route::group([

], function ($router) {
    // lấy danh sách đơn hàng
    Route::get('order', [OrderController::class, 'index'])->middleware(['admin', 'check_login']);
    //lấy 1 đơn hàng cụ thể
    Route::get('order/{id}', [OrderController::class, 'show'])->middleware(['admin', 'check_login']);
    //lấy đơn hàng của bản thân
    Route::get('my-order', [OrderController::class, 'myOrder'])->middleware(['check_login']);
    //thêm mới đơn hàng
    Route::post('order', [OrderController::class, 'store'])->middleware(['admin', 'check_login']);
    //xóa sản phẩm
    Route::delete('order/{id}', [OrderController::class, 'destroy'])->middleware(['admin', 'check_login']);
});

Route::group([

], function ($router) {
    // lấy danh sách đơn hàng
    Route::get('cart', [CartController::class, 'index'])->middleware(['check_login']);
    //thêm mới đơn hàng
    Route::post('cart', [CartController::class, 'store'])->middleware(['check_login']);
    //sửa sản phẩm
    Route::patch('cart', [CartController::class, 'update'])->middleware(['check_login']);
    //xóa sản phẩm
    Route::delete('cart/{id}', [CartController::class, 'destroy'])->middleware(['check_login']);
});
