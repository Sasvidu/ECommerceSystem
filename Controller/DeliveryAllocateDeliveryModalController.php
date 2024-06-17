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

    $saleId = $_POST["SaleId"];
    $deliveryId = $_POST["DeliveryId"];
    $allocationDate = date("Y-m-d");

    require_once "../Commons/ECommerceDB.php";
    require_once "../Model/DeliveryAllocateDeliveryModalModel.php";

    $thisDBConnection = new DbConnection();
    $myCon = $thisDBConnection->con;

    $saleRow = saleExists($myCon, $saleId);
    $saleDate = $saleRow['sale_date'];

    if (InputCheck($saleId, $deliveryId, $allocationDate, $saleDate) === true) {
        AllocateOrderToDelivery($myCon, $saleId, $deliveryId, $allocationDate);
    }
}

?>