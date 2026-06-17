<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    protected $fillable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_author',
        'canonical_url',
        'og_title',
        'og_description',
        'og_image',
        'og_url',
        'og_type',
        'og_site_name',
        'fb_app_id',
        'twitter_card',
        'twitter_site',
        'twitter_creator',
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'google_analytics_id',
        'google_site_verification',
        'facebook_pixel_id',
        'custom_head_code',
        'custom_body_code',
        'index_page',
    ];

    protected $casts = [
        'index_page' => 'boolean',
    ];

    /**
     * Get the SEO settings (singleton pattern)
     */
    public static function getSettings()
    {
        return self::firstOrCreate(
            ['id' => 1],
            [
                'og_type' => 'website',
                'twitter_card' => 'summary_large_image',
                'index_page' => true,
            ]
        );
    }
}
