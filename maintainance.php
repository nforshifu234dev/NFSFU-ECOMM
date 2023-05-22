<?php

include_once __DIR__ . "/assets/php/app.php" ;
// include_once __DIR__ . "/assets/php/connect.php";

if ( chechkSiteVisibilityStatus($dbConn) != 2 )
{
    header("location: index.php");
}

$site_titile = getSiteName($dbConn)[0];


include_once "assets/pages/head.php";

?>

    <title> CURRENTLY OFFLINE  - <?php echo $site_titile ?></title>
</head>
<body>
    
    <div class="container-fluid">

        <?php require_once 'assets/pages/navigation.php' ?>


        <div class="contents container-fluid">

        

        <div class="page-contents w-100">

            <div class="page-not-found-container">

                <div class="title text-center">
                    <h1 class="text-uppercase"> <i class="fas fa-tools text-danger"></i> MAINTANANCE ONGOING</h1>
                    <p class="mt-4" > <b class="text-success"><?php echo $site_titile ?></b> is currently undergoing maintainace </p>
                    <p>Kindly Bear with us . </p>
                    <p>
                        <b>Thank You. The Managment.</b>
                        
                    </p>
                    
                </div>

                <div class="copy p-4 mt-2" style="display: flex; align-items:center;justify-content:center;font-weight:bolder;font-size: calc(100% + 0.5rem);" >

                    Copyright &copy; <?php echo date("Y") ?> . <?php echo $site_titile ?>

                </div>

            </div>

        </div>

        </div>

    </div>

</body>
</html>