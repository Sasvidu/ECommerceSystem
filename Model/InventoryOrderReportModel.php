<?php

require_once '../Commons/ECommerceDB.php';

function orderExists($con, $orderId)
{

    $sql = "SELECT * FROM stockorder WHERE (order_id = ? AND order_status=1);";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/InventoryManageOrders.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $orderId);
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

function productExists($con, $productId)
{

    $sql = "SELECT * FROM product WHERE product_id = ?;";
    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/InventoryManageOrders.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $productId);
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

function supplierExists($con, $supplierId)
{

    $sql = "SELECT * FROM supplier WHERE supplier_id = ?;";
    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/InventoryManageOrders.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $supplierId);
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
