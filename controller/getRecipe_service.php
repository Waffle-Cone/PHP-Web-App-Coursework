<?php
header('Content-Type: application/json');
require_once "../model/startUp.php";

if (!isset($_REQUEST["title"]) && !isset($_REQUEST["text"]) && !isset($_REQUEST["ingredient"]) && !isset($_REQUEST["keyword"]) &&!isset($_REQUEST["diet"]) &&!isset($_REQUEST["time"]))
{
  echo json_encode([]); // send empty array
}
else
{
    if(isset($_REQUEST["title"]))
    {
        $recipes = getRecipeByStartOfTitle($_REQUEST["title"]);
        echo json_encode($recipes);
    }
    else if(isset($_REQUEST["text"]))
    {
        $recipes = getRecipeByStartOfText($_REQUEST["text"]);
        echo json_encode($recipes);
    }
    else if(isset($_REQUEST["ingredient"]))
    {
        $recipes = getRecipeByStartOfIngredient($_REQUEST["ingredient"]);
        echo json_encode($recipes);
       
    }
    else if(isset($_REQUEST["keyword"]))
    {
        $recipes = getRecipeByStartOfKeyword($_REQUEST["keyword"]);
        echo json_encode($recipes);
    }
    else if(isset($_REQUEST["diet"]))
    {
        $recipes = getRecipeByStartOfDiet($_REQUEST["diet"]);
        echo json_encode($recipes);
    }
    else if(isset($_REQUEST["time"]))
    {
        $recipes = getRecipeByStartOfTime($_REQUEST["time"]);
        echo json_encode($recipes);
    }
    

  
}
?>


