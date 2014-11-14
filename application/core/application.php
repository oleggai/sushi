<?php
/**
 * Created by PhpStorm.
 * User: олег
 * Date: 17.06.14
 * Time: 10:37
 */
class Application {

    public $url_controller = null;

    private $url_action = null;

    private $url_parametr_1 = null;

    private $url_parametr_2 = null;

    private $url_parametr_3 = null;

    private $user = null;

    public function __construct() {

        session_start();
        $this->splitUrl();
        $this->checkUser();


        if(file_exists("./application/controllers/controller_".$this->url_controller.".php")) {

            require_once "./application/controllers/controller_".$this->url_controller.".php";

            $this->url_controller = "Controller_".$this->url_controller;
            $this->url_controller = new $this->url_controller();

            if(method_exists($this->url_controller, $this->url_action)) {

                if(isset($this->url_parametr_3)) {

                    $this->url_controller->{$this->url_action}($this->url_parametr_1, $this->url_parametr_2, $this->url_parametr_3);
                }
                elseif(isset($this->url_parametr_2)) {

                    $this->url_controller->{$this->url_action}($this->url_parametr_1, $this->url_parametr_2);
                }
                elseif(isset($this->url_parametr_1)) {

                    $this->url_controller->{$this->url_action}($this->url_parametr_1);
                } else {
                    $this->url_controller->{$this->url_action}();
                }
            } else {
                $this->url_controller->index();
            }
        } else {
            require_once "./application/views/404_view.php";
        }
    }

    private function checkUser() {

        if(in_array($this->url_controller, array("admin")) && !$this->isAuthorized()) {

            header("Location: " . URL . "login");
        }
        elseif(in_array($this->url_controller, array("admin")) && $this->isAuthorized()) {
            $this->url_controller = "admin";
        }
        elseif(in_array($this->url_controller, array("login")) && $this->isAuthorized()) {
            $this->url_controller = "admin";
        }
    }
    private function isAuthorized() {
        if(isset($_SESSION['authorized'])){
            $this->user = unserialize($_SESSION["user"]);

            return true;
        }
        else {

            return false;
        }
    }
    private function splitUrl() {
        if(isset($_GET["route"]) && !empty($_GET["route"])) {
           $url = rtrim($_GET["route"], "/");
           $url = filter_var($url, FILTER_SANITIZE_URL);
           $url = explode("/", $url);

           $this->url_controller = (isset($url[0]) ? $url[0] : null);

           $this->url_action = (isset($url[1]) ? $url[1] : null);
           $this->url_parametr_1 = (isset($url[2]) ? $url[2] : null);
           $this->url_parametr_2 = (isset($url[3]) ? $url[3] : null);
           $this->url_parametr_3 = (isset($url[4]) ? $url[4] : null);

/*
            echo "Controller: ".$this->url_controller."<br>";
            echo "Action : ".$this->url_action."<br>";
            echo "1 Parametr: ".$this->url_parametr_1."<br>";
            echo "2 Parametr: ".$this->url_parametr_2."<br>";
            echo "3 Parametr: ".$this->url_parametr_3;
*/
        } else {
            $this->url_controller = "pizza";
            $this->url_action = "index";
        }
    }

}