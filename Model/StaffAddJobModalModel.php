<?php

function InputCheck($JobName, $JobDescription, $JobDepartment, $JobSalary, $JobOT, $JobSalaryOG, $JobOTOG)
{
    if ($JobName == "") {
        $msg = "Designation name cannot be empty!";
        $msg = base64_encode($msg);
        header("location: ../View/Staff.php?msg=$msg");
    } else if ($JobDescription == "") {
        $msg = "Designation description cannot be empty!";
        $msg = base64_encode($msg);
        header("location: ../View/Staff.php?msg=$msg");
    } else if ($JobDepartment == "") {
        $msg = "Designation department cannot be empty!";
        $msg = base64_encode($msg);
        header("location: ../View/Staff.php?msg=$msg");
    } else if ($JobSalaryOG == "") {
        $msg = "Designation salary cannot be empty!";
        $msg = base64_encode($msg);
        header("location: ../View/Staff.php?msg=$msg");
    } else if ($JobOTOG == "") {
        $msg = "Designation OT cannot be empty!";
        $msg = base64_encode($msg);
        header("location: ../View/Staff.php?msg=$msg");
    } else if ($JobSalary < $JobOT) {
        $msg = "Designation OT cannot be greater than job salary!";
        $msg = base64_encode($msg);
        header("location: ../View/Staff.php?msg=$msg");
    } else if ($JobOT > 10000.00) {
        $msg = "Designation OT cannot exceed 10000.00 per hour";
        $msg = base64_encode($msg);
        header("location: ../View/Staff.php?msg=$msg");
    } else {
        return true;
    }
}

function JobExists($con, $JobName, $JobDepartment)
{
    $sql = "SELECT * FROM job WHERE (job_name = ? AND job_department = ?);";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/Staff.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $JobName, $JobDepartment);
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

function InsertJob($con, $JobName, $JobDescription, $JobDepartment, $JobSalary, $JobOT)
{
    $sql = "INSERT INTO job(job_name, job_description, job_department, job_salary, job_OTPay) VALUES (?, ?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/Staff.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssss", $JobName, $JobDescription, $JobDepartment, $JobSalary, $JobOT);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $code = "Designation added successfully!";
    $code = base64_encode($code);
    header("location: ../View/Staff.php?msg=$code");
}
