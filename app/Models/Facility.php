<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $fillable = [
        'name',
        'tag_line',
        'short_bio',
        'image_path',
        'features',
    ];

    protected $casts = [
        'features' => 'array',
    ];
}
