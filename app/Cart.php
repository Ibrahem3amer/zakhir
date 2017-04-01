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
        'user_id', 'product_id', 'quantity', 'size', 'color'
    ];

    static public function AddToCart($prod_id, $user_id, $quan, $size, $color)
    {
        $existing_prod = Cart::where('product_id', $prod_id)->where('user_id', $user_id)->where('active', 1)->where('wishlist', 0)->first();
        
        if( $existing_prod )
        {   
            if($existing_prod->color == $color && $existing_prod->size == $size)
            {
                $existing_prod->quantity += $quan;
                $existing_prod->save();
                return true;
            }
        }
        $product = Cart::create([
                'user_id' => $user_id,
                'product_id' => $prod_id,
                'quantity' => $quan,
                'size' => $size,
                'color' => $color
            ]);
            return true;

    }

}
