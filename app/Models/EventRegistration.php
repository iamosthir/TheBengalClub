<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    protected $fillable = [
        'event_id',
        'user_id',
        'is_member',
        'full_name',
        'email',
        'phone',
        'address',
        'payment_method_id',
        'transaction_id',
        'payment_proof_path',
        'status',
        'note',
    ];

    protected $casts = [
        'is_member' => 'boolean',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function isPending()   { return $this->status === 'pending'; }
    public function isApproved()  { return $this->status === 'approved'; }
    public function isCancelled() { return $this->status === 'cancelled'; }
}
