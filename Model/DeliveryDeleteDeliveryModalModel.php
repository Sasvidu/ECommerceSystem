<?php

require_once '../Commons/ECommerceDB.php';

function DeleteAgent($con, $deliveryId)
{

    $sql = "UPDATE delivery SET delivery_status = 0 WHERE delivery_id = ?";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement for updating delivery Failed";
        $msg = base64_encode($msg);
        header("location: ../View/DeliveryManageDeliveries.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $deliveryId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);


    $sqla = "UPDATE sale SET sale_delivery_id = NULL WHERE sale_delivery_id = ?";

    $stmta = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmta, $sqla)) {
        $msg = "Error: MySQL statement for updating sales Failed";
        $msg = base64_encode($msg);
        header("location: ../View/DeliveryManageDeliveries.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmta, "s", $deliveryId);
    mysqli_stmt_execute($stmta);
    mysqli_stmt_close($stmta);

    $code = "Delivery deleted successfully!";
    $code = base64_encode($code);
    header("location: ../View/DeliveryManageDeliveries.php?msg=$code");
}
