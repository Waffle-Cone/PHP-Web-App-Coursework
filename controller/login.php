<?php
//M
require_once "../model/startUp.php";
//C
session_start();
if (!isset($_SESSION["account"]))
    {
        $_SESSION["account"];
    }

$account = $_SESSION["account"];

$message = false;
$result =[];




if((isset($_REQUEST["username"])&&$_REQUEST["username"]!=" ") && (isset($_REQUEST["password"])&&$_REQUEST["password"]!=" "))
{
    $result = findAccounts($_REQUEST["username"],$_REQUEST["password"]);

    if(empty($result))
    {
        $message = "Username/Password incorrect";
    }
    else
    {
        $account= $result[0];
        $_SESSION["account"] = $account;
        $message = "Welcome! $account->username";
    }

}


require_once "../view/login_view.php";


?>