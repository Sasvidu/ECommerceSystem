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

    $agentId = $_POST['AgentId'];
    $agentName = $_POST['AgentName'];
    $agentLocation = $_POST['AgentLocation'];
    $agentAddress = $_POST['AgentAddress'];

    require_once "../Model/DeliveryEditAgentModalModel.php";
    require_once '../Commons/ECommerceDB.php';

    $thisDBConnection = new DbConnection();
    $myCon = $thisDBConnection->con;

    if (emptyInputCheck($agentId, $agentName, $agentLocation, $agentAddress) === true) {
        UpdateProduct($myCon, $agentId, $agentName, $agentLocation, $agentAddress);
    }
}
