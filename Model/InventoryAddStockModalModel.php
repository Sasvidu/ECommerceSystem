<?php

require_once '../Commons/ECommerceDB.php';

    function InputCheck($Id, $MaxQty, $BufferQty, $OGDate){

        if($Id=="Unspecified"){
           $msg = "Product cannot be empty!";
           $msg = base64_encode($msg);
           header("location: ../View/Inventory.php?msg=$msg");
        }else if($MaxQty==""){
            $msg = "Maximum quantity cannot be empty!";
            $msg = base64_encode($msg);
            header("location: ../View/Inventory.php?msg=$msg");
        }else if($BufferQty==""){
            $msg = "Re-order quantity cannot be empty!";
            $msg = base64_encode($msg);
            header("location: ../View/Inventory.php?msg=$msg");
        }else if($OGDate==""){
            $msg = "Date of creation cannot be empty!";
            $msg = base64_encode($msg);
            header("location: ../View/Inventory.php?msg=$msg");
        }else if($BufferQty > $MaxQty){
            $msg = "Re-Order quantity cannot exceed Maximum quantity!";
            $msg = base64_encode($msg);
            header("location: ../View/Inventory.php?msg=$msg");
        }else{
            return true;
        }

    }

    function InsertStock($con, $Id, $MaxQty, $BufferQty, $Date){

        $sql = "INSERT INTO stock(stock_id, stock_product_id, stock_qty_max, stock_qty_buffer, stock_created_date, stock_updated_date) VALUES (?, ?, ?, ?, ?, ?);";

        $stmt = mysqli_stmt_init($con);  

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $msg = "Error: MySQL statement Failed";
            $msg = base64_encode($msg);
            header("location: ../View/Inventory.php?msg=$msg");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ssssss", $Id, $Id, $MaxQty, $BufferQty, $Date, $Date);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $sql = "UPDATE product SET product_stock_status = 1 WHERE product_id = ?;";

        $stmt = mysqli_stmt_init($con);  

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $msg = "Error: MySQL statement Failed";
            $msg = base64_encode($msg);
            header("location: ../View/Inventory.php?msg=$msg");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $Id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $code = "Stock created successfully!";
        $code = base64_encode($code);
        header("location: ../View/Inventory.php?msg=$code");

    }



