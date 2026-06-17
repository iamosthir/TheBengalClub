<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PaymentLink extends Model
{
    protected $fillable = [
        'token',
        'name',
        'phone',
        'email',
        'amount',
        'purpose',
        'status',
        'payment_method_id',
        'transaction_id',
        'payment_proof_path',
        'submitted_at',
        'verified_at',
        'ip_address',
        'created_by_admin_id',
        'verified_by_admin_id',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'submitted_at' => 'datetime',
        'verified_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (PaymentLink $link) {
            if (empty($link->token)) {
                $link->token = self::generateUniqueToken();
            }
        });
    }

    public static function generateUniqueToken(): string
    {
        do {
            $token = Str::lower(Str::random(24));
        } while (self::where('token', $token)->exists());

        return $token;
    }

    public function getUrlAttribute(): string
    {
        return route('payment-link.show', $this->token);
    }

    public function getRouteKeyName(): string
    {
        return 'token';
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function createdByAdmin()
    {
        return $this->belongsTo(Admin::class, 'created_by_admin_id');
    }

    public function verifiedByAdmin()
    {
        return $this->belongsTo(Admin::class, 'verified_by_admin_id');
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isSubmitted()
    {
        return $this->status === 'submitted';
    }

    public function isVerified()
    {
        return $this->status === 'verified';
    }

    public function isCanceled()
    {
        return $this->status === 'canceled';
    }

    /** Whether a payer can still submit a payment against this link. */
    public function isPayable(): bool
    {
        return in_array($this->status, ['pending', 'submitted'], true);
    }
}
