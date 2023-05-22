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

if( $_SERVER["REQUEST_METHOD"] === "POST" )
{

    if ( !isset( $_POST["addProduct"] ) ){ exit; }

    $product_name = trim($_POST["product_name"]);
    $product_price = trim($_POST["product_price"]);
    $product_short_description = trim($_POST["product_short_description"]);
    $product_long_description = trim($_POST["product_long_description"]);
    $product_images = $_FILES["product_images"];

    $product_category = trim($_POST['product_category']);

    $product_slug = strtolower($product_name);
    $product_slug = preg_replace("/\s+/", "-", $product_slug);

    $product_id = generateRadmonStrings("prdct-");

    $upload_dir = __DIR__ . "/assets/products/" . $product_id ;
    $allowed_exts = array( 'jpg', 'png', 'jpeg' );


    // Define Maxsize for files i.e 5MB
    $maxSize = 5 * 1024 * 1024;

    $productImagesUrls = "";

    if ( !is_dir($upload_dir) )
    {
        // echo "DOES NOT EXIST";
        mkdir( $upload_dir );
        mkdir( $upload_dir . "/media" );
        mkdir( $upload_dir . "/media/images" );
        mkdir( $upload_dir . "/metadata" );
    }

    $upload_dir = $upload_dir . "/media/images/";

    if ( !empty ( array_filter( $product_images['name'] ) ) )
    {

        foreach( $product_images['tmp_name'] as $key => $value )
        {

            $file_tmp_name = $product_images['tmp_name'][$key];
            $file_name = $product_images['name'][$key];
            $file_size = $product_images['size'][$key];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

            $filePath = $upload_dir . $file_name;


            if ( in_array( strtolower($file_ext), $allowed_exts ) )
            {

                if ( $file_size > $maxSize )
                {
                    echo "File Size is large";
                }
                else
                {

                    if ( file_exists($filePath) )
                    {

                        $filePath = $upload_dir.time().$file_name;

                        if ( move_uploaded_file( $file_tmp_name, $filePath ) )
                        {
                            // echo "{$file_name} successfuly uploaded";
                            $productImagesUrls.= "assets/products/$product_id/media/images/" . $file_name . ",";
                        }
                        else
                        {
                            echo "ERROR";
                        }

                    }
                    else
                    {

                        if ( move_uploaded_file( $file_tmp_name, $filePath ) )
                        {
                            // echo "{$file_name} successfuly uploaded";
                            $_SESSION["error_msg"] = "Upload Success";
                            $_SESSION["error_bg"] = "bg-success";
                            $productImagesUrls.= "assets/products/$product_id/media/images/" . $file_name . ",";
                            
                        }
                        else
                        {
                            // echo "ERROR";
                            $_SESSION["error_msg"] = "Error While  Uploading";
                            $_SESSION["error_bg"] = "bg-failure";
                        }

                    }

                }

            }
            else
            {
                // echo "Error Uploading: ";
                // echo "({$file_ext} file is not allowed)";
                $_SESSION["error_msg"] = "{$file_ext} file is not allowed <br>";
                $_SESSION["error_bg"] = "bg-failure";
            }



        }

    } 

    else
    {
        
        $_SESSION["error_msg"] = "No FIles Selected";
        $_SESSION["error_bg"] = "bg-failure";
    }

    // echo "<br>";
    // echo "<br>";
    // echo "<br>";

    // echo $productImagesUrls;

    $product_details = array (

        "product_name" => $product_name,
        "product_slug" => $product_slug,
        "product_category" => $product_category,
        "product_images" => $productImagesUrls,
        "product_id" => $product_id,
        "product_current_price" => $product_price,
        "product_short_description" => $product_short_description,
        "product_long_description" => $product_long_description,

    );

    // echo "<br>";
        // echo "<br>";

    if ( createNewProduct( $dbConn, $product_details ) )
    {
        
        $_SESSION["error_msg"] = "Registration Success";
        $_SESSION["error_bg"] = "bg-success";
        header("Location:" . htmlspecialchars($_SERVER['PHP_SELF']) . "?respCode=200&msg=success");
    }
    else
    {
        $_SESSION["error_msg"] = "Registration Failed";
        $_SESSION["error_bg"] = "bg-failure";
    }

}

?>

<?php require_once 'assets/pages/admin/head.php' ?>
 
    <title> Create New Product - <?php echo $site_titile ?> </title>
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
                            <h2> <i class="fa fa-add"></i> Add <span>New</span> Product </h2>
                        </div>

                    </div>

                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" class="add-new-product-form ">

                        <div class="form-group mt-3 mb-3">

                            <label class="mb-3" for="product_name">Product Name <span>*</span></label>
                            <input type="text" class="form-control" name="product_name" id="product_name" itemid="product_name" itemtype="input" placeholder="Ex. Product 1, Product 2, Product 3, ... " value="<?php isset($_POST["product_name"] ) && !empty($_POST["product_name"]) ? $_POST["product_name"] : '' ?>" autofocus required>

                        </div>

                        <div class="form-group mt-3 mb-3">

                            <label class="mb-3" for="product_price">Product Price <span>*</span></label>
                            <input type="text" min="0.00" class="form-control" name="product_price" id="product_price" itemid="product_price" itemtype="input" placeholder="Ex. 50.99" value="<?php isset($_POST["product_price"] ) && !empty($_POST["product_price"]) ? $_POST["product_price"] : '' ?>" required>

                        </div>

                        <div class="form-group mt-3 mb-3">

                            <label class="mb-3" for="product_image">Product Image (s) <span>*</span></label>
                            <input type="file" class="form-control" name="product_images[]" multiple id="product_images" itemid="product_image" itemtype="input" required>

                        </div>

                        <div class="form-group mt-3 mb-3">

                            <label class="mb-3" for="product_category">Product Image (s) <span>*</span></label>
                                <?php if ( count( $categories ) != 0 ): ?>

                            <select class="form-control" name="product_category" id="product_category" itemid="product_image" itemtype="input" required>
                                <option value="">Select A Category</option>


                                    <?php foreach( $categories as $key => $category ): ?>
                                        <option value="<?php echo $category["category_slug"] ?>"><?php echo $category["category_name"] ?></option>
                                    <?php endforeach;?>


                                    

                            </select>
                                <?php else: ?>

                                    <a href="add-category.php" class="btn btn-primary form-control"> <i class="fas fa-plus-circle"></i> Create New Category</a>

                            <?php endif; ?>

                        </div>

                        <div class="form-group mt-3 mb-3">

                            <label class="mb-3" for="product_short_description">Product Short description <span>*</span></label>
                            <textarea name="product_short_description" id="product_short_description" class="form-control" value="<?php isset($_POST["product_short_description"] ) && !empty($_POST["product_short_description"]) ? $_POST["product_short_description"] : '' ?>" placeholder="Write a brief detail of what your product is about..." required></textarea>

                        </div>

                        <div class="form-group mt-3 mb-3">

                            <label class="mb-3" for="product_long_description">Product Long description</label>
                            <textarea name="product_long_description" id="product_long_description" class="form-control" placeholder="Enter Additional Details..." value="<?php isset($_POST["product_long_description"] ) && !empty($_POST["product_long_description"]) ? $_POST["product_long_description"] : '' ?>"></textarea>

                        </div>

                        <div class="form-group mt-3 mb-3 text-end">

                            <button type="submit" name="addProduct" class="btn btn-primary" > <i class="fas fa-add"></i> Add New Product</button>

                        </div>


                    </form>
                    

                </section>
                

            </div>

        </div>

    </div>

</body>
</html>