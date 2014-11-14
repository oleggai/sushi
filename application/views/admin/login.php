<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="<?php echo URL?>public/css/admin/login.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo URL;?>/public/js/jQuery.js"></script>
    <script src="<?php echo URL;?>public/js/admin/login.js"></script>
</head>
<body>
<form onsubmit="return false;"  class="iform" style="display: block;">
    <fieldset>
        <legend class="iheader">Вход в админ панель</legend>
        <div id="imessageERROR"></div>
        <ul>
            <li><label for=""><span class="form_star">*</span> Логин:</label><input class="itext" type="text" name="login" id="login" /></li>
            <li><label for=""><span class="form_star">*</span> Пароль:</label><input class="itext" type="password" name="password" id="password" /></li>

            <li><label>&nbsp;</label><input type="button" class="ibutton"  name="" id="but_login_admin" value="Войти" />
                <a href="#" style="margin-left: 30px;">Забыли пароль?</a>
            </li>
        </ul>
    </fieldset>
</form>
</body>
</html>