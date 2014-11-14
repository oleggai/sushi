<!doctype html>
<html lang="en"><head>
    <meta charset="utf-8">
    <title>Admin Sushi & Pizza</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="<?php echo URL;?>public/css/admin/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="<?php echo URL;?>public/css/admin/bootstrap/font-awesome.css">

    <script src="<?php echo URL;?>public/js/admin/bootstrap/jquery-1.11.1.min.js" type="text/javascript"></script>

    <script src="<?php echo URL;?>public/js/checkInfo.js" type="text/javascript"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo URL;?>public/css/admin/bootstrap/theme.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL;?>public/css/admin/bootstrap/premium.css">

</head>
<body class=" theme-blue">
<div id="opacity" style="position: fixed; display: none; width: 100%; height: 100%; opacity: 0.4; z-index: 1; top: 0px; left: 0px; background: rgb(0, 0, 0);"></div>
<!-- Demo page code -->

<style type="text/css">
    #line-chart {
        height:300px;
        width:800px;
        margin: 0px auto;
        margin-top: 1em;
    }
    .navbar-default .navbar-brand, .navbar-default .navbar-brand:hover {
        color: #fff;
    }
</style>

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>

<![endif]-->

<!-- Le fav and touch icons -->
<link rel="shortcut icon" href="../assets/ico/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">


<!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
<!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
<!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
<!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->

<!--<![endif]-->

<div class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="" href="index.html"><span class="navbar-brand"><span class="fa fa-paper-plane"></span> Admin Sushi & Pizza</span></a></div>

    <div class="navbar-collapse collapse" style="height: 1px; float: right; width: 170px; height:70px; position: relative; margin-top:13px;">
        <a class="dropdown-toggle" style="color: white; line-height: 20px;" >Привет
            <?php
                $user = unserialize($_SESSION["user"]);
                echo $user->getLogin();
            ?>
        </a>
        <a href="<?php echo URL;?>logout" class="dropdown-toggle hover_out" style="color: white; line-height: 20px; float: right;" >Выход</a>
    </div>
</div>
</div>
<?php
$controller = null;
if(isset($_GET["route"])) {
    $controller = substr($_GET["route"], strpos($_GET["route"], "/") + 1);
}
?>

