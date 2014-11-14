<?php
/**
 * Created by PhpStorm.
 * User: олег
 * Date: 01.07.14
 * Time: 17:11
 */
class Controller_cart extends Controller {

    /**
     * @var null
     */
    protected $id_product = null;

    /**
     * @var null
     */
    protected $id_type_product = null;

    /**
     * @var null
     */
    protected $last_insert_id = null;

    /**
     * @var null
     */
    protected $value_cookie = null;

    /**
     * @var null
     */
    protected $model_cart = null;

    /**
     * @var array
     */
    protected $res = array();

    /**
     *
     */
    public function index() {

        require_once "./application/models/model_cart.php";
        $this->model_cart = new Model_cart();

        try{
            if(isset($_COOKIE["id_cart"])) {
            $this->res = $this->model_cart->checkOrderHash($_COOKIE["id_cart"]);
            }
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }

        if(isset($this->res[0]["id_order_hash"]) && !empty($this->res[0]["id_order_hash"])) {

            try {
            $data_cart = $this->model_cart->selectCart($this->res[0]["id_order_hash"]);
            $data_sum_cart = $this->model_cart->selectSumPrice($this->res[0]["id_order_hash"]);
            }
            catch(Exception $e) {
                echo $e->getMessage();
            }
            $this->view->generate("cart.php", "main.php", $data_cart, $data_sum_cart);
        }
        else {
            $this->view->generate("cart.php", "main.php");
        }
    }

    /**
     *
     */
    public function add_cart() {

        $mass_sum_count = array();
        require_once "./application/models/model_cart.php";

        $this->model_cart = new Model_cart();
        $mass = Validate::trim($_POST);

        if(isset($mass["id_product"]) && isset($mass["id_type_product"])) {
            $this->id_product = $mass["id_product"];
            $this->id_type_product = $mass["id_type_product"];
        }

        if(isset($_COOKIE["id_cart"])) {

            try {
                $this->res = $this->model_cart->checkOrderHash($_COOKIE["id_cart"]);
            }
            catch(Exception $e) {
                echo $e->getMessage();
            }

            if(isset($this->res[0]["id_order_hash"])) {
                //echo $res[0]["id_order_hash"];
                //echo "есть такая кука в базе";

                try {
                    $insert_res = $this->model_cart->insertIntoCart($this->id_product, $this->id_type_product, $this->res[0]["id_order_hash"]);

                    $update_res = $this->model_cart->updateDateTimeInOrderHash($this->res[0]["id_order_hash"]);
                    if(!$update_res) {
                        echo json_encode(array("message"=>"Извините! Произошла техническая ошибка"));
                        exit();
                    }

                    $mass_sum_count = $this->allSumCount($insert_res);

                    Cookie::setCookie($_COOKIE["id_cart"], $mass_sum_count[0]["sum_price"], $mass_sum_count[0]["all_count_product"]);

                    if($insert_res) {
                        echo json_encode(array(
                                               "message"   => true,
                                               "all_sum"   => $mass_sum_count[0]["sum_price"],
                                               "all_count" => $mass_sum_count[0]["all_count_product"]
                                           ));
                    }
                    else {
                        echo json_encode(array("message"=>false));
                    }
                }
                catch(Exception $e) {
                    echo $e->getMessage();
                }

            }
            else{
                // Хеш из базы удалили. Пользователь не заходил например больше недели. Корзину очистили
                $this->insertNewCart();
            }

        }
        else {
            $this->insertNewCart();
        }

    }

    /**
     *
     */
    public function insertNewCart() {

        $this->value_cookie = Cookie::generateHashCookie();
        $mass = array();

        try {
            $this->last_insert_id = $this->model_cart->insertOrderHash($this->value_cookie);
            $insert_res = $this->model_cart->insertIntoCart($this->id_product, $this->id_type_product, $this->last_insert_id);

            $mass = $this->allSumCount($insert_res);
            if($insert_res) {
                echo json_encode(array(
                                       "message"=>true,
                                       "all_sum"   => $mass[0]["sum_price"],
                                       "all_count" => $mass[0]["all_count_product"]
                                      ));
            }
            else {
                echo json_encode(array("message"=>false));
            }
        }
        catch(Exception $e) {
            $e->getMessage();
        }

        Cookie::removeCookie();
        Cookie::setCookie($this->value_cookie, $mass[0]["sum_price"], $mass[0]["all_count_product"]);
    }

