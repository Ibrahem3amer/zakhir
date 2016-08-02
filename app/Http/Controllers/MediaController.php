<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Input;
use Validator;
use Redirect;
use Session;


class MediaController extends Controller
{
    public function getMediahome()
    {
    	$cats = \App\Cat::all();
    	/*foreach ($cats as $cat ) {
    		return $cat->albums->toArray();
    	}
    	die();*/
    	return view('media.home', compact('cats'));
    }

    public function getAlbum($id = 0)
    {
        if( !$id )
            return view('media.home');
        else{
            $photos = \App\Photo::where('album_id', $id)->get();
            if( $photos ){
                $cats = \App\Cat::all();
                return view('media.album', compact('photos', 'cats')); //add extra loop on photos
            }
            else
                return view('media.home');   
        }
    }

    public function getAddmedia()
    {
    	$albums = \App\Album::get();
    	return view('media.add', compact('albums'));
    }

    public function postAddmedia(Request $request)
    {
    	$file = [
    		'img' => $request->file('upload'),
    	];

    	$rules = [
    		'img' => 'required',
    	];

    	$validation = Validator::make($file, $rules);	//check rules and apply it to file

    	if($validation->fails())
    		return redirect('media/mediahome')->withInput()->withErrors($validation);
    	else{
    		if($request->file('upload')->isValid())
    		{
    			$cpanelPath = 'img';
    			$imgSource = $request->file('upload')->getClientOriginalExtension();
    			$imgNewName = rand(11111, 99999).'.'.$imgSource;

    			$request->file('upload')->move($cpanelPath, $imgNewName);
    			Session::flash('success', 'upload successed'); 
                $request->flash();
    			$imgPath = '/'.$cpanelPath.'/'.$imgNewName;
    			$photo = \App\Photo::create([
    					'title' => $request->img_name,
    					'album_id' => $request->albums,
    					'photo_url' => $imgPath
    				]);
    			return redirect()->back()->withInput()->with('photo', $photo);
    		}
    		else{
    			Session::flash('error', 'uploaded file is not valid');
    			return redirect('/');
    		}
    	}
    }

    public function getAlbums(Request $request)
    {
    	$q = intval( $request->get('q') );
    	$photos = \App\Photo::where('album_id', $q)->get();
    	if( $photos )
    		return $photos;
    	else 
    		return "null";
    }

}
