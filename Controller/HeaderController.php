<?php

//Start the session:
session_start();

//Retrieve the link clicked from the navigation bar:
$action = $_POST["submit"];

//Redirect Appropriately:
if ($action == "navLogout") {
    //If the action was to log out, first destory the session:
    session_destroy();
    //Send a message to the login page:
    $code = "Logged out successfully!";
    $code = base64_encode($code);
    header("location: ../View/Login.php?code=$code");
} else if ($action == "navInventory") {
    header("location: ../View/Inventory.php");
} else if ($action == "navSuppliers") {
    header("location: ../View/Suppliers.php");
} else if ($action == "navStaff") {
    header("location: ../View/Staff.php");
} else if ($action == "navProfile") {
    header("location: ../View/UsersMyProfile.php");
} else if ($action == "navDelivery") {
    header("location: ../View/Deliveries.php");
} else if ($action == "navHome") {
    if ($_SESSION["userRole"] == "Admin") {
        header("location: ../View/AdminHome.php");
    } else if ($_SESSION["userRole"] == "Clerk") {
        header("location: ../View/ClerkHome.php");
    }
//If the action read is not defined, go back to dashboards:
} else {
    if ($_SESSION["userRole"] == "Admin") {
        header("location: ../View/AdminHome.php");
    } else if ($_SESSION["userRole"] == "Clerk") {
        header("location: ../View/ClerkHome.php");
    }
}
