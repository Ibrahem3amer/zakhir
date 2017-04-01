@extends('admin.adminbase')

@section('content')
	<div class="page_content">
	    <h1 class="heading_title">التصنيفات الرئيسية</h1>

	    <div class="wrap">
	        <table class="table table-bordered">
	            <tr style="color: #d14233;">
	                <td>#</td>
	                <td style="width: 70%; text-align: right;" >اسم التصنيف</td>
	                <td>التحكم</td>
	            </tr>
	            <?php $i =1; ?>
	            @foreach( $cats as $cat )
	            <tr>
	                <td>{{$i++}}</td>
	                <td style="text-align: right;">{{$cat->name}}
	                @if( null !== $cat->parent_id)
	                	<small style="font-style: italic;">- تصنيف فرعي </small>
	                @endif
	                </td>
	                <td>
	                    <a href="{{ URL::to('/')}}/admin/editcat?id={{$cat->id}}" class="glyphicon glyphicon-pencil" data-toggle="tooltip"
	                       data-placement="top" title="تعديل"></a>
	                    <a href="{{ URL::to('/')}}/admin/deletecat?id={{$cat->id}}" class="glyphicon glyphicon-remove" data-toggle="tooltip"
	                       data-placement="top" title="حذف"></a>
	                </td>
	            </tr>
	            @endforeach
	        </table>

	    </div>
	</div>
@endsection