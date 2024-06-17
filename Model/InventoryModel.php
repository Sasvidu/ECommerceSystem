<?php

    //Load the Database connection string:
    require_once '../Commons/ECommerceDB.php';

    //Read user tuple from the database:
    function userExists($con, $username){
                
        //User name === User email
        $sql = "SELECT * FROM user WHERE user_email = ?;";

        $stmt = mysqli_stmt_init($con);  

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $msg = "Error: MySQL statement Failed";
            $msg = base64_encode($msg);
            header("location: ../View/Inventory.php?msg=$msg");
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

    //Present the user's image:
    function getImage($con, $username){

        //Read the user tuple:
        $userExists = userExists($con, $username);

        //Send an error message if the user tuple does not exist:
        if($userExists == false){
            $msg = "Error: There was an error loading your image";
            $msg = base64_encode($msg);
            header("location: ../View/Inventory.php?msg=$msg");
            exit();
        }

        //Extract the image name from the user_image attribute:
        $dbImg = $userExists['user_image'];

        //Load the image from the 'Profiles' Folder in the 'Commons' folder:
        if($dbImg == "N/A"){
            //Load a default image if the user has not upload a specific one:
            echo "<img src='../Commons/Profiles/ProfileDefault.png' alt='User image' id='UserImage'>";
        }else{
            echo "<img src='../Commons/Profiles/" . $dbImg . "' alt='User image' id='UserImage'>";
        }

    }

?>