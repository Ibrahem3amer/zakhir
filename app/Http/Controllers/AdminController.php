<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\carbon;
use App\Http\Requests;

class AdminController extends Controller
{
    public function login()
    {
    	return view('admin.login');
    }

    public function plogin(Request $request)
    {
    	if( \App\Admin::is_admin($request->admin_mail, $request->admin_password) )
    		return redirect('/admin/dashboard');
    	else
    		return view('errors.503');
    }

    public function getDashboard()
    {
    	return view('admin.dashboard');
    }

    public function getAllcats()
    {
    	$cats = \App\Cat::all();
    	return view('admin.cats', compact('cats'));
    }

    public function getEditcat(Request $request)
    {
    	$id = intval($request->get('id'));
    	$cat = \App\Cat::where('id', $id)->first();
    	$cats = \App\Cat::all();
    	return view('admin.editcat', compact('cat', 'cats'));
    }

    public function getAddcat(Request $request)
    {
    	$cats = \App\Cat::all();
    	return view('admin.addcat', compact('cats'));
    }

    public function postEditcat(Request $request)
    {
    	$cat = \App\Cat::find($request->cat_id);
    	if( empty($cat) )
    	{
    		\App\Cat::create([
    			'name' => $request->cat_name,
    			'parent_id' => $request->parent_id,
    		]);
    		return redirect()->back()->with(['error'=>'']);
    	}
    	else{
    		$cat->name = $request->cat_name;
    		$cat->parent_id = $request->parent_id;
    	}
    	if($cat->save())
    		return redirect()->back()->with(['error'=>'']);
		else
			return redirect()->back()->with(['error'=>'Something went wrong']);
    }

    public function getDeletecat(Request $request)
    {
    	$id = intval($request->get('id'));
    	$cat = \App\Cat::find($id);
    	$cat->delete();
    	return redirect()->back();
    }

    public function getAllprods()
    {
    	$prods = \App\Product::all();
    	$brands = \App\Brand::all();
    	return view('admin.prods', compact('prods', 'brand'));
    }

    public function getEditprod(Request $request)
    {
    	$id = intval($request->get('id'));
    	$prod = \App\Product::find($id);
    	$cats = \App\Cat::all();
    	$albums = \App\Album::all();
    	$brands = \App\Brand::all();
    	return view('admin.editprod', compact('prod', 'cats', 'albums', 'brands'));
    }

    public function getAddprod(Request $request)
    {
    	$cats = \App\Cat::all();
    	$albums = \App\Album::all();
    	$brands = \App\Brand::all();
    	return view('admin.addprod', compact('cats', 'brands', 'albums'));
    }

    public function postEditprod(Request $request)
    {
    	$photos = json_encode(explode(',', $request->photos_values));
    	$prod = \App\Product::find($request->prod_id);
    	if( empty($prod) )  //new product  
    	{
    		$prod = new \App\Product;
            $json_string = "";
            $colors = explode(',', $request->colors);
            for($i=1; $i <=5 ; $i++) { 
                $name = 'size_'.$i.'_name';
                $value = 'size_'.$i.'_value';
                if(!empty($request->$name) && !empty($request->$value))
                    $json_string = $json_string.'"'.$request->$name.'"'.':'.'"'.$request->$value.'",';
            }
            $json_string = rtrim($json_string, ",");
            $prod->size = "{".$json_string."}";
            $prod->color = json_encode($colors);
    	}
        else{
            $colors = explode(',', $request->colors);
            $prod->color = json_encode($colors);
            $sizes = json_decode($prod->size, true);
            foreach ($sizes as $size=>$value) {
                $sizes[$size] = $request[$size];
            }
            $prod->size = json_encode($sizes);
        }

    	$prod->name = $request->prod_name;
    	$prod->price = $request->prod_price;
    	$prod->photo_url = $request->prod_photo;
    	$prod->photos = $photos;
    	$prod->description = $request->prod_description;
    	$prod->cat_id = $request->cat_id;
    	$prod->brand = $request->brand_id;
    	$prod->has_sale = $request->prod_sale;


    	if($prod->save())
    		return redirect()->back()->with(['error'=>'']);
		else
			return redirect()->back()->with(['error'=>'Something went wrong']);
    }

