<?php

require_once '../Commons/ECommerceDB.php';

    function emptyInputCheck($Id, $Name, $Location, $Address){

        if($Id == ""){
            $msg = "Error loading supplier details";
            $msg = base64_encode($msg);
            header("location: ../View/SuppliersManageSuppliers.php?msg=$msg");
        }else if($Name == ""){
            $msg = "Supplier name cannot be empty!";
            $msg = base64_encode($msg);
            header("location: ../View/SuppliersManageSuppliers.php?msg=$msg");
        }else if($Location == ""){
            $msg = "Supplier city cannot be empty!";
            $msg = base64_encode($msg);
            header("location: ../View/SuppliersManageSuppliers.php?msg=$msg");
        }else if($Address == ""){
            $msg = "Supplier address cannot be empty!";
            $msg = base64_encode($msg);
            header("location: ../View/SuppliersManageSuppliers.php?msg=$msg");
        }else{
            return true;
        }

    }

    function UpdateSupplier($con, $Id, $Name, $Location, $Address){

        $sql = "UPDATE supplier SET supplier_name = ?, supplier_location = ? , supplier_address = ? WHERE supplier_id = ?;";

        $stmt = mysqli_stmt_init($con);  

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $msg = "Error: MySQL statement Failed";
            $msg = base64_encode($msg);
            header("location: ../View/SuppliersManageSuppliers.php?msg=$msg");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ssss", $Name, $Location, $Address, $Id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $code = "Supplier updated successfully!";
        $code = base64_encode($code);
        header("location: ../View/SuppliersManageSuppliers.php?msg=$code");

    }

?>