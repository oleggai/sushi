<?php
/**
 * Created by PhpStorm.
 * User: олег
 * Date: 15.07.14
 * Time: 9:37
 */
class Controller_admin extends Controller {

    /**
     *
     */
    public function index() {

        require_once "./application/models/model_admin.php";
        $model_admin = new Model_admin();

        $short_view = array();
        try{
            $short_view["all_sum"] = $model_admin->allSum();
            $short_view["count_orders"] = $model_admin->countOrders();
            $short_view["count_customers"] = $model_admin->countCustomers();
            $short_view["count_new_orders"] = $model_admin->countNewOrders();
            $short_view["count_active_cart"] =$model_admin->countActiveCart();
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }

        $this->view->generateAdmin("view_short.php", "admin.php", $short_view);
    }

    /**
     *
     */
    public function allOrders() {

        require_once "./application/models/model_admin.php";
        $model_admin = new Model_admin();

        $orders = $model_admin->allOrders();
        $this->view->generateAdmin("view_all_orders.php", "admin.php", $orders);
    }

    public function orderDetails($idOrder) {
        require_once "./application/models/model_admin.php";
        $model_admin = new Model_admin();
        $orderDetails = $model_admin->selectOrderDetails($idOrder);
        $orderer = $model_admin->selectInfoOrderer($idOrder);
        require_once "./application/views/admin/view_order.php";
    }

