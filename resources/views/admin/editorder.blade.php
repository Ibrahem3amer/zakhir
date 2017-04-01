@extends('admin.adminbase')

@section('content')
	<div class="page_content">

	    <h1 class="heading_title">تحديث حالة الأوردر</h1>
	    @if( null === session('error'))

	    @elseif( empty(session('error')) )
	    	<div role="alert" class="alert alert-success"> <strong>تم تعديل الأوردر!</strong></div>
    	@else
    		<div role="alert" class="alert alert-danger"> <strong>خطأ في البيانات!</strong></div>
		@endif
	    <div class="form">
	        <form class="form-horizontal" action="{{ URL::to('/') }}/admin/editorder" method="post">
	        	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	        	<input type="hidden" name="order_id" value="{{ $order->id }}">
	            <div class="form-group">
	                <label for="input0" class="col-sm-2 control-label bring_right left_text">رقم الأوردر</label>
	                <div class="col-sm-10">
	                    <input type="text" value="{{ $order->id }}" name="order_id" class="form-control" id="input0" placeholder="رقم الأوردر" disabled>
	                </div>
	            </div>
	            <div class="form-group">
	                <label for="input1" class="col-sm-2 control-label bring_right left_text">حالة الأوردر الآن</label>
	                <div class="col-sm-10">
	                    <input type="radio" name="order_status" value="waiting"
	                     <?php echo $order->status=='waiting'?'checked':''; ?>/> في إنتظار الموافقة<br />
	                    <input type="radio" name="order_status" value="accepted"
	                     <?php echo $order->status=='accepted'?'checked':''; ?>/> تم قبوله<br />
	                    <input type="radio" name="order_status" value="being prepared"
	                     <?php echo $order->status=='being prepared'?'checked':''; ?>/> يتم تحضيره<br />
	                    <input type="radio" name="order_status" value="done"
	                     <?php echo $order->status=='done'?'checked':''; ?>/> تم شحنه واستلامه<br />
	                    <input type="radio" name="order_status" value="canceled"
	                     <?php echo $order->status=='canceled'?'checked':''; ?>/> إلغاء الأوردر<br />
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