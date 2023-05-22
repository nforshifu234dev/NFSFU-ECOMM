
<?php include_once "assets/php/app.php" ?>
<?php
chechkSiteVisibilityStatusAndRedirect($dbConn);
?>
<?php require_once 'assets/pages/head.php' ?>

    <title> Privacy Policy  - <?php echo $site_titile ?></title>
</head>
<body>
    
    <div class="container-fluid">

        <?php require_once 'assets/pages/navigation.php' ?>


            <div class="contents container-fluid">

                <?php require_once 'assets/pages/sidebar.php' ?>

                <div class="page-contents">
                
                <?php echo getContentsFromAFile("assets/pages/privacy-policy.php"); ?>

                </div>

            </div>


    </div>

    <?php require_once 'assets/pages/footer.php' ?>