<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable = ['product_id', 'title', 'uri', 'size', 'type'];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
