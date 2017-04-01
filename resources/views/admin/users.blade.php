@extends('admin.adminbase')

@section('content')
	<div class="page_content">
	    <h1 class="heading_title">الأعضاء</h1>

	    <div class="wrap">
	        <table class="table table-bordered">
	            <tr style="color: #d14233;">
	                <td>#</td>
	                <td style="width: 20%; text-align: right;" >اسم العضو</td>
	                <td style="width: 10%; text-align: right;" >رقم الكارت</td>
	                <td style="width: 10%; text-align: right;" >البريد الإلكتروني</td>
	                <td style="width: 20%; text-align: right;" >تاريخ التسجيل</td>
	                <td>التحكم</td>
	            </tr>
	            <?php $i =1; ?>
	            @foreach( $users as $user )
	            <tr>
	                <td>{{$i++}}</td>
	                <td style="text-align: right;">{{$user->name}}</td>
	                <td style="text-align: right;">{{$user->stripe_customer_id}}</td>
	                <td style="text-align: right;">{{$user->email}}</td>
	                <td style="text-align: right;">{{$user->created_at}}</td>
	                <td>
	                    <a href="{{ URL::to('/')}}/admin/edituser?id={{$user->id}}" class="glyphicon glyphicon-pencil" data-toggle="tooltip"
	                       data-placement="top" title="تعديل"></a>
	                    <a href="{{ URL::to('/')}}/admin/deleteuser?id={{$user->id}}" class="glyphicon glyphicon-remove" data-toggle="tooltip"
	                       data-placement="top" title="حذف"></a>
	                </td>
	            </tr>
	            @endforeach
	        </table>

	    </div>
	</div>
@endsection