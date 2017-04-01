<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class OrdersController extends Controller
{
    public function getHome()
    {
    	$user_id = 1;
    	$products_in_cart = \App\Cart::where('user_id', $user_id)->where('wishlist', 0)->where('active', 1)->get();
    	$products = array();
    	foreach ($products_in_cart->lists('product_id') as $product_id) {
    		array_push($products, \App\Product::find($product_id));
    	}

    	return view('order.neworder', compact('products_in_cart', 'products'));
    }

    public function getBilling(Request $request)
    {
    	$user_id = intval($request->get('user_id'));
    	$total = intval($request->get('total'));
    	$cart = \App\Cart::where('user_id', $user_id)->where('active', 1)->get();
    	$order = \App\Order::create([
    			'user_id' => $user_id,
    			'status' => 'waiting',
    			'total' => $total,
    		]);
    		foreach ($cart as $product) {
    			\DB::table('order_product')->insert([
	    			'order_id' => $order->id,
	    			'user_id' => $user_id,
	    			'product_id' => $product->product_id,
	    			]);
    			//$product->active = 0;
    			$product->save();
    		}

    	return redirect('users/address')->with('order', $order);

    }

	public function getTrack()
	{
		$orders = \App\Order::where('user_id', 1)->get();
		$orders_id = $orders->lists('id');
		$piviot = array();
		$products = array('-90'=>'-90');
		$i = 0;
		foreach ($orders_id as $order_id) {
			/*array_push($piviot, \DB::table('order_product')->where('user_id', 1)->where('order_id', $order_id)->lists('product_id'));
			array_push($products, \App\Product::find($piviot));*/
			$temp = \DB::table('order_product')->where('user_id', 1)->where('order_id', $order_id)->lists('product_id');
			//generate auto indexes for each group of products
			$products[] = \App\Product::find($temp);
			
		}
		//return $products;
		return view('order.track', compact('orders', 'products'));
	}

}

