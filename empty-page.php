<?php

    require_once __DIR__ . "/assets/php/config.php";
    require_once __DIR__ . "/assets/php/functions/functions.php";

    // var_dump($dbConn);

    chechkSiteVisibilityStatusAndRedirect($dbConn);



?>


<?php require_once 'assets/pages/head.php' ?>

    <title><?php echo $site_titile ?> - Home</title>
</head>
<body>
    
    <div class="container-fluid">

        <?php require_once 'assets/pages/navigation.php' ?>


        <div class="contents container">

            <?php require_once 'assets/pages/sidebar.php' ?>


        </div>

    </div>

</body>
</html>