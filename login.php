<?php 
include_once __DIR__ . "/assets/php/app.php" ;
    
    $dbConn = $connectionHandler;


    $site_titile = getSiteName($dbConn)[0];

?>

<?php 


$userDetails = getUserDetailsUsingUsername($dbConn, $username);

if ( chechkIfLoggedIn() )
{
     header("location: dashboard.php");
 exit;
}
?>

<?php




if( $_SERVER["REQUEST_METHOD"] === "POST" )
{

    

    $username = trim( $_POST["username"]);
    $password = trim($_POST["password"]);

    

    if ( !empty( $username ) || !empty($password) )
    {




        if ( getUserDetailsUsingUsername($dbConn, $username) === false )
        {
            $_SESSION["error_bg"] = "bg-failure";
            $_SESSION["error_msg"] = "USER NOT FOUND. check your username or email and try again";
            header("Location:" . htmlspecialchars($_SERVER['PHP_SELF']) . "?respCode=200&message=user-was-not-found" );
            exit;
        }
        else
        {





            $userDetails = getUserDetailsUsingUsername($dbConn, $username);

            if ( !password_verify( $password , $userDetails["user_password"]  ) )
            {
                $_SESSION["error_bg"] = "bg-failure";
                $_SESSION["error_msg"] = "PASSWORD IS NOT CORRECT";
                $_GET["error_unmae"] =     $username;
                header("Location:" . htmlspecialchars($_SERVER['PHP_SELF']) . "?password" );
            }
            else
            {

                if ( chechkSiteVisibilityStatus($dbConn) )
                {
                    session_start();
                }

                $_SESSION["login-status"] = TRUE;
                $_SESSION["SSID"] = generateRadmonStrings("ssid-");
                $_SESSION["SSID-USERNAME"] = $userDetails["user_username"];

                
            
                if ( isset( $_SESSION["returnUrl"] ) )
                {
                    $url = $_SESSION["returnUrl"];
                    header("location: $url");
                    unset($_SESSION["returnUrl"]);
                    
                }
                else
                {
                    if ( isset( $_SESSION["SSID"] ) && isset( $_SESSION["SSID-USERNAME"] ) )
                    {
                        header("location: dashboard.php?loginStatus=loggedIn&respCode=200");
                    }


                }


            }

        }

    }
    else
    {
        $_SESSION["error_bg"] = "bg-failure";
        $_SESSION["error_msg"] = "EMPTY FEILDS";
        header("Location:" . htmlspecialchars($_SERVER['PHP_SELF']) );
    }



}

if ( isset( $_GET["returnUrl"] ) )
{
    $_SESSION["returnUrl"] = $_GET["returnUrl"];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="<?php echo LOGO_URL ?>" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Into Your Account - <?php echo $site_titile ?></title>
    <script src="assets/lib/all.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <style>
        .bg-failure
        {
            background: red;
            color: #fff;
        }
    </style>
</head>

<body>


        <?php if( isset( $_SESSION["error_msg"] ) && isset( $_SESSION["error_bg"] ) && !empty( $_SESSION["error_msg"] ) && !empty( $_SESSION["error_bg"] ) ): ?>
            <div class="error-container display-block">
                <div class="error-msg-container">

                    <div class="message  <?php echo $_SESSION["error_bg"]; ?>">
                        <?php echo $_SESSION["error_msg"]; ?>
                        
                    </div>

                    <div class="icon ui-close">
                        <i class="fas fa-times-circle"></i>
                    </div>

                </div>
            </div>
        <?php endif; ?>


    <div class="wrapper login">
        <div class="container">

            <div class="col-left">
                <div class="login-text display-none">
                    <h2>Welcome!</h2>
                    <p>Create your account.<br>For Free!</p>
                    <a href="" class="btn">Sign Up</a>
                </div>
            </div>

            <div class="col-right">
                <div class="login-form">
                    <h2> <i class="fas fa-user fa-2x "></i> Login</h2>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                        <p>
                            <label><i class="icn fas fa-user "></i>Username/Email address<span>*</span></label>
                
                            <input type="text" name="username" placeholder="Username or Email" <?php if( isset($_POST["username"]) ){ echo " value=' " .  $_POST["username"] . " ' "; } elseif( isset($_GET["error_unmae"]) ) { echo "value = '" .  $_GET["error_unmae"] . "'";  } ?> required>
                        </p>
                        <p>
                            <label><i class="icn fas fa-key "></i>Password<span>*</span></label>
                            <input type="password" name="password" placeholder="Password" required>
                        </p>
                        <p>
                            <button>
                                <i class="fas fa-sign-in"></i> Sign In
                            </button>
                        </p>
                        <p>
                            <a href="index.php"> <i class="fas fa-home"></i> Go Home</a>
                        </p>

                    </form>
                </div>
            </div>

        </div>
    </div>



    <script>
        








        
        const allCloseIcons = document.querySelectorAll(".ui-close").forEach( (item)=>{

            item.addEventListener( "click", ()=>
            {


               
                if ( document.querySelector(".error-container").classList.contains("display-block") )
                {
                    document.querySelector(".error-container").classList.remove("display-block");
                }


                document.querySelector(".error-container").classList.add("display-none");


                

            } );

            

        } );

        setTimeout( ()=>{

            if ( document.querySelector(".error-container").classList.contains("display-block") )
            {
                document.querySelector(".error-container").classList.remove("display-block");
            }


            document.querySelector(".error-container").classList.add("display-none");


        }, 2000 );


    </script>

</body>

</html>