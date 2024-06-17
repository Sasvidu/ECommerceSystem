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

        $productId = $_POST["Product"];
        $supplierId = $_POST["Supplier"];
        $OGdate = $_POST["OrderDate"];
        $Qty = $_POST["Qty"];

        require_once "../Commons/ECommerceDB.php";
        require_once "../Model/InventoryAddOrderModalModel.php";

        $thisDBConnection = new DbConnection();
        $myCon = $thisDBConnection->con;

        if(emptyInputCheck($myCon, $productId, $supplierId, $OGdate, $Qty) === true){

            $OGdate = strval($OGdate);
            $Date = date("Y-m-d", strtotime($OGdate));

            $Payment = $Qty * getProductPrice($myCon, $productId);
            
            placeOrder($myCon, $productId, $supplierId, $Date, $Qty, $Payment);

        }
    }

?>