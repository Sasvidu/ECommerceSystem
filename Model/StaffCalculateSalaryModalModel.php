<?php

require_once '../Commons/ECommerceDB.php';

function getJobSalary($con, $JobId)
{
    $sql = "SELECT job_salary FROM job WHERE job_id = ?;";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/Staff.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $JobId);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        $jobSalary = $row["job_salary"];
        return $jobSalary;
    } else {
        $msg = "Error: Couldn't fetch designation salary from the database";
        $msg = base64_encode($msg);
        header("location: ../View/Staff.php?msg=$msg");
        exit();
    }

    mysqli_stmt_close($stmt);
}

function getJobOT($con, $JobId)
{
    $sql = "SELECT job_OTPay FROM job WHERE job_id = ?;";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/Staff.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $JobId);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        $jobSalary = $row["job_OTPay"];
        return $jobSalary;
    } else {
        $msg = "Error: Couldn't fetch designation salary from the database";
        $msg = base64_encode($msg);
        header("location: ../View/Staff.php?msg=$msg");
        exit();
    }

    mysqli_stmt_close($stmt);
}

function InputCheck($EmpId, $WorkedDays, $OTHours, $Year, $Month)
{

    if ($EmpId == "Unspecified") {
        $msg = "Employee name cannot be empty!";
        $msg = base64_encode($msg);
        header("location: ../View/Staff.php?msg=$msg");
    } else if ($WorkedDays == "") {
        $msg = "Worked days cannot be empty!";
        $msg = base64_encode($msg);
        header("location: ../View/Staff.php?msg=$msg");
    } else if ($OTHours == "") {
        $msg = "Over time hours cannot be empty!";
        $msg = base64_encode($msg);
        header("location: ../View/Staff.php?msg=$msg");
    } else if ($WorkedDays < 0) {
        $msg = "Invalied Worked days!";
        $msg = base64_encode($msg);
        header("location: ../View/Staff.php?msg=$msg");
    } else if ($Year < 2020) {
        $msg = "Invalid year!";
        $msg = base64_encode($msg);
        header("location: ../View/Staff.php?msg=$msg");
    } else if ($Month < 1 || $Month > 12) {
        $msg = "Invalid month!";
        $msg = base64_encode($msg);
        header("location: ../View/Staff.php?msg=$msg");
    } else {
        return true;
    }
}

function calculateSalary($Salary, $OTPay, $DaysWorked, $OTHours)
{
    if ($DaysWorked < 10) {
        //Replaceable logic
        return 0.00;
    } else {
        $OTPayment = $OTHours * $OTPay;
        $PayrollAmount = $Salary + $OTPayment;
        return $PayrollAmount;
    }
}

function payrollExistsRe($con, $EmpId, $Year, $Month)
{
    $sql = "SELECT * FROM payroll WHERE payroll_emp_id = ? AND payroll_year = ? AND payroll_month = ? AND payroll_status = 1;";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/Staff.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $EmpId, $Year, $Month);
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

function UpdatePayroll($con, $EmpId, $Year, $Month, $WorkedDays, $OTHours, $Amount){

    $sql = "UPDATE payroll SET payroll_days_attended = ?, payroll_OTHours = ?, payroll_amount = ?, payroll_paid_status = 1 WHERE payroll_emp_id = ? AND payroll_year = ? AND payroll_month = ? AND payroll_status = 1;";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/Staff.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssss", $WorkedDays, $OTHours, $Amount, $EmpId, $Year, $Month);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $code = "Employee updated to the payroll successfully";
    $code = base64_encode($code);
    header("location: ../View/Staff.php?msg=$code");

}

function InsertPayroll($con, $EmpId, $Year, $Month, $WorkedDays, $OTHours, $Amount){
    
    $sql = "INSERT INTO payroll(payroll_emp_id, payroll_year, payroll_month, payroll_days_attended, payroll_OTHours, payroll_amount, payroll_paid_status) VALUES (?, ?, ?, ?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/Staff.php?msg=$msg");
        exit();
    }

    $paidStatus = 1;

    mysqli_stmt_bind_param($stmt, "ssssssi", $EmpId, $Year, $Month, $WorkedDays, $OTHours, $Amount, $paidStatus);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $code = "Employee inserted to the payroll successfully";
    $code = base64_encode($code);
    header("location: ../View/Staff.php?msg=$code");

}

