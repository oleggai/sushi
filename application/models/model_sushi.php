<?php
/**
 * Created by PhpStorm.
 * User: олег
 * Date: 20.06.14
 * Time: 16:25
 */
class Model_sushi extends Model {

    public function __construct() {
        $this->OpenDatabaseConnection();
    }
}