    public function changeStatus() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $idOrder = $_POST["idOrder"];
        }
        require_once "./application/models/model_admin.php";
        $model_admin = new Model_admin();
        try {
            $res = $model_admin->changeStatus($idOrder);
            if($res) {
                echo json_encode(array("res"=>true));
            }
            else {
                echo json_encode(array("res"=>false));
            }
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }

    }

    public function checkNewOrder() {
        require_once "./application/models/model_admin.php";
        $model_admin = new Model_admin();
        try {
           $count = $model_admin->checkNewOrder();
            //var_dump($_SESSION["idOrders"]);
          echo json_encode(array("count" => $count["count"]));
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    public function loadNewOrder() {
        require_once "./application/models/model_admin.php";
        $model_admin = new Model_admin();

        try {
            $idNewOrders = $model_admin->selectNewOrders();
            $newOrders = $model_admin->loadNewOrder($idNewOrders);
             //var_dump($newOrders);

            echo json_encode(array("newOrders" => $newOrders));

            $model_admin->deleteFromNewOrders();
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }
    /**
     *
     */
    public function allPizza() {

        require_once "./application/models/model_admin.php";
        $model_admin = new Model_admin();

        $pizza = $model_admin->selectAllPizzaSushiDrinks(TypeCategory::Pizza);
        //file_put_contents("PDOerrors.txt", $pizza, FILE_APPEND);
        $this->view->generateAdmin("view_category.php", "admin.php", $pizza, TypeCategory::Pizza);
    }

    /**
     *
     */
    public function allSushi() {

        require_once "./application/models/model_admin.php";
        $model_admin = new Model_admin();

        $sushi = $model_admin->selectAllPizzaSushiDrinks(TypeCategory::Sushi);
        $this->view->generateAdmin("view_category.php", "admin.php", $sushi, TypeCategory::Sushi);
    }

    /**
     *
     */
    public function changeNameProduct() {

        require_once "./application/models/model_admin.php";
        $model_admin = new Model_admin();

        if(isset($_POST["name_product"]) && !empty($_POST["name_product"])) {
            $mass = Validate::trim($_POST);
            try{
            $res = $model_admin->changeNameProduct($mass["id_product"], $mass["name_product"]);
                if($res) {
                    echo json_encode(array("message"=>"Название продукта успешно изменено!"));
                }
                else {
                    echo json_encode(array("error"=>"Извините! Произошла техническа ошибка."));
                }
            }
            catch(Exception $e) {
                echo $e->getMessage();
            }

        }
        else {
            echo json_encode(array("error"=>"Извините! Произошла техническая ошибка"));
        }
        //echo json_encode(array("name"=>$_POST["name_product"]));
    }

    /**
     *
     */
    public function changeCompoundProduct() {

        require_once "./application/models/model_admin.php";
        $model_admin = new Model_admin();

        if(isset($_POST["compound"]) && !empty($_POST["compound"])) {
            $mass = Validate::trim($_POST);
            try{
                $res = $model_admin->changeCompoundProduct($mass["id_product"], $mass["compound"]);
                if($res) {
                    echo json_encode(array("message"=>"Состав продукта успешно изменено!"));
                }
                else {
                    echo json_encode(array("error"=>"Извините! Произошла техническа ошибка."));
                }
            }
            catch(Exception $e) {
                echo $e->getMessage();
            }

        }
        else {
            echo json_encode(array("error"=>"Извините! Произошла техническая ошибка."));
        }
    }

    /**
     *
     */
    public function changeTypeProduct() {

        require_once "./application/models/model_admin.php";
        $model_admin = new Model_admin();

        if(isset($_POST["id_type"]) && isset($_POST["diameter"]) && isset($_POST["weight"]) && isset($_POST["price"])) {
            $mass = Validate::trim($_POST);
            try{
                $res = $model_admin->changeTypeProduct($mass["id_type"],
                                                       $mass["diameter"],
                                                       $mass["weight"],
                                                       $mass["price"]);
                if($res) {
                    echo json_encode(array("message"=>"Тип продукта успешно изменено!"));
                }
                else {
                    echo json_encode(array("error"=>"Извините! Произошла техническа ошибка"));
                }
            }
            catch(Exception $e) {
                echo $e->getMessage();
            }

        }
        else {
            echo json_encode(array("error"=>"Извините! Произошла техническая ошибка."));
        }
    }

    /**
     * @param $id_category
     */
    public function loadSmallImage($id_category) {

        // Получаем параметры файла.
        // Пути формируются в зависимости id_category
        $mass_param = Image::returnParamImage($id_category);

        switch($id_category) {

            case TypeCategory::Pizza:
                $image = ConstPath::pathDbSmallImgPizza.$mass_param["name_file"];
                $file_directory = ConstPath::pathDirectorySmallImgPizza;
                break;

            case TypeCategory::Sushi:
                $image = ConstPath::pathDbSmallImgSushi.$mass_param["name_file"];
                $file_directory = ConstPath::pathDirectorySmallImgSushi;
                break;

            case TypeCategory::Drinks:
                $image = ConstPath::pathDbSmallImgDrinks.$mass_param["name_file"];
                $file_directory = ConstPath::pathDirectorySmallImgDrinks;
                break;
        }

        // Если файл не был загружен
        // Например пользователь выбрал слишком большой файл и сервер отсек этот файл в соответствии с своими настройками:
        // upload_max_filesize or post_max_size и тд
        if(!$mass_param) {

            $message = "Извините! Произошла ошибка при загрузке файла.";

            $this->view->generateAdminMessage("message.php", $message, TypeError::Error );
        }

        $validate_img = new ValidateImage();
        $validate_img->validateFileImage($mass_param["tmp_name_file"], $mass_param["name_file"], $mass_param["size_file"]);

        // Режутся пробелы и экранируются теги
        $mass_param["name_file"] = Validate::validateNameFile($mass_param["name_file"]);
        $mass_post = Validate::trim($_POST);


        try {
            // Вытаскиваем значение image_large до обновления.
            // В случае ошыбки перемещения файла зделать откат, обновить поле до предыдущего значения
            $value_before_update = $mass_param["model_admin"]->selectSmallImage($mass_post["id_product"]);
            $res = $mass_param["model_admin"]->updateSmallImage($mass_post["id_product"], $image);
        }
        catch(Exception $e) {
            $e->getMessage();
        }

        // Если НЕ произошло обновления, то выход
        if(!$res) {
            $message = "Извините! Произошла ошибка при загрузке файла.";

            $this->view->generateAdminMessage("message.php", $message, TypeError::Error );
            exit();
        }

        if(move_uploaded_file($mass_param["tmp_name_file"], $file_directory.$mass_param["name_file"])) {

            $message = "Файл успешно загружен!";
            $this->view->generateAdminMessage("message.php", $message, TypeError::Message );
        }
        else {
            // Если не удалось переместить файл
            // Обновляем image до предыдущего значения
            $mass_param["model_admin"]->updateBigImage($mass_post["id_product"], $value_before_update["image"]);
            $message = "Извините! Произошла ошибка при загрузке файла.";

            $this->view->generateAdminMessage("message.php", $message, TypeError::Error );
        }
    }


    /**
     * @param $id_category
     */
    public function loadBigImage($id_category) {

        // Получаем параметры файла.
        // Пути формируются в зависимости id_category
        $mass_param = Image::returnParamImage($id_category);

        switch($id_category) {

            case TypeCategory::Pizza:
                $image = ConstPath::pathDbBigImgPizza.$mass_param["name_file"];
                $file_directory = ConstPath::pathDirectoryBigImgPizza;
                break;

            case TypeCategory::Sushi:
                $image = ConstPath::pathDbBigImgSushi.$mass_param["name_file"];
                $file_directory = ConstPath::pathDirectoryBigImgSushi;
                break;

            case TypeCategory::Drinks:
                $image = ConstPath::pathDbBigImgDrinks.$mass_param["name_file"];
                $file_directory = ConstPath::pathDirectoryBigImgDrinks;
                break;
        }

        // Если файл не был загружен
        // Например пользователь выбрал слишком большой файл и сервер отсек этот файл в соответствии с своими настройками:
        // upload_max_filesize or post_max_size и тд
        if(!$mass_param) {

            $message = "Извините! Произошла ошибка при загрузке файла.";

            $this->view->generateAdminMessage("message.php", $message, TypeError::Error );
            exit();
        }
        $validate_img = new ValidateImage();

        // Проверяется: Выбрал ли пользователь файл, размер файла, файл должен буть картинкой
        $validate_img->validateFileImage($mass_param["tmp_name_file"], $mass_param["name_file"], $mass_param["size_file"]);

        // Режутся пробелы и экранируются теги
        $mass_param["name_file"] = Validate::validateNameFile($mass_param["name_file"]);
        $mass_post = Validate::trim($_POST);

        try {

            // Вытаскиваем значение image_large до обновления.
            // В случае ошыбки перемещения файла зделать откат, обновить поле до предыдущего значения
            $value_before_update = $mass_param["model_admin"]->selectBigImage($mass_post["id_product"]);
            $res = $mass_param["model_admin"]->updateBigImage($mass_post["id_product"], $image);
        }
        catch(Exception $e) {
            $e->getMessage();
        }

        // Если НЕ произошло обновления, то выход
        if(!$res) {
            $message = "Извините! Произошла ошибка при загрузке файла.";

            $this->view->generateAdminMessage("message.php", $message, TypeError::Error );
            exit();
        }

        if(move_uploaded_file($mass_param["tmp_name_file"], $file_directory.$mass_param["name_file"])) {

            $message = "Файл успешно загружен!";
            $this->view->generateAdminMessage("message.php", $message, TypeError::Message );
        }
        else {
            // Если не удалось переместить файл
            // Обновляем image_large до предыдущего значения
            $mass_param["model_admin"]->updateBigImage($mass_post["id_product"], $value_before_update["image_large"]);
            $message = "Извините! Произошла ошибка при загрузке файла.";

            $this->view->generateAdminMessage("message.php", $message, TypeError::Error );
        }
    }

    /**
     *
     */
    public function delTypeProduct() {

        require_once "./application/models/model_admin.php";
        $model_admin = new Model_admin();

        $mass_post = Validate::trim($_POST);

        try{
        $row = $model_admin->delTypeProduct($mass_post["id_type"]);
            if($row) {
                echo json_encode(array("message" => "Тип товара успешно удалено"));
            }
            else {
                echo json_encode(array("error" => "Извините! Произошла техническая ошибка. Тип товара не удален."));
            }
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     *
     */
    public function addTypeProduct() {

        require_once "./application/models/model_admin.php";
        $model_admin = new Model_admin();

        $mass_post = Validate::trim($_POST);

        try{
            $row = $model_admin->addTypeProduct($mass_post["id_product"], $mass_post["diameter"],
                                                $mass_post["weight"], $mass_post["price"]);
            if($row) {
                echo json_encode(array(
                                       "message" => "Тип товара успешно добавлено!",
                                       "id_type" => $row
                                     ));
            }
            else {
                echo json_encode(array("error" => "Извините! Произошла техническая ошибка. Тип товара не добавлено."));
            }
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     *
     */
    public function delProduct() {

        require_once "./application/models/model_admin.php";
        $model_admin = new Model_admin();

        $mass_post = Validate::trim($_POST);
        try{
            $row = $model_admin->delProduct($mass_post["id_product"]);
            if($row) {
                echo json_encode(array(
                        "message" => "Товар удален :(",
                    ));
            }
            else {
                echo json_encode(array("error" => "Извините! Произошла техническая ошибка. Товар не удален."));
            }
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     *
     */
    public function allDrinks() {

        require_once "./application/models/model_admin.php";
        $model_admin = new Model_admin();

        $drinks = $model_admin->selectAllPizzaSushiDrinks(TypeCategory::Drinks);
        //file_put_contents("PDOerrors.txt", $pizza, FILE_APPEND);
        $this->view->generateAdmin("view_drinks.php", "admin.php", $drinks, TypeCategory::Drinks);
    }

    /**
     *
     */
    public function changeTypeDrinks() {

        require_once "./application/models/model_admin.php";
        $model_admin = new Model_admin();

        $mass_post = Validate::trim($_POST);
        try {
        $res = $model_admin->updateTypeDrinks($mass_post["id_type"], $mass_post["weight"], $mass_post["price"]);
            if($res) {
                echo json_encode(array("message" => "Тип продукта успешно изменен!"));
            }
            else {
                echo json_encode(array("error" => "Извините! Произошла техническая ошибка. Тип продукта не изменен."));
            }
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     *
     */
    public function changeNameDrinks() {

        require_once "./application/models/model_admin.php";
        $model_admin = new Model_admin();

        $mass_post = Validate::trim($_POST);
        try {
            $res = $model_admin->updateNameDrinks($mass_post["id_product"], $mass_post["name_product"]);
            if($res) {
                echo json_encode(array("message" => "Имя продукта успешно изменен!"));
            }
            else {
                echo json_encode(array("error" => "Извините! Произошла техническая ошибка. Имя продукта не изменено."));
            }
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    public function addProduct() {
        $this->view->generateAdmin("view_add_product.php", "admin.php");
    }

    public function addNewProduct() {

        require_once "./application/models/model_admin.php";
        $model_admin = new Model_admin();

        $mass_post = Validate::trim($_POST);

        if(empty($mass_post["name_product"]) && empty($mass_post["compound"])) {
            echo json_encode(array("error"=>"Вернитесь и заполните все поля!"));
            exit();
        }

        try {
            $id_product = $model_admin->addNameCompoundProduct($mass_post["name_product"], $mass_post["compound"], $mass_post["id_category"]);
            if($id_product) {
                echo json_encode(array(
                                      "message"        => "Товар успешно добавлен :)",
                                      "id_new_product" => $id_product
                                  ));
            }
            else {
                echo json_encode(array("error"=>"Извините! Произршла техническая ошибка. Товар не добавлен :("));
            }
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }


    }
    public function addNewTypeProduct() {

        require_once "./application/models/model_admin.php";
        $model_admin = new Model_admin();

        $mass_post = Validate::trim($_POST);

        if(empty($mass_post["diameter"]) && empty($mass_post["weight"]) && empty($mass_post["price"])) {
            echo json_encode(array("error"=>"Вернитесь и заполните все поля!"));
            exit();
        }

        try {
            $res = $model_admin->addNewTypeProduct($mass_post["id_new_product"], $mass_post["diameter"],
                                                               $mass_post["weight"], $mass_post["price"]);
            if($res) {
                echo json_encode(array( "message" => 'Продукт успешно создан! Для добавления изображения перейдите к поцизии продукта и нажмите "Сменить изображение" :)'));
            }
            else {
                echo json_encode(array("error"=>"Извините! Произршла техническая ошибка. Тип товара не добавлен :("));
            }
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }

}