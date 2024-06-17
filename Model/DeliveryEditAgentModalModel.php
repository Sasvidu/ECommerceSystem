<?php

require_once '../Commons/ECommerceDB.php';

function emptyInputCheck($agentId, $agentName, $agentLocation, $agentAddress)
{
    if ($agentId == "") {
        $msg = "Error loading Agent Id!";
        $msg = base64_encode($msg);
        header("location: ../View/DeliveryManageAgents.php?msg=$msg");
    } else if ($agentName == "") {
        $msg = "Agent name cannot be empty!";
        $msg = base64_encode($msg);
        header("location: ../View/DeliveryManageAgents.php?msg=$msg");
    } else if ($agentLocation == "") {
        $msg = "Agent location cannot be empty!";
        $msg = base64_encode($msg);
        header("location: ../View/DeliveryManageAgents.php?msg=$msg");
    } else if ($agentAddress == "") {
        $msg = "Agent address cannot be empty!";
        $msg = base64_encode($msg);
        header("location: ../View/DeliveryManageAgents.php?msg=$msg");
    } else {
        return true;
    }
}

function UpdateProduct($con, $agentId, $agentName, $agentLocation, $agentAddress)
{

    $sql = "UPDATE deliveryagent SET agent_name = ? , agent_location = ? , agent_address = ? WHERE agent_id = ?";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/DeliveryManageAgents.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssss", $agentName, $agentLocation, $agentAddress, $agentId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $code = "Agent updated successfully!";
    $code = base64_encode($code);
    header("location: ../View/DeliveryManageAgents.php?msg=$code");
}