    public function getDeleteprod(Request $request)
    {
    	$id = intval($request->get('id'));
    	$prod = \App\Product::find($id);
    	$prod->delete();
    	return redirect()->back();
    }

    public function getAllalbums()
    {
    	$albums = \App\Album::all();
    	return view('admin.albums', compact('albums'));
    }

    public function getEditalbum(Request $request)
    {
    	$id = intval($request->get('id'));
    	$album = \App\Album::find($id);
    	$album_in_cat = \DB::table('album_cat')->where('album_id', $album->id)->lists('cat_id');
    	$album_in_cat = array_unique($album_in_cat);
    	$cats = \App\Cat::all();
    	return view('admin.editalbum', compact('album', 'cats', 'album_in_cat'));
    }

    public function getAddalbum(Request $request)
    {

    	$cats = \App\Cat::all();
    	return view('admin.addalbum', compact('cats'));
    }

    public function postEditalbum(Request $request)
    {
    	$checked_cats = explode(',', $request->checked);
    	$album = \App\Album::find($request->album_id);
    	if( empty($album) )
    	{
    		$album = new \App\Album;
    	}
		$album->name = $request->album_name;
		$album->save();
		\DB::table('album_cat')->where('album_id', $album->id)->delete();
		if( sizeof($checked_cats) > 1)
		{
			foreach ($checked_cats as $cat) {
				\DB::table('album_cat')->insert([
					'cat_id' => $cat,
					'album_id' => $album->id
				]);
			}
		}
		else{
			\DB::table('album_cat')->insert([
					'cat_id' => $checked_cats[0],
					'album_id' => $album->id
			]);
		}

    	if($album->save())
    		return redirect()->back()->with(['error'=>'']);
		else
			return redirect()->back()->with(['error'=>'Something went wrong']);
    }

    public function getDeletealbum(Request $request)
    {
    	$id = intval($request->get('id'));
    	$album = \App\Album::find($id);
    	$album->delete();
    	return redirect()->back();
    }

    public function getAllpages()
    {
    	$pages = \DB::table('pages')->get();
    	return view('admin.pages', compact('pages'));
    }

    public function getEditpage(Request $request)
    {
    	$id = intval($request->get('id'));
    	$page = \DB::table('pages')->where('id', $id)->first();
    	return view('admin.editpage', compact('page'));
    }

    public function getAddpage(Request $request)
    {

    	return view('admin.addpage');
    }

    public function postEditpage(Request $request)
    {
    	$page = \DB::table('pages')->where('id', $request->page_id)->first();
    	if( empty($page) )
    	{
    		$page = \DB::table('pages')->insert([
    				'page_title' => $request->page_title,
    				'content' => $request->page_content
    			]);
    	}
    	else{
			$page = \DB::table('pages')->update([
    				'page_title' => $request->page_title,
    				'content' => $request->page_content
    			]);
    	}	
    	
    	if($page)
    		return redirect()->back()->with(['error'=>'']);
		else
			return redirect()->back()->with(['error'=>'Something went wrong']);
    }

    public function getDeletepage(Request $request)
    {
    	$id = intval($request->get('id'));
     	$page = \DB::table('pages')->where('id', $id)->delete();
    	return redirect()->back();
    }

    public function getAllusers()
    {
    	$users = \App\User::all();
    	return view('admin.users', compact('users'));
    }

    public function getEdituser(Request $request)
    {
    	$id = intval($request->get('id'));
    	$user = \App\User::find($id);
    	return view('admin.edituser', compact('user'));
    }

    public function getAdduser(Request $request)
    {

    	return view('admin.adduser');
    }

    public function postEdituser(Request $request)
    {
    	$id = intval($request->get('id'));
    	$user = \App\User::find($request->user_id);
    	if( empty($user) )
    	{
    		$user = \App\User::create([
    				'name' => $request->user_name, 
    				'email' => $request->user_mail,
    				'password' => \Hash::make($request->user_password),  
    				'address' => $request->user_address
    			]);
    	}
    	else{
    		$password = !empty($request->user_password)?\Hash::make($request->user_password):$user->password;
			$user->name = $request->user_name;
			$user->password = $password;
			$user->address = $request->user_address;
    	}	
    	
    	if($user->save())
    		return redirect()->back()->with(['error'=>'']);
		else
			return redirect()->back()->with(['error'=>'Something went wrong']);
    }

