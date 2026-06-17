<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = [
        'invite_id',
        'email',
        'membership_category_id',
        'application_fee',
        'is_used',
    ];

    protected $casts = [
        'application_fee' => 'decimal:2',
        'is_used' => 'boolean',
    ];

    public function membershipCategory()
    {
        return $this->belongsTo(MembershipCategory::class);
    }
}
