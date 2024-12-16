<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailController;

Route::get('/', function () {
    return view('index');
});

Route::get('about', function () {
    return view('about');
});

Route::get('404', function () {
    return view('404');
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
