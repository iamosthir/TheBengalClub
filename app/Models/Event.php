<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'date',
        'venue',
        'description',
        'thumbnail_path',
        'gallery_images',
        'status',
        'is_free',
        'fee',
    ];

    protected $casts = [
        'date' => 'date',
        'gallery_images' => 'array',
        'status' => 'boolean',
        'is_free' => 'boolean',
        'fee' => 'decimal:2',
    ];

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }
}
