<?php
/**
 * Created by PhpStorm.
 * User: олег
 * Date: 14.07.14
 * Time: 10:48
 */
class Cookie {

    static public function setCookie($id_cart, $sum_price, $all_count_product) {
        setcookie("id_cart", $id_cart, time() + 3600*24*7, "/");
        setcookie("all_sum", $sum_price, time() + 3600*24*7, "/");
        setcookie("all_count", $all_count_product, time() + 3600*24*7, "/");
    }

    static public function generateHashCookie() {
        return md5(time().rand(10000, 9999));
    }

    static public function removeCookie() {

        setcookie("id_cart", "", time() - 3600*24*7, "/");
        setcookie("all_sum", "", time() - 3600*24*7, "/");
        setcookie("all_count", "", time() - 3600*24*7, "/");
    }
}