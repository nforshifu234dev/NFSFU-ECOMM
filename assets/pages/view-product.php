<?php

if( $userDetails["user_role"] === 'user' || $userDetails["user_role"] === 'admin' )
{
    
    foreach( $products as $key => $product )
    {

        if ( intval($product["product_visibility"]) !=  1 )
        {
            
            unset( $products[$key] );

        }

    }

}

?>

<div class="page-contents">

<section class="product-category">

    <div class="heading">
        
        <div class="details">
            <h2> <span><i class="fa fa-box"></i></span> View Products </h2>
        </div>

        <span>Showing Products from 1 - <span id="numberOfRecordsShown"><?php echo count($products) ;?></span> </span>


    </div>

    <div class="view-products-table table-responsive mt-5">

        <table class="table table-dark table-striped table-bordered table-hover table-sm">

            <p class="text-muted mb-2">*** Products List ***</p>

            
            <?php if ( count($products) != 0 ): ?>

            <thead >

                <tr class="text-center">

                    <th scope="col" >#</th>
                    <th scope="col" >Product Name</th>
                    <th scope="col" >Product ID</th>
                    <th scope="col" >Product URL</th>
                    <th scope="col" >Product Category</th>
                    <th scope="col" >Product Image</th>
                    <th scope="col" >Product Curr Price ($)</th>
                    <th scope="col" >Product Old Price ($)</th>
                    <th scope="col" >Product Number Of Orders</th>
                    <th scope="col" >Product Visibility</th>
                    <?php if( $userDetails["user_role"] === 'super-admin' || $userDetails['user_role'] === 'product-manager' ): ?>
                    <th scope="col" >Product Action</th>
                    <?php endif; ?>
                </tr>

            </thead>

            <tbody>

                <?php 

                
                    foreach( $products as $key => $product ):

                        $product_name = $product["product_name"];
                        $product_id= $product["product_id"];
                        $product_category = $product["product_category"];
                        $product_current_price = $product["product_curr_price"];
                        $product_previous_price = $product["product_prev_price"];
                        $product_number_of_orders = $product["product_number_of_orders"];
                        $product_visibility = $product["product_visibility"];

                        $product_images = $product["product_img"];
                        $product_images = explode(",", $product_images);
                        $product_images = $product_images[0];

                ?>

                    <tr>

                        <th scope="row" ><?php echo $key + 1; ?></th>
                        <td><?php echo $product_name ?></td>
                        <td><?php echo $product_id ?></td>
                        <td> <a href="<?php echo "product-details-page.php?product-id=". $product_id ?>" target="_blank" > <?php echo "product-details-page.php?product-id=". $product_id ?> </a> </td>
                        <td><?php echo $product_category; ?></td>
                        <td class="product-preview">
                            <img src="<?php echo "$product_images" ?>" alt="">
                        </td>
                        <td><?php echo $product_current_price ?></td>
                        <td><?php echo $product_previous_price ?></td>
                        <td><?php echo $product_number_of_orders ?></td>
                        <td><?php echo $product_visibility ?></td>
                        <?php if( $userDetails["user_role"] === 'super-admin' || $userDetails['user_role'] === 'product-manager' ): ?>
                        <td>

                            <div class="btn-group">

                                <a href="edit-product.php?product-id=<?php echo $product_id ?>"><button class="btn btn-primary" ><i class="fas fa-pen"></i></button></a>
                                
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                    <input type="hidden" name="delete-id" value="<?php echo $product_id ?>" >
                                    <button name="deleteProduct" class="btn btn-danger" ><i class="fa fa-delete-left"></i></button>
                                </form>

                            </div>

                        </td>
                        <?php endif; ?>

                    </tr>

                <?php 
                    endforeach; 
                ?>
        

            </tbody>

            <?php 
                else:
            ?>

                <h1 class="bg-info text-white p-3" >THERE ARE NO PRODUCTS YET AVAILABLE</h1>

            <?php endif; ?>

            <tfoot>
                <caption>*** Products List ***</caption>
            </tfoot>

        </table>

        <div class="loadMoreButton text-center">
            <button class="btn btn-primary" >Load More Products</button>
        </div>

    </div>
    

</section>


</div>