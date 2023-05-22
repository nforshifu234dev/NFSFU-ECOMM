<div class="page-contents">

    

    <section class="product-category">

        <div class="heading">
            
            <div class="details">
                <h2> <span><i class="fa fa-box"></i> <?php echo $categoryName ?></span> Category</h2>
            </div>

        </div>


<?php $number_of_products = count($products); if ( $number_of_products != 0 ): ?>
    
        <div class="products-container row row-cols-1 cols-4 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 row-cols-xxl-5">

            <?php  foreach ($products as $key => $product): 
                $product_name = $product["product_name"];
                $product_slug = $product["product_slug"];
                $product_id = $product["product_id"];
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
                        <?php echo $product_name; ?>
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

        <?php else: ?>
            <div class="page-contents">
                <center>
                    <h1>There are no products under this category yet.</h1>
                </center>
            </div>

        <?php endif; ?>

    </section>
                


</div>

