<?php
    class DietaryRestriction implements JsonSerializable{

        private $restriction_ID; // only for dataAccess usage
        private $restriction;

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