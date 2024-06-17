<?php

    if($_GET["status"]!="true"){

        header("location: ../View/SuppliersManageSuppliers.php");

    }else{

        session_start();
        if(!isset($_SESSION["userName"])){                   
            $msg = "Please login first";
            $msg = base64_encode($msg);
            header("location: ../View/Login.php?msg=$msg");
        }

        $Id = $_POST["Id"];
        $PendingPayment = $_POST["PendingPayment"];

        require_once "../Model/SuppliersDeleteSuppliersModalModel.php";
        require_once '../Commons/ECommerceDB.php';

        $thisDBConnection = new DbConnection();
        $myCon = $thisDBConnection->con;

        if(emptyInputCheck($Id, $PendingPayment) === true){
            DeleteSupplier($myCon, $Id, $PendingPayment);
        }
        
    }


?>