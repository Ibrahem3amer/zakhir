@extends('admin.adminbase')

@section('content')
	<div class="page_content">
	    <h1 class="heading_title">الواجهة الرسمية</h1>
	    <div class="wrap">
		    <div class="form">
		        <form class="form-horizontal" action="{{ URL::to('/') }}/admin/ui" method="post">
		        	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		        	<table class="table table-bordered">
			            <tr style="color: #d14233; text-align: center;">
			            	<td colspan="7">قائمة اللينكات الرئيسية</td>
			            </tr>
			            <tr style="color: #000; font-weight: bold; text-align: center;">
			            	<td style="width: 10%;">ألبوم الصور</td>
			            	<td style="width: 10%;">المنتجات</td>
			            	<td style="width: 10%;">{{$nav[0]->placeholder}}</td>
			            	<td style="width: 10%;">{{$nav[1]->placeholder}}</td>
			            	<td style="width: 10%;">{{$nav[2]->placeholder}}</td>
			            	<td style="width: 10%;">{{$nav[3]->placeholder}}</td>
			            	<td style="width: 10%;">{{$nav[4]->placeholder}}</td>
			            </tr>
			            <tr style="color: #000; font-weight: bold; text-align: center;">
			            	<td style="width: 10%;">
				            	<select style="width: 90%;" name="" disabled>
			            			<option value="">ألبوم الصور</option>
				            	</select>
			            	</td>
			            	<td style="width: 10%;">
				            	<select style="width: 90%;" name="" disabled>
			            			<option value="">المنتجات</option>
				            	</select>
			            	</td>
			            	<td style="width: 10%;">
				            	<select style="width: 90%;" name="element3" >
				            		@foreach($pages as $page)
				            			<option value="{{$page->id}}">{{$page->page_title}}</option>
				            		@endforeach
				            	</select>
			            	</td>
			            	<td style="width: 10%;">
				            	<select style="width: 90%;" name="element4" >
				            		@foreach($pages as $page)
				            			<option value="{{$page->id}}">{{$page->page_title}}</option>
				            		@endforeach
				            	</select>
			            	</td>
			            	<td style="width: 10%;">
				            	<select style="width: 90%;" name="element5" >
				            		@foreach($pages as $page)
				            			<option value="{{$page->id}}">{{$page->page_title}}</option>
				            		@endforeach
				            	</select>
			            	</td>
			            	<td style="width: 10%;">
				            	<select style="width: 90%;" name="element6" >
				            		@foreach($pages as $page)
				            			<option value="{{$page->id}}">{{$page->page_title}}</option>
				            		@endforeach
				            	</select>
			            	</td>
			            	<td style="width: 10%;">
				            	<select style="width: 90%;" name="element7" >
				            		@foreach($pages as $page)
				            			<option value="{{$page->id}}">{{$page->page_title}}</option>
				            		@endforeach
				            	</select>
			            	</td>
			            </tr>
			        </table>
		            <div class="form-group">
		                <div class="col-sm-12 left_text">
		                    <button type="submit" class="btn btn-danger check">تحديث اللينكات</button>
		                </div>
		            </div>
		        </form>
		    </div>
	    </div>
	</div>
@endsection