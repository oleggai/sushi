<!DOCTYPE html>
<html>
<head>
    <title></title>
    <script src="<?php echo URL;?>public/js/jQuery.js"></script>
    <script src="<?php echo URL;?>public/js/jQuery_Easing.js"></script>
    <style>
        #div {
            width: 99%;
            margin: 0 auto;
            text-align: center;
            font-family: "Trebuchet MS";
            font-size: 24px;
            position: absolute;
            color: <?php switch($type_error) {
                                    case 'message':
                                        echo '#4CAE4C';
                                        break;
                                    case 'error':
                                        echo '#A94442';
                                        break;
                                }
                    ?>;
        }
        #div a {
            color: blue;
            font-size: 14px;
            text-decoration: none;
        }
        #div a:hover {
            text-decoration: underline;
        }
        span {
        }
    </style>

</head>
<body>
<div id="div">
              <span><?php echo $message;?></span><br>
              <a onclick="window.history.back();" style="cursor: pointer;">Вернуться в админку</a>
</div>
<script>
    $("#div").animate({
        "top": '+=40%'
    },900,'easeOutBounce');
</script>
</body>
</html>