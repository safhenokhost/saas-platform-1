<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Profile extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'full_name',
        'postal_code',
        'address',
        'mobile',
        'lat',
        'lng',
        'avatar',
      ];

    protected $casts = [
        'extra' => 'array',   // ✅ خیلی مهم
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
