<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'price', 'cat_id', 'photo_url', 'status', 'has_sale'
    ];

    public function cat()
    {
    	return $this->belongsTo('App\Cat');
    }

    public function orders()
    {
        return $this->belongsTo('App\Order');
    }


}
