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
    
    if ( isset( $_GET["product-id"] ) && !empty( $_GET["product-id"] ) )
    {

        

        $id = $_GET["product-id"];


        $checkIfRecordExist = chechkIfValueExist($dbConn, 'table_products', "product_id", $id);

        if ( $checkIfRecordExist != 1 )
        {
            //echo "Product Not FOund";
            $dir = '../bolu-site/product-not-found.php'; 
            loadPage($dir);
            exit;
        }

        $product = getProductsDetails($dbConn, $id);

        $product_name = $product["product_name"];
        $product_id = $product["product_id"];
        $product_category = $product["product_category"];
        $product_visibility = $product["product_visibility"];
        $product_short_description = $product["short_description"];
        // $product_short_description = $product["short_description"];
        $product_current_price = $product["product_curr_price"];
        $product_previous_price = $product["product_prev_price"];
        $product_long_description = $product["long_description"];


    }
    else
    {
        //echo "HJIN";
        load404Page();
            exit;
    }

}

if( $_SERVER["REQUEST_METHOD"] === "POST" )
{

    if ( !isset( $_POST["updateProduct"] ) ){ load404Page();exit; }
    if ( !isset( $_GET["product-id"] ) || empty( $_GET["product-id"] ) ){ load404Page();exit; };

    $id = $_GET["product-id"];


    $checkIfRecordExist = chechkIfValueExist($dbConn, 'table_products', "product_id", $id);

    if ( $checkIfRecordExist != 1 )
    {
        //echo "Product Not FOund";
        load404Page();exit;
    }

    $product = getProductsDetails($dbConn, $id);

    $u_product_name = trim($_POST["product_name"]);
    $u_product_price = trim($_POST["product_price"]);
    $u_product_category = trim($_POST["product_category"]);
    $u_product_visibility = trim($_POST["product_visibility"]);
    $u_product_short_description = trim($_POST["product_short_description"]);
    $u_product_long_description = trim($_POST["product_long_description"]);
    $u_product_images = $_FILES["product_images"];

    $product_name = $product["product_name"];
    $product_id = $product["product_id"];
    $product_visibility = $product["product_visibility"];
    $product_category = $product["product_category"];
    $product_images = $product["product_img"];
    $product_short_description = $product["short_description"];
    $product_current_price = $product["product_curr_price"];
    $product_previous_price = $product["product_prev_price"];
    $product_long_description = $product["long_description"];

    $responseArray = array();

    if ( !hash_equals( $product_name, $u_product_name ) )
    {
        // //echo "PRODUCT NAME IS NOT THE SAME <br>";
        $product_slug = strtolower($u_product_name);
        $product_slug = preg_replace("/\s+/", "-", $product_slug);


        // echo $product_slug;

        if ( updateProductDetailInDB($dbConn, "table_products", "product_name", $product_id, $u_product_name ) === true && updateProductDetailInDB($dbConn, "table_products", "product_slug", $product_id, $product_slug ) === true )
        {
            array_push( $responseArray, true );
        }
        else
        {
            //echo "T";
            array_push( $responseArray, true );
            array_push( $responseArray, false );

        }

    }     
    else
    {
        array_push( $responseArray, true );
    }

    if ( !hash_equals( $product_current_price, $u_product_price ) )
    {
        // //echo "PRODUCT NAME IS NOT THE SAME <br>";
        $product_slug = trim($u_product_price);
        $product_slug = floatval($u_product_price );
        

        // $product_slug = preg_replace("/\s+/", "-", $product_slug);

        if ( 
            updateProductDetailInDB($dbConn, "table_products", "product_prev_price", $product_id, $product_current_price ) === true 
            && updateProductDetailInDB($dbConn, "table_products", "product_curr_price", $product_id, $u_product_price ) === true 
        )
        {
            array_push( $responseArray, true );
        }
        else
        {
            //echo "T";
            array_push( $responseArray, true );
            array_push( $responseArray, false );

        }

    }     
    else
    {
        array_push( $responseArray, true );
    }

    if ( !hash_equals( $product_category, $u_product_category ) )
    {
        // //echo "CATEGORY IS NOT THE SAME <br>";
        if ( updateProductDetailInDB($dbConn, "table_products", "product_category", $product_id, $u_product_category ) )
        {
            array_push( $responseArray, true );
        }
        else
        {
            array_push( $responseArray, true );
            array_push( $responseArray, false );
            //echo "h";

        }
        
    }
    else
    {
        array_push( $responseArray, true );
    }

    if ( !hash_equals( $product_short_description, $u_product_short_description ) )
    {
        // //echo "SHORT DESCRIPTION IS NOT THE SAME <br>";
        if ( updateProductDetailInDB($dbConn, "table_products", "short_description", $product_id, $u_product_short_description ) )
        {
            array_push( $responseArray, true );
        }
        else
        {
            array_push( $responseArray, true );
            array_push( $responseArray, false );
            //echo "R";

        }
        
    }
    else
    {
        array_push( $responseArray, true );
    }

    if ( !hash_equals( $product_long_description, $u_product_long_description ) )
    {
        // //echo "LONG DESCRIPTION IS NOT THE SAME <br>";
        if ( updateProductDetailInDB($dbConn, "table_products", "long_description", $product_id, $u_product_long_description ) )
        {
            array_push( $responseArray, true );
        }
        else
        {
            array_push( $responseArray, true );
            array_push( $responseArray, false );
            //echo "e";

        }
    }
    else
    {
        array_push( $responseArray, true );
    }

    if( !hash_equals( $product_visibility, $u_product_visibility ) )
    {

        if ( updateProductDetailInDB($dbConn, "table_products", "product_visibility", $product_id, $u_product_visibility ) )
        {
            array_push( $responseArray, true );
        }
        else
        {
            array_push( $responseArray, true );
            array_push( $responseArray, false );
            //echo "e";

        }

    }


    if ( count( array_unique( $responseArray ) ) != 1 )
    {
        $_SESSION["error_msg"] = "An Error Occured. We have sent the trace logs to the admins.";
        $_SESSION["error_bg"] = "bg-failure";
    }
    else
    {
        $_SESSION["error_msg"] = "Successfully Updated";
        $_SESSION["error_bg"] = "bg-success";
        header("Location:view-products.php?respCode=200&msg=success");
    }


}


