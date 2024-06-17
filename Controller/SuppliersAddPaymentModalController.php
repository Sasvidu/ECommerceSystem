<?php

    if(!isset($_GET["status"])){

        ?>
            <script>window.location="../View/Suppliers.php"</script>
        <?php
        exit();

    }else{

        session_start();
        if(!isset($_SESSION["userName"])){                   
            $msg = "Please login first";
            $msg = base64_encode($msg);
            header("location: ../View/Login.php?msg=$msg");
        }

        $SupplierId = $_POST['Supplier'];
        $OrderId = $_POST['Order'];

        $OGDate = $_POST['PaymentDate'];
        $OGDate = strval($OGDate);
        $Date = date("Y-m-d", strtotime($OGDate));

        $OGAmount = $_POST["PaymentAmount"];
        $Amount = number_format((float)$OGAmount, 2, '.', '');

        $Comment = $_POST["PaymentComment"];

        require_once "../Model/SuppliersAddPaymentModalModel.php";
        require_once '../Commons/ECommerceDB.php';

        $thisDBConnection = new DbConnection();
        $myCon = $thisDBConnection->con;

        if($OrderId == "Unspecified"){
            if(LowerInputCheck($SupplierId, $OGDate, $OGAmount, $Comment) === true){
                LowerInsertPayment($myCon, $Date, $Amount, $SupplierId, $Comment);

                $code = "Payment Recorded Successfully";
                $code = base64_encode($code);
                header("location: ../View/Suppliers.php?msg=$code");
            }
        }else{
            if(UpperInputCheck($OrderId, $SupplierId, $OGDate, $OGAmount) === true){
                UpperInsertPayment($myCon, $Date, $Amount, $SupplierId, $OrderId, $Comment);

                $code = "Payment Recorded Successfully";
                $code = base64_encode($code);
                header("location: ../View/Suppliers.php?msg=$code");
            }
        }
        
    }


?>