<?php

if ($_GET["status"] != "true") {

    header("location: ../View/UsersEditUser.php");

} else {

    session_start();
    if (!isset($_SESSION["userName"])) {
        $msg = "Please login first";
        $msg = base64_encode($msg);
        header("location: ../View/Login.php?msg=$msg");
    }

    $UserFName = $_POST['UserFName'];
    $UserLName = $_POST['UserLName'];
    $UserEmail = $_POST['UserEmail'];
    $UserNIC = $_POST['UserNIC'];
    $UserDOBOG = $_POST['UserDOB'];
    $UserRoleId = $_POST['UserRole'];
    $UserAddress = $_POST['UserAddress'];

    $UserDOBOG = strval($UserDOBOG);
    $UserDOB = date("Y-m-d", strtotime($UserDOBOG));

    require_once '../Commons/ECommerceDB.php';
    require_once '../Model/UsersEditUserModel.php';

    $thisDBConnection = new DbConnection();
    $myCon = $thisDBConnection->con;

    if (emptyInputCheck($UserFName, $UserLName, $UserEmail, $UserAddress, $UserNIC, $UserDOBOG, $UserRoleId) === true) {

        if(nicValidator($UserNIC) === true){

            if(nicExists($myCon, $UserNIC, $UserEmail) === false){

                UpdateUser($myCon, $UserFName, $UserLName, $UserAddress, $UserNIC, $UserDOB, $UserRoleId, $UserEmail);
    
            }else{
    
                $msg = "There is already a user with this NIC";
                $msg = base64_encode($msg);
                header("location: ../View/UsersEditUser.php?msg=$msg");
                exit();
    
            }

        }else{

            $msg = "Invalid NIC";
            $msg = base64_encode($msg);
            header("location: ../View/UsersEditUser.php?msg=$msg");
            exit();

        }

    }

}
