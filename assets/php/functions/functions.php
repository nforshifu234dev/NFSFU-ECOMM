<?php



    function chechkIfDataBaseExists(PDO $conn, string $dbName):bool
    {
        
        $chechkIfDBExistQuery = $conn->query( " SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA  WHERE SCHEMA_NAME = '$dbName' " );
        return $chechkIfDBExistQuery->fetchColumn();

    }  

function chechkSiteVisibilityStatus( PDO $dbConn )
{
    

    $query = "SELECT * FROM table_site_details WHERE site_details_detail_info = :bind";

    $stmt = $dbConn->prepare($query);
    $bind = "SITE_VISIBILITY";

    $stmt->bindParam(":bind", $bind );

    if ( !$stmt->execute() )
    {

        $status = false;

    }
    else
    {
        $r = $stmt->fetch();

        $status = $r["site_details_detail_info_value"];
        $status = intval($status);


        return $status;


    }

}

function chechkSiteVisibilityStatusAndRedirect($dbConn)
{

    if ( chechkSiteVisibilityStatus($dbConn) === 0 )
    {

        header("Location: offline.php");

    }
    else if ( chechkSiteVisibilityStatus($dbConn) === 2 )
    {

        header("Location: maintainance.php");

    }
    else if ( chechkSiteVisibilityStatus($dbConn) === 3 )
    {

        header("Location: coming-soon.php");

    }
    else if ( chechkSiteVisibilityStatus($dbConn) != 1 )
    {

    }

}


function getSiteName(PDO $dbConn)
{
    $query = "SELECT `site_details_detail_info_value` FROM `table_site_details` WHERE `ID` = 1;";
    $stmt = $dbConn->prepare($query);
    
    $stmt->execute();

    $result = $stmt->fetch();

    return $result;
}

function chechkIfValueExist(PDO $dbConn,string $tableName, string $columnName, string|int $valueYouWantToSearch):bool
{

    $query = "SELECT * FROM `$tableName` WHERE `$columnName` = :columnName ";
    
    $stmt = $dbConn->prepare($query);
    $stmt->bindParam(":columnName", $valueYouWantToSearch);
    $stmt->execute();

    $result = $stmt->fetchAll();

    $num_result = count($result);

    $value = ($num_result > 0) ? true : false ;

    return $value;


}

function getUserDetailsUsingUsername(PDO $dbConn, string $username):bool | array 
{
    
    $query = "SELECT * FROM table_users WHERE user_username = :username OR user_email = :username OR user_id = :username  LIMIT 1";

    $stmt = $dbConn->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch();



    if ( $result === false )
    {
        
        if ( chechkIfLoggedIn() )
        {
            header("location: logout.php");
            exit;
            return false;
        }

    }

    return $result;


}

function getAllSiteInformation(PDO $dbConn):mixed
{

    $query = "SELECT * FROM table_site_details ORDER BY site_details_detail_info " ;


    $stmt = $dbConn->prepare($query);

    $stmt->execute();


    $products = $stmt->fetchAll();



    return $products;

}

function getAllUsers(PDO $dbConn, int $offsetValue = 0, int $number_of_items = 50  ):mixed
{

    $query = "SELECT * FROM table_users ORDER BY user_name LIMIT $number_of_items OFFSET $offsetValue" ;


    $stmt = $dbConn->prepare($query);

    $stmt->execute();


    $products = $stmt->fetchAll();



    return $products;

}

function getAllProducts(PDO $dbConn, int $offsetValue = 0, int $number_of_items = 50 ):mixed
{

    $query = "SELECT * FROM table_products ORDER BY product_name LIMIT $number_of_items OFFSET $offsetValue" ;


    $stmt = $dbConn->prepare($query);

    $stmt->execute();


    $products = $stmt->fetchAll();



    return $products;

}


function getAllCategories(PDO $dbConn, int $offsetValue = 0, int $number_of_items = 50):mixed
{

    $query = "SELECT * FROM table_categories ORDER BY category_name LIMIT $number_of_items OFFSET $offsetValue";


    $stmt = $dbConn->prepare($query);

    $stmt->execute();


    $products = $stmt->fetchAll();



    return $products;

}

