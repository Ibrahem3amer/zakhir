@extends('layouts.base')

@section('body')
<div class="main-cont container">
  <div class="col-lg-4 col-md-4 col-sm-12 image-block prod" id="main" style="display: none;">
    <div class="product_other_imgs" style="display: none;">
      <input type="hidden" class="product_images" value="" />
    </div>
    <input type="hidden" value="" class="product_id" />
    <input type="hidden" value="" class="photo_url" />
    <div class="photo-content wow fadeInLeft animated" data-wow-duration="1s" data-wow-delay="1s" style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.3s; animation-name: fadeInLeft;">
      <div class="images" href="product.html" style="background-image: url();"> 
        <div class="overlay">
          <div class="btn-group">
            <a class="fancybox" href="#pop_up_details"><button type="button" class="btn btn-default glyphicon glyphicon-fullscreen"><span>  تفاصيل</span></button>
            </a>
            <a class="grab_info" href="product.html"><button type="button" class="btn btn-default glyphicon glyphicon-star"><span>  حفظ</span></button>
            </a>
          </div>
        </div>      
      </div>
      <div class="product_info">
        <div class="caption"><!-- name-->
          <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
          <a href="#" class="link prt_name">صالة الدخول</a>
        </div>
        <hr />
        <div class="price-info"><!-- price-->
          <div class="product-price">200$</div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="products pull-left col-sm-12 col-md-10 col-lg-10">
      <div class="inner-content">
        <div class="row prods-container">
			@if( isset($results) )
				@foreach( $results as $product )
				  <div class="col-lg-4 col-md-3 col-sm-12 prod">
				    <div class="product_other_imgs" style="display: none;">
				      @if(!empty($product->photos))
				        <?php $images_arr = json_decode($product->photos); ?>
				        @foreach( $images_arr as $image )
				          <input type="hidden" class="product_images" value="{{$image}}" />
				        @endforeach
				      @endif
				    </div>
				    <input type="hidden" value="{{$product->id}}" class="product_id" />
				    <input type="hidden" value="{{$product->photo_url}}" class="photo_url" />
				    <?php $cats = \App\Cat::all(); $prod_cat = $cats->find($product->cat_id)->pluck('name')->first(); ?>
				    <div class="photo-content wow fadeInLeft animated" data-wow-duration="1s" data-wow-delay="1s" style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.3s; animation-name: fadeInLeft;">
				      <div class="images" style="background-image: url({{$product->photo_url}});"> 
				        <div class="overlay">
				          <div class="btn-group">
				            <a class="fancybox grab_info" href="#pop_up_details"><button type="button" class="btn btn-default glyphicon glyphicon-fullscreen"><span>  تفاصيل</span></button>
				            </a>
				            <a class="grab_info" href="product.html"><button type="button" class="btn btn-default glyphicon glyphicon-star"><span>  المفضلة</span></button>
				            </a>
				          </div>
				        </div>      
				      </div>
				      <div class="product_info">
				        <div class="caption"><!-- name-->
				          <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
				          <a class="link product_name">{{ $product->name }}</a>
				        </div>
				        <hr />
				        <div class="price-info"><!-- price-->
				          <div class="product-price product_price">{{$product->price}} <small>ريال</small></div>
				          <span class="info cat_name" style="font-style: italic;"><small>{{$prod_cat}}</small></span>
				          <br>
				          <a href="{{URL::to('/')}}/product/cat/{{$product->cat_id}}" class="icon cat_link">تسوق {{$prod_cat}}</a>
				          <i class="fa fa-angle-left" aria-hidden="true"></i>
				        </div>
				      </div>
				    </div>
				  </div>
				@endforeach
			@endif
        </div>
        <div class="row prods-container">
			<h2 style="margin-right: 20px;">منتجات ذات صلة</h2>
          @if( isset($related) )
            @foreach( $related as $product )
              <div class="col-lg-4 col-md-3 col-sm-12 prod">
                <div class="product_other_imgs" style="display: none;">
                  @if(!empty($product->photos))
                    <?php $images_arr = json_decode($product->photos); ?>
                    @foreach( $images_arr as $image )
                      <input type="hidden" class="product_images" value="{{$image}}" />
                    @endforeach
                  @endif
                </div>
                <input type="hidden" value="{{$product->id}}" class="product_id" />
                <input type="hidden" value="{{$product->photo_url}}" class="photo_url" />
                <?php $cats = \App\Cat::all(); $prod_cat = $cats->find($product->cat_id)->pluck('name')->first(); ?>
                <div class="photo-content wow fadeInLeft animated" data-wow-duration="1s" data-wow-delay="1s" style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.3s; animation-name: fadeInLeft;">
                  <div class="images" style="background-image: url({{$product->photo_url}});"> 
                    <div class="overlay">
                      <div class="btn-group">
                        <a class="fancybox grab_info" href="#pop_up_details"><button type="button" class="btn btn-default glyphicon glyphicon-fullscreen"><span>  تفاصيل</span></button>
                        </a>
                        <a class="grab_info" href="product.html"><button type="button" class="btn btn-default glyphicon glyphicon-star"><span>  المفضلة</span></button>
                        </a>
                      </div>
                    </div>      
                  </div>
                  <div class="product_info">
                    <div class="caption"><!-- name-->
                      <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                      <a class="link product_name">{{ $product->name }}</a>
                    </div>
                    <hr />
                    <div class="price-info"><!-- price-->
                      <div class="product-price product_price">{{$product->price}} <small>ريال</small></div>
                      <span class="info cat_name" style="font-style: italic;"><small>{{$prod_cat}}</small></span>
                      <br>
                      <a href="{{URL::to('/')}}/product/cat/{{$product->cat_id}}" class="icon cat_link">تسوق {{$prod_cat}}</a>
                      <i class="fa fa-angle-left" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          @endif
        </div>
      </div>
    </div>
    <div class="side-menu pull-right col-sm-12 col-md-2 col-lg-2">
      <ul class="main-items">
        <li>
          <h6>الأقسام</h6>
          <hr />
          <ul class="menu-items">
            @foreach( $cats as $cat )
              @if( $cat->parent_id === null )
                <li>
                  <a class="node_name" href="#" value="{{$cat->id}}">{{$cat->name}}</a>
                  @foreach( $cat->children->toArray() as $node )
                    @if( null !== $node )
                    <a class="node_name" href="#" value="{{$node['id']}}">
                      <p></p>
                    </a>
                    <ul class="nested-menu">
                      <li><a href="#" class="node_name" value="{{$node['id']}}"><small>{{ $node['name'] }}</small></a></li>
                    </ul>
                    @endif
                  @endforeach
                </li>
              @endif
            @endforeach
          </ul>
        </li>
        <form action="{{URL::to('/')}}/product/filter">
          <li>
            <h6>السعر</h6>
            <hr />
            <input type="number" name="min" class="min numeric_input" /> -   
            <input type="number" name="max" class="max numeric_input" /> ريال
          </li>
          <li>
            <h6>خيارات الشراء</h6>
            <hr />
            <ul class="menu-items">
              <li>
                <label class="checkbox">
                  <input type="checkbox" name="discount"  />
                  <span class="buying_options">اظهار المنتجات ذات الخصم</span>
                </label>
              </li>
            </ul>
          </li>
          <li>
            <h6>الماركات</h6>
            <hr />
            <ul class="menu-items">
              <li>
                @foreach( $brands as $brand )
                  <label class="checkbox">
                    <input type="checkbox" name="brand[]" value="{{$brand->id}}">
                    <span class="buying_options">{{ $brand->name }}</span>
                  </label>
                @endforeach
              </li>
            </ul>
          </li>
          <button type="submit" class="btn btn-success check">تصفية</button>
        </form>
      </ul>
    </div> 
  </div>  
