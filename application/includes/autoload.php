<?php
/**
 * Created by PhpStorm.
 * User: олег
 * Date: 17.06.14
 * Time: 10:35
 */
function __autoload($classname) {
    $filename = "application/core/".strtolower($classname).".php";
    if(file_exists($filename)) {
        require_once($filename);
    }
    $filename = "application/controllers/controller_".strtolower($classname).".php";
    if(file_exists($filename)) {
        require_once($filename);
    }
}