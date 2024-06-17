<?php

require_once '../Commons/ECommerceDB.php';

function userExists($con, $username)
{
    //User name === User email
    $sql = "SELECT * FROM user WHERE user_email = ? AND user_status=1;";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/UsersMyProfile.php?msg=$msg");
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


function getImage($con, $username, $userId)
{
    $userExists = userExists($con, $username);

    if ($userExists == false) {
        $msg = "Error: There was an error loading your image";
        $msg = base64_encode($msg);
        header("location: ../View/UsersMyProfile.php?msg=$msg");
        exit();
    }

    $dbImg = $userExists['user_image'];

    if ($dbImg == "N/A") {
        echo "<img src='../Commons/Profiles/ProfileDefault.png' alt='User image' id='UserImage'>";
    } else {
        echo "<img src='../Commons/Profiles/" . $dbImg . "' alt='User image' id='UserImage'>";
    }
}


function emptyInputCheck($UserId, $UserFName, $UserLName, $UserEmail, $UserAddress, $UserDOBOG)
{
    if ($UserId == "") {
        $msg = "Error loading user details";
        $msg = base64_encode($msg);
        header("location: ../View/UsersMyProfile.php?msg=$msg");
    } else if ($UserFName == "") {
        $msg = "First name cannot be empty!";
        $msg = base64_encode($msg);
        header("location: ../View/UsersMyProfile.php?msg=$msg");
    } else if ($UserLName == "") {
        $msg = "Last Name cannot be empty!";
        $msg = base64_encode($msg);
        header("location: ../View/UsersMyProfile.php?msg=$msg");
    } else if ($UserEmail == "") {
        $msg = "Username cannot be empty!";
        $msg = base64_encode($msg);
        header("location: ../View/UsersMyProfile.php?msg=$msg");
    } else if ($UserAddress == "") {
        $msg = "User address cannot be empty!";
        $msg = base64_encode($msg);
        header("location: ../View/UsersMyProfile.php?msg=$msg");
    }else if ($UserDOBOG == "") {
        $msg = "Date of birth cannot be empty!";
        $msg = base64_encode($msg);
        header("location: ../View/UsersMyProfile.php?msg=$msg");
    } else {
        return true;
    }
}


function imageCheck($UserImageName)
{
    if ($UserImageName == "") {
        return false;
    } else {
        return true;
    }
}


function emailExists($con, $UserEmail, $UserId)
{
    $sql = "SELECT * FROM user WHERE user_email = ? AND user_status=1 AND NOT (user_id = ?);";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/UsersMyProfile.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $UserEmail, $UserId);
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

function UpdateUserUpper($con, $UserId, $UserFName, $UserLName, $UserEmail, $UserAddress, $UserDOB, $UserImage){

    $sql = "UPDATE user SET user_fname = ?, user_lname = ?, user_email = ?, user_address = ?, user_dob = ?, user_image = ? WHERE user_id = ?;";

    $imageName = $UserImage['name'];
    $imageTmpName = $UserImage['tmp_name'];
    $imageSize = $UserImage['size'];
    $imageError = $UserImage['error'];
    $imageType = $UserImage['type'];

    $imageExtention = explode('.', $imageName);
    $imageActualExtension = strtolower(end($imageExtention));
    $allowedExtenstions = array('jpg', 'jpeg', 'png');

    $UserImageNameReal="";

    if(in_array($imageActualExtension, $allowedExtenstions)){
        if($imageError === 0){
            if($imageSize <= 50000000){
                $UserImageNameReal = "Profile" . $UserId . "." . $imageActualExtension;
                $fileDestination = "../Commons/Profiles/" . $UserImageNameReal;
                move_uploaded_file($imageTmpName, $fileDestination);
                echo "Upload Success!";
            }else{
                $msg = "The file is too large, please try and compress it";
                $msg = base64_encode($msg);
                header("location: ../View/UsersMyProfile.php?msg=$msg");
            }
        }else{
            $msg = "There was an error uploading the file";
            $msg = base64_encode($msg);
            header("location: ../View/UsersMyProfile.php?msg=$msg");
        }
    }else{
        $msg = "You cannot upload files of this type";
        $msg = base64_encode($msg);
        header("location: ../View/UsersMyProfile.php?msg=$msg");
    }

    $stmt = mysqli_stmt_init($con);  

    if(!mysqli_stmt_prepare($stmt, $sql)){
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/UsersMyProfile.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssssss", $UserFName, $UserLName, $UserEmail, $UserAddress, $UserDOB, $UserImageNameReal, $UserId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $code = "Account updated successfully! Please login again for changes to take effect.";
    $code = base64_encode($code);
    header("location: ../View/UsersMyProfile.php?msg=$code");

}


function UpdateUserLower($con, $UserId, $UserFName, $UserLName, $UserEmail, $UserAddress, $UserDOB){

    $sql = "UPDATE user SET user_fname = ?, user_lname = ?, user_email = ?, user_address = ?, user_dob = ? WHERE user_id = ?;";

    $stmt = mysqli_stmt_init($con);  

    if(!mysqli_stmt_prepare($stmt, $sql)){
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/UsersMyProfile.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssss", $UserFName, $UserLName, $UserEmail, $UserAddress, $UserDOB, $UserId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $code = "Account updated successfully! Please login again for changes to take effect.";
    $code = base64_encode($code);
    header("location: ../View/UsersMyProfile.php?msg=$code");

}