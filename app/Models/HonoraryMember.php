<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HonoraryMember extends Model
{
    protected $fillable = [
        'name',
        'designation',
        'bio',
        'photo_path',
        'order',
        'is_active',
    ];

    protected $casts = [
        'designation' => 'array',
        'is_active'   => 'boolean',
        'order'       => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
