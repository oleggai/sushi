<?php
/**
 * Created by PhpStorm.
 * User: олег
 * Date: 14.07.14
 * Time: 15:57
 */
class Controller_login extends Controller {

    public function index() {
        $mass = array();
        //echo json_encode(array("login"=>$_POST["login"], "password"=>$_POST["password"]));
        if(!isset($_POST['login']) || !isset($_POST['password'])) {
            require_once './application/views/admin/login.php';
            return;
        }
        $model = new Model();
        ($model->db == null) ? $model->openDatabaseConnection() : "" ;
        require_once "./application/models/model_login.php";
        $login_model = new Model_login();

        $mass = Validate::trim($_POST);
        $check_validate = Validate::isLogin($mass["login"]);

        if(!$check_validate) {
            echo json_encode(array("error"=>"Неверно введен логин или пароль!"));
            exit();
        }
        $check_validate = Validate::isPassword($mass["password"]);

        if(!$check_validate) {
            echo json_encode(array("error"=>"Неверно введен логин или пароль!"));
            exit();
        }
        try{
            $mass = $login_model->checkLogin($mass["login"], $mass["password"]);
            if($mass) {
                       $this->user = new User($mass);
                       $_SESSION['user'] = serialize($this->user);
                       $_SESSION['authorized'] = true;
                       echo json_encode(array("authorized"=>$_SESSION['authorized']));

              }
            else {
                  echo json_encode(array("error"=>"Неверно введен логин или пароль!"));
                  exit();
                }
        }
        catch(Exception $e) {
            echo json_encode(array("error"=>"error database"));
        }
    }
}