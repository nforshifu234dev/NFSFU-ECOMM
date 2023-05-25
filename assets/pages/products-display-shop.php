<div class="page-contents">



    
        <?php  
    $products = getAllVisibleProductsUsingLimits($dbConn, 0, 12); 
            
            $number_of_products = count($products);
            if ( $number_of_products != 0 ):
                
        ?>

            <section class="product-category">

                <div class="heading">
                    
                    <div class="details">
                        <h2> '<span><i class="fa fa-shop"></i> <?php echo $site_titile ?> </span>' Shop </h2>
                    </div>

                    <span>Showing Products from 1 - <span id="numberOfRecordsShown"><?php echo count($products) ;?></span> </span>


                </div>






                    <div class="products-container row row-cols-1 cols-4 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 row-cols-xxl-3">

                        <?php 
                            foreach ($products as $key => $product) :

                                $product_name = $product["product_name"];
                                $product_slug = $product["product_slug"];
                                $product_id = $product["product_id"];
                                $product_category= $product["product_category"];
                                $product_current_price = $product["product_curr_price"];
                                $product_previous_price = $product["product_prev_price"];
                                $product_images = $product["product_img"];
                        
                                $product_images = explode( ",", $product_images );

                        ?>

                            <div class="product-card card col">

                                <div class="product-image ">
                                    <!-- listen if the image link response is 200 else display default product image -->

                                    <img class="card" src="<?php echo $product_images[0] ?>" alt="">

                                    <div class="overlay-container">

                                        <div class="overlay">

                                            <a href="product-details-page.php?product-id=<?php echo $product_id; ?>" class="icon view-product">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <div class="icon share-product">
                                                <i class="fas fa-share"></i>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <a href="product-details-page.php?product-id=<?php echo $product_id; ?>" class="product-name card-title">
                                    <i class="fas fa-shopping-basket" style="font-size: calc(100% - 0.35rem);" ></i> <?php echo $product_name; ?>
                                </a>

                                <a href="category.php?category-slug=<?php echo $product_category; ?>" class="product-name card-title">
                                    <i class="fas fa-tags"  style="font-size: calc(100% - 0.35rem);"></i> <?php echo $product_category; ?>
                                </a>

                                <div class="product-price card-text">

                                    <span class="curr-price" > <?php echo CURRENCY_SYMBOL . $product_current_price; ?></span> 

                                    <?php if ( floatval($product_previous_price) != 0.0 ): ?>
                                        
                                        <span class="prev-price"><?php echo CURRENCY_SYMBOL . $product_previous_price; ?></span>
                                    <?php endif; ?>

                                </div>

                                <div class="product-btn">
                                    <button class="btn btn-danger" > <i class="fas fa-shopping-cart"></i> Add to cart </button>
                                </div>

                            </div>

                        <?php endforeach; ?>


                    </div>



                    

            </section>

            <div class="loadMoreButton text-center mt-5">
                <button class="btn btn-primary btn-lg" > <i class="fas fa-recycle icon"></i> Load Products</button>
            </div>

        <?php else: ?>
        
            <?php 
            loadNoProductsMessage(  $dbConn );
        ?>
        

        <?php endif; ?> 


        

</div>

