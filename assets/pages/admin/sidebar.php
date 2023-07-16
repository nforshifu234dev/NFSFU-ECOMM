<div class="categories">

    <section class="category" id="category">

        <div class="heading">
            <h2>Role: <b><?php echo $userDetails["user_role"] ?></b> </h2>
            <p  class="fs-2">The time is: <span class="fw-3" id="timeCont" >HH:MM:SS</span> </p>
            <hr>
        </div>

        <a href="dashboard.php" class="category-item">
            <span class="mx-3" >
                <i class="fas fa-dashboard"></i>
            </span>
            <span class="category-text display-none-on-small ">
                Dashboard
            </span>
        </a>

        <a href="profile.php" class="category-item">
            <span class="mx-3" >
                            <i class="fas fa-user"></i>
            </span>
            <span class="category-text display-none-on-small">
                            Account
            </span>
        </a>

        <?php 

            if( file_exists( PARENT_DIR . "/assets/pages/admin/pages/sidenav/" . $userDetails['user_role'] . '.sidebar.php' ) )
            {
                include_once   PARENT_DIR . "/assets/pages/admin/pages/sidenav/" . $userDetails['user_role'] . '.sidebar.php';
            }
            else
            {
                echo "Could Not Load The Menu Pages.";
            }

         
        ?>

        <a href="profile.php" class="category-item bg-info text-white">
            <span class="mx-3" >
                            <i class="fas fa-user"></i>
            </span>
            <span class="category-text display-none-on-small">
                            My Profile
            </span>
        </a>

        <a href="https://github.com/nforshifu234dev/NFSFU-ECOMM/" target="_blank" class="category-item bg-dark text-white-50">
            <span class="mx-3" >
                            <i class="fas fa-clock"></i>
            </span>
            <span class="category-text display-none-on-small">
                            check for updates
            </span>
        </a>

        <a href="logout.php" class="category-item bg-danger text-white-50">
            <span class="mx-3" >
                            <i class="fas fa-door-open"></i>
            </span>
            <span class="category-text display-none-on-small">
                            Logout
            </span>
        </a>

        


    </section>



</div>