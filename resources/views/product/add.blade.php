@extends('layouts.base')

@section('body')
	<div class="container" style="float: right; direction: rtl;">

		@if (count($errors) > 0)
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
		{!! Form::open(['url'=>'product/addproduct','method'=>'POST', 'files'=>true]) !!}
			<label for="pr_name">اسم المنتج</label>
			<input type="input" placeholder="اسم المنتج" name="pr_name" value="" />
			<br />
			<label for="pr_price">السعر بالدولار</label>
			<input type="input" placeholder="السعر المطلوب للوحدة" name="pr_price" />
			<br />
			<div class="upload_photo">
				<label for="choose">أضف صورة: </label>
				<a class="various" href="#albums" id="pr_pick"><div class="btn">اختر من الأستوديو</div></a>
				<input type="hidden" name="picker" value="" class="picker"/>
				<label for="uploader">أو</label>
				<a class="various" href="#add_photo"><div class="btn upload_btn upload" value="">قم برفع صورة جديدة</div></a>
				@if( null !== session('photo') )
					{{ session('photo')->photo_url }}
					<input type="hidden" name="uploader" value="{{ session('photo')->photo_url }}"/>
				@endif
			</div>
			<div id="target_btn" class="btn btn-primary">Add more photos!</div>
			<br />
			<label for="cats">Select a category</label>
		 	<select name="albums">
			 	@foreach( $cats as $cat )
			  		<option value="{{$cat->id}}">{{ $cat->name }}</option>
		  		@endforeach
			</select> 
			<br />
			<input type="submit" value="Upload" />
		{!! Form::close() !!}
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
					<img src="#" class="img_url" width="300px" height="300px">
				</a>
				<input type="hidden" value="#"/>
			</div>
		</div>
		<div id="add_photo" style="display: none;">
			{!! Form::open(['url'=>'media/addmedia','method'=>'POST', 'files'=>true]) !!}
				<label for="img_name">Name</label>
				<input type="input" placeholder="your image name" name="img_name" />
				<br />
				<label for="upload">upload</label>
				<input type="file" placeholder="your image name" name="upload" />
			  	<p class="errors">{!!$errors->first('upload')!!}</p> 
				@if(Session::has('error'))
				<p class="errors">{!! Session::get('error') !!}</p>
				@endif
				<br />
				<label for="cats">Select a category</label>
			 	<select name="albums">
			 	@foreach( $albums as $album )
			  		<option value="{{$album->id}}">{{ $album->name }}</option>
		  		@endforeach
				</select> 
				<br />
				<input type="submit" value="Upload" />
			{!! Form::close() !!}
		</div>
		<script type="text/javascript">
			$(document).ready(function() {
				$(".various").fancybox({
					maxWidth	: 800,
					maxHeight	: 600,
					fitToView	: false,
					width		: '70%',
					height		: '70%',
					autoSize	: false,
					closeClick	: false,
					openEffect	: 'none',
					closeEffect	: 'none'
				});

				$('#pr_pick').click(function(){
					$('#albums').show();
				});

				$('.album').click(function(){
					var id = $(this).attr('value');
					$.ajax({
			            url:"/public/media/photos?q="+id,
			            success:function(photos)
			            {
			            	$('.photos').fadeIn();
			            	var thumb = $('#photos').find('.thumbnail');
							for (var i = photos.length-1; i >= 0; i--) 
	                    	{	
	                    		thumb = thumb.clone().appendTo('#photos');
	                    		var img_url = thumb.find('.img_url');
	                    		var urlSyntax = "{{ URL::to('/') }}"+photos[i].photo_url;
	                    		img_url.attr('src', urlSyntax);
	                    		thumb.show();
	                    	}
	                    	var photo_url = $('.get_url');
	                    	photo_url.click(function(){
	                    		var urlToInput = $(this).find('.img_url').attr('src');
	                    		$('.picker').attr('value', urlToInput);
	                    		$('#pr_pick').append(urlToInput);
	                    		$('.upload_btn').hide();
	                    		$.fancybox.close();
	                    	});
			            }
			        });
				});

				$('#target_btn').click(function(){
					var frame = $('.upload_photo').clone();
					$('#target_btn').before(frame);
					
				});


			});
		</script>
	</div>
@endsection