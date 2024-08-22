<?php
 class Account{
    private $username;
    private $password;
    private $customer;
    private $isAdmin = 0;

    function __get($name)
        {
            return $this->$name;
        }
    function __set($name, $value)
    {
        $this->$name = $value;
    }

 }
?>