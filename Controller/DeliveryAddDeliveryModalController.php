<?php

if (!isset($_GET["status"])) {

?>
    <script>
        window.location = "../View/DeliveryManageDeliveries.php"
    </script>
<?php
    exit();
} else {

    session_start();
    if (!isset($_SESSION["userName"])) {
        $msg = "Please login first";
        $msg = base64_encode($msg);
        header("location: ../View/Login.php?msg=$msg");
    }

    $agentId = $_POST["Agent"];

    $OGDeliveryDate = $_POST["DeliveryDate"];
    $OGDeliveryDate = strval($OGDeliveryDate);
    $deliveryDate = date("Y-m-d", strtotime($OGDeliveryDate));

    $todayDate = date("Y-m-d");

    require_once "../Commons/ECommerceDB.php";
    require_once "../Model/DeliveryAddDeliveryModalModel.php";

    $thisDBConnection = new DbConnection();
    $myCon = $thisDBConnection->con;

    if (emptyInputCheck($agentId, $OGDeliveryDate, $deliveryDate, $todayDate) === true) {
        InsertDelivery($myCon, $deliveryDate, $agentId);
    }
}

?>