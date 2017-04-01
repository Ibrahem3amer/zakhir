@extends('layouts.base')

@section('body')
	<div class="container">
		<div class="inner-content col-md-10 col-lg-10">
			<input type="hidden" id="user_id" value="{{\Auth::user()->id}}" />
			@if( sizeof($prods_details) ) 
				<table class="cart-products">
					<?php $i = sizeof($prods)-2;?>
					<?php $sum = 0; ?>
					@foreach( $prods_details as $details )
						<tr class="thumbnail">
							<input type="hidden" class="prod_id" value="{{$details->id}}" />
							<td class="cart-table-image" style="width: 40%;">
								<img src="{{$details['photo_url']}}" class="responsive-img cart-img" width="450px" height="450px" />
							</td>
							<td class="cart-table-price" style="width: 40%; text-align: right;">
								<h3>{{$details['name']}}</h3>
								<input type="input" value="{{$prods[$i]->quantity}}" name="prod_quantity" class="quantity" />
								<?php $PriceAfterSale = ($details->price-($details->price*($details->has_sale>0?$details->has_sale:100)/100)); ?>
								<?php $sum += ($prods[$i]->quantity*$PriceAfterSale); ?>
								<h4 class="price">{{$PriceAfterSale * $prods[$i]->quantity}} <small style="color: #7cc04b;">ريال</small></h4>
								<input type="hidden" class="unit_price" value="{{$PriceAfterSale}}" />
							</td>
							<td class="cart-table-data" style="width: 20%; text-align: center;">
								<button class="btn btn-danger remove">حذف</button>
								<button class="btn btn-primary wishlist" style="background-color: #7cc04b; border: 0;">حفظ</button>
								<button class="btn btn-success added" style="display: none;">
									تم إضافته لقائمة الأمنيات
								</button>
							</td>
						</tr>
						<?php $i++ ?>
					@endforeach			
				</table>
			@else
				<h1>لا يوجد منتجات لعرضها.</h1>
			@endif
		</div>
		<div class="inner-content col-md-2 col-lg-2">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="panel-title">
						<h4>إجمالي السعر</h4>
					</div>
				</div>
				<div class="panel-body">
					<h3 id="sum">{{ $sum }} ريال</h3>
					<button class="btn btn-primary" id="check">إنهاء الطلب</button>
				</div>	
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$('.quantity').change(function(){
			var thumb = $(this).closest('.thumbnail');
			var prod_id = thumb.find('.prod_id').val();
			var user_id = $('#user_id').val();
			unit_price = thumb.find('.unit_price');	
			price = thumb.find('.price');
			price.text(parseInt($(this).val()*unit_price.val())+' ريال');
			var sum = 0;
			$('.price').each(function(){
				sum += parseInt($(this).text());
			});
			$('#sum').text(sum+" ريال");
			$.ajax({
				url: '/public/cart/editquan?prod_id='+prod_id+'&user_id='+user_id+'&quan='+$(this).val(),
			});
		});

		$('.remove').click(function(){
			price = $(this).closest('.thumbnail');
			price = parseInt(price.find('.price').text());
			prev = parseInt($('#sum').text());
			$('#sum').text(parseInt(prev-price)+" ريال");
			var prod_id = $('.prod_id').val();
			var thumb = $(this).closest('.thumbnail');
			$.ajax({	
				url: '/public/cart/remove?id='+prod_id+'&user='+1,
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
			var thumb = $(this).closest('.thumbnail');
			var prod_id = thumb.find('.prod_id').val();
			price = $(this).closest('.thumbnail');
			price = parseInt(price.find('.price').text());
			prev = parseInt($('#sum').text());
			$('#sum').text(parseInt(prev-price)+" ريال");

			$.ajax({
				url: '/public/cart/towish?id='+prod_id,
				success: function(){
					console.log($(this));
					thumb.find('.remove').hide();
					thumb.find('.wishlist').hide();
					thumb.find('.added').show();
					thumb.fadeOut(1000);
				},
				error: function(){
					console.log('fail');
				},
			});
		});

		$('#check').click(function(){
	     	var newURL = window.location.protocol + "//" + window.location.host;
	    	window.location.href = newURL + '/public/order/home';
		});
	</script>
@endsection