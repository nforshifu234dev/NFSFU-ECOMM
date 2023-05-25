<?php include_once __DIR__ . "/assets/php/app.php" ?>
<?php 

if ( !chechkIfLoggedIn() )
{
    header("location: login.php?returnUrl=" . htmlspecialchars($_SERVER['PHP_SELF']) );
}
$userDetails = getUserDetailsUsingUsername($dbConn, $_SESSION["SSID-USERNAME"] );

if ( $userDetails['user_role'] != 'super-admin' && $userDetails['user_role'] != 'product-manager' && $userDetails['user_role'] != 'user' && $userDetails['user_role'] != 'admin'  )
{
    load404Page();
    exit;
}

?>
<?php



if( $_SERVER["REQUEST_METHOD"] === "GET" )
{
    
   $products = getAllProducts($dbConn, 0);

   if ( isset( $_GET["offset"] ) && isset( $_GET["SSID"] ) && !empty( $_GET["offset"] ) && !empty( $_GET["SSID"] ) )
   {
        if ( !hash_equals( $_SESSION["SSID"],  $_GET["SSID"] )  )
        {
            load404Page();
            exit;
        }

        $offset = intval( $_GET["offset"] );
        $categories = getAllProducts($dbConn, $offset);

        $result = array(
            "status" => 200,
            "response" => $categories
        );

        echo json_encode($result);
        exit;

   }

}

if( $_SERVER["REQUEST_METHOD"] === "POST" )
{

    if ( !isset( $_POST["delete-id"] ) || empty( $_POST["delete-id"] ) )
    {
        exit;
    }

    $deleteId = $_POST["delete-id"];

    $checkIfRecordExist = chechkIfValueExist($dbConn, 'table_products', "product_id", $deleteId);

    if ( $checkIfRecordExist != 1 )
    {
        //echo "Product Not FOund";
        exit;
    }


    $product_dir = "assets" . DIRECTORY_SEPARATOR . "products" . DIRECTORY_SEPARATOR . $deleteId . DIRECTORY_SEPARATOR ;
    
    // echo $product_dir;

    if ( is_dir( $product_dir ) )
    {
        // $it = new RecursiveDirectoryIterator($product_dir, RecursiveDirectoryIterator::SKIP_DOTS);
        // $files = new RecursiveIteratorIterator($it,
        //     RecursiveIteratorIterator::CHILD_FIRST
        // );

        $files = scandir($product_dir);

        foreach ( $files as $file )
        {
    
            if ( $file->isDir() )
            {
                rmdir($file->getRealPath());
            }
            else
            {
                unlink($file->getRealPath());
            }
    
        }
    
        rmdir($product_dir);

    }

    if ( deleteProductDetailInDB( $dbConn, "table_products", $deleteId ) )
    {
        header("Location:" . htmlspecialchars($_SERVER['PHP_SELF']) . "?respCode=200&msg=success");
    }
    else
    {
        header("Location:" . htmlspecialchars($_SERVER['PHP_SELF']) . "?respCode=400&msg=error");
    }


    // echo "SUCCESS";

}

?>

<?php require_once 'assets/pages/admin/head.php' ?>

    <title> View Products - <?php echo $site_titile ?></title>

    

</head>
<body>
    
    <div class="container-fluid">

        <?php require_once 'assets/pages/admin/navigation.php' ?>


        <div class="contents container-fluid">

            <?php require_once 'assets/pages/admin/sidebar.php' ?>


            <?php require_once 'assets/pages/view-product.php' ?>


        </div>

    </div>

</body>

<script>

var numberOfrecords = parseInt( document.getElementById("numberOfRecordsShown").innerHTML );

