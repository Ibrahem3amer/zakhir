@extends('admin.adminbase')

@section('content')
	<div class="page_content">

	    <h1 class="heading_title">إضافة قسم</h1>
	    @if( null === session('error'))

	    @elseif( empty(session('error')) )
	    	<div role="alert" class="alert alert-success"> <strong>تم إضافة القسم!</strong></div>
    	@else
    		<div role="alert" class="alert alert-danger"> <strong>خطأ في البيانات!</strong></div>
		@endif
	    <div class="form">
	        <form class="form-horizontal" action="/public/admin/editcat" method="post">
	        	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	        	<input type="hidden" name="cat_id" value="0">
	            <div class="form-group">
	                <label for="input0" class="col-sm-2 control-label bring_right left_text">اسم القسم</label>
	                <div class="col-sm-10">
	                    <input type="text" value="" name="cat_name" class="form-control" id="input0" placeholder="اسم القسم">
	                </div>
	            </div>
	            <div class="form-group">
	                <label for="input2" class="col-sm-2 control-label bring_right left_text">القسم الرئيسي</label>
	                <div class="col-sm-10">
	                <select id="input2" class="form-control" name="parent_id">
	                	@foreach( $cats as $opt )
	                	<option value="{{$opt->id}}">{{$opt->name}}</option>
	                	@endforeach
	                </select>
	                </div>
	            </div>
	            <div class="form-group">
	                <div class="col-sm-12 left_text">
	                    <button type="submit" class="btn btn-danger">حفظ</button>
	                </div>
	            </div>
	        </form>
	    </div>
	</div>
@endsection