<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodOrder extends Model
{
    // Tambahkan baris ini
    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'payment_method'
    ];

    // Relasi ke User (Opsional tapi disarankan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Item Pesanan
    public function items()
    {
        return $this->hasMany(FoodOrderItem::class);
    }
}