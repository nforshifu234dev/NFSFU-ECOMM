<?php
include_once __DIR__ . "/assets/php/app.php";
// include_once __DIR__ . "/assets/php/config.php";
// include_once __DIR__ . "/assets/php/functions/functions.php";

// echo $dbConn;


if ( $_SERVER["REQUEST_URI"] != "/NFSFU-ECOMM/view-user.php" )
{
    $site_titile = $_SESSION['site_title'];
}


?>
<?php require_once 'assets/pages/head.php' ?>

    <title> PAGE NOT FOUND  - <?php echo $site_titile ?></title>
</head>
<body>
    
    <div class="container-fluid">

        <?php require_once 'assets/pages/navigation.php' ?>


        <div class="contents container-fluid">

        

        <div class="page-contents w-100">

            <div class="page-not-found-container">

                <div class="title text-center">
                    <h1 class="text-uppercase">Page Not FOund</h1>
                    <p class="mt-4" >The requested URL was not found.</p>
                    <p>Check the URL or try the options below </p>
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