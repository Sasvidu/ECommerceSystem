<?php

if ($_GET["status"] != "true") {

    header("location: ../View/UsersAddUser.php");

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
    $UserDOBOG = $_POST['UserDOB'];
    $UserNIC = $_POST['UserNIC'];
    $Password = $_POST['Password'];
    $RePassword = $_POST['RePassword'];
    $UserRole = $_POST['UserRole'];
    $UserAddress = $_POST['UserAddress'];

    $UserDOBOG = strval($UserDOBOG);
    $UserDOB = date("Y-m-d", strtotime($UserDOBOG));

    try{
            
        require_once '../Commons/ECommerceDB.php';
        require_once '../Model/UsersAddUserModel.php';

        $thisDBConnection = new DbConnection();
        $myCon = $thisDBConnection->con;

        if(emptyInputCheck($UserFName, $UserLName, $UserEmail, $UserAddress, $UserDOBOG, $UserNIC, $Password, $RePassword, $UserRole) !== true){
            throw new Exception(emptyInputCheck($UserFName, $UserLName, $UserEmail, $UserAddress, $UserDOBOG, $UserNIC, $Password, $RePassword, $UserRole));
        }

        if(userExists($myCon, $UserEmail) !== false){
            throw new Exception("Sorry, this email adress is already taken by another user.");
        }

        if(nicValidator($UserNIC) !== true){
            throw new Exception(nicValidator($UserNIC));
        }

        if(passwordStrengthChecker($Password) !== true){
            throw new Exception(passwordStrengthChecker($Password));
        }

        if(passwordMatcher($Password, $RePassword) !== true){
            throw new Exception("Passwords do not match");
        }

        InsertUser($myCon, $UserFName, $UserLName, $UserEmail, $UserAddress, $UserDOB, $UserNIC, $Password, $UserRole);

    }catch(exception $ex){

        $msg = $ex->getMessage();
        $msg = base64_encode($msg);

        header("location: ../View/UsersAddUser.php?msg=$msg");

        exit();
    }

}
