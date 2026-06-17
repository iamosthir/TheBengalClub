<?php

namespace App\Models;

use App\Support\RichText;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'date' => 'datetime',
        'gallery_images' => 'array',
        'status' => 'boolean',
        'is_free' => 'boolean',
        'fee' => 'decimal:2',
    ];

    /**
     * Strip pasted inline colors from the description on save so it stays
     * readable on the dark theme. Runs on both create and update.
     */
    protected function description(): Attribute
    {
        return Attribute::make(
            set: fn (?string $value) => RichText::stripColorStyles($value),
        );
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }
}
