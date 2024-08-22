<?php
//M
    require_once "../model/startUp.php";
   
//C
        // session_start();
        $status = false;

    /*/building up if statment because it gets way too long.
        $requests = array('$_REQUEST["title"]','$_REQUEST["description"]','$_REQUEST["ingredientList"]','$_REQUEST["instructions"]','$_REQUEST["time"]','$_REQUEST["keywords"]');
        $ifStatements="";
        foreach ($requests as $r)
        {
            $ifStatements= "("."isset"."(".$r.")"."&&".$r."!=".'" "'.")"."&&".$ifStatements;
        }
    $ifStatements= substr($ifStatements, 0, -2);*/

    //form processing to ad recipe
    if((isset($_REQUEST["keywords"])&&$_REQUEST["keywords"]!=" ")&&(isset($_REQUEST["time"])&&$_REQUEST["time"]!=" ")&&(isset($_REQUEST["instructions"])&&$_REQUEST["instructions"]!=" ")&&(isset($_REQUEST["ingredientList"])&&$_REQUEST["ingredientList"]!=" ")&&(isset($_REQUEST["description"])&&$_REQUEST["description"]!=" ")&&(isset($_REQUEST["title"])&&$_REQUEST["title"]!=" ") )
    {
        $title = $_REQUEST["title"];
        $description = $_REQUEST["description"];
        $ingredientList = $_REQUEST["ingredientList"];
        $instructions = $_REQUEST["instructions"];
        $time = $_REQUEST["time"];
        $keywords = $_REQUEST["keywords"];
        $isBox = $_REQUEST["choice"];
        $cost = $_REQUEST["cost"];
        
        if(!isset($_REQUEST["restrictions"]))
        {
            $restrictions[] = "None";
        }
        else
        {
            $restrictions = $_REQUEST["restrictions"];
        }

        if(!isset($_REQUEST["choice"]) || $_REQUEST["choice"] == "0")
        {
            $cost = 0;
            $isBox = 0;
        }

        $recipe = new Recipe();

        $ingredientSplit= explode(",",$ingredientList); // seperating each amount-ingredient combo //

    // $ingredients = [];

        foreach($ingredientSplit as $line)
        {
            $seperate= explode(") ",$line);  //seperating amount from the ingredient
            
            //$ingredients[]= $seperate[1] ;

            $recipe->addIngredient(htmlentities($seperate[1])); //adding ingredient to new recipe object

        }

    // dealing with restrictions //
        foreach($restrictions as $restriction)
        {
            $recipe->addRestriction(htmlentities($restriction)); // adding all selectied restrictions to new recipe object
        }
    // dealing with keywords //
        foreach($keywords as $keyword)
        {
            $recipe->addKeyword(htmlentities($keyword)); // adding all selectied keywords to new recipe object
        }
            
        
        $recipe->recipeTitle= htmlentities($title);
        $recipe->recipeShort= htmlentities($description);
        $recipe->recipeText= htmlentities($instructions);
        $recipe->ingredientText= htmlentities($ingredientList); 
        $recipe->cookingTime= htmlentities($time);
        $recipe->isBox= htmlentities($isBox);
        $recipe->cost= htmlentities($cost);

        //passing a single recipe onject which has all the info i need in dataAccess
        $status = addNewRecipe($recipe); // addNewRecipe returns a string of either  "This recipe exists" or "new Recipe added"

    }


//v
    require_once "../view/addRecipe_view.php";
?>