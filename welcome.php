<?php
        
    require_once __DIR__ . "/assets/php/functions/welcomeFunction.php";


    session_start();

    date_default_timezone_set("Africa/Lagos");


    if( $_SERVER["REQUEST_METHOD"] === "POST" )
    {


        if ( empty($dbConn) || $dbConn === NULL )
        {

            echo "ERROR";
            exit;

        }



        $brand_name = $_POST["brand_name"];

        $brand_logo = $_FILES["brand_logo"];

        $currency_name = isset( $_POST["brand_default_currency_name"] ) && !empty( $_POST["brand_default_currency_name"] ) ? $_POST["brand_default_currency_name"] : "United States Dollar";
        $currency_symbol = isset( $_POST["brand_default_currency_symbol"] ) && !empty( $_POST["brand_default_currency_symbol"] ) ? $_POST["brand_default_currency_symbol"] : "$";

        $db_name = $_POST["db_name"];
        $db_name = strtolower($db_name);
        $db_name = preg_replace("/\s+/", "-", $db_name);
        $db_name .= "-". generateRadmonStrings('', '', 20) . "_" . date( 'Y-m-d__H:i:s') ;

        $db_admin_name = $_POST["db_admin_name"];

        $db_admin_email = $_POST["db_admin_email"];

        $db_admin_username = $_POST["db_admin_username"];

        $db_admin_password = $_POST["db_admin_password"];

        $db_admin_confirm_password = $_POST["db_admin_confirm_password"];

        $user_id = generateRadmonStrings($brand_name . "-USR-ID-");

        /**
         * Empty the Users and Products Folder
         */
        deleteAFolderAndItsContents( __DIR__ . "/assets/users/" );
        deleteAFolderAndItsContents( __DIR__ . "/assets/products/" );



        $upload_dir = __DIR__ . "/assets/users/" . $user_id ;
        $allowed_exts = array( 'jpg', 'png', 'jpeg', 'ico' );


        // Define Maxsize for files i.e 5MB
        $maxSize = 5 * 1024 * 1024;

        if ( !is_dir($upload_dir) )
        {
            mkdir( $upload_dir );
            mkdir( $upload_dir . "/media" );
            mkdir( $upload_dir . "/media/images" );
            mkdir( $upload_dir . "/metadata" );
        }
    
        $upload_dir = $upload_dir . "/media/images/";

        // Here, we are checking if the 2 passwords enterd by the user is correct
        if ( !hash_equals( $db_admin_password, $db_admin_confirm_password ) )
        {

            $_SESSION["welcome_error_msg"] = "The Passwords do not match.";
            $_SESSION["welcome_error_bg"] = "bg-failure";

        }
        else
        {

            // Chechking if Database exist
            if ( chechkIfDataBaseExists($dbConn, $db_name) != 1 )
            {
                createDb($dbConn, $db_name);
            }
            else
            {
                echo "hdfergtnib";
                exit;
            }
            
            
            // Chaninging the connection to connection to the database 
            $dbConn = connectToDatabase($db_name);


            // Creating Neccessary Tables for the application

            $query = 
            "

                DROP TABLE IF EXISTS `table_site_details`;
                DROP TABLE IF EXISTS `tble_site_details`;
                CREATE table `$db_name`.`table_site_details`(
                    `ID` INT( 11 )  NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    `site_details_detail_info` VARCHAR(255) NOT NULL,
                    `site_details_detail_info_value` VARCHAR(255) NOT NULL
                )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                DROP TABLE IF EXISTS `table_products`;
                CREATE TABLE `$db_name`.`table_products` (`id` INT(11) NOT NULL AUTO_INCREMENT , `product_name` TEXT NOT NULL , `product_slug` VARCHAR(255) NOT NULL , `product_category` VARCHAR(255) NOT NULL, `product_hero_img` VARCHAR(500) NOT NULL, `product_img` VARCHAR(100000) NULL DEFAULT NULL , `product_id` VARCHAR(255) NOT NULL , `product_curr_price` VARCHAR(255) NOT NULL , `product_prev_price` VARCHAR(255) NOT NULL DEFAULT '00.00' , `product_number_of_orders` INT(255) NOT NULL DEFAULT '0' , `product_visibility` CHAR(2) NOT NULL DEFAULT 0 , `short_description` TEXT NOT NULL , `long_description` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
            
                DROP TABLE IF EXISTS `table_categories`;
                CREATE TABLE `$db_name`.`table_categories` (`id` INT NOT NULL AUTO_INCREMENT , `category_name` TEXT NOT NULL , `category_slug` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
        
                DROP TABLE IF EXISTS `table_users`;
                CREATE TABLE `$db_name`.`table_users` (`id` INT(11) NOT NULL AUTO_INCREMENT , `user_name` TEXT NOT NULL , `user_username` VARCHAR(255) NOT NULL , `user_email` VARCHAR(255) NOT NULL , `user_id` VARCHAR(255) NOT NULL, `user_password` VARCHAR(255) NOT NULL, `user_role` TEXT NOT NULL DEFAULT 'user' , `user_number_of_orders` TEXT NOT NULL DEFAULT '0', PRIMARY KEY (`id`)) ENGINE = InnoDB;


            ";

            $f = $dbConn->exec( $query );

            if ( $f != 0 )
            {
                // $_SESSION["error_message"] = "FALSE";
                // echo "FALSE";
                $_SESSION["welcome_error_msg"] = "An error occured";
                $_SESSION["welcome_error_bg"] = "bg-failure";
                // exit;
            }


            // if ( !empty ( array_filter( $brand_logo['name'] ) ) )
            // {
                $logoUrl = '';
                foreach( $brand_logo['tmp_name'] as $key => $value )
                {
                    $file_tmp_name = $brand_logo['tmp_name'][$key];
                    $file_name = $brand_logo['name'][$key];
                    $file_size = $brand_logo['size'][$key];
                    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        
                    $filePath = $upload_dir . $file_name;

                    $logoUrl .= "assets/users/" . $user_id . "/media/images/" . $file_name ;
                    $filePath = $upload_dir . $file_name;

                    if ( in_array( strtolower($file_ext), $allowed_exts ) )
                    {

                        if ( $file_size > $maxSize )
                        {
                            
                            $_SESSION["error_msg"] = "File Size is large";
                            $_SESSION["error_bg"] = "bg-failure";
                        }
                        else
                        {

                            if ( file_exists($filePath) )
                            {
        
                                $filePath = $upload_dir.time().$file_name;
        
                                 move_uploaded_file( $file_tmp_name, $filePath );

                                // if ( )
                                // {
                                //     // echo "{$file_name} successfuly uploaded";
                                //     $productImagesUrls.= "assets/products/$product_id/media/images/" . $file_name . ",";
                                // }
                                // else
                                // {
                                //     echo "ERROR";
                                // }
        
                            }
                            else
                            {
        
                                if ( move_uploaded_file( $file_tmp_name, $filePath ) )
                                {
                                    // echo "{$file_name} successfuly uploaded";
                                    $_SESSION["error_msg"] = "Upload Success";
                                    $_SESSION["error_bg"] = "bg-success";
                                    // $productImagesUrls.= "assets/products/$product_id/media/images/" . $file_name . ",";
                                    
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

            // }
            // else
            // {
                
            //     $_SESSION["error_msg"] = "No FIles Selected";
            //     $_SESSION["error_bg"] = "bg-failure";
            // }

            $db_admin_password = password_hash($db_admin_confirm_password, PASSWORD_DEFAULT );

            // if ( password_verfiy(  password, hash-password  ) )
            // {
            //     verfied
            // }


            //INSERTING DATA INTO SITE_DETAILS Table
            $siteInformationTableTableItems = array (

                0 => array( "SITE_NAME", $brand_name ),
                2 => array( "SITE_VISIBILITY", 3 ),
                3 => array( "SITE_BASE_URL", "NULL" ),
                3 => array( "SITE_LOGO", $logoUrl ),
                4 => array( "SITE_CREATION_DATE", date( 'Y-m-d H:i:s') ),
                5 => array( "SITE_LAST_UPDATED_DATE", date( 'Y-m-d H:i:s') ),
                // SITE_BASE_URL
            );

            $q = "INSERT INTO `table_site_details` (`site_details_detail_info`, `site_details_detail_info_value`) VALUES (:title, :answer) ";

            if ( insertIntoDBwhereColumnIsTwo( $dbConn, $q, $siteInformationTableTableItems ) != true )
            {
                // echo "\n FALSE \n";
                $_SESSION["welcome_error_msg"] = "an error occured";
                $_SESSION["welcome_error_bg"] = "bg-failure";
                // array_push( $final_results_array, false );
            }
            else
            {

                // THIS IS FOR INSERTING DATA INTO USER TABLE

                $q = "INSERT INTO `$db_name`.`table_users` (`ID`, `user_name`, `user_email`, `user_username`, `user_password`, `user_id`, `user_role`) 
                                        VALUES (NULL, :user_name,  :user_email,  :user_username , :user_password, :user_id, :user_role) ";


                $tmp_brand_name = strtoupper($brand_name);
                $tmp_brand_name = preg_replace("/\s+/", "-", $tmp_brand_name);

                $userId = generateRadmonStrings("USR-ID-");
                $role = "super-admin";


                // SETTING UP THE DEFAULT SUPER ADMIN ACCOUNT

                
                $stmt = $dbConn->prepare($q);

                $adminName = "NFSFU SUPER ADMIN";
                $adminUsername = "NFSFU-SA";
                $adminPassword = password_hash( "NFSFU-Pass123", PASSWORD_DEFAULT );

                $stmt->bindParam(":user_name", $adminName );
                $stmt->bindParam(":user_username", $adminUsername );
                $stmt->bindParam(":user_email", $db_admin_email );
                $stmt->bindParam(":user_password", $adminPassword );
                $stmt->bindParam(":user_role", $role );
                $stmt->bindParam(":user_id", $userId );

                $stmt->execute();

                // SETTING UP THE NEW USER SUPER ADMIN ACCOUNT
                $userId = generateRadmonStrings("USR-ID-");

                $stmt = $dbConn->prepare($q);

                $stmt->bindParam(":user_name", $db_admin_name );
                $stmt->bindParam(":user_username", $db_admin_username );
                $stmt->bindParam(":user_email", $db_admin_email );
                $stmt->bindParam(":user_password", $db_admin_password );
                $stmt->bindParam(":user_role", $role );
                $stmt->bindParam(":user_id", $userId );

                if ( !$stmt->execute() )
                {
                    // echo "\n FALSE \n";
                    // $_SESSION["welcome_error_msg"] = "FALSE";
                    $_SESSION["welcome_error_msg"] = "an error occured";
                    $_SESSION["welcome_error_bg"] = "bg-failure";
        
                }
                else
                {

                    

                    $site_name_details = 
                        '<?php'. PHP_EOL .
                        '$brandName="' . $brand_name . '";' . PHP_EOL .
                        "?>"
                    ;

                    $site_logo_details = 
                        '<?php'. PHP_EOL .
                        '$logoPath="' . $logoUrl . '";' . PHP_EOL .
                        'define( "LOGO_URL", " $logoPath");' . PHP_EOL . "?>"
                    ;
                    

                    $site_db_details = 
                        '<?php'. PHP_EOL .
                        '$dbName="' . $db_name . '";' . PHP_EOL .
                        '$dbAdminName="' . $db_admin_name . '";' . PHP_EOL .
                        '$dbAdminEmail="' . $db_admin_email . '";' . PHP_EOL .
                        '$dbAdminUsername="' . $db_admin_username . '";' . PHP_EOL .
                        'define( "DB_NAME", " $dbName");' . PHP_EOL .
                        'define( "DB_ADMIN_NAME", " $dbAdminName");' . PHP_EOL .
                        'define( "DB_ADMIN_USERNAME", " $dbAdminUsername");' . PHP_EOL .
                        'define( "DB_ADMIN_EMAIL", " $dbAdminEmail");' . PHP_EOL . "?>" 
                    ;

                    $site_currency_details =
                        '<?php'. PHP_EOL .
                        '$currencyName="' . $currency_name . '";' . PHP_EOL .
                        '$currencySymbol="' . $currency_symbol . '";' . PHP_EOL .
                        'define("CURRENCY_NAME", $currencyName);'.
                        'define("CURRENCY_SYMBOL", $currencySymbol);'
                        . "?>"
                    ;


                    $string = '<?php' . PHP_EOL ;
                        

                    $files = array( "assets/php/pages/site-name.php", "assets/php/pages/site-logo.php", "assets/php/pages/db.php", "assets/php/pages/currency.php" );
                    $strings = array( $site_name_details, $site_logo_details, $site_db_details, $site_currency_details );

                    foreach ( $files as $key => $file )
                    {

                        $string .= 'include_once  "' . $file . ' ";' .PHP_EOL ;

                        if ( file_exists( $file ) )
                        {

                            file_put_contents( $file, $strings[$key] );

                        }

                    }

                    $string .= '?>';
                    
                    if ( file_put_contents( "assets/php/variables.php", $string ) && file_put_contents("../NFSFU-ECOMM/status.file", 1) )
                    {
                        
                        
                        $_SESSION["welcome_error_msg"] = "The Setup was successull.Kindly Wait as we redirect You.";
                        $_SESSION["welcome_error_bg"] = "bg-success";

                        $_SESSION["login-status"] = TRUE;
                        $_SESSION["SSID"] = generateRadmonStrings("ssid-");
                        $_SESSION["SSID-USERNAME"] = $db_admin_username;

                        // header( "refresh:5;url=index.html" );
                        header( "Location: installation.php?respCode=200&creation-process=SUCCESS&message=WELCOME-TO-" .$brand_name );

                    }
                    else
                    {
                        $_SESSION["welcome_error_msg"] = "AN ERROR OCCURED";
                        $_SESSION["welcome_error_bg"] = "bg-failure";
                    }

                    






                }

            }


    
        }







       
    }

    $f = file_get_contents("status.file");

    if ( intval($f) === 1 )
    {
        header("location: index.php?msg=THIS-SERVICE-HAS-BEEN-INSTALLED-ALREADY");
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> NFSFU-ECOMM v0.01 ~ NFORSHIFU234.Dev Codes </title>
    <script src="assets/lib/jquery-3.6.3.js"></script>
    <link rel="stylesheet" href="assets/lib/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <script src="assets/lib/all.min.js"></script>
</head>
<body>
    
    <div class="container-fluid">

        <div class="navigation-bar">

            <a href="" class="logo">
                <img src="assets/img/nforshifu234-dev-logo.png" alt="">
            </a>


        </div>

        <div class="contents container-fluid">

            <?php if( isset( $_SESSION["welcome_error_msg"] ) && isset( $_SESSION["welcome_error_bg"] ) ): ?>
                <div class="error-container display-block">
                    <div class="error-msg-container">

                        <div class="message  <?php echo $_SESSION["welcome_error_bg"]; ?>">
                            <?php echo $_SESSION["welcome_error_msg"]; ?>
                        </div>

                        <div class="icon">
                            <i class="fas fa-times-circle"></i>
                        </div>

                    </div>
                </div>
            <?php endif; ?>

            <div class="page-contents w-100">

                <section class="product-category">

                    <div class="heading">
                        
                        <div class="details" style="width: 100%;height: 70px;display: flex;align-items: center;justify-content: center;" >
                            
                            <h2 class="text-center w-100"> <span><i class="fa fa-note-sticky"></i></span> Welcome To The <span>NFSFU-ECOMM Installation</span> Page </h2>
                        </div>

                    </div>

                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" class="add-new-product-form ">

                        <div class="form-group mt-3 mb-3">

                            <label class="mb-3" for="brand_name">Brand Name <span>*</span></label>
                            <input type="text" class="form-control" name="brand_name" id="brand_name" itemid="brand_name" itemtype="input" placeholder="Enter your brand name... " value="<?php echo  isset($_POST["brand_name"] ) && !empty($_POST["brand_name"]) ? $_POST["brand_name"] : '' ?>" required>

                        </div>

                        <div class="form-group mt-3 mb-3">

                            <label class="mb-3" for="brand_logo">Brand Logo <span>*</span></label>
                            <input type="file" class="form-control" name="brand_logo[]" id="brand_logo" itemid="brand_logo" itemtype="input"  required>

                        </div>

                        <div class="form-group mt-3 mb-3">

                            <label class="mb-3" for="brand_default_currency">Product Currency</label>
                            <p class = "text-failure" ><b>NOTE:</b> By default, the currency dymbol is in USD($)</p>
                            <input type="text" class="form-control" name="brand_default_currency_name" id="brand_default_currency_name" itemid="brand_default_currency_name" itemtype="input" placeholder="Enter your country's monetry name. E.x United States Dollar,Nigerian Naira... " value="<?php echo  isset($_POST["brand_default_currency"] ) && !empty($_POST["brand_default_currency"]) ? $_POST["brand_default_currency"] : '' ?>" >
                            <input type="text" class="form-control mt-3" name="brand_default_currency_symbol" id="brand_default_currency_symbol" itemid="brand_default_currency_symbol" itemtype="input" placeholder="Enter your country's monetry icon. E.x $,... " value="<?php echo  isset($_POST["brand_default_currency"] ) && !empty($_POST["brand_default_currency"]) ? $_POST["brand_default_currency"] : '' ?>" >

                        </div>

                        <div class="form-group mt-3 mb-3">

                            <label class="mb-3" for="db_name">Database Name <span>*</span></label>
                            <input type="text" class="form-control" name="db_name" id="db_name" itemid="db_name" itemtype="input" placeholder="Enter your database name... " value="<?php echo  isset($_POST["db_name"] ) && !empty($_POST["db_name"]) ? $_POST["db_name"] : '' ?>" required>

                        </div>


                        <div class="form-group mt-3 mb-3">

                            <label class="mb-3" for="db_admin_name">Application Admin Name <span>*</span></label>
                            <input type="text" class="form-control" name="db_admin_name" id="db_admin_name" itemid="db_admin_name" itemtype="input" placeholder="Enter your Application Admin name... " value="<?php echo  isset($_POST["db_admin_name"] ) && !empty($_POST["db_admin_name"]) ? $_POST["db_admin_name"] : '' ?>" required>

                        </div>

                        <div class="form-group mt-3 mb-3">

                            <label class="mb-3" for="db_admin_email">Application Admin Email <span>*</span></label>
                            <input type="email" class="form-control" name="db_admin_email" id="db_admin_email" itemid="db_admin_email" itemtype="input" placeholder="Enter your Application Admin email... " value="<?php echo  isset($_POST["db_admin_email"] ) && !empty($_POST["db_admin_email"]) ? $_POST["db_admin_email"] : '' ?>" required>

                        </div>

                        
                        <div class="form-group mt-3 mb-3">

                            <label class="mb-3" for="db_admin_username">Application Admin Username <span>*</span></label>
                            <input type="text" class="form-control" name="db_admin_username" id="db_admin_username" itemid="db_admin_username" itemtype="input" placeholder="Enter your Application Admin username... " value="<?php echo  isset($_POST["db_admin_username"] ) && !empty($_POST["db_admin_username"]) ? $_POST["db_admin_username"] : '' ?>" required>

                        </div>

                        <div class="form-group mt-3 mb-3">

                            <label class="mb-3" for="db_admin_password">Application Admin Password <span>*</span></label>
                            <input type="password" class="form-control" name="db_admin_password" id="db_admin_password" itemid="db_admin_password" itemtype="input" placeholder="Enter your Application Admin password... " required>

                        </div>

                        <div class="form-group mt-3 mb-3">

                            <label class="mb-3" for="db_admin_confirm_password">Application Admin Confirm Password <span>*</span></label>
                            <input type="password" class="form-control" name="db_admin_confirm_password" id="db_admin_confirm_password" itemid="db_admin_confirm_password" itemtype="input" placeholder="Confirm your Application Admin password... " required>

                        </div>

                        <div class="form-group mt-3 mb-3 text-end">

                            <button type="submit" class="btn btn-primary" > <i class="fas fa-download"></i> Begin Installation</button>

                        </div>


                    </form>
                    

                </section>

            </div>

        </div>

    </div>

    <footer class="footer">

        <div class="text-center w-100 p-2">
            <h5>Designed By <a href="https://instagram.com/nforshifu234.dev/" target="_blank" >NFORSHIFU234.Dev CODE</a></h5>
        </div>

    </footer>

</body>
</html>

<?php

unset( $_SESSION["welcome_error_msg"] );
unset( $_SESSION["welcome_error_bg"] );

exit;

?>