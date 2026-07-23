<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'recipient_name',
        'recipient_phone',
        'email',
        'country',
        'address',
        'address_detail',
        'payment_method',
        'shipping_method',
        'subtotal',
        'total',
        'status',
        'notes',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