<div class="sidebar-nav">
    <ul>
        <li rel="slide"><a style="cursor: pointer;" data-target=".dashboard-menu" class="nav-header" data-toggle="collapse"><i class="fa fa-fw fa-dashboard"></i> Обзор<i class="fa fa-collapse"></i></a></li>
        <li><ul class="dashboard-menu nav nav-list collapse" style="">
                <li class="<?php if($controller == "") { echo 'hover_link'; }?>"><a href="<?php echo URL;?>admin/"><span class="fa fa-caret-right"></span> Краткий обзор</a></li>

                <!---<li class="<?php if($controller == 'allOrders') { echo 'hover_link'; }?>"><a href="<?php echo URL;?>admin/allOrders"><span class="fa fa-caret-right"></span> Последние 10 заказов</a></li>--->

            </ul></li>

        <li rel="slide" data-popover="true"  rel="popover" data-placement="right"><a style="cursor: pointer;" data-target=".premium-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-fighter-jet"></i> Категории товаров<i class="fa fa-collapse"></i></a></li>
        <li><ul class="premium-menu nav nav-list collapse">

                <li class="<?php if($controller == 'allPizza') echo 'hover_link';?>"><a href="<?php echo URL;?>admin/allPizza"><span class="fa fa-caret-right"></span> Пицца</a></li>
                <li class="<?php if($controller == 'allSushi') echo 'hover_link';?>"><a href="<?php echo URL;?>admin/allSushi"><span class="fa fa-caret-right"></span> Суши</a></li>
                <li class="<?php if($controller == 'allDrinks') echo 'hover_link';?>"><a href="<?php echo URL;?>admin/allDrinks"><span class="fa fa-caret-right"></span> Напитки</a></li>
                <li class="<?php if($controller == 'addProduct') echo 'hover_link';?>"><a href="<?php echo URL;?>admin/addProduct"><span class="fa fa-caret-right"></span> Добавить товар</a></li>
                <li ><a href="premium-pricing-tables.html"><span class="fa fa-caret-right"></span> Добавить категорию</a></li>
                <li ><a href="premium-upgrade-account.html"><span class="fa fa-caret-right"></span> Удалить категорию</a></li>
            </ul>
        </li>

        <li rel="slide"><a style="cursor: pointer;" data-target=".accounts-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-briefcase"></i> Заказы <span class="label label-info new_orders"></span></a></li>
        <li><ul class="accounts-menu nav nav-list collapse">
                <li class="<?php if($controller == 'allOrders') { echo 'hover_link'; }?>" ><a href="<?php echo URL;?>admin/allOrders"><span class="fa fa-caret-right"></span> Все заказы <span class="label label-info new_orders"></span></a></li>
                <li ><a href="sign-up.html"><span class="fa fa-caret-right"></span> Новые заказы <span class="label label-info new_orders"></span></a></li>
            </ul></li>


        <li><a style="cursor: pointer;"  class="nav-header"><i class="fa fa-fw fa-question-circle"></i> Обратная связь <span class="label label-info">+5</span></a></li>
        <li><a style="cursor: pointer;"  class="nav-header"><i class="fa fa-fw fa-question-circle"></i> Передзвонить мне <span class="label label-info">+2</span></a></li>
        <li><a style="cursor: pointer;"  class="nav-header"><i class="fa fa-fw fa-comment"></i> Коментарии <span class="label label-info">+9</span></a></li>
        <li  rel="slide"><a style="cursor: pointer;"  data-target=".legal-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-legal"></i> Настройки<i class="fa fa-collapse"></i></a></li>
        <li><ul class="legal-menu nav nav-list collapse">
                <li ><a href="privacy-policy.html"><span class="fa fa-caret-right"></span> Сменить логин</a></li>
                <li ><a href="terms-and-conditions.html"><span class="fa fa-caret-right"></span> Сменить пароль</a></li>
            </ul></li>
    </ul>
</div>

<div class="content">
    <div class="header">

        <h1 class="page-title">
            <?php
            if($controller == "") { echo "Краткий обзор";}
            if($controller == "allOrders") { echo "Все заказы";}
            if($controller == "allPizza") { echo "Категория Пицца";}
            if($controller == "allSushi") { echo "Категория Суши";}
            if($controller == "allDrinks") { echo "Категория Напитки";}
            if($controller == "addProduct") { echo "Добавить товар";}

            ?>
        </h1>
        <ul class="breadcrumb">
            <li><a href="index.html">Admin</a></li>
            <li class="active">
                <?php
                if($controller == "") { echo "Краткий обзор";}
                if($controller == "allOrders") { echo "Все заказы";}
                if($controller == "allPizza") { echo "Пицца";}
                if($controller == "allSushi") { echo "Категория Суши";}
                if($controller == "allDrinks") { echo "Категория Напитки";}
                if($controller == "addProduct") { echo "Добавить товар";}
                ?>
            </li>
        </ul>

    </div>
    <div class="main-content">

        <?php
        require_once "./application/views/admin/".$content_view;
        ?>

        <footer>
            <hr>

            <!-- Purchase a site license to remove this link from the footer: http://www.portnine.com/bootstrap-themes -->
            <p class="pull-right">Разработка и поддержка<a href="#" target="_blank"> oleggaidaienko@gmail.com</a></p>
            <p>© 2014 <a href="#" target="_blank">Доставка Sushi & Pizza</a></p>
        </footer>
    </div>
</div>
<audio id="sound">
    <source src="<?php echo URL;?>application/views/admin/layouts/2.mp3">
</audio>
<script type="text/javascript">
// Гармошка
$(".sidebar-nav ul li[rel='slide']").bind("click", function() {
    $(this).next().find("ul").slideToggle();
    $(this).next().next().find("a").css("borderTop", " 1px solid #c8c8cb");
});



    $(".hover_link").parent().css("display", "block");


</script>

</body></html>
