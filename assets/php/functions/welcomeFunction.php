<?php

    try
    {
        $dbConn = new PDO( "mysql:host=localhost;", "root" , "");
    }
    catch ( PDOException $e )
    {
        return $e;
    }

    function chechkIfDataBaseExists(PDO $conn, string $dbName):bool
    {
        
        $chechkIfDBExistQuery = $conn->query( " SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA  WHERE SCHEMA_NAME = '$dbName' " );
        // return either 0 or 1
        return $chechkIfDBExistQuery->fetchColumn();

    }

    function createDb(PDO $conn, string $dbName)
    {
        
        $conn->exec("

            CREATE DATABASE IF NOT EXISTS `$dbName` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
        ")

        or die( print_r( $conn->errorInfo(), true ) );


    }

    function connectToDatabase(string $dbName):PDO | Exception
    {

        try
        {
            $conn = new PDO( "mysql:host=localhost;dbname=$dbName", "root", "" );
            return $conn;
        }
        catch ( PDOException $e )
        {
            return $e;
        }

    }

    function insertIntoDBwhereColumnIsTwo( PDO $dbConnection, string $query, array $dataToBindArray )
    {

        $response = null;
        $response_array = array();

        foreach ($dataToBindArray as $key => $dataToBindArrayItem) 
        {

            $qr = $query;

            $title = $dataToBindArrayItem[0] ;
            $value = $dataToBindArrayItem[1];

            $stmt = $dbConnection->prepare($qr);
            $stmt->bindParam(":title", $title );
            $stmt->bindParam(":answer", $value );

            if ( $stmt->execute() )
            {

                array_push($response_array, true);

            }
            else
            {

                array_push($response_array, false);

            }



        }

        if ( count( array_unique( $response_array ) ) === 1 )
        {

            $response = true;
            
        }
        else
        {

            $response = false;

        }

        return $response;

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

    function deleteAFolderAndItsContents( string $pathToFolder )
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


    
        }

    }


?>