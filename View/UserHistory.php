<?php

session_start();
if (!isset($_SESSION["userName"])) {
    $msg = "Please login first";
    $msg = base64_encode($msg);
    header("location: ../View/Login.php?msg=$msg");
}

$userName = $_SESSION['userName'];
$userId = $_SESSION['userId'];
$userImage = $_SESSION['userImage'];
$userRole = $_SESSION['userRole'];
$userEmail = $_SESSION['userEmail'];

//Specific code:

require_once "../Commons/ECommerceDB.php";
$thisDBConnection = new DbConnection();
$myCon = $thisDBConnection->con;

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

if(isset($_POST['limitSelector'])){
    $_SESSION['limitHistory'] = $_POST['limitSelector'];
    $limit = $_POST['limitSelector'];
    $page = 1;
}else{
    if(isset($_SESSION['limitHistory'])){
        $limit = $_SESSION['limitHistory'];
    }else{
        $_SESSION['limitHistory'] = 10;
        $limit = 10;
    }
}

$start = ($page - 1) * $limit;

if (isset($_GET["search"])) {

    $filters = mysqli_real_escape_string($myCon, $_GET["search"]);
    $page = 0;

    $sql = "SELECT * FROM sale JOIN product ON sale_product_id = product_id WHERE CONCAT(product_name, product_category, product_brand, sale_date, sale_qty) LIKE '%$filters%' AND sale_user_id=$userId AND sale_status=1 ORDER BY sale_date DESC;";
    $result = $myCon->query($sql) or die($myCon->error);
    $resCheck = mysqli_num_rows($result);

    if ($resCheck > 0) {
        $sales = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $msg = "No records have been read from the database";
        $msg = base64_encode($msg);
        header("location: ../View/UserHistory.php?msg=$msg");
        exit();
    }
} else {

    $sql = "SELECT * FROM sale JOIN product ON sale_product_id = product_id WHERE sale_user_id = $userId AND sale_status=1 ORDER BY sale_date DESC LIMIT $start, $limit;";
    $result = $myCon->query($sql) or die($myCon->error);
    $resCheck = mysqli_num_rows($result);

    if ($resCheck > 0) {
        $sales = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $msg = "No purchases have been made by your account";
        $msg = base64_encode($msg);
        header("location: ../View/UserHome.php?msg=$msg");
        exit();
    }
}

$sqlNew = "SELECT count(sale_id) AS sale_id FROM sale WHERE sale_user_id = $userId AND sale_status = 1";
$resultNew = $myCon->query($sqlNew) or die($myCon->error);
$saleCount = $resultNew->fetch_all(MYSQLI_ASSOC);
$total = $saleCount[0]['sale_id'];
$pages = ceil($total / $limit);

$previous = $page - 1;
$next = $page + 1;

if (isset($_SESSION["cart"])) {
    $cartCount = count($_SESSION["cart"]);
}

require_once "../Model/UserHistoryModel.php";

?>

<!DOCTYPE html>
<html>

