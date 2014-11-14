/**
 * Created by олег on 25.07.14.
 */

var id_category = null;
var id_new_product = null;
$(document).ready(function() {

    $(".h1_add_product").bind("click", function() {

        $("#div_form_add_product").slideToggle();
    })

    $("#button_add_product").bind("click", function() {

        var name_product = $("#name_new_product").val();
        var compound = $("#compound_new_product").val();
        id_category = $(this).closest("#div_add_product").attr("id-category");

        sendNewProduct(name_product, compound, $(this));

    });

    $("#button_add_type_product").bind("click", function() {
        var diameter = $("#diameter_new_product").val();
        var weight = $("#weight_new_product").val();
        var price = $("#price_new_product").val();

        sendNewTypeProduct(diameter, weight, price, $(this));
    });
});


function sendNewProduct(name_product, compound, button) {
    //alert(name_product);
    //alert(compound);
    $.ajax({
        dataType: "json",
        url: "/sushi/admin/addNewProduct",
        type: "POST",
        data: {
            "id_category": id_category,
            "name_product": name_product,
            "compound": compound
        },
        success: function(responce) {
            if("message" in responce) {
                $(button).next().append(responce.message);
                $(button).next().fadeTo(1000, 100);

                $(button).attr("disabled","");
                $("#div_form_add_type_product").slideToggle();
                id_new_product = responce.id_new_product;

                setTimeout(function() {

                        $(button).next().animate({"opacity": 0}, 1500, function() {
                            $(button).next().html("");
                        });
                    }
                , 3000);
            }
            if("error" in responce) {
                alert(responce.error);
            }
        }
    });
}

function sendNewTypeProduct(diameter, weight, price, button) {
    //alert(diameter);
    //alert(weight);
    //alert(price);
    $.ajax({
        dataType: "json",
        url: "/sushi/admin/addNewTypeProduct",
        type: "POST",
        data: {
            "diameter": diameter,
            "weight": weight,
            "price": price,
            "id_new_product": id_new_product
        },
        success: function(responce) {
            if("message" in responce) {
                alert(responce.message);
                window.location.reload();
            }
            if("error" in responce) {
                alert(responce.error);
            }
        }
    });
}