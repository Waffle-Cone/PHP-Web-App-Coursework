<?php

    require_once "../model/startUp.php";
    session_start();

    
    if (!isset($_SESSION["basket"]))
    {
        $_SESSION["basket"] = [];
    }

    $basket = $_SESSION["basket"];
    $price =0;


    foreach($basket as $lists)
   {
        foreach($lists as $item)
        {
            $price = $price + $item->cost;
        } 
   }


    require_once "../view/basket_view.php";

?>