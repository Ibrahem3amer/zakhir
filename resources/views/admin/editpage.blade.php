@extends('admin.adminbase')

@section('content')
	<div class="page_content">

	    <h1 class="heading_title">تعديل الصفحة</h1>
	    @if( null === session('error'))

	    @elseif( empty(session('error')) )
	    	<div role="alert" class="alert alert-success"> <strong>تم إضافة الصفحة!</strong></div>
    	@else
    		<div role="alert" class="alert alert-danger"> <strong>خطأ في البيانات!</strong></div>
		@endif
	    <div class="form">
	        <form class="form-horizontal" action="{{ URL::to('/') }}/admin/editpage" method="post">
	        	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	        	<input type="hidden" name="page_id" value="{{ $page->id }}">
	            <div class="form-group">
	                <label for="input0" class="col-sm-2 control-label bring_right left_text">اسم الصفحة</label>
	                <div class="col-sm-10">
	                    <input type="text" value="{{ $page->page_title }}" name="page_title" class="form-control" id="input0" placeholder="اسم الصفحة">
	                </div>
	            </div>
	            <div class="form-group">
	                <label for="input1" class="col-sm-2 control-label bring_right left_text">المحتوى</label>
	                <div class="col-sm-10">
	                    <textarea id="page_content" name="page_content">{{ $page->content }}</textarea>
	                </div>
	            </div>
	            <div class="form-group">
	                <div class="col-sm-12 left_text">
	                    <button type="submit" class="btn btn-danger check">حفظ</button>
	                </div>
	            </div>
	        </form>
	    </div>
	</div>
@endsection