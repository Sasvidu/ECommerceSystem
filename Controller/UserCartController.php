<?php

if ($_GET["status"] != "true") {

    header("location: ../View/UserCart.php");
    exit();
} else {

    session_start();
    if (!isset($_SESSION["userName"])) {
        $msg = "Please login first";
        $msg = base64_encode($msg);
        header("location: ../View/Login.php?msg=$msg");
        exit();
    }

    if (isset($_SESSION["cart"])) {

        require_once '../Commons/ECommerceDB.php';
        require_once '../Model/UserCartModel.php';

        $thisDBConnection = new DbConnection();
        $myCon = $thisDBConnection->con;

        $products = $_POST['productId'];
        $quantities = $_POST['productQty'];
        $length = count($products);
        $date = date("Y-m-d");
        $userId = $_SESSION["userId"];

        for ($i = 0; $i < $length; $i++) {

            $productId = $products[$i];
            $productQty = $quantities[$i];

            if (productExists($myCon, $productId) == false) {
                $msg = "Please login first";
                $msg = base64_encode($msg);
                header("location: ../View/UserCart.php?msg=$msg");
                exit();
            } else {
                $product = productExists($myCon, $productId);
            }

            $payment = $product['product_price'] * $productQty;

            InsertSale($myCon, $productId, $date, $productQty, $payment, $userId);
            UpdateStock($myCon, $productId, $productQty, $date);

            $code = "Order placed successfully! You will receive the products through our delivery partners.";
            $code = base64_encode($code);
            header("location: ../View/UserHome.php?msg=$code");
        }
    } else {

        header("location: ../View/UserCart.php");
        exit();
    }
}
