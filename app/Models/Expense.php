<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'donation_category_id',
        'description',
        'amount',
        'attachment_path',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function donationCategory()
    {
        return $this->belongsTo(DonationCategory::class);
    }
}
