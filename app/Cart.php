<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'product_id', 'quantity'
    ];

    static public function AddToCart($prod_id, $user_id, $quan)
    {
    	$existing_prod = Cart::where('product_id', $prod_id)->where('user_id', $user_id)->first();
    	if( $existing_prod )
    	{
    		$existing_prod->quantity += $quan;
    		$existing_prod->save();
    		return true;
    	}
    	else{
	    	$product = Cart::create([
	    			'user_id' => $user_id,
	    			'product_id' => $prod_id,
	    			'quantity' => $quan,
	    		]);
	    		return true;
    	}

    }

}
