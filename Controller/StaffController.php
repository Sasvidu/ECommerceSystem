<?php

if (!isset($_GET["status"])) {

    header("location: ../View/Staff.php");
    exit();
} else {

    if (isset($_POST['ManageJobButton'])) {
        header("location: ../View/StaffManageJobs.php");
    } else if (isset($_POST['ManageEmpButton'])) {
        header("location: ../View/StaffManageEmployees.php");
    }
}
