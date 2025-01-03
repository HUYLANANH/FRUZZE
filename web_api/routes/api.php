<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\VNPayController;
use App\Http\Controllers\WarehouseController;

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
    Route::post('register-admin', [AuthController::class, 'registerAdmin'])->middleware('admin');
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
    Route::get('all-users/{role_id}', [AdminController::class, 'getUsers'])->middleware('admin');
});

Route::group([

], function ($router) {
    // lấy danh sách danh mục sản phẩm
    Route::get('category', [CategoryController::class, 'index']);
    //lấy 1 danh mục cụ thể
    Route::get('category/{id}', [CategoryController::class, 'show']);
    //thêm mới danh mục
    Route::post('category', [CategoryController::class, 'store'])->middleware(['admin']);
    //sửa danh mục
    Route::patch('category/{id}', [CategoryController::class, 'update'])->middleware(['admin']);
    //xóa danh mục
    Route::delete('category/{id}', [CategoryController::class, 'destroy'])->middleware(['admin']);
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
    Route::post('product', [ProductController::class, 'store'])->middleware('admin');
    //sửa sản phẩm
    Route::patch('product/{id}', [ProductController::class, 'update'])->middleware('admin');
    //sửa sản phẩm
    Route::post('product/thumbnail/{id}', [ProductController::class, 'updateThumbnail'])->middleware('admin');
    //xóa sản phẩm
    Route::delete('product/{id}', [ProductController::class, 'destroy'])->middleware('admin');
});


Route::group([

], function ($router) {
    // lấy danh sách đơn hàng
    Route::get('order', [OrderController::class, 'index'])->middleware('admin');
    //lấy 1 đơn hàng cụ thể
    Route::get('order/{id}', [OrderController::class, 'show']);
    //lấy đơn hàng của bản thân
    Route::get('my-order', [OrderController::class, 'myOrder'])->middleware('check_login');
    //thêm mới đơn hàng
    Route::post('order', [OrderController::class, 'store'])->middleware('check_login');
    //xóa sản phẩm
    Route::delete('order/{id}', [OrderController::class, 'destroy'])->middleware('check_login');
    //cập nhật trạng thái
    Route::patch('order/{id}', [OrderController::class, 'updateStatus']);
});

Route::group([

], function ($router) {
    // lấy danh sách sản phẩm trong giỏ hàng
    Route::get('cart', [CartController::class, 'index'])->middleware('check_login');
    //thêm mới sản phẩm vào giỏ hàng
    Route::post('cart', [CartController::class, 'store'])->middleware('check_login');
    //sửa số lượng sản phẩm trong giỏ hàng
    Route::patch('cart', [CartController::class, 'update'])->middleware('check_login');
    //xóa sản phẩm trong giỏ hàng
    Route::delete('cart/{id}', [CartController::class, 'destroy'])->middleware('check_login');
});

Route::group([

], function ($router) {
    // lấy danh sách số lượng sản phẩm trong kho
    Route::get('warehouse', [WarehouseController::class, 'index'])->middleware('admin');
    //thêm mới sản phẩm vào kho
    Route::post('warehouse', [WarehouseController::class, 'store'])->middleware('admin');
    //sửa số lượng sản phẩm trong kho
    Route::patch('warehouse/{id}', [WarehouseController::class, 'update'])->middleware('admin');
});

Route::group([
    'prefix' => 'dashboard',
], function ($router) {
    // lấy tổng doanh thu
    Route::get('total_revenue', [DashboardController::class, 'getTotalRevenue'])->middleware('admin');
    //lấy doanh thu hôm nay
    Route::get('today-revenue', [DashboardController::class, 'getTodayRevenue'])->middleware('admin');
    //lấy phần trăm trạng thái
    Route::get('order-status-percentages', [DashboardController::class, 'getOrderStatusPercentages'])->middleware('admin');
    //lấy top 5 người dùng chi tiêu nhiều nhất
    Route::get('top-5-spending', [DashboardController::class, 'getTop5SpendingUsers'])->middleware('admin');
    //lấy top 5 người dùng chi tiêu nhiều nhất
    Route::get('top-5-selling', [DashboardController::class, 'getTop5SellingProducts']);
});

Route::group([
    'prefix' => 'payment',
], function ($router) {
    // lấy tổng doanh thu
    Route::get('vnpay', [VNPayController::class, 'vnpay_payment'])->middleware('check_login');
    //lấy doanh thu hôm nay
    Route::get('vnpay_return', [VNPayController::class, 'return']);
});
