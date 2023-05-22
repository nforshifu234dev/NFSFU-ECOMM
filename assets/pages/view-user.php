
<?php

if( $userDetails["user_role"] === 'admin' )
{

    foreach( $products as $key => $product )
    {

        $user_role = $product["user_role"];

        if ( $user_role === 'super-admin' )
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
            <h2> <span><i class="fa fa-user-group"></i></span> View Users </h2>
        </div>

        <span>Showing Users from 1 - <span id="numberOfRecordsShown"><?php echo count($products) ;?></span> </span>


    </div>

    <div class="view-products-table table-responsive mt-5">

        <table class="table table-dark table-striped table-bordered table-hover table-sm">

            <p class="text-muted mb-2">*** Users List ***</p>

            <thead >

                <tr class="text-center">

                    <th scope="col" >#</th>
                    <th scope="col" >User Name</th>
                    <th scope="col" >User ID</th>
                    <th scope="col" >User Username</th>
                    <th scope="col" >User Email</th>
                    <th scope="col" >User Role</th>
                    <?php if( $userDetails["user_role"] === 'super-admin' || $userDetails["user_role"] === 'admin' ): ?>
                    <th scope="col" >User Number Of Orders</th>
                    <th scope="col" >User Action</th>
                    <?php endif; ?>
                </tr>

            </thead>

            <tbody>

                <?php 
                        $i = 0;
                
                    foreach( $products as $key => $product ):
                        $user_name = $product["user_name"];
                        $user_id= $product["user_id"];
                        $user_username= $product["user_username"];
                        $user_email = $product["user_email"];
                        $user_role = $product["user_role"];
                        $user_number_of_orders = $product["user_number_of_orders"];


                ?>

                        <tr>

                            <!-- <th scope="row" ><?php// echo $x = ( $userDetails["user_role"] === 'admin' ) ? $key + 1 : $key + 1 ; ?></th> -->
                            <th scope="row" ><?php echo $i += 1 ; ?></th>
                            <td><?php echo $user_name ?></td>
                            <td><?php echo $user_id ?></td>
                            <td><?php echo $user_username ?></td>
                            <td >
                                <?php echo $user_email ?>
                            </td>
                            <td><?php echo $user_role ?></td>
                            <?php if( $userDetails["user_role"] === 'super-admin' || $userDetails["user_role"] === 'admin' ): ?>
                                <td><?php echo $user_number_of_orders ?></td>


                                    <td>

                                        <?php if( $user_username != $_SESSION["SSID-USERNAME"]  ): ?>

                                            <?php if( $user_username != "NFSFU-SA" ): ?>

                                                <div class="btn-group">

                                                    <a href="profile-edit.php?user-id=<?php echo $user_id ?>"><button class="btn btn-primary" ><i class="fas fa-pen"></i></button></a>
                                                    
                                                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                                        <input type="hidden" name="delete-id" value="<?php echo $user_id ?>" >
                                                        <button name="deleteProduct" class="btn btn-danger" ><i class="fa fa-delete-left"></i></button>
                                                    </form>

                                                </div>
                                            <?php else: ?>
                                                ---
                                            <?php endif; ?>

                                        <?php else: ?>
                                            ---
                                        <?php endif; ?>

                                    </td>
                                    

                            <?php endif; ?>
                        </tr>


                <?php endforeach; ?>
        

            </tbody>

            <tfoot>
                <caption>*** Users List ***</caption>
            </tfoot>

        </table>

        <div class="loadMoreButton text-center">
            <button class="btn btn-primary" >Load More Users</button>
        </div>

    </div>
    

</section>


</div>