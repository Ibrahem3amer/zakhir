@extends('admin.adminbase')

@section('content')
	<div class="page_content">

	    <h1 class="heading_title">تعديل منتج</h1>
	    @if( null === session('error'))

	    @elseif( empty(session('error')) )
	    	<div role="alert" class="alert alert-success"> <strong>تم التعديل!</strong></div>
    	@else
    		<div role="alert" class="alert alert-danger"> <strong>خطأ في البيانات!</strong></div>
		@endif
	    <div class="form">
	        <form class="form-horizontal" action="/public/admin/editprod" method="post">
	        	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	        	<input type="hidden" name="prod_id" value="{{$prod->id}}">
	        	<input type="hidden" name="prod_photo" class="prod_photo" value="{{$prod->photo_url}}">
	            <div class="form-group">
	                <label for="input0" class="col-sm-2 control-label bring_right left_text">اسم المنتج</label>
	                <div class="col-sm-10">
	                    <input type="text" value="{{$prod->name}}" name="prod_name" class="form-control" id="input0" placeholder="اسم المنتج">
	                </div>
	            </div>
	            <div class="form-group">
	                <label for="input1" class="col-sm-2 control-label bring_right left_text">سعر المنتج</label>
	                <div class="col-sm-10">
	                    <input type="text" value="{{$prod->price}}" name="prod_price" class="form-control" id="input1" placeholder="سعر المنتج">
	                </div>
	            </div>
				<div class="upload_photo form-group">
					<label for="choose" class="col-sm-2 control-label bring_right left_text">أضف صورة: </label>
					<a class="various " href="#albums" id="pr_pick"><div class="btn">اختر من الأستوديو</div></a>
					<input type="hidden" name="picker" value="" class="picker"/>
				</div>
				<div class="form-group">
	                <label for="input2" class="col-sm-2 control-label bring_right left_text">الوصف</label>
	                <div class="col-sm-10">
	                    <textarea type="text" name="prod_description" class="form-control" id="input2">{{$prod->description}}</textarea>
	                </div>
	            </div>
	            <div class="form-group">
	                <label for="input3" class="col-sm-2 control-label bring_right left_text">القسم الرئيسي</label>
	                <div class="col-sm-10">
	                <select id="input3" class="form-control" name="cat_id">
	                	@foreach( $cats as $opt )
	                	<option value="{{$opt->id}}" <?php echo $prod->cat_id != $opt->id?"":"selected"; ?>>{{$opt->name}}</option>
	                	@endforeach
	                </select>
	                </div>
	            </div>
	            <div class="form-group">
	                <label for="input4" class="col-sm-2 control-label bring_right left_text">الماركة</label>
	                <div class="col-sm-10">
	                <select id="input4" class="form-control" name="brand_id">
	                	@foreach( $brands as $opt )
	                	<option value="{{$opt->id}}" <?php echo $prod->brand != $opt->id?"":"selected"; ?>>{{$opt->name}}</option>
	                	@endforeach
	                </select>
	                </div>
	            </div>
				<div class="form-group">
	                <label for="input5" class="col-sm-2 control-label bring_right left_text">خصم <small>(%)</small></label>
	                <div class="col-sm-10">
	                    <input type="text" value="{{$prod->has_sale}}" name="prod_sale" class="form-control" id="input5" placeholder="سعر المنتج">
	                </div>
	            </div>
	            <hr />
	            <h4>الأحجام</h4>
	            @if( !empty($prod->size) )
		            <div class="form-group">
	                    <?php $sizes = json_decode($prod->size, true); ?>
	                    @foreach( $sizes as $size => $price )
	                    	<label for="{{$size}}" class="col-sm-2 control-label bring_right left_text">{{$size}}</label>
	                    	<div class="col-sm-10">
	                    		<input type="text" value="{{$price}}" name="{{$size}}" class="form-control" placeholder="سعر المنتج">
	                    	</div>
	                    @endforeach
		            </div>
	            @endif
	            <hr />
	            <h4>الألوان</h4>
	            @if( !empty($prod->color) )
		            <div class="form-group">
	                    <?php $colors = json_decode($prod->color, true); $str = implode(',', $colors); ?>
	                	<label for="colors" class="col-sm-2 control-label bring_right left_text">الألوان</label>
	                	<div class="col-sm-10">
	                		<textarea type="text" name="colors" class="form-control">{{$str}}</textarea>
	                		<small>افصل بين كل لون بفصلة</small>
	                	</div>
		            </div>
	            @endif
	            <div class="form-group">
	                <div class="col-sm-12 left_text">
	                    <button type="submit" class="btn btn-danger">حفظ</button>
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
		<div id="photos" class="photos" style="display: none;">
			<div class="thumbnail" style="display: none;">
				<a class="get_url" href="#">
					<img src="{{$prod->photo_url}}" class="img_url" width="300px" height="300px">
				</a>
				<input type="hidden" value="#"/>
			</div>
		</div>
	</div>

@endsection