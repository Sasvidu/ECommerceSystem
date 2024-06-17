<?php

require_once '../Commons/ECommerceDB.php';

//Read the user tuple from the database:
function userExists($con, $username)
{

    //User name === User email
    $sql = "SELECT * FROM user WHERE user_email = ?;";

    //Prepared Statement:
    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/Login.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

//Log the user into the system:
function loginUser($con, $username, $password)
{

    //Read the tuple record
    $userExists = userExists($con, $username);

    //If there is no matching tuple:
    if ($userExists == false) {
        $msg = "Error: Invalid username";
        $msg = base64_encode($msg);
        header("location: ../View/Login.php?msg=$msg");
        exit();
    }

    //Extract the user's attribute details into seperate varaibles
    $dbPassword = $userExists['user_pwd'];
    $userRole = $userExists['user_role_id'];

    //If the passwords match:
    if (password_verify($password, $dbPassword)) {
        //password_verify will automatically check the original pwd against the hashed pwd

        //Create a session with the logged in user's details:
        session_start();
        $_SESSION["userId"] = $userExists["user_id"];
        $_SESSION["userName"] = $userExists["user_fname"] . " " . $userExists["user_lname"];
        $_SESSION["userDOB"] = $userExists["user_dob"];
        $_SESSION["userImage"] = $userExists["user_image"];
        $_SESSION["userEmail"] = $userExists["user_email"];
        $_SESSION["userAddress"] = $userExists["user_address"];

        //Convert the role Id of the user into a string based on the role table:
        if ($userRole == 1) {
            $_SESSION["userRole"] = "Admin";
            header("location: ../View/AdminHome.php");
        } else if ($userRole == 2) {
            $_SESSION["userRole"] = "User";
            header("location: ../View/UserHome.php");
        } else if ($userRole == 3) {
            $_SESSION["userRole"] = "Clerk";
            header("location: ../View/ClerkHome.php");
        }

    //If the passwords do not match:
    } else {
        $msg = "Error: Invalid Password";
        $msg = base64_encode($msg);
        header("location: ../View/Login.php?msg=$msg");
        exit();
    }
}


?>