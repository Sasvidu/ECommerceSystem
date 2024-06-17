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

        $name = $_POST["Name"];
        $location = $_POST["Location"];
        $address = $_POST["Address"];

        $emails = $_POST["Emails"];
        $emailsLength= count($emails);

        $Telnos = $_POST["TelNos"];
        $TelnosLength = count($Telnos);

        require_once "../Commons/ECommerceDB.php";
        require_once "../Model/SuppliersAddSupplierModalModel.php";

        $thisDBConnection = new DbConnection();
        $myCon = $thisDBConnection->con;


        if(emptyInputCheck($name, $location, $address) === true){

            echo "Input Pass";
            if(InsertSupplier($myCon, $name, $location, $address) === true){
                $SupplierId = mysqli_insert_id($myCon);

                foreach($emails as $thisEmail){
                    if($thisEmail != ""){
                        InsertSupplierContact($myCon, $SupplierId, "Email", $thisEmail);
                    }
                }

                foreach($Telnos as $thisTelNo){
                    if($thisTelNo != ""){
                        InsertSupplierContact($myCon, $SupplierId, "Telephone", $thisTelNo);
                    }
                }
            }

            $code = "Supplier Created Successfully";
            $code = base64_encode($code);
            header("location: ../View/Suppliers.php?msg=$code");
    
        }
        
    }


?>