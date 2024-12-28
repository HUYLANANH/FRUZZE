<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('index');
});

Route::get('about', function () {
    return view('about');
});

Route::get('contact', function () {
    return view('contact');
});

Route::get('term', function () {
    return view('term');
});

Route::get('shop', function () {
    return view('shop');
});

Route::get('detail-shop', function () {
    return view('detail-shop');
});

Route::get('/detail-shop/{id}', [ProductController::class, 'show']);


Route::get('blog', function () {
    return view('blog');
});

Route::get('detail-blog', function () {
    return view('detail-blog');
});

Route::get('404', function () {
    return view('404');
});

Route::get('wishlist', function () {
    return view('wishlist');
});

Route::get('cart', function () {
    return view('cart');
});

Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::get('register', function () {
    return view('auth.register');
})->name('register');

Route::get('forgot-password', function () {
    return view('auth.forgot-password'); // Giao diện quên mật khẩu
})->name('forgot-password');

Route::get('change-password', function () {
    return view('auth.change-password'); // Giao diện quên mật khẩu
})->name('change-password');

Route::get('profile', function () {
    return view('profile.profile');
})->name('profile');

Route::prefix('product')->group(function () {
    // Lấy danh sách sản phẩm
    Route::get('get', function () {
        return view('admin.product.show');
    })->name('get');

    // Tạo sản phẩm mới
    Route::get('add', function () {
        return view('admin.product.create');
    })->name('add');

    // Cập nhật sản phẩm
    Route::get('update', function () {
        return view('admin.product.update');
    })->name('update');
    // Xóa sản phẩm
   // Route::delete('/{id}', [ProductController::class, 'destroy'])->name('api.products.destroy');
});
Route::prefix('admin')->group(function () {
Route::get('getusers', function () {
    return view('admin.getusers');
})->name('getusers');
});