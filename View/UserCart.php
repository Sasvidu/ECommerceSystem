<?php

//Set up values:

session_start();
if (!isset($_SESSION["userName"])) {
    $msg = "Please login first";
    $msg = base64_encode($msg);
    header("location: ../View/Login.php?msg=$msg");
}

$userId = $_SESSION['userId'];
$userName = $_SESSION['userName'];
$userDOB = $_SESSION["userDOB"];
$userImage = $_SESSION['userImage'];
$userRole = $_SESSION['userRole'];
$userEmail = $_SESSION['userEmail'];

if (isset($_SESSION["cart"])) {

    $cartCount = count($_SESSION["cart"]);
    if ($cartCount == 0) {

        header("location: ../View/UserHome.php");
        exit();
    }
} else {

    header("location: ../View/UserHome.php");
    exit();
}

//Initialize database connection:

require_once '../Commons/ECommerceDB.php';
require_once '../Model/UserCartModel.php';

$thisDBConnection = new DbConnection();
$myCon = $thisDBConnection->con;

//Initialize price variable

$totalPrice = 0;


//Remove Button:

if (isset($_POST["btnRemove"])) {

    $ElementId = $_POST["btnRemove"];

    unset($_SESSION["cart"][$ElementId]);
    unset($_POST["btnRemove"]);

    $_SESSION["cart"] = array_values($_SESSION["cart"]);
    $cartCount = count($_SESSION["cart"]);

    if ($cartCount == 0) {

        header("location: ../View/UserHome.php");
        exit();
    }
}

//Quantity change:

if (isset($_POST["qtySubmit"])) {

    for ($i = 0; $i < $cartCount; $i++) {

        if ($_POST["qtySubmit"][$i] != "1") {

            $qty = $_POST["qtySubmit"][$i];
            $explosion = explode("-", $qty);
            $cartId = $explosion[0];
            $qty = $explosion[1];

            $itemArray = $_SESSION["cart"][$cartId];
            $itemArray["product_qty"] = $qty;
            $_SESSION["cart"][$cartId] = $itemArray;
        }
    }
}

//Item count:

$itemCount = 0;
for ($i = 0; $i < $cartCount; $i++) {

    $qty = $_SESSION["cart"][$i]['product_qty'];
    $itemCount += $qty;
}

?>

<!DOCTYPE html>
<html>

<head>

