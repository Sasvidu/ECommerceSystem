<?php

require_once '../Commons/ECommerceDB.php';

    //Check for input validity:
    function InputCheck($Id, $Name, $MaxQty, $BufferQty, $CurrentQty, $OGCreateDate, $OGUpdateDate){

        if($Id == ""){
            $msg = "Error loading stock details";
            $msg = base64_encode($msg);
            header("location: ../View/InventoryManageStocks.php?msg=$msg");
        }else if($Name == ""){
            $msg = "Product name cannot be empty!";
            $msg = base64_encode($msg);
            header("location: ../View/InventoryManageStocks.php?msg=$msg");
        }else if($MaxQty == ""){
            $msg = "Maximum quantity cannot be empty!";
            $msg = base64_encode($msg);
            header("location: ../View/InventoryManageStocks.php?msg=$msg");
        }else if($BufferQty == ""){
            $msg = "Re-Order quantity cannot be empty!";
            $msg = base64_encode($msg);
            header("location: ../View/InventoryManageStocks.php?msg=$msg");
        }else if($CurrentQty == ""){
            $msg = "Current quantity cannot be empty!";
            $msg = base64_encode($msg);
            header("location: ../View/InventoryManageStocks.php?msg=$msg");
        }else if($OGCreateDate == ""){
            $msg = "Create date cannot be empty!";
            $msg = base64_encode($msg);
            header("location: ../View/InventoryManageStocks.php?msg=$msg");
        }else if($OGUpdateDate == ""){
            $msg = "Last update date cannot be empty!";
            $msg = base64_encode($msg);
            header("location: ../View/InventoryManageStocks.php?msg=$msg");
        }else if($BufferQty > $MaxQty){
            $msg = "Re-Order quantity cannot exceed Maximum quantity!";
            $msg = base64_encode($msg);
            header("location: ../View/InventoryManageStocks.php?msg=$msg");
        }else if($CurrentQty > $MaxQty){
            $msg = "Current quantity cannot exceed Maximum quantity!";
            $msg = base64_encode($msg);
            header("location: ../View/InventoryManageStocks.php?msg=$msg");
        }else{
            return true;
        }

    }

    //Update the stock in the database:
    function UpdateStock($con, $Id, $MaxQty, $BufferQty, $CurrentQty, $CreateDate, $UpdateDate){

        $sql = "UPDATE stock SET stock_qty_max = ? , stock_qty_buffer = ? , stock_qty_current = ? , stock_created_date = ? , stock_updated_date = ? WHERE stock_id = ?;";

        $stmt = mysqli_stmt_init($con);  

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $msg = "Error: MySQL statement Failed";
            $msg = base64_encode($msg);
            header("location: ../View/InventoryManageStocks.php?msg=$msg");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ssssss", $MaxQty, $BufferQty, $CurrentQty, $CreateDate, $UpdateDate, $Id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        //Send a success message:
        $code = "Stock updated successfully!";
        $code = base64_encode($code);
        header("location: ../View/InventoryManageStocks.php?msg=$code");

    }

?>