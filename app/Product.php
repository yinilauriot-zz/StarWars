<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $dates = ['published_at'];

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'score',
        'abstract',
        'content',
        'price',
        'quantity',
        'status',
        'published_at'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function picture()
    {
        return $this->hasOne('App\Picture');
    }

    public function histories()
    {
        return $this->hasMany('App\History');
    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function getPublishedAtAttribute($value)
    {
        if($value=='0000-00-00 00:00:00') return 'no date';

        return Carbon::parse($value)->format('d/m/Y h:i:s');
    }

    public function scopeOnline($query)
    {
        return $query->where('status', '=', 'opened');
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = (empty($value)) ? str_slug($this->name) : str_slug($value);
    }

    public function setCategoryIdAttribute($value)
    {
        $this->attributes['category_id'] = ($value == 0) ? null : $value;
    }

    public function setPublishedAtAttribute($value)
    {
        $this->attributes['published_at'] = (empty($value)) ? '0000-00-00 00:00:00' : Carbon::now();
    }

    public function hasTag($tagId)
    {
        foreach($this->tags as $tag)
        {
            if ($tag->id == $tagId) return true;
        }

        return false;
    }
}