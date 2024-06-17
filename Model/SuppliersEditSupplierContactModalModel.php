<?php

require_once "../Commons/ECommerceDB.php";

    function emptyInputCheck($SupplierId, $Id, $Type, $Value){

        if($Id==""){
            $msg = "Error loading supplier's contact details";
            $msg = base64_encode($msg);
            header("location: ../View/SuppliersManageSuppliersContact.php?supplierId=$SupplierId&msg=$msg");
        }else if($Type=="Unspecified"){
            $msg = "Contact Type cannot be empty!";
            $msg = base64_encode($msg);
            header("location: ../View/SuppliersManageSuppliersContact.php?supplierId=$SupplierId&msg=$msg");
        }else if($Value==""){
            $msg = "Contact value cannot be empty!";
            $msg = base64_encode($msg);
            header("location: ../View/SuppliersManageSuppliersContact.php?supplierId=$SupplierId&msg=$msg");
        }else{
            return true;
        }

    }

    function UpdateSupplierContact($con, $SupplierId, $Id, $Type, $Value){

        $sql = "UPDATE suppliercontact SET supplierContact_type = ? , supplierContact_value = ? WHERE supplierContact_id = ?;";

        $stmt = mysqli_stmt_init($con);  

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $msg = "Error: MySQL statement Failed";
            $msg = base64_encode($msg);
            header("location: ../View/SuppliersManageSuppliersContact.php?supplierId=$SupplierId&msg=$msg");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "sss", $Type, $Value, $Id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $code = "Supplier contact details updated successfully";
        $code = base64_encode($code);
        header("location: ../View/SuppliersManageSuppliersContact.php?supplierId=$SupplierId&msg=$code");

    }

?>