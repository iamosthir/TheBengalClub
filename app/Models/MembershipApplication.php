<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipApplication extends Model
{
    protected $fillable = [
        'name',
        'photo',
        'date_of_birth',
        'nid_passport',
        'profession_organization',
        'mobile',
        'email',
        'address',
        'reference',
        'membership_category_id',
        'nid_photo',
        'payment_method_id',
        'transaction_id',
        'payment_proof_path',
        'payment_verified_at',
        'payment_verified_by_admin_id',
        'is_tos_accepted',
        'status',
        'ip_address',
        'invite_id',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'payment_verified_at' => 'datetime',
        'is_tos_accepted' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the membership category for this application
     */
    public function membershipCategory()
    {
        return $this->belongsTo(MembershipCategory::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function paymentVerifiedByAdmin()
    {
        return $this->belongsTo(Admin::class, 'payment_verified_by_admin_id');
    }

    public function isPaymentVerified(): bool
    {
        return $this->payment_verified_at !== null;
    }

    /**
     * Get the user profile created from this application
     */
    public function userProfile()
    {
        return $this->hasOne(UserProfile::class);
    }

    /**
     * Scope to get pending applications
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope to get accepted applications
     */
    public function scopeAccepted($query)
    {
        return $query->where('status', 'accepted');
    }

    /**
     * Scope to get rejected applications
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Check if a person can apply (no existing pending or accepted applications)
     */
    public static function canApply(string $email, string $mobile): bool
    {
        $existing = self::where(function ($query) use ($email, $mobile) {
            $query->where('email', $email)
                  ->orWhere('mobile', $mobile);
        })
        ->whereIn('status', ['pending', 'accepted'])
        ->first();

        return is_null($existing);
    }

    /**
     * Get existing application for email or mobile
     */
    public static function getExistingApplication(string $email, string $mobile)
    {
        return self::where(function ($query) use ($email, $mobile) {
            $query->where('email', $email)
                  ->orWhere('mobile', $mobile);
        })
        ->whereIn('status', ['pending', 'accepted'])
        ->first();
    }
}
