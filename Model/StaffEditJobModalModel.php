<?php

require_once "../Commons/ECommerceDB.php";

function InputCheck($JobId, $JobName, $JobDescription, $JobDepartment, $JobSalary, $JobOT, $JobSalaryOG, $JobOTOG)
{
    if ($JobId < 0) {
        $msg = "There was an error loading the details of the designation. Please try again";
        $msg = base64_encode($msg);
        header("location: ../View/StaffManageJobs.php?msg=$msg");
    } else if ($JobName == "") {
        $msg = "Designation name cannot be empty!";
        $msg = base64_encode($msg);
        header("location: ../View/StaffManageJobs.php?msg=$msg");
    } else if ($JobDescription == "") {
        $msg = "Designation description cannot be empty!";
        $msg = base64_encode($msg);
        header("location: ../View/StaffManageJobs.php?msg=$msg");
    } else if ($JobDepartment == "") {
        $msg = "Designation department cannot be empty!";
        $msg = base64_encode($msg);
        header("location: ../View/StaffManageJobs.php?msg=$msg");
    } else if ($JobSalaryOG == "") {
        $msg = "Designation salary cannot be empty!";
        $msg = base64_encode($msg);
        header("location: ../View/StaffManageJobs.php?msg=$msg");
    } else if ($JobOTOG == "") {
        $msg = "Designation OT cannot be empty!";
        $msg = base64_encode($msg);
        header("location: ../View/StaffManageJobs.php?msg=$msg");
    } else if ($JobSalary < $JobOT) {
        $msg = "Designation OT cannot be greater than job salary!";
        $msg = base64_encode($msg);
        header("location: ../View/StaffManageJobs.php?msg=$msg");
    } else if ($JobOT > 10000.00) {
        $msg = "Designation OT cannot exceed 10000.00 per hour";
        $msg = base64_encode($msg);
        header("location: ../View/StaffManageJobs.php?msg=$msg");
    } else {
        return true;
    }
}

function UpdateJob($con, $JobName, $JobDescription, $JobDepartment, $JobSalary, $JobOT, $JobId)
{
    $sql = "UPDATE job SET job_name = ?, job_description = ?, job_department = ?, job_salary = ?, job_OTPay = ? WHERE job_id = ?;";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/StaffManageJobs.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssss", $JobName, $JobDescription, $JobDepartment, $JobSalary, $JobOT, $JobId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $code = "Designation updated successfully!";
    $code = base64_encode($code);
    header("location: ../View/StaffManageJobs.php?msg=$code");
}
