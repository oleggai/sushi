<?php
/**
 * Created by PhpStorm.
 * User: Oleg
 * Date: 12.06.14
 * Time: 16:05
 */

class Error {
    private $message = null;

    /** @var null Тип сообщения:
     * $type = error
     * $type = message
     * В зависимости от типа сообщения мы можем менять соответствующие CSS-свойства для элементов разметки.
     * Или же делать какие-то другие действия
     */
    private $type = null;

    private $code = null;

    public function __construct($msg, $type, $code = 0){
        $this->message = $msg;
        $this->type = $type;
        $this->code = $code;
    }
    /**
     * @param null $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return null
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param null $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return null
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Возвращает тип сообщения
     * @return null
     */
    public function getTypeMessage() {
        return $this->type;
    }

} 