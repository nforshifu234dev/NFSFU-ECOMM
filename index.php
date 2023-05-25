<?php include_once __DIR__ . "/assets/php/app.php" ?>

<?php

    chechkSiteVisibilityStatusAndRedirect($dbConn);
    
    chechkNumberOfProductsANdCategoriesAndDisplayMessage( $dbConn );

if ( chechkIfLoggedIn() )
{
    $userDetails = getUserDetailsUsingUsername($dbConn, $_SESSION["SSID-USERNAME"] );
}


$total_number_of_products = count(getAllProducts($dbConn));
$total_number_of_categories = count(getAllCategories($dbConn));

chechkSiteVisibilityStatusAndRedirect($dbConn);

?>

<?php require_once 'assets/pages/head.php' ?>

    <title><?php echo $site_titile ?> - Home</title>
</head>
<body>
    
    <div class="container-fluid">

        <?php require_once 'assets/pages/navigation.php' ?>

            <div class="contents container">

                <?php require_once 'assets/pages/sidebar.php' ?>


                
                <?php require_once 'assets/pages/products-display.php' ?>


            </div>

    </div>

<?php require_once 'assets/pages/footer.php' ?>