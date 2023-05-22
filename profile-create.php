<?php include_once __DIR__ . "/assets/php/app.php" ?>
<?php include_once __DIR__ . "/assets/php/admin.php" ?>

<?php 

if ( !chechkIfLoggedIn() )
{
    header("location: login.php?returnUrl=" . htmlspecialchars($_SERVER['PHP_SELF']) );
}

$userDetails = getUserDetailsUsingUsername($dbConn, $_SESSION["SSID-USERNAME"] );

$role = $userDetails['user_role'];

// if (  $role != 'admin' || $role != 'super-admin'  )

if ( $userDetails['user_role'] != 'super-admin' && $userDetails['user_role'] != 'admin'  )
{
    load404Page();
    exit;
}

?>

<?php 

// if ( $_SERVER )

if( $_SERVER["REQUEST_METHOD"] === "POST" )
{

    if ( !isset( $_POST["createUser"] )  ) { load404Page();exit; }

    $userDetails = getUserDetailsUsingUsername($dbConn, $_SESSION["SSID-USERNAME"] );
    
    // $a_user_name = $userDetails["user_"];

    // $u_user_id = $_POST["u_user_password"];
    $u_user_name = $_POST["u_user_name"];
    $u_user_username = $_POST["u_user_username"];
    $u_user_password = $_POST["u_user_pass"];
    $u_user_password_confirm = $_POST["u_user_pass_confirm"];
    $u_user_email = $_POST["u_user_email"];
    $u_user_role = $_POST["u_user_role"];


    $responseArray = array();

    if ( empty( $u_user_name ) || empty( $u_user_username || empty( $u_user_email ) || empty( $u_user_role) )  )
    {
        $_SESSION["error-msg"] = "Empty Feilds";
        $_SESSION["error-bg"] = "bg-failure";
                    array_push( $responseArray, true );
            array_push( $responseArray, false );
        header("Location:" . htmlspecialchars($_SERVER['PHP_SELF']) . "?respCode=402&message=EMPTY-FEILDS" );
        exit;
    }


    if ( !empty( $u_user_password ) && !empty( $u_user_password_confirm ) )
    {
        if ( !hash_equals( $u_user_password, $u_user_password_confirm ) )
        {

            $_SESSION["error-msg"] = "CONFIMR YOUR PASSWORD";
            $_SESSION["error-bg"] = "bg-failure";
                        array_push( $responseArray, true );
            array_push( $responseArray, false );
            header("Location:" . htmlspecialchars($_SERVER['PHP_SELF']) . "?respCode=402&message=CONFIRM-YOUR-PASSWORD" );
            exit;

        }


    }

    $admins = array( "a", "u", "sa", "pm" );


    if ( $u_user_role === 'a' )
    {
        $u_user_role = "admin";
    }
    else if ( $u_user_role === 'sa' )
    {
        $u_user_role = "super-admin";
    }
    else if ( $u_user_role === 'u' )
    {
        $u_user_role = "user";
    }
    else if ( $u_user_role === 'pm' )
    {
        $u_user_role = "product-manager";
    }
    else
    {
        $u_user_role = "user";
    }

    $pass = password_hash($u_user_password, PASSWORD_BCRYPT);

    $user_id = generateRadmonStrings( $site_titile . "-USR-ID-");

    $userDetails = array(
        "user_name" => $u_user_name,
        "user_username" => $u_user_username,
        "user_id" => $user_id,
        "user_password" => $pass,
        "user_email" => $u_user_email,
        "user_password" => $pass,
        "user_role" => $u_user_role ,
    );

    $upload_dir = __DIR__ . "/assets/users/" . $user_id ;

    if ( !is_dir($upload_dir) )
    {
        mkdir( $upload_dir );
        mkdir( $upload_dir . "/media" );
        mkdir( $upload_dir . "/media/images" );
        mkdir( $upload_dir . "/metadata" );
    }


    if ( createNewUser($dbConn, $userDetails) )
    {
        header("Location:" . htmlspecialchars($_SERVER['PHP_SELF']) . "?respCode=200&message=Successfully-Created" );
    }
    else
    {
    header("Location:" . htmlspecialchars($_SERVER['PHP_SELF']) . "?respCode=400&message=AN-ERROR-OCCURED" );

    }

    // unset($_SESSION["error_msg"]);
    // unset($_SESSION["error_bg"]);


}



?>

<?php require_once 'assets/pages/admin/head.php' ?>

    <title>Create a New User - <?php echo $site_titile ?></title>

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

                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="add-new-product-form ">


                        <div class="heading ">
                            <div class="details">
                                <h2> <i class="fas fa-user-plus"></i> Create New User</h2>
                            </div>


                            <!-- <hr> -->
                        </div>
                    

                            <div class="form-group mt-3 mb-3">

                                <label class="mb-3" for="u_user_name"> <i class="fas fa-user"></i> User Name <span>*</span></label>
                                <input type="text" class="form-control" name="u_user_name" id="u_user_name" itemid="u_user_name" itemtype="input" required >

                            </div>

                            <div class="form-group mt-3 mb-3">

                                <label class="mb-3" for="u_user_username"> <i class="fas fa-users"></i> User Username <span>*</span></label>
                                <input type="text" class="form-control" name="u_user_username" id="u_user_username" itemid="u_user_username" itemtype="input" required >

                            </div>

                            <?php if( $userDetails["user_role"] === 'super-admin' || $userDetails["user_role"] === 'admin' ): ?>
                                <div class="form-group mt-3 mb-3">

                                    <label class="mb-3" for="u_user_role"> <i class="fas fa-building-user"></i> User Role <span>*</span></label>

                                    <select class="form-control" name="u_user_role" id="u_user_role" itemid="u_user_role" itemtype="input" required>

                                        <option value="u">User</option>
                                        <option value="a">Admin</option>
                                        <option value="u">User</option>
                                        <option value="pm">Project Manager</option>
                                        <?php if( $userDetails["user_role"] === 'super-admin' ): ?>
                                            <option value="sa">Super Admin</option>
                                        <?php endif; ?>

                                    </select>
                                    
                                </div>
                            <?php endif; ?>


                            <div class="row  ">

                                <div class="col">
                                    <label class="mb-3" for="u_user_email"> <i class="fas fa-square-envelope"></i> User Email <span>*</span></label>
                                    <input type="email" class="form-control" name="u_user_email" id="u_user_email" itemid="u_user_email" itemtype="input" required >



                                </div>

                                

                            </div>

                            <div class="form-group mb-3">

                                <label class="mb-3" for="u_user_pass"> <i class="fas fa-unlock-keyhole"></i> Create Password <span>*</span></label>
                                <br>
                                <input type="password" class="form-control mt-3" name="u_user_pass" id="u_user_pass" itemid="u_user_pass" itemtype="input" required >

                            </div>

                            <div class="form-group mb-3">

                                <label class="mb-3" for="u_user_pass_confirm"> <i class="fas fa-unlock-keyhole"></i> Confirm New Password <span>*</span></label>
                                <input type="password" class="form-control mt-3" name="u_user_pass_confirm" id="u_user_pass_confirm" itemid="u_user_pass_confirm" itemtype="input" required>

                            </div>

                            <div class="form-group mb-3">

                                <button type="submit" name="createUser" class="form-control btn btn-primary" > <i class="fas fa-user-plus"></i> Create Profile</button>

                            </div>

                    </form>
                    
                </section>

            </div>

        </div>

    </div>


</body>
</html>