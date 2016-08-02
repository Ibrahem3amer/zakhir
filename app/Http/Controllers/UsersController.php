<?php

namespace App\Http\Controllers;

use App\Http\Requests\userSignUpRequest;
use App\Http\Requests\LogInRequest;
use App\Http\Requests;
use App\SocialAccountService;
use Socialite;

class UsersController extends Controller
{
    public function getSignup()
    {
    	return view('users.signup');
    }

    public function postSignup(userSignUpRequest $request) 
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

    public function getSignin()
    {
        return view('users.signin');
    }

    public function postSignin(LogInRequest $request)
    {
        // Using attempt is conditioned by hashed your passwords in database and extending your password's field size
        /*if( \Auth::attempt(['email' => $request->usrmail, 'password' => $request->usrpass]) )
            return "success";
        else
            return "no";*/
        $user = \App\User::where('email', $request->usrmail)->first();
        if( $user )
        {
            $getPassword = $user->GetPassword( $user->id );
            if( $getPassword === $request->usrpass )
            {
                \Auth::login($user);
                return redirect('/');
            }
        }
        else
            return "failed";

    }

    public function getRedirect($provider)
    {
        return \Socialite::driver($provider)->redirect();
    }

    public function getCallback( SocialAccountService $service, $provider )
    {
        $user = $service->createOrGetUser(Socialite::driver($provider));
        auth()->login($user);
        return redirect()->to('/');
    }
}