function getCategoryDetails(PDO $dbConn, $queryItem)
{

    $query = "SELECT * FROM table_categories WHERE category_name = :query OR category_slug = :query LIMIT 1";

    $stmt = $dbConn->prepare($query);

    $stmt->bindParam(":query", $queryItem);

    $stmt->execute();



    $categoryDetails = $stmt->fetch();


    return $categoryDetails;

}

function getAllVisibleProductsUsingLimits(PDO $dbConn, int $offsetValue = 0, int $limitValue = 50):mixed
{


    $query= "SELECT product_name,product_slug,product_category,product_img,product_id,product_curr_price,product_prev_price,product_hero_img FROM table_products WHERE product_visibility = 1 ORDER BY product_name LIMIT $limitValue OFFSET $offsetValue";


    $stmt = $dbConn->prepare($query);


    $stmt->execute();



    $products = $stmt->fetchAll();


    return $products;

}

function getAllVisibleProductsUsingCategoryQueryUsingLimits(PDO $dbConn, string $category_name, int $offsetValue = 0, int $limitValue = 50):mixed
{


    $query= "SELECT product_name,product_slug,product_img,product_id,product_curr_price,product_prev_price,product_category FROM table_products WHERE product_visibility = 1 AND product_category = :product_category ORDER BY product_name LIMIT $limitValue OFFSET $offsetValue";


    $stmt = $dbConn->prepare($query);

    $stmt->bindParam(":product_category", $category_name);

    $stmt->execute();



    $products = $stmt->fetchAll();


    return $products;

}

function getAllVisibleProductsUsingCategoryQueryUsingLimitsRandom(PDO $dbConn, string $category_name, int $offsetValue = 0, int $limitValue = 50):mixed
{


    $query= "SELECT product_name,product_slug,product_img,product_id,product_curr_price,product_prev_price,product_category FROM table_products WHERE product_visibility = 1 AND product_category = :product_category ORDER BY RAND() LIMIT $limitValue OFFSET $offsetValue";


    $stmt = $dbConn->prepare($query);

    $stmt->bindParam(":product_category", $category_name);

    $stmt->execute();



    $products = $stmt->fetchAll();


    return $products;

}

function getAllHiddenProductsUsingLimits(PDO $dbConn, int $offsetValue = 0, int $limitValue = 50):mixed
{


    $query= "SELECT * FROM table_products WHERE product_visibility = 0 ORDER BY product_name LIMIT $limitValue OFFSET $offsetValue";

    $stmt = $dbConn->prepare($query);

    $stmt->execute();



    $products = $stmt->fetchAll();



    return $products;

}

function getProductsDetails(PDO $dbConn, string $identifier)
{

    $query = "SELECT * FROM table_products WHERE product_slug  = :identitifer OR product_id = :identitifer LIMIT 1";

    $stmt = $dbConn->prepare($query);

    $stmt->bindParam(":identitifer", $identifier );

    if ( !$stmt->execute() )
    {

        $status = false;

    }
    else
    {
        $r = $stmt->fetch();


        return $r;


    }

}

function getProductsRandomly( PDO $dbConn , int $number_of_items_to_display = 1, int $offsetValue = 0 )
{

    $query = "SELECT * FROM table_products WHERE product_visibility = 1 ORDER BY RAND() LIMIT $number_of_items_to_display offset $offsetValue";

    $stmt = $dbConn->prepare($query);


    $stmt->execute();

    $result= $stmt->fetchAll();

    return $result;

}

function getCategoriesRandomly( PDO $dbConn , int $number_of_items_to_display = 1, int $offsetValue = 0 )
{

    $query = "SELECT * FROM table_categories  ORDER BY RAND() LIMIT $number_of_items_to_display OFFSET $offsetValue";

    $stmt = $dbConn->prepare($query);


    $stmt->execute();

    $result= $stmt->fetchAll();

    return $result;

}

