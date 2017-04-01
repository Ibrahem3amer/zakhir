@extends('admin.adminbase')

@section('content')
	<div class="page_content">

	    <h1 class="heading_title">تعديل الألبومات</h1>
	    @if( null === session('error'))

	    @elseif( empty(session('error')) )
	    	<div role="alert" class="alert alert-success"> <strong>تم التعديل!</strong></div>
    	@else
    		<div role="alert" class="alert alert-danger"> <strong>خطأ في البيانات!</strong></div>
		@endif
	    <div class="form">
	        <form class="form-horizontal" action="{{ URL::to('/') }}/admin/editalbum" method="post">
	        	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	        	<input type="hidden" name="album_id" value="{{$album->id}}">
	            <div class="form-group">
	                <label for="input0" class="col-sm-2 control-label bring_right left_text">اسم الألبوم</label>
	                <div class="col-sm-10">
	                    <input type="text" value="{{$album->name}}" name="album_name" class="form-control" id="input0" placeholder="اسم الألبوم">
	                </div>
	            </div>
	            <div class="form-group">
	                <label for="input2" class="col-sm-2 control-label bring_right left_text">التصنيفات</label>
	                <div class="col-sm-10">
	                	@foreach( $cats as $opt )
	                		<input type="checkbox" <?php
	                		foreach ($album_in_cat as $cat_id) {
	                			echo $cat_id==$opt->id?"checked":"";
	                		}?>
	                		name="check_boxes" class="check_boxes" value="{{$opt->id}}"> {{$opt->name}}<br>
	                	@endforeach
	                </div>
	            </div>
	            <textarea style="display: none;" name="checked" id="checked_values"></textarea>
	            <div class="form-group">
	                <div class="col-sm-12 left_text">
	                    <button type="submit" class="btn btn-danger check">حفظ</button>
	                </div>
	            </div>
	        </form>
	    </div>
	</div>
@endsection