<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'address',
        'qrcode',
        'total_price',
        'subtotal_price',
        'delivery_price',
        'discount',
        'payment_status',
        'order_status',
        'created_at',
        'note',
        'user_id',
        'product_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}