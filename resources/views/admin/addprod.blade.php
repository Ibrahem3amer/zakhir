@extends('admin.adminbase')

@section('content')
	<div class="page_content">

	    <h1 class="heading_title">إضافة منتج جديد</h1>
	    @if( null === session('error'))

	    @elseif( empty(session('error')) )
	    	<div role="alert" class="alert alert-success"> <strong>تم إضافة المنتج!</strong></div>
    	@else
    		<div role="alert" class="alert alert-danger"> <strong>خطأ في البيانات!</strong></div>
		@endif
	    <div class="form">
	        <form class="form-horizontal" action="/public/admin/editprod" method="post">
	        	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	        	<input type="hidden" name="prod_id" value="0">
	        	<input type="hidden" name="prod_photo" class="prod_photo" value="">
	            <div class="form-group">
	                <label for="input0" class="col-sm-2 control-label bring_right left_text">اسم المنتج</label>
	                <div class="col-sm-10">
	                    <input type="text" value="" name="prod_name" class="form-control" id="input0" placeholder="اسم المنتج">
	                </div>
	            </div>
	            <div class="form-group">
	                <label for="input1" class="col-sm-2 control-label bring_right left_text">سعر المنتج</label>
	                <div class="col-sm-10">
	                    <input type="text" value="" name="prod_price" class="form-control" id="input1" placeholder="سعر المنتج">
	                </div>
	            </div>
				<div class="upload_photo form-group">
					<label for="choose" class="col-sm-2 control-label bring_right left_text">أضف صورة: </label>
					<a class="various " href="#albums" id="pr_pick"><div class="btn">اختر من الأستوديو</div></a>
					<input type="hidden" name="picker" value="" class="picker"/>
				</div>
					<div class="upload_photo secondary form-group">
						<label for="choose" class="col-sm-2 control-label bring_right left_text">صورة إضافية: </label>
						<a class="various btn_sec" href="#sec_albums" class="btn_sec"><div class="btn">اختر من الأستوديو</div></a>
						<input type="hidden" name="additional1" value="" class="additional"/>
					</div>
				<div class="form-group">
	                <label for="input2" class="col-sm-2 control-label bring_right left_text">الوصف</label>
	                <div class="col-sm-10">
	                    <textarea type="text" name="prod_description" class="form-control" id="input2"></textarea>
	                </div>
	            </div>
	            <div class="form-group">
	                <label for="input3" class="col-sm-2 control-label bring_right left_text">القسم الرئيسي</label>
	                <div class="col-sm-10">
	                <select id="input3" class="form-control" name="cat_id">
	                	@foreach( $cats as $opt )
	                	<option value="{{$opt->id}}">{{$opt->name}}</option>
	                	@endforeach
	                </select>
	                </div>
	            </div>
	            <div class="form-group">
	                <label for="input4" class="col-sm-2 control-label bring_right left_text">الماركة</label>
	                <div class="col-sm-10">
	                <select id="input4" class="form-control" name="brand_id">
	                	@foreach( $brands as $opt )
	                	<option value="{{$opt->id}}">{{$opt->name}}</option>
	                	@endforeach
	                </select>
	                </div>
	            </div>
				<div class="form-group">
	                <label for="input5" class="col-sm-2 control-label bring_right left_text">خصم <small>(%)</small></label>
	                <div class="col-sm-10">
	                    <input type="text" value="" name="prod_sale" class="form-control" id="input5" placeholder="سعر المنتج">
	                </div>
	            </div>
		    <hr />
	            <h4>الأحجام</h4>
	            <div class="form-group">
	            	@for( $i = 1; $i <= 5; $i++)
	                	<div class="col-sm-6">
	                		<input type="text" value="" name="size_{{$i}}_name" class="form-control" placeholder="الحجم">
	                	</div>
	                	<div class="col-sm-6">
	                		<input type="text" value="" name="size_{{$i}}_value" class="form-control" placeholder="سعر الحجم">
	                	</div>
	            	@endfor
	            </div>
	            <hr />
	            <h4>الألوان</h4>
	            <div class="form-group">
                	<div class="col-sm-12">
                		<textarea type="text" name="colors" class="form-control"></textarea>
                		<small>افصل بين كل لون بفصلة (,)</small>
                	</div>
	            </div>
	            <textarea id="array" name="photos_values" style="display: none;"></textarea>
	            <div class="form-group">
	                <div class="col-sm-12 left_text">
	                    <button type="submit" class="btn btn-danger">انشاء</button>
	                </div>
	            </div>

	        </form>
	    </div>
		<div id="albums" style="display: none;">
			@foreach( $albums as $album )
				<div class="thumbnail" style="text-align: center;">
					<a href="#photos" class="various album" value="{{ $album->id }}"> {{ $album->name }} </a>
				</div>
			@endforeach
		</div>
		<div id="sec_albums" style="display: none;">
			@foreach( $albums as $album )
				<div class="thumbnail" style="text-align: center;">
					<a href="#photos" class="various sec" value="{{ $album->id }}"> {{ $album->name }} </a>
				</div>
			@endforeach
		</div>
		<div id="photos" class="photos" style="display: none;">
			<div class="thumbnail" id="main_photo" style="display: none;">
				<a class="get_url" href="#">
					<img src="" class="img_url" width="300px" height="300px">
				</a>
				<input type="hidden" value="#"/>
			</div>
			<div class="span_target"></div>
		</div>
	</div>

@endsection