/**
 * Created by олег on 13.11.14.
 */
var timeout;
var currentCount;
var audio;
$(document).ready(function() {
    audio = $("#sound")[0];
    timeout = setTimeout(function run(){
        currentCount = $(".new_orders").html();
        checkNewOrder();
        timeout = setTimeout(run, 5000);
    }, 500);
});

function checkNewOrder() {
    $.ajax({
        dataType: "json",
        url: "/sushi/admin/checkNewOrder",
        success: function(responce) {
            if("count" in responce) {
                if(responce.count != '0') {
                    if(currentCount != ("+" + responce.count)) {
                        loadNewOrder();
                        audio.play();
                        currentCount = "+" + responce.count;
                    }
                    $(".new_orders").html("+" + responce.count);
                    //audio.play();
                }
            }
        }
    });
}

function loadNewOrder() {
    var serviced;
    var color;
    $.ajax({
        dataType: "json",
        url: "/sushi/admin/loadNewOrder",
        success: function(responce) {
            //alert(responce.newOrders);
            for(var i in responce.newOrders) {
                var tr = $("<tr></tr>");

/*                alert(responce.newOrders[i].id_all_orders);
                alert(responce.newOrders[i].id_order_hash);
                alert(responce.newOrders[i].name_customer);
                alert(responce.newOrders[i].street);
                alert(responce.newOrders[i].house);
                alert(responce.newOrders[i].apartment);
                alert(responce.newOrders[i].phone);
                alert(responce.newOrders[i].email);
                alert(responce.newOrders[i].note);
                alert(responce.newOrders[i].datetime);*/
                $(tr).append('<td class="tg-s6z2">' + responce.newOrders[i].id_all_orders + '</td>');
                $(tr).append('<td class="tg-s6z2">' + responce.newOrders[i].name_customer + '</td>');
                $(tr).append('<td class="tg-s6z2">' + responce.newOrders[i].street + '</td>');
                $(tr).append('<td class="tg-s6z2">' + responce.newOrders[i].house + '</td>');
                $(tr).append('<td class="tg-s6z2">' + responce.newOrders[i].apartment + '</td>');
                $(tr).append('<td class="tg-s6z2">' + responce.newOrders[i].phone + '</td>');
                $(tr).append('<td class="tg-s6z2">' + responce.newOrders[i].email + '</td>');
                $(tr).append('<td class="tg-s6z2">' + responce.newOrders[i].note + '</td>');
                $(tr).append('<td class="tg-s6z2">' + responce.newOrders[i].datetime + '</td>');
                if(responce.newOrders[i].serviced == '0') {
                    serviced = "Не обслужено";
                    color = "red";
                }
                else {
                    serviced = "Обслужено";
                    color = "blue";
                }
                $(tr).append('<td class="tg-s6z2"><span style="color: '+ color +'">'+ serviced +'</span></td>')
                $(tr).append('<td class="tg-s6z2">' +
                    '<a href="/sushi/admin/orderDetails/'+ responce.newOrders[i].id_all_orders +'">Посмотреть</a>' + '<br>' +
                    '<a class="change_status" style="cursor: pointer;" id_all_orders = "' + responce.newOrders[i].id_all_orders + '">Сменить статус</a>' +
                    '</td>');
                $(".tg").find("tr").eq(0).after(tr);
                $(".change_status").unbind("click");
                $(".change_status").bind("click",k);
            }
        }
    });
}