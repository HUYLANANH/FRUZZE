<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;
use App\Models\OrderDetail;

class DashboardController extends Controller
{
    public function getTotalRevenue(Request $request)
    {
        // Lấy tháng và năm từ request, nếu không có thì mặc định là tháng và năm hiện tại
        $month = $request->query('month', date('m')); // Mặc định là tháng hiện tại
        $year = $request->query('year', date('Y')); // Mặc định là năm hiện tại

        // Kiểm tra nếu tháng không hợp lệ
        if (!preg_match('/^(0[1-9]|1[0-2])$/', $month)) {
            return response()->json([
                'error' => 'Tháng không hợp lệ. Vui lòng cung cấp tháng từ 01 đến 12.',
            ], 400);
        }

        // Kiểm tra nếu năm không hợp lệ
        if (!preg_match('/^\d{4}$/', $year)) {
            return response()->json([
                'error' => 'Năm không hợp lệ. Vui lòng cung cấp năm dưới dạng 4 chữ số.',
            ], 400);
        }

        // Lấy tổng doanh thu từ các đơn hàng có status là 'Hoàn tất' trong tháng và năm đã cho
        $totalRevenue = Order::where('status', 'Hoàn tất')
            ->whereMonth('created_at', $month) // Lọc theo tháng
            ->whereYear('created_at', $year) // Lọc theo năm
            ->sum('total_price');

        // Trả về response dưới dạng JSON
        return response()->json([
            'total_revenue' => $totalRevenue,
        ], 200);
    }

    public function getTodayRevenue()
    {
        // Lấy doanh thu từ các đơn hàng có status là 'Hoàn tất' và ngày tạo là hôm nay
        $todayRevenue = Order::where('status', 'Hoàn tất')
            ->whereDate('created_at', Carbon::today())
            ->sum('total_price');

        // Trả về response dưới dạng JSON
        return response()->json([
            'today_revenue' => $todayRevenue,
        ], 200);
    }

    public function getOrderStatusPercentages()
    {
        // Lấy tổng số đơn hàng
        $totalOrders = Order::whereMonth('created_at', Carbon::now()->month)
                            ->whereYear('created_at', Carbon::now()->year)
                            ->count();

        // Nếu không có đơn hàng nào, trả về 0% cho tất cả các trạng thái
        if ($totalOrders === 0) {
            return response()->json([
                'Chưa xác nhận' => 0,
                'Đã xác nhận' => 0,
                'Đang vận chuyển' => 0,
                'Hoàn tất' => 0,
                'Đã hủy' => 0,
            ], 200);
        }

        // Tính số lượng đơn hàng theo từng trạng thái
        $unconfirmed = Order::where('status', 'Chưa xác nhận')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        $confirmed = Order::where('status', 'Đã xác nhận')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        $shipping = Order::where('status', 'Đang vận chuyển')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        $completed = Order::where('status', 'Hoàn tất')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        $canceled = Order::where('status', 'Đã hủy')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // Tính tỷ lệ phần trăm cho từng trạng thái
        $percentages = [
            'Chưa xác nhận' => ($unconfirmed / $totalOrders) * 100,
            'Đã xác nhận' => ($confirmed / $totalOrders) * 100,
            'Đang vận chuyển' => ($shipping / $totalOrders) * 100,
            'Hoàn tất' => ($completed / $totalOrders) * 100,
            'Đã hủy' => ($canceled / $totalOrders) * 100,
        ];

        // Trả về response dưới dạng JSON
        return response()->json($percentages, 200);
    }

    public function getTop5SpendingUsers()
    {
        $topUsers = Order::select('users.full_name', 'users.phone_number')
            ->selectRaw('SUM(total_price) as total_spent')
            ->selectRaw('COUNT(*) as total_orders') // Đếm số đơn hàng
            ->join('users', 'orders.user_id', '=', 'users.id') // Join với bảng users
            ->where('orders.status', 'Hoàn tất') // Chỉ tính cho các đơn hàng đã hoàn tất
            ->groupBy('user_id', 'users.full_name','users.phone_number') // Nhóm theo user_id và tên
            ->orderBy('total_spent', 'desc')
            ->take(5)
            ->get(['users.full_name', 'users.phone_number', 'total_spent', 'total_orders']); // Chọn các trường cần thiết

        return response()->json($topUsers, 200);
    }

    public function getTop5SellingProducts()
    {
        $topProducts = OrderDetail::select('products.name', 'products.price', 'warehouses.quantity') // Chọn tên, giá và số lượng tồn kho
            ->selectRaw('SUM(order_details.quantity) as total_sold') // Tính tổng số lượng đã bán
            ->join('orders', 'order_details.order_id', '=', 'orders.id') // Join với bảng orders
            ->join('products', 'order_details.product_id', '=', 'products.id') // Join với bảng products
            ->join('warehouses', 'products.id', '=', 'warehouses.product_id') // Join với bảng warehouse
            ->where('orders.status', 'Hoàn tất') // Chỉ tính cho các đơn hàng đã hoàn tất
            ->groupBy('order_details.product_id', 'products.name', 'products.price', 'warehouses.quantity') // Nhóm theo product_id
            ->orderBy('total_sold', 'desc') // Sắp xếp theo tổng số lượng bán
            ->take(5) // Lấy 5 sản phẩm
            ->get(['products.name', 'products.price', 'total_sold', 'warehouses.quantity']); // Chọn các trường cần thiết

        return response()->json($topProducts, 200);
    }
}
