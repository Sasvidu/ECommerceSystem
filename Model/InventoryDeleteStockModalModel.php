<?php

require_once '../Commons/ECommerceDB.php';

    //Update the stock in the database so that its status is changed to 0 and update the product in its table such that its stock status is changed to 0:
    //This is a soft delete
    function DeleteStock($con, $id){

        $sql = "DELETE FROM stock WHERE stock_id = ?";

        $stmt = mysqli_stmt_init($con);  

        if(!mysqli_stmt_prepare($stmt, $sql)){
            //Send an error message:
            $msg = "Error: MySQL statement Failed";
            $msg = base64_encode($msg);
            header("location: ../View/InventoryManageStocks.php?msg=$msg");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $sql = "UPDATE product SET product_stock_status = 0 WHERE product_id = ?";

        $stmt = mysqli_stmt_init($con);  

        if(!mysqli_stmt_prepare($stmt, $sql)){
            //Send an error message:
            $msg = "Error: MySQL statement Failed";
            $msg = base64_encode($msg);
            header("location: ../View/InventoryManageStocks.php?msg=$msg");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        //Send a success message:
        $code = "Stock deleted successfully!";
        $code = base64_encode($code);
        header("location: ../View/InventoryManageStocks.php?msg=$code");

    }


?>
