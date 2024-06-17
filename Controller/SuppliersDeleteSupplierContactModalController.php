<?php

    if(!isset($_GET["status"])){

        header("location: ../View/SuppliersManageSuppliers.php");
        exit();

    }else{

        session_start();
        if(!isset($_SESSION["userName"])){                   
            $msg = "Please login first";
            $msg = base64_encode($msg);
            header("location: ../View/Login.php?msg=$msg");
        }

        $SupplierId = $_POST["SupplierId"];
        $ContactId = $_POST["Id"];

        require_once "../Commons/ECommerceDB.php";
        require_once "../Model/SuppliersDeleteSupplierContactModalModel.php";

        $thisDBConnection = new DbConnection();
        $myCon = $thisDBConnection->con;

        if(InputCheck($myCon, $SupplierId, $ContactId) === true){
            DeleteContact($myCon, $ContactId, $SupplierId);
        }
        
    }


?>