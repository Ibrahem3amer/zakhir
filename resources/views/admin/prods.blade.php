@extends('admin.adminbase')

@section('content')
	<div class="page_content">
	    <h1 class="heading_title">المنتجات</h1>

	    <div class="wrap">
	        <table class="table table-bordered">
	            <tr style="color: #d14233;">
	                <td>#</td>
	                <td style="width: 30%; text-align: right;" >اسم المنتج</td>
	                <td style="width: 10%; text-align: center;" >الصورة</td>
	                <td style="width: 10%; text-align: center;" >السعر</td>
	                <td style="width: 10%; text-align: center;" >خصم</td>
	                <td style="width: 10%; text-align: center;" >المقاس</td>
	                <td style="width: 10%; text-align: center;" >اللون</td>
	                <td>التحكم</td>
	            </tr>
	            <?php $i =1; ?>
	            @foreach( $prods as $prod )
	            <tr>
	                <td>{{$i++}}</td>
	                <td style="text-align: right;">{{$prod->name}}
	                </td>
	                <td class="text-center">
	                	<img src="{{$prod->photo_url}}" alt="{{$prod->name}}" width="50px" height="50px" />
	                </td>
	                <td class="text-center">{{$prod->price}}</td>
	                <td class="text-center">{{$prod->has_sale?'نعم':'لا'}}</td>
	                <td class="text-center">
	                	@if(!empty($prod->size))
	                		<?php $arr = json_decode($prod->size, true); ?>
	                		@foreach( $arr as $size => $price)
	                			<h5>{{$size}} = {{$price}}</h5>
	                		@endforeach
	                	@else
	                		<h5>غير محدد</h5>
	                	@endif
	                </td>
	                <td class="text-center">
	                		<h5>غير محدد</h5>
	                </td>
	                <td>
	                    <a href="{{ URL::to('/')}}/admin/editprod?id={{$prod->id}}" class="glyphicon glyphicon-pencil" data-toggle="tooltip"
	                       data-placement="top" title="تعديل"></a>
	                    <a href="{{ URL::to('/')}}/admin/deleteprod?id={{$prod->id}}" class="glyphicon glyphicon-remove" data-toggle="tooltip"
	                       data-placement="top" title="حذف"></a>
	                </td>

	            </tr>
	            @endforeach
	        </table>

	    </div>
	</div>
@endsection