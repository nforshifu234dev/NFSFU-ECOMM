<div class="navigation-bar">

<a href="index.php" class="logo" target="_blank" style="width:200px;height:100%;" >
    <img src="<?php echo LOGO_URL ?>" style="width:100%;height:100%;object-fit:contain;">
    <h2 class="list-inline-item" ><?php echo $site_titile ?></h2>
</a>

<div class="responsive-icon display-block-on-small">
    <i class="fas fa-bars fa-2x"></i>
</div>

<div class="links-and-icon-container"  >

    <div class="close-button display-none-on-large display-block-on-small">
        <div class=" ui-close ">
            <i class="fas fa-times"></i>
        </div>
    </div>

    <div class="navigation-links ">

        <a href="index.php" target="_blank" class="nav-link active">
            <i class="fas fa-home-alt mx-1"></i>
            Home
        </a>

        <a href="shop.php" target="_blank" class="nav-link ">
            <i class="fas fa-shop mx-1"></i>
            Shop
        </a>
        
    </div>

    <div class="icons">

        <form method="GET" action="search.php" class="form-inline list-inline-item">

            <div class="form-group list-inline-item">
                <input type="search" class="form-control " name="q" placeholder="Search for products, categories,..."  >
            </div>

            <button type="submit" class="btn btn-success list-inline-item"> <i class="fas fa-search"></i> Search</button>

        </form>

        <?php if( chechkIfLoggedIn() ): ?>


            <a href="profile.php" class="icon">
                <i class="fas fa-user fa-2x"></i>
            </a>

            <?php else: ?>

            <a href="login.php" class="icon">
                <i class="fas fa-user fa-2x"></i>
            </a>

        <?php endif; ?>

        <a href="#" class="icon display-none">
            <i class="fas fa-shopping-cart fa-2x"></i>
        </a>

    </div>

</div>

</div>