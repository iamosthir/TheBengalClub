<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlideshowBanner extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'extra_text',
        'enable_action_button',
        'button_text',
        'action_link',
        'order',
        'image_path',
    ];

    protected $casts = [
        'enable_action_button' => 'boolean',
        'order' => 'integer',
    ];
}
