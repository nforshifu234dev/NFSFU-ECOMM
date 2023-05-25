<?php use PHPMailer\PHPMailer\PHPMailer; ?>
<?php include_once __DIR__ . "/assets/php/app.php" ?>

<?php

    chechkSiteVisibilityStatusAndRedirect($dbConn);

    

if ( chechkIfLoggedIn() )
{
    $userDetails = getUserDetailsUsingUsername($dbConn, $_SESSION["SSID-USERNAME"] );
}


?>

<?php require_once 'assets/pages/head.php' ?>

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
                            <img src="assets\brand\images\logo.png" width="50%"  alt="">
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

    <script>

        $(document).on('submit', 'form', function(e){
            e.preventDefault();
        });

        const submitBtn = document.getElementById("feedbackSend");
        const form = document.getElementById("feedForm");

        submitBtn.addEventListener("click", ()=>{


            const u_name = document.getElementById("u_name") ;
            const u_mail = document.getElementById("u_mail");
            const u_msg = document.getElementById("u_message");

            const t = setTimeout(() => {
                errorContainer.classList.remove("display-block");
                errorContainer.innerHTML = '';
            }, 3000);

            function displayErroMessage(message)
            {
                const errorContainer = document.getElementById("errorContainer");

                errorContainer.classList.add("display-block");
                errorContainer.innerHTML = message;

                t;
                

            }

            const validateEmail = (email) =>{
                return String(email).toLowerCase()
                .match(
                  /^(([^<>()[\]\\,,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/  
                );
            }


            if ( !u_name.value )
            {
                console.log(true);
                displayErroMessage("Please provide a name.");
                u_name.focus();
            }
            else if( !u_mail.value )
            {
                displayErroMessage("Please provide an email.");
                u_mail.focus();

            }
            else if ( !u_msg.value )
            {
                displayErroMessage("Please enter some message.");
                u_msg.focus();

            }
            else if ( ! validateEmail( u_mail.value ) )
            {
                displayErroMessage("Please provide a valid email.");
                u_mail.focus();
            }
            else
            {

                if ( !window.navigator.onLine )
                {
                    displayErroMessage("Please connect to the internet or check your network connection to send me a feedback.");
                }
                else
                {

                    form.submit();
                    t;

                }

            }



        });

    </script>

<?php

        unset($_SESSION['e_code']);

?>

<?php require_once 'assets/pages/footer.php' ?>