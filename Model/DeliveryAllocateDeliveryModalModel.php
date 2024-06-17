<?php

require_once '../Commons/ECommerceDB.php';

function saleExists($con, $saleId)
{
    $sql = "SELECT * FROM sale WHERE sale_id = ? AND sale_delivery_id IS NULL AND sale_status=1;";

    //Prepared Statement:
    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/DeliveryAllocateDeliveries.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $saleId);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function InputCheck($saleId, $deliveryId, $allocationDate, $saleDate)
{
    if ($saleId == "") {
        $msg = "Error loading sales Id.";
        $msg = base64_encode($msg);
        header("location: ../View/DeliveryAllocateDeliveries.php?msg=$msg");
    } else if ($deliveryId == "Unspecified") {
        $msg = "Please select a delivery to acllocate the customer order";
        $msg = base64_encode($msg);
        header("location: ../View/DeliveryAllocateDeliveries.php?msg=$msg");
    } else if ($allocationDate < $saleDate){
        $msg = "Allocation date cannot be lower than sale date. There is an error with the date and time of the computer.";
        $msg = base64_encode($msg);
        header("location: ../View/DeliveryAllocateDeliveries.php?msg=$msg");
    } else {
        return true;
    }
}

function AllocateOrderToDelivery($con, $saleId, $deliveryId, $allocationDate)
{

    $sql = "UPDATE sale SET sale_delivery_id = ?, sale_delivery_allocated_date = ? WHERE sale_id = ? AND sale_status=1;";
    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/DeliveryAllocateDeliveries.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $deliveryId, $allocationDate, $saleId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sqla = "UPDATE delivery SET delivery_status=3 WHERE delivery_id = ? AND delivery_status=4;";
    $stmta = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmta, $sqla)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/DeliveryAllocateDeliveries.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmta, "s", $deliveryId);
    mysqli_stmt_execute($stmta);
    mysqli_stmt_close($stmta);

    $code = "Order allocated to delivery successfully!";
    $code = base64_encode($code);
    header("location: ../View/DeliveryAllocateDeliveries.php?msg=$code");
}
