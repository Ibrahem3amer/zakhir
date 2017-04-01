@extends('layouts.base')

@section('body')
	<div class="login_sec inner-content">
		<div class="container">
			@if (Session::has('loginErr'))
				<div class="alert alert-danger">{{Session::get('loginErr')}}</div>
			@endif
			 <h2>تسجيل الدخول</h2>
			 <div class="log">			 
				 <p>مرحباً بك في زاخر، رجاءاً قم بكتابة البريد الإلكتروني والرقم السري لتتمكن من الإستمتاع بكافة مميزات زاخر</p>
				 {!! Form::open(['url' => '/users/signin']) !!}
					<h5>البريد الإلكتروني</h5>	
					<input name="usrmail" type="email" class="input form-control" value="">
					<h5>الرقم السري</h5>
					<input name="usrpass" type="password" value="" class="form-control">	
					<br />						
					<input type="submit" value="دخول" class="btn btn-success form-control login-btn">	
					<br />
					<a class="acount-btn btn btn-default form-control login-btn" href="/users/signup">تسجيل عضوية جديدة</a>
					<br />
					<br />
				 	<a class="acount-btn btn btn-primary form-control" href="redirect/facebook" style="text-decoration: none;">دخول بحساب فيس بوك</a>
				 	<a class="acount-btn btn btn btn-info form-control" href="redirect/twitter" style="text-decoration: none;"><TABLE></TABLE>دخول بحساب تويتر </a>
				 	<a class="acount-btn btn btn-danger form-control" href="redirect/google" style="text-decoration: none;"><TABLE></TABLE>دخول بحساب جوجل بلس</a>
				{!! Form::close() !!}
				<a href="#">Forgot Password ?</a>
			 </div>	
			 <div class="clearfix"></div>
		</div>
	</div>
@endsection