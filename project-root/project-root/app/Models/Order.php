<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'order_code',
        'customer_name',
        'customer_phone',
        'province',
        'district',
        'ward',
        'address_line',
        'subtotal',
        'discount_amount',
        'shipping_fee',
        'total_amount',
        'payment_status',
        'order_status',
        'created_at',
        'updated_at',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}