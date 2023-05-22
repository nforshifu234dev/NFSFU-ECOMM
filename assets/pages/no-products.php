<?php include_once "assets/php/app.php" ?>

<?php
if ( chechkIfLoggedIn() )
{
    $userDetails = getUserDetailsUsingUsername($dbConn, $_SESSION["SSID-USERNAME"] );
}


$total_number_of_products = count(getAllProducts($dbConn));
$total_number_of_categories = count(getAllCategories($dbConn));
$site_titile = getSiteName($dbConn)[0];

?>

<?php require_once 'assets/pages/head.php' ?>

    <title><?php echo $site_titile ?> - No Products</title>
</head>
<body>
    
    <div class="container-fluid">

        <?php require_once 'assets/pages/navigation.php' ?>


        <div class="contents container-fluid" style="text-align: center;display:flex;justify-content:center;align-items:center;flex-direction:column;" >
            
            <?php echo $message; ?>
            
        </div>
    </div>

</body>
</html>