<?php

if ($_GET["status"] != "true") {

    header("location: ../View/StaffManageJobs.php");
} else {

    session_start();
    if (!isset($_SESSION["userName"])) {
        $msg = "Please login first";
        $msg = base64_encode($msg);
        header("location: ../View/Login.php?msg=$msg");
    }

    $JobId = $_POST["JobId"];

    require_once "../Model/StaffDeleteJobModalModel.php";
    require_once '../Commons/ECommerceDB.php';

    $thisDBConnection = new DbConnection();
    $myCon = $thisDBConnection->con;

    if (emptyInputCheck($JobId) === true) {
        DeleteJob($myCon, $JobId);
    }
}
