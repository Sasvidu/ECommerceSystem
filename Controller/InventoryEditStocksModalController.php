<?php

    //Verify that the controller had been accessed through the view:
    if($_GET["status"]!="true"){

        header("location: ../View/InventoryManageStocks.php");

    }else{

        //Verify that user has logged in:
        session_start();
        if(!isset($_SESSION["userName"])){                   
            $msg = "Please login first";
            $msg = base64_encode($msg);
            header("location: ../View/Login.php?msg=$msg");
        }

        //Load data from view:
        $Id = $_POST["Id"];
        $Name = $_POST["Name"];
        $MaxQty = $_POST["MaxQty"];
        $BufferQty = $_POST["BufferQty"];
        $CurrentQty = $_POST["CurrentQty"];
        $OGCreateDate = $_POST["CreateDate"];
        $OGUpdateDate = $_POST["UpdateDate"];

        //Format the dates:
        $OGCreateDate = strval($OGCreateDate);
        $CreateDate = date("Y-m-d", strtotime($OGCreateDate));

        $OGUpdateDate = strval($OGUpdateDate);
        $UpdateDate = date("Y-m-d", strtotime($OGUpdateDate));

        //Load the database connection string and model:
        require_once "../Model/InventoryEditStocksModalModel.php";
        require_once '../Commons/ECommerceDB.php';

        //Create database connection object:
        $thisDBConnection = new DbConnection();
        $myCon = $thisDBConnection->con;

        //Update the stock:
        if(InputCheck($Id, $Name, $MaxQty, $BufferQty, $CurrentQty, $OGCreateDate, $OGUpdateDate)){
            UpdateStock($myCon, $Id, $MaxQty, $BufferQty, $CurrentQty, $CreateDate, $UpdateDate);
        }
        
    }


?>