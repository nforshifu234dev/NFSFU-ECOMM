<?php include_once __DIR__ . "/assets/php/app.php" ?>
<?php 
define("PARENT_DIR", __DIR__);

if ( !chechkIfLoggedIn() )
{
    header("location: login.php?returnUrl=" . htmlspecialchars($_SERVER['PHP_SELF']) );
}
$userDetails = getUserDetailsUsingUsername($dbConn, $_SESSION["SSID-USERNAME"] );

if ( $userDetails['user_role'] != 'super-admin'  )
{
    load404Page();
    exit;
}

$siteDetails = getAllSiteInformation($dbConn);

?>
<?php 

if( $_SERVER["REQUEST_METHOD"] === "GET" )
{
    
    

}

if( $_SERVER["REQUEST_METHOD"] === "POST" )
{

    foreach( $siteDetails as $key => $siteDetail )
    {

        if (  isset (  $_POST["update". $siteDetail["site_details_detail_info"] ]  ))
        {


            if ( hash_equals( "SITE_BASE_URL", $siteDetail["site_details_detail_info"] ) )
            {

                $siteUrl = isset( $_POST[ $siteDetail["site_details_detail_info"] ] ) && !empty( $_POST[ $siteDetail["site_details_detail_info"] ] ) ? $_POST[ $siteDetail["site_details_detail_info"] ] : '';
                


                if ( !updateSiteInformation($dbConn, $siteUrl, $siteDetail["ID"] ) )
                {

                    header("location:" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?respCode=402&message=AN-ERROR-OCCURED" );

                }
                else
                {
                    updateSiteLastUpdatedTime( $dbConn, date( 'Y-m-d H:i:s') );

                    header("location:site-details.php". "?respCode=200&UPDATED-" . $siteDetail["site_details_detail_info"] . "-SUCCESS" );

                }

            }
            else if ( hash_equals( "SITE_NAME", $siteDetail["site_details_detail_info"] ) )
            {

                
                $siteUrl = isset( $_POST[ $siteDetail["site_details_detail_info"] ] ) && !empty( $_POST[ $siteDetail["site_details_detail_info"] ] ) ? $_POST[ $siteDetail["site_details_detail_info"] ] : '';
                


                if ( !updateSiteInformation($dbConn, $siteUrl, $siteDetail["ID"] )  )
                {

                    header("location:" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?respCode=402&message=AN-ERROR-OCCURED" );

                }
                else
                {


                    

                    $q = 
                    '
                    <?php ' .PHP_EOL . ' $brandName="' . $siteUrl . '"; ' . PHP_EOL . ' 
                    ?>
                    ';

                    if ( !file_put_contents( "assets/php/site-name.php", $q ) )
                    {
                        header("location:" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?respCode=402&message=ERROR->COULD_NOT_WRITE_TO_FILE" );
                    }

                    


                    updateSiteLastUpdatedTime( $dbConn, date( 'Y-m-d H:i:s') );
                    header("location:site-details.php". "?respCode=200&UPDATED-" . $siteDetail["site_details_detail_info"] . "-SUCCESS" );

                }

            }
            else if ( hash_equals( "SITE_VISIBILITY", $siteDetail["site_details_detail_info"] ) )
            {

                $siteUrl = isset( $_POST[ $siteDetail["site_details_detail_info"] ] ) && !empty( $_POST[ $siteDetail["site_details_detail_info"] ] ) ? $_POST[ $siteDetail["site_details_detail_info"] ] : '0';
                


                    if ( !updateSiteInformation($dbConn, $siteUrl , $siteDetail["ID"] )  )
                    {
    
                        header("location:" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?respCode=402&message=AN-ERROR-OCCURED" );
    
                    }
                    else
                    {
    
    
                        
                        if ( !file_put_contents( "assets/php/site-name.php", $msg ) )
                        {
                            header("location:" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?respCode=402&message=ERROR->COULD_NOT_WRITE_TO_FILE" );
                        }
    
                        updateSiteLastUpdatedTime( $dbConn, date( 'Y-m-d H:i:s') );
                        header("location:site-details.php". "?respCode=200&UPDATED-" . $siteDetail["site_details_detail_info"] . "-SUCCESS" );
    
                    }
    


                
            }

                    
            

        }

    }


}
?>


<?php require_once 'assets/pages/admin/head.php' ?>

    <title> Edit SITE INFORMATION -  <?php echo $site_titile ?></title>
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
                            <h2> <i class="fa fa-pencil"></i> Edit <span>INFORMATION SITE DETAILS</span>  </h2>
                        </div>

                    </div>
                    
                    <?php 
                        foreach( $siteDetails as $key => $siteDetail ):
                    
                    ?>

                        <?php if ( hash_equals( "SITE_BASE_URL", $siteDetail["site_details_detail_info"] ) ): ?>

                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="add-new-product-form ">

                                <div class="form-group mt-3 mb-3">

                                    <label class="mb-3" for="<?php echo $siteDetail["site_details_detail_info"] ?>"><?php echo $siteDetail["site_details_detail_info"] ?> <span>*</span></label>
                                    <input type="url" class="form-control" name="<?php echo $siteDetail["site_details_detail_info"] ?>" id="<?php echo $siteDetail["site_details_detail_info"] ?>" itemid="<?php echo $siteDetail["site_details_detail_info"] ?>" itemtype="input" value="<?php echo $siteDetail["site_details_detail_info_value"]; ?>" placeholder="Ex. Category 1, Category 2, Category 3, ... " required>

                                    </div>

                                    <div class="form-group mt-3 mb-3 text-end">

                                    <button type="submit" name="update<?php echo $siteDetail["site_details_detail_info"] ?>" class="btn btn-primary" > <i class="fas fa-upload"></i> Update <?php echo $siteDetail["site_details_detail_info"]; ?></button>

                                </div>


                            </form>

                        <?php elseif ( $key === 3 ): ?>

                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="add-new-product-form ">

                                <div class="form-group mt-3 mb-3">

                                    <label class="mb-3" for="<?php echo $siteDetail["site_details_detail_info"] ?>"><?php echo $siteDetail["site_details_detail_info"] ?> <span>*</span></label>
                                    <input type="text" class="form-control" name="<?php echo $siteDetail["site_details_detail_info"] ?>" id="<?php echo $siteDetail["site_details_detail_info"] ?>" itemid="<?php echo $siteDetail["site_details_detail_info"] ?>" itemtype="input" value="<?php echo $siteDetail["site_details_detail_info_value"]; ?>" placeholder="Ex. Category 1, Category 2, Category 3, ... " required>

                                    </div>

                                    <div class="form-group mt-3 mb-3 text-end">

                                    <button type="submit" name="update<?php echo $siteDetail["site_details_detail_info"] ?>" class="btn btn-primary" > <i class="fas fa-upload"></i> Update <?php echo $siteDetail["site_details_detail_info"]; ?></button>

                                </div>


                            </form>

                        <?php elseif ( $key === 4 ): ?>

                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="add-new-product-form ">

                                <div class="form-group mt-3 mb-3">

                                    <label class="mb-3" for="<?php echo $siteDetail["site_details_detail_info"] ?>"><?php echo $siteDetail["site_details_detail_info"] ?> <span>*</span></label>

                                    <select class="form-control" name="<?php echo $siteDetail["site_details_detail_info"] ?>" id="<?php echo $siteDetail["site_details_detail_info"] ?>">
                                        <option value="<?php echo isset( $siteDetail["site_details_detail_info_value"] ) && !empty($siteDetail["site_details_detail_info_value"]) ? $siteDetail["site_details_detail_info_value"] : ''; ?>"> <?php echo isset( $siteDetail["site_details_detail_info_value"] ) && !empty($siteDetail["site_details_detail_info_value"]) ? $siteDetail["site_details_detail_info_value"] : 'Choose a state'; ?> </option>
                                        <option value="0">0 -> Services Offline</option>
                                        <option value="1">1 -> Active</option>
                                        <option value="2">2 -> Maintainance</option>
                                        <option value="3">3 -> Coming Soon</option>
                                    </select>

                                    </div>

                                    <div class="form-group mt-3 mb-3 text-end">

                                    <button type="submit" name="update<?php echo $siteDetail["site_details_detail_info"] ?>" class="btn btn-primary" > <i class="fas fa-upload"></i> Update <?php echo $siteDetail["site_details_detail_info"]; ?></button>

                                </div>


                            </form>


                       

                        <?php endif; ?>

                           

                    <?php endforeach; ?>

                </section>
                

            </div>

        </div>

    </div>

</body>
</html>