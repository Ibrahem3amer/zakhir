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


    public function getProds(Request $request)
    {
    	$q = intval( $request->get('q') );
    	$prods = \App\Product::where('cat_id', $q)->get();
    	if( $prods )
			return $prods;
		else
			return 'null';
    }
}
