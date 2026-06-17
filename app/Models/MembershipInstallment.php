<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipInstallment extends Model
{
    protected $fillable = [
        'user_id',
        'user_profile_id',
        'installment_number',
        'due_date',
        'amount',
        'status',
        'payment_method',
        'note',
        'paid_at',
        'completed_by_admin_id',
        'member_payment_method_id',
        'member_txn_id',
        'member_proof_path',
        'member_submitted_at',
    ];

    protected $casts = [
        'due_date' => 'date',
        'paid_at' => 'datetime',
        'member_submitted_at' => 'datetime',
        'amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class);
    }

    public function completedByAdmin()
    {
        return $this->belongsTo(Admin::class, 'completed_by_admin_id');
    }

    public function transactions()
    {
        return $this->hasMany(MembershipTransaction::class);
    }

    public function memberPaymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'member_payment_method_id');
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isOverdue(): bool
    {
        return $this->status === 'pending' && $this->due_date->isPast();
    }

    public function isPaymentSubmitted(): bool
    {
        return $this->status === 'pending' && $this->member_submitted_at !== null;
    }

    public function scopePaymentSubmitted($query)
    {
        return $query->whereNotNull('member_submitted_at')->where('status', 'pending');
    }
}
