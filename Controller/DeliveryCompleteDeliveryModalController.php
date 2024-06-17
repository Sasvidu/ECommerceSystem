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
    $completedDate = date("Y-m-d");

    require_once "../Model/DeliveryCompleteDeliveryModalModel.php";
    require_once '../Commons/ECommerceDB.php';

    $thisDBConnection = new DbConnection();
    $myCon = $thisDBConnection->con;

    $deliveryRow = deliveryExists($myCon, $id);
    $dispatchedDate = $deliveryRow['delivery_dispatched_date'];

    if(InputCheck($completedDate, $dispatchedDate) === true){
        CompleteDelivery($myCon, $id, $completedDate);
    }

}
