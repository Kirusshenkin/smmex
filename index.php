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
    <title>SmmEx</title>
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
<section class="header" id="HOME">
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
                <div class="col-md-8">
                    <div class="logo ">
                        <!-- LOGO -->
                        <img width="125" height="55" src="/landing/images/logo.png" alt="">
                    </div>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-primary btn-action btn-black" href="/login.php" style="float: right">личный кабинет</a>

                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-sm-8">
                    <div class="home_text">
                        <!-- TITLE AND DESC -->
                        <h1><span>Легкие</span> шаги к успеху</h1>
                        <div class="dropdown-divider"></div>
                        <ul class="home_steps">
                            <li><i class="fa fa-check"></i><span>1 </span> Создайте товарное предложение</li>
                            <li><i class="fa fa-check"></i><span>2 </span> Организуйте получение подписчиков</li>
                            <li><i class="fa fa-check"></i><span>3 </span> Запустите автоворонку продаж</li>
                            <li><i class="fa fa-check"></i><span>4 </span> Поддерживайте Рост клиентской базы</li>
                            <li><i class="fa fa-check"></i><span>5 </span> Получайте еще больше возможностей</li>
                        </ul>

                        <div class="messanger-icons">
                            <div class="messanger-icons__item"><img src="widget/img/icon_tg.svg" alt=""></div>
                            <div class="messanger-icons__item"><img src="widget/img/icon_whatsapp.svg" alt=""></div>
                            <div class="messanger-icons__item"><img src="widget/img/icon_viber.svg" alt=""></div>
                            <div class="messanger-icons__item"><img src="widget/img/icon_vk.svg" alt=""></div>
                        </div>

                        <div class="download-btn">
                            <!-- BUTTON -->
                            <a class="btn btn-primary btn-action" href="#CONTACT">Регистрация</a>
                            <a class="tuor btn wow fadeInRight" href="">Демо <i
                                    class="fa fa-angle-down"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4  col-sm-4">
                    <div class="home-iphone">
                        <img src="/landing/images/iPhone_Home.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- END HEADER SECTION -->


<!-- =========================
     Start FUN FACTS
============================== -->


<section class="fun_facts parallax">
    <div class="section_overlay">
        <div class="container wow bounceInLeft" data-wow-duration="1s">
            <div class="row text-center">
                <div class="col-md-3">
                    <div class="single_fun_facts">
                        <i class="pe-7s-look"></i>
                        <h2><span class="counter_num">90</span> <span>%</span></h2>
                        <p>Прочитают ваши рассылки</p><span class="counter_red_text">В email — 20%</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="single_fun_facts">
                        <i class="pe-7s-next-2"></i>
                        <h2><span class="counter_num">30</span> <span>%</span></h2>
                        <p>Перейдут по ссылке</p><span class="counter_red_text">В email — 3-5%</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="single_fun_facts">
                        <i class="pe-7s-comment"></i>
                        <h2><span class="counter_num">70</span> <span>%</span></h2>
                        <p>Вам ответят.</p> <span class="counter_green_text">Мессенджеры — интерактивный канал</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="single_fun_facts">
                        <i class="pe-7s-clock"></i>
                        <h2><span class="counter_num">90</span> <span>сек</span></h2>
                        <p>Среднее время реакции
                            в мессенджерах</p><span class="counter_red_text">В email — 90 минут</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- END FUN FACTS -->


<!-- =========================
     START FEATURES
