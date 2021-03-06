@extends('layouts.base')

@section('body')
	<div class="container">
		<div class="row">
			<p>{{$address}}</p>
			<form action="/public/users/billing" method="POST" id="payment-form">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">	
			  <span class="payment-errors"></span>

			  <div class="form-row">
			    <label>
			      <span>Card Number</span>
			      <input type="text" size="20" data-stripe="number">
			    </label>
			  </div>
			  <div class="form-row">
			    <label>
			      <span>Expiration (MM/YY)</span>
			      <input type="text" size="2" data-stripe="exp_month">
			    </label>
			    <span> / </span>
			    <input type="text" size="2" data-stripe="exp_year">
			  </div>

			  <div class="form-row">
			    <label>
			      <span>CVC</span>
			      <input type="text" size="4" data-stripe="cvc">
			    </label>
			  </div>
			  <input type="hidden" value="{{ $order->total }}" name="order_total" />
			  <input type="submit" class="submit" value="Submit Payment">
			</form>


		</div><!-- /.row -->
	</div>
	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
	<script type="text/javascript">
	  Stripe.setPublishableKey('pk_test_d3uoC8RFPgzYi8X1ey8r9LbG');
	  	$(function() {
		  var $form = $('#payment-form');
		  $form.submit(function(event) {
		    // Disable the submit button to prevent repeated clicks:
		    $form.find('.submit').prop('disabled', true);

		    // Request a token from Stripe:
		    Stripe.card.createToken($form, stripeResponseHandler);

		    // Prevent the form from being submitted:
		    return false;
		  });
		});
	</script>


@endsection