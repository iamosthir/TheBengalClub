<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id',
        'photo',
        'membership_application_id',
        'date_of_birth',
        'nid_passport',
        'profession_organization',
        'mobile',
        'address',
        'membership_category_id',
        'manual_member_id',
        'membership_start_at',
        'membership_end_at',
        'facebook_url',
        'instagram_url',
        'linkedin_url',
        'twitter_url',
        'youtube_url',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'membership_start_at' => 'datetime',
        'membership_end_at' => 'datetime',
    ];

    /**
     * Get the user that owns the profile
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the membership application
     */
    public function membershipApplication()
    {
        return $this->belongsTo(MembershipApplication::class);
    }

    /**
     * Get the membership category
     */
    public function membershipCategory()
    {
        return $this->belongsTo(MembershipCategory::class);
    }

    public function installments()
    {
        return $this->hasMany(MembershipInstallment::class)->orderBy('installment_number');
    }
}
