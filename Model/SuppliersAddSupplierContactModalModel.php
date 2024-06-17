<?php

require_once '../Commons/ECommerceDB.php';

    function emptyInputCheck($Id, $Type, $Value){

        if($Id==""){
            $msg = "Error loading supplier's contact details";
            $msg = base64_encode($msg);
            header("location: ../View/SuppliersManageSuppliers.php?msg=$msg");
        }else if($Type=="Unspecified"){
            $msg = "Contact Type cannot be empty!";
            $msg = base64_encode($msg);
            header("location: ../View/SuppliersManageSuppliersContact.php?supplierId=$Id&msg=$msg");
        }else if($Value==""){
            $msg = "Contact value cannot be empty!";
            $msg = base64_encode($msg);
            header("location: ../View/SuppliersManageSuppliersContact.php?supplierId=$Id&msg=$msg");
        }else{
            return true;
        }

    }

    function InsertSupplierContact($con, $Id, $Type, $Value){

        $sql = "INSERT INTO suppliercontact(supplierContact_type, supplierContact_value, supplierContact_supplier_id) VALUES (?, ?, ?);";

        $stmt = mysqli_stmt_init($con);  

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $msg = "Error: MySQL statement Failed";
            $msg = base64_encode($msg);
            header("location: ../View/SuppliersManageSuppliersContact.php?supplierId=$Id&msg=$msg");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "sss", $Type, $Value, $Id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $code = "New supplier contact added successfully";
        $code = base64_encode($code);
        header("location: ../View/SuppliersManageSuppliersContact.php?supplierId=$Id&msg=$code");

    }