    /**
     *
     */
    public function changeCountProduct() {

        require_once "./application/models/model_cart.php";

        $this->model_cart = new Model_cart();
        $mass_ajax = array();

        if(isset($_POST["id_cart"]) && isset($_POST["flag"])) {
            $mass = Validate::trim($_POST);
            if(!in_array($mass["flag"], array("1", "2"))) {
                exit();
            }
            try {
                $mass_ajax["count_product"] = $this->model_cart->changeCountProduct($mass["id_cart"], $mass["flag"]);
                $mass_ajax["all_price"] = $this->model_cart->allPrice($mass["id_cart"]);
                $mass_ajax["all_sum_count"] = $this->allSumCount($mass["id_cart"]);

                $id_hash = $this->model_cart->checkOrderHash($_COOKIE["id_cart"]);
                $update_res = $this->model_cart->updateDateTimeInOrderHash($id_hash[0]["id_order_hash"]);
                if(!$update_res) {
                    echo json_encode(array("message"=>"Извините! Произошла техническая ошибка"));
                    exit();
                }

                Cookie::setCookie($_COOKIE["id_cart"],
                                  $mass_ajax["all_sum_count"][0]["sum_price"],
                                  $mass_ajax["all_sum_count"][0]["all_count_product"]);

                echo json_encode(array(
                                      "count_product" => $mass_ajax["count_product"]["count_product"],
                                      "all_price" => $mass_ajax["all_price"]["all_price"],
                                      "all_sum" => $mass_ajax["all_sum_count"][0]["sum_price"],
                                      "all_count" =>$mass_ajax["all_sum_count"][0]["all_count_product"]
                                ));

            }
            catch(Exception $e) {
                $e->getMessage();
            }
        }

    }

    /**
     * @param $id_cart
     *
     * @return mixed
     */
    public function allSumCount($id_cart) {
        require_once "./application/models/model_cart.php";

        $this->model_cart = new Model_cart();
        return $this->model_cart->allSumCount($id_cart);
    }

    /**
     *
     */
    public function delProductFromCart() {
        $mass_ajax = array();
        require_once "./application/models/model_cart.php";

        $this->model_cart = new Model_cart();

        if(isset($_POST["id_cart"]) && !empty($_POST["id_cart"])) {
            try {
                $hash = $this->model_cart->checkOrderHash($_COOKIE["id_cart"]);

                if(isset($hash[0]["id_order_hash"])) {

                    $res = $this->model_cart->delProductFromCart($_POST["id_cart"], $hash[0]["id_order_hash"]);
                    $update_res = $this->model_cart->updateDateTimeInOrderHash($hash[0]["id_order_hash"]);
                    if(!$update_res) {
                        echo json_encode(array("message"=>"Извините! Произошла техническая ошибка"));
                        exit();
                    }

                } else {
                    exit();
                   }

                if($res) {
                    $mass_ajax = $this->model_cart->selectSumPrice($hash[0]["id_order_hash"]);

                    Cookie::setCookie($_COOKIE["id_cart"], $mass_ajax[0]["sum_price"], $mass_ajax[0]["all_count_product"]);

                    echo json_encode(array(
                            "message"=>true,
                            "all_sum" => $mass_ajax[0]["sum_price"],
                            "all_count" =>$mass_ajax[0]["all_count_product"]
                        ));
                } else {
                    echo json_encode(array("message"=>false));
                  }
             }
            catch(Exception $e) {
                echo $e->getMessage();
             }
    }
        else {
            exit();
        }
    }

    /**
     *
     */
    public function addIntoAllOrders() {

        require_once "./application/models/model_cart.php";

        $this->model_cart = new Model_cart();
        if(isset($_POST["name_customer"]) && isset($_POST["street"]) && isset($_POST["house"]) && isset($_POST["phone"])
             && !empty($_POST["name_customer"]) && !empty($_POST["street"]) && !empty($_POST["house"]) && !empty($_POST["phone"])) {

            $mass = Validate::trim($_POST);
            //$mass = Lang::changeEncoding($mass);

            if(!Validate::isEmail($mass["email"])) {
                echo json_encode(array("message"=>"Введите корректный E-mail!"));
                exit();
            }
            $hash = $this->model_cart->checkOrderHash($_COOKIE["id_cart"]);
            $res = $this->model_cart->insertIntoAllOrders($hash[0]["id_order_hash"],$mass["name_customer"], $mass["street"],
                                                          $mass["house"], $mass["apartment"],
                                                          $mass["phone"], $mass["email"], $mass["note"]);

            $lastInsertId = $this->model_cart->insertIntoNewOrders($hash[0]["id_order_hash"]);

            $update_res = $this->model_cart->updateDateTimeInOrderHash($hash[0]["id_order_hash"]);
            if(!$update_res) {
                echo json_encode(array("message"=>"Извините! Произошла техническая ошибка"));
                exit();
            }

            if($res) {
              echo json_encode(array("insert" => "Спасибо! Ваш заказ успешно принято.<br>В ближайшее время наша курьерская служба доставит Ваш заказ по указаному адресу."));
              Cookie::removeCookie();



            } else {
                echo json_encode(array("message"=> "Извините! Ваш заказ не принято по техническим причинам.
                                                    Наш ИТ отдел решает эту проблему."));
            }
        }
        else {
            echo json_encode(array("message"=>"Вернитесь и заполните все поля!"));
        }
    }
}