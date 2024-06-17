<?php

if ($_GET["status"] != "true") {

    header("location: ../View/DeliveryManageAgents.php");
} else {

    session_start();
    if (!isset($_SESSION["userName"])) {
        $msg = "Please login first";
        $msg = base64_encode($msg);
        header("location: ../View/Login.php?msg=$msg");
    }

    $id = $_POST['Id'];

    require_once "../Model/DeliveryDeleteAgentModalModel.php";
    require_once '../Commons/ECommerceDB.php';

    $thisDBConnection = new DbConnection();
    $myCon = $thisDBConnection->con;

    DeleteAgent($myCon, $id);
}
