<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // Giả sử bạn có model Order
use Illuminate\Support\Facades\Auth; // Sử dụng Auth để xác định khách hàng đã đăng nhập

class OrderTrackingController extends Controller
{
    public function trackOrders()
    {
        // Lấy danh sách đơn hàng của khách hàng đã đăng nhập
        $orders = Order::where('user_id', Auth::id())->get();

        return view('order-list', ['orders' => $orders]);
    }
}
