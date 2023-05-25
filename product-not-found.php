
<?php

include_once __DIR__ . "/assets/php/app.php";



    







if ( !empty( $_GET["product-slug"] ) )
{

    $id = $_GET["product-slug"];

    $message ='<h1 class="text-uppercase">Product Not Found</h1>'.
    '<h2 class="mt-4" >The requested Product <b class="text-success" >' . $id .'</b> was not found.</h2>'.
    '<h3>Check the URL <b class="text-success" >OR</b> check back later. </h3>';
    
    $title = "Product Not Found";

}
elseif ( !empty( $_GET["product-id"] ) )
{

    $id = $_GET["product-id"];
    $message ='<h1 class="text-uppercase">Product Not Found</h1>'.
    '<h2 class="mt-4" >The requested Product <b class="text-success" >' . $id .'</b> was not found.</h2>'.
    '<h3>Check the URL <b class="text-success" >OR</b> check back later. </h3>';
    $title = "Product Not Found";

}
elseif ( isset( $_GET["category-slug"] ) && !empty( $_GET["category-slug"] ) )
{

    $id = $_GET["category-slug"];
    $message ='<h1 class="text-uppercase">Category Not Found</h1>'.
    '<h2 class="mt-4" >The requested Category <b class="text-success" >' . $id .'</b> has no products under this category.</h2>'.
    '<h3>Check the URL <b class="text-success" >OR</b> check back later. </h3>';

    $title = "Category Not Found";
    
}
elseif ( isset( $_GET["user-id"] ) && !empty( $_GET["user-id"] ) )
{
    $id = $_GET["category-slug"];
    $message = "USER NOT FOUND";
}
else
{

    $message ='<h1 class="text-uppercase">Products Not Found</h1>'.
    '<h2 class="mt-4" >There are No Products Yet. Check Back Soon.</h2>'
    ;
    $title = "Products Not Found";
}

?>

<?php require_once 'assets/pages/head.php' ?>
    <title> <?php echo $title  ?> - <?php echo $_SESSION['site_title'] ?></title>
</head>
<body>
    
    <div class="container-fluid">

        <?php require_once 'assets/pages/navigation.php' ?>


        <div class="contents container-fluid"  >
            

            <div class="page-contents w-100">

                <div class="page-not-found-container">

                    <div class="title text-center">
                        
                        <?php echo $message; ?>
                        
                        <div class="mt-4" >

                        

                            <a href="index.php" class="btn mx-3 mb-3 btn-success text-white">
                                <div class="icon"> <i class="fas fa-home"></i> </div>
                                <div class="text">Go Home</div>
                            </a>

                            <?php if( chechkIfLoggedIn() ): ?>

                                <a href="add-product.php" class="btn mx-3 mb-3 btn-success text-white">
                                    <div class="icon"> <i class="fas fa-plus"></i> </div>
                                    <div class="text">Create a New Product</div>
                                </a>

                                <a href="dashboard.php" class="btn mx-3 mb-3 btn-success text-white">
                                    <div class="icon"> <i class="fas fa-dashboard"></i> </div>
                                    <div class="text">Go to Dashboard</div>
                                </a>

                                <a href="add-category.php" class="btn mx-3 mb-3 btn-success text-white">
                                    <div class="icon"> <i class="fas fa-tag"></i> </div>
                                    <div class="text">Create a New Category</div>
                                </a>
                            <?php endif; ?>

                        

                        </div>

                    </div>

                </div>

            </div>
            
        </div>
    </div>

</body>
</html>