<?php

require_once '../Commons/ECommerceDB.php';

    function LowerInputCheck($SupplierId, $OGDate, $OGAmount, $Comment){

        if($SupplierId=="Unspecified"){
            $msg = "Payment Supplier cannot be empty!";
            $msg = base64_encode($msg);
            header("location: ../View/Suppliers.php?msg=$msg");
        }else if($OGDate==""){
            $msg = "Payment Date cannot be empty!";
            $msg = base64_encode($msg);
            header("location: ../View/Suppliers.php?msg=$msg");
        }else if($OGAmount==""){
            $msg = "Payment Amount cannot be empty!";
            $msg = base64_encode($msg);
            header("location: ../View/Suppliers.php?msg=$msg");
        }else if($Comment==""){
            $msg = "Payment order or comment must be filled in!";
            $msg = base64_encode($msg);
            header("location: ../View/Suppliers.php?msg=$msg");
        }else{
            return true;
        }

    }

    function UpperInputCheck($OrderId, $SupplierId, $OGDate, $OGAmount){

        if($OrderId==""){
            $msg = "Payment order or comment must be filled in!";
            $msg = base64_encode($msg);
            header("location: ../View/Suppliers.php?msg=$msg");
        }else if($SupplierId=="Unspecified"){
            $msg = "Payment Supplier cannot be empty!";
            $msg = base64_encode($msg);
            header("location: ../View/Suppliers.php?msg=$msg");
        }else if($OGDate==""){
            $msg = "Payment Date cannot be empty!";
            $msg = base64_encode($msg);
            header("location: ../View/Suppliers.php?msg=$msg");
        }else if($OGAmount==""){
            $msg = "Payment Amount cannot be empty!";
            $msg = base64_encode($msg);
            header("location: ../View/Suppliers.php?msg=$msg");
        }else{
            return true;
        }

    }

    function LowerInsertPayment($con, $Date, $Amount, $SupplierId, $Comment){

        $sql = "INSERT INTO payment(payment_date, payment_amount, payment_comment, payment_supplier_id) VALUES (?, ?, ?, ?);";

        $stmt = mysqli_stmt_init($con);  

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $msg = "Error: MySQL statement1 Failed";
            $msg = base64_encode($msg);
            header("location: ../View/Suppliers.php?msg=$msg");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ssss", $Date, $Amount, $Comment, $SupplierId);
        mysqli_stmt_execute($stmt);

        $sql = "UPDATE supplier SET supplier_pending_payment = supplier_pending_payment - ? WHERE supplier_id = ?;";

        $stmt = mysqli_stmt_init($con);  

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $msg = "Error: MySQL statement2 Failed";
            $msg = base64_encode($msg);
            header("location: ../View/Suppliers.php?msg=$msg");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss", $Amount, $SupplierId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

    }

    function UpperInsertPayment($con, $Date, $Amount, $SupplierId, $OrderId, $Comment){

        $sql = "INSERT INTO payment(payment_date, payment_amount, payment_order_id, payment_comment, payment_supplier_id) VALUES (?, ?, ?, ?, ?);";

        $stmt = mysqli_stmt_init($con);  

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $msg = "Error: MySQL statement Failed";
            $msg = base64_encode($msg);
            header("location: ../View/Suppliers.php?msg=$msg");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "sssss", $Date, $Amount, $OrderId, $Comment, $SupplierId,);
        mysqli_stmt_execute($stmt);

        $sql = "UPDATE supplier SET supplier_pending_payment = supplier_pending_payment - ? WHERE supplier_id = ?;";

        $stmt = mysqli_stmt_init($con);  

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $msg = "Error: MySQL statement Failed";
            $msg = base64_encode($msg);
            header("location: ../View/Suppliers.php?msg=$msg");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss", $Amount, $SupplierId);
        mysqli_stmt_execute($stmt);

        $sql = "UPDATE stockorder SET order_completed_payment = order_completed_payment + ? WHERE order_id = ?;";

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $msg = "Error: MySQL statement Failed";
            $msg = base64_encode($msg);
            header("location: ../View/Suppliers.php?msg=$msg");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss", $Amount, $OrderId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

    }

?>