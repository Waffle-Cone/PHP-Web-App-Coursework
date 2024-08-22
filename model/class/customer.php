<?php
    class Customer{
        private $firstName;
        private $lastName;
        private $email;
        private $address;
        private $hasAccount = false;

        function __get($name)
        {
            return $this->$name;
        }

        function __set($name, $value)
        {
            $this->$name = $value;
        }
        
        function getFullName()
        {
            return $this->firstName . " " . $this->lastName;
        }
    }
?>