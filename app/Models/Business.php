<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'business_id',
        'tele_bot_token',
        'tele_chat_id'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($business) {
            $business->business_id = strval(mt_rand(100000000000, 999999999999));
        });
    }

    public function data()
    {
        return $this->hasMany(Data::class);
    }
}
