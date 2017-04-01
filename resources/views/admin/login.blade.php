<!DOCTYPE html>
<html lang="ar"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>لوحة التحكم - زاخر</title>
    <link href="/admin_files/login/bootstrap.css" rel="stylesheet">
    <link href="/admin_files/login/icon.css" rel="stylesheet">
    <link href="/admin_files/login/style.css" rel="stylesheet">
    <link href="/admin_files/login/ar.css" rel="stylesheet" class="lang_css arabic">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body style="background-color: #252830;">

    <div class="login_container">
        <form action="/admin/login" method="post">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <h1 class="heading_title">تسجيل الدخول للنظام</h1>

            <div class="form-group">
                <input class="form-control" id="exampleInputEmail1" name="admin_mail" placeholder="البريد الالكتروني" type="email">
            </div>
            <div class="form-group">
                <input class="form-control" id="exampleInputPassword1" name="admin_password" placeholder="كلمة المرور" type="password">
            </div>
            <div class="checkbox">
                <label>
                    <input  name="remember_token" type="checkbox"> تذكرني
                </label>
            </div>
            <button type="submit" class="btn btn-primary">دخول</button>
        </form>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="/admin_files/login/jquery-2.js"></script>
    <script src="/admin_files/login/bootstrap.js"></script>
    <script src="/admin_files/login/js.js"></script>


</body></html>