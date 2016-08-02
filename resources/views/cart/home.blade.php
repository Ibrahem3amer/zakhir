@extends('layouts.base')

@section('body')
	<div class="container">
		<ul>
			<?php $i = sizeof($prods)-1;?>
			<?php $sum = 0; ?>

			@foreach( $prods_details as $details )
			<li class="thumbnail text-center">
				<input type="hidden" class="prod_id" value="{{$details->id}}" />
				<img src="{{$details['photo_url']}}" class="responsive-img" width="450px" height="450px" />
				<h3>{{$details['name']}}</h3>
				<input type="input" value="{{$prods[$i]->quantity}}" name="prod_quantity" class="quantity" />
				<?php $sum += ($prods[$i]->quantity*$details->price); ?>
				<h4 class="price">{{$details->price * $prods[$i]->quantity}}</h4>
				<input type="hidden" class="unit_price" value="{{$details->price}}" />
				<button class="btn btn-danger remove">Remove from Cart</button>
				<button class="btn btn-primary wishlist">Add to wishlist</button>
				<button class="btn btn-success added" style="display: none;">
					Added To Wishlist!
				</button>
			
			</li>
			@endforeach
		</ul>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<h3>Total price</h3>
				</div>
			</div>
			<div class="panel-body">
				<h3 id="sum">{{ $sum }}$</h3>
				<button class="btn btn-primary">Check out</button>
				<button class="btn btn-danger">Delete Cart</button>
			</div>	
		</div>
		<script type="text/javascript">
			$('.quantity').change(function(){
				var thumb = $(this).closest('.thumbnail');
				unit_price = thumb.find('.unit_price');	
				price = thumb.find('.price');
				price.text(parseInt($(this).val()*unit_price.val()));
				var sum = 0;
				$('.price').each(function(){
					sum += parseInt($(this).text());
				});
				$('#sum').text(sum+"$");
			});

			$('.remove').click(function(){
				price = $(this).closest('.thumbnail');
				price = parseInt(price.find('.price').text());
				prev = parseInt($('#sum').text());
				$('#sum').text(parseInt(prev-price)+"$");
				$(this).closest('.thumbnail').fadeOut();
			});

			$('.wishlist').click(function(){
				var prod_id = $('.prod_id').val();
				var thumb = $(this).closest('.thumbnail');
				price = $(this).closest('.thumbnail');
				price = parseInt(price.find('.price').text());
				prev = parseInt($('#sum').text());
				$('#sum').text(parseInt(prev-price)+"$");

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