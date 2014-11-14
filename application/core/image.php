<?php
/**
 * Created by PhpStorm.
 * User: олег
 * Date: 22.07.14
 * Time: 17:27
 */
class Image {

    static public function returnParamImage($id_category) {

        // Если файл не был загружен
        if(!isset($_FILES["image_file"]["tmp_name"])) {
            return false;
        }
        $tmp_name_file = $_FILES["image_file"]["tmp_name"];
        $name_file = $_FILES["image_file"]["name"];
        $size_file = $_FILES["image_file"]["size"];

        require_once "./application/models/model_admin.php";
        $model_admin = new Model_admin();

        return array(
                     "model_admin"    => $model_admin,
                     "tmp_name_file"  => $tmp_name_file,
                     "name_file"      => $name_file,
                     "size_file"      => $size_file,
                 );
    }
}