<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationCategory extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image_path',
        'status',
    ];

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }
}
