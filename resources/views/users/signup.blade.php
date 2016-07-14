@extends('layouts.base')

@section('body')
  <div class="container">
      <ol class="breadcrumb">
        <li><a href="index.html">Home</a></li>
        <li class="active">Account</li>
       </ol>
     <div class="registration">
       <div class="registration_left">
         <!-- [if IE] 
          < link rel='stylesheet' type='text/css' href='ie.css'/>  
         [endif] -->  
          
         <!-- [if lt IE 7]>  
          < link rel='stylesheet' type='text/css' href='ie6.css'/>  
         <! [endif] -->  
         <script>
          (function() {
        
          // Create input element for testing
          var inputs = document.createElement('input');
          
          // Create the supports object
          var supports = {};
          
          supports.autofocus   = 'autofocus' in inputs;
          supports.required    = 'required' in inputs;
          supports.placeholder = 'placeholder' in inputs;
        
          // Fallback for autofocus attribute
          if(!supports.autofocus) {
            
          }
          
          // Fallback for required attribute
          if(!supports.required) {
            
          }
        
          // Fallback for placeholder attribute
          if(!supports.placeholder) {
            
          }
          
          // Change text inside send button on submit
          var send = document.getElementById('register-submit');
          if(send) {
            send.onclick = function () {
              this.innerHTML = '...Sending';
            }
          }
        
         })();
         </script>
        @if( !\Auth::user() )
          <h1>Hello {{ \Auth::user()->name }} </h1>        
        @else
          <h2>new user? <span> create an account </span></h2>
          <div class="registration_form">
            <!-- Form -->
            @if( $errors->any() )
            <ul class="alert alert-danger">
              @foreach( $errors->all() as $error )
                <li>{{ $error }}</li>
              @endforeach
            </ul>
            @endif
            {!! Form::open(['url' => 'users/signup']) !!}
            <div>
              <label>
                <input name="fname" placeholder="first name" type="text" tabindex="1">
              </label>
            </div>
            <div>
              <label>
                <input name="lname" placeholder="last name" type="text" tabindex="2">
              </label>
            </div>
            <div>
              <label>
                <input name="email" placeholder="email address" type="email" tabindex="3">
              </label>
            </div>             
            <div>
              <label>
                <input name="password" placeholder="password" type="password" tabindex="4">
              </label>
            </div>            
            <div>
              <label>
                <input name="repassword" placeholder="retype password" type="password" tabindex="4">
              </label>
            </div>  
            <div>
              <input type="submit" value="create an account" id="register-submit">
            </div>
            <div class="sky-form">
              <label class="checkbox"><input type="checkbox" name="checkbox" ><i></i>i agree Terms & conditions &nbsp;<a class="terms" href="#"> terms of service</a> </label>
            </div>
            {!! Form::close()!!}
            <!-- /Form -->
          </div>
          </div>
          <div class="registration_left">
           <h2>existing user</h2>
           <div class="registration_form">
           <!-- Form -->
            {!! Form::open() !! }
              <div>
                <label>
                  <input placeholder="email" type="email" tabindex="3" required>
                </label>
              </div>
              <div>
                <label>
                  <input placeholder="password" type="password" tabindex="4" required>
                </label>
              </div>            
              <div>
                <input type="submit" value="sign in">
              </div>
              <div class="forget">
                <a href="#">forgot your password</a>
              </div>
            {!! Form::close() !!}
           <!-- /Form -->
           </div>
          </div>
          <div class="clearfix"></div>
        @endif
     </div>
  </div>
@endsection