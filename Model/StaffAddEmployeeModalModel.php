<?php

require_once '../Commons/ECommerceDB.php';

function emptyInputCheck($EmpFName, $EmpLName, $EmpAddress, $EmpDOBOG, $EmpNIC, $EmpEmail1, $EmpTel1, $EmpJobId)
{
    if ($EmpFName == "") {
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

function employeeExists($con, $EmpNIC)
{
    $sql = "SELECT * FROM employee WHERE emp_nic = ? AND emp_status = 1;";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/Staff.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $EmpNIC);
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

function InsertEmployee($con, $EmpFName, $EmpLName, $EmpAddress, $EmpDOB, $EmpNIC, $EmpEmail1, $EmpEmail2, $EmpTel1, $EmpTel2, $EmpJobId)
{
    $sql = "INSERT INTO employee(emp_fname, emp_lname, emp_address, emp_dob, emp_nic, emp_email1, emp_email2, emp_telno1, emp_telno2, emp_job_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/Staff.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssssssss", $EmpFName, $EmpLName, $EmpAddress, $EmpDOB, $EmpNIC, $EmpEmail1, $EmpEmail2, $EmpTel1, $EmpTel2, $EmpJobId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $code = "Employee Added Successfully";
    $code = base64_encode($code);
    header("location: ../View/Staff.php?msg=$code");
}

function InsertEmployeeLower($con, $EmpFName, $EmpLName, $EmpAddress, $EmpDOB, $EmpNIC, $EmpEmail1, $EmpTel1, $EmpJobId)
{
    $sql = "INSERT INTO employee(emp_fname, emp_lname, emp_address, emp_dob, emp_nic, emp_email1, emp_telno1, emp_job_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/Staff.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssssss", $EmpFName, $EmpLName, $EmpAddress, $EmpDOB, $EmpNIC, $EmpEmail1, $EmpTel1, $EmpJobId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $code = "Employee Added Successfully";
    $code = base64_encode($code);
    header("location: ../View/Staff.php?msg=$code");
}

function InsertEmployeeEmail($con, $EmpFName, $EmpLName, $EmpAddress, $EmpDOB, $EmpNIC, $EmpEmail1, $EmpEmail2, $EmpTel1, $EmpJobId)
{
    $sql = "INSERT INTO employee(emp_fname, emp_lname, emp_address, emp_dob, emp_nic, emp_email1, emp_email2, emp_telno1, emp_job_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/Staff.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssssssss", $EmpFName, $EmpLName, $EmpAddress, $EmpDOB, $EmpNIC, $EmpEmail1, $EmpEmail2, $EmpTel1, $EmpJobId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $code = "Employee Added Successfully";
    $code = base64_encode($code);
    header("location: ../View/Staff.php?msg=$code");
}

function InsertEmployeeTel($con, $EmpFName, $EmpLName, $EmpAddress, $EmpDOB, $EmpNIC, $EmpEmail1, $EmpTel1, $EmpTel2, $EmpJobId)
{
    $sql = "INSERT INTO employee(emp_fname, emp_lname, emp_address, emp_dob, emp_nic, emp_email1, emp_email2, emp_telno1, emp_job_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/Staff.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssssssss", $EmpFName, $EmpLName, $EmpAddress, $EmpDOB, $EmpNIC, $EmpEmail1, $EmpTel1, $EmpTel2, $EmpJobId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $code = "Employee Added Successfully";
    $code = base64_encode($code);
    header("location: ../View/Staff.php?msg=$code");
}
