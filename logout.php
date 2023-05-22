<?php include_once __DIR__ . "/assets/php/app.php" ?>
<?php include_once __DIR__ . "/assets/php/admin.php" ?>

<?php 

if ( !chechkIfLoggedIn() )
{
    header("location: index.php");
}

unset($_SESSION["login-status"]);
unset($_SESSION["SSID"]);
unset($_SESSION["SSID-USERNAME"]);
session_destroy();
header("location: index.php?respCode=200&message=logout-success");


?>