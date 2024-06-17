<?php

if (!isset($_GET["status"])) {

    header("location: ../View/Staff.php");
    exit();
} else {

    session_start();
    if (!isset($_SESSION["userName"])) {
        $msg = "Please login first";
        $msg = base64_encode($msg);
        header("location: ../View/Login.php?msg=$msg");
    }

    $Year = date("Y");;
    $Month = date("n");

    $_SESSION["Year"] = $Year;
    $_SESSION["Month"] = $Month;

    header("location: ../View/StaffViewPayroll.php?status=true");
}
