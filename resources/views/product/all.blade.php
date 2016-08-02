@extends('layouts.base')

@section('body')
	<div class="product-model">	 
		<div class="container">
			<ol class="breadcrumb">
			  <li><a href="index.html">Home</a></li>
			  <li class="active">Products</li>
		 	</ol>
			<h2>Our Products</h2>			
		 	<div class="col-md-9 product-model-sec pull-right" >
		 		<div class="prod" style="display: none;">
		 			<input type="hidden" value="" name="prod_id" class="prod_id" />
					<a class="fancybox clickable" href="#prod_view"><div class="product-grid">
						<div class="more-product"><span> </span></div>						
							<div class="product-img b-link-stripe b-animate-go  thickbox">
							<img src="img/p2.jpg" class="img-responsive photo_url" alt=""/>
							<div class="b-wrapper">
							<h4 class="b-animate b-from-left  b-delay03">							
							<button><span aria-hidden="true"></span>More Details</button>
							</h4>
							</div>
						</div>
					</a>	
					<div class="product-info simpleCart_shelfItem">
						<div class="product-info-cust ">
							<h3 class="prt_name">Cat1</h3>							
						</div>						
					</div>
		 		</div>

			</div>	
			<div class="prods-container">
			</div>



				
			</div>
			<div id="prod_view" style="display: none;">
				<table>
					<tr>
						<td width="50%">
						<img src="" class="box_img" width="300px" height="300px" />
						</td>
						<td width="50%" style="margin: 5px;">
							<h2 class="box_title"></h2>
							<h3 class="box_price">price</h3>
							<select name="prod_quantity" class="quan">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
							</select>
							<input type="hidden" value="{{ Auth::user() }}" class="user_id" />
							<button class="btn btn-primary to_cart">Add to cart</button>
						</td>
					</tr>
				</table>
			</div>
			<div class="rsidebar span_1_of_left">
				<section  class="sky-form">
					 <div class="product_right">
						 <h4 class="m_2"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Categories</h4>
						 <?php $i = 1; ?>
						 @foreach( $cats as $cat )
						 @if( $cat->parent_id === null )
						 <div class="tab{{ $i++ }}">
							 <ul class="place">								
								 <li class="sort">{{ $cat->name }}</li>
								 <li class="by"><img src="{{ URL::to('/') }}/img/do.png" alt=""></li>
									<div class="clearfix"> </div>
							  </ul>								  
						 	<div class="single-bottom">
							<a class="node_name" href="#" value="{{$cat->id}}">
								<p>{{ $cat->name }}</p>
							</a>
						 	@foreach( $cat->children->toArray() as $node )
						 		@if( null !== $node )
								<a class="node_name" href="#" value="{{$node['id']}}">
									<p>{{ $node['name'] }}</p>
								</a>
								@endif
							@endforeach
					     	</div>
					      </div>
					      @endif
					      @endforeach
						  
						  <!--script-->
						<script>
							$(document).ready(function(){
								$(".tab1 .single-bottom").hide();
								$(".tab2 .single-bottom").hide();
								$(".tab3 .single-bottom").hide();
								$(".tab4 .single-bottom").hide();
								$(".tab5 .single-bottom").hide();
								
								$(".tab1 ul").click(function(){
									$(".tab1 .single-bottom").slideToggle(300);
									$(".tab2 .single-bottom").hide();
									$(".tab3 .single-bottom").hide();
									$(".tab4 .single-bottom").hide();
									$(".tab5 .single-bottom").hide();
								})
								$(".tab2 ul").click(function(){
									$(".tab2 .single-bottom").slideToggle(300);
									$(".tab1 .single-bottom").hide();
									$(".tab3 .single-bottom").hide();
									$(".tab4 .single-bottom").hide();
									$(".tab5 .single-bottom").hide();
								})
								$(".tab3 ul").click(function(){
									$(".tab3 .single-bottom").slideToggle(300);
									$(".tab4 .single-bottom").hide();
									$(".tab5 .single-bottom").hide();
									$(".tab2 .single-bottom").hide();
									$(".tab1 .single-bottom").hide();
								})
								$(".tab4 ul").click(function(){
									$(".tab4 .single-bottom").slideToggle(300);
									$(".tab5 .single-bottom").hide();
									$(".tab3 .single-bottom").hide();
									$(".tab2 .single-bottom").hide();
									$(".tab1 .single-bottom").hide();
								})	
								$(".tab5 ul").click(function(){
									$(".tab5 .single-bottom").slideToggle(300);
									$(".tab4 .single-bottom").hide();
									$(".tab3 .single-bottom").hide();
									$(".tab2 .single-bottom").hide();
									$(".tab1 .single-bottom").hide();
								})
								$('.node_name').click(function(){
									$('.prods-container').empty();
									id = $(this).attr('value');
					                $.ajax({
					                    url:"/product/prods?q="+id,
					                    success:function(prods)
					                    {
					                    	for (var i = prods.length-1; i >= 0; i--) 
					                    	{	
					                    		var prod = $('.prod');
					                    		prod = prod.clone().appendTo('.prods-container');
					                    		var num = 'prod_item'+(i+1);
					                    		prod.addClass(num);
					                    		var prod_id = prod.find('.prod_id');
					                    		prod_id.attr('value', prods[i].id);
					                    		var
					                    		var anchor = prod.find('.clickable');
					                    		anchor.addClass('grab_info')
					                    		var img_url = prod.find('.photo_url');
					                    		var prod_title = prod.find('.prt_name');
					                    		var urlSyntax = prods[i].photo_url;
					                    		img_url.attr('src', urlSyntax);
					                    		prod_title.text(prods[i].name);
					                    		prod.fadeIn();

					                    	}
											$('.fancybox').fancybox({
												openEffect	: 'elastic',
										    	closeEffect	: 'elastic',
										    	helpers : {
										    		title : {
										    			type : 'over'
										    		}
										    	}
											});
							                $('.grab_info').click(function(){
							                	prod = $(this).closest('.prod');
							                	//alert(prod);
							                	img = prod.find('.photo_url');
							                	title = prod.find('.prt_name');
							                	id = prod.find('.prod_id').val();

							                	box_title = $('.box_title');
							                	box_title.text(title.text());

							                	box_img = $('.box_img');
							                	box_img.attr('src', img.attr('src'));

								                $('.to_cart').click(function(){
								                	/*var newURL = window.location.protocol + "//" + window.location.host;
								                	window.location.href = newURL + '/cart/home';*/
								                	var prod_quantity = $('.quan').val();
								                	var user_id = 1/*$('.user_id').val()*/;
								                	$.ajax({
								                		url: "/cart/new?prod_id="+id+"&q="+prod_quantity+"&user="+user_id,
								                		success: function(){
								                			alert('added!');
								                		},
								                		error: function(){
								                			alert('failure');
								                		}
								                	});
								                });

							                });
					                    }
					                });
								});	
							});
						</script>
						<!-- script -->					 
				 </section>
				 
				 <section  class="sky-form">
					 <h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>DISCOUNTS</h4>
					 <div class="row row1 scroll-pane">
						 <div class="col col-4">
								<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Upto - 10% (20)</label>
						 </div>
						 <div class="col col-4">
								<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>40% - 50% (5)</label>
								<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>30% - 20% (7)</label>
								<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>10% - 5% (2)</label>
								<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Other(50)</label>
						 </div>
					 </div>
				 </section>  				 
				   
				 <section  class="sky-form">
						<h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Price</h4>
							<ul class="dropdown-menu1">
								 <li><a href="">								               
								<div id="slider-range"></div>							
								<input type="text" id="amount" style="border: 0; font-weight: NORMAL;   font-family: 'Dosis-Regular';" />
							 </a></li>			
						  </ul>
				   </section>
				   <!---->
					 <script type="text/javascript" src="js/jquery-ui.min.js"></script>
					 <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
					<script type='text/javascript'>//<![CDATA[ 
					$(window).load(function(){
						var min, max;
					 $( "#slider-range" ).slider({
								range: true,
								min: 0,
								max: 100000,
								values: [ 500, 100000 ],
								slide: function( event, ui )
								{  
									$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
									min = ui.values[0];
									max = ui.values[1];
								}
					 });
					$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );

					});//]]> 

					</script>
					 <!---->
				   <section  class="sky-form">
						<h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Brand</h4>
							<div class="row row1 scroll-pane">
								<div class="col col-4">
								@foreach( $brands as $brand )
									<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>{{ $brand->name }}</label>
								@endforeach
								</div>
							</div>
				   </section>				   
		 		</div>				 
			</div>
		</div>
	</div>

@endsection