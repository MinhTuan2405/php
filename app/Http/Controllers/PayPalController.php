<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderDetail;
use App\Models\User;

class PayPalController extends Controller
{
    // 1. Initiate Payment
    public function createPayment(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $userId = Auth::id();
        session(['paypal_user_id' => $userId]);
        session(['paypal_amount_vnd' => $request->amount]);

        $currencyExchange = 26364; // VND to USD exchange rate
        $amountVnd = $request->amount;
        $amountUsd = round($amountVnd / $currencyExchange, 2);

        $data = [
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.success'),
                "cancel_url" => route('paypal.cancel')
            ],
            "purchase_units" => [
                [
                    "reference_id" => "U{$userId}_" . time(),
                    "custom_id" => (string)$userId,
                    "description" => "Payment for user:$userId",
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $amountUsd
                    ]
                ]
            ]
        ];

        $order = $provider->createOrder($data);
        $url = collect($order['links'])->where('rel', 'approve')->first()['href'];
        
        return redirect()->away($url);
    }

    // 2. Handle Success Return
    public function success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        $status = $response['status'] ?? 'FAILED';
        $isSuccess = $status === 'COMPLETED';

        // Lấy thông tin User
        $purchaseUnit = $response['purchase_units'][0] ?? [];
        $userId = session('paypal_user_id')
            ?? ($purchaseUnit['custom_id'] ?? null)
            ?? (preg_match('/user:(\d+)/', $purchaseUnit['description'] ?? '', $m) ? $m[1] : null);

        // Lấy thông tin chi tiết giao dịch (Captures)
        $captures = $purchaseUnit['payments']['captures'][0] ?? [];
        
        // 1. Lấy Transaction ID (Thay vì Order ID)
        $transactionId = $captures['id'] ?? null;
        
        // 2. Lấy thời gian thanh toán và format lại cho đúng chuẩn Database (Y-m-d H:i:s)
        $paypalTime = $captures['create_time'] ?? now();
        $paymentTime = date('Y-m-d H:i:s', strtotime($paypalTime));

        // 3. Lấy lại số tiền VND từ session để lưu vào DB cho thống nhất
        $amountVnd = session('paypal_amount_vnd') ?? 0; 

        // Xóa session sau khi dùng
        session()->forget(['paypal_user_id', 'paypal_amount_vnd']);

        if ($isSuccess && $userId) {
            // Store into existing DB column `vnpay_order_id` to remain compatible
            $order = Order::create([
                'user_id' => $userId,
                // Store PayPal id in its own column
                'paypal_order_id' => $response['id'] ?? null,
                'amount' => $amountVnd,
                'order_info' => $purchaseUnit['description'] ?? 'Thanh toán qua PayPal',
                'transaction_no' => $transactionId,
                'bank_code' => 'PayPal',
                'payment_time' => $paymentTime,
                'status' => 1
            ]);

            // Xử lý giỏ hàng và khóa học (Giữ nguyên code cũ của bạn)
            $cartItems = Cart::where('user_id', $userId)->get();
            foreach ($cartItems as $cartItem) {
                OrderDetail::create([
                    'user_id' => $userId,
                    'course_id' => $cartItem->course_id,
                    'order_id' => $order->id
                ]);
                if ($user = User::find($userId)) {
                    $user->courses()->syncWithoutDetaching([$cartItem->course_id]);
                }
                $cartItem->delete();
            }
        }

        return view('paypal.return', [
            'code' => $isSuccess ? '00' : '01',
            'message' => $isSuccess ? 'Giao dịch PayPal thành công' : 'Giao dịch PayPal thất bại',
            'data' => $response
        ]);
    }

    public function cancel()
    {
        return view('paypal.return', [
            'code' => 'CANCEL',
            'message' => 'Bạn đã hủy giao dịch PayPal',
            'data' => []
        ]);
    }
}