    public function getDeleteuser(Request $request)
    {
    	$id = intval($request->get('id'));
     	$user = \App\User::find($id)->delete();
    	return redirect()->back();
    }

    public function getOrders()
    {
    	$orders = \App\Order::all();
    	$users_ids = array_unique((array)$orders->lists('user_id'));
    	$users = array();
    	foreach ($users_ids as $user) {
    		array_push($users, \App\User::find($user)->first());
    	}
    	return view('admin.orders', compact('orders', 'users'));
    }

    public function postOrders(Request $request)
    {
    	$status = $request->order_status;
    	$orders = \App\Order::where('status', $status)->get();
    	$users_ids = array_unique((array)$orders->lists('user_id'));
    	$users = array();
    	foreach ($users_ids as $user) {
    		array_push($users, \App\User::find($user)->first());
    	}
    	return view('admin.orders', compact('orders', 'users'));

    }

	public function getListorder(Request $request)
    {
    	$id = intval($request->get('id'));
    	$user_id = intval($request->get('user'));
    	$order = \App\Order::find($id);
    	$orders = \DB::table('order_product')->where('order_id', $id)->lists('product_id');
    	$quantities = array();
    	$products_ids = array_unique((array)$orders);
    	foreach ($products_ids as $product_id) {
    		array_push($quantities, \App\Cart::where('product_id', $product_id)->where('user_id', $user_id)->first());
    	}
    	$products = \App\Product::find($products_ids);
    	$products = $products->toArray();
    	$products_with_quantities = array();
    	for ($i=0, $len = sizeof($products_ids); $i < $len; $i++) { 
    		array_push($products[$i], $quantities[$i]->quantity);
    		array_push($products_with_quantities, $products[$i]);
    	}
    	return view('admin.listorder', compact('products_with_quantities', 'order'));
    }

    public function getEditorder(Request $request)
    {
    	$id = intval($request->get('id'));
    	$order = \App\Order::find($id);
    	return view('admin.editorder', compact('order'));
    }

    public function postEditorder(Request $request)
    {
    	$order = \App\Order::find($request->order_id);
		$order->status = $request->order_status;
    	
    	if($order->save())
    		return redirect()->back()->with(['error'=>'']);
		else
			return redirect()->back()->with(['error'=>'Something went wrong']);
    }

    public function getStats()
    {
    	$orders_total = \App\Order::all()->count();
    	$products_total = \App\Product::all()->count();
    	$total_benefits = \App\Order::where('status', 'accepted')->orWhere('status', 'being prepared')->orWhere('status', 'done')->lists('total');
    	$total_benefits_total = $total_benefits->sum();
    	$this_month_total = \App\Order::where('created_at', '>=', Carbon::now()->startOfMonth())->where('status', 'accepted')->orWhere('status', 'being prepared')->orWhere('status', 'done')->lists('total')->sum();
    	$total_benefits_number = $total_benefits->count();
    	$orders_this_month = \App\Order::where('created_at', '>=', Carbon::now()->startOfMonth())->count();
    	$orders_last_month = \App\Order::where('created_at', '<', Carbon::now()->startOfMonth())->count();
    	$failed_orders = \App\Order::where('status', 'canceled')->count();
    	return view('admin.stats', compact('orders_total', 'products_total', 'total_benefits_total', 'total_benefits_number', 'orders_this_month', 'orders_last_month', 'failed_orders', 'this_month_total'));
    }

    public function getUi()
    {	
    	$nav = (array)\DB::table('ui')->where('role', 'nav')->get();
    	$pages = \DB::table('pages')->get();
    	return view('admin.ui', compact('pages', 'nav'));
    }

    public function postUi(Request $request)
    {	
    	$elements = array(	$request->element3, 
				    		$request->element4, 
				    		$request->element5, 
				    		$request->element6, 
				    		$request->element7
		    		);
    	$i = 1;
    	foreach ($elements as $page_id) {
    		$page = \DB::table('pages')->where('id', $page_id)->first();
    		$ui_element = \DB::table('ui')->where('role', 'nav')->where('id', $i++)->update([
    				'placeholder' => $page->page_title,
    				'link' => '/page/'.$page->id
    			]);
    	}
    	return redirect()->back();
    }
}
