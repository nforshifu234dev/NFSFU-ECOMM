<div class="navigation-bar">

<a href="index.php" class="logo">
    <img src="<?php echo LOGO_URL ?>" alt="">
</a>

<div class="responsive-icon display-block-on-small">
    <i class="fas fa-bars fa-2x"></i>
</div>

<div class="links-and-icon-container">

    <div class="close-button display-none-on-large display-block-on-small">
        <div class="ui-close">
            <i class="fas fa-times"></i>
        </div>
    </div>

    <div class="navigation-links">
    

        <?php $file_page = basename( $_SERVER['PHP_SELF'], '.php' ); ?>

        

        <?php if ( $file_page === 'home' || $file_page === 'index' ): ?>

            <a href="index.php" class="nav-link active">
            Home
        </a>

        <?php else: ?>

            <a href="index.php" class="nav-link">
            Home
        </a>

        <?php endif; ?>

        <?php if ( $file_page === 'shop' ): ?>

            <a href="shop.php" class="nav-link active">
                Shop
            </a>

        <?php else: ?>

            <a href="shop.php" class="nav-link">
                Shop
            </a>

        <?php endif; ?>

        <?php if ( $file_page === 'about' ): ?>

            <a href="about.php" class="nav-link active">
            About
        </a>

        <?php else: ?>

            <a href="about.php" class="nav-link">
            About
        </a>


        <?php endif; ?>

        <?php if ( $file_page === 'contact' ): ?>

            <a href="contact.php" class="nav-link active">
            Contact
        </a>

        <?php else: ?>

            <a href="contact.php" class="nav-link">
            Contact
        </a>

        <?php endif; ?>

        
        

        <?php if( chechkIfLoggedIn() ): ?>

            <a href="dashboard.php" class="category-item">
                <span class="mx-3" >
                                <i class="fas fa-dashboard"></i>
                </span>
                <span class="category-text display-none-on-small ">
                                Dashboard
                </span>
            </a>

        <?php endif; ?>
        
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

        <a href="cart.php" class="icon">
            <i class="fas fa-shopping-cart fa-2x"></i>
        </a>

    </div>

</div>

</div>