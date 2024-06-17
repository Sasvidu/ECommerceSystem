<?php

require_once '../Commons/ECommerceDB.php';

function DispatchDelivery($con, $deliveryId, $dispatchedDate)
{

    $sql = "UPDATE delivery SET delivery_status = 2, delivery_dispatched_date = ? WHERE delivery_id = ? AND delivery_status = 3";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/DeliveryManageDeliveries.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $dispatchedDate, $deliveryId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $code = "Delivery dispatched successfully!";
    $code = base64_encode($code);
    header("location: ../View/DeliveryManageDeliveries.php?msg=$code");
}
