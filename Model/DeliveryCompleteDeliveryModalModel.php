<?php

require_once '../Commons/ECommerceDB.php';

function deliveryExists($con, $deliveryId){
    $sql = "SELECT * FROM delivery WHERE delivery_id = ? AND delivery_status=2;";

    //Prepared Statement:
    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/DeliveryManageDeliveries.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $deliveryId);
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

function InputCheck($completedDate, $dispatchedDate)
{
    if($completedDate < $dispatchedDate){
        $msg = "Completion date cannot be lower than dispatch date. There is an error with the date and time of the computer.";
        $msg = base64_encode($msg);
        header("location: ../View/DeliveryManageDeliveries.php?msg=$msg");
    }else{
        return true;
    }
}

function CompleteDelivery($con, $deliveryId, $completedDate)
{
    $sql = "UPDATE delivery SET delivery_status = 1, delivery_completed_date = ? WHERE delivery_id = ? AND delivery_status = 2";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/DeliveryManageDeliveries.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $completedDate, $deliveryId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $code = "Delivery completed successfully!";
    $code = base64_encode($code);
    header("location: ../View/DeliveryManageDeliveries.php?msg=$code");
}
