<?php

    if(!isset($_GET["status"])){

        ?>
            <script>window.location="../View/Inventory.php"</script>
        <?php
        exit();

    }else{

        session_start();
        if(!isset($_SESSION["userName"])){                   
            $msg = "Please login first";
            $msg = base64_encode($msg);
            header("location: ../View/Login.php?msg=$msg");
        }

        $Id = $_POST["Product"];
        $MaxQty = $_POST["MaxQty"];
        $BufferQty = $_POST["BufferQty"];
        $OGDate =  $_POST["Date"];

        $OGDate = strval($OGDate);
        $Date = date("Y-m-d", strtotime($OGDate));

        require_once "../Model/InventoryAddStockModalModel.php";
        require_once '../Commons/ECommerceDB.php';

        $thisDBConnection = new DbConnection();
        $myCon = $thisDBConnection->con;

        if(InputCheck($Id, $MaxQty, $BufferQty, $OGDate) === true){
            InsertStock($myCon, $Id, $MaxQty, $BufferQty, $Date);
        }
        
    }


?>