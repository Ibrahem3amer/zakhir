<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CartController extends Controller
{
    public function getHome()
    {
    	$prods = \App\Cart::where('user_id', 1)->where('wishlist', 0)->get();
    	$i = sizeof($prods);
    	foreach ($prods as $prod) {
    		$prods_details[$i--] = \App\Product::where('id', $prod->product_id)->first();
    	}
    	return view('cart.home', compact('prods', 'prods_details'));
    }

    public function getNew(Request $request)
    {
    	$prod_id = intval($request->get('prod_id'));
    	$user_id = intval($request->get('user'));
    	$quan = intval($request->get('q'));

    	if( \App\Cart::AddToCart($prod_id, $user_id, $quan) )
    		return;
    	else
    		return false;
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
    	$prods = \App\Cart::where('user_id', 1)->where('wishlist', 1)->get();
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
    	if( sizeof($id) > 1)
    	{
    		foreach ($id as $item) {
    			\App\Cart::where('product_id', $item)->where('user_id', $user_id)->delete();
			}
    	}
    	else{
    		\App\Cart::where('product_id', $id)->where('user_id', $user_id)->delete();
    	}
    	return;
    }
}
