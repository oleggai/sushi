<!DOCTYPE html>
<html>
<head>
    <title>Интернет магазин</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="<?php echo URL?>public/css/style.css" rel="stylesheet">
    <link href="<?php echo URL?>public/css/demo.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo URL?>public/css/common.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo URL?>public/css/style7.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo URL?>public/css/css_hover/component.css" rel="stylesheet" type="text/css"/>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,700' rel='stylesheet' type='text/css' />

    <link href="<?php echo URL?>public/css/faary.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo URL?>public/css/lightbox/lightbox.css" rel="stylesheet" type="text/css"/>

    <script src="<?php echo URL;?>public/js/jQuery.js"></script>
    <script src="<?php echo URL;?>public/js/jQuery_Easing.js"></script>
    <script src="<?php echo URL;?>public/js/lightbox/lightbox.min.js"></script>

    <script src="<?php echo URL;?>public/js/javascript.js"></script>
    <script src="<?php echo URL;?>public/js/ajax_cart.js"></script>
    <script src="<?php echo URL;?>public/js/hover_link.js"></script>
    <script src="<?php echo URL;?>public/js/cart.js"></script>
    <script type="text/javascript" src="<?php echo URL;?>public/js/modernizr.custom.79639.js"></script>
    <!--[if lte IE 8]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
</head>
<body>
<div class="upper_menu">
        <ul>
            <li><a>Обратная связь&nbsp;&nbsp;</a><span>|&nbsp;&nbsp;</span></li>
            <li><a>Отзывы&nbsp;&nbsp;</a><span>|&nbsp;&nbsp;</span></li>
            <li><a>Оплата&nbsp;&nbsp;</a><span>|&nbsp;&nbsp;</span></li>
            <li><a>Доставка&nbsp;&nbsp;</a><span>|&nbsp;&nbsp;</span></li>
            <li><a>Акции</a></li>
        </ul>
    <div style="position: relative; display: inline-block; top:6px; margin-left: 150px; font-size: 24px; color:white;">
        044-902-514
    </div>
    <div style="color: white; float: right; position: relative; display:inline-block; top: 10px; right:10px;
     font-size: 12px;">
        Работаем круглосуточно
    </div>

</div>
<div id="alert" style="display: none;">
     <div class="upper_menu alert" style="">
     </div>

     <div class="message" style="">
         <span class="message_text" style="">Спасибо за покупку! Товар добавлен в корзину!</span>
     </div>
