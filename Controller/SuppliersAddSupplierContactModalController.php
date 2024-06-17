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
        $Type = $_POST["Type"];
        $Value = $_POST["Value"];

        require_once "../Commons/ECommerceDB.php";
        require_once "../Model/SuppliersAddSupplierContactModalModel.php";

        $thisDBConnection = new DbConnection();
        $myCon = $thisDBConnection->con;

        if(emptyInputCheck($SupplierId, $Type, $Value) === true){
            InsertSupplierContact($myCon, $SupplierId, $Type, $Value);
        }
        
        
    }


?>