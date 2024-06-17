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

        require_once "../Model/InventoryDeleteProductModalModel.php";
        require_once '../Commons/ECommerceDB.php';

        $thisDBConnection = new DbConnection();
        $myCon = $thisDBConnection->con;

        DeleteProduct($myCon, $id);
        
    }


?>