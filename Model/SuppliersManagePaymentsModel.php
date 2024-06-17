<?php

require_once "../Commons/ECommerceDB.php";

    function getSupplierName($con, $Id){

        $sql = "SELECT * FROM supplier WHERE supplier_id = ?;";

        $stmt = mysqli_stmt_init($con);  

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $msg = "Error: MySQL statement Failed";
            $msg = base64_encode($msg);
            header("location: ../View/SuppliersManagePayments.php?msg=$msg");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $Id);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resultData)){
            $supplierName = $row["supplier_name"];
            return $supplierName;
        }else{
            $msg = "Error: Couldn't fetch supplier name from the database";
            $msg = base64_encode($msg);
            header("location: ../View/SuppliersManagePayments.php?msg=$msg");
            exit();
        }

        mysqli_stmt_close($stmt);

    }

?>