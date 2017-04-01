<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\AddProductRequest;

class ProductsController extends Controller
{
    public function getAddproduct()
    {
    	$cats = \App\Cat::all();
    	$albums = \App\Album::all();
    	$photos = \App\Photo::all();
    	return view('product.add', compact('cats', 'albums', 'photos'));
    }

    public function postAddproduct(AddProductRequest $request)
    {
    	$url = max($request->picker, $request->uploader);
    	$product = \App\Product::create([
    			'name' => $request->pr_name,
    			'price' => $request->pr_price,
    			'cat_id' => $request->albums,
    			'photo_url' => $url,
    		]);
    	$cats = \App\Cat::all();
    	$brands = \App\Brand::all();
    	return view('product.all', compact('cats', 'brands'));
    }

    public function getAll()
    {
    	$cats = \App\Cat::all();
    	$brands = \App\Brand::all();
    	return view('product.all', compact('cats', 'brands'));
    }

    public function getCat($cat_id)
    {
    	$cats = \App\Cat::all();
    	$brands = \App\Brand::all();
    	$products = \App\Product::where('cat_id', $cat_id)->get();
    	return view('product.all', compact('cats', 'brands', 'products'));
    }


    public function getProds(Request $request)
    {
    	$q = intval( $request->get('q') );
    	$prods = \App\Product::where('cat_id', $q)->get();
    	if( $prods )
			return $prods;
		else
			return 'null';
    }

    public function getRating(Request $request)
    {
    	$product_id = intval($request->get('prod_id'));
    	$user_id = intval($request->get('user_id'));
    	$expression = \App\Rate::where('user_id', $user_id)->where('product_id', $product_id)->first();
    	if(sizeof($expression))
    		return $expression->rating;
    	else{
    		$rate = \App\Rate::where('product_id', $product_id)->lists('rating');
    		return $rate->sum()/$rate->count();
    	}

    }

    public function getFilter(Request $request)
    {
    	//splitting price 
    	/*$price = (string)$request->price;
    	$price = explode(',', $price);*/
        $price = array();
        $price[0] = $request->min;
        $price[1] = $request->max;

    	//filtering query
    	$size = sizeof($request->brand);
    	$products = array();
    	$products_flatten = array();
    	if( $size > 1 )
    	{
	    	foreach ($request->brand as $brand) {
	    		if(sizeof($price)>1)
	    		{	
	    			if($request->cat_id){
    					array_push($products, \App\Product::where('cat_id', $request->cat_id)->whereBetween('price', [$price[0], $price[1]])->where('brand', $brand)->get());	
	    			}
	    			else{
	    				array_push($products, \App\Product::whereBetween('price', [$price[0], $price[1]])->where('brand', $brand)->get());
	    			}
		    		
	    		}
	    		else
	    		{
	    			if($request->cat_id){
    					array_push($products, \App\Product::whereBetween('price', [$price[0], $price[1]])->where('brand', $brand)->get());	
	    			}
	    			else{
	    				array_push($products, \App\Product::where('brand', $brand)->get());
	    			}
	    		}

	    	}
	    	foreach ($products as $brand ) {
	    		foreach ($brand as $product) {
	    			array_push($products_flatten, $product);
	    		}
	    	}
    	}
    	else if( $size == 1 )
    	{
    		$products_flatten = \App\Product::where('cat_id', $request->cat_id)->where('brand', $request->brand)->get();
    	}
    	else{
    		$products_flatten = \App\Product::where('cat_id', $request->cat_id)->where('brand', $request->brand)->get();
    	}
    	$products = $products_flatten;

    	$cats = \App\Cat::all();
    	$brands = \App\Brand::all();
		return view('product.all', compact('cats', 'brands', 'products'));
    }
}
