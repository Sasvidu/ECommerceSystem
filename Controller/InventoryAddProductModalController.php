<?php

    //Verify that the controller had been accessed through the view:
    if(!isset($_GET["status"])){

        ?>
            <script>window.location="../View/Inventory.php"</script>
        <?php
        exit();

    }else{

        //Verify that user has logged in:
        session_start();
        if(!isset($_SESSION["userName"])){                   
            $msg = "Please login first";
            $msg = base64_encode($msg);
            header("location: ../View/Login.php?msg=$msg");
        }

        //Load data from view
        $category = $_POST['Category'];
        $brand = $_POST["Brand"];
        $name = $_POST['Name'];

        //Convert price in the decimal format required by the database:
        $OGPrice = $_POST["Price"];
        $Price = number_format((float)$OGPrice, 2, '.', '');

        //Prepare the image:
        $OGImage = $_FILES["Image"];
        $imageName = $OGImage['name'];

        //Load the database connection string and model:
        require_once "../Model/InventoryAddProductModalModel.php";
        require_once '../Commons/ECommerceDB.php';

        //Create database connection object:
        $thisDBConnection = new DbConnection();
        $myCon = $thisDBConnection->con;

        //Add the product to the database:
        if(emptyInputCheck($category, $brand, $name, $OGPrice, $imageName)===true){
            InsertProduct($myCon, $category, $brand, $name, $Price, $OGImage);
        }

        /*
        if(productExists($myCon, $category, $brand, $name) !== false){
            $msg = "Product already exists";
            $msg = base64_encode($msg);
            header("location: ../View/Inventory.php?msg=$msg");
            exit();
        }
        */
        
    }


?>