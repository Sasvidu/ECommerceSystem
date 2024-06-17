<?php

require_once '../Commons/ECommerceDB.php';

function userExists($con, $username)
{

    //User name === User email
    $sql = "SELECT * FROM user WHERE user_email = ?;";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/UserCart.php?msg=$msg");
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

function getImageNav($con, $username, $userId)
{

    $userExists = userExists($con, $username);

    if ($userExists == false) {
        $msg = "Error: There was an error loadin your image";
        $msg = base64_encode($msg);
        header("location: ../View/UserCart.php?msg=$msg");
        exit();
    }

    $dbImg = $userExists['user_image'];

    if ($dbImg == "N/A") {
        echo "<img src='../Commons/Profiles/ProfileDefault.png' alt='User image' id='UserImageNav'>";
    } else {
        echo "<img src='../Commons/Profiles/" . $dbImg . "' alt='User image' id='UserImageNav'>";
    }

}

function productExists($con, $productId)
{

    $sql = "SELECT * FROM product WHERE product_id = ?;";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/UserCart.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $productId);
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

function productExistsUpper($con, $productId)
{

    //User name === User email
    $sql = "SELECT * FROM product JOIN stock ON product_id = stock_product_id WHERE product_id = ?;";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/UserCart.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $productId);
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

function InsertSale($con, $productId, $date, $qty, $payment, $userId){

    $sql = "INSERT INTO sale(sale_product_id, sale_date, sale_qty, sale_payment, sale_user_id) VALUES (?, ?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/UserCart.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssss", $productId, $date, $qty, $payment, $userId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    session_start();
    unset($_SESSION['cart']);

}

function UpdateStock($con, $productId, $qty, $updateDate){

    $sql = "UPDATE stock SET stock_qty_current = (stock_qty_current - ?) , stock_updated_date = ? WHERE stock_product_id = ?;";

    $stmt = mysqli_stmt_init($con);  

    if(!mysqli_stmt_prepare($stmt, $sql)){
        $msg = "Error: MySQL statement Failed";
        $msg = base64_encode($msg);
        header("location: ../View/UserCart.php?msg=$msg");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $qty, $updateDate, $productId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

}