============================== -->
<section id="FEATURES" class="features page">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <!-- FEATURES SECTION TITLE -->
                <div class="section_title wow fadeIn" data-wow-duration="1s">
                    <h2>Кому подойдет сервис?</h2>
                    <p>От настоящих профессионалов. Для настоящего бизнеса.
                        Ради получения настоящих людей и клиентов</p>
                </div>
                <!-- END FEATURES SECTION TITLE -->
            </div>
        </div>
    </div>

    <div class="feature_inner">
        <div class="container">
            <div class="row">
                <div class="col-md-4 right_no_padding wow fadeInLeft" data-wow-duration="1s">
                    <!-- FEATURE -->

                    <div class="left_single_feature">
                        <!-- ICON -->
                        <div><span class="pe-7s-pen"></span></div>

                        <!-- FEATURE HEADING AND DESCRIPTION -->
                        <h3>Предприниматель<span>/</span></h3>
                        <p>SMM-Ex - это возможность не только дешево и массово получать клиентов, но и инструмент для
                            ведения полноценного бизнеса в Instagram.</p>
                    </div>

                    <!-- END SINGLE FEATURE -->


                    <!-- FEATURE -->
                    <div class="left_single_feature">
                        <!-- ICON -->
                        <div><span class="pe-7s-coffee"></span></div>

                        <!-- FEATURE HEADING AND DESCRIPTION -->
                        <h3>Самозанятый<span>/</span></h3>
                        <p>SMM-Ex поможет заработать при минимальных рисках и вложениях. Больше заказов, больше
                            сарафанного радио, больше подписчиков и лайков.</p>
                    </div>
                    <!-- END SINGLE FEATURE -->


                    <!-- FEATURE -->
                    <div class="left_single_feature">
                        <!-- ICON -->
                        <div><span class="pe-7s-paper-plane"></span></div>

                        <!-- FEATURE HEADING AND DESCRIPTION -->
                        <h3>SMM-менеджер<span>/</span></h3>
                        <p>SMM-Ex - вовлеченные подписчики, множество вариантов массового привлечения фолловеров,
                            удобная коммуникация с аудиторией и ведение аккаунта.</p>
                    </div>
                    <!-- END SINGLE FEATURE -->

                </div>
                <div class="col-md-4">
                    <div class="feature_iphone">
                        <!-- FEATURE PHONE IMAGE -->
                        <img class="wow bounceIn" data-wow-duration="1s" src="/landing/images/iPhone02.png" alt="">
                    </div>
                </div>
                <div class="col-md-4 left_no_padding wow fadeInRight" data-wow-duration="1s">

                    <!-- FEATURE -->
                    <div class="right_single_feature">
                        <!-- ICON -->
                        <div><span class="pe-7s-joy"></span></div>

                        <!-- FEATURE HEADING AND DESCRIPTION -->
                        <h3><span>/</span>Блогер
                        </h3>
                        <p>SMM-Ex поможет как начинающим, так и профессиональным блогерам в получении огромного охвата,
                            подписчиков, лайков и комментариев!</p>
                    </div>
                    <!-- END SINGLE FEATURE -->


                    <!-- FEATURE -->
                    <div class="right_single_feature">
                        <!-- ICON -->
                        <div><span class="pe-7s-display1"></span></div>

                        <!-- FEATURE HEADING AND DESCRIPTION -->
                        <h3><span>/</span>Арбитражник
                        </h3>
                        <p>SMM-Ex - дешевые заявки за счёт продвинутых фильтров и настроек охвата, низкой стоимости
                            функционала Tooligram и минимизации рисков (можно использовать одновременно кучу аккаунтов
                            Instagram!).</p>
                    </div>
                    <!-- END SINGLE FEATURE -->


                    <!-- FEATURE -->
                    <!-- <div class="right_single_feature">
                         &lt;!&ndash; ICON &ndash;&gt;
                         <div><span class="pe-7s-gleam"></span></div>

                         &lt;!&ndash; FEATURE HEADING AND DESCRIPTION &ndash;&gt;
                         <h3><span>/</span>Clean Code</h3>
                         <p>Lorem ipsum dolor, consectetur sed do adipisicing elit, sed do eiusmod tempor incididunt</p>
                     </div>-->
                    <!-- END SINGLE FEATURE -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END FEATURES SECTION -->


