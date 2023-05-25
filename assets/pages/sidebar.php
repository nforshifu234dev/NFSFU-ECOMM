<div class="categories">
<?php 



?>
<?php 
if ( chechkSiteVisibilityStatus($dbConn) === 1 ):

$catys = getCategoriesRandomly($dbConn, 4); 

if ( count( $catys ) != 0 ) :


?>
    
    <section class="category">

        <div class="heading">
            <h2>Categories</h2>
            <hr>
        </div>

        <?php 
            
        
            foreach( $catys as $caty ): 

                
        ?>

            <a href="category.php?category-slug=<?php echo $caty["category_slug"] ?>" class="category-item">
                <span class="mx-2"><i class="fas fa-tag"></i></span>
                <span><?php echo $caty["category_slug"] ?></span>
            </a>

        <?php endforeach; ?>

    </section>

<?php endif; endif; ?>


    <?php 
    if ( chechkSiteVisibilityStatus($dbConn) === 1 ):
        $prdcts = getProductsRandomly($dbConn, 6); 
        if ( count( $prdcts ) != 0 ) :
    
    ?>

    <section class="category">

        <div class="heading">

            <h2>Products</h2>
            <hr>

        </div>

        <?php  foreach( $prdcts as $prdct ): 
        

            $prdct_name = $prdct["product_name"];
            $prdct_id = $prdct["product_id"];
            $prdct_slug = $prdct["product_slug"];
            $prdct_category = $prdct["product_category"];
            $prdct_short_description = $prdct["short_description"];
            $prdct_current_price = $prdct["product_curr_price"];
            $prdct_previous_price = $prdct["product_prev_price"];
            $prdct_long_description = $prdct["long_description"];

            $prdct_images = $prdct["product_img"];

            $prdct_images = explode(",", $prdct_images);
        
        ?>

            <!-- <a href="#" class="w-100 d-block" > -->

                <div class="pdct-card">

                    <div class="image">
                        <img src="<?php echo $prdct_images[0] ?>"  alt="">
                    </div>

                    <div class="details">

                        <a href="product-details-page.php?product-id=<?php echo $prdct_id; ?>" class="prdct-dtil prdct-nme"><?php echo $prdct_name ?></a>
                        <a href="category.php?category-slug=<?php echo $prdct_category; ?>" class="prdct-dtil prdct-tag"> <i class="fas fa-tag"></i> <?php echo $prdct_category ?></a>

                        <a href="product-details-page.php?product-id=<?php echo $prdct_id; ?>" class="btn btn-failure"> <i class="fas fa-eye"></i> View Product</a>

                    </div>

                </div>

            <!-- </a> -->

        <?php endforeach; ?>

    </section>

    <?php endif; endif; ?>

    

</div>