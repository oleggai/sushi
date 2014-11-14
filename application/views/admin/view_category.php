<link href="<?php echo URL?>/public/css/admin/form_change_pizza.css" rel="stylesheet">
<script src="<?php echo URL;?>/public/js/admin/show_form_product.js"></script>
<script src="<?php echo URL;?>/public/js/admin/delete.js"></script>
<script src="<?php echo URL;?>/public/js/admin/add_type.js"></script>



<!--- jQuery Form Styler -->

<link href="<?php echo URL?>/public/css/admin/jQuery_form_styler/jquery.formstyler.css" rel="stylesheet">
<script src="<?php echo URL;?>/public/js/admin/jQuery_form_styler/jquery.formstyler.min.js"></script>

<script src="<?php echo URL;?>/public/js/admin/active_form_styler.js"></script>

<!----->

<script src="<?php echo URL;?>/public/js/admin/show_form_file.js"></script>

<?php require_once "./application/views/admin/view_add_product.php";?>



<table class="tg">
    <tr>
        <th class="tg-s6z2">Изображение</th>
        <th class="tg-031e">Название</th>
        <th class="tg-031e">Состав</th>
        <th class="tg-031e type_th">
            <div><?php if($controller == "allPizza") echo "Диаметр"; if($controller == "allSushi") echo "Длина";?></div>
            <div>Вес</div>
            <div>Цена</div>
        </th>
        <th class="tg-031e ">Управление</th>
    </tr>
    <?php foreach($data as $key=>$val) {?>
    <tr id-product = "<?php echo $val["id_product"];?>">
        <td class="tg-031e"><img height='160' src='<?php echo URL;?>public/img<?php echo $val["image"];?>'></td>
        <td class="tg-031e"><span><?php echo $val["name_product"];?></span></td>
        <td class="tg-031e  compund_th"><?php echo $val["compound"];?></td>
        <td class="tg-031e type_td" >
            <?php foreach($val["diameter_weight_price"] as $key=>$value) {?>
            <div class="type" id-type="<?php echo $value["id_type"];?>">

                <div><span><?php echo $value["diameter"];?></span>&nbsp;см</div>
                <div><span><?php echo $value["weight"];?></span>&nbsp;г</div>
                <div><span><?php echo $value["price"];?></span>&nbsp;грн</div>

            </div>
            <?php }?>
        </td>
        <td class="tg-031e" >
            <a class="a_chnage_product">Редактировать</a>
            <hr>
            <a class="a_add_type">Добавить тип</a>
            <hr>
            <a class="a_chnage_img">Сменить изображение</a>
            <hr>

            <select class="sel" style="width: 130px; top: -10px; right: 5px;">
                <option>--Удалить--</option>
                <option value="del_type">Удалить тип</option>
                <option value="del_product">Удалить товар</option>
            </select>
        </td>
    </tr>
    <?php }?>
</table>

<!-- Форма для изменения информации о товаре -->
<div class="div_form form_product" id="div_form_product">
    <div class="header_form">
        <p>Изменение информации о товаре <span class="close_form" style="">Закрыть</span></p>
    </div>
    <hr style="margin: 5px 0px 10px 0px;">

        <form method="post" action="" onsubmit="return false;" class="iform" >
             <div id="imessageOK">Thank you! Message Sent!</div>
             <div id="imessageERROR">ERROR: Message Not Sent!</div>
             <ul>
                 <li>
                     <label for="">Название: </label>
                     <input class="itext" type="text" name="name_product" id="name_product" />
                     <input type="button" class="ibutton" style="margin-left: 10px;" name="change_button" id="change_name_product_button" value="Изменить" />
                  </li>
             </ul>
        </form>
        <form method="post" action="" onsubmit="return false;" class="iform">
             <ul>
                 <li>
                     <label for="YourMessage">Состав: </label>
                     <textarea class="itextarea" style="float: left;" name="compound" id="compound"></textarea>
                     <input type="button" class="ibutton" style="float: left; margin-left: 15px;" name="change_compound_product_button" id="change_compound_product_button" value="Изменить" />
                 </li>

              </ul>
         </form>

    <hr style="clear: both; position: relative; top: 20px;">
    <table border="0" class="table_change_type" id="change_type_table">
        <th>Тип</th>
        <th><?php if($controller == "allPizza") echo "Диаметр"; if($controller == "allSushi") echo "Длина";?></th>
        <th>Вес</th>
        <th>Цена</th>
        <th></th>
        <!-- Вставка tr данных типов товаров-->
    </table>
</div>
<!--- Конец формы --->

<!---- Форма для изменения картинки продукта -->
<div class="box form_product">
    <div class="header_form">
        <p>Изменение изображения <span id="close_form_file" style="">Закрыть</span></p>
    </div>
    <hr style="margin: 5px 0px 10px 0px;">
    <div class="div_file">

        <form method="post" action="<?php echo URL;?>admin/loadSmallImage/<?php echo $other_data; // ИД типа категории ?>" enctype="multipart/form-data">
             <div class="section">
                 <label>Загрузите маленькое изображение</label>
                 <input type="file" name="image_file" /><br>
                 <input type="hidden" name="id_product" value="">
                 <input type="submit" class="styler" value="Загрузить">
             </div><!-- .section -->
        </form>
        <form method="post" action="<?php echo URL;?>admin/loadBigImage/<?php echo $other_data; // Ид типа категории ?>" enctype="multipart/form-data">
             <div class="section">
                 <label>Загрузите большое изображение</label>
                 <input type="file" name="image_file"/><br>
                 <input type="hidden" name="id_product" value="">
                 <input type="submit" class="styler" value="Загрузить">
             </div><!-- .section -->
        </form>
    </div><!-- .box -->
</div>

<div class="div_form form_product" id="div_del_type">
    <div class="header_form">
        <p>Удаление типа продукта <span class="close_form" style="">Закрыть</span></p>
    </div>
    <table border="0" class="table_change_type" id="del_type_table" style="width: 400px;">
        <th>Тип</th>
        <th><?php if($controller == "allPizza") echo "Диаметр"; if($controller == "allSushi") echo "Длина";?></th>
        <th>Вес</th>
        <th>Цена</th>
        <th></th>
        <!-- Вставка tr данных типов товаров-->
    </table>
</div>


<!-- Форма для добавления типа товара -->
<div class="div_form form_product" id="div_add_type">
    <div class="header_form">
        <p>Добавление типа продукта <span class="close_form_add_type" style="">Закрыть</span></p>
    </div>
    <table border="0" class="table_change_type" id="add_type_table" style="width: 400px;">
        <th><?php if($controller == "allPizza") echo "Диаметр"; if($controller == "allSushi") echo "Длина";?></th>
        <th>Вес</th>
        <th>Цена</th>
        <th></th>
        <tr>
        <td><input type="text" class="itext" name="diameter" id="diameter"></td>
        <td><input type="text" class="itext" name="weight" id="weight"></td>
        <td><input type="text" class="itext" name="price" id="price"></td>
        <td><input type="button" class="ibutton" value="Добавить" id="button_add_type"></td>
        </tr>
    </table>
</div>

