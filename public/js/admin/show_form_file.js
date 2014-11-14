var id_product = null;


$(document).ready(function() {

    var coords = {};
    $(".a_chnage_img").bind("click", function() {

        coords = $(this).offset();

        var tr =  $(this).closest("tr");

        id_product = $(tr).attr("id-product");
        $("input[name = 'id_product']").val(id_product);
        $(".box").css({top: coords.top - 100, left: coords.left - 800});

        $("#opacity").fadeTo(500, 0.7);
        $(".box").fadeTo(2000, 100);

        $("body, html").animate({
            "scrollTop" : coords.top - 100
        }, 250 );
    });

    $("#close_form_file").bind("click", function() {

        $(".box, #opacity").animate({
            "opacity": 0
        }, 300, function() {
            $(".box, #opacity").css("display","none");
        });
    });
});
