@extends('layouts.base')

@section('body')
	<div class="container">
		<ul>
			<?php $i = sizeof($prods)-1;?>
			<?php $sum = 0; ?>
			@if( $prods_details )
				@foreach( $prods_details as $details )
				<li class="thumbnail text-center">
					<input type="hidden" class="prod_id" value="{{$details->id}}" />
					<img src="{{$details['photo_url']}}" class="responsive-img" width="450px" height="450px" />
					<h3>{{$details['name']}}</h3>
					<h4 class="price">{{$details->price}}</h4>
					<input type="hidden" class="unit_price" value="{{$details->price}}" />
					<button class="btn btn-danger remove">Remove from wishlist</button>
					<button class="btn btn-primary wishlist">Add to cart</button>
				
				</li>
				@endforeach
			@else
				<h1>No items to display</h1>
			@endif

		</ul>
		<script type="text/javascript">

			$('.remove').click(function(){
				var prod_id = $('.prod_id').val();
				var thumb = $(this).closest('.thumbnail');
				$.ajax({	
					url: '/cart/remove/?id='+prod_id+'&user='+1,
					success: function(){
						console.log($(this));
						thumb.find('.remove').hide();
						thumb.find('.wishlist').hide();
						thumb.find('.added').show();
						thumb.fadeOut(1500);
					},
					error: function(){
						console.log('fail');
					},
				});
			});

			$('.wishlist').click(function(){
				var prod_id = $('.prod_id').val();
				var thumb = $(this).closest('.thumbnail');
				$.ajax({
					url: '/cart/towish/?id='+prod_id,
					success: function(){
						console.log($(this));
						thumb.find('.remove').hide();
						thumb.find('.wishlist').hide();
						thumb.find('.added').show();
						thumb.fadeOut(1500);
					},
					error: function(){
						console.log('fail');
					},
				});
			});

		</script>
	</div>
@endsection