</div>

<div id="pop_up_details" class="product-pop" style="display: none;">
  <div class="row">
    <div class="product-pop-item">
      <div class="col-lg-8 col-md-8 col-xs-12">
      
        <!-- start slideshow -->
        <div class="product-pop-w3-content" style="">
          <img class="mySlides box_img" src="image/44-min.jpg" style="width:100%">
          <div id="main_pop">
          </div>
          <div class="w3-row-padding w3-section"> 
            <div class="w3-col s4">
              <img class="demo w3-border w3-hover-shadow box_demo" src="image/44-min.jpg" style="width:100%" onclick="currentDiv(1)">
            </div>
            <div id="demo_images"></div>
          </div>
          <div class="product-pop-sharing text-center">
            <ul>
             <li><a href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
             <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
             <li><a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
             <li><a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
            </ul>
          </div>
        </div>
        <!-- end slideshow -->
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-xs-12">
      <div class="product-pop-details">
      </div>
      <div class="pop-price">
        <h4 class="text"></h4>
        <div class="title">
            <h6 class="box_title">نجفة ذات جودة عالية</h6>         
            <div class="star">
                 <i class="fa fa-star" aria-hidden="true"></i>
                 <i class="fa fa-star" aria-hidden="true"></i>
                 <i class="fa fa-star" aria-hidden="true"></i>
                 <i class="fa fa-star" aria-hidden="true"></i>
                 <i class="fa fa-star" aria-hidden="true"></i>
            </div>
        </div>
        <span class="box_price">253</span>
        <div class="clearfix"></div>
        <div class="count">
            <h6 class="quant">الكمية</h6>
            <select name="prod_quantity" class="quan">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10+</option>
            </select>
        </div>
        <div class="panel panel-success">
          <div class="panel-body">
            تمتع بالخصم لفترة محدودة!
          </div>
          <div class="panel-footer">
            تمتع الآن بخصم 10% على هذا المنتج الآن ولفترة محدودة 
            السعر بعد الخصم يصبح: 200 ريال!
          </div>
        </div>
        <div class="card text-center">
            <button type="button" class="btn btn-success to_cart">
            <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
            إضافة إلى السلة</button>
        </div>
      </div>
      <hr>
      <div class="discrip">
        <p> 
            هذا المنتج يشتمل علي العزيز من المميزات يمكنك ان تحصل عليها فور استلامها ونرجو ان يناسب سعادتكم
        </p>
      </div>
    </div>     
  </div>
