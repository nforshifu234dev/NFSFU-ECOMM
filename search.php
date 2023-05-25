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

?>

<?php

if( $_SERVER["REQUEST_METHOD"] === "GET" )
{
    
    if ( isset( $_GET["q"] ) && !empty( $_GET["q"] ) )
    {

        

        $query = $_GET["q"];
        $searchTerm = $query;


        



       

    }
    else
    {
        load404Page();
        exit;
    }

}

?>

<?php require_once 'assets/pages/head.php' ?>

    <title> Search Results on ' <?php echo $searchTerm; ?> '  - <?php echo $site_titile ?></title>
</head>
<body>
    
    <div class="container-fluid">

        <?php require_once 'assets/pages/navigation.php' ?>


            <div class="contents container-fluid">

                <?php require_once 'assets/pages/sidebar.php' ?>

                <?php require_once 'assets/pages/search.php' ?>
                

            </div>


    </div>

    <?php require_once 'assets/pages/footer.php' ?>