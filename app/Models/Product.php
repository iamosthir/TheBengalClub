<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'image_path',
        'description',
        'price',
        'delivery_charge',
        'is_active',
    ];

    protected $casts = [
        'price'           => 'decimal:2',
        'delivery_charge' => 'decimal:2',
        'is_active'       => 'boolean',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
