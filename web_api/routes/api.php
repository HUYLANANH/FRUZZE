<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ProductController;


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
    'middleware' => ['check_login']
], function ($router) {
    // lấy danh sách danh mục sản phẩm
    Route::get('category', [CategoryController::class, 'index']);
    //lấy 1 danh mục cụ thể
    Route::get('category/{id}', [CategoryController::class, 'show']);
    //thêm mới danh mục
    Route::post('category', [CategoryController::class, 'store'])->middleware('admin');
    //sửa danh mục
    Route::patch('category/{id}', [CategoryController::class, 'update'])->middleware('admin');
    //xóa danh mục
    Route::delete('category/{id}', [CategoryController::class, 'destroy'])->middleware('admin');
});

Route::group([
    'middleware' => ['check_login']
], function ($router) {
    // lấy danh sách danh mục sản phẩm
    Route::get('product', [ProductController::class, 'index']);
    //lấy 1 danh mục cụ thể
    Route::get('product/{id}', [ProductController::class, 'show']);
    //thêm mới danh mục
    Route::post('product', [ProductController::class, 'store'])->middleware('admin');
    //sửa danh mục
    Route::patch('product/{id}', [ProductController::class, 'update'])->middleware('admin');
    //xóa danh mục
    Route::delete('product/{id}', [ProductController::class, 'destroy'])->middleware('admin');
});

