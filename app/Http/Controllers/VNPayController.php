<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;

class VNPayController extends Controller
{
    public function createPayment(Request $request)
    {
        $vnp_TxnRef = rand(1, 10000);
        $user_id = auth()->id(); // Get user ID during payment creation

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => config('vnpay.tmn_code'),
            "vnp_Amount" => $request->amount * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $request->ip(),
            "vnp_Locale" => $request->language,
            "vnp_OrderInfo" => "Thanh toan GD:" . $vnp_TxnRef . "|user:" . $user_id, // Include user ID in order info
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => config('vnpay.return_url'),
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => date('YmdHis', strtotime('+15 minutes'))
        );

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

        $vnp_Url = config('vnpay.url') . "?" . $query;
        $vnpSecureHash = hash_hmac('sha512', $hashdata, config('vnpay.hash_secret'));
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;

        return redirect($vnp_Url);
    }

    public function return(Request $request)
    {
        $inputData = array();
        foreach ($request->all() as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $hashData = "";
        $i = 0;

        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, config('vnpay.hash_secret'));

        if ($secureHash == $vnp_SecureHash) {
            if ($inputData['vnp_ResponseCode'] == '00') {
                // Determine user id: prefer authenticated user, otherwise try to extract from vnp_OrderInfo
                $userId = auth()->id();
                if (!$userId && isset($inputData['vnp_OrderInfo'])) {
                    $matches = [];
                    if (preg_match('/user:(\d+)/', $inputData['vnp_OrderInfo'], $matches)) {
                        $userId = $matches[1];
                    }
                }

                // Create order (use extracted user id if available)
                $order = Order::create([
                    'user_id' => $userId,
                        'vnpay_order_id' => $inputData['vnp_TxnRef'],
                    'amount' => $inputData['vnp_Amount'] / 100,
                    'order_info' => $inputData['vnp_OrderInfo'],
                    'transaction_no' => $inputData['vnp_TransactionNo'],
                    'bank_code' => $inputData['vnp_BankCode'],
                    'payment_time' => $inputData['vnp_PayDate'],
                    'status' => 1 // Success
                ]);

                // Move items from cart to order details and enroll user in courses
                $cartItems = [];
                if ($userId) {
                    $cartItems = Cart::where('user_id', $userId)->get();
                }

                foreach ($cartItems as $cartItem) {
                    OrderDetail::create([
                        'user_id' => $userId,
                        'course_id' => $cartItem->course_id,
                        'order_id' => $order->id
                    ]);

                    // Enroll user in course using pivot table if user exists
                    if ($userId) {
                        $user = User::find($userId);
                        if ($user) {
                            $user->courses()->attach($cartItem->course_id);
                        }
                    }

                    // Remove from cart
                    $cartItem->delete();
                }

                return view('vnpay.return', [
                    'code' => '00',
                    'message' => 'Giao dịch thành công',
                    'data' => $inputData
                ]);
            } else {
                return view('vnpay.return', [
                    'code' => $inputData['vnp_ResponseCode'],
                    'message' => 'Giao dịch không thành công',
                    'data' => $inputData
                ]);
            }
        } else {
            return view('vnpay.return', [
                'code' => '97',
                'message' => 'Chữ ký không hợp lệ',
                'data' => $inputData
            ]);
        }
    }

    // public function ipn(Request $request)
    // {
    //     $inputData = array();
    //     foreach ($request->all() as $key => $value) {
    //         if (substr($key, 0, 4) == "vnp_") {
    //             $inputData[$key] = $value;
    //         }
    //     }

    //     $vnp_SecureHash = $inputData['vnp_SecureHash'];
    //     unset($inputData['vnp_SecureHash']);
    //     ksort($inputData);
    //     $hashData = "";
    //     $i = 0;

    //     foreach ($inputData as $key => $value) {
    //         if ($i == 1) {
    //             $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
    //         } else {
    //             $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
    //             $i = 1;
    //         }
    //     }

    //     $secureHash = hash_hmac('sha512', $hashData, config('vnpay.hash_secret'));

    //     try {
    //         if ($secureHash == $vnp_SecureHash) {
    //             // Extract user ID from order info
    //             $orderInfo = $inputData['vnp_OrderInfo'];
    //             preg_match('/user:(\d+)/', $orderInfo, $matches);
    //             $user_id = $matches[1] ?? null;

    //             if ($user_id) {
    //                 $vnp_Amount = $inputData['vnp_Amount'] / 100;
    //                 $vnp_TxnRef = $inputData['vnp_TxnRef'];

    //                 // Create order and order details
    //                 $order = Order::create([
    //                     'user_id' => $user_id, // Use extracted user ID
        //                     'vnpay_order_id' => $vnp_TxnRef,
    //                     'amount' => $vnp_Amount,
    //                     'order_info' => $inputData['vnp_OrderInfo'],
    //                     'transaction_no' => $inputData['vnp_TransactionNo'],
    //                     'bank_code' => $inputData['vnp_BankCode'],
    //                     'payment_time' => \Carbon\Carbon::createFromFormat('YmdHis', $inputData['vnp_PayDate'])->toDateTimeString(),
    //                     'status' => ($inputData['vnp_ResponseCode'] == '00') ? 1 : 2
    //                 ]);

    //                 // Move items from cart to order details
    //                 $cart = Cart::where('user_id', $user_id)->get();
    //                 foreach ($cart as $cartItem) {
    //                     OrderDetail::create([
    //                         'user_id' => $user_id,
    //                         'course_id' => $cartItem->course_id,
    //                         'order_id' => $order->id
    //                     ]);
    //                     $cartItem->delete();
    //                 }

    //                 return response()->json([
    //                     'RspCode' => '00',
    //                     'Message' => 'Confirm Success'
    //                 ]);
    //             }
    //         }

    //         return response()->json([
    //             'RspCode' => '97',
    //             'Message' => 'Invalid signature'
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'RspCode' => '99',
    //             'Message' => 'Unknown error'
    //         ]);
    //     }
    // }
}
