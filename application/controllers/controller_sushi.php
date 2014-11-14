<?php
/**
 * Created by PhpStorm.
 * User: олег
 * Date: 20.06.14
 * Time: 16:24
 */
class Controller_sushi extends Controller {
    public function index() {
        require_once "./application/models/model_sushi.php";
        $model = new Model_sushi();
        $list_sushi = $model->select_product(TypeCategory::Sushi);
        $this->view->generate("view_list_sushi.php", "main.php", $list_sushi);
    }

}