<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $fillable = [
        'full_name',
        'phone_number',
        'birthday',
        'email',
        'password',
        'repassword',
        'otp_code',
        'otp_code_2',
        'images'
    ];
}