<head>

    <title>My Purchases</title>

    <link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../CSS/HeaderStyleslight.css">
    <link rel="stylesheet" type="text/css" href="../CSS/HeaderStylesUser.css">
    <link rel="stylesheet" type="text/css" href="../CSS/UserHistoryStyles.css">
    <script src="https://kit.fontawesome.com/0c49cb8566.js" crossorigin="anonymous"></script>

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
                        <a class="nav-link" href="#"> <button class="btnToTxt activeItem" type="submit" name="submit" value="navHistory"> History </button> </a>
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

    <br><br>

    <div class="container">

        <div class="row">
            <div class="col-12">
                <h2 class="TitleTxt">My Purchase History</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-9">

                <nav class="paginationNav">
                    <ul class="pagination">

                        <li class="page-item">
                            <a class="page-link" href="UserHistory.php?page=1">First</a>
                        </li>

                        <li class="page-item <?php if ($page == 1 || $page == 0) {
                                                    echo "disabled";
                                                } ?>">
                            <a class="page-link" href="UserHistory.php?page=<?php echo $previous; ?>">Previous</a>
                        </li>

                        <?php for ($i = 1; $i <= $pages; $i++) { ?>

                            <li class="page-item<?php if ($i == $page) {
                                                    echo " active";
                                                } ?>">
                                <a class="page-link" href="UserHistory.php?page=<?php echo $i; ?>"> <?php echo $i; ?> </a>
                            </li>

                        <?php } ?>

                        <li class="page-item <?php if ($page == $pages || $page == 0) {
                                                    echo "disabled";
                                                } ?>">
                            <a class="page-link" href="UserHistory.php?page=<?php echo $next; ?>">Next</a>
                        </li>

                        <li class="page-item">
                            <a class="page-link" href="UserHistory.php?page=<?php echo $pages; ?>">Last</a>
                        </li>

                    </ul>
                </nav>

            </div>

            <div class="col-3">
                <form action="" method="get">
                    <div class="input-group mb-3">
                        <input id="search" name="search" value="<?php if (isset($_GET["search"])) {
                                                                    echo $_GET["search"];
                                                                } ?>" type="text" class="form-control" placeholder="Search for any purchases">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>

        </div>

        <div class="row">
            <div class="col-12">

                <table class="table table-striped table-hover table-bordered table-responsive">

                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Product Category</th>
                            <th scope="col">Product Brand</th>
                            <th scope="col">Order Date</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Payment</th>
                            <th scope="col">Delivery Date</th>
                            <th scope="col">Status</th>
                            <th scope="th-sm" id="Action">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <form action="UserInvoiceReport.php?status=true" method="post">
                        <?php foreach ($sales as $sale) { ?>
                            <tr>
                                <th scope="row"><?php echo $sale['sale_id'] ?></th>
                                <td id="ProductName<?php echo $sale['sale_id'] ?>"> <?php echo $sale['product_name'] ?></td>
                                <td id="ProductCategory<?php echo $sale['sale_id'] ?>"> <?php echo $sale['product_category'] ?></td>
                                <td id="ProductBrand<?php echo $sale['sale_id'] ?>"> <?php echo $sale['product_brand'] ?></td>
                                <td id="SaleDate<?php echo $sale['sale_id'] ?>"><?php echo $sale['sale_date'] ?></td>
                                <td id="SaleQty<?php echo $sale['sale_id'] ?>"><?php echo $sale['sale_qty'] ?></td>
                                <td id="SalePayment<?php echo $sale['sale_id'] ?>"><?php echo $sale['sale_payment'] ?></td>
                                <td id="SaleDeliveryDate<?php echo $sale['sale_id'] ?>">
                                    <?php
                                    if ($sale['sale_delivery_id'] === NULL) {
                                        $deliveryDate = "N/A";
                                        echo $deliveryDate;
                                    } else {
                                        $delivery = deliveryExists($myCon, $sale['sale_delivery_id']);
                                        $deliveryDate = $delivery['delivery_scheduled_date'];
                                        echo $deliveryDate;
                                    }
                                    ?>
                                </td>
                                <td id="SaleDeliveryStatus<?php echo $sale['sale_id'] ?>">
                                    <?php
                                    if ($sale['sale_delivery_id'] === NULL) {
                                        $deliveryStatus = "<button type='button' class='btn btn-block btn-danger btn-status'>Processing</button>";
                                        echo $deliveryStatus;
                                    } else {
                                        $delivery = deliveryExists($myCon, $sale['sale_delivery_id']);
                                        $deliveryStatus = $delivery['delivery_status'];
                                        if ($deliveryStatus == 3) {
                                            $deliveryStatus = "<button type='button' class='btn btn-block btn-warning btn-status'>Allocated</button>";
                                        } else if ($deliveryStatus == 2) {
                                            $deliveryStatus = "<button type='button' class='btn btn-block btn-primary btn-status'>Dispatched</button>";
                                        } else if ($deliveryStatus == 1) {
                                            $deliveryStatus = "<button type='button' class='btn btn-block btn-success btn-status'>Delivered</button>";
                                        } else {
                                            $deliveryStatus = "<button type='button' class='btn btn-block btn-secondary btn-status'>Archived</button>";
                                        }
                                        echo $deliveryStatus;
                                    }
                                    ?>
                                </td>
                                <td>
                                    <button type="submit" formtarget="_blank" class="btn btn-sm btn-success" name="invoiceButton" id="invoice-<?php echo $sale['sale_id'] ?>" value="invoice-<?php echo $sale['sale_id'] ?>"><i class="fa-solid fa-file-invoice"></i>&nbsp;&nbsp;Invoice</button>
                                </td>
                            </tr>
                        <?php } ?>
                        </form>
                    </tbody>

                </table>

            </div>
        </div>
        
        <div class="row">

            <form action="#" method="post" class="limitSelectForm">

                <label>Records per page:</label>
                <select id="limitSelector" name="limitSelector" class="form-select limitSelect" onchange="changeLimits()">
                    <option <?php if($limit == 5){ echo "selected"; } ?> value="5">5</option>
                    <option <?php if($limit == 10){ echo "selected"; } ?> value="10">10</option>
                    <option <?php if($limit == 20){ echo "selected"; } ?> value="20">20</option>
                    <option <?php if($limit == 50){ echo "selected"; } ?> value="50">50</option>
                    <option <?php if($limit == 100){ echo "selected"; } ?> value="100">100</option>
                </select>

            </form>

        </div>

    </div>

    <?php

    //Anything to include

    ?>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="http://www.datejs.com/build/date.js" type="text/javascript"></script>
    <script src="../JS/UserHistory.js"></script>

    <?php

    if (isset($_GET['msg'])) {
        $msg = base64_decode($_GET['msg']);
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }

    ?>

</body>

</html>