function generateRadmonStrings(string $prefix = '', string $suffix = '', int $amountOfChar = 40):string
{
    if ($amountOfChar === 0) {
        $amountOfChar = 40;
    }

    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTWXYZ0123456789";
    
    $generatedText = '';

    if ( !empty($prefix) )
    {
        $generatedText = $prefix . substr(str_shuffle($chars), 0, $amountOfChar);
    }
    else if ( !empty($suffix) )
    {
        $generatedText = substr(str_shuffle($chars), 0, $amountOfChar) . $suffix;
    }
    else
    {
        $generatedText = substr(str_shuffle($chars), 0, $amountOfChar);
    }

    return $generatedText;
}


function createNewProduct(PDO $dbConn, array $values)
{


    $product_name = $values["product_name"] ;
    $product_slug = $values["product_slug"] ;
    $product_category = $values["product_category"] ;
    $product_images = $values["product_images"];
    $product_id = $values["product_id"] ;
    $product_current_price = $values["product_current_price"] ;
    $product_short_description = $values["product_short_description"] ;
    $product_long_description = $values["product_long_description"] ;

    $product_hero_image = explode( ",", $product_images )[0];


    $query = "INSERT INTO table_products ( product_name, product_slug, product_category, product_hero_img, product_img, product_id, product_curr_price, short_description, long_description ) 
            VALUES ( :product_name, :product_slug, :product_category,:product_hero_img, :product_images, :product_id, :product_price, :product_short_description, :product_long_description )
    ";

    $stmt = $dbConn->prepare($query);
    $stmt->bindParam(":product_name", $product_name);
    $stmt->bindParam(":product_slug", $product_slug);
    $stmt->bindParam(":product_category", $product_category);
    $stmt->bindParam(":product_hero_img", $product_hero_image);
    $stmt->bindParam(":product_images", $product_images);
    $stmt->bindParam(":product_id", $product_id);
    $stmt->bindParam(":product_price", $product_current_price);
    $stmt->bindParam(":product_short_description", $product_short_description);
    $stmt->bindParam(":product_long_description", $product_long_description);


    if ( $stmt->execute() === true )
    {

        return true;

    }
    else
    {

        return false;

    }
    

}

function createNewCategory(PDO $dbConn, array $values)
{


    $category_name = $values["category_name"] ;
    $category_slug = $values["category_slug"] ;


    $query = "INSERT INTO table_categories ( category_name, category_slug) 
            VALUES ( :category_name, :category_slug  )
    ";

    $stmt = $dbConn->prepare($query);
    $stmt->bindParam(":category_name", $category_name);
    $stmt->bindParam(":category_slug", $category_slug);



    if ( $stmt->execute() === true )
    {

        return true;

    }
    else
    {

        return false;

    }
    

}

function createNewUser(PDO $dbConn, array $values)
{


    $user_name = $values["user_name"] ;
    $user_id = $values["user_id"] ;
    $user_username = $values["user_username"] ;
    $user_email = $values["user_email"] ;
    $user_password = $values["user_password"] ;
    $user_role = $values["user_role"] ;
    $user_number_of_orders = 0;


    $query = "INSERT INTO table_users ( user_name, user_username, user_id, user_email, user_password, user_role, user_number_of_orders) 
            VALUES ( :user_name, :user_username, :user_id, :user_email, :user_password, :user_role, :user_number_of_orders  )
    ";

    $stmt = $dbConn->prepare($query);
    $stmt->bindParam(":user_name", $user_name);
    $stmt->bindParam(":user_username", $user_username);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":user_email", $user_email);
    $stmt->bindParam(":user_password", $user_password);
    $stmt->bindParam(":user_role", $user_role);
    $stmt->bindParam(":user_number_of_orders", $user_number_of_orders);



    if ( $stmt->execute() === true )
    {

        return true;

    }
    else
    {

        return false;

    }
    

}

