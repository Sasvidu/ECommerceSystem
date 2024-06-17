<?php

require_once '../Commons/ECommerceDB.php';

    function DeleteProduct($con, $id){

        $sql = "UPDATE product SET product_status = 0, product_stock_status = 0 WHERE product_id = ?";

        $stmt = mysqli_stmt_init($con);  

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $msg = "Error: MySQL statement Failed";
            $msg = base64_encode($msg);
            header("location: ../View/InventoryManageProducts.php?msg=$msg");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $sqla = "UPDATE stock SET stock_status = 0 WHERE stock_product_id = ?";

        $stmta = mysqli_stmt_init($con);  

        if(!mysqli_stmt_prepare($stmta, $sqla)){
            $msg = "Error: MySQL statement Failed";
            $msg = base64_encode($msg);
            header("location: ../View/InventoryManageProducts.php?msg=$msg");
            exit();
        }

        mysqli_stmt_bind_param($stmta, "s", $id);
        mysqli_stmt_execute($stmta);
        mysqli_stmt_close($stmta);

        $code = "Product deleted successfully!";
        $code = base64_encode($code);
        header("location: ../View/InventoryManageProducts.php?msg=$code");

    }


?>
