<?php include_once __DIR__ . "/assets/php/app.php" ?>
<?php include_once __DIR__ . "/assets/php/admin.php" ?>

<?php 
define("PARENT_DIR", __DIR__);

if ( !chechkIfLoggedIn() )
{
    header("location: login.php?returnUrl=" . htmlspecialchars($_SERVER['PHP_SELF']) );
}


if ( isset( $_GET["user-id"] ) )
{
    $userDetails = getUserDetailsUsingUsername($dbConn, $_GET["user-id"] );

    $_SESSION["updateId"] = $_GET["user-id"] ;

    $profileName = $userDetails["user_name"];

}
else
{
    $userDetails = getUserDetailsUsingUsername($dbConn, $_SESSION["SSID-USERNAME"] );
    $profileName = "My";


}




if ( $userDetails === false )
{
    load404Page();
    exit;
}


?>

<?php 


if( $_SERVER["REQUEST_METHOD"] === "POST" )
{

    if ( !isset( $_POST["updateUser"] )  ) { load404Page();exit; }

    if ( isset(  $_SESSION["updateId"] ) )
    {
        $off =  $_SESSION["updateId"];
    }
    else
    {
        $off = $_SESSION["SSID-USERNAME"] ;
    }


    $userDetails = getUserDetailsUsingUsername($dbConn, $off );


    
    $a_user_id = $userDetails["user_id"];
    $a_user_name = $userDetails["user_name"];
    $a_user_username = $userDetails["user_username"];
    $a_user_password = $userDetails["user_password"];
    $a_user_email = $userDetails["user_email"];
    $a_user_role = $userDetails["user_role"];
    $a_user_name = $userDetails["user_number_of_orders"];

    $u_user_name = $_POST["u_user_name"];
    $u_user_username = $_POST["u_user_username"];
    $u_user_password = $_POST["u_user_pass"];
    $u_user_password_confirm = $_POST["u_user_pass_confirm"];
    $u_user_email = $_POST["u_user_email"];

    $responseArray = array();

    if ( empty( $u_user_name ) || empty( $u_user_username || empty( $u_user_email )  )  )
    {
        $_SESSION["error-msg"] = "Empty Feilds";
        $_SESSION["error-bg"] = "bg-failure";
                    array_push( $responseArray, true );
            array_push( $responseArray, false );
        header("Location:" . htmlspecialchars($_SERVER['PHP_SELF']) );
        exit;
    }

    if ( !hash_equals( $a_user_name, $u_user_name ) )
    {

        if ( !updateUsersDetailInDB( $dbConn, "table_users", "user_name", $a_user_id, $u_user_name ) )
        {

            $_SESSION["error-msg"] = "AN ERROR OCCURED";
            $_SESSION["error-bg"] = "bg-failure";
            $_SESSION["SSID-USERNAME"] = $u_user_name;
            array_push( $responseArray, true );
            array_push( $responseArray, false );

        }
        else
        {
            array_push( $responseArray, true );
        }

    }

    if ( !hash_equals( $a_user_username, $u_user_username ) )
    {

        if ( !updateUsersDetailInDB( $dbConn, "table_users", "user_username", $a_user_id, $u_user_username ) )
        {
            
            $_SESSION["error-msg"] = "AN ERROR OCCURED";
            $_SESSION["error-bg"] = "bg-failure";
                        array_push( $responseArray, true );
            array_push( $responseArray, false );

        }
        else
        {
            array_push( $responseArray, true );
        }


    }

    if ( !hash_equals( $a_user_email, $u_user_email ) )
    {

        if ( !updateUsersDetailInDB( $dbConn, "table_users", "user_email", $a_user_id, $u_user_email) )
        {

            $_SESSION["error-msg"] = "AN ERROR OCCURED";
            $_SESSION["error-bg"] = "bg-failure";
                        array_push( $responseArray, true );
            array_push( $responseArray, false );

        }
        else
        {
            array_push( $responseArray, true );
        }
        
    }

    if ( !empty( $u_user_password ) && !empty( $u_user_password_confirm ) )
    {

        if ( hash_equals( $u_user_password, $u_user_password_confirm ) )
        {

            if ( !password_verify( $a_user_password, $u_user_password ) )
            {

                $pass = password_hash( $u_user_password, PASSWORD_BCRYPT );

                if ( !updateUsersDetailInDB( $dbConn, "table_users", "user_password", $a_user_id, $pass) )
                {

                    $_SESSION["error-msg"] = "AN ERROR OCCURED";
                    $_SESSION["error-bg"] = "bg-failure";
                                array_push( $responseArray, true );
            array_push( $responseArray, false );

                }
                else
                {

                    array_push( $responseArray, true );


                }

            }
            else
            {
                $_SESSION["error-msg"] = "YOUR PASSWORD CANNOT BE THE SAME AS THE PREVIOUS ONE.";
                $_SESSION["error-bg"] = "bg-failure";
                            array_push( $responseArray, true );
            array_push( $responseArray, false );
            }

        }
        else
        {

            $_SESSION["error-msg"] = "CONFIMR YOUR PASSWORD";
            $_SESSION["error-bg"] = "bg-failure";
                        array_push( $responseArray, true );
            array_push( $responseArray, false );

        }

    }
    else if ( empty( $u_user_password ) || empty( $u_user_password_confirm ) )
    {
        $_SESSION["error-msg"] = "EMPTY FEILDS";
        $_SESSION["error-bg"] = "bg-failure";
                    array_push( $responseArray, true );
            array_push( $responseArray, false );
    }


    if ( $userDetails["user_role"] === 'super-admin' || $userDetails["user_role"] === 'admin' )
    {

        $u_user_role = $_POST["u_user_role"];

        if ( empty( $u_user_role) )
        {
            $u_user_role = "u";
        }

        if ( !hash_equals( $a_user_role, $u_user_role ) )
        {


            $admins = array( "a", "u", "sa", "pm" );

            if ( in_array( $u_user_role, $admins ) )
            {

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

                if ( !updateUsersDetailInDB( $dbConn, "table_users", "user_role", $a_user_id, $u_user_role ) )
                {
                    $_SESSION["error-msg"] = "EMPTY FEILDS";
                    $_SESSION["error-bg"] = "bg-failure";
                                array_push( $responseArray, true );
                    array_push( $responseArray, false );
                }
                else
                {

                    array_push( $responseArray, true );
                }


            }

        }
        else
        {
            array_push( $responseArray, true );
        }

    }

 

        
    header("Location: view-users.php");



}


