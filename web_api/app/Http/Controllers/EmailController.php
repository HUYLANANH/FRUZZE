<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use App\Models\User;

class EmailController extends Controller
{
    public function sendOtp(Request $request)
    {
        if (!User::where('email', $request->email)->exists()) {
            return response()->json(['error' => 'Email không tồn tại'], 404);
        }

        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        Cache::put($request->email, $otp, 2*60);

        try {
            Mail::to($request->email)->send(new SendOtpMail($otp));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Không thể gửi email, vui lòng thử lại sau.'], 500);
        }
        
        return response()->json(['message' => 'OTP sent successfully!', 'otp' => $otp], 200);
    }
    
    public function verifyOtp(Request $request)
{
    // Kiểm tra xem email và OTP đã được truyền vào chưa
    if (!$request->has('email') || !$request->has('otp')) {
        return response()->json(['error' => 'Thiếu email hoặc OTP'], 400);
    }

    // Lấy OTP từ cache
    $otpData = Cache::get($request->email);

    if ($otpData && $otpData == $request->otp) {
        Cache::forget($request->email);

        // Tạo reset token
        $resetToken = Str::random(60);
        Cache::put('password-reset-' . $request->email, $resetToken, 5 * 60); // Reset token có thời gian sống 5 phút

        return response()->json([
            'message' => 'OTP hợp lệ.',
            'reset_token' => $resetToken,
        ]);
    }

    return response()->json(['message' => 'OTP không chính xác hoặc đã hết hạn.'], 400);
}

}
