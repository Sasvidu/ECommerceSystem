<?php

require_once "../Commons/ECommerceDB.php";

function emptyInputCheck($JobId)
{

    if ($JobId == "") {
        $msg = "Error loading designation details";
        $msg = base64_encode($msg);
        header("location: ../View/StaffManageJobs.php?msg=$msg");
    } else {
        return true;
    }
}

function DeleteJob($con, $JobId)
{
    $sql = "UPDATE job SET job_status = 0 WHERE job_id = ?";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/StaffManageJobs.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $JobId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $code = "Designation deleted successfully!";
    $code = base64_encode($code);
    header("location: ../View/StaffManageJobs.php?msg=$code");
}