</div>
<div id="main">
    <div style="height: 250px; width: 1100px; margin-top: 40px; text-align: center;
        background-image: url(<?php echo URL?>public/img/fon_1.png);">
        <div style="position: absolute; margin: 40px 0px 0px 50px;">
            <img src="<?php echo URL?>public/img/logo.jpeg" style="">
        </div>
        <div id="image" style="position: relative; display: inline-block; text-align: center; width: 800px; height: 281px;">
            <img src="<?php echo URL?>public/img/header/image1.png" style="position: absolute; right: 100px;">
            <img src="<?php echo URL?>public/img/header/image2.png" style=" opacity:0; filter:alpha(opacity=0); position:absolute; right: 100px; ">
            <img src="<?php echo URL?>public/img/header/image3.png" style=" opacity:0; filter:alpha(opacity=0); position:absolute; right: 100px;">
            <img src="<?php echo URL?>public/img/header/image4.png" style=" opacity:0; filter:alpha(opacity=0); position:absolute; right: 100px;">
        </div>
        <img style="position: absolute; margin-top:5px;" src="<?php echo URL?>public/img/animatedDude.gif">
        <a id="subscribe" style="position: absolute; margin-top: 75px; color: #911c1d;">Подписаться</a>
        <a id="call_me" style="margin-top: 95px; float: right; position: absolute; color: #911c1d;">Передзвонить мне</a>
        <div style="width: 150px; height: 130px; line-height: 30px; background-color: #f1f5fc; position: absolute;
                   margin: -120px 0px 0px 840px;font-size: 24px; font-family: 'Trebuchet MS', Arial, sans-serif;
                   -webkit-border-radius: 15px; -moz-border-radius: 15px; border-radius: 15px;">
            Корзина
        <div style="font-size: 16px;">
            <span>Товаров</span>
            <span id="all_count_product">
                <?php if(isset($_COOKIE["all_count"])) echo $_COOKIE["all_count"];?>
            </span><br>

            <span>На сумму</span>&nbsp;
            <span id="all_sum">
                <?php if(isset($_COOKIE["all_sum"])) echo $_COOKIE["all_sum"];?>
            </span> <span>грн</span></div>

            <a href="<?php echo URL;?>cart" style="color: blue; font-size: 14px;">Оформить заказ</a>
        </div>
    </div>
    <?php
    $controller = null;
    if(isset($_GET["route"])) {
    $controller = substr($_GET["route"], 0, strpos($_GET["route"], "/"));
    }
    ?>
    <h2 style="color: #911c1d;">Доставка пиццы Киев</h2>
    <div id="hor_menu">
        <section class="main">

            <ul class="ch-grid selector">
                <li id="link_pizza" >
                    <div class="ch-item">
                        <div class="ch-info">
                            <div class="ch-info-front ch-img-1">
                                <img class="img_title" src="<?php echo URL;?>public/img/link_menu/img_pizza.png" style=" right: 32px;">
                            </div>
                            <div class="ch-info-back">
                                <h3>Пицца</h3>
                                <p>Доставка пиццы Киев<a href="#">Sushi & Pizza</a></p>
                            </div>
                        </div>
                    </div>
                </li>
                <li id="link_sushi">
                    <div class="ch-item">
                        <div class="ch-info">
                            <div class="ch-info-front ch-img-2">
                                <img class="img_title" src="<?php echo URL;?>public/img/link_menu/img_sushi.png" style="right: 47px;">
                            </div>
                            <div class="ch-info-back">
                                <h3>Суши</h3>
                                <p>Доставка суши Киев<a href="#">Sushi & Pizza</a></p>
                            </div>
                        </div>
                    </div>
                </li>
                <li id="link_drinks">
                    <div class="ch-item">
                        <div class="ch-info">
                            <div class="ch-info-front ch-img-3">
                                <img class="img_title" src="<?php echo URL;?>public/img/link_menu/img_drinks.png" style="right: 15px;">
                            </div>
                            <div class="ch-info-back">
                                <h3>Напитки</h3>
                                <p>Доставка напитков Киев<a href="#">Sushi & Pizza</a></p>
                            </div>
                        </div>
                    </div>
                </li>

            </ul>

        </section>

        <div class="border">
            <div style="margin-left: 170px;" class="<?php if($controller == "pizza") echo "hover";?>"></div>
            <div style="margin-left: 45px;" class="<?php if($controller == "sushi") echo "hover";?>"></div>
            <div style="margin-left: 50px;" class="<?php if($controller == "drinks") echo "hover";?>"></div>
        </div>
    </div>
<div id="content">
    <?php
    require_once "./application/views/".$content_view;
    ?>
</div>
<div id="footer">
    <div>
        <a><img src="<?php echo URL?>public/img/logo.jpeg" height="60" style="float: left; margin: 15px 0px 0px 0px;"></a>
        <p style="font-size: 11px; position: absolute; padding-left: 70px; color: grey;">
            © 2012 «Pizza & Sushi» - доставка пиццы по Киеву, Работаем круглосуточно.
            <br><br>Все права защищены.<br>
            <a>Доставка пиццы</a>&nbsp;&nbsp;&nbsp;
            <a>Доставка суши</a>
        </p>
    </div>
    <div style="width: 430px;">
        <p style="position: absolute; font-size: 28px; color: grey;">
            044-233-7117
            <span style="font-size: 18px; margin-left: 40px;">Работаем круглосуточно</span>
        </p>
    </div>

    <div id="footer_menu">
            <ul>
                <li><a>Пиццы&nbsp;&nbsp;</a><span>|&nbsp;&nbsp;</span></li>
                <li><a>Суши&nbsp;&nbsp;</a><span>|&nbsp;&nbsp;</span></li>
                <li><a>Салаты&nbsp;&nbsp;</a><span>|&nbsp;&nbsp;</span></li>
                <li><a>Фри&nbsp;&nbsp;</a><span>|&nbsp;&nbsp;</span></li>
                <li><a>Паста</a><span>|&nbsp;&nbsp;</span></li>
                <li><a>Напитки&nbsp;&nbsp;</a></li>
            </ul>
    </div>
</div>
</div>
</body>
</html>