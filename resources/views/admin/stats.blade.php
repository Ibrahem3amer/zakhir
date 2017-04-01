@extends('admin.adminbase')

@section('content')
	<div class="page_content">
	    <h1 class="heading_title">الإحصائيات</h1>

	    <div class="wrap">
	        <table class="table table-bordered">
	            <tr>
	                <td>عدد المنتجات</td>
	                <td style="text-align: center;" >{{$products_total}}<small style="font-style: italic; color: #000; font-size: 11px;"> منتج</small></td>
	            </tr>
	            <tr>
	                <td>عدد الأوردرات</td>
	                <td style="text-align: center;" >{{$orders_total}}<small style="font-style: italic; color: #000; font-size: 11px;"> أوردر</small></td>
	            </tr>
	            <tr>
	                <td>اجمالي المبيعات</td>
	                <td style="text-align: center;" >{{$total_benefits_total}}<small style="font-style: italic; color: #000; font-size: 11px;"> ريال</small></td>
	            </tr>
	            <tr>
	                <td>اجمالي المبيعات هذا الشهر</td>
	                <td style="text-align: center;" >{{$this_month_total}}<small style="font-style: italic; color: #000; font-size: 11px;"> ريال</small></td>
	            </tr>
	            <tr>
	                <td>اجمالي عدد الأوردرات المباعة</td>
	                <td style="text-align: center;" >{{$total_benefits_number}}<small style="font-style: italic; color: #000; font-size: 11px;"> أوردر</small></td>
	            </tr>
	            <tr>
	                <td>عدد الأوردرات هذا الشهر</td>
	                <td style="text-align: center;" >{{$orders_this_month}}<small style="font-style: italic; color: #000; font-size: 11px;"> أوردر</small></td>
	            </tr>
	            <tr>
	                <td>نسبة الزيادة في الأوردرات هذا الشهر</td>
	                <td style="text-align: center;" >{{ round(($orders_this_month * 100 )/$orders_total, 2)}}<small style="font-style: italic; color: #000; font-size: 11px;">%</small></td>
	            </tr>
	            <tr>
	                <td>عدد الأوردرات الغير ناجحة</td>
	                <td style="text-align: center;" >{{$failed_orders}}<small style="font-style: italic; color: #000; font-size: 11px;"> أوردر</small></td>
	            </tr>
	        </table>

	    </div>
	</div>
@endsection