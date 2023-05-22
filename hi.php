<?php

    require_once __DIR__ . "/assets/php/config.php";
    require_once __DIR__ . "/assets/php/functions/functions.php";

    // var_dump($dbConn);

    chechkSiteVisibilityStatusAndRedirect($dbConn);

    // Getting All the products that are made public
    // $products = getAllVisibleProductsUsingLimits($dbConn);
    $products = getAllVisibleProductsUsingCategoryQueryUsingLimits($dbConn, "t-shirt");

    $categories = getAllCategories($dbConn);

    echo "<pre>";
    var_dump( $categories );
    echo "</pre>";

    foreach ($categories as $key => $category) 
    {
        
        // echo "<pre>";
        // var_dump( $product );
        // echo "</pre>";


        $category_name = $category["category_name"];
        $category_slug = $category["category_slug"];
    
        $products = getAllVisibleProductsUsingCategoryQueryUsingLimits($dbConn, $category_slug);


        echo "<pre>";
        var_dump( $products );
        echo "</pre>";

        echo "<br>";
        echo "<br>";
        echo "<br>";
            

        
        
    }

    foreach ($products as $key => $product) 
    {
        
        // echo "<pre>";
        // var_dump( $product );
        // echo "</pre>";

        $product_name = $product["product_name"];
        $product_slug = $product["product_slug"];
        $product_id = $product["product_id"];
        $product_current_price = $product["product_curr_price"];
        $product_previous_price = $product["product_prev_price"];
        $product_images = $product["product_img"];

        $product_images = explode( ",", $product_images );

        // foreach ($product_images as $key => $product_image) 
        // {

        //     echo $product_image;

        // }


        
        
    }
    

?>