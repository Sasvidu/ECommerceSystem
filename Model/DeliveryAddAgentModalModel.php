<?php

require_once '../Commons/ECommerceDB.php';

function emptyInputCheck($agentName, $agentLocation, $agentAddress)
{
    if ($agentName == "") {
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

function InsertAgent($con, $agentName, $agentLocation, $agentAddress)
{

    $sql = "INSERT INTO deliveryagent(agent_name, agent_location, agent_address) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/DeliveryManageAgents.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $agentName, $agentLocation, $agentAddress);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $code = "Agent added successfully!";
    $code = base64_encode($code);
    header("location: ../View/DeliveryManageAgents.php?msg=$code");
}
