<x-app-layout>
    <div class="pt-20 pb-6 bg-gradient-to-r from-indigo-900 to-blue-900 text-white">
        <div class="max-w-5xl mx-auto px-4 md:px-6">
            <h1 class="text-3xl font-bold mb-2">Kết quả giao dịch PayPal</h1>
            <p class="text-blue-100">Thông tin chi tiết giao dịch vừa thực hiện</p>
        </div>
    </div>

    <div class="py-10 bg-gray-50">
        <div class="max-w-5xl mx-auto px-4 md:px-6">
            <div class="bg-white shadow-md rounded-xl border border-gray-100 p-6">
                <div class="flex items-center mb-6">
                    @if($code === '00')
                        <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center mr-4">
                            <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 13 4 4L19 7"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-green-600">{{ $message }}</h2>
                            <p class="text-gray-500 text-sm">Mã: {{ $code }}</p>
                        </div>
                    @elseif($code === 'CANCEL')
                        <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center mr-4">
                            <svg class="w-7 h-7 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-yellow-600">{{ $message }}</h2>
                            <p class="text-gray-500 text-sm">Mã: {{ $code }}</p>
                        </div>
                    @else
                        <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center mr-4">
                            <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v4m0 4h.01M4.93 4.93l14.14 14.14"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-red-600">{{ $message }}</h2>
                            <p class="text-gray-500 text-sm">Mã: {{ $code }}</p>
                        </div>
                    @endif
                </div>

                @if(!empty($data))
                    <div class="grid md:grid-cols-2 gap-6 mb-8">
                        <div class="space-y-3">
                            <h3 class="text-sm font-semibold text-gray-500 uppercase">Thông tin chung</h3>
                            <p class="text-gray-700 text-sm">
                                <span class="font-medium">Order ID:</span>
                                {{ $data['id'] ?? 'N/A' }}
                            </p>
                            <p class="text-gray-700 text-sm">
                                <span class="font-medium">Trạng thái:</span>
                                {{ $data['status'] ?? 'N/A' }}
                            </p>
                            @php
                                $amount = $data['purchase_units'][0]['payments']['captures'][0]['amount']['value'] ?? ($data['purchase_units'][0]['amount']['value'] ?? null);
                                $currency = $data['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'] ?? ($data['purchase_units'][0]['amount']['currency_code'] ?? null);
                            @endphp
                            <p class="text-gray-700 text-sm">
                                <span class="font-medium">Số tiền:</span>
                                {{ $amount && $currency ? $amount . ' ' . $currency : 'N/A' }}
                            </p>
                            <p class="text-gray-700 text-sm">
                                <span class="font-medium">Update:</span>
                                {{ $data['update_time'] ?? ($data['purchase_units'][0]['payments']['captures'][0]['update_time'] ?? 'N/A') }}
                            </p>
                        </div>

                        <div class="space-y-3">
                            <h3 class="text-sm font-semibold text-gray-500 uppercase">Người thanh toán</h3>
                            @php $payer = $data['payer'] ?? []; @endphp
                            <p class="text-gray-700 text-sm">
                                <span class="font-medium">Payer ID:</span>
                                {{ $payer['payer_id'] ?? 'N/A' }}
                            </p>
                            <p class="text-gray-700 text-sm">
                                <span class="font-medium">Email:</span>
                                {{ $payer['email_address'] ?? 'N/A' }}
                            </p>
                            <p class="text-gray-700 text-sm">
                                <span class="font-medium">Tên:</span>
                                {{ ($payer['name']['given_name'] ?? '') . ' ' . ($payer['name']['surname'] ?? '') ?: 'N/A' }}
                            </p>
                        </div>
                    </div>
                @endif

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('cart.index') }}" class="flex-1 inline-flex items-center justify-center px-5 py-3 rounded-full bg-gray-200 text-gray-800 hover:bg-gray-300 text-sm font-medium">
                        Quay lại giỏ hàng
                    </a>
                    <a href="{{ route('category.index') }}" class="flex-1 inline-flex items-center justify-center px-5 py-3 rounded-full bg-gradient-to-r from-indigo-600 to-blue-600 text-white hover:from-indigo-700 hover:to-blue-700 text-sm font-medium">
                        Khám phá khóa học
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>