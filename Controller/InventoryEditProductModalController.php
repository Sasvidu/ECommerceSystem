<?php

    if($_GET["status"]!="true"){

        header("location: ../View/InventoryManageProducts.php");

    }else{

        session_start();
        if(!isset($_SESSION["userName"])){                   
            $msg = "Please login first";
            $msg = base64_encode($msg);
            header("location: ../View/Login.php?msg=$msg");
        }

        $id = $_POST['Id'];
        $category = $_POST['Category'];
        $brand = $_POST['Brand'];
        $name = $_POST['Name'];

        $OGPrice = $_POST['Price'];
        $Price = number_format((float)$OGPrice, 2, '.', '');;

        $OGImage = $_FILES["Image"];
        $imageName = $OGImage['name'];

        require_once "../Model/InventoryEditProductModalModel.php";
        require_once '../Commons/ECommerceDB.php';

        $thisDBConnection = new DbConnection();
        $myCon = $thisDBConnection->con;

        if(emptyInputCheck($category, $brand, $name, $OGPrice, $imageName) === true){
            UpdateProduct($myCon, $id, $category, $brand, $name, $Price, $OGImage);
        }
        
    }


?>