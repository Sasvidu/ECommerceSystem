<?php

require_once '../Commons/ECommerceDB.php';

    function emptyInputCheck($name, $location, $address){

        if($name==""){
            $msg = "Supplier name cannot be empty!";
            $msg = base64_encode($msg);
            header("location: ../View/Suppliers.php?msg=$msg");
        }else if($location==""){
            $msg = "Supplier city cannot be empty!";
            $msg = base64_encode($msg);
            header("location: ../View/Suppliers.php?msg=$msg");
        }else if($address==""){
            $msg = "Supplier address cannot be empty!";
            $msg = base64_encode($msg);
            header("location: ../View/Suppliers.php?msg=$msg");
        }else{
            return true;
        }

    }

    function InsertSupplier($con, $name, $location, $address){

        $sql = "INSERT INTO supplier(supplier_name, supplier_location, supplier_address) VALUES (?, ?, ?);";

        $stmt = mysqli_stmt_init($con);  

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $msg = "Error: MySQL statement Failed";
            $msg = base64_encode($msg);
            header("location: ../View/Suppliers.php?msg=$msg");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "sss", $name, $location, $address);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        return true;
    }

    function InsertSupplierContact($con, $Id, $type, $contact){

        $sql = "INSERT INTO suppliercontact(supplierContact_type, supplierContact_value, supplierContact_supplier_id) VALUES (?, ?, ?);";

        $stmt = mysqli_stmt_init($con);  

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $msg = "Error: MySQL statement Failed";
            $msg = base64_encode($msg);
            header("location: ../View/Suppliers.php?msg=$msg");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "sss", $type, $contact, $Id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

    }