<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    public function photos()
    {
    	return $this->hasMany('App\Photo');
    }

    public function cats()
    {
    	return $this->belongsToMany('App\Cat');
    }

    static public function attachCats()
    {
    	$albums = \App\Album::all();
    	foreach ($albums as $album) {
    		if( !sizeof($album->cats) )
    		{
    			$album->cats()->attach(3);
    		}
    	}
    }
}
