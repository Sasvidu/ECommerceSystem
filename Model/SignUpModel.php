<?php

require_once '../Commons/ECommerceDB.php';

    function emptyInputCheck($fname, $lname, $email, $dob, $nic, $address, $password, $Repassword){

        if($fname==""){
            return "First name cannot be empty!";
        }else if($lname==""){
            return "Last name cannot be empty!";
        }else if($email==""){
            return "Email cannot be empty!";
        }else if($dob==""){
            return "Date of Birth cannot be empty!";
        }else if($nic==""){
            return "NIC cannot be empty!";
        }else if($address==""){
            return "Address cannot be empty!";
        }else if($password==""){
            return "Password cannot be empty!";
        }else if($Repassword==""){
            return "Repeat password cannot be empty!";
        }else{
            return true;
        }

    }

    function userExists($con, $username){
            
        //User name === User email
        $sql = "SELECT * FROM user WHERE user_email = ?;";

        //Prepared Statement:
        $stmt = mysqli_stmt_init($con);  

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $msg = "Error: MySQL statement Failed";
            $msg = base64_encode($msg);
            header("location: ../View/SignUp.php?msg=$msg");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resultData)){
            return $row;
        }else{
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);

    }

    function nicValidator($nic){

        $length = strlen($nic);

        if($length==10){

            for ($i = 0; $i < $length-1; $i++) {
                if ( !ctype_digit($nic[$i]) ) {
                    return "Invalid NIC number.";
                }
            }

            if($nic[9]!="V"){
                return "Invalid NIC number.";
            }

            return true;

        }else if($length == 12){

            if ( !ctype_digit($nic) ){
                return "Invalid NIC number.";
            }

            return true;

        }else{

            return "Invalid NIC number.";

        }
    }

    function passwordStrengthChecker($password){

        $length = strlen($password);
        if($length <= 5){
            return "Please make the password longer than 5 characters";
        }

        $isThereNumber = false;
        for ($i = 0; $i < $length; $i++) {
            if ( ctype_digit($password[$i]) ) {
            $isThereNumber = true;
            break;
            }
        }

        if($isThereNumber == false){
            return "Please include at least one number in your password";
        }

        return true;
    }

    function passwordMatcher($password, $Repassword){

        if($password === $Repassword){
            return true;
        }else{
            return false;
        }

    }

    function InsertUser($con, $fname, $lname, $email, $dob, $nic, $address, $password){

        $sql = "INSERT INTO `user`(`user_fname`, `user_lname`, `user_dob`, `user_nic`, `user_address`, `user_email`, `user_pwd`, `user_role_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";

        $stmt = mysqli_stmt_init($con);  

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $msg = "Error: MySQL statement Failed";
            $msg = base64_encode($msg);
            header("location: ../View/SignUp.php?msg=$msg");
            exit();
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $roleNo = 2;

        mysqli_stmt_bind_param($stmt, "sssssssi", $fname, $lname, $dob, $nic, $address, $email, $hashedPassword, $roleNo);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $code = "Account Created Successfully";
        $code = base64_encode($code);
        header("location: ../View/Login.php?code=$code");

    }
