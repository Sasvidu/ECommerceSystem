<?php

    session_start();
    $action = $_POST["submit"];

    if($action == "navLogout"){
        session_destroy();
        $code = "Logged out successfully!";
        $code = base64_encode($code);
        header("location: ../View/Login.php?code=$code");
    }else if($action == "navStore"){
        header("location: ../View/UserHome.php");
    }else if($action == "navHistory"){
        header("location: ../View/UserHistory.php");
    }

?>