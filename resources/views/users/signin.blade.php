@extends('layouts.base')

@section('body')
	<div class="login_sec">
	 <div class="container">
		 <ol class="breadcrumb">
		  <li><a href="/">Home</a></li>
		  <li class="active">Login</li>
		 </ol>
		 <h2>Login</h2>
		 <div class="col-md-6 log">			 
				 <p>Welcome, please enter the folling to continue.</p>
				 <p>If you have previously Login with us, <span>click here</span></p>
				 {!! Form::open(['url' => '/users/signin']) !!}
					 <h5>E-mail</h5>	
					 <input name="usrmail" type="email" class="input" value="">
					 <h5>Password</h5>
					 <input name="usrpass" type="password" value="">					
					 <input type="submit" value="Login">	
						<a class="acount-btn" href="/users/signup">Create an Account</a>
						<br />
					 	<a class="acount-btn" href="redirect/facebook" style="text-decoration: none;">Facebook login</a>
					 	<a class="acount-btn" href="redirect/twitter" style="text-decoration: none;"><TABLE></TABLE>Twitter login</a>
					 	<a class="acount-btn" href="redirect/google" style="text-decoration: none;"><TABLE></TABLE>GooglePlus login</a>
				 {!! Form::close() !!}
				 <a href="#">Forgot Password ?</a>
					
		 </div>	
				
		 <div class="clearfix"></div>
	 </div>
	</div>
@endsection