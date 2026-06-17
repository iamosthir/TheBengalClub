<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'name',
        'logo_path',
        'instruction',
        'wallet_number',
        'qr_image_path',
        'status',
        'label',
    ];
}
