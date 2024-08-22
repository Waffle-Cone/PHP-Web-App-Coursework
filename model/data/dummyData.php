<?php

$cus1 = new Customer();
$cus1->firstName = "Stan";
$cus1->lastName = "Marsh";
$cus1->email = "smarsh@gmail.com";
$cus1->address = "123 West Lane, London";

$cus2 = new Customer();
$cus2->firstName = "Lara";
$cus2->lastName = "Croft";
$cus2->email = "lcroft@gmail.com";
$cus2->address = "234 East Road, London";

$cus3 = new Customer();
$cus3->firstName = "Lionel";
$cus3->lastName = "Messi";
$cus3->email = "lmessi@gmail.com";
$cus3->address = "345 North Avenue, London";

$rec1 = new Recipe();
$rec1->recipeText = "Chocolate Cake";
$rec1->ingredients = ["flour", "eggs", "butter", "chocolate", "milk"];
$rec1->cookingTime = 30; //minutes
$rec1->dietryRestrictions = ["gluten", "dairy"];
$rec1->keywords = ["dessert", "sweet"];

$rec2 = new Recipe();
$rec2->recipeText = "Pasta Bake";
$rec2->ingredients = ["pasta", "tomato sauce", "cream", "chicken", "onion", "cheese"];
$rec2->cookingTime = 40; //minutes
$rec2->dietryRestrictions = ["gluten", "meat", "dairy"];
$rec2->keywords = ["savoury", "italian"];

$rb1 = new RecipeBox();
$rb1->recipe = $rec1;
$rb1->cost = 5; //pounds

$rb2 = new RecipeBox();
$rb2->recipe = $rec2;
$rb2->cost = 10; //pounds

$sb1 = new ShoppingBasket();
$sb1->recipeBoxes = [$rb1];
$sb1->totalCost = $rb1->cost;

$sb2 = new ShoppingBasket();
$sb2->recipeBoxes = [$rb1, $rb2];
$sb2->totalCost = $rb1->cost + $rb2->cost;

$customers = [$cus1, $cus2, $cus3];
$recipes = [$rec1, $rec2];
$recipeBoxes = [$rb1, $rb2];
$shoppingBaskets = [$sb1, $sb2];

?>