<?php

require_once "../Commons/ECommerceDB.php";

function emptyInputCheck($EmpId)
{

    if ($EmpId == "") {
        $msg = "Error loading employee details";
        $msg = base64_encode($msg);
        header("location: ../View/StaffManageEmployees.php?msg=$msg");
    } else {
        return true;
    }
}

function DeleteEmployee($con, $EmpId)
{
    $sql = "UPDATE employee SET emp_status = 0 WHERE emp_id = ?";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/StaffManageEmployees.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $EmpId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $code = "Employee deleted successfully!";
    $code = base64_encode($code);
    header("location: ../View/StaffManageEmployees.php?msg=$code");
}
