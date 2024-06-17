<?php

    require_once '../Commons/ECommerceDB.php';

    function userExists($con, $username){
                
        //User name === User email
        $sql = "SELECT * FROM user WHERE user_email = ?;";

        $stmt = mysqli_stmt_init($con);  

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $msg = "Error: MySQL statement Failed";
            $msg = base64_encode($msg);
            header("location: ../View/Suppliers.php?msg=$msg");
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

    function getImage($con, $username, $userId){

        $userExists = userExists($con, $username);

        if($userExists == false){
            $msg = "Error: There was an error loadin your image";
            $msg = base64_encode($msg);
            header("location: ../View/Suppliers.php?msg=$msg");
            exit();
        }

        $dbImg = $userExists['user_image'];

        if($dbImg == "N/A"){
            echo "<img src='../Commons/Profiles/ProfileDefault.png' alt='User image' id='UserImage'>";
        }else{
            echo "<img src='../Commons/Profiles/" . $dbImg . "' alt='User image' id='UserImage'>";
        }

    }

?>