<?php

require_once '../Commons/ECommerceDB.php';

function getSafeStock($con)
{

    $sql = "SELECT * FROM stock JOIN product ON stock.stock_product_id = product.product_id WHERE stock.stock_qty_buffer < stock.stock_qty_current AND stock.stock_status = 1;";
    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/SuppliersManagePayments.php?msg=$msg");
        exit();
    }

    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    return $resultData;

    mysqli_stmt_close($stmt);
}

function getBufferStock($con)
{

    $sql = "SELECT * FROM stock JOIN product ON stock.stock_product_id = product.product_id WHERE stock.stock_qty_buffer > stock.stock_qty_current AND NOT stock.stock_qty_current = 0 AND stock.stock_status = 1;";
    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/SuppliersManagePayments.php?msg=$msg");
        exit();
    }

    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    return $resultData;

    mysqli_stmt_close($stmt);
}

function getEmptyStock($con)
{

    $sql = "SELECT * FROM stock JOIN product ON stock.stock_product_id = product.product_id WHERE stock.stock_qty_current = 0 AND stock.stock_status = 1;";
    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/SuppliersManagePayments.php?msg=$msg");
        exit();
    }

    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    return $resultData;

    mysqli_stmt_close($stmt);
}
