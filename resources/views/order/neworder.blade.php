@extends('layouts.base')

@section('body')
	<div class="container">
		<div class="col-md-6">
			<input type="hidden" class="user_id" value="1" />
			<ul>
				<?php $i = sizeof($products_in_cart)-1;?>
				<?php $sum = 0; ?>
				@foreach( $products as $product )
				<li class="" style="list-style-type: none;">
					<input type="hidden" class="prod_id" value="{{$product->id}}" />
					<img src="{{$product['photo_url']}}" class="responsive-img" width="70px" height="70px" />
					<span>{{$product['name']}}</span>
					<div class="badge">{{$products_in_cart[$i]->quantity}}</div>
					<hr />
					<?php $PriceAfterSale = ($product->price-($product->price*($product->has_sale>0?$product->has_sale:100)/100)); ?>
					<?php $sum+= $PriceAfterSale * $products_in_cart[$i--]->quantity; ?>
				</li>
				@endforeach
			</ul>
			<input type="hidden" id="total_cost" value="{{$sum}}" />
		</div>
		<div class="col-md-6">
			<h3>القيمة النهائية لطلبك هي: {{$sum}}ريال</h3>
			<p>سيتم تسليم الأوردر على العنوان التالي: {{\Auth::user()->address}}</p>
			<button class="btn btn-success billing">الإنهاء والدفع</button>
			<button class="btn btn-danger cart">عودة لسلة المشتريات</button>
		</div>
		<script type="text/javascript">
			$('.billing').click(function(){
				var newURL = window.location.protocol + "//" + window.location.host;
				user_id = $('.user_id').val();
				total = $('#total_cost').val();
	        	window.location.href = newURL + '/public/order/billing?user_id='+user_id+'&total='+total;
			});

			$('.cart').click(function(){
				var newURL = window.location.protocol + "//" + window.location.host;
	        	window.location.href = newURL + '/public/cart/home';
			});

		</script>
	</div>
@endsection