?>

<?php require_once 'assets/pages/admin/head.php' ?>

    <title> Edit Product - <?php echo $product_name; ?> - <?php echo $site_titile ?></title>
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
                            <h2> <i class="fa fa-pencil"></i> Edit Product: <span>NFORSHIFU234 red hoodie</span>  </h2>
                        </div>

                    </div>

                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?product-id=$product_id" ; ?>" enctype="multipart/form-data" class="add-new-product-form ">

<div class="form-group mt-3 mb-3">

    <label class="mb-3" for="product_name">Product Name <span>*</span></label>
    <input type="text" class="form-control" name="product_name" id="product_name" itemid="product_name" itemtype="input" placeholder="Ex. Product 1, Product 2, Product 3, ... " value="<?php echo isset($_POST["product_name"] ) && !empty($_POST["product_name"]) ? $_POST["product_name"] : $product_name ?>" required>

</div>

<div class="form-group mt-3 mb-3">

    <label class="mb-3" for="product_price">Product Price <span>*</span></label>
    <input type="text" min="0.00" class="form-control" name="product_price" id="product_price" itemid="product_price" itemtype="input" placeholder="Ex. 50.99" value="<?php echo isset($_POST["product_price"] ) && !empty($_POST["product_price"]) ? $_POST["product_price"] : $product_current_price ?>" required>

</div>

<div class="form-group mt-3 mb-3">

    <label class="mb-3" for="product_visibility">Product Visibility Status <span>*</span></label>

    <select class="form-control"  name="product_visibility" id="product_visibility">
        <?php if ( $product_visibility === 1 ): ?>
        <option value="1">Visible</option>
        <?php elseif ( $product_visibility === 0 ): ?>
        <option value="0">Not Visible</option>
        <?php endif; ?>
        <option value="1">Visible</option>
        <option value="0">Not Visible</option>
    </select>

</div>

<div class="form-group mt-3 mb-3">

    <label class="mb-3" for="product_category">Product Category <span>*</span></label>

    <select class="form-control" name="product_category" id="product_category" itemid="product_image" itemtype="select" required>
        
        <?php if( !empty( $product_category ) ): ?>

            <?php $r = getCategoryDetails($dbConn, $product_category); ?>
            <option value="<?php echo $r["category_slug"]; ?>"><?php echo $r["category_name"]; ?></option>
        <?php else: ?>
            <option value="">Choose a Category Below</option>
        <?php endif; ?>
        <?php foreach( $categories as $key => $category ): ?>
            <option value="<?php echo $category["category_slug"] ?>"><?php echo $category["category_name"] ?></option>
        <?php endforeach;?>

    </select>

</div>

<div class="form-group mt-3 mb-3">

    <label class="mb-3" for="product_short_description">Product Short description <span>*</span></label>
    <textarea name="product_short_description" id="product_short_description" class="form-control" value="<?php echo  $product_short_description  ?>" placeholder="Write a brief detail of what your product is about..." required><?php echo  $product_short_description  ?></textarea>

</div>

<div class="form-group mt-3 mb-3">

    <label class="mb-3" for="product_long_description">Product Long description</label>
    <textarea name="product_long_description" id="product_long_description" class="form-control" placeholder="Enter Additional Details..." value="<?php echo isset($_POST["product_long_description"] ) && !empty($_POST["product_long_description"]) ? $_POST["product_long_description"] : $product_long_description ?>"><?php echo  $product_long_description  ?></textarea>

</div>

<div class="form-group mt-3 mb-3 text-end">

    <button type="submit" name="updateProduct" class="btn btn-primary" > <i class="fas fa-upload"></i> Update Product</button>

</div>


</form>
                    

                </section>
                

            </div>

        </div>

    </div>

</body>
</html>