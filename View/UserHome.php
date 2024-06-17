<?php

session_start();
if (!isset($_SESSION["userName"])) {
    $msg = "Please login first";
    $msg = base64_encode($msg);
    header("location: ../View/Login.php?msg=$msg");
}

$userName = $_SESSION['userName'];
$userId = $_SESSION['userName'];
$userImage = $_SESSION['userName'];
$userRole = $_SESSION['userRole'];
$userEmail = $_SESSION['userEmail'];

$explosion = explode(" ", $userName);
$Fname = $explosion[0];
$Lname = $explosion[1];


require_once "../Commons/ECommerceDB.php";
$thisDBConnection = new DbConnection();
$myCon = $thisDBConnection->con;

$limit = 12;

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$start = ($page - 1) * $limit;

if (isset($_POST["search"])) {

    $search = mysqli_real_escape_string($myCon, $_POST["search"]);
    $page = 0;

    $sql = "SELECT * FROM product JOIN stock ON product_id = stock_product_id WHERE CONCAT(product_category, product_brand, product_name, product_price) LIKE '%$search%' AND product_status=1 AND product_stock_status=1 ORDER BY product_id DESC;";

    $result = $myCon->query($sql) or die($myCon->error);
    $resCheck = mysqli_num_rows($result);

    if ($resCheck > 0) {
        $products = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        header("location: ../View/UserHome.php");
        exit();
    }

    $sqlNew = "SELECT count(product_id) AS product_id FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1";
    $resultNew = $myCon->query($sqlNew) or die($myCon->error);
    $productCount = $resultNew->fetch_all(MYSQLI_ASSOC);
    $total = $productCount[0]['product_id'];
    $pages = ceil($total / $limit);

    unset($_SESSION["FiltersSubmit"]);
    unset($_SESSION["FiltersCategory"]);
    unset($_SESSION["FiltersBrand"]);
    unset($_SESSION["FiltersIsStockAvailable"]);
    unset($_POST["FiltersSubmit"]);
    unset($_POST["FiltersCategory"]);
    unset($_POST["FiltersBrand"]);
    unset($_POST["FiltersIsStockAvailable"]);

} else {

    if (isset($_POST["FiltersSubmit"])) {

        $_SESSION["FiltersCategory"] = mysqli_real_escape_string($myCon, $_POST["FiltersCategory"]);
        $_SESSION["FiltersBrand"] = mysqli_real_escape_string($myCon, $_POST["FiltersBrand"]);
        $_SESSION["FiltersSubmit"] = "true";

        $Category = strval($_SESSION["FiltersCategory"]);
        $Brand = strval($_SESSION["FiltersBrand"]);

        unset($_POST["FiltersCategory"]);
        unset($_POST["FiltersBrand"]);
        unset($_POST["FiltersSubmit"]);

        if (isset($_POST["FiltersIsStockAvailable"]) && $_POST["FiltersIsStockAvailable"] == "on") {

            $_SESSION["FiltersIsStockAvailable"] = mysqli_real_escape_string($myCon, $_POST["FiltersIsStockAvailable"]);
            unset($_POST["FiltersIsStockAvailable"]);

            if ($Category == "All" && $Brand == "") {

                $sql = "SELECT * FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1 AND stock_qty_current > 0 ORDER BY product_id DESC LIMIT $start, $limit;";
                $result = $myCon->query($sql) or die($myCon->error);
                $resCheck = mysqli_num_rows($result);

                if ($resCheck > 0) {
                    $products = $result->fetch_all(MYSQLI_ASSOC);
                } else {
                    $msg = "No products avaiable at the moment";
                    $msg = base64_encode($msg);
                    unset($_SESSION["FiltersSubmit"]);
                    unset($_SESSION["FiltersCategory"]);
                    unset($_SESSION["FiltersBrand"]);
                    unset($_SESSION["FiltersIsStockAvailable"]);
                    header("location: ../View/UserHome.php?msg=$msg");
                    exit();
                }

                $sqlNew = "SELECT count(product_id) AS product_id FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1 AND stock_qty_current > 0;";
                $resultNew = $myCon->query($sqlNew) or die($myCon->error);
                $productCount = $resultNew->fetch_all(MYSQLI_ASSOC);
                $total = $productCount[0]['product_id'];
                $pages = ceil($total / $limit);

            } else if ($Category == "All" && $Brand != "") {

                $sql = "SELECT * FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1 AND product_brand LIKE '%$Brand%' AND stock_qty_current > 0  ORDER BY product_id DESC LIMIT $start, $limit;";
                $result = $myCon->query($sql) or die($myCon->error);
                $resCheck = mysqli_num_rows($result);

                if ($resCheck > 0) {
                    $products = $result->fetch_all(MYSQLI_ASSOC);
                } else {
                    $msg = "No products of this brand is available at the moment";
                    $msg = base64_encode($msg);
                    unset($_SESSION["FiltersSubmit"]);
                    unset($_SESSION["FiltersCategory"]);
                    unset($_SESSION["FiltersBrand"]);
                    unset($_SESSION["FiltersIsStockAvailable"]);
                    header("location: ../View/UserHome.php?msg=$msg");
                    exit();
                }

                $sqlNew = "SELECT count(product_id) AS product_id FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1 AND product_brand LIKE '%$Brand%' AND stock_qty_current > 0;";
                $resultNew = $myCon->query($sqlNew) or die($myCon->error);
                $productCount = $resultNew->fetch_all(MYSQLI_ASSOC);
                $total = $productCount[0]['product_id'];
                $pages = ceil($total / $limit);

            } else if ($Category != "All" && $Brand == "") {

                $sql = "SELECT * FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1 AND product_category = '$Category' AND stock_qty_current > 0 ORDER BY product_id DESC LIMIT $start, $limit;";
                $result = $myCon->query($sql) or die($myCon->error);
                $resCheck = mysqli_num_rows($result);

                if ($resCheck > 0) {
                    $products = $result->fetch_all(MYSQLI_ASSOC);
                } else {
                    $msg = "No products of this category are available at the moment";
                    $msg = base64_encode($msg);
                    unset($_SESSION["FiltersSubmit"]);
                    unset($_SESSION["FiltersCategory"]);
                    unset($_SESSION["FiltersBrand"]);
                    unset($_SESSION["FiltersIsStockAvailable"]);
                    header("location: ../View/UserHome.php?msg=$msg");
                    exit();
                }

                $sqlNew = "SELECT count(product_id) AS product_id FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1 AND product_category = '$Category' AND stock_qty_current > 0;";
                $resultNew = $myCon->query($sqlNew) or die($myCon->error);
                $productCount = $resultNew->fetch_all(MYSQLI_ASSOC);
                $total = $productCount[0]['product_id'];
                $pages = ceil($total / $limit);

            } else if ($Category != "All" && $Brand != "") {

                $sql = "SELECT * FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1 AND product_category = '$Category' AND product_brand LIKE '%$Brand%' AND stock_qty_current > 0 ORDER BY product_id DESC LIMIT $start, $limit;";
                $result = $myCon->query($sql) or die($myCon->error);
                $resCheck = mysqli_num_rows($result);

                if ($resCheck > 0) {
                    $products = $result->fetch_all(MYSQLI_ASSOC);
                } else {
                    $msg = "No products like this are available at the moment";
                    $msg = base64_encode($msg);
                    unset($_SESSION["FiltersSubmit"]);
                    unset($_SESSION["FiltersCategory"]);
                    unset($_SESSION["FiltersBrand"]);
                    unset($_SESSION["FiltersIsStockAvailable"]);
                    header("location: ../View/UserHome.php?msg=$msg");
                    exit();
                }

                $sqlNew = "SELECT count(product_id) AS product_id FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1 AND product_category = '$Category' AND product_brand LIKE '%$Brand%' AND stock_qty_current > 0;";
                $resultNew = $myCon->query($sqlNew) or die($myCon->error);
                $productCount = $resultNew->fetch_all(MYSQLI_ASSOC);
                $total = $productCount[0]['product_id'];
                $pages = ceil($total / $limit);
            }

        } else {

            unset($_POST["FiltersIsStockAvailable"]);

            if ($Category == "All" && $Brand == "") {

                $sql = "SELECT * FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1 ORDER BY product_id DESC LIMIT $start, $limit;";
                $result = $myCon->query($sql) or die($myCon->error);
                $resCheck = mysqli_num_rows($result);

                if ($resCheck > 0) {
                    $products = $result->fetch_all(MYSQLI_ASSOC);
                } else {
                    $msg = "No products avaiable at the moment";
                    $msg = base64_encode($msg);
                    unset($_SESSION["FiltersSubmit"]);
                    unset($_SESSION["FiltersCategory"]);
                    unset($_SESSION["FiltersBrand"]);
                    unset($_SESSION["FiltersIsStockAvailable"]);
                    header("location: ../View/UserHome.php?msg=$msg");
                    exit();
                }

                $sqlNew = "SELECT count(product_id) AS product_id FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1;";
                $resultNew = $myCon->query($sqlNew) or die($myCon->error);
                $productCount = $resultNew->fetch_all(MYSQLI_ASSOC);
                $total = $productCount[0]['product_id'];
                $pages = ceil($total / $limit);

                unset($_SESSION["FiltersSubmit"]);
                unset($_SESSION["FiltersCategory"]);
                unset($_SESSION["FiltersBrand"]);
                unset($_SESSION["FiltersIsStockAvailable"]);

            } else if ($Category == "All" && $Brand != "") {

                $sql = "SELECT * FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1 AND product_brand LIKE '%$Brand%' ORDER BY product_id DESC LIMIT $start, $limit;";
                $result = $myCon->query($sql) or die($myCon->error);
                $resCheck = mysqli_num_rows($result);

                if ($resCheck > 0) {
                    $products = $result->fetch_all(MYSQLI_ASSOC);
                } else {
                    $msg = "No products of this brand is available at the moment";
                    $msg = base64_encode($msg);
                    unset($_SESSION["FiltersSubmit"]);
                    unset($_SESSION["FiltersCategory"]);
                    unset($_SESSION["FiltersBrand"]);
                    unset($_SESSION["FiltersIsStockAvailable"]);
                    header("location: ../View/UserHome.php?msg=$msg");
                    exit();
                }

                $sqlNew = "SELECT count(product_id) AS product_id FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1 AND product_brand LIKE '%$Brand%';";
                $resultNew = $myCon->query($sqlNew) or die($myCon->error);
                $productCount = $resultNew->fetch_all(MYSQLI_ASSOC);
                $total = $productCount[0]['product_id'];
                $pages = ceil($total / $limit);

                unset($_SESSION["FiltersIsStockAvailable"]);

            } else if ($Category != "All" && $Brand == "") {

                $sql = "SELECT * FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1 AND product_category = '$Category' ORDER BY product_id DESC LIMIT $start, $limit;";
                $result = $myCon->query($sql) or die($myCon->error);
                $resCheck = mysqli_num_rows($result);

                if ($resCheck > 0) {
                    $products = $result->fetch_all(MYSQLI_ASSOC);
                } else {
                    $msg = "No products of this category are available at the moment";
                    $msg = base64_encode($msg);
                    unset($_SESSION["FiltersSubmit"]);
                    unset($_SESSION["FiltersCategory"]);
                    unset($_SESSION["FiltersBrand"]);
                    unset($_SESSION["FiltersIsStockAvailable"]);
                    header("location: ../View/UserHome.php?msg=$msg");
                    exit();
                }

                $sqlNew = "SELECT count(product_id) AS product_id FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1 AND product_category = '$Category';";
                $resultNew = $myCon->query($sqlNew) or die($myCon->error);
                $productCount = $resultNew->fetch_all(MYSQLI_ASSOC);
                $total = $productCount[0]['product_id'];
                $pages = ceil($total / $limit);

                unset($_SESSION["FiltersIsStockAvailable"]);

            } else if ($Category != "All" && $Brand != "") {

                $sql = "SELECT * FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1 AND product_category = '$Category' AND product_brand LIKE '%$Brand%' ORDER BY product_id DESC LIMIT $start, $limit;";
                $result = $myCon->query($sql) or die($myCon->error);
                $resCheck = mysqli_num_rows($result);

                if ($resCheck > 0) {
                    $products = $result->fetch_all(MYSQLI_ASSOC);
                } else {
                    $msg = "No products like this are available at the moment";
                    $msg = base64_encode($msg);
                    unset($_SESSION["FiltersSubmit"]);
                    unset($_SESSION["FiltersCategory"]);
                    unset($_SESSION["FiltersBrand"]);
                    unset($_SESSION["FiltersIsStockAvailable"]);
                    header("location: ../View/UserHome.php?msg=$msg");
                    exit();
                }

                $sqlNew = "SELECT count(product_id) AS product_id FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1 AND product_category = '$Category' AND product_brand LIKE '%$Brand%';";
                $resultNew = $myCon->query($sqlNew) or die($myCon->error);
                $productCount = $resultNew->fetch_all(MYSQLI_ASSOC);
                $total = $productCount[0]['product_id'];
                $pages = ceil($total / $limit);

                unset($_SESSION["FiltersIsStockAvailable"]);

            }
        }

    } else if (isset($_SESSION["FiltersSubmit"])) {

        $Category = $_SESSION["FiltersCategory"];
        $Brand = $_SESSION["FiltersBrand"];

        if (isset($_SESSION["FiltersIsStockAvailable"]) && $_SESSION["FiltersIsStockAvailable"] == "on") {

            if ($Category == "All" && $Brand == "") {

                $sql = "SELECT * FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1 AND stock_qty_current > 0 ORDER BY product_id DESC LIMIT $start, $limit;";
                $result = $myCon->query($sql) or die($myCon->error);
                $resCheck = mysqli_num_rows($result);

                if ($resCheck > 0) {
                    $products = $result->fetch_all(MYSQLI_ASSOC);
                } else {
                    $msg = "No products avaiable at the moment";
                    $msg = base64_encode($msg);
                    unset($_SESSION["FiltersSubmit"]);
                    unset($_SESSION["FiltersCategory"]);
                    unset($_SESSION["FiltersBrand"]);
                    unset($_SESSION["FiltersIsStockAvailable"]);
                    header("location: ../View/UserHome.php?msg=$msg");
                    exit();
                }

                $sqlNew = "SELECT count(product_id) AS product_id FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1 AND stock_qty_current > 0;";
                $resultNew = $myCon->query($sqlNew) or die($myCon->error);
                $productCount = $resultNew->fetch_all(MYSQLI_ASSOC);
                $total = $productCount[0]['product_id'];
                $pages = ceil($total / $limit);

            } else if ($Category == "All" && $Brand != "") {

                $sql = "SELECT * FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1 AND product_brand LIKE '%$Brand%' AND stock_qty_current > 0  ORDER BY product_id DESC LIMIT $start, $limit;";
                $result = $myCon->query($sql) or die($myCon->error);
                $resCheck = mysqli_num_rows($result);

                if ($resCheck > 0) {
                    $products = $result->fetch_all(MYSQLI_ASSOC);
                } else {
                    $msg = "No products of this brand is available at the moment";
                    $msg = base64_encode($msg);
                    unset($_SESSION["FiltersSubmit"]);
                    unset($_SESSION["FiltersCategory"]);
                    unset($_SESSION["FiltersBrand"]);
                    unset($_SESSION["FiltersIsStockAvailable"]);
                    header("location: ../View/UserHome.php?msg=$msg");
                    exit();
                }

                $sqlNew = "SELECT count(product_id) AS product_id FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1 AND product_brand LIKE '%$Brand%' AND stock_qty_current > 0;";
                $resultNew = $myCon->query($sqlNew) or die($myCon->error);
                $productCount = $resultNew->fetch_all(MYSQLI_ASSOC);
                $total = $productCount[0]['product_id'];
                $pages = ceil($total / $limit);

            } else if ($Category != "All" && $Brand == "") {

                $sql = "SELECT * FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1 AND product_category = '$Category' AND stock_qty_current > 0 ORDER BY product_id DESC LIMIT $start, $limit;";
                $result = $myCon->query($sql) or die($myCon->error);
                $resCheck = mysqli_num_rows($result);

                if ($resCheck > 0) {
                    $products = $result->fetch_all(MYSQLI_ASSOC);
                } else {
                    $msg = "No products of this category are available at the moment";
                    $msg = base64_encode($msg);
                    unset($_SESSION["FiltersSubmit"]);
                    unset($_SESSION["FiltersCategory"]);
                    unset($_SESSION["FiltersBrand"]);
                    unset($_SESSION["FiltersIsStockAvailable"]);
                    header("location: ../View/UserHome.php?msg=$msg");
                    exit();
                }

                $sqlNew = "SELECT count(product_id) AS product_id FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1 AND product_category = '$Category' AND stock_qty_current > 0;";
                $resultNew = $myCon->query($sqlNew) or die($myCon->error);
                $productCount = $resultNew->fetch_all(MYSQLI_ASSOC);
                $total = $productCount[0]['product_id'];
                $pages = ceil($total / $limit);

            } else if ($Category != "All" && $Brand != "") {

                $sql = "SELECT * FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1 AND product_category = '$Category' AND product_brand LIKE '%$Brand%' AND stock_qty_current > 0 ORDER BY product_id DESC LIMIT $start, $limit;";
                $result = $myCon->query($sql) or die($myCon->error);
                $resCheck = mysqli_num_rows($result);

                if ($resCheck > 0) {
                    $products = $result->fetch_all(MYSQLI_ASSOC);
                } else {
                    $msg = "No products like this are available at the moment";
                    $msg = base64_encode($msg);
                    unset($_SESSION["FiltersSubmit"]);
                    unset($_SESSION["FiltersCategory"]);
                    unset($_SESSION["FiltersBrand"]);
                    unset($_SESSION["FiltersIsStockAvailable"]);
                    header("location: ../View/UserHome.php?msg=$msg");
                    exit();
                }

                $sqlNew = "SELECT count(product_id) AS product_id FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1 AND product_category = '$Category' AND product_brand LIKE '%$Brand%' AND stock_qty_current > 0;";
                $resultNew = $myCon->query($sqlNew) or die($myCon->error);
                $productCount = $resultNew->fetch_all(MYSQLI_ASSOC);
                $total = $productCount[0]['product_id'];
                $pages = ceil($total / $limit);

            }

        } else {

            unset($_POST["FiltersIsStockAvailable"]);

            if ($Category == "All" && $Brand == "") {

                $sql = "SELECT * FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1 ORDER BY product_id DESC LIMIT $start, $limit;";
                $result = $myCon->query($sql) or die($myCon->error);
                $resCheck = mysqli_num_rows($result);

                if ($resCheck > 0) {
                    $products = $result->fetch_all(MYSQLI_ASSOC);
                } else {
                    $msg = "No products avaiable at the moment";
                    $msg = base64_encode($msg);
                    unset($_SESSION["FiltersSubmit"]);
                    unset($_SESSION["FiltersCategory"]);
                    unset($_SESSION["FiltersBrand"]);
                    unset($_SESSION["FiltersIsStockAvailable"]);
                    header("location: ../View/UserHome.php?msg=$msg");
                    exit();
                }

                $sqlNew = "SELECT count(product_id) AS product_id FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1;";
                $resultNew = $myCon->query($sqlNew) or die($myCon->error);
                $productCount = $resultNew->fetch_all(MYSQLI_ASSOC);
                $total = $productCount[0]['product_id'];
                $pages = ceil($total / $limit);

                unset($_SESSION["FiltersSubmit"]);
                unset($_SESSION["FiltersCategory"]);
                unset($_SESSION["FiltersBrand"]);
                unset($_SESSION["FiltersIsStockAvailable"]);

            } else if ($Category == "All" && $Brand != "") {

                $sql = "SELECT * FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1 AND product_brand LIKE '%$Brand%' ORDER BY product_id DESC LIMIT $start, $limit;";
                $result = $myCon->query($sql) or die($myCon->error);
                $resCheck = mysqli_num_rows($result);

                if ($resCheck > 0) {
                    $products = $result->fetch_all(MYSQLI_ASSOC);
                } else {
                    $msg = "No products of this brand is available at the moment";
                    $msg = base64_encode($msg);
                    unset($_SESSION["FiltersSubmit"]);
                    unset($_SESSION["FiltersCategory"]);
                    unset($_SESSION["FiltersBrand"]);
                    unset($_SESSION["FiltersIsStockAvailable"]);
                    header("location: ../View/UserHome.php?msg=$msg");
                    exit();
                }

                $sqlNew = "SELECT count(product_id) AS product_id FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1 AND product_brand LIKE '%$Brand%';";
                $resultNew = $myCon->query($sqlNew) or die($myCon->error);
                $productCount = $resultNew->fetch_all(MYSQLI_ASSOC);
                $total = $productCount[0]['product_id'];
                $pages = ceil($total / $limit);

                unset($_SESSION["FiltersIsStockAvailable"]);

            } else if ($Category != "All" && $Brand == "") {

                $sql = "SELECT * FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1 AND product_category = '$Category' ORDER BY product_id DESC LIMIT $start, $limit;";
                $result = $myCon->query($sql) or die($myCon->error);
                $resCheck = mysqli_num_rows($result);

                if ($resCheck > 0) {
                    $products = $result->fetch_all(MYSQLI_ASSOC);
                } else {
                    $msg = "No products of this category are available at the moment";
                    $msg = base64_encode($msg);
                    unset($_SESSION["FiltersSubmit"]);
                    unset($_SESSION["FiltersCategory"]);
                    unset($_SESSION["FiltersBrand"]);
                    unset($_SESSION["FiltersIsStockAvailable"]);
                    header("location: ../View/UserHome.php?msg=$msg");
                    exit();
                }

                $sqlNew = "SELECT count(product_id) AS product_id FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1 AND product_category = '$Category';";
                $resultNew = $myCon->query($sqlNew) or die($myCon->error);
                $productCount = $resultNew->fetch_all(MYSQLI_ASSOC);
                $total = $productCount[0]['product_id'];
                $pages = ceil($total / $limit);

                unset($_SESSION["FiltersIsStockAvailable"]);

            } else if ($Category != "All" && $Brand != "") {

                $sql = "SELECT * FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1 AND product_category = '$Category' AND product_brand LIKE '%$Brand%' ORDER BY product_id DESC LIMIT $start, $limit;";
                $result = $myCon->query($sql) or die($myCon->error);
                $resCheck = mysqli_num_rows($result);

                if ($resCheck > 0) {
                    $products = $result->fetch_all(MYSQLI_ASSOC);
                } else {
                    $msg = "No products like this are available at the moment";
                    $msg = base64_encode($msg);
                    unset($_SESSION["FiltersSubmit"]);
                    unset($_SESSION["FiltersCategory"]);
                    unset($_SESSION["FiltersBrand"]);
                    unset($_SESSION["FiltersIsStockAvailable"]);
                    header("location: ../View/UserHome.php?msg=$msg");
                    exit();
                }

                $sqlNew = "SELECT count(product_id) AS product_id FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1 AND product_category = '$Category' AND product_brand LIKE '%$Brand%';";
                $resultNew = $myCon->query($sqlNew) or die($myCon->error);
                $productCount = $resultNew->fetch_all(MYSQLI_ASSOC);
                $total = $productCount[0]['product_id'];
                $pages = ceil($total / $limit);

                unset($_SESSION["FiltersIsStockAvailable"]);

            }

        }

    } else {

        $sql = "SELECT * FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1 ORDER BY product_id DESC LIMIT $start, $limit;";
        $result = $myCon->query($sql) or die($myCon->error);
        $resCheck = mysqli_num_rows($result);

        if ($resCheck > 0) {
            $products = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $msg = "Website is under maintainance, we apologise for any inconviniences.";
            $msg = base64_encode($msg);
            header("location: ../View/404.php?msg=$msg");
            exit();
        }

        $sqlNew = "SELECT count(product_id) AS product_id FROM product JOIN stock ON product_id = stock_product_id WHERE product_status=1 AND stock_status=1";
        $resultNew = $myCon->query($sqlNew) or die($myCon->error);
        $productCount = $resultNew->fetch_all(MYSQLI_ASSOC);
        $total = $productCount[0]['product_id'];
        $pages = ceil($total / $limit);

        unset($_SESSION["FiltersSubmit"]);
        unset($_SESSION["FiltersCategory"]);
        unset($_SESSION["FiltersBrand"]);
        unset($_SESSION["FiltersIsStockAvailable"]);
        unset($_POST["FiltersSubmit"]);
        unset($_POST["FiltersCategory"]);
        unset($_POST["FiltersBrand"]);
        unset($_POST["FiltersIsStockAvailable"]);

    }

}

