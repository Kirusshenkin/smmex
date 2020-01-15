<?php require_once 'functions.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous" /> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <!-- <link rel="stylesheet" href="js/emojiarea/jquery.emojiarea.css"> -->
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>SmmEX</title>

    <script>
        var token = '<?= $token ?>';
        var apiUrl = '<?= $apiUrl ?>';
    </script>
</head>

<body>
    <header>
        <div class="container">
            <a href="/" class="logo">
                <img src="https://smmex.ru/landing/images/logo.png" alt="">
            </a>
            <ul class="header-menu" style="flex: 1">
                <li>
                    <a href="">Рассылки <i class="fas fa-caret-down"></i></a>
                    <ul>
                        <li><a href="/offers.php"><i class="fal fa-shopping-basket fa-fw header-icon"></i> Товарные предложения</a></li>
                        <li><a href="/chains.php"><i class="fal fa-filter fa-fw header-icon"></i>Автоворонки</a></li>
                        <li><a href="/mailings.php"><i class="fal fa-envelope fa-fw header-icon"></i>Рассылки</a></li>
                        <li><a href="/mini-landing.php"><i class="fal fa-envelope fa-fw header-icon"></i>Мини лендинг</a></li>
                        <li><a href="/bots.php"><i class="fal fa-robot fa-fw header-icon"></i>Боты</a></li>
                    </ul>
                </li>
                <li>
                    <a href="">Инструменты <i class="fas fa-caret-down"></i></a>
                    <ul>
                        <li><a href="/widgetsLinks.php"><i class="fal fa-toolbox fa-fw header-icon"></i> Виджеты подписки</a></li>
                        <li><a href="/importYML.php"><i class="fal fa-upload fa-fw header-icon"></i> Импорт ТП</a></li>
                    </ul>
                </li>
                <li><a href="/payment.php">Услуги</a></li>
                <li><a href="#">Помощь</a></li>
            </ul>
            <ul class="header-menu menu-right">
                <li>
                    <a href=""><i class="fal fa-user fa-fw header-icon"></i><?= $userInfo->username ?> <i class="fas fa-caret-down"></i></a>
                    <ul style="left: auto;right: 0">
                        <li><a href=""><i class="fal fa-cog fa-fw header-icon"></i>Настройки аккаунта</a></li>
                        <li><a href="/logout.php"><i class="fal fa-power-off fa-fw header-icon"></i>Выход</a></li>
                    </ul>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
    </header>
    <?php $rate = json_decode($userInfo->rate->data); ?>
    <?php if(empty($rate) || $userInfo->rate->ok != 1){ ?>
    <div class="container">
        <div class="alert alert-warning" role="alert">
            <b>Оплаченный период закончился.</b> Рассылки и ответы клиентам недоступны. Для оплаты нажмите <a href="/payment.php">здесь</a>
        </div>
    <?php } ?>