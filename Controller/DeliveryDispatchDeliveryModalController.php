<?php

if ($_GET["status"] != "true") {

    header("location: ../View/DeliveryManageDeliveries.php");
} else {

    session_start();
    if (!isset($_SESSION["userName"])) {
        $msg = "Please login first";
        $msg = base64_encode($msg);
        header("location: ../View/Login.php?msg=$msg");
    }

    $id = $_POST['Id'];
    $dispatchedDate = date("Y-m-d");

    require_once "../Model/DeliveryDispatchDeliveryModalModel.php";
    require_once '../Commons/ECommerceDB.php';

    $thisDBConnection = new DbConnection();
    $myCon = $thisDBConnection->con;

    DispatchDelivery($myCon, $id, $dispatchedDate);
}
