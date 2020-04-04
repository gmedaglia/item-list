<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Item extends Model
{
	public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['image', 'description'];

    protected $hidden = ['image', 'order'];

    protected $appends = ['image_url'];


    public function getImageUrlAttribute()
    {
    	return asset('storage/images/' . $this->attributes['image']);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
