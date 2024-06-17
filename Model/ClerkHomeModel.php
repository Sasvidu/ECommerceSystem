<?php

require_once "../Commons/ECommerceDB.php";

function getMonthSales($con, $year, $month)
{
    $totalSalesMonth = 0;
    $sql = "SELECT * FROM sale WHERE MONTH(sale_date) = ? AND YEAR(sale_date) = ? AND sale_status=1;";
    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/ClerkHome.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $month, $year);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rows = mysqli_num_rows($result);

    if ($rows > 0) {

        while ($sale = mysqli_fetch_assoc($result)) {
            $totalSalesMonth += $sale['sale_payment'];
        }
    }

    mysqli_stmt_close($stmt);
    return $totalSalesMonth;
}

function getYearSales($con, $year)
{
    $totalSalesYear = 0;
    $sql = "SELECT * FROM sale WHERE YEAR(sale_date) = ? AND sale_status=1;";
    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/ClerkHome.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $year);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rows = mysqli_num_rows($result);

    if ($rows > 0) {

        while ($sale = mysqli_fetch_assoc($result)) {
            $totalSalesYear += $sale['sale_payment'];
        }
    }

    mysqli_stmt_close($stmt);
    return $totalSalesYear;
}


function getTotalPayment($con, $year, $month)
{
    $totalPayment = 0;
    $sql = "SELECT * FROM payment WHERE MONTH(payment_date) = ? AND YEAR(payment_date) = ? AND payment_status=1;";
    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/ClerkHome.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $month, $year);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rows = mysqli_num_rows($result);

    if ($rows > 0) {

        while ($payment = mysqli_fetch_assoc($result)) {
            $totalPayment += $payment['payment_amount'];
        }
    }

    mysqli_stmt_close($stmt);
    return $totalPayment;
}

function getTotalPendingSalaries($con, $year, $month)
{

    $sql = "SELECT * FROM payroll WHERE payroll_year = ? AND payroll_month = ? AND payroll_paid_status = 0 AND payroll_status = 1;";
    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/ClerkHome.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $year, $month);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rows = mysqli_num_rows($result);
    mysqli_stmt_close($stmt);

    return $rows;
}

function userExists($con, $username)
{

    //User name === User email
    $sql = "SELECT * FROM user WHERE user_email = ?;";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/ClerkHome.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
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


function getImage($con, $username, $userId)
{

    $userExists = userExists($con, $username);

    if ($userExists == false) {
        $msg = "Error: There was an error loading your image";
        $msg = base64_encode($msg);
        header("location: ../View/ClerkHome.php?msg=$msg");
        exit();
    }

    $dbImg = $userExists['user_image'];

    if ($dbImg == "N/A") {
        echo "<img src='../Commons/Profiles/ProfileDefault.png' alt='User image' id='UserImage'>";
    } else {
        echo "<img src='../Commons/Profiles/" . $dbImg . "' alt='User image' id='UserImage'>";
    }
}
