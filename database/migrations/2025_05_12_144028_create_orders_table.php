<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('vnpay_order_id')->nullable();
            $table->string('paypal_order_id')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->text('order_info')->nullable();
            $table->string('transaction_no')->nullable();
            $table->string('bank_code')->nullable();
            $table->dateTime('payment_time')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