?>

<?php require_once 'assets/pages/admin/head.php' ?>

    <title>Edit My Account - <?php echo $site_titile ?></title>

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

                    <?php if( $userDetails['user_username'] != "NFSFU-SA" ): ?>

                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="add-new-product-form ">


                            <div class="heading ">
                                <div class="details">
                                    <h2> <i class="fas fa-user-cog"></i> Editing <?php echo $profileName ?> Account</h2>
                                </div>

                                <button type="submit" class="btn btn-primary" name="updateUser" > <i class="fas fa-upload"></i> Update Profile</button>

                            </div>
                        

                                <div class="form-group mt-3 mb-3">

                                    <label class="mb-3" for="u_user_name"> <i class="fas fa-user-ninja"></i> <?php echo $profileName ?> Name</label>
                                    <input type="text" class="form-control" name="u_user_name" id="u_user_name" itemid="u_user_name" itemtype="input" value="<?php echo $userDetails["user_name"] ?>" >

                                </div>

                                <div class="form-group mt-3 mb-3">

                                    <label class="mb-3" for="u_user_username"> <i class="fas fa-home-user"></i> <?php echo $profileName ?> Username</label>
                                    <input type="text" class="form-control" name="u_user_username" id="u_user_username" itemid="u_user_username" itemtype="input" value="<?php echo $userDetails["user_username"] ?>" >

                                </div>

                                <?php if( $userDetails["user_role"] === 'super-admin' ): ?>
                                    <div class="form-group mt-3 mb-3">

                                        <label class="mb-3" for="u_user_role"> <i class="fas fa-building-user"></i> <?php echo $profileName ?> Role</label>

                                        <select class="form-control" name="u_user_role" id="u_user_role" itemid="u_user_role" itemtype="input">

                                            <option value="<?php echo $userDetails["user_role"] ?>"><?php echo $userDetails["user_role"] ?></option>
                                            <option value="a">Admin</option>
                                            <option value="u">User</option>
                                            <option value="pm">Product Manager</option>
                                            <option value="sa">Super Admin</option>

                                        </select>
                                        
                                    </div>
                                <?php endif; ?>


                                <div class="row  ">

                                    <div class="col">
                                        <label class="mb-3" for="u_user_email"> <i class="fas fa-square-envelope"></i> <?php echo $profileName ?> Email</label>
                                        <input type="email" class="form-control" name="u_user_email" id="u_user_email" itemid="u_user_email" itemtype="input"value="<?php echo $userDetails["user_email"] ?>" >



                                    </div>

                                    

                                </div>

                                <div class="form-group mb-3">

                                    <label class="mb-3" for="u_user_pass"> <i class="fas fa-unlock-keyhole"></i> Update <?php echo $profileName ?> Password</label>
                                    <br>
                                    <small class="text-muted" >Leave the next 2 inpus empty if you are not changing <?php echo $profileName ?> password.</small>
                                    <input type="password" class="form-control mt-3" name="u_user_pass" id="u_user_pass" itemid="u_user_pass" itemtype="input" >

                                </div>

                                <div class="form-group mb-3">

                                    <label class="mb-3" for="u_user_pass_confirm"> <i class="fas fa-unlock-keyhole"></i> Confirm <?php echo $profileName ?> New Password</label>
                                    <input type="password" class="form-control mt-3" name="u_user_pass_confirm" id="u_user_pass_confirm" itemid="u_user_pass_confirm" itemtype="input" >

                                </div>

                                <div class="form-group mb-3">

                                    <button type="submit" name="updateUser" class="form-control btn btn-primary" >Update Profile</button>

                                </div>

                        </form>

                    <?php else: ?>

                        <center>
                            <h1>
                                YOU CANNOT EDIT <mark class="bg-danger text-white" ><?php echo $userDetails['user_username'] ?> PROFILE.</mark> 
                            </h1>
                        </center>

                    <?php endif; ?>
                    
                </section>

            </div>

        </div>

    </div>


</body>
</html>