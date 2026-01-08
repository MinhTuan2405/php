<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'vnpay_order_id',
        'paypal_order_id',
        'payment_method',
        'amount',
        'order_info',
        'transaction_no',
        'bank_code',
        'payment_time',
        'status'
    ];

    protected $casts = [
        'payment_time' => 'datetime'
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    // Ensure compatibility: expose `order_id` attribute that reads from `vnpay_order_id`.
    public function getOrderIdAttribute()
    {
        return $this->attributes['vnpay_order_id'] ?? null;
    }

    public function setOrderIdAttribute($value)
    {
        // Map writes to the existing DB column `vnpay_order_id` to avoid inserting unknown `order_id` column
        $this->attributes['vnpay_order_id'] = $value;
    }
}
