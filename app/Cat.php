<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function albums()
    {
    	return $this->belongsToMany('App\Album');
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public function parent()
    {
        return $this->belongsTo('App\Cat', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Cat', 'parent_id');
    }
}
