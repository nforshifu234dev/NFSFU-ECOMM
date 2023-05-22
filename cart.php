<?php include_once __DIR__ . "/assets/php/app.php" ?>

<?php
    chechkSiteVisibilityStatusAndRedirect($dbConn);

chechkNumberOfProductsANdCategoriesAndDisplayMessage( $dbConn );

if ( chechkIfLoggedIn() )
{
    $userDetails = getUserDetailsUsingUsername($dbConn, $_SESSION["SSID-USERNAME"] );
}

?>

<?php require_once 'assets/pages/head.php' ?>

    <title>My Cart - <?php echo $site_titile ?></title>
</head>
<body>
    
    <div class="container-fluid">

        <?php require_once 'assets/pages/navigation.php' ?>

            <div class="contents container">

                <?php require_once 'assets/pages/sidebar.php' ?>


                
                <?php require_once 'coming-soon.php' ?>


            </div>

    </div>

    <?php require_once 'assets/pages/footer.php' ?>