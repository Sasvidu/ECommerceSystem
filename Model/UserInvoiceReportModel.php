<?php

require_once '../Commons/ECommerceDB.php';

//Retrieve sale details:
function saleExists($con, $saleId)
{

    $sql = "SELECT * FROM sale JOIN product ON sale.sale_product_id = product.product_id WHERE (sale_id = ? AND sale_status=1);";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        //Redirect and send an error meesage:
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/UserHistory.php?msg=$msg");
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


//Retrieve delivery details:
function deliveryExists($con, $deliveryId){

    $sql = "SELECT * FROM delivery JOIN deliveryagent ON delivery.delivery_agent_id = deliveryagent.agent_id WHERE delivery_id = ?;";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        //Redirect and send an error meesage:
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/UserHistory.php?msg=$msg");
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

