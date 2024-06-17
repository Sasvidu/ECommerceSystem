<?php

require_once '../Commons/ECommerceDB.php';

function emptyInputCheck($fname, $lname, $email, $address, $nic, $dob, $role){

    if($email == ""){
        $msg = "Please select a user first!";
        $msg = base64_encode($msg);
        header("location: ../View/UsersEditUser.php?msg=$msg");
        exit();
    }else if($fname==""){
        $msg = "First name cannot be empty!";
        $msg = base64_encode($msg);
        header("location: ../View/UsersEditUser.php?msg=$msg");
        exit();
    }else if($lname==""){
        $msg = "Last name cannot be empty!";
        $msg = base64_encode($msg);
        header("location: ../View/UsersEditUser.php?msg=$msg");
        exit();
    }else if($address==""){
        $msg = "Address cannot be empty!";
        $msg = base64_encode($msg);
        header("location: ../View/UsersEditUser.php?msg=$msg");
        exit();
    }else if($nic==""){
        $msg = "NIC cannot be empty!";
        $msg = base64_encode($msg);
        header("location: ../View/UsersEditUser.php?msg=$msg");
        exit();
    }else if($dob==""){
        $msg = "Date of Birth cannot be empty!";
        $msg = base64_encode($msg);
        header("location: ../View/UsersEditUser.php?msg=$msg");
        exit();
    }else if($role==""){
        $msg = "User's role must be selected!";
        $msg = base64_encode($msg);
        header("location: ../View/UsersEditUser.php?msg=$msg");
        exit();
    }else{
        return true;
    }

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

function nicExists($con, $nic, $email){

    $sql = "SELECT * FROM user WHERE user_nic = ? AND user_status=1 AND NOT(user_email = ?);";

    $stmt = mysqli_stmt_init($con);  

    if(!mysqli_stmt_prepare($stmt, $sql)){
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/UsersEditUser.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $nic, $email);
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

function UpdateUser($con, $fname, $lname, $address, $nic, $dob, $role, $email){

    $sql = "UPDATE user SET user_fname = ?, user_lname = ?, user_address = ?, user_dob = ?, user_nic = ?, user_role_id = ? WHERE user_email = ? AND user_status=1;";

    $stmt = mysqli_stmt_init($con);  

    if(!mysqli_stmt_prepare($stmt, $sql)){
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/UsersEditUser.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssssss", $fname, $lname, $address, $dob, $nic, $role, $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $code = "User Updated Successfully";
    $code = base64_encode($code);
    header("location: ../View/UsersEditUser.php?msg=$code");

}