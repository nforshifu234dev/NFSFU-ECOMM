<?php include_once __DIR__ . "/assets/php/app.php" ?>

<?php

    chechkSiteVisibilityStatusAndRedirect($dbConn);

    

if ( chechkIfLoggedIn() )
{
    $userDetails = getUserDetailsUsingUsername($dbConn, $_SESSION["SSID-USERNAME"] );
}

// echo $_SERVER['REQUEST_METHOD'];

if ( $_SERVER['REQUEST_METHOD'] === "POST" )
{

    // echo "POST";
    // var_dump($_POST);

    // if ( isset( $_POST['feedbackSend'] ) )
    // {

        $from = $_POST['u_mail'];
        $name = $_POST['u_name'];
        $msg = $_POST['u_message'];

        if ( empty($msg) || empty($from) || empty($name) )
        {
            $_SESSION["e_message"] = "Empty Feilds";
            header("location: " . htmlspecialchars( $_SERVER["PHP_SELF"] )) ;
            exit;
        }

        $to = "nforshifu234.dev@gmail.com";
        $subject = "Feedback Form from NFSFU-ECOMM v-1.0.0-alpha";

        $header = "From: $from \r\n";
        $header .= "Cc:work.nforshifu@gmail.com \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";

        $retval = mail( $to, $subject, $msg, $header );

        if ( $retval == true )
        {
            $_SESSION['e_message'] = "Your Feedback Was Sent Successfully";
            $_SESSION['e_code'] = 200;
            // echo "SENT";
        }
        else
        {
            $_SESSION['e_message'] = "Your Feedback Was NOT Sent Successfully";
            $_SESSION['e_code'] = 402;
            // echo "NOT SENT";
        }

        // htmlspecialchars( $_SERVER["PHP_SELF"] );

    // }

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

                    <div class="col images-social-media d-flex align-items-center justify-content-center" style="border: red solid 2p;" >

                        <div class="logo">
                            <img src="<?php echo LOGO_URL ?>" alt="">
                        </div>

                        <div class="social-media-containers">

                            <div class="social-media-icon">
                                <div class="icon"></div>
                                <div class="message"></div>
                            </div>

                        </div>

                    </div>

                    <form action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"] ) ?>" method="POST" class="col form" id="feedForm">

                        <div class="title text-center">
                        
                            <hr>
                            <h2>
                                <i class="fas fa-envelope-open"></i>
                                Feedback Form
                            </h2>
                            <p>
                                Thank you for sharing your feedback with me on how to improve this project in the long run.
                            </p>
                            <hr>

                        </div>

                        <?php if ( isset( $_SESSION['e_message'] ) && !empty($_SESSION['e_message']) ): ?>
                            <div class="error bg-danger text-white w-100 text-center p-3 text-bold text-uppercase mb-2 display-block" id="errorContainer" >

                            <?php echo $_SESSION['e_message'] ?>

                            </div>

                        <?php 
                            unset($_SESSION['e_message']);

                            else :
                        ?>
                            <div class="error bg-danger text-white w-100 text-center p-3 text-bold text-uppercase mb-2" id="errorContainer" >
                            

                            </div>
                        <?php endif;  ?>

                        <div class="form-group mb-2">
                            <label for="" class="mb-2">
                                <i class="fas fa-user"></i>
                                Your Name <span class="text-danger" ><small>-Required</small></span> 
                            </label>
                            <input type="text" class="form-control" id="u_name" name="u_name" <?php echo $ans = ( chechkIfLoggedIn() ) ? 'value=" ' . $userDetails['user_name'] . '"' : null;  ?>  require>
                        </div>

                        <div class="form-group mb-2">
                            <label for="" class="mb-2">
                                <i class="fas fa-envelope"></i>
                                Your Email <span class="text-danger" ><small>-Required</small></span>
                            </label>
                            <input type="email" class="form-control" id="u_mail" name="u_mail" <?php echo $ans = ( chechkIfLoggedIn() ) ? 'value=" ' .  $userDetails['user_email'] . '"' : '' ?> require>
                        </div>

                        <div class="form-group mb-2">
                            <label for="" class="mb-2">
                                <i class="fas fa-envelope-open"></i>
                                Feedback Message <span class="text-danger" ><small>-Required</small></span>
                            </label>
                            <textarea class="form-control" id="u_message" name="u_message" style="min-height:150px;" require></textarea>
                        </div>

                        <div class="form-group">
                            <button class="form-control bg-primary text-white" id="feedbackSend" name="feedbackSend" >
                                Send Feedback
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>

                    </form>

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

        // unset($_SESSION['e_message']);
        unset($_SESSION['e_code']);

?>

<?php require_once 'assets/pages/footer.php' ?>