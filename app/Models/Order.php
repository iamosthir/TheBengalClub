<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'email',
        'phone',
        'billing_address',
        'shipping_address',
        'payment_method_id',
        'transaction_id',
        'payment_proof_path',
        'subtotal',
        'delivery_charge',
        'total_amount',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'subtotal'        => 'decimal:2',
        'delivery_charge' => 'decimal:2',
        'total_amount'    => 'decimal:2',
    ];

    const STATUSES = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function statusBadgeClass(): string
    {
        return match ($this->status) {
            'pending'    => 'badge-warning',
            'processing' => 'badge-info',
            'shipped'    => 'badge-primary',
            'delivered'  => 'badge-success',
            'cancelled'  => 'badge-danger',
            default      => 'badge-secondary',
        };
    }
}
