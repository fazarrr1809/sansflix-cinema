<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodOrderItem extends Model
{
    protected $fillable = [
        'food_order_id',
        'food_beverage_id',
        'quantity',
        'price'
    ];
    public function foodBeverage()
    {
        return $this->belongsTo(FoodBeverage::class);
    }
}