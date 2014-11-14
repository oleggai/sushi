/**
 * Created by олег on 25.07.14.
 */

$(document).ready(function() {

    $(".a_del_product").bind("click", function() {
        if(confirm("Вы действительно хотите удалить товар?")) {
            tr = $(this).closest("tr");
            id_product = $(tr).attr("id-product");
            delProduct(id_product);
        }
    });

});

function delProduct(id_product) {
    $.ajax({
        dataType: "json",
        url: "/sushi/admin/delProduct",
        type: "POST",
        data: {
            "id_product": id_product
        },
        cashe: false,
        success: function(responce) {
            if("message" in responce) {
                $(tr).remove();
            }
            if("error" in responce) {
                alert(responce.error);
            }
        }
    });
}
