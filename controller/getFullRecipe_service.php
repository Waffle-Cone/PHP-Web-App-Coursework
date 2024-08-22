<?php
    header('Content-Type: application/json');
    require_once "../model/startUp.php";

    if(!isset($_REQUEST["title"]))
    {
        echo json_encode([]); // send empty array
    }

    if(isset($_REQUEST["title"]))
    {
        $recipes = getRecipeByTitle($_REQUEST["title"]);
        echo json_encode($recipes);
    }


?>