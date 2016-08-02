@extends('layouts.base')

@section('body')
	<img src="{{Input::file('upload')->getRealPath()}}" />
@endsection