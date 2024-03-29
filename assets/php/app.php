<?php

    require_once "config.php";
    require_once "functions/functions.php";

    
    if ( chechkIfDataBaseExists($dbConn, $dbName ) != 1 )
    {
        file_put_contents("status.file", 0);
        header("location: installation.php");
        exit;
    }
    

    
    $categories = getAllCategories($dbConn);

    session_start();

    date_default_timezone_set("Africa/Lagos");

    $site_titile = getSiteName($dbConn)[0];

    $_SESSION['site_title'] = $site_titile;

    if ( !chechkIfLoggedIn() )
    {
        ini_set("display_errors", false);
    }
    else
    {
        ini_set("display_errors", true);
    }




?>