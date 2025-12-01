<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
    ];

    // Optional: Products in cart relationship
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // Optional: Products in orders
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
