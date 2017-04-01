@extends('layouts.base')

@section('body')
    @if( !isset($error) )
      <?php $error = "home"; ?>
    @endif
    @if( "home" === $error )
      
    @elseif( "" !== $error )
      <div class="alert alert-danger">{{$error}}</div>
    @else
      <div class="alert alert-success">You've Successfully completed your order! Thanks for using Zakhir.</div>
    @endif
      <?php $products = \App\Product::all()->sortByDesc('created_at')->slice(0, 12); ?>
      <div class="row">
        @foreach( $products->slice(0, 6) as $product)
          <div class="col-lg-4 col-md-3 col-sm-12 prod">
            <div class="product_other_imgs" style="display: none;">
              @if(!empty($product->photos))
                <?php $images_arr = json_decode($product->photos); ?>
                @foreach( $images_arr as $image )
                  <input type="hidden" class="product_images" value="{{$image}}" />
                @endforeach
              @endif
            </div>
            <?php 
              $sizes=''; 
              $colors='';
              if(!empty($product->size))
              { 
                $sizes = json_decode($product->size, true); 
                foreach( $sizes as $size=>$value ){
                  echo '<input type="hidden" name="'.$size.'" value="'.$value.'" class="sizes_menu" />'; 
                }
              }
              if(!empty($product->color))
              { 
                $colors = json_decode($product->color, true);
                foreach( $colors as $color)
                {
                  echo '<input type="hidden" name="'.$color.'" value="'.$color.'" class="colors_menu" />';
                }
              }
            ?>
            <input type="hidden" value="{{$product->id}}" class="product_id" />
            <input type="hidden" value="{{$product->photo_url}}" class="photo_url" />
            <input type="hidden" value="{{$product->has_sale}}" class="product_sale" />
            <input type="hidden" value="{{$product->description}}" class="product_description" />

            <?php $cats = \App\Cat::all(); $prod_cat = $cats->find($product->cat_id)->pluck('name')->first(); ?>
            <div class="photo-content wow fadeInLeft animated" data-wow-duration="1s" data-wow-delay="1s" style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.3s; animation-name: fadeInLeft;">
              <div class="images" style="background-image: url({{$product->photo_url}});"> 
                <div class="overlay">
                  <div class="btn-group">
                    <a class="fancybox grab_info" href="#pop_up_details"><button type="button" class="btn btn-default glyphicon glyphicon-fullscreen"><span>  تفاصيل</span></button>
                    </a>
                    <a class="grab_info" href="#"><button type="button" class="btn btn-default glyphicon glyphicon-star"><span>  حفظ</span></button>
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
      </div>
      <div class="row">
        <div class="photos-slider">
          <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1"></li>
              <li data-target="#myCarousel" data-slide-to="2"></li>
              <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
              <?php $photos = \App\Photo::all()->sortByDesc('created_at')->slice(0, 4); $i=1 ?>
              @foreach( $photos as $photo )
              <div class="item {{$i++==1?'active':''}}">
                <a href="{{URL::to('/')}}/media/mediahome">
                  <img src="{{$photo->photo_url}}" alt="{{$photo->title}}" class="img-responsive">
                </a>
              </div>
              @endforeach
            </div>
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>
      <div class="row">
        @foreach( $products->slice(6) as $product)
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
                    <a class="grab_info" href="#"><button type="button" class="btn btn-default glyphicon glyphicon-star"><span>  حفظ</span></button>
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
      </div>

      <div id="pop_up_details" class="product-pop" style="display: none;">
        <div class="row">
          <div class="product-pop-item">
            <div class="col-lg-8 col-md-8 col-xs-12">
            
              <!-- start slideshow -->
              <div class="product-pop-w3-content" style="">
                <img class="mySlides box_img" src="image/44-min.jpg" style="width:100%">
                <div id="main">
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
                  <select name="prod_quantity" class="quan" style="padding: 5px;">
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
              <div class="size_color">
                <div class="size">
                  <label>الحجم 
                  </label>
                  <select name="size" class="size_menu" style="width: 100%; padding: 5px;">
                  </select>
                  <br />
                  <small style="font-size: 10px"><i>لكل حجم قيمة إضافية تضاف للسعر</i></small>
                </div>
                <div class="color">
                  <label>اللون 
                  </label>
                  <select name="color" class="color_menu" style="width: 100%; padding: 5px;">
                  </select>
                  <br />
                  <small style="font-size: 10px"><i>لا يؤثر اختيار اللون على السعر المعروض</i></small>
                </div>
              </div>
              <div class="panel panel-success has_sale" style="display: none;">
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
            <div>
              <p class="discrip"> 
                  هذا المنتج يشتمل علي العزيز من المميزات يمكنك ان تحصل عليها فور استلامها ونرجو ان يناسب سعادتكم
              </p>
            </div>
          </div>     
        </div>
      </div>

      <script>
        new WOW().init();
      </script>


      <script>
         
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
            $('.has_sale').hide();
            $('.size_menu').empty();
            $('#demo_images').empty();
            $('#main').empty();
            prod = $(this).closest('.prod');
            $('.discrip').text(prod.find('.product_description').val());
            prod.find('.sizes_menu').each(function (i, item) {
                $('.size_menu').append($('<option>', { 
                    value: item.value,
                    text : item.name 
                }));
            });
            prod.find('.colors_menu').each(function (i, item) {
                $('.color_menu').append($('<option>', { 
                    value: item.value,
                    text : item.name,
                    style: 'background-color:#'+item.value+';',
                }));
            });
            img = prod.find('.photo_url');
            title = prod.find('.product_name');
            var price = parseInt(prod.find('.product_price').text());
            var sale = prod.find('.product_sale').val();
            if( sale > 0 )
            {
              $('.has_sale').show();
              price = price-price*sale/100;
              text = $('.has_sale').find('.panel-footer');
              text.text('تمتع الآن بخصم '+sale+'% على هذا المنتج الآن ولفترة محدودة السعر بعد الخصم يصبح: '+price+' ريال!');
            }
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
            box_price.text(price+' ريال');

            $('.box_demo').attr('src', img.val());
            $('.to_cart').click(function(){
              /*var newURL = window.location.protocol + "//" + window.location.host;
              window.location.href = newURL + '/cart/home';*/
              var prod_quantity = $('.quan').val();
              var user_id = $('.user_id').val();
              size_name = $('.size_menu').find(":selected").text();
              size_value = $('.size_menu').find(":selected").val();
              var size = size_name+'_'+size_value;
              console.log(size);
              var color = $('.color_menu').val();
              $.ajax({
                url: "/public/cart/new?prod_id="+id+"&q="+prod_quantity+"&user="+user_id+"&size="+size+"&color='"+color+"'",
                success: function(){
                  alert('تمت إضافة'+' '+box_title.text()+' '+'إلى سلة المشتريات');
                },
                error: function(){
                  var newURL = window.location.protocol + "//" + window.location.host;
                  window.location.href = newURL + '/public/users/signin';
                }
              });
            });
          });
      </script>
@endsection