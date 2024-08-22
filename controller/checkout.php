<?php
//M
    require_once "../model/startUp.php";
//C
    session_start();

        if (!isset($_SESSION["basket"]))
        {
            $_SESSION["basket"] = [];
        }
        $basket = $_SESSION["basket"];


        if (!isset($_SESSION["account"]))
        {
            $_SESSION["account"];
        }
        $account = $_SESSION["account"];

    $price =0;
    $isCheckedOut = false;

    foreach($basket as $lists)
    {
        foreach($lists as $item)
        {
            $price = $price + $item->cost;
        } 
    }

    /*/building up if statment because it gets way too long.
        $requests = array('$_REQUEST["firstName"]','$_REQUEST["lastName"]','$_REQUEST["email"]','$_REQUEST["address"]');
        $ifStatements="";
        foreach ($requests as $r)
        {
            $ifStatements= "("."isset"."(".$r.")"."&&".$r."!=".'" "'.")"."&&".$ifStatements;
        }
    $ifStatements= substr($ifStatements, 0, -2);*/

   if((isset($_REQUEST["address"])&&$_REQUEST["address"]!=" ")&&(isset($_REQUEST["email"])&&$_REQUEST["email"]!=" ")&&(isset($_REQUEST["lastName"])&&$_REQUEST["lastName"]!=" ")&&(isset($_REQUEST["firstName"])&&$_REQUEST["firstName"]!=" "))
   {
        $firstName = htmlentities($_REQUEST["firstName"]);
        $lastName = htmlentities($_REQUEST["lastName"]);
        $email = htmlentities($_REQUEST["email"]);
        $address = htmlentities($_REQUEST["address"]);

        $customer = new Customer();

        $customer->firstName = $firstName;
        $customer->lastName  = $lastName;
        $customer->email = $email;
        $customer->address = $address;

        

        


   }    






//V
require_once "../view/checkout_view.php";

?>