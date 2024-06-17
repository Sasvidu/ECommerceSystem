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
        $Name = $_POST["Name"];
        $Location = $_POST["Location"];
        $Address = $_POST["Address"];

        require_once "../Model/SuppliersEditSuppliersModalModel.php";
        require_once '../Commons/ECommerceDB.php';

        $thisDBConnection = new DbConnection();
        $myCon = $thisDBConnection->con;

        if(emptyInputCheck($Id, $Name, $Location, $Address) === true){
            UpdateSupplier($myCon, $Id, $Name, $Location, $Address);
        }
        
    }


?>