<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'reason',
        'payment_date',
        'payment_method_id',
        'membership_application_id',
        'recorded_by_admin_id',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function membershipApplication()
    {
        return $this->belongsTo(MembershipApplication::class);
    }

    public function recordedByAdmin()
    {
        return $this->belongsTo(Admin::class, 'recorded_by_admin_id');
    }
}
