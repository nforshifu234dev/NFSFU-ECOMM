<?php include_once __DIR__ . "/assets/php/app.php" ?>
<?php 
define("PARENT_DIR", __DIR__);

if ( !chechkIfLoggedIn() )
{
    header("location: login.php?returnUrl=" . htmlspecialchars($_SERVER['PHP_SELF']) );
}
$userDetails = getUserDetailsUsingUsername($dbConn, $_SESSION["SSID-USERNAME"] );

if ( $userDetails['user_role'] != 'super-admin'  )
{
    load404Page();
    exit;
}

$siteDetails = getAllSiteInformation($dbConn);


?>

<?php require_once 'assets/pages/admin/head.php' ?>

    <title> SITE INFORMATION - <?php echo $site_titile ?></title>

    

</head>
<body>
    
    <div class="container-fluid">

        <?php require_once 'assets/pages/admin/navigation.php' ?>


        <div class="contents container-fluid">

            <?php require_once 'assets/pages/admin/sidebar.php' ?>


            <?php require_once 'assets/pages/site-detail.php' ?>
            


        </div>

    </div>

</body>
</html>