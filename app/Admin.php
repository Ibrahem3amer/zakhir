<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    static public function is_admin($email, $password)
    {
    	if( \Auth::attempt(['email' => $email, 'password' => $password]) )
    	{
    		$user = \Auth::user();
    		$admin = \App\Admin::where('user_id', $user->id)->first();
    		if( !empty($admin) )
    		{
    			\Auth::login($user);
    			return true;
    		}
    	}
    	else
    		return false;
    }
}
