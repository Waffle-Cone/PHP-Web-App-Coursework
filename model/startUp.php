<?php
    // Classes

    foreach(glob(dirname(__FILE__)."/class/*.php") as $filename)
    {
        require_once $filename;
    }

    // Database
    require_once "../model/data/dataAccess-db.php";
?>