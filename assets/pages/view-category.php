<div class="page-contents">

<section class="product-category">

    <div class="heading">
                        
        <div class="details">
            <h2> <span><i class="fa fa-tags"></i></span> View Categories </h2>
        </div>

        <span>Showing Categories from 1 - <span id="numberOfRecordsShown"><?php echo count($categories) ;?></span> </span>


    </div>

    <div class="view-products-table table-responsive mt-5">

        <table class="table table-dark table-striped table-bordered table-hover table-sm">

            <p class="text-muted mb-2">*** Categories List ***</p>

            <thead >

                <tr class="text-center">

                    <th scope="col" >#</th>
                    <th scope="col" >Category Name</th>
                    <th scope="col" >Category Slug</th>
                    <th scope="col" >Category Link</th>
                        <?php if( $userDetails["user_role"] === 'super-admin' ): ?>
                    <th scope="col" >Category Action</th>
                    <?php endif; ?>

                </tr>

            </thead>

            <tbody>

                <?php 
                
                    foreach( $categories as $key => $category ):

                        $category_name = $category["category_name"];
                        $category_slug= $category["category_slug"];


                ?>

                    <tr>

                        <th scope="row" ><?php echo $key + 1; ?></th>
                        <td><?php echo $category_name ?></td>
                        <td><?php echo $category_slug ?></td>
                        <td > <a href="category.php?category-slug=<?php echo $category_slug; ?>" target="_blank" > category.php?category-slug=<?php echo $category_slug; ?> </a> </td>
                        <?php if( $userDetails["user_role"] === 'super-admin' ): ?>
                        <td>

                            <div class="btn-group">

                                <a href="edit-category.php?category-slug=<?php echo $category_slug ?>"><button class="btn btn-primary" ><i class="fas fa-pen"></i></button></a>
                                
                                <form method="post" action="#">
                                    <input type="hidden" name="delete-id" value="<?php echo $category_slug ?>" >
                                    <button class="btn btn-danger" ><i class="fa fa-delete-left"></i></button>
                                </form>

                            </div>

                        </td>
                        <?php endif; ?>

                    </tr>

                <?php endforeach; ?>
        

            </tbody>

            <tfoot>
                    <caption>*** Categories List ***</caption>
            </tfoot>

        </table>

        <div class="loadMoreButton text-center">
            <button class="btn btn-primary" >Load More Categories</button>
        </div>

    </div>
    

</section>


</div>