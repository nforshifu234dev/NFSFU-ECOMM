<?php include_once __DIR__ . "/assets/php/app.php" ?>
<?php include_once __DIR__ . "/assets/php/admin.php" ?>

<?php 

define("PARENT_DIR", __DIR__);

if ( !chechkIfLoggedIn() )
{
    header("location: login.php?returnUrl=" . htmlspecialchars($_SERVER['PHP_SELF']) );
}

$userDetails = getUserDetailsUsingUsername($dbConn, $_SESSION["SSID-USERNAME"] );

if( is_null( $userDetails ) )
{
    header("location: logout.php");
}

?>

<?php require_once 'assets/pages/admin/head.php' ?>

    <title>My Account - <?php echo $site_titile ?></title>

    <style>

        .dashboard-card
        {
            height: 200px;
            width: 30%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dashboard-card:hover
        {
            text-decoration: none;
            transform: scale(1.04);
        }

        .dashboard-card .icon
        {
            font-size: calc(100% + 1.2rem);
        }

    </style>


    

</head>
<body>

    <div class="container-fluid">

        <?php require_once 'assets/pages/admin/navigation.php' ?>


        <div class="contents container-fluid">

            <?php require_once 'assets/pages/admin/sidebar.php' ?>

            <div class="page-contents">

                <section class="product-category">

                    <div class="heading ">
                        <div class="details">
                            <h2> <i class="fas fa-user-cog"></i> My Account</h2>
                        </div>

                        <a href="profile-edit.php" class="btn btn-success" > <i class="fas fa-pencil"></i> Edit Profile</a>

                    </div>
                
                    <div class="add-new-product-form ">

                        <div class="form-group mt-3 mb-3">

                            <label class="mb-3" for="user_name"> <i class="fas fa-user-ninja"></i> My Name</label>
                            <input type="text" class="form-control" name="user_name" id="user_name" itemid="user_name" itemtype="input" value="<?php echo $userDetails["user_name"] ?>" >

                        </div>

                        <div class="form-group mt-3 mb-3">

                            <label class="mb-3" for="user_username"> <i class="fas fa-home-user"></i> My Username</label>
                            <input type="text" class="form-control" name="user_username" id="user_username" itemid="user_username" itemtype="input" value="<?php echo $userDetails["user_username"] ?>" >

                        </div>

                        <div class="form-group mt-3 mb-3">

                            <label class="mb-3" for="user_role"> <i class="fas fa-building-user"></i> My Role</label>
                            <input type="text" class="form-control" name="user_role" id="user_role" itemid="user_role" itemtype="input" value="<?php echo $userDetails["user_role"] ?>" >

                        </div>


                        <div class="row  ">

                            <div class="col">
                                <label class="mb-3" for="user_email"> <i class="fas fa-square-envelope"></i> My Email</label>
                                <input type="email" class="form-control" name="user_email" id="user_email" itemid="user_email" itemtype="input"value="<?php echo $userDetails["user_email"] ?>" >

                            </div>

                            <div class="col  ">

                                <label class="mb-3" for="user_no_of_orders"> <i class="fas fa-shopping-basket"></i> Number Of Orders </label>
                                <input type="text" class="form-control" name="user_no_of_orders" id="user_no_of_orders" itemid="user_no_of_orders" itemtype="input" >

                            </div>

                        </div>

                        <div class="form-group mb-3">

                            <label class="mb-3" for="user_pass"> <i class="fas fa-unlock-keyhole"></i> My Password</label>
                            <input type="password" class="form-control" name="user_pass" id="user_pass" itemid="user_pass" itemtype="input" value="<?php echo base64_encode( $userDetails["user_password"] ); ?>">

                        </div>

                        <div class="form-group mb-3">

                            <a href="logout.php"><button class="form-control btn btn-danger"> <i class="fas fa-door-open"></i> Logout </button></a>

                        </div>

                    </div>

                </section>

            </div>

        </div>

    </div>
    <script>


        document.querySelectorAll("input").forEach( 
            (input) => { 
        
                input.readOnly = true; 

            
            } 
        );





    </script>

</body>
</html>