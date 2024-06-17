<?php

if (!isset($_GET["status"])) {

    header("location: ../View/Staff.php");
    exit();

} else {

    if(isset($_POST["NoSubmit"])){

        $msg = "The last calculated salary was : " . $_POST["Amount"];
        $msg = base64_encode($msg);
        header("location: ../View/Staff.php?msg=$msg");

    }else if(isset($_POST["YesSubmit"])){

        session_start();
        if (!isset($_SESSION["userName"])) {
            $msg = "Please login first";
            $msg = base64_encode($msg);
            header("location: ../View/Login.php?msg=$msg");
        }
    
        require_once "../Model/StaffCalculateSalaryModalModel.php";
        require_once '../Commons/ECommerceDB.php';
    
        $thisDBConnection = new DbConnection();
        $myCon = $thisDBConnection->con;
    
        $EmpId = $_POST["EmpId"];
        $Year = $_POST["Year"];
        $Month = $_POST["Month"];
        $WorkedDays = $_POST["WorkedDays"];
        $OTHours = $_POST["OTHours"];
        $Amount = $_POST["Amount"];

        $Amount = number_format((float)$Amount, 2, '.', '');


        if(payrollExistsRe($myCon, $EmpId, $Year, $Month) !== false){
            UpdatePayroll($myCon, $EmpId, $Year, $Month, $WorkedDays, $OTHours, $Amount);
        }else if(payrollExistsRe($myCon, $Year, $Month, $EmpId) === false){
            InsertPayroll($myCon, $EmpId, $Year, $Month, $WorkedDays, $OTHours, $Amount);
        }else{
            $msg = "There was an error with inserting data to the database. please contact your troubleshooting supervisor";
            $msg = base64_encode($msg);
            header("location: ../View/Staff.php?msg=$msg");
        }

    }

}

?>