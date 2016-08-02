<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class NavBarController extends Controller
{
    public function getTeam()
    {
    	return view('pages.team');
    }
}
