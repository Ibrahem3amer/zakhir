<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CartController extends Controller
{
    public function getHome()
    {
    	$user_id = \Auth::user()->id;
    	$prods = \App\Cart::where('user_id', $user_id)->where('wishlist', 0)->where('active', 1)->get();
    	$i = sizeof($prods);
    	foreach ($prods as $prod) {
    		$prods_details[$i--] = \App\Product::where('id', $prod->product_id)->first();
    	}
    	if( sizeof($prods) && sizeof($prods_details))
    		return view('cart.home', compact('prods', 'prods_details'));
    	else
    	{
    		$prods = [];
    		$prods_details = [];
    		return view('cart.home', compact('prods', 'prods_details'));
    	}

    }

    public function getNew(Request $request)
    {
    	$prod_id = intval($request->get('prod_id'));
    	$user_id = intval($request->get('user'));
    	$quan = intval($request->get('q'));
    	$rate = intval($request->get('rate'));
        $size = $request->get('size');
        $color = $request->get('color');
    	$user_rate = \App\Rate::where('user_id', $user_id)->where('product_id', $prod_id)->first();
    	//add or update rating 
    	if(!empty($user_rate))
    	{
    		$user_rate->rating = $rate;
    		$user_rate->save();
    	}
    	else{
    		\App\Rate::create([
    				'user_id' => $user_id,
    				'product_id' => $prod_id,
    				'rating' => $rate,
    			]);
    	}


		//add cart or return false    		
    	if( \App\Cart::AddToCart($prod_id, $user_id, $quan, $size, $color) )
    		return;
    	else
    		'unexpected error in AddToCart';
    }

    public function getTowish(Request $request)
    {	
    	$id = intval($request->get('id'));
    	$prod = \App\Cart::where('product_id', $id)->first();
    	if( $prod->wishlist > 0)
    		$prod->wishlist = 0;
    	else
    		$prod->wishlist = 1;
    	$prod->save();
    	return; 

    }

    public function getWishlist()
    {
    	$user_id = \Auth::user()->id;
    	$prods = \App\Cart::where('user_id', $user_id)->where('wishlist', 1)->where('active', 1)->get();
    	if( 0 !== sizeof($prods) )
    	{
    		$i = sizeof($prods);
    		foreach ($prods as $prod) {
    			$prods_details[$i--] = \App\Product::where('id', $prod->product_id)->first();
    		}
    		return view('cart.wishlist', compact('prods', 'prods_details'));
    	}
    	else
    	{
    		$prods = 0;
    		$prods_details = 0;
    		return view('cart.wishlist', compact('prods', 'prods_details'));
    	}
    	
    }

    public function getRemove(Request $request)
    {
    	$id = intval($request->get('id'));
    	$user_id = intval($request->get('user'));
    	$prods = \App\Cart::where('product_id', $id)->where('user_id', $user_id)->get();
		if( sizeof($prods) > 1){
			foreach ($prods as $item) {
				$item->active = 0;
				$item->quantity = 0;
				$item->save();
			}
		}
		else{
			$prods[0]->active = 0;
			$prods[0]->quantity = 0;
			$prods[0]->save();
		}
    	return;
    }

    public function getEditquan(Request $request)
    {
    	$prod_id = intval($request->get('prod_id'));
    	$quan = intval($request->get('quan'));
    	$user_id = intval($request->get('user_id'));
    	$product = \App\Cart::Where('product_id', $prod_id)->where('user_id', $user_id)->where('active', 1)->where('wishlist', 0)->first();
    	$product->quantity = $quan;
    	$product->save();
    	return;
    }
}
