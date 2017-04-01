@extends('admin.adminbase')

@section('content')
	<div class="page_content">

	    <h1 class="heading_title">إضافة عضو جديد</h1>
	    @if( null === session('error'))

	    @elseif( empty(session('error')) )
	    	<div role="alert" class="alert alert-success"> <strong>تم إضافة العضو!</strong></div>
    	@else
    		<div role="alert" class="alert alert-danger"> <strong>خطأ في البيانات!</strong></div>
		@endif
	    <div class="form">
	        <form class="form-horizontal" action="{{ URL::to('/') }}/admin/edituser" method="post">
	        	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	        	<input type="hidden" name="user_id" value="">
	            <div class="form-group">
	                <label for="input0" class="col-sm-2 control-label bring_right left_text">اسم العضو</label>
	                <div class="col-sm-10">
	                    <input type="text" value="" name="user_name" class="form-control" id="input0" placeholder="اسم العضو">
	                </div>
	            </div>
				<div class="form-group">
	                <label for="input1" class="col-sm-2 control-label bring_right left_text">الإيميل</label>
	                <div class="col-sm-10">
	                    <input type="email" value="" name="user_mail" class="form-control" id="input1" placeholder="الإيميل">
	                </div>
	            </div>
				<div class="form-group">
	                <label for="input2" class="col-sm-2 control-label bring_right left_text">الرقم السري</label>
	                <div class="col-sm-10">
	                    <input type="text" value="" name="user_password" class="form-control" id="input2" placeholder="الرقم السري" >
	                </div>
	            </div>
				<div class="form-group">
	                <label for="input3" class="col-sm-2 control-label bring_right left_text">عنوان الشحن والتوصيل</label>
	                <div class="col-sm-10">
	                    <textarea name="user_address" class="form-control" id="input3"></textarea>
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