<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_name',
        'site_tagline',
        'logo',
        'favicon',
        'email',
        'phone',
        'phone_secondary',
        'address',
        'city',
        'state',
        'zip_code',
        'country',
        'total_members',
        'application_fee',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'linkedin_url',
        'youtube_url',
        'whatsapp_url',
        'google_maps_url',
        'footer_text',
        'copyright_text',
    ];

    protected $casts = [
        'total_members' => 'integer',
        'application_fee' => 'decimal:2',
    ];

    /**
     * Get the site settings (singleton pattern)
     */
    public static function getSettings()
    {
        return self::firstOrCreate(
            ['id' => 1],
            [
                'site_name' => 'BengalClub',
                'country' => 'Bangladesh',
                'total_members' => 0,
            ]
        );
    }
}