<title>My Cart</title>

    <link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../CSS/HeaderStyleslight.css">
    <link rel="stylesheet" type="text/css" href="../CSS/HeaderStylesUser.css">
    <link rel="stylesheet" type="text/css" href="../CSS/UserCartStyles.css">
    <script src="https://kit.fontawesome.com/0c49cb8566.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">

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
                        <a class="nav-link" href="#"> <button class="btnToTxt" type="submit" name="submit" value="navStore"> Store </button> </a>
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
            &nbsp;
        </div>

        <div class="col-1">
            &nbsp;
        </div>

        <div class="col-1">

            <div id="shoppingCartDiv">

                &nbsp;&nbsp;&nbsp;&nbsp;
                <a href="UserCart.php" id="cart-link"><i id="shoppingCart" class="fa-solid fa-cart-shopping"></i></a>
                &nbsp;&nbsp;
                <span id="cartCount"> <?php if (isset($cartCount)) {
                                            echo $cartCount;
                                        } else {
                                            echo "0";
                                        } ?> </span>

            </div>

        </div>

        <div class="col-1 flexer">

            <div id="imageHolderNav">

                <a href="UserMyProfile.php">

                    <?php
                    getImageNav($myCon, $userEmail, $userId);
                    ?>

                </a>

            </div>

        </div>

    </nav>

    <div class="container">

        <div class="row">

            <div class="col-12">
                &nbsp;
            </div>

            <div class="col-12">
                &nbsp;
            </div>

        </div>

        <div class="row">

            <div class="col-md-7 col-sm-12">

                <h5 id="myCart">My Cart</h5>
                <hr>
                <br>

                <form id="cartForm" action="UserCart.php" method="post">

                    <?php

                    if (isset($_SESSION["cart"])) {

                        for ($i = 0; $i < $cartCount; $i++) {

                            $productArray = $_SESSION['cart'][$i];
                            $productId = $productArray['product_id'];
                            $productQty = $productArray['product_qty'];

                            if (productExists($myCon, $productId) == false) {
                                break;
                            } else {
                                $product = productExistsUpper($myCon, $productId);
                            }

                            //Assoc

                    ?>

                            <div class="row product">

                                <div class="col-3">

                                    <img src="../Commons/Products/<?php echo $product['product_image'] ?>" alt="Product Image" class="img-fluid productImage">

                                </div>

                                <div class="col-6">

                                    <div class="row">

                                        <div class="col-12">
                                            <h3 class="product-name$productId"><?php echo $product['product_name'] ?></h3>
                                        </div>

                                        <div class="col-6">
                                            <span class="product-category"><?php echo $product['product_category'] ?></span>
                                        </div>

                                        <div class="col-6">
                                            <span class="product-brand"><?php echo $product['product_brand'] ?></span>
                                        </div>

                                        <div class="col-12">
                                            <h5 class="product-price">LKR <?php echo ($product['product_price'] * $productQty);
                                                                            $totalPrice += ($product['product_price'] * $productQty); ?></h5>
                                        </div>

                                        <div class="col-12">
                                            <button id="btnRemove" name="btnRemove" value="<?php echo $i ?>" type="submit" class="btn btn-danger">Remove</button>
                                            <input id="productId<?php echo $productId; ?>" name="productId[]" value="<?php echo $productId; ?>" type="hidden" class="form-control" readonly>
                                        </div>

                                    </div>

                                </div>

                                <div class="col-3 flexer">

                                    <div class="row">

                                        <div class="col-12 flexer">

                                            <button id="<?php echo $i; ?>" type="button" class="btn bg-light border rounded-circle minusbtn"><i class="fa-solid fa-minus"></i></button>
                                            <input id="qtyCounter<?php echo $i; ?>" type="text" value="<?php echo $productQty; ?>" class="form-control w-30 d-inline qtyCounter" readonly>
                                            <button id="<?php echo $i; ?>" type="button" class="btn bg-light border rounded-circle plusbtn" value="<?php echo $product['stock_qty_current'] ?>"><i class="fa-solid fa-plus"></i></button>

                                        </div>

                                        <div class="col-12 flexer">

                                            <small>Max : <?php echo $product['stock_qty_current'] ?></small>

                                        </div>

                                        <div class="col-12 flexer">

                                            <input id="qtySubmit<?php echo $i; ?>" name="qtySubmit[]" type="hidden" value="1" class="form-control" readonly>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-12">
                                    &nbsp;
                                </div>

                            </div>

                        <?php

                        }
                    } else {

                        ?>
                        <h3> Cart is Empty. </h3>
                    <?php

                    }

                    ?>

                </form>

            </div>

            <div class="col-md-5 col-sm-12">

                <div class="panel cartPanel">

                    <form action="../Controller/UserCartController.php?status=true" method="post">

                        <div class="row">

                            <div class="col-12">
                                <span class="cartPanel-title">PRICE DETAILS</span>
                            </div>

                            <br><br>

                            <hr>

                            <div class="col-6">
                                <span class="cartPanel-text">Price (<?php if (isset($_SESSION["cart"])) {
                                                                        echo $itemCount;
                                                                    } else {
                                                                        echo "0";
                                                                    } ?> items) : </span>
                            </div>

                            <div class="col-6">
                                <span class="cartPanel-text">LKR <?php echo $totalPrice; ?> </span>
                            </div>

                            <div class="col-12">
                                &nbsp;
                            </div>

                            <div class="col-6">
                                <span class="cartPanel-text">Delivery Charges : </span>
                            </div>

                            <div class="col-6">
                                <span class="cartPanel-text text-success">Islandwide FREE Delivery</span>
                            </div>

                            <div class="col-12">
                                &nbsp;
                            </div>

                            <hr>

                            <div class="col-6">
                                <span class="cartPanel-text">Total Amount : </span>
                            </div>

                            <div class="col-6">
                                <span class="cartPanel-text"> LKR <?php echo $totalPrice; ?> </span>
                            </div>

                            <div class="col-12">
                                <small>*Payment is to be made upon delivery.</small>
                            </div>

                            <div class="col-12">
                                &nbsp;
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-12 flexer">

                                <button id="checkOut" name="checkOut" value="" type="submit" class="btn btn-success">Place Order</button>

                            </div>

                            <?php

                            if (isset($_SESSION["cart"])) {

                                for ($i = 0; $i < $cartCount; $i++) {

                                    $productArray = $_SESSION['cart'][$i];
                                    $productId = $productArray['product_id'];
                                    $productQty = $productArray['product_qty'];

                                    if (productExists($myCon, $productId) == false) {
                                        break;
                                    } else {
                                        $product = productExists($myCon, $productId);
                                    }

                            ?>

                                    <div class="col-12">
                                        <input id="productId<?php echo $productId; ?>" name="productId[]" value="<?php echo $productId; ?>" type="hidden" class="form-control" readonly>
                                        <input id="productQty<?php echo $productId; ?>" name="productQty[]" value="<?php echo $productQty; ?>" type="hidden" class="form-control" readonly>
                                    </div>

                            <?php

                                }
                            }

                            ?>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <script src="../JS/UserCartJS.js"></script>

    <?php

    if (isset($_GET['msg'])) {
        $msg = base64_decode($_GET['msg']);
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }

    ?>

</body>

</html>