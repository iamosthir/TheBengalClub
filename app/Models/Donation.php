<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'donation_category_id',
        'full_name',
        'email',
        'amount',
        'payment_method_id',
        'transaction_id',
        'payment_proof_path',
        'status',
        'note',
        'ip_address',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function donationCategory()
    {
        return $this->belongsTo(DonationCategory::class);
    }

    public function isPending()  { return $this->status === 'pending'; }
    public function isVerified() { return $this->status === 'verified'; }
    public function isCanceled() { return $this->status === 'canceled'; }
}
