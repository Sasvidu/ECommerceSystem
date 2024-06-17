<?php

if ($_GET["status"] != "true") {

    header("location: ../View/UsersPasswordReset.php");
} else {

    session_start();
    if (!isset($_SESSION["userName"])) {
        $msg = "Please login first";
        $msg = base64_encode($msg);
        header("location: ../View/Login.php?msg=$msg");
    }

    //Identity Verifires
    $NIC = $_POST['NIC'];
    $CurrentPassword = $_POST['CurrentPassword'];

    //New Password
    $NewPassword1 = $_POST['NewPassword1'];
    $NewPassword2 = $_POST['NewPassword2'];

    //Confirm Password
    $Repassword1 = $_POST['Repassword1'];
    $Repassword2 = $_POST['Repassword2'];

    //DB Identifiers
    $UserId = $_POST['UserId'];

    require_once '../Commons/ECommerceDB.php';
    require_once '../Model/UsersPasswordResetModel.php';

    $thisDBConnection = new DbConnection();
    $myCon = $thisDBConnection->con;


    if ($NIC == "" && $CurrentPassword == "") {

        $msg = "Please fill in either the NIC or the current password";
        $msg = base64_encode($msg);
        header("location: ../View/UsersPasswordReset.php?msg=$msg");

    } else if ($NIC != "" && $NewPassword1 != "" && $Repassword1 != "") {

        //NIC Change password

        if (nicValidator($NIC) !== true) {
            $msg = nicValidator($NIC);
            $msg = base64_encode($msg);
            header("location: ../View/UsersPasswordReset.php?msg=$msg");
            exit();
        }

        if (passwordStrengthChecker($NewPassword1) !== true) {
            $msg = passwordStrengthChecker($NewPassword1);
            $msg = base64_encode($msg);
            header("location: ../View/UsersPasswordReset.php?msg=$msg");
            exit();
        }

        if (passwordMatcher($NewPassword1, $Repassword1) !== true) {
            $msg = passwordMatcher($NewPassword1, $Repassword1);
            $msg = base64_encode($msg);
            header("location: ../View/UsersPasswordReset.php?msg=$msg");
            exit();
        }

        UpdatePasswordNIC($myCon, $UserId, $NIC, $NewPassword1);

    } else if ($CurrentPassword != "" && $NewPassword2 != "" && $Repassword2 != "") {

        //Current password change password

        if (passwordStrengthChecker($NewPassword2) !== true) {
            $msg = passwordStrengthChecker($NewPassword2);
            $msg = base64_encode($msg);
            header("location: ../View/UsersPasswordReset.php?msg=$msg");
            exit();
        }

        if (passwordMatcher($NewPassword2, $Repassword2) !== true) {
            $msg = passwordMatcher($NewPassword2, $Repassword2);
            $msg = base64_encode($msg);
            header("location: ../View/UsersPasswordReset.php?msg=$msg");
            exit();
        }

        UpdatePasswordCurrentPassword($myCon, $UserId, $CurrentPassword, $NewPassword2);

    } else {

        $msg = "Please fill in a valid combination of field to change your passsword";
        $msg = base64_encode($msg);
        header("location: ../View/UsersPasswordReset.php?msg=$msg");
    }

}
