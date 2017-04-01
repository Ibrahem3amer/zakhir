@extends('layouts.base')

@section('body')
	<div class="container">
		@for( $i=0, $len=sizeof($orders); $i<$len; $i++)
			<h1>Order #{{$i+1}} <small>{{$orders[$i]->created_at}}</small></h1>
			<div class="progress">
			  <div class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 10%;">
			    10%
			  </div>
			</div>
			<hr />
			<ul>
			@foreach( $products as $key => $value )
				@if( $key == $i )
					@foreach( $value as $prod)
						<li>{{$prod->name}}</li>
					@endforeach
				@endif
			@endforeach
			</ul>

		@endfor
	</div>
@endsection