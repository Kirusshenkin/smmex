<?php $is_login_page = true; ?>
<?php require_once 'functions.php' ?>
<!DOCTYPE html>
<html lang="ru">
<!--
	Bent by Dcrazed
	Site: Dcrazed.com
	Free for personal and commercial use under GNU GPL 3.0 license.
-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bent | App Landing Page</title>
    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Raleway:500,600,700,800,900,400,300' rel='stylesheet'
          type='text/css'>

    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900,300italic,400italic'
          rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->
    <link href="/landing/css/bootstrap.min.css" rel="stylesheet">

    <!-- Owl Carousel Assets -->
    <link href="/landing/css/owl.carousel.css" rel="stylesheet">
    <link href="/landing/css/owl.theme.css" rel="stylesheet">

    <!-- Fancybox Assets -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

    <!-- Pixeden Icon Font -->
    <link href="/landing/css/Pe-icon-7-stroke.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="/landing/css/font-awesome.min.css" rel="stylesheet">


    <!-- PrettyPhoto -->
    <link href="/landing/css/prettyPhoto.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>

    <!-- Style -->
    <link href="/landing/css/style.css" rel="stylesheet">

    <link href="/landing/css/animate.css" rel="stylesheet">
    <!-- Responsive CSS -->
    <link href="/landing/css/responsive.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>
        var token = '<?=$token?>';
        var apiUrl = '<?=$apiUrl?>';
    </script>

</head>
<body>

<!-- PRELOADER -->
<div class="spn_hol">
    <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
</div>

<!-- END PRELOADER -->

<!-- =========================
    START ABOUT US SECTION
============================== -->
<section class="header" id="LOGIN">
    <h2></h2>
    <div class="section_overlay">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <img src="/landing/images/logo.png" alt="Logo">
                    </a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <!-- NAV -->
                        <li><a href="#FEATURES">О НАС</a></li>
                        <li><a href="#CONTACT">ЗАРЕГИСТРИРОВАТЬСЯ </a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container- -->
        </nav>

        <div class="container home-container">
            <div class="row">
                <div class="col-md-6">
                    <a href="/" class="logo ">
                        <!-- LOGO -->
                        <img width="125" height="55" src="/landing/images/logo.png" alt="">
                    </a>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-primary submit-btn" href="/login.php" style="float: right;width: auto">Войти</a>
                    <span class="header-question">Уже зарегистрированы?</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-md-4 col-sm-4">
                    <div class="home-iphone">
                        <img src="/landing/images/iPhone_Home.png" alt="">
                    </div>
                </div>
                <div class="col-sm-1"></div>
                <div class="col-md-6 col-sm-6">
                    <div class="home_text">
                        <h1 class="text-center">Попробуйте <span>бесплатно</span></h1>
                        <div class="contact_form">
                            <form action="" onsubmit="register(event, this)">
                                <div class="form-group">
                                    <input type="text" id="username" class="form-control" name="username" placeholder="Логин">
                                </div>
                                <div class="form-group">
                                    <input type="text" id="username" class="form-control" name="email" placeholder="E-mail">
                                </div>
                                <div class="form-group">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="Пароль">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-action btn-block">Отправить</button>
                                </div>
                                <div class="error text-center"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================
     FOOTER
============================== -->

<section class="copyright">
    <h2></h2>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="copy_right_text">
                    <!-- COPYRIGHT TEXT -->
                    <p>ИНН 2543124027</p>
                    <p>Свидетельство о государственной регистрации</p>
                </div>

            </div>
            <div class="col-md-3">
                <div class="copy_right_text">
                    <!-- COPYRIGHT TEXT -->
                    <p>ОГРН 2543124027 </p>

                </div>

            </div>
            <div class="col-md-3">
                <div class="copy_right_text">
                    <!-- COPYRIGHT TEXT -->
                    <p>Политика конфендициальности</p>

                </div>

            </div>
            <div class="col-md-3">
                <div class="copy_right_text">
                    <!-- COPYRIGHT TEXT -->
                    <p>Публичная оферта</p>

                </div>

            </div>


        </div>
    </div>
</section>
<!-- END FOOTER -->


<!-- =========================
     SCRIPTS
============================== -->


<script src="/landing/js/jquery.min.js"></script>
<script src="/landing/js/bootstrap.min.js"></script>
<script src="/landing/js/owl.carousel.js"></script>
<script src="/landing/js/jquery.fitvids.js"></script>
<script src="/landing/js/smoothscroll.js"></script>
<script src="/landing/js/jquery.parallax-1.1.3.js"></script>
<script src="/landing/js/jquery.prettyPhoto.js"></script>
<script src="/landing/js/jquery.ajaxchimp.min.js"></script>
<script src="/landing/js/jquery.ajaxchimp.langs.js"></script>
<script src="/landing/js/wow.min.js"></script>
<script src="/landing/js/waypoints.min.js"></script>
<script src="/landing/js/jquery.counterup.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="/js/auth.js"></script>
<script src="/landing/js/script.js"></script>


</body>

</html>