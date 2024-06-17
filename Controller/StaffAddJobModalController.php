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

    $JobName = $_POST['JobName'];
    $JobDescription = $_POST['JobDescription'];
    $JobDepartment = $_POST['JobDepartment'];
    $JobSalaryOG = $_POST['JobSalary'];
    $JobOTOG = $_POST['JobOT'];

    $JobSalary = number_format((float)$JobSalaryOG, 2, '.', '');
    $JobOT = number_format((float)$JobOTOG, 2, '.', '');

    require_once "../Model/StaffAddJobModalModel.php";
    require_once '../Commons/ECommerceDB.php';

    $thisDBConnection = new DbConnection();
    $myCon = $thisDBConnection->con;

    if (InputCheck($JobName, $JobDescription, $JobDepartment, $JobSalary, $JobOT, $JobSalaryOG, $JobOTOG) === true) {
        if (JobExists($myCon, $JobName, $JobDepartment) === false) {
            InsertJob($myCon, $JobName, $JobDescription, $JobDepartment, $JobSalary, $JobOT);
        } else {
            $msg = "Job already exists!";
            $msg = base64_encode($msg);
            header("location: ../View/Staff.php?msg=$msg");
        }
    }
}
