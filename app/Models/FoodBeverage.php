<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodBeverage extends Model
{
    protected $fillable = [
    'name', 
    'category', 
    'price', 
    'description', 
    'image_url', 
    'is_active'
];
}