if ( numberOfrecords < 50 )
{
    document.querySelector(".loadMoreButton").classList.add("display-none");
}
else
{

    document.querySelector(".loadMoreButton").addEventListener("click", ()=>
    {

        const url = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>?offset=" + numberOfrecords + "&SSID=<?php echo $_SESSION["SSID"] ?>";
        // console.log(url);

        let requestOptions = 
        {

            method: "GET",
            mode: "same-origin",
            credentials: "same-origin",
            Accept: 'application/json, text/plain, */*',
            headers: {
                Accept: 'application/json, text/plain, */*',
            },
            cache: 'default',

        }

        fetch( url, requestOptions )
        .then( (response) => response.json() )
        .then( (data) => {

            let status = parseInt(data.status);
            console.log(data.status);
            if ( status === 200 )
            {

                console.log(data.response);

                let datas = data.response;

                // if ( datas.length === 0 || data === undefined )
                if ( datas.length === 0 )
                {
                    document.querySelector(".loadMoreButton").innerHTML = "<h1>You Have Reached the end of all categories in the Database</h1>";
                }
                else
                {

                    datas.forEach( ( data )=>
                    {

                        const dataRow = document.createElement("tr");

                            const table_categroy_id = document.createElement("td");
                                    table_categroy_id.setAttribute("scope", "row");
                                    table_categroy_id.innerHTML = numberOfrecords + 1;

                            const table_product_name = document.createElement("td");
                                    table_product_name.innerHTML = data.product_name;

                            const table_product_id = document.createElement("td");
                                    table_product_id.innerHTML = data.product_id;

                            const table_product_category = document.createElement("td");
                                    table_product_category.innerHTML = data.product_category;

                            const table_product_current_price = document.createElement("td");
                                    table_product_current_price.innerHTML = data.product_curr_price;

                            const table_product_previous_price = document.createElement("td");
                                    table_product_previous_price.innerHTML = data.product_prev_price;

                            const table_product_visibility = document.createElement("td");
                                    table_product_visibility.innerHTML = data.product_visibility;

                            const table_product_number_of_orders = document.createElement("td");
                                    table_product_number_of_orders.innerHTML = data.product_number_of_orders;

                            const table_categroy_link = document.createElement("td");
                                    const table_categroy_link_tag = document.createElement("a");
                                                table_categroy_link_tag.setAttribute("href", "product-details.php?product-id=" + data.product_id ) 
                                                table_categroy_link_tag.innerHTML = "product-details.php?product-id=" + data.product_id;

                                table_categroy_link.appendChild( table_categroy_link_tag );

                            const table_categroy_image = document.createElement("td");
                                    const table_categroy_image_tag = document.createElement("img");
                                                table_categroy_image_tag.setAttribute("src", data.product_hero_img ) 
                                                table_categroy_image_tag.setAttribute("class", "product-preview" ) 
                                                // table_categroy_image_tag.innerHTML = "product-details.php?product-id=" + data.product_id;

                            table_categroy_image.appendChild( table_categroy_image_tag );


                            const table_actions = document.createElement("td");

                                    const table_actions_action_container = document.createElement("div");
                                            table_actions_action_container.setAttribute("class", "btn-group");

                                                const edit_link = document.createElement("a");
                                                        edit_link.setAttribute("href", "edit-product.php?product-id=" + data.product_id);

                                                        const edit_link_btn = document.createElement("button");
                                                            
                                                                edit_link_btn.setAttribute("class", "btn btn-primary");
                                                                edit_link_btn.innerHTML = '<i class="fas fa-pen"></i>';

                                                        edit_link.appendChild(edit_link_btn);

                                                const category_delete_form = document.createElement("form");
                                                        category_delete_form.setAttribute("action", "<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>");
                                                        category_delete_form.setAttribute("method", "POST");

                                                            const category_delete_form_input = document.createElement("input");
                                                                    category_delete_form_input.setAttribute("type", "hidden");
                                                                    category_delete_form_input.setAttribute("name", "delete-id");
                                                                    category_delete_form_input.setAttribute("value", data.product_id);

                                                            const category_delete_form_button = document.createElement("button");
                                                                    category_delete_form_button.setAttribute( "class", "btn btn-danger");
                                                                    category_delete_form_button.innerHTML = '<i class="fa fa-delete-left"></i>';


                                                category_delete_form.appendChild(category_delete_form_input);
                                                category_delete_form.appendChild(category_delete_form_button);

                                    table_actions_action_container.appendChild(edit_link);
                                    table_actions_action_container.appendChild(category_delete_form);

                            table_actions.appendChild(table_actions_action_container);

                        dataRow.appendChild(table_categroy_id);
                        dataRow.appendChild(table_product_name);
                        dataRow.appendChild(table_product_id);
                        dataRow.appendChild(table_categroy_link);
                        dataRow.appendChild(table_product_category);
                        dataRow.appendChild(table_categroy_image);
                        dataRow.appendChild(table_product_current_price);
                        dataRow.appendChild(table_product_previous_price);
                        dataRow.appendChild(table_product_number_of_orders);
                        dataRow.appendChild(table_product_visibility);
                        dataRow.appendChild(table_actions);

                        console.log(dataRow);

                        const table = document.querySelector(".table");

                        const tableBody = table.querySelector("tbody");

                        numberOfrecords += 1;

                        document.getElementById("numberOfRecordsShown").innerHTML = numberOfrecords;

                        tableBody.appendChild(dataRow);


                    } );

                }

            }

        })
        .catch( (error) => 
        {

            console.error("Error:", error);
            Rstatus = false;
            
        }  );

    });

}

</script>