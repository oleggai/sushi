<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style type="text/css">
        .tg  {width: 100%; border-collapse:collapse;border-spacing:0;border-color:#ccc;}
        .tg td{font-family:Arial, sans-serif;font-size:12px;padding:10px 10px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;border-top-width:1px;border-bottom-width:1px;}
        .tg th{font-family:Arial, sans-serif;font-size:12px;font-weight:normal;padding:15px 20px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;border-top-width:1px;border-bottom-width:1px;}
        .tg .tg-s6z2{text-align:center}
        .tg .tg-izya{font-size:12px;text-align:center; font-weight: bold;}
    </style>
</head>
<body>
<?php //var_dump($orderDetails);?>
<h2 style="text-align: center;">Заказ № <?php echo $orderDetails[0]["id_all_orders"].'<br>'; echo $orderDetails[0]["datetime"]; ?></h2>
<h3>Заказчик</h3>
<table class="tg">
    <tr>
        <th class="tg-izya">Имя</th>
        <th class="tg-izya">Улица</th>
        <th class="tg-izya">Дом</th>
        <th class="tg-izya">Квартира</th>
        <th class="tg-izya">Телефон</th>
        <th class="tg-izya">E-mail</th>
        <th class="tg-izya">Коментарий</th>
    </tr>
    <?php foreach($orderer as $key=>$val) {?>
        <tr>
            <td class="tg-s6z2">
                <?php echo $val["name_customer"]; ?>
            </td>
            <td class="tg-s6z2">
                <?php echo $val["street"]; ?>
            </td>
            <td class="tg-s6z2">
                <?php echo $val["house"]; ?>
            </td>
            <td class="tg-s6z2">
                <?php echo $val["apartment"]; ?>
            </td>
            <td class="tg-s6z2">
                <?php echo $val["phone"]; ?>
            </td>
            <td class="tg-s6z2">
                <?php echo $val["email"]; ?>
            </td>
            <td class="tg-s6z2">
                <?php echo $val["note"]; ?>
            </td>

        </tr>
    <?php }?>
</table>
<h3>Детали</h3>
<table class="tg">
    <tr>
        <th class="tg-izya">Продукт</th>
        <th class="tg-izya">Количество</th>
        <th class="tg-izya">Диаметр</th>
        <th class="tg-izya">Вес</th>
        <th class="tg-izya">Цена</th>
    </tr>
    <?php foreach($orderDetails as $key=>$val) {?>
        <tr>
                <td class="tg-s6z2">
                    <?php echo $val["name_product"]; ?>
                </td>
            <td class="tg-s6z2">
                <?php echo $val["count_product"]; ?>
            </td>
            <td class="tg-s6z2">
                <?php echo $val["diameter"]; ?>
            </td>
            <td class="tg-s6z2">
                <?php echo $val["weight"]; ?>
            </td>
            <td class="tg-s6z2">
                <?php echo $val["price"]; ?>
            </td>

        </tr>
    <?php }?>
</table>
</body>
</html>