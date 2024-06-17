<?php

if (!isset($_GET["status"])) {
    header("location: ../View/StaffManageEmployees.php");
    exit();
} else {
    session_start();
    if (!isset($_SESSION["userName"])) {
        $msg = "Please login first";
        $msg = base64_encode($msg);
        header("location: ../View/Login.php?msg=$msg");
    }

    $EmpId = $_POST["EmpId"];
    $EmpFName = $_POST["EmpFName"];
    $EmpLName = $_POST["EmpLName"];
    $EmpAddress = $_POST["EmpAddress"];
    $EmpDOBOG = $_POST["EmpDOB"];
    $EmpNIC = $_POST["EmpNIC"];
    $EmpEmail1 = $_POST["EmpEmail1"];
    $EmpEmail2 = $_POST["EmpEmail2"];
    $EmpTel1 = $_POST["EmpTel1"];
    $EmpTel2 = $_POST["EmpTel2"];
    $EmpJobId = $_POST["EmpJobId"];

    $EmpDOBOG = strval($EmpDOBOG);
    $EmpDOB = date("Y-m-d", strtotime($EmpDOBOG));

    require_once "../Model/StaffEditEmployeeModalModel.php";
    require_once "../Commons/ECommerceDB.php";

    $thisDBConnection = new DbConnection();
    $myCon = $thisDBConnection->con;

    try {

        if (emptyInputCheck($EmpId, $EmpFName, $EmpLName, $EmpAddress, $EmpDOBOG, $EmpNIC, $EmpEmail1, $EmpTel1, $EmpJobId) !== true) {
            throw new Exception(emptyInputCheck($EmpId, $EmpFName, $EmpLName, $EmpAddress, $EmpDOBOG, $EmpNIC, $EmpEmail1, $EmpTel1, $EmpJobId));
        }
        if (nicValidator($EmpNIC) !== true) {
            throw new Exception(nicValidator($nic));
        }

        if ($EmpEmail2 != "" && $EmpTel2 != "") {
            UpdateEmployee($myCon, $EmpFName, $EmpLName, $EmpAddress, $EmpDOB, $EmpNIC, $EmpEmail1, $EmpEmail2, $EmpTel1, $EmpTel2, $EmpJobId, $EmpId);
        } else if ($EmpEmail2 != "") {
            UpdateEmployeeEmail($myCon, $EmpFName, $EmpLName, $EmpAddress, $EmpDOB, $EmpNIC, $EmpEmail1, $EmpEmail2, $EmpTel1, $EmpJobId, $EmpId);
        } else if ($EmpTel2 != "") {
            UpdateEmployeeTel($myCon, $EmpFName, $EmpLName, $EmpAddress, $EmpDOB, $EmpNIC, $EmpEmail1, $EmpTel1, $EmpTel2, $EmpJobId, $EmpId);
        } else {
            UpdateEmployeeLower($myCon, $EmpFName, $EmpLName, $EmpAddress, $EmpDOB, $EmpNIC, $EmpEmail1, $EmpTel1, $EmpJobId, $EmpId);
        }
    } catch (exception $ex) {

        $msg = $ex->getMessage();
        $msg = base64_encode($msg);

        header("location: ../View/StaffManageEmployees.php?msg=$msg");

        exit();
    }
}