<!-- =========================
    START ABOUT US SECTION
============================== -->


<section class="about page" id="ABOUT">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <!-- ABOUT US SECTION TITLE-->
                <div class="section_title">
                    <h2>Почему мы?</h2>

                </div>
            </div>

        </div>
    </div>
    <div class="inner_about_area">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="about_phone wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".5s">
                        <!-- PHONE -->
                        <img src="/landing/images/about_iphone.png" alt="">
                    </div>
                </div>
                <div class="col-md-6  wow fadeInRight" data-wow-duration="1s" data-wow-delay=".5s">
                    <!-- TITLE -->
                    <div class="inner_about_title">
                        <h2>Почему мы лучще подходим <br> для тебя</h2>
                        <p>SMM-Ex позволил нашим клиентам сделать свой Instagram основной площадкой продаж</p>
                    </div>
                    <div class="inner_about_desc">

                        <!-- SINGLE DESC -->
                        <div class="single_about_area fadeInUp wow" data-wow-duration=".5s" data-wow-delay="1s">
                            <!-- ICON -->
                            <div><i class="pe-7s-users"></i></div>
                            <!-- HEADING DESCRIPTION -->
                            <h3>Взаимопиар</h3>
                            <p>Продвигайте ваши продукты или услуги аудитории </p>
                        </div>
                        <!-- END SINGLE DESC -->


                        <!-- SINGLE DESC -->
                        <div class="single_about_area fadeInUp wow" data-wow-duration=".5s" data-wow-delay="1.5s">
                            <!-- ICON -->
                            <div><i class="pe-7s-target"></i></div>
                            <!-- HEADING DESCRIPTION -->
                            <h3>Партнерская программа</h3>
                            <p>Получайте до 50% со всех платежей приведенных клиентов</p>
                        </div>
                        <!-- END SINGLE DESC -->


                        <!-- SINGLE DESC -->
                        <div class="single_about_area fadeInUp wow" data-wow-duration=".5s" data-wow-delay="2s">
                            <!-- ICON -->
                            <div><i class="pe-7s-stopwatch"></i></div>
                            <!-- HEADING DESCRIPTION -->
                            <h3>Остались вопросы?</h3>
                            <p>Присоединяйтесь к нашему сообществу Вконтакте и общайтесь со всеми пользователями</p>
                        </div>
                        <!-- END SINGLE DESC -->

                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- End About Us -->


<!-- =========================
    START TESTIMONIAL SECTION
============================== -->