function updateProductDetailInDB(PDO $dbConn, string $tableName, string  $tableColumn, string|int $svgId, string $valueToBeUpdated)
{
    
    $valueToBeUpdated = trim($valueToBeUpdated);

    $query = "UPDATE $tableName SET $tableColumn = :value WHERE product_id = :img_id";
    $stmt = $dbConn->prepare($query);
    $stmt->bindParam(":value", $valueToBeUpdated);
    $stmt->bindParam(":img_id", $svgId);

    if ( $stmt->execute() === true )
    {

        return true;

    }
    else
    {

        return false;

    }
    

}

function updateCategoryDetailInDB(PDO $dbConn, string $tableName, string  $tableColumn, string|int $svgId, string $valueToBeUpdated)
{
    
    $valueToBeUpdated = trim($valueToBeUpdated);

    $query = "UPDATE $tableName SET $tableColumn = :value WHERE category_slug = :img_id";
    $stmt = $dbConn->prepare($query);
    $stmt->bindParam(":value", $valueToBeUpdated);
    $stmt->bindParam(":img_id", $svgId);

    if ( $stmt->execute() === true )
    {

        return true;

    }
    else
    {

        return false;

    }
    

}

function updateUsersDetailInDB(PDO $dbConn, string $tableName, string  $tableColumn, string|int $svgId, string $valueToBeUpdated)
{
    
    $valueToBeUpdated = trim($valueToBeUpdated);

    $query = "UPDATE $tableName SET $tableColumn = :value WHERE user_id = :img_id";
    $stmt = $dbConn->prepare($query);
    $stmt->bindParam(":value", $valueToBeUpdated);
    $stmt->bindParam(":img_id", $svgId);

    if ( $stmt->execute() === true )
    {

        return true;

    }
    else
    {

        return false;

    }
    

}

function updateSiteInformation( PDO $dbConn , string|int $valueToBeUpdated, int | string $valueToBeUpdatedId )
{

    $query = "UPDATE `table_site_details` SET `site_details_detail_info_value` = :info WHERE `table_site_details`.`ID` = :id";

    $stmt = $dbConn->prepare($query);

    $stmt->bindParam(":info", $valueToBeUpdated);
    $stmt->bindParam(":id", $valueToBeUpdatedId);

    if ( $stmt->execute() === true )
    {

        return true;

    }
    else
    {

        return false;

    }


} 

function updateSiteLastUpdatedTime( PDO $dbConn , string $valueToBeUpdated, int | string $valueToBeUpdatedId  = '')
{

    $query = "UPDATE `table_site_details` SET `site_details_detail_info_value` = :info WHERE `table_site_details`.`ID` = 5";

    $stmt = $dbConn->prepare($query);

    $stmt->bindParam(":info", $valueToBeUpdated);

    if ( $stmt->execute() === true )
    {

        return true;

    }
    else
    {

        return false;

    }


} 

function deleteProductDetailInDB(PDO $dbConn, string $tableName, string $valueToBedeleted)
{
    
    $valueToBedeleted = trim($valueToBedeleted);

    $query = "DELETE FROM $tableName WHERE product_id = :product_id";
    $stmt = $dbConn->prepare($query);
    $stmt->bindParam(":product_id", $valueToBedeleted);

    if ( $stmt->execute() === true )
    {

        return true;

    }
    else
    {

        return false;

    }
    

}

function deleteUserDetailInDB(PDO $dbConn, string $tableName, string $valueToBedeleted)
{
    
    $valueToBedeleted = trim($valueToBedeleted);

    $query = "DELETE FROM $tableName WHERE user_id = :product_id";
    $stmt = $dbConn->prepare($query);
    $stmt->bindParam(":product_id", $valueToBedeleted);

    if ( $stmt->execute() === true )
    {

        return true;

    }
    else
    {

        return false;

    }
    

}