</div>
<script>
  new WOW().init();
  $(document).ready(function(){
    $('.fancybox').fancybox({
      openEffect  : 'elastic',
      closeEffect : 'elastic',
      helpers : {
        title : {
          type : 'over'
        }
      }
    });
    
    //slider
            var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
      showDivs(slideIndex += n);
    }

    function currentDiv(n) {
      showDivs(slideIndex = n);
    }

    function showDivs(n) {
      var i;
      var x = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("demo");
      if (n > x.length) {slideIndex = 1}
      if (n < 1) {slideIndex = x.length}
      for (i = 0; i < x.length; i++) {
         x[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
         dots[i].className = dots[i].className.replace(" w3-white", "");
      }
      x[slideIndex-1].style.display = "block";
      dots[slideIndex-1].className += " w3-white";
    }
    $('.grab_info').click(function(){
      $('#demo_images').empty();
      $('#main').empty();
      prod = $(this).closest('.prod');
      img = prod.find('.photo_url');
      title = prod.find('.product_name');
      price = prod.find('.product_price');
      box_img = $('.box_img');
      box_img.attr('src', img.val());
      var box_title = $('.box_title');
      var id = prod.find('.product_id').val();
      var i = 2;
      imgs_block = prod.find('.product_other_imgs');
      console.log(imgs_block.children());
      /*prod_imgs = prod.find('.product_other_imgs').find('.product_images');*/
      imgs_block.children().each(function(){
        $('#main').append('<img class="mySlides" src="'+$(this).val()+'" style="width:100%">');
        $('#demo_images').append('<div class="w3-col s4"><img class="demo w3-border w3-hover-shadow" src="'+$(this).val()+'" style="width:100%" onclick="currentDiv('+ i++ +')"></div>');
      });
      box_title.text(title.text());
      box_price = $('.box_price');
      box_price.text(price.text());

      $('.box_demo').attr('src', img.val());
      $('.to_cart').click(function(){
        /*var newURL = window.location.protocol + "//" + window.location.host;
        window.location.href = newURL + '/cart/home';*/
        var prod_quantity = $('.quan').val();
        var user_id = $('.user_id').val();
        $.ajax({
          url: "/public/cart/new?prod_id="+id+"&q="+prod_quantity+"&user="+user_id,
          success: function(){
            alert('تمت إضافة '+box_title.text()+' إلى سلة المشتريات');
          },
          error: function(){
            var newURL = window.location.protocol + "//" + window.location.host;
            window.location.href = newURL + '/public/users/signin';
          }
        });
      });
    });
  });
  $('.node_name').click(function(){
    $('.prods-container').empty();
    id = $(this).attr('value');
    $('#cat_id').attr('value', id);
    $.ajax({
      url:"/public/product/prods?q="+id,
      success:function(prods)
      {
        for (var i = prods.length-1; i >= 0; i--) 
        { 
          var prod = $('#main');
          prod = prod.clone().appendTo('.prods-container');
          var num = 'prod_item'+(i+1);
          prod.addClass(num);
          var prod_id = prod.find('.prod_id');
          prod_id.attr('value', prods[i].id); 
          var anchor = prod.find('.clickable');
          anchor.addClass('grab_info')
          var img_url = prod.find('.images');
          var prod_title = prod.find('.prt_name');
          var prod_price = prod.find('.product-price');
          var urlSyntax = prods[i].photo_url;
          img_url.css('background-image','url('+urlSyntax+')');
          prod_title.text(prods[i].name);
          prod_price.text(prods[i].price+"ريال");
          prod.show();
        }
        $('.fancybox').fancybox({
          openEffect  : 'elastic',
            closeEffect : 'elastic',
            helpers : {
              title : {
                type : 'over'
              }
            }
        });
        $('.grab_info').click(function(){
          $('#demo_images').empty();
          $('#main').empty();
          prod = $(this).closest('.prod');
          img = prod.find('.photo_url');
          title = prod.find('.product_name');
          price = prod.find('.product_price');
          box_img = $('.box_img');
          box_img.attr('src', img.val());
          var box_title = $('.box_title');
          var id = prod.find('.product_id').val();
          var i = 2;
          imgs_block = prod.find('.product_other_imgs');
          console.log(imgs_block.children());
          /*prod_imgs = prod.find('.product_other_imgs').find('.product_images');*/
          imgs_block.children().each(function(){
            $('#main').append('<img class="mySlides" src="'+$(this).val()+'" style="width:100%">');
            $('#demo_images').append('<div class="w3-col s4"><img class="demo w3-border w3-hover-shadow" src="'+$(this).val()+'" style="width:100%" onclick="currentDiv('+ i++ +')"></div>');
          });
          box_title.text(title.text());
          box_price = $('.box_price');
          box_price.text(price.text());

          $('.box_demo').attr('src', img.val());
          $('.to_cart').click(function(){
            /*var newURL = window.location.protocol + "//" + window.location.host;
            window.location.href = newURL + '/cart/home';*/
            var prod_quantity = $('.quan').val();
            var user_id = $('.user_id').val();
            $.ajax({
              url: "/public/cart/new?prod_id="+id+"&q="+prod_quantity+"&user="+user_id,
              success: function(){
                alert('تمت إضافة '+box_title.text()+' إلى سلة المشتريات');
              },
              error: function(){
                var newURL = window.location.protocol + "//" + window.location.host;
                window.location.href = newURL + '/users/signin';
              }
            });
          });
        });
        $('.rating').each(function(){
          var product_id = $(this).closest('#main').find('.prod_id').val();
          var user_id = $('.user_id').val();
          var div = $(this);
          $.ajax({
            url: '/public/product/rating?prod_id='+product_id+'&user_id='+user_id,
            success: function(rating){
              for (var i = 0; i < rating; ++i)
              {
                div.find('.stars').append('<span class="glyphicon glyphicon-star fake"></span>');
              }
            },
          });
        });
      }
    });
  });  
</script>
@endsection