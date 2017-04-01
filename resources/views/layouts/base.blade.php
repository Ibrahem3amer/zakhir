<!DOCTYPE html>
  <html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/animate.css">
        <link rel="stylesheet" href="/css/font-awesome.min.css">
        <link rel="stylesheet" href="/css/jquery.fancybox.css">
        <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/css/cat.css">
        <link rel="stylesheet" href="/css/product.css">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
        <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/jquery.fancybox.js"></script>
        <script src="/js/plug.js"></script>
        <script src="/js/wow.min.js"></script>
        <script type="text/javascript">
                $(document).ready(function () {
                  $('#tags').keypress(function(){
                    var value = $(this).val();
                    $.ajax({
                      url: '/public/users/search?query'+value,
                      success: function(results)
                      {
                        $( "#tags" ).autocomplete({
                          source: results
                          });
                      },
                    });
                  });
                });
        </script>
        <title>Home page</title>
    </head>
    <body>
        <!---- nav search ------>
        <div class="zakher-search">
          <div class="container">
               <div class="row">
                   <div class="col-sm-12 col-md-2 col-lg-2 zakhir-logo">
                       <a href="{{URL::to('/')}}"><img src="/image/Zakhir_ar_ok.jpg" width="100px;" class="img-responsive"></a>
                   </div>
                   <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                       
                      <div id="custom-search-input">
                          <div class="input-group col-md-12">
                              <form action="/public/users/search" method="post">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <input type="text" id="tags" placeholder="ابحث عن منتجاتك" class="form-control" name="search_query" />
                              </form>
                          </div>
                      </div>
                   </div>
                  <div class="col-lg-4 col-md-4 col-sm-12 cart_sign">
                    @if( \Auth::check())
                    <input type="hidden" name="user_id" class="user_id" value="{{\Auth::user()->id}}" />
                    <div class="cart">
                      <?php $cart = \App\Cart::where('user_id', \Auth::user()->id)->where('active', 1)->where('wishlist', '0')->get(); ?>
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="fa fa-cart-arrow-down" aria-hidden="true" style="font-size: 25px;"></span> 
                      </a>
                      <ul class="dropdown-menu products-menu">
                        @foreach( $cart as $product )
                          <li class="product-in-menu">
                            <?php $product = \App\Product::find($product->product_id);?>
                            <img src="{{ $product->photo_url }}" width="50px" height="50px">
                            <span>{{ $product->name }}</span>
                          </li>
                          <div class="clearfix"></div>
                        @endforeach
                        <hr />
                        <li><a href="{{ URL::to('/') }}/order/home">انهاء الطلب</a></li>
                        <li><a href="{{ URL::to('/') }}/order/track">تابع طلباتك</a></li>
                      </ul>
                    </div>
                    @endif

                   
                     <div class="sign">
                        @if( !\Auth::check())
                        <a href="{{ URL::to('/') }}/users/signin">تسجيل الدخول</a>
                        <a href="{{ URL::to('/') }}/users/signup">تسجيل حساب جديد</a>
                        @else
                        <!--When signed in--> 
                        <div class="user-data">
                          <a class="dropdown-toggle user-name-menu" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                          <span aria-hidden="true">{{\Auth::user()->name}}</span> 
                          </a>
                          <ul class="dropdown-menu user-menu" style="float: right; margin-left: 135px;">
                            <li><a href="#">تعديل البيانات</a></li>
                            <li><a href="{{ URL::to('/') }}/cart/home">سلة الشراء</a></li>
                            <li><a href="{{ URL::to('/') }}/cart/wishlist">قائمة الأمنيات</a></li>
                            <li><a href="{{ URL::to('/') }}/users/signout">تسجيل الخروج</a></li>
                          </ul>
                        </div>
                        @endif
                      </div>

                  </div> 
                   
               </div>
          </div>
          <?php $nav = (array)\DB::table('ui')->where('role', 'nav')->get(); ?>
          <nav class="navbar navbar-default" id="navbar">
              <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav navbar-right">
                    @foreach( $nav as $element )
                    <li>
                      <a href="{{ URL::to($element->link) }}" role="button">
                         <span class="glyphicon glyphicon-list"><span class="nav-items-font"> {{$element->placeholder}} </span></span>
                      </a>
                    </li>
                    @endforeach
                    <?php $categories = \App\Cat::all(); ?>
                    <li role="presentation" class="dropdown">
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                         <span class="glyphicon glyphicon-shopping-cart"><span class="nav-items-font"> المنتجات </span></span>
                      </a>
                      <ul class="dropdown-menu">
                        @foreach( $categories as $cat )
                          @if( $cat->parent_id ==null )
	                          <li>
	                            <a href="{{ URL::to('/') }}/product/cat/{{ $cat->id }}" class="fa fa-hand-o-left"> <span class="nav-items-font"> {{ $cat->name }}</span>
	                            </a>
                            	<?php $subcats = \App\Cat::where('parent_id', $cat->id)->get(); ?>
                            	@foreach( $subcats as $sub )
                           		<a href="{{ URL::to('/') }}/product/cat/{{ $sub->id }}" class="fa fa-hand-o-left" style="font-style: italic; color: #3d8901;"> <span class="nav-items-font"> {{ $sub->name }}</span>
                            		</a>
                            	@endforeach
	                          </li>
	                   @endif
                        @endforeach
                      </ul>
                    </li>
                    <?php $albums = \App\Album::all(); ?>
                    <li role="presentation" class="dropdown">
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                      <span class="glyphicon glyphicon-camera"><span class="nav-items-font"> ألبوم الصور </span> 
                      </a>
                      <ul class="dropdown-menu">
                        @foreach( $albums as $cat )
                          <li>
                            <a href="{{ URL::to('/') }}/media/album/{{ $cat->id }}" class="fa fa-hand-o-left"> <span class="nav-items-font"> {{ $cat->name }}</span>
                            </a>
                          </li>
                        @endforeach
                      </ul>
                    </li>
                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
          </nav>  
        </div>
        <div class="search-mobile hidden-md hidden-lg hidden-sm">
          <div class="container">
            <form action="/users/search" method="post">
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
              <input type="text" id="tags" placeholder="ابحث عن منتجاتك" class="form-control" name="search_query" />
            </form>
            <div class="list-group">
              <a class="list-group-item active">
                قائمة العميل
              </a>
              <a href="#" class="list-group-item">المفضلة</a>
              <a href="#" class="list-group-item">تعديل بياناتي</a>
              <a href="#" class="list-group-item">أوردراتي</a>
              <a href="#" class="list-group-item">سلة المشتريات</a>
              <a href="#" class="list-group-item">قائمة الأمنيات</a>
              <a href="#" class="list-group-item">تسجيل الخروج</a>
            </div>
          </div>
        </div>
        <!---- nav search ------>
        <!--- photo ---->
        <div class="photo">
            <div class="container">
              @yield('body')
              <div class="footer">
                 <div class="container">
                     <div class="row">
                         <div class="col-lg-9 col-md-9 col-sm-12">
                             <ul class="foot-list">
                                     <li><a href="#">الرئيسية</a></li>
                                     <li><a href="#">فريق العمل</a></li>
                                     <li><a href="#">عن زاخر</a></li>
                                     <li><a href="#">المنتجات</a></li>
                                     <li><a href="#">إتصل بنا</a></li>
                             </ul>
                         </div>
                         <br />
                         <h6 class="copyrights"><a href="http://www.ibrahem3amer.com">Ibrahem A'mer</a> | Full-stack developer</h6>
                     </div>
                 </div>
              </div>
            </div>
        
    </body>
  </html>