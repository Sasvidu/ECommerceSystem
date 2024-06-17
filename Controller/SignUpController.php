<?php

    if($_GET["status"]!="true"){

        header("location: ../View/SignUp.php");

    }else{

        $fname = $_POST["Fname"];
        $lname = $_POST["Lname"];
        $email = $_POST["Email"];
        $dobOG = $_POST["dob"];
        $nic = $_POST["nic"];
        $address = $_POST["address"];
        $password = $_POST["password"];
        $repassword = $_POST["Repassword"];
        
        $dobOG = strval($dobOG);
        $dob = date("Y-m-d", strtotime($dobOG));

        try{
            
            require_once '../Commons/ECommerceDB.php';
            require_once '../Model/SignUpModel.php';

            $thisDBConnection = new DbConnection();
            $myCon = $thisDBConnection->con;

            if(emptyInputCheck($fname, $lname, $email, $dobOG, $nic, $address, $password, $repassword) !== true){
                throw new Exception(emptyInputCheck($fname, $lname, $email, $dobOG, $nic, $address, $password, $repassword));
            }

            if(userExists($myCon, $email) !== false){
                throw new Exception("Sorry, this email adress is already taken by another user.");
            }

            if(nicValidator($nic) !== true){
                throw new Exception(nicValidator($nic));
            }

            if(passwordStrengthChecker($password) !== true){
                throw new Exception(passwordStrengthChecker($password));
            }

            if(passwordMatcher($password, $repassword) !== true){
                throw new Exception("Passwords do not match");
            }

            InsertUser($myCon, $fname, $lname, $email, $dob, $nic, $address, $password);

        }catch(exception $ex){

            $msg = $ex->getMessage();
            $msg = base64_encode($msg);

            header("location: ../View/SignUp.php?msg=$msg");

            exit();
        }

    }
    
?>