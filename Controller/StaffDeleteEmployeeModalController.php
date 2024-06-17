<?php

if ($_GET["status"] != "true") {

    header("location: ../View/StaffManageEmployees.php");
} else {

    session_start();
    if (!isset($_SESSION["userName"])) {
        $msg = "Please login first";
        $msg = base64_encode($msg);
        header("location: ../View/Login.php?msg=$msg");
    }

    $EmpId = $_POST["EmpId"];

    require_once "../Model/StaffDeleteEmployeeModalModel.php";
    require_once '../Commons/ECommerceDB.php';

    $thisDBConnection = new DbConnection();
    $myCon = $thisDBConnection->con;

    if (emptyInputCheck($EmpId) === true) {
        DeleteEmployee($myCon, $EmpId);
    }
}