<section id="TESTIMONIAL" class="testimonial parallax">
    <div class="section_overlay">
        <div class="container">
            <div class="row">
                <div class="col-md-12 wow bounceInDown">
                    <div id="carousel-example-caption-testimonial" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-caption-testimonial" data-slide-to="0"
                                class="active"></li>
                            <li data-target="#carousel-example-caption-testimonial" data-slide-to="1"></li>
                            <li data-target="#carousel-example-caption-testimonial" data-slide-to="2"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <!-- IMAGE -->
                                            <img src="/landing/images/client_1.png" alt="">
                                            <div class="testimonial_caption">
                                                <!-- DESCRIPTION -->
                                                <h2>Эдуард Головинский</h2>
                                                <h4><span>Блогер</span></h4>
                                                <p>“
                                                    Мой отзыв больше для тех кто хочет с 0 завести свой блог. Я не
                                                    занимаюсь продажами и другим бизнесом. То, что я делаю, для души
                                                    (#ноэтонеточно😆). Случайно от знакомого узнал о ресурсе и получив 3
                                                    дня бесплатно, разобрался в нем и был приятно удивлён, что не надо
                                                    делать то, что я раньше руками делал. В какой то период мне даже
                                                    надоело заниматься Инстой, но Тулиграмм мне помог и освободил кучу
                                                    времени! А вот, что полезно для начинающих - это вебинары, которые
                                                    организует сервис! Это познавательно!! Эмоции только положительные
                                                    🙋🏻”
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <!-- IMAGE -->
                                            <img src="/landing/images/client_2.png" alt="">
                                            <div class="testimonial_caption">
                                                <!-- DESCRIPTION -->
                                                <h2>Елена Дмитриченко</h2>
                                                <h4><span>Москва, 28 лет,</span> Блогер</h4>
                                                <p>“
                                                    Ровно за два месяца работы с Tooligram мне удалось повысить
                                                    количество подписчиков с 350 человек до 5860. Это очень круто!
                                                    Когда я увидела такой результат по подпискам, я испугалась, что
                                                    это будет не моя целевая аудитория (фейковые профили, роботы)
                                                    и начала следить за тем, кто же эти подписчики. К моему удивлению,
                                                    у меня появилась именно моя целевая аудитория! Спасибо
                                                    ”</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <!-- IMAGE -->
                                            <img src="/landing/images/client_3.png" alt="">
                                            <div class="testimonial_caption">
                                                <!-- DESCRIPTION -->
                                                <h2>Никита Кузнецов</h2>
                                                <h4><span>Предпринематель</span></h4>
                                                <p>“
                                                    Пользуюсь облачной версией и вообще забыл про постоянно включенный
                                                    компьютер и сбор баз данных. Забиваю ники конкурентов, ставлю
                                                    параметры фильтрации и все работает на автомате 24/7 без каких-либо
                                                    проблем. Спасибо за разработку облака, очень давно ждал.
                                                    ”</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- END TESTIMONIAL SECTION -->


<!-- =========================
     START CONTCT FORM AREA
============================== -->
<section class="contact page" id="CONTACT">
    <div class="section_overlay">
        <div class="container">
            <div class="col-md-10 col-md-offset-1 wow bounceIn">
                <!-- Start Contact Section Title-->
                <div class="section_title">
                    <h2>Зарегистрироваться</h2>

                </div>
            </div>
        </div>

        <div class="contact_form wow bounceIn">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-6" style="padding-bottom: 70px">
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
                                <button class="btn btn-default submit-btn">Отправить</button>
                            </div>
                            <div class="error text-center"></div>
                        </form>
                    </div>

                    <div class="col-md-6 wow bounceInLeft">
                        <div class="social_icons">
                            <ul>
                                <li><a href=""><i class="fa fa-facebook"></i></a>
                                </li>
                                <li><a href=""><i class="fa fa-instagram"></i></a>
                                </li>
                                <li><a href=""><i class="fa fa-vk"></i></a>
                                </li>
                                <li><a href=""><i class="fa fa-youtube-play"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


</section>
<!-- END CONTACT -->

<!-- =========================
     FOOTER
============================== -->

<section class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="">
                    <div class="copyright-title">Информация</div>
                    <p>
                        <a href="#" data-fancybox data-type="ajax" data-src="/modal/rules.php">Условия использования</a>
                    </p>
                    <p>
                        <a href="#" data-fancybox data-type="ajax" data-src="/modal/rules.php">Правовая информация</a>
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="">
                    <div class="copyright-title">Аккаунт</div>
                    <p>
                        <a href="/register.php">Регистрация</a>
                    </p>
                    <p>
                        <a href="/login.php">Вход в аккаунт</a>
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="copyright-title">Поддержка</div>
                <p>
                    +7 495 123-45-34 | Москва и МО <br>
                    +7 812 123-34-45 | Санкт-Петербург и ЛО <br>
                    +7 800 300 65 67 | Регионы РФ <br>
                </p>
            </div>
            <div class="col-md-3">
                <div class="copy_right_text text-right">
                    <p>
                        ИП Горбунов А. В. <br>
                        Москва, Б. Академическая 71. <br>
                        ОГРНИП ‎317554300052514 <br>
                        ИНН ‎550201247998 <br>
                        info@smmex.ru <br>
                    </p>
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