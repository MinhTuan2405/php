<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Order;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class OrderController extends Controller
{
    /**
     * Hiển thị danh sách tất cả các chi tiết đơn hàng
     */
    public function index(Request $request)
    {
        $query = OrderDetail::with(['order', 'course', 'user']);

        // Filter by course, user, status, payment method, date range via order relation
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        if ($request->filled('status')) {
            $status = $request->status;
            $query->whereHas('order', function ($q) use ($status) {
                $q->where('status', $status);
            });
        }

        if ($request->filled('payment_method')) {
            $pm = $request->payment_method;
            if ($pm === 'paypal') {
                $query->whereHas('order', function ($q) {
                    $q->whereNotNull('paypal_order_id');
                });
            } elseif ($pm === 'vnpay') {
                $query->whereHas('order', function ($q) {
                    $q->whereNotNull('vnpay_order_id');
                });
            }
        }

        if ($request->filled('date_from') || $request->filled('date_to')) {
            $from = $request->date_from ? date('Y-m-d 00:00:00', strtotime($request->date_from)) : null;
            $to = $request->date_to ? date('Y-m-d 23:59:59', strtotime($request->date_to)) : null;
            $query->whereHas('order', function ($q) use ($from, $to) {
                if ($from && $to) {
                    $q->whereBetween('payment_time', [$from, $to]);
                } elseif ($from) {
                    $q->where('payment_time', '>=', $from);
                } elseif ($to) {
                    $q->where('payment_time', '<=', $to);
                }
            });
        }

        $orderDetails = $query->orderByDesc('id')->get();

        // $totalPaidAmount = $orderDetails->filter(function ($detail) {
        //     return $detail->order->status == 1;
        // })->sum(function ($detail) {
        //     return $detail->order->amount ?? 0;
        // });
        $totalPaidAmount = $orderDetails->filter(function ($detail) {
            return $detail->order && $detail->order->status == 1;
        })
            ->unique(function ($detail) {
                return $detail->order_id;
            })
            ->sum(function ($detail) {
                return $detail->order->amount ?? 0;
            });

        // Export CSV if requested
        if ($request->filled('export')) {
            $fileName = 'orders_export_' . date('Ymd_His') . '.csv';
            $response = new StreamedResponse(function () use ($orderDetails) {
                $handle = fopen('php://output', 'w');
                // UTF-8 BOM for Excel compatibility
                fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));
                fputcsv($handle, ['OrderDetailID', 'Course', 'User', 'Amount', 'Payment Method', 'VNPAY ID', 'PayPal ID', 'Transaction No', 'Payment Time', 'Order Info']);

                foreach ($orderDetails as $detail) {
                    $order = $detail->order;
                    $paymentMethod = $order->payment_method ?? ($order->paypal_order_id ? 'PayPal' : ($order->vnpay_order_id ? 'VNPAY' : ($order->transaction_no ? 'PayPal' : 'N/A')));
                    fputcsv($handle, [
                        $detail->id,
                        $detail->course->name ?? '-',
                        $detail->user->name ?? '-',
                        $order->amount ?? '',
                        $paymentMethod,
                        $order->vnpay_order_id ?? '',
                        $order->paypal_order_id ?? '',
                        $order->transaction_no ?? '',
                        $order->payment_time ?? '',
                        $order->order_info ?? '',
                    ]);
                }

                fclose($handle);
            });

            $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
            $response->headers->set('Content-Disposition', 'attachment; filename="' . $fileName . '"');
            return $response;
        }

        return view('admin.orders.index', compact('orderDetails', 'totalPaidAmount'));
    }

    /**
     * Xóa đơn hàng
     */
    public function destroy(Order $order)
    {
        // delete related details first (if cascade not set)
        $order->orderDetails()->delete();
        $order->delete();

        return redirect()->route('admin.orders')->with('success', 'Đã xóa đơn hàng.');
    }
}
