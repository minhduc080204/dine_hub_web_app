<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Order extends Model
{
    use HasFactory;
    // protected $table = 'order';
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address',
        'total_price',
        'subtotal_price',
        'delivery_price',
        'discount',
        'payment_status',
        'order_status',
        'created_at',
        'product_id',
    ];
}