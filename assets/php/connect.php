<?php

    require_once "variables.php";



    $Dsn = "mysql:host=localhost;port=3306;dbname=" . $dbName;
    $username = "root";
    $password = "";
            

    //create a pdo options array
    $Options = array(
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );

    try 
    {
        $connectionHandler = new PDO($Dsn, $username, $password, $Options);
    } 
    catch (Exception $e) {
        echo '<center><h1>Couldn\'t Establish A Database Connection. Due to the following reason: ' . $e->getMessage() . '. Kindly wait for redirection.</h1></center>';
        file_put_contents("status.file", 0);
        header( "refresh:5;url=installation.php" );
        exit;
    }



?>