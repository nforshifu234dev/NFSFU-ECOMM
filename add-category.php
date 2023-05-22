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

    if ( !isset( $_POST["addCategory"] ) ){ exit; }

    $category_name = trim($_POST["category_name"]);

    $category_slug = strtolower($category_name);
    $category_slug = preg_replace("/\s+/", "-", $category_slug);

    $category_details = array (

        "category_name" => $category_name,
        "category_slug" => $category_slug,

    );

    if ( createNewCategory( $dbConn, $category_details ) )
    {
        
        $_SESSION["error_msg"] = "Registration Success";
        $_SESSION["error_bg"] = "bg-success";
        // echo "SUccess";
        // header("Location:" .htmlspecialchars($_SERVER['PHP_SELF']) );
        header("Location:" . htmlspecialchars($_SERVER['PHP_SELF']) .  "?respCode=200&msg=success");
    }
    else
    {
        $_SESSION["error_msg"] = "Registration Failed";
        $_SESSION["error_bg"] = "bg-failure";
    }

}

?>

<?php require_once 'assets/pages/admin/head.php' ?>
 
    <title> Create New Category - <?php echo $site_titile ?> </title>
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
                            <h2> <i class="fa fa-add"></i> Create <span>New</span> Category </h2>
                        </div>

                    </div>

                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="add-new-product-form ">

                        <div class="form-group mt-3 mb-3">

                            <label class="mb-3" for="category_name">Category Name <span>*</span></label>
                            <input type="text" class="form-control" name="category_name" id="category_name" itemid="category_name" itemtype="input" placeholder="Ex. Category 1, Category 2, Category 3, ... " autofocus required>

                        </div>

                        <div class="form-group mt-3 mb-3 text-end">

                            <button type="submit" name="addCategory" class="btn btn-primary" > <i class="fas fa-add"></i> Create New Category</button>

                        </div>


                    </form>
                    

                </section>
                

            </div>

        </div>

    </div>

</body>
</html>