<?php

require_once '../Commons/ECommerceDB.php';

    function emptyInputCheck($email, $nic, $password, $Repassword){

        if($email==""){
            return "Email cannot be empty!";
        }else if($nic==""){
            return "NIC cannot be empty!";
        }else if($password==""){
            return "Password cannot be empty!";
        }else if($Repassword==""){
            return "Repeat password cannot be empty!";
        }else{
            return true;
        }

    }

    function userExists($con, $username){
            
        $sql = "SELECT * FROM user WHERE user_email = ?;";

        $stmt = mysqli_stmt_init($con);  

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $msg = "Error: MySQL statement Failed";
            $msg = base64_encode($msg);
            header("location: ../View/UserPasswordReset.php?msg=$msg");
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
                    return "Invalid NIC number!";
                }
            }

            if($nic[9]!="V"){
                return "Invalid NIC number!";
            }

            return true;

        }else if($length == 12){

            if ( !ctype_digit($nic) ){
                return "Invalid NIC number!";
            }

            return true;

        }else{

            return "Invalid NIC number!";

        }
    }

    function passwordStrengthChecker($password){

        $length = strlen($password);
        if($length <= 5){
            return "Please make the password longer than 5 characters.";
        }

        $isThereNumber = false;
        for ($i = 0; $i < $length; $i++) {
            if ( ctype_digit($password[$i]) ) {
            $isThereNumber = true;
            break;
            }
        }

        if($isThereNumber == false){
            return "Please include at least one number in your password.";
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

    function UpdatePassword($con, $email, $nic, $password){

        $userExists = userExists($con, $email);

        if($userExists == false){
            $msg = "Invalid username";
            $msg = base64_encode($msg);
            header("location: ../View/UserPasswordReset.php?msg=$msg");
            exit();
        }

        $dbNIC = $userExists['user_nic'];

        if($nic !== $dbNIC){
            $msg = "NIC does not match";
            $msg = base64_encode($msg);
            header("location: ../View/UserPasswordReset.php?msg=$msg");
            exit();
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE user SET user_pwd = ? WHERE user_email = ?;";

        $stmt = mysqli_stmt_init($con);  

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $msg = "Error: MySQL statement Failed";
            $msg = base64_encode($msg);
            header("location: ../View/UserPasswordReset.php?msg=$msg");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss", $hashedPassword, $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $code = "Password Updated Successfully";
        $code = base64_encode($code);
        header("location: ../View/Login.php?code=$code");

    }

?>