function deleteCategoryDetailInDB(PDO $dbConn, string $tableName, string $valueToBedeleted)
{
    
    $valueToBedeleted = trim($valueToBedeleted);

    $query = "DELETE FROM $tableName WHERE category_slug = :category_id";
    $stmt = $dbConn->prepare($query);
    $stmt->bindParam(":category_id", $valueToBedeleted);

    if ( $stmt->execute() === true )
    {

        return true;

    }
    else
    {

        return false;

    }
    

}

function getAllProductsWithCategoryName(PDO $dbConn, string $categoryName)
{

    $query = "SELECT * FROM table_products WHERE product_visibility = 1 AND product_category = :product_category";
    $stmt = $dbConn->prepare($query);
    $stmt->bindParam(":product_category", $categoryName);

    if ( $stmt->execute() === true )
    {

        return $stmt->fetchAll() ;

    }
    else
    {

        return false;

    }

}


function searchProduct(PDO $dbConn, string $searchTerm, int $offsetValue = 0, int $limitValue = 50)
{

    $query = " SELECT * FROM table_products WHERE product_name LIKE '%$searchTerm%' OR product_category LIKE '%$searchTerm%' OR product_slug LIKE '%$searchTerm%'   ";

    $stmt = $dbConn->prepare($query) ;


    if ( $stmt->execute() === true )
    {

        $result = $stmt->fetchAll();


        return $result;

    }
    else
    {
        return false;
    }

}

function chechkIfLoggedIn()
{





        if ( 
            isset( $_SESSION["login-status"] ) 
            && isset( $_SESSION["SSID"] ) 
            && isset( $_SESSION["SSID-USERNAME"] ) 
            && !empty( $_SESSION["login-status"] ) 
            && !empty( $_SESSION["SSID"] ) 
            && !empty( $_SESSION["SSID-USERNAME"] ) 
        )
        {
    
            return true;
            
    
        }
        else
        {
            return false;
    
    
        }
    

    



}


function chechkNumberOfProductsANdCategoriesAndDisplayMessage( PDO $dbConn )
{

    $total_number_of_products = count(getAllProducts($dbConn));
    $total_number_of_categories = count(getAllCategories($dbConn));



    if ( $total_number_of_products === 0 && $total_number_of_categories === 0 )
    {
        loadNoProductsMessage($dbConn);
        exit;
    }
    

}

function loadNoProductsMessage(  PDO $dbConn )
{
    $message =  
        '<h1 class="mx-auto w-100 " > <i class="fas fa-triangle-exclamation text-danger "></i> There are no products in our product lists yet.</h1>'.
        '<h3>Kindly report this to the admin at <a href="mailto:' . DB_ADMIN_EMAIL .'"> <i class="fas fa-envelope-open"></i> ' . DB_ADMIN_EMAIL .' </a>  </h3>';

        include_once '../NFSFU-ECOMM\assets/pages/no-products.php';


        return true;
}

function loadPage(string $pathToFile)
{

    if ( file_exists( $pathToFile ) )
    {
        include_once $pathToFile;
    }
    else{
        load404Page();
    }


}

function load404Page()
{

    $dir = "page-not-found.php";
    loadPage($dir);

}

function loadProductNotFoundPage()
{
    $dir = 'product-not-found.php'; 
    loadPage($dir);
    exit;
}


function getContentsFromAFile( string $filePath )
{

    if ( file_exists( $filePath ) )
    {
        $contents = file_get_contents($filePath);
    }
    else
    {
        $contents = null;
    }

    return $contents;
   

}

function deleteAFolderAndItsContents( string $pathToFolder , bool $ifDeleteParentFolder = false)
{

    if ( is_dir( $pathToFolder ) )
    {
        $files = scandir($pathToFolder);
        unset( $files[0] );
        unset( $files[1] );
        
        foreach ( $files as $file )
        {

            $path = $pathToFolder . DIRECTORY_SEPARATOR . $file;

            if ( is_dir( $path) )
            {
                deleteAFolderAndItsContents( $path );
            }
            else
            {
                unlink($path);
            }

            rmdir($path);
    
        }

        if ( $ifDeleteParentFolder === true )
        {
            rmdir($pathToFolder);
        }


    }

}

?>