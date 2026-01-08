@extends('layouts.admin')

@section('title', 'Quản lý đơn hàng')

@section('content')
<div class="mb-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Danh sách đơn hàng</h1>
            <p class="text-gray-600">Quản lý và theo dõi tất cả đơn hàng trong hệ thống</p>
        </div>
        <!-- Top layout buttons hidden on this page; use the filter/export inside the orders form below -->
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
    <div class="p-6">
        <form method="GET" action="{{ route('admin.orders') }}" class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 space-y-3 md:space-y-0">
            <div class="flex items-center space-x-4">
                <div>
                    <input type="date" name="date_from" value="{{ request('date_from') }}" class="px-3 py-2 border rounded" placeholder="Từ ngày">
                    <input type="date" name="date_to" value="{{ request('date_to') }}" class="px-3 py-2 border rounded ml-2" placeholder="Đến ngày">
                </div>

                <div class="relative">
                    <select name="payment_method" class="block w-full border border-gray-300 rounded-lg appearance-none px-3 py-2 pr-12 bg-white">
                        <option value="">Phương thức</option>
                        <option value="vnpay" {{ request('payment_method') == 'vnpay' ? 'selected' : '' }}>VNPAY</option>
                        <option value="paypal" {{ request('payment_method') == 'paypal' ? 'selected' : '' }}>PayPal</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>

                <div>
                    <input type="text" name="user_id" value="{{ request('user_id') }}" class="px-3 py-2 border rounded" placeholder="User ID">
                </div>

                <div>
                    <button type="submit" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg">Lọc</button>
                    <button type="submit" name="export" value="1" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg ml-2">Xuất Excel</button>
                </div>
            </div>

            <div class="mt-4 md:mt-0 flex items-center">
                <div class="bg-green-50 text-green-700 px-4 py-2 rounded-lg flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-medium">Tổng tiền đã thanh toán:</span>
                    <span class="ml-2 font-bold">{{ number_format($totalPaidAmount ?? 0, 0, ',', '.') }} VND</span>
                </div>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tên khóa học</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mã đơn hàng</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Người dùng</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số tiền</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phương thức thanh toán</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thời gian</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($orderDetails as $index => $detail)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-indigo-100 rounded-md flex items-center justify-center text-indigo-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $detail->course->name ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-indigo-600">#{{ $detail->order_id }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">{{ $detail->user->name ?? 'Không rõ' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ number_format($detail->course->price ?? 0, 0, ',', '.') }} VND
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($detail->order->status == 1)
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Đã thanh toán
                            </span>
                            @else
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Chưa thanh toán
                            </span>
                            @endif
                        </td>
                        @php
                        $pm = $detail->order->payment_method ?? ($detail->order->paypal_order_id ? 'PayPal' : ($detail->order->vnpay_order_id ? 'VNPAY' : ($detail->order->transaction_no ? 'PayPal' : 'N/A')));
                        @endphp
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pm }}</td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $detail->order->payment_time ? $detail->order->payment_time->format('d/m/Y H:i') : 'Chưa thanh toán' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-2">
                                <a href="#" class="view-order text-indigo-600 hover:text-indigo-900" data-order='@json($detail->order)'>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>

                                <form action="{{ route('admin.orders.destroy', $detail->order->id) }}" method="POST" onsubmit="return confirm('Xác nhận xóa đơn hàng #{{ $detail->order->id }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Order detail modal (hidden by default) -->
        <div id="order-detail-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl mx-4">
                <div class="p-4 border-b flex items-center justify-between">
                    <h3 class="text-lg font-medium">Chi tiết đơn hàng</h3>
                    <button id="close-order-modal" class="text-gray-500 hover:text-gray-700">Đóng</button>
                </div>
                <div id="order-detail-content" class="p-6 text-sm text-gray-700">
                    <!-- Filled by JS -->
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex items-center justify-between border-t border-gray-200 pt-4">
            <div class="flex items-center text-sm text-gray-500">
                <span>Hiển thị 1-{{ count($orderDetails) }} của {{ count($orderDetails) }} kết quả</span>
            </div>
            <div class="flex space-x-2">
                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                    Trước
                </button>
                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                    Tiếp
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-indigo-100 text-indigo-600 mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Tổng doanh thu</p>
                <p class="text-2xl font-bold text-gray-900">{{ number_format($totalPaidAmount, 0, ',', '.') }} VND</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Đơn hàng đã thanh toán</p>
                <p class="text-2xl font-bold text-gray-900">{{ $orderDetails->where('order.status', 1)->count() }}</p>
            </div>
        </div>
    </div>

    <!-- Removed unpaid orders card per request -->
</div>
        <script>
            (function(){
                function prettyDate(d){
                    if(!d) return 'N/A';
                    try{ return new Date(d).toLocaleString(); }catch(e){ return d; }
                }

                document.querySelectorAll('.view-order').forEach(function(btn){
                    btn.addEventListener('click', function(e){
                        e.preventDefault();
                        var raw = btn.getAttribute('data-order');
                        if(!raw) return;
                        try{
                            var order = JSON.parse(raw);
                        }catch(err){
                            console.error('Invalid order JSON', err);
                            return;
                        }

                        var content = document.getElementById('order-detail-content');
                        var html = '<div class="space-y-2">';
                        html += '<p><strong>ID:</strong> ' + (order.id ?? '') + '</p>';
                        html += '<p><strong>Người dùng:</strong> ' + (order.user_id ?? '') + '</p>';
                        html += '<p><strong>Số tiền:</strong> ' + (order.amount ?? '') + '</p>';
                        html += '<p><strong>Phương thức thanh toán:</strong> ' + (order.payment_method ?? (order.paypal_order_id ? 'PayPal' : (order.vnpay_order_id ? 'VNPAY' : (order.transaction_no ? 'PayPal' : 'N/A')))) + '</p>';
                        html += '<p><strong>Mã VNPAY:</strong> ' + (order.vnpay_order_id ?? '-') + '</p>';
                        html += '<p><strong>Mã PayPal:</strong> ' + (order.paypal_order_id ?? '-') + '</p>';
                        html += '<p><strong>Mã giao dịch:</strong> ' + (order.transaction_no ?? '-') + '</p>';
                        html += '<p><strong>Bank code:</strong> ' + (order.bank_code ?? '-') + '</p>';
                        html += '<p><strong>Trạng thái:</strong> ' + (order.status ?? '-') + '</p>';
                        html += '<p><strong>Thời gian thanh toán:</strong> ' + prettyDate(order.payment_time ?? order.created_at) + '</p>';
                        html += '<p><strong>Ghi chú:</strong> ' + (order.order_info ?? '-') + '</p>';
                        html += '</div>';
                        content.innerHTML = html;
                        document.getElementById('order-detail-modal').classList.remove('hidden');
                    });
                });

                var closeBtn = document.getElementById('close-order-modal');
                if(closeBtn){
                    closeBtn.addEventListener('click', function(){
                        document.getElementById('order-detail-modal').classList.add('hidden');
                    });
                }

                // close when clicking outside modal box
                document.getElementById('order-detail-modal')?.addEventListener('click', function(e){
                    if(e.target === this) this.classList.add('hidden');
                });
            })();
        </script>

        @endsection
