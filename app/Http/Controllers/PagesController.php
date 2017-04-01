<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function grabPage($id)
    {
    	//$id = intval($request->get('id'));
    	$page = \DB::table('pages')->where('id', $id)->first();
    	return view('pages.template', compact('page'));	
    }
}
