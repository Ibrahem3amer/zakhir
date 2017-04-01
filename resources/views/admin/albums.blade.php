@extends('admin.adminbase')

@section('content')
	<div class="page_content">
	    <h1 class="heading_title">ألبومات الصور</h1>

	    <div class="wrap">
	        <table class="table table-bordered">
	            <tr style="color: #d14233;">
	                <td>#</td>
	                <td style="width: 70%; text-align: right;" >اسم الألبوم</td>
	                <td>التحكم</td>
	            </tr>
	            <?php $i =1; ?>
	            @foreach( $albums as $album )
	            <tr>
	                <td>{{$i++}}</td>
	                <td style="text-align: right;">{{$album->name}}
	                </td>
	                <td>
	                    <a href="{{ URL::to('/')}}/admin/editalbum?id={{$album->id}}" class="glyphicon glyphicon-pencil" data-toggle="tooltip"
	                       data-placement="top" title="تعديل"></a>
	                    <a href="{{ URL::to('/')}}/admin/deletealbum?id={{$album->id}}" class="glyphicon glyphicon-remove" data-toggle="tooltip"
	                       data-placement="top" title="حذف"></a>
	                </td>
	            </tr>
	            @endforeach
	        </table>

	    </div>
	</div>
@endsection