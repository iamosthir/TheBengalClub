<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipTransaction extends Model
{
    protected $fillable = [
        'user_id',
        'membership_installment_id',
        'amount',
        'payment_type',
        'trx_id',
        'admin_id',
        'completed_by',
        'status',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function installment()
    {
        return $this->belongsTo(MembershipInstallment::class, 'membership_installment_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function isAdminPayment(): bool
    {
        return $this->completed_by === 'admin';
    }

    public function isUserPayment(): bool
    {
        return $this->completed_by === 'user';
    }
}
