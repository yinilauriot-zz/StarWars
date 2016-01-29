<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = [
        'command_id',
        'product_id',
        'customer_id',
        'price',
        'quantity',
        'command_at',
        'status'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

}
