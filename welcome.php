<?php include_once __DIR__ . "/assets/php/app.php" ?>
<?php include_once __DIR__ . "/assets/php/admin.php" ?>



<?php require_once 'assets/pages/head.php' ?>

    <title>Installation Guide Of NFSFU-ECOMM v0.01 </title>

    <style>

        .guide a
        {
            color: var(--green-color) !important;
        }

    </style>


    

</head>
<body>

    <div class="container-fluid">

        <?php require_once 'assets/pages/navigation.php' ?>


        <div class="contents container-fluid">

            <?php require_once 'assets/pages/sidebar.php' ?>

            <div class="page-contents">

                <section class="product-category">

                    <div class="heading ">
                        <div class="details">
                            <h2> <i class="fas fa-info-circle"></i> ~ Installation Guide</h2>
                        </div>

                    </div>

                    <div class="guide" id="guide">

                    </div>


                </section>

            </div>

        </div>

    </div>

        <script src="assets/lib/marked_3.3.0.min.js"></script>

        <script>

            const container = document.getElementById("guide");

            fetch('ReadMe.md')
                .then(resp => resp.text())
                .then(data => {

                    const htmlContents = marked(data);

                    container.innerHTML = htmlContents;

                })
                .catch(error => {
                    container.innerHTML = "<center><h1>AN ERROR OCCURED. KINDLY RELOAD THE PAGE. IF THIS MESSAGE  CI+ONTINUE KINDLY CONTACT ME.</h1></center>";
                });

        </script>


    <?php require_once 'assets/pages/footer.php' ?>
