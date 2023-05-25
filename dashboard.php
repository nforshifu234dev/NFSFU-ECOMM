<?php include_once __DIR__ . "/assets/php/app.php" ?>
<?php include_once __DIR__ . "/assets/php/admin.php" ?>

<?php 

$dbConn = $connectionHandler;
$site_titile = getSiteName($dbConn)[0];

?>

<?php 

if ( !chechkIfLoggedIn() )
 {
     header("location: login.php?returnUrl=" . htmlspecialchars($_SERVER['PHP_SELF']) );
 }

$userDetails = getUserDetailsUsingUsername($dbConn, $_SESSION["SSID-USERNAME"] );

$total_number_of_products = count(getAllProducts($dbConn));
$total_number_of_categories = count(getAllCategories($dbConn));
$total_number_of_users = count(getAllUsers($dbConn));

?>

<?php require_once 'assets/pages/admin/head.php' ?>

    <title>Admin Dashboard - <?php echo $site_titile ?></title>

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

                <div class="row row-cols-1 cols-4 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 row-cols-xxl-5" >

                <a href="installation.php" class="col card mb-3 dashboard-card mx-1">
                    <div class="icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <h3 class="message text-center">installation guide</h3>
                </a>

                <a href="profile.php" class="col card mb-3 dashboard-card mx-1">
                    <div class="icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h3 class="message text-center">MY ACCOUNT</h3>
                </a>

                <?php 

                    if( file_exists('assets/pages/admin/pages/dashboard/' . $userDetails['user_role'] . '.dashboard.php') )
                    {
                        include_once 'assets/pages/admin/pages/dashboard/' . $userDetails['user_role'] . '.dashboard.php';
                    }

                ?>

                <a href="feedback.php" class="col card mb-3 dashboard-card mx-1 text-white bg-info">
                    <div class="icon"><i class="fab fa-wpforms"></i></div>
                    <h3 class="message text-center">send feedback</h3>
                </a>

                <a href="https://github.com/nforshifu234dev/NFSFU-ECOMM/" target="_blank" class="col card mb-3 dashboard-card mx-1 text-white bg-info">
                    <div class="icon"><i class="fas fa-clock"></i></div>
                    <h3 class="message text-center">Check for updates</h3>
                </a>

                <a href="https://linktr.ee/nforshifu234dev/" target="_blank" class="col card mb-3 dashboard-card mx-1 text-white bg-info">
                    <div class="icon"><i class="fas fa-globe"></i></div>
                    <h3 class="message text-center">NFORSHIFU234.Dev</h3>
                </a>

                <a href="logout.php" class="col card mb-3 dashboard-card mx-1 text-white-50 bg-danger">
                    <div class="icon"><i class="fas fa-door-open"></i></div>
                    <h3 class="message text-center">Logout</h3>
                </a>
                    
                    

                </div>
                

            </div>

        </div>

    </div>

</body>
</html>