<?php

require_once "../Commons/ECommerceDB.php";

    function emptyInputCheck($Id, $PendingPayment){

        if($Id == ""){
            $msg = "Error loading supplier details";
            $msg = base64_encode($msg);
            header("location: ../View/SuppliersManageSuppliers.php?msg=$msg");
        }else if($PendingPayment == ""){
            $msg = "Error loading supplier details";
            $msg = base64_encode($msg);
            header("location: ../View/SuppliersManageSuppliers.php?msg=$msg");
        }else{
            return true;
        }

    }

    function DeleteSupplier($con, $Id, $PendingPayment){

        if($PendingPayment > 0){
            $msg = "Cannot delete suppliers to whom money is owed!";
            $msg = base64_encode($msg);
            header("location: ../View/SuppliersManageSuppliers.php?msg=$msg");
        }else{

            $sql = "UPDATE supplier SET supplier_status = 0 WHERE supplier_id = ?;";

            $stmt = mysqli_stmt_init($con);  

            if(!mysqli_stmt_prepare($stmt, $sql)){
                $msg = "Error: MySQL statement Failed";
                $msg = base64_encode($msg);
                header("location: ../View/SuppliersManageSuppliers.php?msg=$msg");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "s", $Id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            $code = "Supplier deleted successfully!";
            $code = base64_encode($code);
            header("location: ../View/SuppliersManageSuppliers.php?msg=$code");

        }

    }

?>