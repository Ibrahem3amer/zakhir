@extends('layouts.base')

@section('body')
	<div class="container">
		{!! Form::open(['url'=>'media/addmedia','method'=>'POST', 'files'=>true]) !!}
			<label for="img_name">Name</label>
			<input type="input" placeholder="your image name" name="img_name" />
			<br />
			<label for="upload">upload</label>
			<input type="file" placeholder="your image name" name="upload" />
		  	<p class="errors">{!!$errors->first('upload')!!}</p> 
			@if(Session::has('error'))
			<p class="errors">{!! Session::get('error') !!}</p>
			@endif
			<br />
			<label for="cats">Select a category</label>
		 	<select name="albums">
		 	@foreach( $albums as $album )
		  		<option value="{{$album->id}}">{{ $album->name }}</option>
	  		@endforeach
			</select> 
			<br />
			<input type="submit" value="Upload" />
		{!! Form::close() !!}
	</div>
@endsection