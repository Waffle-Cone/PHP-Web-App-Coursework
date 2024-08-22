<?php
//M
    
    require_once "../model/startUp.php";

    if(session_status()==1)
    {
        session_start();
    }


    // Session basket
    if (!isset($_SESSION["basket"]))
    {
        $_SESSION["basket"] = [];    
    }

    $basket= $_SESSION["basket"];

    //session user
    if (!isset($_SESSION["account"]))
    {
        $_SESSION["account"] = new Account;
    }

    $account = $_SESSION["account"];




//C

    if ((!isset($_REQUEST["searchRecipes"]) || $_REQUEST["searchRecipes"] == " ") && !isset($_REQUEST["searchBy"]))
    {   
        $recipes = getAllRecipes();

    }

    else if(!isset($_REQUEST["searchBy"]))
    {
        $recipes = getRecipeByTitle($_REQUEST["searchRecipes"]);
    }

    else if($_REQUEST["searchBy"]=="ingredient")
    {
        $recipes = getRecipeByIngredient($_REQUEST["searchRecipes"]);
    }
    else if($_REQUEST["searchBy"]=="text")
    {
        $recipes = getRecipeByText($_REQUEST["searchRecipes"]);
    }
    else if($_REQUEST["searchBy"]=="keyword")
    {
        $recipes = getRecipeByKeyword($_REQUEST["searchRecipes"]);
    }
    else if($_REQUEST["searchBy"]=="diet")
    {
        $recipes = getRecipeByDiet($_REQUEST["searchRecipes"]);
    }

    else if($_REQUEST["searchBy"]=="time")
    {
        $recipes = getRecipeByCookingTime($_REQUEST["searchRecipes"]);
    }
    


    if (isset($_REQUEST["addToBasket"]))
    {
        $recipeBoxToAdd = getRecipeByTitle($_REQUEST["addToBasket"]); // REMEBER THIS IS AN ARRAY of one object!!!!!!
        $basket[] = $recipeBoxToAdd;
        $_SESSION["basket"] = $basket;
        

    }
    

//V
    require_once "../view/home_view.php";
    
?>