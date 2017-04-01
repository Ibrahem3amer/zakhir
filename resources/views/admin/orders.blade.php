@extends('admin.adminbase')

@section('content')
	<div class="page_content">
	    <h1 class="heading_title">الطلبات</h1>
	    <br />
    	<form action="{{URL::to('/admin/orders')}}" method="post">
        	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	        <div class="form-group">
		    	<select name="order_status" class="form-control">
		        	<option value="waiting"> في إنتظار الموافقة</option>
			        <option value="accepted"> تم قبوله</option>
			        <option value="being prepared"> يتم تحضيره</option>
			        <option value="done"> تم شحنه واستلامه</option>
			        <option value="canceled"> أوردر ملغي</option>
				</select>
        	</div>	
            <div class="form-group">
                <div class="col-sm-12 left_text">
                    <button type="submit" class="btn btn-danger check">تصفية</button>
                </div>
            </div>
		</form>
	    <div class="wrap">
	        <table class="table table-bordered">
	            <tr style="color: #d14233;">
	                <td>#</td>
	                <td style="width: 10%; text-align: right;" >رقم الأوردر</td>
	                <td style="width: 30%; text-align: right;" >اسم العضو</td>
	                <td style="width: 10%; text-align: right;" >الإجمالي</td>
	                <td style="width: 10%; text-align: right;" >الحالة</td>
	                <td style="width: 20%; text-align: right;" >تاريخ الطلب</td>
	                <td style="width: 7%; text-align: right;" >قائمة المنتجات</td>
	                <td>التحكم</td>
	            </tr>
	            <?php $i =1; ?>
	            @foreach( $orders as $order )
	            <tr>
	                <td>{{$i++}}</td>
	                <td style="text-align: right;">{{$order->id}}</td>
	                <td style="text-align: right;">
	                	@foreach($users as $user)
	                		@if( $user->id == $order->user_id )
	                			{{ $user->name }}
	                			<?php $user_id = $user->id; ?>
	                			<?php break; ?>
	                		@endif
	                	@endforeach
	                </td>
	                <td style="text-align: right;">{{$order->total}}</td>
	                <td style="text-align: right;">{{$order->status}}</td>
	                <td style="text-align: right;">{{$order->created_at}}</td>
	                <td style="text-align: center;"><a href="{{ URL::to('/')}}/admin/listorder?id={{$order->id}}&user={{$user_id}}" class="glyphicon glyphicon-list-alt"></a></td>
	                <td>
	                    <a href="{{ URL::to('/')}}/admin/editorder?id={{$order->id}}" class="glyphicon glyphicon-refresh" data-toggle="tooltip"
	                       data-placement="top" title="تعديل"></a>
	                    <a href="{{ URL::to('/')}}/admin/deleteorder?id={{$order->id}}" class="glyphicon glyphicon-remove" data-toggle="tooltip"
	                       data-placement="top" title="حذف"></a>
	                </td>
	            </tr>
	            @endforeach
	        </table>

	    </div>
	</div>
@endsection