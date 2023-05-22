<?php include_once __DIR__ . "/assets/php/app.php" ?>

<?php
    chechkSiteVisibilityStatusAndRedirect($dbConn);

chechkNumberOfProductsANdCategoriesAndDisplayMessage( $dbConn );

if ( chechkIfLoggedIn() )
{
    $userDetails = getUserDetailsUsingUsername($dbConn, $_SESSION["SSID-USERNAME"] );
}


$total_number_of_products = count(getAllProducts($dbConn));
$total_number_of_categories = count(getAllCategories($dbConn));


?>

<?php

if( $_SERVER["REQUEST_METHOD"] === "GET" )
{

   if ( isset( $_GET["offset"] ) && !empty( $_GET["offset"] ) )
    {
        

        $offset = intval( $_GET["offset"] );
        $products = getAllVisibleProductsUsingLimits($dbConn, $offset); 

        $result = array(
            "status" => 200,
            "response" => $products
        );

        echo json_encode($result);
        exit;

    }

}

?>

<?php require_once 'assets/pages/head.php' ?>

    <title><?php echo $site_titile ?> - Home</title>
</head>
<body>
    
    <div class="container-fluid">

        <?php require_once 'assets/pages/navigation.php' ?>

            <div class="contents container">

                <?php require_once 'assets/pages/sidebar.php' ?>


                
                <?php require_once 'assets/pages/products-display-shop.php' ?>

                

            </div>

    </div>

<script>

var numberOfrecords = parseInt( document.getElementById("numberOfRecordsShown").innerHTML );

if ( numberOfrecords < 50)
{
    document.querySelector(".loadMoreButton").classList.add("display-none");
}
else
{




    document.querySelector(".loadMoreButton").addEventListener("click", ()=>
    {

        const btn = document.querySelector(".loadMoreButton");
        const Bbutton = btn.querySelector("button");

        Bbutton.querySelector(".icon").classList.add("spin");

        const url = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>?offset=" + numberOfrecords ;

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

            if ( status === 200 )
            {

                let datas = data.response;

                if ( datas.length === 0 )
                {
                    document.querySelector(".loadMoreButton").innerHTML = "<h1>You Have Reached the end of all categories in the Database</h1>";
                }
                else
                {

                    datas.forEach( ( data )=>{

                        const productCard = document.createElement("div");
                                productCard.classList.add("product-card");
                                productCard.classList.add("card");
                                productCard.classList.add("col");

                                const productImageContainer = document.createElement("div");
                                        productImageContainer.classList.add("product-image");

                                            const productImageContainerImage = document.createElement("img");
                                                    productImageContainerImage.setAttribute("src", data.product_hero_img );
                                                    productImageContainerImage.classList.add("card");

                                productImageContainer.appendChild( productImageContainerImage );

                                            const productCardOverlayContainer = document.createElement("div");
                                                    productCardOverlayContainer.classList.add("overlay-container");

                                                        const productCardOverlay = document.createElement("div");
                                                                productCardOverlay.classList.add("overlay");

                                                                    const productViewLink = document.createElement("a");
                                                                            productViewLink.setAttribute("class", "icon view-product");
                                                                            productViewLink.setAttribute("href", "product-details-page.php?product-id=" + data.product_id);
                                                                            productViewLink.innerHTML = '<i class="fas fa-eye"></i>';

                                                                    const productShareIcon = document.createElement("div");
                                                                            productShareIcon.setAttribute("class", "icon view-product");
                                                                            productShareIcon.innerHTML = '<i class="fas fa-share-alt"></i>';
                                                        productCardOverlay.appendChild(productViewLink);
                                                        productCardOverlay.appendChild(productShareIcon);
                                        
                                            productCardOverlayContainer.appendChild(productCardOverlay);

                                productImageContainer.appendChild(productCardOverlayContainer);

                                    // productImageContainer.appendChild();
                                                                            
                                const productName = document.createElement("a");
                                        productName.setAttribute("href", "product-details-page.php?product-id=" + data.product_id );
                                        productName.setAttribute("src", "product-name card-title");
                                        productName.innerHTML = '<i class="fas fa-shopping-basket"  style="font-size: calc(100% - 0.35rem);"></i>' + data.product_name ;

                    


                                const productCategory = document.createElement("a");
                                        productCategory.setAttribute("href", "category.php?category-slug=" + data.product_category );
                                        productCategory.setAttribute("src", "product-name card-title");
                                        productCategory.innerHTML = '<i class="fas fa-tags"  style="font-size: calc(100% - 0.35rem);"></i>' + data.product_category ;

                                const productPriceContainer = document.createElement("div");
                                        productPriceContainer.setAttribute("class", "product-price card-text");

                                            const currPrice = document.createElement("span");
                                                    currPrice.innerHTML = data.product_curr_price;
                                                    currPrice.setAttribute("class", "curr-price");

                                            const prevPrice = document.createElement("span");
                                                    prevPrice.innerHTML = data.product_prev_price;
                                                    prevPrice.setAttribute("class", "prev-price");

                                        if ( parseInt( data.product_prev_price ) === 0 )
                                        {
                                            productPriceContainer.appendChild(currPrice);
                                        }
                                        else
                                        {
                                            productPriceContainer.appendChild(currPrice);
                                            productPriceContainer.appendChild(prevPrice);
                                        }

                                const addToCartButtonCont = document.createElement("div");
                                        addToCartButtonCont.setAttribute("class", "product-btn");

                                            addToCartButtonContBtn = document.createElement("button");
                                                addToCartButtonContBtn.setAttribute("class", "btn btn-danger" );
                                                addToCartButtonContBtn.innerHTML = '<i class="fas fa-shopping-cart"></i> Add to cart';

                                        addToCartButtonCont.appendChild(addToCartButtonContBtn);

                        productCard.append(productImageContainer);                  
                        productCard.append(productName);                  
                        productCard.append(productCategory);                  
                        productCard.append(productPriceContainer);                  
                        productCard.append(addToCartButtonCont);                  
                        // productCard.append();                  

                        console.log(productCard);

                        numberOfrecords += 1;

                        document.getElementById("numberOfRecordsShown").innerHTML = numberOfrecords;


                        document.querySelector(".products-container").appendChild(productCard);

                        Bbutton.querySelector(".icon").classList.remove("spin");
                    
                    } );

                }

            }

        })
        .catch( (err)=>{
            console.error(err);
        } ) ;


    });

}

</script>

    <?php require_once 'assets/pages/footer.php' ?>