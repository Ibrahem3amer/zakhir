<!DOCTYPE html>
<html>
	<head>
		<title>Zakhir</title>
		<link rel="stylesheet" type="text/css" href="/css/product.css">
		<link rel="stylesheet" type="text/css" href="/css/style.css">
		<link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="/css/font-awesome.css">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<link rel="stylesheet" href="/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="/deso/jquery.desoslide.css" />
        <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
        <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script type="text/javascript" src="/fancybox/jquery.fancybox.pack.js"></script>
        <script type="text/javascript" src="/deso/jquery.desoslide.min.js"></script>
        <script type="text/javascript" src="/js/bootstrap.min.js"></script>
		<script type="text/javascript">
			function addEventListenerList(list) {
			    for (var i = 0, len = list.length; i < len; i++) {
			        list[i].addEventListener('click', function(){
			        	document.getElementById('myframe').style.visibility = "visible";
			        	window.location.hash = '#myframe';
			        });
			    }
			}

			function display_details() {
				/*var btn = getElementById('right');
				btn.addEventListener('click', function (e) {
				    /*var d = window.parent.document;
				    var frame = d.getElementById('myframe');
				    frame.parentNode.removeChild(frame);
				    e.preventDefault();
				    alert('gaga');
				});*/
				var nodes = document.getElementsByClassName('right-item-btn');
				addEventListenerList(nodes);

				document.getElementById('close-btn').addEventListener("click", function(){
					document.getElementById('myframe').style.visibility = "hidden";
				});
			}

			$(document).ready(function () {
                res = [
                  "ActionScript",
                  "AppleScript",
                  "Asp",
                  "BASIC",
                  "C",
                  "C++",
                  "Clojure",
                  "COBOL",
                  "ColdFusion",
                  "Erlang",
                  "Fortran",
                  "Groovy",
                  "Haskell",
                  "Java",
                  "JavaScript",
                  "Lisp",
                  "Perl",
                  "PHP",
                  "Python",
                  "Ruby",
                  "Scala",
                  "Scheme"
                ];
				$( "#tags" ).autocomplete({
                        source: res
              	});
			});


		</script>
	</head>
	<body onload="display_details()">
		<div id="wrapper">
			<div class="container upper-header">
				<header>
					<div class="row">
						<div class="col-sm-12 col-md-2 col-lg-2">
							<img src="/img/Zakhir_ar_ok.jpg" width="100px" height="100px" class="">
						</div>
						<div class="col-sm-12 col-md-5 col-lg-5">
							<form>
								<input type="text" id="tags" placeholder="search" class="form-control" />
							</form>
						</div>
						<div class="col-sm-12 col-md-5 col-lg-5">
							<div id="client_data">
								<ul class="nav nav-pills">
									<div id="cart" class="col-sm-6 col-md-2 col-lg-2">
									  <li role="presentation" class="dropdown">
									    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
									     <span> Cart </span>
									    </a>
									    <ul class="dropdown-menu">
									    </ul>
									  </li>
									</div>
									@if( \Auth::user())
										<div id="profile" class="col-sm-6 col-md-2 col-lg-2">
											<li role="presentation" class="dropdown">
											    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
											     <span> Profile </span>
											    </a>
											    <ul class="dropdown-menu">
													<h4>welcome {!! \Auth::user()->name !!} </h4>
													<button value="{!! \Auth::logout() !!}">Logout</button>
											    </ul>
											  </li>
										</div>
									@endif
								</ul> 
							</div>
						</div>
					</div>
					<br />
					<div class="row">
						<ul class="nav nav-pills">
						  <li role="presentation" class="dropdown">
						    <a class="dropdown-toggle" data-toggle="dropdown" href="/about" role="button" aria-haspopup="true" aria-expanded="false">
						     <span class="glyphicon glyphicon-list"> About </span>
						    </a>
						    <ul class="dropdown-menu">
						    	<li><a href="{{ URL::to('/') }}/pages/team" class="fa fa-hand-o-right"> About us</a></li>
						    	<li><a href="{{ URL::to('/') }}/pages/team" class="fa fa-hand-o-right"> Team</a></li>
						    	<li><a href="{{ URL::to('/') }}/pages/team" class="fa fa-hand-o-right"> Why us</a></li>
						    </ul>
						  </li>
						  <?php $categories = \App\Cat::all(); ?>
						  <li role="presentation" class="dropdown">
						    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
						     <span class="glyphicon glyphicon-shopping-cart"> Shop </span>
						    </a>
						    <ul class="dropdown-menu">
						    	@foreach( $categories as $cat )
						    		<li>
							    		<a href="{{ URL::to('/') }}/product/cat/{{ $cat->id }}" class="fa fa-hand-o-right"> {{ $cat->name }}
							    		</a>
							    	</li>
							    @endforeach
						    </ul>
						  </li>
						  <?php $albums = \App\Album::all(); ?>
						  <li role="presentation" class="dropdown">
						    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
						     <span class="glyphicon glyphicon-camera"> Photos </span>
						    </a>
						    <ul class="dropdown-menu">
						    	@foreach( $albums as $cat )
						    		<li>
							    		<a href="{{ URL::to('/') }}/media/album/{{ $cat->id }}" class="fa fa-hand-o-right"> {{ $cat->name }}
							    		</a>
							    	</li>
							    @endforeach
						    </ul>
						  </li>
						</ul>
					</div>
				</header>	
			</div>	
			<br /> 
			<div class="container">
				@yield('body')	
			</div>
			<footer>
				<P>All rights reserved</P>
			</footer>

		</div>
	</body>
</html>