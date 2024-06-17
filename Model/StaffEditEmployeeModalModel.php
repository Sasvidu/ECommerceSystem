<?php

require_once '../Commons/ECommerceDB.php';

function emptyInputCheck($EmpId, $EmpFName, $EmpLName, $EmpAddress, $EmpDOBOG, $EmpNIC, $EmpEmail1, $EmpTel1, $EmpJobId)
{
    if ($EmpId < 0) {
        return "There was an error loading employee details!";
    } else if ($EmpFName == "") {
        return "Employee first name cannot be empty!";
    } else if ($EmpLName == "") {
        return "Employee last name cannot be empty!";
    } else if ($EmpAddress == "") {
        return "Employee address cannot be empty!";
    } else if ($EmpDOBOG == "") {
        return "Employee date of Birth cannot be empty!";
    } else if ($EmpNIC == "") {
        return "Employee NIC cannot be empty!";
    } else if ($EmpEmail1 == "") {
        return "Employee first email cannot be empty!";
    } else if ($EmpTel1 == "") {
        return "Employee first telephone number cannot be empty!";
    } else if ($EmpJobId == "Unspecified") {
        return "Employee designation cannot be empty!";
    } else {
        return true;
    }
}

function nicValidator($EmpNIC)
{
    $length = strlen($EmpNIC);

    if ($length == 10) {

        for ($i = 0; $i < $length - 1; $i++) {
            if (!ctype_digit($EmpNIC[$i])) {
                return "Invalid NIC number!";
            }
        }

        if ($EmpNIC[9] != "V") {
            return "Invalid NIC number!";
        }

        return true;
    } else if ($length == 12) {

        if (!ctype_digit($EmpNIC)) {
            return "Invalid NIC number!";
        }
        return true;
    } else {

        return "Invalid NIC number!";
    }
}

function UpdateEmployee($con, $EmpFName, $EmpLName, $EmpAddress, $EmpDOB, $EmpNIC, $EmpEmail1, $EmpEmail2, $EmpTel1, $EmpTel2, $EmpJobId, $EmpId)
{
    $sql = "UPDATE employee SET emp_fname = ?, emp_lname = ?, emp_address = ?, emp_dob = ?, emp_nic = ?, emp_email1 = ?, emp_email2 = ?, emp_telno1 = ?, emp_telno2 = ?, emp_job_id = ? WHERE emp_id = ?;";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Upper Failed";
        $msg = base64_encode($msg);
        header("location: ../View/StaffManageEmployees.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssssssssss", $EmpFName, $EmpLName, $EmpAddress, $EmpDOB, $EmpNIC, $EmpEmail1, $EmpEmail2, $EmpTel1, $EmpTel2, $EmpJobId, $EmpId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $code = "Employee Added Successfully";
    $code = base64_encode($code);
    header("location: ../View/StaffManageEmployees.php?msg=$code");
}

function UpdateEmployeeLower($con, $EmpFName, $EmpLName, $EmpAddress, $EmpDOB, $EmpNIC, $EmpEmail1, $EmpTel1, $EmpJobId, $EmpId)
{
    $sql = "UPDATE employee SET emp_fname = ?, emp_lname = ?, emp_address = ?, emp_dob = ?, emp_nic = ?, emp_email1 = ?, emp_telno1 = ?, emp_job_id = ? WHERE emp_id = ?;";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Upper Failed";
        $msg = base64_encode($msg);
        header("location: ../View/StaffManageEmployees.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssssssss", $EmpFName, $EmpLName, $EmpAddress, $EmpDOB, $EmpNIC, $EmpEmail1, $EmpTel1, $EmpJobId, $EmpId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $code = "Employee Added Successfully";
    $code = base64_encode($code);
    header("location: ../View/StaffManageEmployees.php?msg=$code");
}

function UpdateEmployeeEmail($con, $EmpFName, $EmpLName, $EmpAddress, $EmpDOB, $EmpNIC, $EmpEmail1, $EmpEmail2, $EmpTel1, $EmpJobId, $EmpId)
{
    $sql = "UPDATE employee SET emp_fname = ?, emp_lname = ?, emp_address = ?, emp_dob = ?, emp_nic = ?, emp_email1 = ?, emp_email2 = ?, emp_telno1 = ?, emp_job_id = ? WHERE emp_id = ?;";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Upper Failed";
        $msg = base64_encode($msg);
        header("location: ../View/StaffManageEmployees.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssssssss", $EmpFName, $EmpLName, $EmpAddress, $EmpDOB, $EmpNIC, $EmpEmail1, $EmpEmail2, $EmpTel1, $EmpJobId, $EmpId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $code = "Employee Added Successfully";
    $code = base64_encode($code);
    header("location: ../View/StaffManageEmployees.php?msg=$code");
}

function UpdateEmployeeTel($con, $EmpFName, $EmpLName, $EmpAddress, $EmpDOB, $EmpNIC, $EmpEmail1, $EmpTel1, $EmpTel2, $EmpJobId, $EmpId)
{
    $sql = "UPDATE employee SET emp_fname = ?, emp_lname = ?, emp_address = ?, emp_dob = ?, emp_nic = ?, emp_email1 = ?, emp_telno1 = ?, emp_telno2 = ?, emp_job_id = ? WHERE emp_id = ?;";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Upper Failed";
        $msg = base64_encode($msg);
        header("location: ../View/StaffManageEmployees.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssssssss", $EmpFName, $EmpLName, $EmpAddress, $EmpDOB, $EmpNIC, $EmpEmail1, $EmpTel1, $EmpTel2, $EmpJobId, $EmpId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $code = "Employee Added Successfully";
    $code = base64_encode($code);
    header("location: ../View/StaffManageEmployees.php?msg=$code");
}
