<?php
    class Recipe implements JsonSerializable{
        //private $recipe_ID;
        private $recipeTitle;
        private $recipeShort;
        private $recipeText;
        private $ingredientText;
        private $cookingTime;
        private $ingredients = [];
        private $dietaryRestrictions = [];
        private $keywords = [];

        //recipe box
        private $isBox;
        private $cost;
        

        function __get($name)
        {
            return $this->$name;
        }

        function __set($name, $value)
        {
            $this->$name = $value;
        }

        function addIngredient($ingredient)
        {
            $this->ingredients[] = $ingredient;
        }

        function addKeyword($keyword)
        {
            $this->keywords[] = $keyword;
        }

        function addRestriction($restriction)
        {
            $this->dietaryRestrictions[] = $restriction;
        }

        public function jsonSerialize()
        {
            return get_object_vars($this);
        }



    }

?>