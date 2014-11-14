/**
 * Created by олег on 15.07.14.
 */
$(document).ready(function() {

    var login = null;
    var password = null;

    $("#but_login_admin").bind("click", function() {

        login = $("#login").val();
        password = $("#password").val();

        //alert(login);
        //alert(password);

        sendDataLogin(login, password);
    });
});

function sendDataLogin(login, password) {
    $.ajax({
        dataType: "json",
        url: "/sushi/login/",
        type: "POST",
        data: {
               "login":    login,
               "password": password
        },
        cashe: false,
        success: function(responce) {
            if("error" in responce) {
                //alert(responce.error);
                $("#imessageERROR").html(responce.error);
                $("#imessageERROR").css("display", "block");
                $(".iheader").css("marginBottom", "10px");
            }
            if("authorized" in responce) {
                if(responce.authorized == true) {
                    window.location.href = "/sushi/admin/";
                }
            }
        }
    });
}
