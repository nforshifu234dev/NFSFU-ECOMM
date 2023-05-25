<?php include_once __DIR__ . "/assets/php/app.php" ?>
<?php 

if ( !chechkIfLoggedIn() )
{
    header("location: login.php?returnUrl=" . htmlspecialchars($_SERVER['PHP_SELF']) );
}
$userDetails = getUserDetailsUsingUsername($dbConn, $_SESSION["SSID-USERNAME"] );

if ( $userDetails['user_role'] != 'super-admin' && $userDetails['user_role'] != 'product-manager'  )
{
    load404Page();
    exit;
}

?>
<?php 

if( $_SERVER["REQUEST_METHOD"] === "GET" )
{
    
    if ( isset( $_GET["category-slug"] ) && !empty( $_GET["category-slug"] ) )
    {

        

        $id = $_GET["category-slug"];


        $checkIfRecordExist = chechkIfValueExist($dbConn, 'table_categories', "category_slug", $id);

        if ( $checkIfRecordExist != 1 )
        {
            $dir = '../bolu-site/product-not-found.php'; 
            loadPage($dir);
            exit;
        }

        $category = getCategoryDetails($dbConn, $id);

        $category_name = $category["category_name"];
        $category_slug = $category["category_slug"];
       

    }
    else
    {
            load404Page();
            exit;
    }

}

if( $_SERVER["REQUEST_METHOD"] === "POST" )
{

    if ( !isset( $_POST["updateCategory"] ) ){ exit; }
    if ( !isset( $_GET["category-slug"] ) || empty( $_GET["category-slug"] ) ){ exit; };

    $id = $_GET["category-slug"];


    $checkIfRecordExist = chechkIfValueExist($dbConn, 'table_categories', "category_slug", $id);

    if ( $checkIfRecordExist != 1 )
    {
        echo "Category Not FOund";
        exit;
    }

    $category = getCategoryDetails($dbConn, $id);

    $category_name = $category["category_name"];
    $category_slug = $category["category_slug"];

    $u_category_name = trim($_POST["category_name"]);



    $responseArray = array();

    if ( !hash_equals( $category_name, $u_category_name ) )
    {
        $a_category_slug = strtolower($u_category_name);
        $a_category_slug = preg_replace("/\s+/", "-", $a_category_slug);

        if ( updateCategoryDetailInDB($dbConn, "table_categories", "category_name", $category_slug, $u_category_name ) === true && updateCategoryDetailInDB($dbConn, "table_categories", "category_slug", $category_slug, $a_category_slug ) === true )
        {

            $productsWithCategoryName = getAllProductsWithCategoryName($dbConn, $category_name);


            foreach( $productsWithCategoryName as $productCategoryName )
            {

                if ( updateProductDetailInDB($dbConn, "table_products", "product_category", $productCategoryName["product_id"], $a_category_slug ) )
                {

                    array_push( $responseArray, true );

                }

            }

        }
        else
        {
            array_push( $responseArray, true );
            array_push( $responseArray, false );

        }

    }     
    
    else
    {
        array_push( $responseArray, true );
    }



    if ( count( array_unique( $responseArray ) ) != 1 )
    {
        $_SESSION["error_msg"] = "An Error Occured. We have sent the trace logs to the admins.";
        $_SESSION["error_bg"] = "bg-failure";
        header("Location:" . htmlspecialchars($_SERVER['PHP_SELF']) . "?category-slug=" . $a_category_slug . "&respCode=400&msg=success");
    }
    else
    {
        $_SESSION["error_msg"] = "Successfully Updated";
        $_SESSION["error_bg"] = "bg-success";
        header("Location:" . htmlspecialchars($_SERVER['PHP_SELF']) . "?category-slug=" . $a_category_slug . "&respCode=200&msg=success");
    }


}

?>


<?php require_once 'assets/pages/admin/head.php' ?>

    <title> Edit Category - <?php echo $category_name; ?> - <?php echo $site_titile ?></title>
</head>
<body>
    
    <div class="container-fluid">

    <?php require_once 'assets/pages/admin/navigation.php' ?>


        <div class="contents container-fluid">

            <?php require_once 'assets/pages/admin/sidebar.php' ?>

            <div class="page-contents">

                <section class="product-category">

                    <div class="heading">
                        
                        <div class="details">
                            <h2> <i class="fa fa-pencil"></i> Edit Category: <span><?php echo $category_name; ?></span>  </h2>
                        </div>

                    </div>

                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?category-slug=" . $category_slug  ?>" class="add-new-product-form ">

                        <div class="form-group mt-3 mb-3">

                            <label class="mb-3" for="category_name">Category Name <span>*</span></label>
                            <input type="text" class="form-control" name="category_name" id="category_name" itemid="category_name" itemtype="input" value="<?php echo $category_name; ?>" placeholder="Ex. Category 1, Category 2, Category 3, ... " required>

                        </div>

                        <div class="form-group mt-3 mb-3 text-end">

                            <button type="submit" name="updateCategory" class="btn btn-primary" > <i class="fas fa-upload"></i> Update Category</button>

                        </div>


                    </form>
                    

                </section>
                

            </div>

        </div>

    </div>

</body>
</html>