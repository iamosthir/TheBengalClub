<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TanSamitiDraw extends Model
{
    protected $fillable = [
        'tan_samiti_id',
        'user_id',
        'cycle_number',
        'drawn_at',
        'drawn_by_admin_id',
        'note',
    ];

    protected $casts = [
        'drawn_at' => 'datetime',
    ];

    public function tanSamiti()
    {
        return $this->belongsTo(TanSamiti::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function drawnBy()
    {
        return $this->belongsTo(Admin::class, 'drawn_by_admin_id');
    }
}
