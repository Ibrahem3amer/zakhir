<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin panel</title>
    <link href="/admin_files/css/bootstrap.min.css" rel="stylesheet">
    <link href="/admin_files/css/icon.css" rel="stylesheet">
    <link href="/admin_files/css/style.css" rel="stylesheet">
    <link href="/admin_files/css/ar.css" rel="stylesheet" class="lang_css arabic">
    <link rel="stylesheet" href="/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
    <script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body>
    <div class="container-fluid">
        <!--Start header-->
        <div class="row header_section">
            <div class="col-sm-3 col-xs-12 logo_area bring_right">
                <h1 class="inline-block"><img src="img/logo.png" alt="">لوحة تحكم زاخر</h1>
                <span class="glyphicon glyphicon-align-justify bring_left open_close_menu" data-toggle="tooltip"
                      data-placement="right" title="إغلاق/فتح القائمة"></span>
            </div>
            <div class="col-sm-3 col-xs-12 head_buttons_area bring_right hidden-xs">
                <div class="inline-block messages bring_right">
                    <span class="glyphicon glyphicon-envelope" data-toggle="tooltip" data-placement="left"
                          title="الرسائل"><span class="notifications">0</span></span>
                </div>
                <div class="inline-block full_screen bring_right hidden-xs">
                    <span class="glyphicon glyphicon-fullscreen" data-toggle="tooltip" data-placement="left"
                          title="شاشة كاملة"></span>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12 user_header_area bring_left left_text">

                <div class="user_info inline-block">
                    <img src="img/user.jpg" alt="" class="img-circle">
                    <span class="h4 user_name">{{\Auth::user()->name}}</span>
                </div>
            </div>
        </div>
        <!--/End header-->

        <!--Start body container section-->
        <div class="row container_section">

            <!--Start left sidebar-->
            <!--/End left sidebar-->

            <!--Start Side bar main menu-->
            <div class="main_sidebar bring_right">
                <div class="main_sidebar_wrapper">

                    <ul>
                        <li><span class="glyphicon glyphicon-home"></span><a href="{{ URL::to('/') }}/admin/dashboard">الصفحة الرئيسية</a></li>
                        <li><span class="glyphicon glyphicon-object-align-right"></span><a href="">إدارة الأقسام</a>
                            <ul class="drop_main_menu">
                                <li><a href="{{ URL::to('/') }}/admin/addcat">إضافة قسم</a></li>
                                <li><a href="{{ URL::to('/') }}/admin/allcats">عرض الأقسام</a></li>
                            </ul>
                        </li>
                        <li><span class="glyphicon glyphicon-gift"></span><a href="">إدارة المنتجات</a>
                            <ul class="drop_main_menu">
                                <li><a href="{{ URL::to('/') }}/admin/addprod">إضافة منتج</a></li>
                                <li><a href="{{ URL::to('/') }}/admin/allprods">عرض المنتجات</a></li>
                            </ul>
                        </li>
                        <li><span class="glyphicon glyphicon-file"></span><a href="">إدارة الصفحات</a>
                            <ul class="drop_main_menu">
                                <li><a href="{{ URL::to('/') }}/admin/addpage">إضافة صفحة</a></li>
                                <li><a href="{{ URL::to('/') }}/admin/allpages">عرض الكل</a></li>
                            </ul>
                        </li>
                        <li><span class="glyphicon glyphicon-user"></span><a href="">إدارة الاعضاء</a>
                            <ul class="drop_main_menu">
                                <li><a href="{{ URL::to('/') }}/admin/adduser">إضافة جديد</a></li>
                                <li><a href="{{ URL::to('/') }}/admin/allusers">عرض الكل</a></li>
                            </ul>
                        </li>
                        <li><span class="glyphicon glyphicon-shopping-cart"></span><a href="">طلبات الشراء</a>
                            <ul class="drop_main_menu">
                                <li><a href="{{ URL::to('/') }}/admin/stats">احصائيات المبيعات</a></li>
                                <li><a href="{{ URL::to('/') }}/admin/orders">جميع الطلبات</a></li>
                            </ul>
                        </li>
                        <li><span class="glyphicon glyphicon-picture"></span><a href="">البوم الصور</a>
                            <ul class="drop_main_menu">
                                <li><a href="{{ URL::to('/') }}/admin/addalbum">إضافة جديد</a></li>
                                <li><a href="{{ URL::to('/') }}/admin/allalbums">عرض الكل</a></li>
                            </ul>
                        </li>
                        <li><span class="glyphicon glyphicon-eye-open"></span><a href="{{ URL::to('/') }}/admin/ui">الواجهة الرئيسية</a></li>
                        <li><span class="glyphicon glyphicon-cog"></span><a href="{{ URL::to('/') }}/admin/dashboard">إعدادات عامة</a></li>
                    </ul>
                </div>
            </div>
            <!--/End side bar main menu-->

            <!--Start Main content container-->
            <div class="main_content_container">
                <div class="main_container  main_menu_open">
                    @yield('content')
                </div>
                <!--/End Main content container-->


            </div>
            <!--/End body container section-->
        </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="/admin_files/js/jquery-2.1.4.min.js"></script>
    <script src="/admin_files/jsbootstrap.min.js"></script>
    <script src="/admin_files/js/js.js"></script>
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="/fancybox/jquery.fancybox.pack.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#pr_pick').append($('.img_url').attr('src'));
            $(".various").fancybox();
            $('.various').click(function(){

            });
            $('.album').click(function(){
                var id = $(this).attr('value');
                $.ajax({
                    url:"/public/media/photos?q="+id,
                    success:function(photos)
                    {
                        $('.photos').fadeIn();
                        var thumb = $('#photos').find('.thumbnail');
                        for (var i = photos.length-1; i >= 0; i--) 
                        {   
                            thumb = thumb.clone().appendTo('.span_target');
                            var img_url = thumb.find('.img_url');
                            var urlSyntax = "{{ URL::to('/') }}"+photos[i].photo_url;
                            img_url.attr('src', urlSyntax);
                            thumb.show();
                        }
                        var photo_url = $('.get_url');
                        photo_url.click(function(){
                            var urlToInput = $(this).find('.img_url').attr('src');
                            $('.picker').attr('value', urlToInput);
                            $('#pr_pick').empty();
                            $('#pr_pick').append(urlToInput);
                            if($('#btn_sec').find('.sec_input').val() == ""){
                                $('#btn_sec').find('.sec_input').val(urlToInput);
                            }
                            $('.prod_photo').val(urlToInput);
                            $('.upload_btn').hide();
                            $.fancybox.close();
                            $('.span_target').empty();
                        });
                    }
                });
            });
            var urls = [];
            $('.sec').click(function(){
                var id = $(this).attr('value');
                $.ajax({
                    url:"/public/media/photos?q="+id,
                    success:function(photos)
                    {   
                        $('.photos').show();
                        var thumb = $('#photos').find('.thumbnail');
                        for (var i = photos.length-1; i >= 0; i--) 
                        {   
                            thumb = thumb.clone().appendTo('.span_target');
                            var img_url = thumb.find('.img_url');
                            var urlSyntax = "{{ URL::to('/') }}"+photos[i].photo_url;
                            img_url.attr('src', urlSyntax);
                            thumb.show();
                        }
                        var photo_url = $('.get_url');
                        photo_url.click(function(){
                            var urlToInput = $(this).find('.img_url').attr('src');
                            urls.push(urlToInput);
                            $('.secondary').append("<h5 >"+urlToInput+"</h5>");
                            $.fancybox.close();
                            $('.span_target').empty();
                            $('#array').text(urls);
                        });
                    }
                });
            }); 
            $('.check_boxes').click(function(){
                var checkedValues = $('input:checkbox:checked').map(function() {
                    return this.value;
                }).get();
                $('#checked_values').text(checkedValues);
            });
        });
    </script>
    <script type="text/javascript">
        var editor_config = {
            path_absolute : "{{ URL::to('/') }}",
            selector: "#page_content",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link ",
            relative_urls: false,
            file_browser_callback : function(field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }
                tinyMCE.activeEditor.windowManager.open({
                    file : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no"
                });
            }
        };
        tinymce.init(editor_config);
    </script>
</body>

</html>