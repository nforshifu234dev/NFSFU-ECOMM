<?php include_once __DIR__ . "/assets/php/app.php" ?>

<?php 
    chechkSiteVisibilityStatusAndRedirect($dbConn);

if ( chechkIfLoggedIn() )
{
    // header("location: login.php?returnUrl=" . htmlspecialchars($_SERVER['PHP_SELF']) );
    $userDetails = getUserDetailsUsingUsername($dbConn, $_SESSION["SSID-USERNAME"] );
}



?>

<?php

if( $_SERVER["REQUEST_METHOD"] === "GET" )
{
    
    if ( isset( $_GET["product-slug"] ) || isset( $_GET["product-id"] ) )
    {

        
        if ( !empty( $_GET["product-slug"] ) )
        {

            $id = $_GET["product-slug"];

        }
        elseif ( !empty( $_GET["product-id"] ) )
        {

            $id = $_GET["product-id"];

        }
        else
        {
            // echo "HJIN";
            load404Page();
            exit;
        }

        // echo $id;
        // exit;

        $checkIfRecordExist = chechkIfValueExist($dbConn, 'table_products', "product_slug", $id);

        if ( $checkIfRecordExist != 1 )
        {
            
            $checkIfRecordExist = chechkIfValueExist($dbConn, 'table_products', "product_id", $id);
            if ( $checkIfRecordExist != 1 )
            {
                
                // echo $message;
                $dir = '../NFSFU-ECOMM/product-not-found.php'; 
                loadPage($dir);
                exit;

            }

        }

        

        $product = getProductsDetails($dbConn, $id);

        // chechking if the product is visible to the general public 

        if ( $product["product_visibility"] != 1 )
        {

            // Here we are chehking if a user is logged and the user is either a super admin or a Product Manager or the user has the access to view unpublished products

            if ( 
                !isset( $_SESSION["login-status"] ) 
                && !isset( $_SESSION["login-status"] ) === TRUE 
                || getUserDetailsUsingUsername($dbConn, $_SESSION["SSID-USERNAME"])["user_role"] === "superadmin"
                || getUserDetailsUsingUsername($dbConn, $_SESSION["SSID-USERNAME"])["user_role"] === "productManager"
            )
            {

                $dir = '../NFSFU-ECOMM/product-not-found.php'; 
                loadPage($dir);
                exit; 

            }

            
        }

        $product_name = $product["product_name"];
        $product_id = $product["product_id"];
        $product_category = $product["product_category"];
        $product_short_description = $product["short_description"];
        $product_current_price = $product["product_curr_price"];
        $product_previous_price = $product["product_prev_price"];
        $product_long_description = $product["long_description"];

        $product_images = $product["product_img"];

        $product_images = explode(",", $product_images);

        

    }
    else
    {

        // echo "PAGE NOT FOUND";
        
        load404Page();

        exit;


    }

}

if( $_SERVER["REQUEST_METHOD"] === "POST" )
{

}


?>


<?php require_once 'assets/pages/head.php' ?>

    <title> <?php echo $product_name; ?> - <?php echo $site_titile ?></title>
</head>
<body>
    
    <div class="container-fluid">

        <?php require_once 'assets/pages/navigation.php' ?>

        <div class="contents container-fluid">

            <?php require_once 'assets/pages/sidebar.php' ?>

            <div class="page-contents">

                <section class="product-category">

                    <?php 

                        if ( 
                            $product['product_visibility'] !=  "1"
                           
                            
                        ):

                        if ( isset( $userDetails['user_role'] ) && $userDetails['user_role'] == 'super-admin' || $userDetails['user_role'] == 'product-manager'  ):

                        // var_dump($product['product_visibility']);

                    ?>

                    <div class="bg-info text-danger text-center text-capitalize p-2">
                        <h1>This product is not yet published. <a href="edit-product.php?product-id=prdct-LhYNXFQHidD42zf9Gxrq3ZgbjREBCTKO5M6Psc8S">click here</a> to make it public </h1>
                    </div>

                    <?php endif; endif; ?>

                    <div class="heading">
                        
                        <div class="details">
                            <h2>Product Information: <span> <?php echo $product_name; ?> </span></h2>
                        </div>

                        <?php if ( chechkIfLoggedIn() && $userDetails["user_role"] === "super-admin" ): ?>

                            <a href="edit-product.php?product-id=<?php echo $product_id ?>">
                            
                                <button class="btn btn-primary">
                                    <i class="fas fa-pen"> </i> Edit This Product
                                </button>

                            </a>

                        <?php endif; ?>

                    </div>

                    <div class="product-details create-product">

                        <div class="details">

                            <div class="product-name">
                                <?php echo $product_name; ?>
                            </div>

                            <div class="single-product-category mt-3 mb-3">
                                <h4 class="grey-text" >
                                    <i class="fas fa-tags"></i>
                                    <a href="category.php?category-slug=<?php echo $product_category ?>">
                                        <?php echo $product_category ?>
                                    </a>
                                </h4>
                            </div>

                            <div class="product-short-description">

                                <h4 class="grey-text"> <i class="fas fa-info-circle"></i> Product Details:</h4>

                                <p>
                                    <?php echo $product_short_description ?>
                                </p>
                            </div>

                            <div class="product-price">
                                <span class="curr-price" ><?php echo CURRENCY_SYMBOL . $product_current_price ?></span>
                                <?php  if ( floatval($product_previous_price) != 0 ): ?>
                                    <span class="prev-price" ><?php echo CURRENCY_SYMBOL . $product_previous_price ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="product-qty">
                                <label for="quantity(ies)">quantity(ies)</label>
                                <input type="number" min="1" value="1" name="" id="" placeholder="Enter the quantity you want to purchase..." >
                            </div>

                            <div class="product-btn">
                                <button class="btn btn-danger" > <i class="fas fa-shopping-cart"></i> Add to cart </button>
                            </div>

                            

                            

                        </div>

                        <div class="images">

                            <div class="hero-image">
                                <img src="<?php echo $product_images[0] ?>" alt="">
                            </div>

                            <div class="sub-images">

                                <?php foreach ( $product_images as $key => $imageUrl ): ?>

                                    <?php if( !empty( $imageUrl ) ): ?>
                                        <div class="item">
                                            <img src="<?php echo $imageUrl; ?>" alt="">
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                            </div>

                        </div>

                    </div>

                    <?php if ( !empty( $product_long_description ) ): ?>
                        <div class="product-long-description">
                            <div class="heading">
                                <h2 class="grey-text" > <i class="fas fa-link"></i> Additional Details</h2>

                            </div>
                            <p>
                                
                                <?php echo $product_long_description ?>

                            </p>
                        </div>
                    <?php endif; ?>

                </section>
                

            </div>

        </div>

    </div>
    <?php require_once 'assets/pages/footer.php' ?>