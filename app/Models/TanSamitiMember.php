<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TanSamitiMember extends Model
{
    protected $fillable = [
        'tan_samiti_id',
        'user_id',
        'status',
        'joined_at',
    ];

    protected $casts = [
        'joined_at' => 'datetime',
    ];

    public function tanSamiti()
    {
        return $this->belongsTo(TanSamiti::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
