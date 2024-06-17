<?php

session_start();
$action = $_POST["submit"];

if ($action == "navLogout") {
    session_destroy();
    $code = "Logged out successfully!";
    $code = base64_encode($code);
    header("location: ../View/Login.php?code=$code");
} else if ($action == "navInventory") {
    header("location: ../View/Inventory.php");
} else if ($action == "navHome") {
    header("location: ../View/ClerkHome.php");
} else if ($action == "navSuppliers") {
    header("location: ../View/Suppliers.php");
} else if ($action == "navStaff") {
    header("location: ../View/Staff.php");
} else if($action == "navProfile"){
    header("location: ../View/UsersMyProfile.php");
}
