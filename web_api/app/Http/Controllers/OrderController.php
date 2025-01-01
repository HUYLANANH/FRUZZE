<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Warehouse;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::paginate(6);

        foreach ($orders->items() as $order) {
            $order->username = $order->user ? $order->user->username : null;
            unset($order->user); // Loại bỏ user id nếu không cần
        }

        return response()->json($orders);
    }

    private function checkStockAvailability($orderDetails)
    {
        foreach ($orderDetails as $detail) {
            $warehouse = Warehouse::where('product_id', $detail['product_id'])->first();

            if (!$warehouse || $warehouse->quantity < $detail['quantity']) {
                return "Sản phẩm ID {$detail['product_id']} không đủ trong kho.";
            }
        }
        return true; // Nếu tất cả sản phẩm đều đủ trong kho
    }

    private function updateStockQuantities($orderDetails)
    {
        foreach ($orderDetails as $detail) {
            $warehouse = Warehouse::where('product_id', $detail['product_id'])->first();

            // Trừ số lượng trong kho
            if ($warehouse) {
                $warehouse->quantity -= $detail['quantity'];
                $warehouse->save();
            }
        }
    }

    private function removeProductsFromCart($cartId, $orderDetails)
    {
        foreach ($orderDetails as $detail) {
            // Kiểm tra xem sản phẩm có trong cart_items không
            $cartItem = CartItem::where('cart_id', $cartId)
                ->where('product_id', $detail['product_id'])
                ->first();

            // Nếu sản phẩm tồn tại trong giỏ hàng, xóa nó
            if ($cartItem) {
                $cartItem->delete();
            }
            // Nếu không tìm thấy sản phẩm, có thể log hoặc xử lý tùy ý
            else {
                // Bạn có thể log hoặc thực hiện hành động khác nếu cần
                // ví dụ: Log::info("Sản phẩm ID {$detail['product_id']} không có trong giỏ hàng với cart ID {$cartId}.");
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth('api')->user();

        $validator = Validator::make($request->all(), [
            'address_ship' => 'required|string',
            'order_details' => 'required|array',
            'order_details.*.product_id' => 'required|exists:products,id',
            'order_details.*.quantity' => 'required|integer|min:1',
            'order_details.*.price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $checkResult = $this->checkStockAvailability($request->order_details);
        if ($checkResult !== true) {
            return response()->json(['error' => $checkResult], 422);
        }

        // Tạo đơn hàng
        $order = Order::create([
            'user_id' => $user->id,
            'address_ship' => $request->address_ship,
            'total_price' => $request->total_price,
            "payment_method"=> $request->payment_method,
        ]);

        // Tạo chi tiết đơn hàng
        foreach ($request->order_details as $detail) {
            $order->orderDetails()->create($detail);
        }

        $this->updateStockQuantities($request->order_details);

        $cart = Cart::where('user_id', $user->id)->first();
        if ($cart) {
            // Nếu giỏ hàng tồn tại, gọi hàm xóa sản phẩm
            $this->removeProductsFromCart($cart->id, $request->order_details);
        }

        return response()->json($order->load('orderDetails'), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Tìm đơn hàng theo ID, kèm theo chi tiết sản phẩm
        $order = Order::with('orderDetails')->find($id);

        // Kiểm tra nếu đơn hàng không tồn tại
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Trả về thông tin đơn hàng và chi tiết sản phẩm
        return response()->json($order, 200);
    }

    public function myOrder()
    {
        $user = auth('api')->user();

        // Tìm đơn hàng theo ID, kèm theo chi tiết sản phẩm
        $order = Order::where('user_id', $user->id)->first();

        // Kiểm tra nếu đơn hàng không tồn tại
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Trả về thông tin đơn hàng và chi tiết sản phẩm
        return response()->json($order, 200);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $order->delete();
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }

    public function updateStatus(Request $request, string $id)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'status' => 'required|string', // Thay đổi điều kiện xác thực nếu cần
        ]);

        // Tìm đơn hàng theo ID
        $order = Order::findOrFail($id);

        // Cập nhật trạng thái thông qua phương thức setStatus
        try {
            $order->setStatus($request->input('status'));
            return response()->json([
                'message' => 'Trạng thái đơn hàng đã được cập nhật.',
                'order' => $order,
            ]);
        } catch (\InvalidArgumentException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
