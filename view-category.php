<?php include_once __DIR__ . "/assets/php/app.php" ?>
<?php 
define("PARENT_DIR", __DIR__);

if ( !chechkIfLoggedIn() )
{
    header("location: login.php?returnUrl=" . htmlspecialchars($_SERVER['PHP_SELF']) );
}

$userDetails = getUserDetailsUsingUsername($dbConn, $_SESSION["SSID-USERNAME"] );

if ( $userDetails['user_role'] != 'super-admin' && $userDetails['user_role'] != 'product-manager'  )
{
    load404Page();
    exit;
}

?>
<?php



if( $_SERVER["REQUEST_METHOD"] === "GET" )
{
   $categories = getAllCategories($dbConn, 0);

   if ( isset( $_GET["offset"] ) && isset( $_GET["SSID"] ) && !empty( $_GET["offset"] ) && !empty( $_GET["SSID"] ) )
   {
        if ( !hash_equals( $_SESSION["SSID"],  $_GET["SSID"] )  )
        {
            http_response_code(404);
            exit;
        }

        $offset = intval( $_GET["offset"] );
        $categories = getAllCategories($dbConn, $offset);


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

    $checkIfRecordExist = chechkIfValueExist($dbConn, 'table_categories', "category_slug", $deleteId);

    if ( $checkIfRecordExist != 1 )
    {
        exit;
    }

    if ( deleteCategoryDetailInDB($dbConn, "table_categories", $deleteId) )
    {
        header("Location:" . htmlspecialchars($_SERVER['PHP_SELF']) . "?respCode=200&msg=success");
    }
    else
    {
        header("Location:" . htmlspecialchars($_SERVER['PHP_SELF']) . "?respCode=400&msg=error");
    }


}

?>

<?php require_once 'assets/pages/admin/head.php' ?>

    <title> View Categories - <?php echo $site_titile ?></title>
</head>
<body>
    
    <div class="container-fluid">

        <?php require_once 'assets/pages/admin/navigation.php' ?>


        <div class="contents container-fluid">

            <?php require_once 'assets/pages/admin/sidebar.php' ?>


            <?php require_once 'assets/pages/view-category.php' ?>


        </div>

    </div>

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


                        let datas = data.response;

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

                                    const table_categroy_name = document.createElement("td");
                                            table_categroy_name.innerHTML = data.category_name;

                                    const table_categroy_slug = document.createElement("td");
                                            table_categroy_slug.innerHTML = data.category_slug;

                                    const table_categroy_link = document.createElement("td");
                                            const table_categroy_link_tag = document.createElement("a");
                                                        table_categroy_link_tag.setAttribute("href", "category.php?category-slug=" + data.category_slug ) 
                                                        table_categroy_link_tag.innerHTML = "category.php?category-slug=" + data.category_slug;

                                        table_categroy_link.appendChild( table_categroy_link_tag );


                                    const table_actions = document.createElement("td");

                                            const table_actions_action_container = document.createElement("div");
                                                    table_actions_action_container.setAttribute("class", "btn-group");

                                                        const edit_link = document.createElement("a");
                                                                edit_link.setAttribute("href", "edit-category.php?category-slug=" + data.category_slug);

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
                                                                            category_delete_form_input.setAttribute("value", data.category_slug);

                                                                    const category_delete_form_button = document.createElement("button");
                                                                            category_delete_form_button.setAttribute( "class", "btn btn-danger");
                                                                            category_delete_form_button.innerHTML = '<i class="fa fa-delete-left"></i>';


                                                        category_delete_form.appendChild(category_delete_form_input);
                                                        category_delete_form.appendChild(category_delete_form_button);

                                            table_actions_action_container.appendChild(edit_link);
                                            table_actions_action_container.appendChild(category_delete_form);

                                    table_actions.appendChild(table_actions_action_container);

                                dataRow.appendChild(table_categroy_id);
                                dataRow.appendChild(table_categroy_name);
                                dataRow.appendChild(table_categroy_slug);
                                dataRow.appendChild(table_categroy_link);
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

</body>