<?php
/**
 * Created by PhpStorm.
 * User: олег
 * Date: 22.07.14
 * Time: 15:38
 */
class ValidateImage extends Controller {

    public function validateFileImage($tmp_name_file, $name_file, $size_file) {

        if(empty($tmp_name_file)) {
            $message = "Ошибка! Файл не выбран.";
            $this->view->generateAdminMessage("message.php", $message, TypeError::Error);
            exit();

        }

        if($size_file > 15*1024*1024) {
            $message = "Извините! Загружаемый Вами файл не должен превышать 15 Мб.";
            $this->view->generateAdminMessage("message.php", $message, TypeError::Error );
            exit();
        }

        if(!exif_imagetype($tmp_name_file)) {
            $message = "Извините! Загружаемый Вами файл должен быть картинкой.";
            $this->view->generateAdminMessage("message.php", $message, TypeError::Error );
            exit();
        }
    }
}