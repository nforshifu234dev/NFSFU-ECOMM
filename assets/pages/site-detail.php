<div class="page-contents">

<section class="product-category">

    <div class="heading">
        
        <div class="details">
            <h2> <span><i class="fa fa-file-medical"></i></span> SITE INFORMATION </h2>
        </div>



    </div>

    <div class="view-products-table table-responsive mt-5">

        <table class="table table-dark table-striped table-bordered table-hover table-sm">

            <p class="text-muted mb-2">*** SITE INFORMATION ***</p>

            <thead >

                <tr class="text-center">

                    <th scope="col" >#</th>
                    <th scope="col" >SITE INFORMATION TITLE</th>
                    <th scope="col" >SITE INFORMATION VALUE</th>
                    <th scope="col" >User Action</th>

                </tr>

            </thead>

            <tbody>

                <tr>
                    <td></td>
                    <td class="text-center">DATABASE NAME</td>
                    <td class="text-center"><?php echo DB_NAME ?></td>
                    <td></td>

                </tr>

                <tr>
                    <td></td>
                    <td class="text-center">Currency </td>
                    <td class="text-center"><?php echo CURRENCY_SYMBOL  ?></td>
                    <td></td>

                </tr>


                <?php 
                
                    foreach( $siteDetails as $key => $siteDetail ):

                ?>

                    <tr >

                        <td class="text-center"> <?php echo $key + 1 ?> </td>
                        <td class="text-center"> <?php echo $siteDetail["site_details_detail_info"] ?>  </td>
                        <td class="text-center"> <?php echo $siteDetail["site_details_detail_info_value"] ?></td>
                        <?php if ( hash_equals( "SITE_BASE_URL", $siteDetail["site_details_detail_info"] ) || $key === 3 || $key === 4 ): ?>
                            <td class="text-center">
                                <div class="btn-group">

                                <a href="site-detail-edit.php"><button class="btn btn-primary" ><i class="fas fa-pen"></i></button></a>

                                </div>

                            </td>
                        <?php else: ?>
                            <td class="text-mute" >NULL</td>
                        <?php endif; ?>
                    </tr>

                <?php ?>
                <?php endforeach; ?>
                            

            </tbody>

            <tfoot>
                <caption>*** SITE INFORMATION ***</caption>
            </tfoot>

        </table>

    </div>
    

</section>


</div>