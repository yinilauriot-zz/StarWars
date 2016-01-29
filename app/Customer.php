<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'user_id',
        'address',
        'number_card',
        'number_command',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function histories()
    {
        return $this->hasMany('App\History');
    }
}
