<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoardDirector extends Model
{
    protected $fillable = [
        'name',
        'designation',
        'social_links',
        'phone',
        'email',
        'photo_path',
        'order',
        'status',
    ];

    protected $casts = [
        'social_links' => 'array',
        'status' => 'boolean',
        'order' => 'integer',
    ];
}
