<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TanSamitiInstallment extends Model
{
    protected $fillable = [
        'tan_samiti_id',
        'user_id',
        'cycle_number',
        'due_date',
        'amount',
        'status',
        'member_payment_method_id',
        'member_txn_id',
        'member_proof_path',
        'member_submitted_at',
        'rejected_at',
        'rejected_by_admin_id',
        'rejection_reason',
        'completed_by_admin_id',
        'paid_at',
        'note',
    ];

    protected $casts = [
        'amount'              => 'decimal:2',
        'due_date'            => 'date',
        'member_submitted_at' => 'datetime',
        'rejected_at'         => 'datetime',
        'paid_at'             => 'datetime',
    ];

    public function tanSamiti()
    {
        return $this->belongsTo(TanSamiti::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function memberPaymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'member_payment_method_id');
    }

    public function completedByAdmin()
    {
        return $this->belongsTo(Admin::class, 'completed_by_admin_id');
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
        return $this->status === 'pending' && $this->due_date < now()->startOfDay();
    }

    public function isPaymentSubmitted(): bool
    {
        return $this->member_submitted_at !== null;
    }

    public function scopePaymentSubmitted($query)
    {
        return $query->where('status', 'pending')->whereNotNull('member_submitted_at');
    }
}
