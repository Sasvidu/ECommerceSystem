<?php

require_once "../Commons/ECommerceDB.php";

    function InputCheck($con, $SupplierId, $ContactId){

        if($SupplierId == ""){

            $msg = "Error loading supplier's contact details";
            $msg = base64_encode($msg);
            header("location: ../View/SuppliersManageSuppliers.php?msg=$msg");

        }else if($ContactId == ""){

            $msg = "Error loading supplier's contact details";
            $msg = base64_encode($msg);
            header("location: ../View/SuppliersManageSuppliersContact.php?supplierId=$SupplierId&msg=$msg");

        }else{
        
            $sql = "SELECT count(supplierContact_id) AS supplierContact_id FROM suppliercontact WHERE supplierContact_supplier_id = ? AND supplierContact_status=1;";
            $stmt = mysqli_stmt_init($con);  

            if(!mysqli_stmt_prepare($stmt, $sql)){
                $msg = "Error: MySQL statement Failed";
                $msg = base64_encode($msg);
                header("location: ../View/SuppliersManageSuppliersContact.php?supplierId=$SupplierId&msg=$msg");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "s", $SupplierId);
            mysqli_stmt_execute($stmt);

            $resultData = mysqli_stmt_get_result($stmt);
    
            $supplierCount = $resultData->fetch_all(MYSQLI_ASSOC);
            $total = $supplierCount[0]['supplierContact_id'];
            
            if($total <= 1){
                $msg = "Supplier must have at least one contact!";
                $msg = base64_encode($msg);
                mysqli_stmt_close($stmt);
                header("location: ../View/SuppliersManageSuppliersContact.php?supplierId=$SupplierId&msg=$msg");
                exit();
            }else{
                mysqli_stmt_close($stmt);
                return true;
            }

        }

    }

    function DeleteContact($con, $ContactId, $SupplierId){

        $sql = "UPDATE suppliercontact SET supplierContact_status = 0 WHERE supplierContact_id = ?;";

        $stmt = mysqli_stmt_init($con);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $msg = "Error: MySQL statement Failed";
            $msg = base64_encode($msg);
            header("location: ../View/SuppliersManageSuppliersContact.php?supplierId=$SupplierId&msg=$msg");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $ContactId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $code = "Supplier contact deleted successfully";
        $code = base64_encode($code);
        header("location: ../View/SuppliersManageSuppliersContact.php?supplierId=$SupplierId&msg=$code");

    }

?>