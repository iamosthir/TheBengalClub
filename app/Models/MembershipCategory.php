<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipCategory extends Model
{
    protected $fillable = [
        'title',
        'price',
        'installment_price',
        'bio',
        'badge_text',
        'duration',
        'is_invite_only',
        'optional_installment',
        'features',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'installment_price' => 'decimal:2',
        'is_invite_only' => 'boolean',
        'optional_installment' => 'boolean',
        'features' => 'array',
    ];
}
