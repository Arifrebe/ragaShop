<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $guarded = [];

     protected $casts = [
        'start_date'   => 'datetime',
        'end_date'     => 'datetime',
        'is_active'    => 'boolean',
    ];
}