$previous = $page - 1;
$next = $page + 1;

if(isset($_SESSION["cart"])){
    $cartCount = count($_SESSION["cart"]);
}

if(isset($_POST["addCartBtn"])){

    $id = $_POST["addCartBtn"];

    if(isset($_SESSION["cart"])){

        $itemIds = array_column($_SESSION["cart"], 'product_id');

        if(in_array($id, $itemIds)){

            ?>
                <script type="text/javascript">alert("Product is already added to the cart!");</script>
            <?php

        }else{

            $itemArray = array('product_id' => $id, 'product_qty' => 1);
            $_SESSION["cart"][$cartCount] = $itemArray;
            ?>
                <script type="text/javascript">alert("Product added to the cart successfully!");</script>
            <?php
            $cartCount = count($_SESSION["cart"]);

        }       

    }else{

        $itemArray = array('product_id' => $id, 'product_qty' => 1);
        $_SESSION["cart"][0] = $itemArray;
        ?>
            <script type="text/javascript">alert("Product added to the cart successfully!");</script>
        <?php
        $cartCount = count($_SESSION["cart"]);

    }

}

unset($_POST["addCartBtn"]);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Shop Products</title>

    <link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../CSS/HeaderStyleslight.css">
    <link rel="stylesheet" type="text/css" href="../CSS/HeaderStylesUser.css">
    <link rel="stylesheet" type="text/css" href="../CSS/UserHomeStyles.css">
    <script src="https://kit.fontawesome.com/0c49cb8566.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body>

    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">

        <div class="col-1">

            <a class="navbar-brand" href="#">
                <img class="logo" src="../Commons/Icons/logotest.png" alt="logo" width="50px" height="50px">
            </a>

        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse col-6" id="navbarSupportedContent" style="display:flex; justify-content: center">

            <form action="../Controller/UserHeaderController.php" method="post">

                <ul class="navbar-nav m-auto navLinks">

                    <li class="nav-item">
                        <a class="nav-link" href="#"> <button class="btnToTxt activeItem" type="submit" name="submit" value="navStore"> Store </button> </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#"> <button class="btnToTxt" type="submit" name="submit" value="navHistory"> History </button> </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#"> <button class="btnToTxt" type="submit" name="submit" value="navLogout"> Log out </button> </a>
                    </li>

                </ul>

            </form>

        </div>

        <div class="col-2">

            <form action="UserHome.php" method="post">

                <div class="input-group">

                    <input id="search" name="search" value="<?php if (isset($_POST["search"])) {echo $_POST["search"];} ?>" type="search" class="form-control" placeholder="Search...">
                    <button type="submit" class="btn btn-outline-primary">Search</button>

                </div>

            </form>

        </div>

        <div class="col-1">
            &nbsp;
        </div>

        <div class="col-1">

            <div id="shoppingCartDiv">

                &nbsp;&nbsp;&nbsp;&nbsp;
                <a href="UserCart.php" id="cart-link"><i id="shoppingCart" class="fa-solid fa-cart-shopping"></i></a>
                &nbsp;&nbsp;
                <span id="cartCount"> <?php if(isset($cartCount)){ echo $cartCount; } else { echo "0"; } ?> </span>

            </div>

        </div>

        <div class="col-1 flexer">

            <a href="UserMyProfile.php">

                <div id="imageHolderNav">

                    <?php
                    require_once '../Model/UserHomeModel.php';
                    getImageNav($myCon, $userEmail, $userId);
                    ?>

                </div>

            </a>

        </div>

    </nav>

    <div class="row">
        <div class="col-12">&nbsp;</div>
        <div class="col-12">&nbsp;</div>
    </div>

    <div id="intro-panel" class="container-fluid">

        <div class="row">

            <div id="message" class="col-12">

                <h1 id="messageContent">Welcome, <?php echo $Fname; ?></h1>

                <!--Scroll down button-->

                <!--End-->

            </div>

        </div>

    </div>

    <div class="container">

        <div class="row">

            <div class="col-12">
                &nbsp;
            </div>

            <div class="col-12">
                &nbsp;
            </div>

            <div class="col-12">
                &nbsp;
            </div>

            <div class="col-12 flexer">
                <h3 id="title">Shop Accessories</h3>
            </div>

            <div class="col-12">
                &nbsp;
            </div>

            <div class="col-12">
                &nbsp;
            </div>

            <div class="col-12">
                &nbsp;
            </div>

        </div>

        <div class="row">

            <div class="accordion col-12" id="Filters">

                <div class="accordion-item">

                    <h2 class="accordion-header" id="headingOnly">

                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            <i class="fa-solid fa-filter"></i> &nbsp; Filters
                        </button>

                    </h2>

                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOnly" data-bs-parent="#Filters">

                        <div class="accordion-body">

                            <form action="UserHome.php" method="post">

                                <div class="row">

                                    <div class="col-6">
                                        <label>Product Category:</label>
                                        <select id="FiltersCategory" name="FiltersCategory" class="form-select">
                                            <option selected value="<?php if (isset($_SESSION["FiltersCategory"])) {echo $_SESSION["FiltersCategory"];} else {echo "All";} ?>"> <?php if (isset($_SESSION["FiltersCategory"])) {echo $_SESSION["FiltersCategory"];} else {echo "All";} ?> </option>
                                            <option value="Phone">Phone</option>
                                            <option value="Tablet">Tablet</option>
                                            <option value="Laptop">Laptop</option>
                                            <option value="Processor">Processor</option>
                                            <option value="Motherboard">Motherboard</option>
                                            <option value="RAM">RAM</option>
                                            <option value="Graphics Card">Graphics Card</option>
                                            <option value="Power Supply">Power Supply</option>
                                            <option value="Cooling">Cooling</option>
                                            <option value="Storage">Storage</option>
                                            <option value="Monitor">Monitor</option>
                                            <option value="Case">Case</option>
                                            <option value="Cable">Cable</option>
                                            <option value="Other">Other</option>
                                            <option value="All">All</option>
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <label>Product Brand:</label>
                                        <input id="FiltersBrand" name="FiltersBrand" value="<?php if (isset($_SESSION["FiltersBrand"])) {echo $_SESSION["FiltersBrand"];} ?>" type="text" class="form-control">
                                    </div>

                                    <div class="col-12">&nbsp;</div>

                                    <div id="FiltersIsStockAvailableDiv" class="col-12 flexer">
                                        <div class="form-check">
                                            <input id="FiltersIsStockAvailable" name="FiltersIsStockAvailable" type="checkbox" class="form-check-input" <?php if (isset($_SESSION["FiltersIsStockAvailable"])) {echo "checked";} ?>>
                                            <label class="form-check-label" for="FiltersIsStockAvailable">In Stock</label>
                                        </div>
                                    </div>

                                    <div class="col-12">&nbsp;</div>

                                    <div class="col-12 flexer">
                                        <button id="FiltersSubmit" name="FiltersSubmit" type="submit" class="btn btn-primary">Apply</button>
                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-12">
                &nbsp;
            </div>

            <div class="col-12">
                &nbsp;
            </div>

            <div class="col-12">
                &nbsp;
            </div>

        </div>

        <form action="UserHome.php" method="post">

            <div class="row productRow">

                <?php foreach ($products as $product) { ?>

                    <div class="col-md-3 col-sm-12 flexer product">

                        <div class="card" style="width: 18rem;">

                            <img src="../Commons/Products/<?php echo $product['product_image'] ?>" class="card-img-top productImage" alt="..." align="center">

                            <div class="card-body">
                                <h6 class="card-title"><?php echo $product['product_name'] ?></h6>
                            </div>

                            <p class="card-text"><?php echo "<br>" . $product['product_price'] ?></p>

                            <div class="card-footer">
                                <?php
                                    if($product['stock_qty_current'] > 0){
                                        ?>
                                            <button class="btn btn-outline-primary cardBtn" type="submit" name="addCartBtn" value="<?php echo $product['product_id'] ?>"> Add To Cart </button>
                                        <?php
                                    }else{
                                        ?>
                                            <button class="btn btn-danger cardBtn" type="button"> Out of Stock </button>
                                        <?php
                                    }
                                ?>
                            </div>

                        </div>

                    </div>

                <?php } ?>

                
                <!--
                <div class="col-md-3 col-sm-12 flexer product">

                    <div class="card" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text"></p>
                            <a href="#" class="btn btn-primary">Add to cart</a>
                        </div>
                    </div>

                </div>
                -->

            </div>

        </form>

        <div class="row">

            <div class="col-12">
                &nbsp;
            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-2"></div>

        <div class="col-8 flexer">

            <nav class="paginationNav">
                <ul class="pagination">

                    <li class="page-item">
                        <a class="page-link" href="UserHome.php?page=1"><i class="fa-solid fa-angles-left"></i></a>
                    </li>

                    <li class="page-item <?php if ($page == 1 || $page == 0) {echo "disabled";} ?>">
                        <a class="page-link" href="UserHome.php?page=<?php echo $previous; ?>"><i class="fa-solid fa-angle-left"></i></a>
                    </li>

                    <?php for ($i = 1; $i <= $pages; $i++) { ?>

                        <li class="page-item<?php if ($i == $page) {echo " active";} ?>">
                            <a class="page-link" href="UserHome.php?page=<?php echo $i; ?>"> <?php echo $i; ?> </a>
                        </li>

                    <?php } ?>

                    <li class="page-item <?php if ($page == $pages || $page == 0) {echo "disabled";} ?>">
                        <a class="page-link" href="UserHome.php?page=<?php echo $next; ?>"><i class="fa-solid fa-angle-right"></i></a>
                    </li>

                    <li class="page-item">
                        <a class="page-link" href="UserHome.php?page=<?php echo $pages; ?>"><i class="fa-solid fa-angles-right"></i></a>
                    </li>

                </ul>
            </nav>

        </div>

        <div class="col-2"></div>

    </div>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    <footer>
        <p align="center"><a href="https://www.freepik.com/vectors/isometric-server">Isometric server vector created by fullvector - www.freepik.com</a></p>
    </footer>

    <script src="../JS/UserHomeJS.js"></script>

    <?php

    if (isset($_GET['msg'])) {
        $msg = base64_decode($_GET['msg']);
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }

    ?>

</body>

</html>