<?php
/**
 * Created by PhpStorm.
 * User: олег
 * Date: 08.07.14
 * Time: 14:21
 */
class Validate {


    /**
     * @param array $mass
     *
     * @return array
     */
    static public function trim(array $mass) {
        $res = array();
        foreach($mass as $key=>$val) {
        $res[$key] = strip_tags(trim($val));
        }
        return $res;
    }

    /**
     * @param $login
     *
     * @return bool
     */
    static function isLogin($login) {
        $pattern_login = "/^[a-z0-9_-]{3,16}$/";
        return preg_match($pattern_login, $login)? true : false;
    }

    /**
     * @param $password
     *
     * @return bool
     */
    static function isPassword($password) {
        $pattern_password = "/^[a-z0-9_-]{6,18}$/";
        return preg_match($pattern_password, $password)? true : false;
    }

    /**
     * @param $email
     *
     * @return bool
     */
    static function isEmail($email) {
        $pattern_email = "/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/";
        return preg_match($pattern_email, $email)? true : false;
    }

    /**
     * @param $name_file
     *
     * @return string
     */
    static public function validateNameFile($name_file) {

        return strip_tags(trim($name_file));
    }

}