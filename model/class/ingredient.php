<?php
    class Ingredient implements JsonSerializable{
        private $ingredient_ID;// only for dataAccess usage
        private $ingredient;

        function __get($name)
        {
            return $this->$name;
        }

        public function jsonSerialize()
        {
            return get_object_vars($this);
        }

    }

?>