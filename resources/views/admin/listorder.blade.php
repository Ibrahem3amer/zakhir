@extends('admin.adminbase')

@section('content')
	<div class="page_content">
	    <h1 class="heading_title">أوردر رقم {{$order->id}}</h1>
		<div class="form-group">
			<div class="col-sm-12 text-center">
				<a href="{{ URL::to('/')}}/admin/orders" class="btn btn-danger">العودة</a>
			</div>
		</div>
	    <div class="wrap">
	        <table class="table table-bordered">
	            <tr style="color: #d14233;">
	                <td style="width: 25%; text-align: right;" >رقم الأوردر</td>
	                <td style="width: 25%; text-align: right;" >الإجمالي</td>
	                <td style="width: 25%; text-align: right;" >الحالة</td>
	                <td style="width: 25%; text-align: right;" >تاريخ الطلب</td>
	                <td>التحكم</td>
	            </tr>
	            <tr>
	                <td style="text-align: right;">{{$order->id}}</td>
	                <td style="text-align: right;">{{$order->total}}</td>
	                <td style="text-align: right;">{{$order->status}}</td>
	                <td style="text-align: right;">{{$order->created_at}}</td>
	                <td>
	                    <a href="{{ URL::to('/')}}/admin/editorder?id={{$order->id}}" class="glyphicon glyphicon-pencil" data-toggle="tooltip"
	                       data-placement="top" title="تعديل"></a>
	                </td>
	            </tr>
	        </table>

	        <table class="table table-bordered">
	            <tr style="color: #d14233;">
	                <td>#</td>
	                <td style="width: 40%; text-align: right;" >اسم المنتج</td>
	                <td style="width: 10%; text-align: right;" >السعر للوحدة</td>
	                <td style="width: 10%; text-align: right;" >العدد</td>
	                <td style="width: 20%; text-align: right;" >السعر داخل الطلب</td>
	                <td style="width: 10%; text-align: right;" >الخصم</td>
	                <td style="width: 5%; text-align: right;" >المقاس</td>
	                <td style="width: 5%; text-align: right;" >اللون</td>

	            </tr>
	            <?php $i =1; ?>
	            @foreach( $products_with_quantities as $product )
		            <tr>
		                <td>{{$i++}}</td>
		                <td style="text-align: right;">{{$product['name']}}</td>
		                <td style="text-align: right;">{{$product['price']}}</td>
		                <td style="text-align: right;">{{$product['0']}}</td>
		                <td style="text-align: right;">{{$product['0']*$product['price']}}</td>
		                <td style="text-align: right;">{{$product['has_sale']}}</td>
		                <td style="text-align: right;">{{$product['size']}}</td>
		                <td style="text-align: right;">{{$product['color']}}</td>
		            </tr>
	            @endforeach
	            </tr>
	        </table>

	    </div>
	</div>
@endsection