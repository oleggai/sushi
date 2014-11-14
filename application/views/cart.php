<div id="cart">

    <img src="<?php echo URL;?>/public/img/cart.png" height="80" style=" float: left;">
    <h2 style="color: #911c1d;">Моя корзина</h2><br>
    <h2 id="my_cart" style="color: blue;"></h2>
    <?php if(!empty($data)) {?>
    <table border="0" id="table_cart">
        <th></th>
        <th>Наименование</th>
        <th>Цена</th>
        <th>Размер / Вес</th>
        <th>Количество</th>
        <th>Всего</th>
        <th>Удалить</th>
        <?php foreach($data as $key=>$val) { ?>
        <tr>
            <td><a href='<?php echo URL;?>public/img<?php echo $val["image_large"];?>' data-lightbox="roadtrip"><img src="<?php echo URL;?>public/img<?php echo $val['image'];?>" height="120"></a></td>
            <td><span><?php echo $val["name_product"];?></span></td>
            <td><?php echo $val["price"];?> Грн</td>
            <td><?php echo $val["diameter"]?>см <?php echo $val["weight"];?>г</td>
            <td>
                <input type="button" value="-" flag="minus" id-cart="<?php echo $val["id_cart"];?>">&nbsp;
                <span><?php echo $val["count_product"]?></span>&nbsp;&nbsp;
                <input type="button" value="+" flag="plus" id-cart="<?php echo $val["id_cart"];?>">
            </td>
            <td><div><?php echo $val["all_price"]?></div> грн</td>
            <td>
                <img src="<?php echo URL;?>public/img/del.gif" id-cart="<?php echo $val["id_cart"];?>" title="Удалить" style="box-shadow: none; cursor: pointer;  margin-bottom: 10px;">
            </td>
        </tr>
        <?php }?>
    </table>
   <div id="all">Итого <span><?php echo $other_data[0]["sum_price"];?> </span>&nbsp;грн</div>
        <hr width="1100" size="2" color="#006595" style="position:relative; top: 10px; ">

        <div style="width: 1100px; height: 30px; margin: 0 auto; text-align: center; margin-top: 35px;">
        <nav class="cl-effect-12"><a style="text-decoration: none;color: #006595; font-family: 'Trebuchet MS', Arial, sans-serif; font-size: 28px; cursor: pointer;">Оформить заказ</a></nav>
        </div>

        <div>
            <form method="post" action="" onsubmit="return false;" class="iform">
                <fieldset>
                    <legend class="iheader">Адрес доставки</legend>
                <div id="imessageERROR"></div>
                <ul>
                    <li><label for=""><span class="form_star">*</span> Ваше имя</label><input class="itext" type="text" name="name_customer" id="name_customer" /></li>
                    <li><label for=""><span class="form_star">*</span> Улица</label><input class="itext" type="text" name="street" id="street" /></li>
                    <li><label for=""><span class="form_star">*</span> Дом</label><input class="itext" type="text" name="house" id="house" /></li>
                    <li><label for="">&nbsp;&nbsp;&nbsp;Квартира</label><input class="itext" type="text" name="apartment" id="apartment" /></li>
                    <li><label for=""><span class="form_star">*</span> Телефон</label><input class="itext" type="tel" name="phone" id="phone" /></li>
                    <li><label for="YourEmail">&nbsp;&nbsp;&nbsp;Ваш Email</label><input class="itext"  name="email" id="email" /></li>
                    <li><label for="">&nbsp;&nbsp;&nbsp;Коментарий:</label><textarea class="itextarea" name="note" id="note"></textarea></li>
                    <li style="float: left; margin-left:30px;"><span class="form_star">*</span><span>&nbsp;Поля обязательные для заполнения</span></li>
                    <img src="<?php echo URL;?>public/img/curly_brace.png" style=" margin-left: 30px;">
                    <li><label>&nbsp;</label><input type="submit" class="ibutton" onclick="sendForm()" name="" id="" value="Оформить!" /></li>
                </ul>
                </fieldset>
            </form>
        </div>
    <?php } else {?>
        <span>Ваша корзина пуста</span>
    <?php }?>
</div>