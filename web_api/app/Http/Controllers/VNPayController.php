<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Order;
use App\Models\Cart;
use App\Http\Controllers\OrderController;

class VNPayController extends Controller
{
    public const VNP_URL = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html"; // Hằng số URL
    public const VNP_RETURN_URL = "http://127.0.0.1:8000/api/payment/vnpay_return"; // Hằng số Return URL
    public const VNP_TMN_CODE = "WA7QOVYR"; // Mã website tại VNPAY
    public const VNP_HASH_SECRET = "J3ALOFIM2EPLJO9ZKOYHXGBBA29KVJL1"; // Chuỗi bí mật

    public function vnpay_payment(Request $request)
    {
        $user = auth('api')->user();
        $this->storeOrder($request, $user->id);

        $vnp_TxnRef = rand(700, 800); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $user->id;
        $vnp_OrderType = "BARBER shop";
        $vnp_Amount = $request->total_price * 100;
        $vnp_Locale = "VN";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => self::VNP_TMN_CODE,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => self::VNP_RETURN_URL,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = self::VNP_URL . "?" . $query;
        if (null!==(self::VNP_HASH_SECRET)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, self::VNP_HASH_SECRET);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
    }

    public function storeOrder( $request, $userID)
    {
        // Tạo một mảng chứa thông tin đơn hàng
        $orderData = [
            'user_id' => $userID,
            'address_ship' => $request->address_ship,
            'total_price' => $request->total_price,
            'payment_method' => $request->payment_method,
            'order_details' => $request->order_details,
        ];

        // Lưu vào cache với key là user_id và một timestamp hoặc một giá trị duy nhất
        $cacheKey = $userID ;
        Cache::put($cacheKey, $orderData, 60); // Lưu trong 60 phút
    }

    public function store($cacheKey)
    {
        $orderController = new OrderController();
        $orderData = Cache::get($cacheKey);

        if (!$orderData) {
            return response()->json(['error' => 'Order not found in cache'], 404);
        }

        $checkResult = $orderController->checkStockAvailability($orderData['order_details']);
        if ($checkResult !== true) {
            return response()->json(['error' => $checkResult], 422);
        }

        // Tạo đơn hàng thực sự trong database
        $order = Order::create([
            'user_id' => $orderData['user_id'],
            'address_ship' => $orderData['address_ship'],
            'total_price' => $orderData['total_price'],
            'payment_method' => $orderData['payment_method'],
        ]);

        // Tạo chi tiết đơn hàng
        foreach ($orderData['order_details'] as $detail) {
            $order->orderDetails()->create($detail);
        }

        $orderController->updateStockQuantities($orderData['order_details']);

        $cart = Cart::where('user_id', $orderData['user_id'])->first();
        if ($cart) {
            // Nếu giỏ hàng tồn tại, gọi hàm xóa sản phẩm
            $orderController->removeProductsFromCart($cart->id, $orderData['order_details']);
        }

        // Xóa dữ liệu khỏi cache sau khi xử lý
        Cache::forget($cacheKey);

        return response()->json($order->load('orderDetails'), 201);
    }

    public function return()
    {
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, self::VNP_HASH_SECRET);
        if ($secureHash == $vnp_SecureHash) {
            if ($_GET['vnp_ResponseCode'] == '00') {
                $this->store($_GET['vnp_OrderInfo']);
                return redirect()->to('http://127.0.0.1:8000/thank-you');
            }
            else {
                echo "GD Khong thanh cong";
                }
        } else {
            echo "Chu ky khong hop le";
            }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
