@extends('layouts.base')

@section('body')
	<div class="container">
		<div class="inner-content">
			<h1 class="text-right" style="font-family: font-family: 'Cairo', sans-serif;  font-style: normal; font-weight: 300;">
				{{$page->page_title}}
			</h1>
			<hr />
			<div id="content" class="text-center">
				{!! $page->content !!}	
			</div>		
		</div>
	</div>	
@endsection