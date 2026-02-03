<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileField extends Model
{
    protected $fillable = [
        'id',
        'key',
        'label',
        'type',
        'required',
        'enabled',
    ];

    protected $casts = [
        'required' => 'boolean',
        'enabled'  => 'boolean',
    ];
}


