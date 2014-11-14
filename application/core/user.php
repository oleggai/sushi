<?php
/**
 * Created by PhpStorm.
 * User: олег
 * Date: 15.07.14
 * Time: 9:29
 */
class User {

    protected $id_user = null;

    protected $login = null;

    public function __construct(array $mass) {

        $this->id_user = $mass["id_user"];
        $this->login = $mass["login"];
    }

    /**
     * @return null
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @return null
     */
    public function getLogin()
    {
        return $this->login;
    }
}