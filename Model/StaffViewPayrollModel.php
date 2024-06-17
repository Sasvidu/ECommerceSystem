<?php

require_once "../Commons/ECommerceDB.php";

function getJobName($con, $JobId)
{

    $sql = "SELECT * FROM job WHERE job_id = ?;";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/StaffViewPayroll.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $JobId);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        $jobName = $row["job_name"];
        return $jobName;
    } else {
        $msg = "Error: Couldn't fetch designation titles from the database";
        $msg = base64_encode($msg);
        header("location: ../View/StaffViewPayroll.php?msg=$msg");
        exit();
    }

    mysqli_stmt_close($stmt);
}

function getMonthName($Month)
{

    switch ($Month) {
        case 1:
            return "January";
        case 2:
            return "February";
        case 3:
            return "March";
        case 4:
            return "April";
        case 5:
            return "May";
        case 6:
            return "June";
        case 7:
            return "July";
        case 8:
            return "August";
        case 9:
            return "September";
        case 10:
            return "October";
        case 11:
            return "November";
        case 12:
            return "December";
        default:
            return $Month;
    }
}
