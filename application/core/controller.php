<?php
/**
 * Created by PhpStorm.
 * User: олег
 * Date: 17.06.14
 * Time: 10:38
 */
class Controller {

    public $model;

    public $view;

    protected $error = null;

    public $user = null;

    public function __construct() {
        $this->view = new View();
    }
    public function index() {

    }
    public function getError()
    {
        return $this->error;
    }
}