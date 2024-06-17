<?php

require_once '../Commons/ECommerceDB.php';

function emptyInputCheck($agentId, $OGDeliverydate, $deliveryDate, $todayDate)
{
    if ($agentId == "Unspecified") {
        $msg = "Please select an agent";
        $msg = base64_encode($msg);
        header("location: ../View/DeliveryManageDeliveries.php?msg=$msg");
    } else if ($OGDeliverydate == "") {
        $msg = "Delivery date cannot be empty!";
        $msg = base64_encode($msg);
        header("location: ../View/DeliveryManageDeliveries.php?msg=$msg");
    } else if ($todayDate >= $deliveryDate) {
        $msg = "The delivery date must be after today";
        $msg = base64_encode($msg);
        header("location: ../View/DeliveryManageDeliveries.php?msg=$msg");
    } else {
        return true;
    }
}

function InsertDelivery($con, $deliveryDate, $agentId)
{

    $sql = "INSERT INTO delivery(delivery_scheduled_date, delivery_agent_id) VALUES (?, ?);";
    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/DeliveryManageDeliveries.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $deliveryDate, $agentId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $code = "Delivery scheduled successfully!";
    $code = base64_encode($code);
    header("location: ../View/DeliveryManageDeliveries.php?msg=$code");
}
