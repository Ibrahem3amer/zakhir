<?php

namespace App\Http\Controllers;

use App\Http\Requests\userSignUpRequest;
use App\Http\Requests;

class UsersController extends Controller
{
    public function getSignup()
    {
    	return view('users.signup');
    }

    public function postSignup( userSignUpRequest $request ) 
    {
    	//User input data using facade
    	$input = $request::all();

    	$user = \App\User::create([
    			'name' => $input['fname'].' '.$input['lname'],
    			'email' => $input['email'],
    			'password' => $input['password'],
    		]);

    	if( $user->save() )
    	{
    		\Auth::login( $user );
    		 return \Redirect::route('home');
    	}
    	else
    		return \Redirect::back()->withErrors( $user->errors() );


    }
}
