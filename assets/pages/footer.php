
<footer class="container-fluid mt-5 pb-2">

    <div class="row row-cols-1  row-cols-md-2 row-cols-lg-3 row-cols-xl-3 row-cols-xxl-3">

        <div class="col text-center"> 

            <div class="footer-logo" style="height: 120px;" >
                <img src="<?php echo LOGO_URL ?>" style="width:100%;height:100%;object-fit:contain;" alt="">
            </div>

            <div class="site-name mt-2">
                <h3><?php echo $site_titile ?></h3>
            </div>

            <div class="site-email">
                <h5>
                    
                    <a href="mailto:<?php echo DB_ADMIN_EMAIL ?>"> <i class="fas fa-envelope"></i> <?php echo DB_ADMIN_EMAIL ?> </a>
                </h5>
            </div>

        </div>

        <div class="col text-center"> 

            <div class="heading">
                <h3>Quick Links</h3>
            </div>

            <ul class="items" style="list-style-type: none;" >

                <li class="mb-2">
                    <a href="index.php"> <i class="fas fa-home-alt"></i> Home </a>
                </li>

                <li class="mb-2">
                    <a href="about.php"> <i class="fas fa-users"></i>  About</a>
                </li>

                <li class="mb-2">
                    <a href="contact.php"> <i class="fas fa-phone"></i> Contact</a>
                </li>

                <li class="mb-2">
                    <a href="privacy-policy.php"> <i class="fas fa-file-contract"></i> Privacy Policy</a>
                </li>

                <li class="mb-2">
                    <a href="terms-and-conditions.php"><i class="fas fa-file-contract"></i>  Terms and Conditions</a>
                </li>

            </ul>

        </div>

        <div class="col text-center"> 

            <div class="heading">
                <h3>Links</h3>
            </div>

            <ul class="items" style="list-style-type: none;" >

                <li class="mb-2">
                    <a href="shop.php"> <i class="fas fa-shop"></i> Shop </a>
                </li>

                <li class="mb-2">
                    <a href="login.php"> <i class="fas fa-user"></i> Login</a>
                </li>

                <li class="mb-2">
                    <a href="cart.php"> <i class="fas fa-shopping-basket"></i> Cart</a>
                </li>

                <li class="mb-2">
                    <a href="feedback.php"> <i class="fab fa-wpforms"></i> Send Feedback</a>
                </li>

            </ul>

        </div>

    </div>

    <div class="copy p-4 bg-dark text-white mt-2" style="display: flex; align-items:center;justify-content:center;font-weight:bolder;font-size: calc(100% + 0.5rem);" >

        Copyright &copy; <?php echo date("Y") ?> . <?php echo $site_titile ?>

    </div>

</footer>

<?php 
    if ( isset( $_SERVER['REQUEST_URI'] ) && $_SERVER['REQUEST_URI'] != '/NFSFU-ECOMM/feedback.php' ):
?>
<div class="send-feedback-bottom-button-container">

    <div class="send-feedback-bottom-button">

        <a href="feedback.php" class="icon">
        
            <i class="fab fa-wpforms "></i>

        </a>

        <div class="message">
            send feedback 🙂
        </div>

    </div>

</div>

<?php endif; ?>

</body>

</body>