<?php include_once __DIR__ . "/assets/php/app.php" ?>

<?php

    chechkSiteVisibilityStatusAndRedirect($dbConn);

    

if ( chechkIfLoggedIn() )
{
    $userDetails = getUserDetailsUsingUsername($dbConn, $_SESSION["SSID-USERNAME"] );
}


?>

<?php require_once 'assets/pages/head.php' ?>
<link rel="shortcut icon" href="assets/img/nforshifu234dev-logo-1.png" type="image/x-icon">

    <style>
        .social-media-containers a
        {
            color: var(--black-color);
        }
        .social-media-containers a:hover
        {
            text-decoration:none;
        }

    </style>
    <title>Feedback - NFSFU-ECOMM v1.0.0-alpha</title>
</head>
<body>
    
    <div class="container-fluid">

        <?php require_once 'assets/pages/navigation.php' ?>

            <div class="contents container">

                <?php require_once 'assets/pages/sidebar.php' ?>


                
                <div class="feedback-form-container row w-100" >

                    <div class="col images-social-media d-flex align-items-center justify-content-center" style="border: red solid 2p;flex-direction:column;" >

                        <div class="logo d-flex align-items-center justify-content-center">
                            <img src="assets/img/nforshifu234dev-logo.png" width="80%"  alt="">
                        </div>

                        <div class="social-media-containers">

                            <a href="https://github.com/nforshifu234dev/NFSFU-ECOMM/" class="social-media-icon">
                                <div class="icon">
                                    <i class="fab fa-github"></i>
                                </div>
                                <div class="message">
                                    GitHub
                                </div>
                            </a>

                            <a href="https://www.instagram.com/nforshifu234dev/" class="social-media-icon">
                                <div class="icon">
                                    <i class="fab fa-instagram"></i>
                                </div>
                                <div class="message">
                                    Instagram
                                </div>
                            </a>

                            <a href="https://twitter.com/nforshifu234dev/" class="social-media-icon">
                                <div class="icon">
                                    <i class="fab fa-twitter"></i>
                                </div>
                                <div class="message">
                                    Twitter
                                </div>
                            </a>

                        </div>

                    </div>

                    

                </div>


            </div>

    </div>


<?php

        unset($_SESSION['e_code']);

?>

<?php require_once 'assets/pages/footer.php' ?>