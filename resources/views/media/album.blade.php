@extends('layouts.base')

@section('body')
<div class="main-cont container">
  <div id="main" style="display: none;">
    <div class="col-md-9 col-lg-9 image-block prod">
      <input type="hidden" value="" class="product_id" />
      <input type="hidden" value="" class="photo_url" />
      <div class="photo-content wow fadeInLeft animated" data-wow-duration="1s" data-wow-delay="1s" style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.3s; animation-name: fadeInLeft;">
        <div class="images" href="product.html" style="background-image: url();"> 
          <div class="overlay">
            <div class="btn-group">
              <a class="single_4" href="" title="">
              <button type="button" class="btn btn-default glyphicon glyphicon-fullscreen"><span>  تفاصيل</span></button>
              </a>
              <a class="grab_info" href="product.html"><button type="button" class="btn btn-default glyphicon glyphicon-star"><span>  حفظ</span></button>
              </a>
            </div>
          </div>      
        </div>
      </div>
    </div>
    <div class="product_info img-info">
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
  <div class="row">
    <div class="products pull-left col-sm-12 col-md-10 col-lg-10">
      <div class="inner-content">
        <div class="row imgs-container">
          @if( isset($photos) )
            @foreach( $photos as $photo )
              <div class="col-md-9 col-lg-9 prod">
                <input type="hidden" value="{{$photo->id}}" class="product_id" />
                <input type="hidden" value="{{$photo->photo_url}}" class="photo_url" />
                <?php $cats = \App\Album::all(); $prod_cat = $cats->find($photo->album_id)->pluck('name')->first(); ?>
                <div class="photo-content wow fadeInLeft animated" data-wow-duration="1s" data-wow-delay="1s" style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.3s; animation-name: fadeInLeft;">
                  <div class="images" style="background-image: url({{$photo->photo_url}});"> 
                    <div class="overlay">
                      <div class="btn-group">
                        <a class="single_4" href="{{$photo->photo_url}}" title="{{$photo->title}}">
                        <button type="button" class="btn btn-default glyphicon glyphicon-fullscreen"><span>  تفاصيل</span></button>
                        </a>
                        <a class="grab_info" href="product.html"><button type="button" class="btn btn-default glyphicon glyphicon-star"><span>  حفظ</span></button>
                        </a>
                      </div>
                    </div>      
                  </div>
                </div>
              </div>
              <div class="product_info img-info">
                <div class="caption"><!-- name-->
                  <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                  <a class="link product_name">{{ $photo->title }}</a>
                </div>
                <hr />
                <div class="price-info"><!-- price-->
                  <div class="product-price product_price">{{$photo->description}}</div>
                  <span class="info cat_name" style="font-style: italic;"><small>{{$prod_cat}}</small></span>
                  <br>
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
          <h6>الألبومات</h6>
          <hr />
          <ul class="menu-items">
            <?php $cats = \App\Cat::all(); ?>
            @foreach( $cats as $cat )
              <li>
                {{$cat->name}}
                @foreach( $cat->albums->toArray() as $album )
                  @if( null !== $album )
                    <ul class="nested-menu">
                      <li>
                        <a class="album_name" href="#" value="{{$album['id']}}">
                          <p>{{$album['name']}}</p>
                        </a>
                      </li>
                    </ul>
                  @endif
                @endforeach
              </li>
            @endforeach
          </ul>
        </li>
      </ul>
    </div> 
  </div>  
</div>

<div id="pop_up_details" class="product-pop" style="display: none;">
  <div class="row">
    <div class="product-pop-item">
      <div class="col-lg-12 col-md-12 col-xs-12">
        <img class="box_img" src="image/44-min.jpg" style="width:100%">
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
  </div>
</div>   
<script>
  new WOW().init();
  $(document).ready(function(){
    $(".single_4").fancybox({
      openEffect  : 'elastic',
      closeEffect : 'elastic',
      helpers : {
        title : {
          type : 'over'
        }
      }
    });
    $('.fancybox').fancybox({
      openEffect  : 'elastic',
      closeEffect : 'elastic',
      helpers : {
        title : {
          type : 'over'
        }
      }
    });
    $('.album_name').click(function(){
      $('.imgs-container').empty();
      id = $(this).attr('value');
      $.ajax({
          url:"/public/media/albums?q="+id,
          success:function(photos)
          {
            for (var i = photos.length-1; i >= 0; i--) 
            { 
              var img = $('#main');
              img = img.clone().appendTo('.imgs-container');
              var anchor = img.find('.single_4');
              anchor.attr('href', photos[i].photo_url);
              anchor.attr('title', photos[i].title);
              var img_url = img.find('.images');
              var prod_title = img.find('.prt_name');
              var prod_price = img.find('.product-price');
              var urlSyntax = photos[i].photo_url;
              img_url.css('background-image','url('+urlSyntax+')');
              prod_title.text(photos[i].title);
              prod_price.text(photos[i].description);
              img.show();

            }
            $(".single_4").fancybox({
              openEffect  : 'elastic',
              closeEffect : 'elastic',
              helpers : {
                title : {
                  type : 'over'
                }
              }
            });
          }
      });
    }); 
    $('.grab_info').click(function(){
      prod = $(this).closest('.prod');
      img = prod.find('.photo_url');
      title = prod.find('.product_name');
      price = prod.find('.product_price');
      box_img = $('.box_img');
      box_img.attr('src', img.val());
      var box_title = $('.box_title');
      box_title.text(title.text());
    });
  });
 
</script>
@endsection