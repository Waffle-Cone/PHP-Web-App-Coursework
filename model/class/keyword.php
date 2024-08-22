<?php
    class Keyword implements JsonSerializable{

        private $keyword_ID; // only for dataAccess usage
        private $keyword;

        function __get($name)
        {
            return $this->$name;
        }

       public function jsonSerialize()
        {
            return get_object_vars($this);

            /*return [
                "keyword_ID" => $this->keyword_ID,
                "keyword" => $this->keyword,
              ];*/
        }

    }

?>