<?php
/**
 * Created by PhpStorm.
 * User: олег
 * Date: 14.07.14
 * Time: 16:50
 */
class Model_login extends Model {

    public function __construct() {
        $this->OpenDatabaseConnection();
    }
    public function checkLogin($login, $password) {
        try{
            $mass = array();
            $sql = "SELECT id_user, login FROM users WHERE login = :login AND password = MD5(CONCAT(salt,:password))";

            $query = $this->db->prepare($sql);
            $query->execute(array(
                                 ":login"    => $login,
                                 ":password" => $password
                         ));
            $mass = $query->fetch();
            if(isset($mass["id_user"]) && !empty($mass["id_user"])) {
                return $mass;
            }
            else {
                return false;
            }
        }
        catch(Exception $e) {
            $this->setError(new Error($e->getMessage(), TypeError::Error, $e->getCode()));
            throw new Exception("Database error! Did not select login from database");
        }
    }
}