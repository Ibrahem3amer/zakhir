@extends('layouts.base')

@section('body')
	<div class="product-model">	 
		<div class="container page-container">
			<ol class="breadcrumb">
			  <li><a href="{{URL::to('/')}}">Home</a></li>
			  <li class="active">Products</li>
		 	</ol>
			<h2 class="target">Photo album</h2>	
			<div class="photo_item">
			 	<div class="col-md-9 product-model-sec pull-right">
			 		<a href="single.html">
					 	<div class="product-grid">
						<div class="more-product"><span></span></div>						
						<div class="product-img b-link-stripe b-animate-go  thickbox">
							<img src="{{ URL::to('/') }}/img/p1.jpg" class="img-responsive photo-url" alt="">
						</div>
					</a>						
					<div class="product-info simpleCart_shelfItem">
						<div class="product-info-cust prt_name">
							<h3></h3>							
						</div>						
					</div>
				</div>	
				<div class="author-info">
					<h1 class="photo-title">Image title</h1>
					<div class="rating">
						<span class="glyphicon glyphicon-star"></span>
						<span class="glyphicon glyphicon-star"></span>
						<span class="glyphicon glyphicon-star"></span>
						<span class="glyphicon glyphicon-star fake"></span>
						<span class="glyphicon glyphicon-star fake"></span>

					</div>
					<p class="photo-description">
						Rule Your Incidents, Changes & Problems. Trusted By 10,000+ IT Teams! Try For Free Today.Rule Your Incidents, Changes & Problems. Trusted By 10,000+ IT Teams! Try For Free Today.
					</p>
					<small class="glyphicon glyphicon-eye-open photo-views"> 1250 views</small>
					<p></p>
					<div class="social-photo">
						<a href="#"><span class="fa fa-facebook"></a>&nbsp&nbsp</span>
						<a href="#"><span class="fa fa-twitter"></a>&nbsp&nbsp</span>
						<a href="#"><span class="fa fa-google-plus"></a>&nbsp&nbsp</span>
						<a href="#"><span class="fa fa-share-square-o"></a>&nbsp&nbsp</span>
					</div>
				</div>
				</div>
			</div>		
			<div class="imgs-container">

			</div>
				<div class="rsidebar span_1_of_left">
					 <section  class="sky-form">
						 <div class="product_right">
							 <h4 class="m_2"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Categories</h4>
							 <?php $i = 1; ?>
							 @foreach( $cats as $cat )
							 <div class="tab{{ $i++ }}">
								 <ul class="place">								
									 <li class="sort">{{ $cat->name }}</li>
									 <li class="by"><img src="{{ URL::to('/') }}/img/do.png" alt=""></li>
										<div class="clearfix"> </div>
								  </ul>								  
							 	<div class="single-bottom">
							 	@foreach( $cat->albums->toArray() as $album )
							 		@if( null !== $album )
									<a class="album_name" href="#" value="{{$album['id']}}">
										<p>{{ $album['name'] }}</p>
									</a>
									@endif
								@endforeach
						     	</div>
						      </div>
						      @endforeach						 
							
							  <!--script-->
							<script>
								$(document).ready(function(){
									$('.photo_item').hide();
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

									$('.album_name').click(function(){
										$('.imgs-container').empty();
										id = $(this).attr('value');
						                $.ajax({
						                    url:"/public/media/albums?q="+id,
						                    success:function(photos)
						                    {
						                    	for (var i = photos.length-1; i >= 0; i--) 
						                    	{	
						                    		var img = $('.photo_item');
						                    		img = img.clone().appendTo('.imgs-container');
						                    		var num = 'photo_item'+(i+1);
						                    		img.attr('class', num);
						                    		var img_url = img.find('.photo-url');
						                    		var img_title = img.find('.photo-title');
						                    		var img_des = img.find('.photo-description');
						                    		var urlSyntax = "{{ URL::to('/') }}"+photos[i].photo_url;
						                    		img_url.attr('src', urlSyntax);
						                    		img_title.text(photos[i].title);
						                    		var boxElement = img.find('.box');
						                    		boxElement.attr('href', urlSyntax);
						                    		boxElement.attr('title', photos[i].description);
						                    		boxElement.addClass('fancybox');
						                    		/*img.childern('.product-model-sec').removeClass('pull-right');*/
						                    		img.fadeIn();

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
						                    }
						                });
									});
							});
							</script>
							<!-- script -->					 
					 </section>				 			   
				 </div>				 
		      </div>
		</div>
	</div>
@endsection