
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="assets/libary/jquery-3.6.3.js"></script>
    <link rel="stylesheet" href="assets/lib/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <script src="assets/lib/all.min.js"></script>
    <!-- <script src="assets/js/into.js"></script> -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/admin.js"></script>

    <style>
	
        .navigation-bar .logo 
        {
            display: flex;
            min-width: 30%;
            max-width: 100% !important;
            height: 100%;
            display: flex;
            align-items: center;
            /* border: rgb(255, 0, 93) solid 2px; */
        }
	
        .navigation-bar .logo .list-inline-item
        {
            /* border: 2px solid gold; */
            height: 100%;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: calc(100% - 0.5rem);
        }

        .navigation-bar .logo img
        {
            width: 50% !important;
            height: 100%;
            object-fit: contain;
        }

        .navigation-bar .links-and-icon-container
        {
            justify-content: right;
        }

        .navigation-bar .links-and-icon-container a:hover
        {
            text-decoration: none !important;
        }

        .categories
        {
            position: -webkit-sticky;
            position: sticky;
            top: 120px;
            z-index: 1020;
            width: 100%;
            margin-top: 100%;
        }

        

        .contents .page-contents
        {
            padding: 0.5rem;
            /* width: 72%; */
            width: calc(100% - 25%);
            padding: 0.5rem;
            /* border: rgb(255, 0, 93) solid 2px; */
        }

        .contents
        {
            flex-direction: row;
            -ms-flex-direction: row;
        }

        .contents .categories
        {
            width: max-content;
        }



        .add-new-product-form .row 
        {
            flex-direction: column;
            -ms-flex-direction: column;
        }

        .add-new-product-form .row .col
        {
            width: 100% !important;
            margin: 10px 0;
        }

        .dashboard-card .message
        {
            text-transform: capitalize;
        }

        .category 
        {
            text-transform: capitalize;
        }

        @media screen and (max-width:1000px) 
        {
        
            .navigation-bar .logo 
            {
                flex-direction: column;
                color: var(--black-color);
            }

            .category .heading
            {
                display: none;
            }

            .navigation-bar .logo .list-inline-item
            {
                /* border: 2px solid gold; */
                font-size: calc(100% - 1rem);
            }
            
        }


    </style>