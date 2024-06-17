<?php

if ($_GET["status"] != "true") {

    header("location: ../View/UserMyProfile.php");

} else {

    session_start();
    if (!isset($_SESSION["userName"])) {
        $msg = "Please login first";
        $msg = base64_encode($msg);
        header("location: ../View/Login.php?msg=$msg");
    }

    $UserId = $_POST['UserId'];
    $UserFName = $_POST['UserFName'];
    $UserLName = $_POST['UserLName'];
    $UserEmail = $_POST['UserEmail'];
    $UserAddress = $_POST['UserAddress'];

    $UserDOBOG = $_POST['UserDOB'];
    $UserDOBOG = strval($UserDOBOG);
    $UserDOB = date("Y-m-d", strtotime($UserDOBOG));

    $UserImage = $_FILES['UserImage'];
    $UserImageName = $UserImage['name'];

    require_once '../Commons/ECommerceDB.php';
    require_once '../Model/UserMyProfileModel.php';

    $thisDBConnection = new DbConnection();
    $myCon = $thisDBConnection->con;

    if (emptyInputCheck($UserId, $UserFName, $UserLName, $UserEmail, $UserAddress, $UserDOBOG) === true) {

        echo "Success";

        if (emailExists($myCon, $UserEmail, $UserId) === false) {

            if (imageCheck($UserImageName) === true) {
                UpdateUserUpper($myCon, $UserId, $UserFName, $UserLName, $UserEmail, $UserAddress, $UserDOB, $UserImage);
            }else{
                UpdateUserLower($myCon, $UserId, $UserFName, $UserLName, $UserEmail, $UserAddress, $UserDOB);
            }

        } else {

            $msg = "Sorry, this email has already been taken by another user.";
            $msg = base64_encode($msg);
            header("location: ../View/UserMyProfile.php?msg=$msg");

        }

    }

}
