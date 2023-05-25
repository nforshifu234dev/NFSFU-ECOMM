<?php include_once __DIR__ . "/assets/php/app.php" ?>



<?php



    chechkSiteVisibilityStatusAndRedirect($dbConn);
    chechkNumberOfProductsANdCategoriesAndDisplayMessage( $dbConn );
    $site_titile = getSiteName($dbConn)[0];

    if ( isset( $_GET["category-slug"] ) && !empty( $_GET["category-slug"] ) )
    {

        $id = $_GET["category-slug"];

        $checkIfRecordExist = chechkIfValueExist($dbConn, 'table_categories', "category_slug", $id);

        if ( $checkIfRecordExist != 1 )
        {
            $dir = '../NFSFU-ECOMM/product-not-found.php'; 
            loadPage($dir);
            exit;
        }



        $category = getCategoryDetails($dbConn, $id);

        $categoryName = $category["category_name"];

        $products = getAllProductsWithCategoryName($dbConn, $category["category_slug"]);

        $count = count( $products );

        if ( $count === 0 )
        {
            // echo "HI";
            // $msg = "HI";
            $dir = '../NFSFU-ECOMM/product-not-found.php'; 
            loadPage($dir);
            exit;
        }

        // var_dump($prdoucts);

    }
    else
    {
        load404Page();
        exit;
    }


?>

<?php require_once 'assets/pages/head.php' ?>

    <title> Category '<?php echo $categoryName; ?>'  - <?php echo $site_titile ?></title>
</head>
<body>
    
    <div class="container-fluid">

    <?php require_once 'assets/pages/navigation.php' ?>


        <div class="contents container-fluid">

            <?php require_once 'assets/pages/sidebar.php' ?>

            <?php include_once 'assets/pages/category.php' ?>
            

        </div>

    </div>

    <?php require_once 'assets/pages/footer.php' ?>
