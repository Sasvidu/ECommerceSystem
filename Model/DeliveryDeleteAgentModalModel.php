<?php

require_once '../Commons/ECommerceDB.php';

function DeleteAgent($con, $id)
{

    $sql = "UPDATE deliveryagent SET agent_status = 0 WHERE agent_id = ?";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/DeliveryManageAgents.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $code = "Agent deleted successfully!";
    $code = base64_encode($code);
    header("location: ../View/DeliveryManageAgents.php?msg=$code");
}
