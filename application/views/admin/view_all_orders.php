<style type="text/css">
    .tg  {width: 100%; border-collapse:collapse;border-spacing:0;border-color:#ccc;}
    .tg td{font-family:Arial, sans-serif;font-size:12px;padding:10px 10px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;border-top-width:1px;border-bottom-width:1px;}
    .tg th{font-family:Arial, sans-serif;font-size:12px;font-weight:normal;padding:15px 20px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;border-top-width:1px;border-bottom-width:1px;}
    .tg .tg-s6z2{text-align:center}
    .tg .tg-izya{font-size:12px;text-align:center; font-weight: bold;}
</style>
<table class="tg">
    <tr>
        <th class="tg-izya">Id Заказа</th>
        <th class="tg-izya">Имя</th>
        <th class="tg-izya">Улица</th>
        <th class="tg-izya">Дом</th>
        <th class="tg-izya">Квартира</th>
        <th class="tg-izya">Телефон</th>
        <th class="tg-izya">E-mail</th>
        <th class="tg-izya">Коментарий</th>
        <th class="tg-izya">Дата заказа</th>
        <th class="tg-izya">Статус</th>
        <th class="tg-izya">Действие</th>
    </tr>
    <?php foreach($data as $key=>$val) {?>
    <tr>
        <?php foreach($val as $key=>$value) {?>
        <td class="tg-s6z2">
            <?php
            if($key == "serviced") {
                if($value == '0') {
                    echo "<span style='color: red;'>Не обслужено</span>";
                    continue;
                }
                if($value == '1') {
                    echo "<span style='color: blue;'>Обслужено</span>";
                    continue;
                }
            }
            echo $value;
            ?>
        </td>
        <?php }?>

        <td class="tg-s6z2">
            <a href="<?php echo URL;?>admin/orderDetails/<?php echo $val["id_all_orders"];?>" target="_blank" style="cursor: pointer;">Посмотреть</a>
            <a class="change_status" id_all_orders = "<?php echo $val["id_all_orders"];?>" style="cursor: pointer;">Сменить статус</a>
        </td>
    </tr>
    <?php }?>
</table>

<script>
    var elem = null;
    $(document).ready(function() {
        $(".change_status").bind("click",k);
    });

  function k()  {
      elem =$(this);
      var idAllOrders = $(this).attr("id_all_orders");
      var res = confirm("Вы действительно хотите сменить статус?");
      if(res) {
          changeStatus(idAllOrders);
      }
      else {
          return 0;
      }
  }
function changeStatus(idAllOrders) {
    //alert(idAllOrders);
    $.ajax({
        dataType: "json",
        url: "/sushi/admin/changeStatus",
        type: "POST",
        data: {
            "idOrder": idAllOrders
        },
        success: function(responce) {
           if("res" in responce) {
              // alert(responce.res);
               var tr = $(elem).closest("tr");
               $(tr).find("td").eq(9).html("<span style='color: blue;'>Обслужено</span>")

           }
        }
    });
}
</script>