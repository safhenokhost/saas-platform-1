<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileFieldValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'profile_field_id',
        'value',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function field()
    {
        return $this->belongsTo(ProfileField::class, 'profile_field_id');
    }
}
