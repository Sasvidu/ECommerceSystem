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
    $_SESSION['limitAllocations'] = $_POST['limitSelector'];
    $limit = $_POST['limitSelector'];
    $page = 1;
}else{
    if(isset($_SESSION['limitAllocations'])){
        $limit = $_SESSION['limitAllocations'];
    }else{
        $_SESSION['limitAllocations'] = 10;
        $limit = 10;
    }
}

$start = ($page - 1) * $limit;

if (isset($_GET["search"])) {

    $filters = $_GET["search"];
    $page = 0;

    $sql = "SELECT * FROM sale JOIN product ON sale_product_id = product_id WHERE CONCAT(product_name, product_category, product_brand, sale_date, sale_qty) LIKE '%$filters%' AND sale_status=1 AND sale_delivery_id IS NULL ORDER BY sale_date ASC, sale_id ASC;";

    $result = $myCon->query($sql) or die($myCon->error);
    $resCheck = mysqli_num_rows($result);

    $sales = $result->fetch_all(MYSQLI_ASSOC);

    //No need to check whether its empty as new array adddition is provided on the same page
} else {

    $sql = "SELECT * FROM sale JOIN product ON sale_product_id = product_id WHERE sale_status=1 AND sale_delivery_id IS NULL ORDER BY sale_date ASC, sale_id ASC LIMIT $start, $limit;";
    $result = $myCon->query($sql) or die($myCon->error);
    $resCheck = mysqli_num_rows($result);

    $sales = $result->fetch_all(MYSQLI_ASSOC);
}

$sqlNew = "SELECT count(sale_id) AS sale_id FROM sale WHERE sale_status = 1 AND sale_delivery_id IS NULL";
$resultNew = $myCon->query($sqlNew) or die($myCon->error);
$salesCount = $resultNew->fetch_all(MYSQLI_ASSOC);
$total = $salesCount[0]['sale_id'];
$pages = ceil($total / $limit);

$previous = $page - 1;
$next = $page + 1;

?>

<!DOCTYPE html>
<html>

<head>

    <title>Allocate to Deliveries</title>

    <link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../CSS/HeaderStyles.css">
    <link rel="stylesheet" type="text/css" href="../CSS/DeliveryAllocateDeliveriesStyles.css">
    <script src="https://kit.fontawesome.com/0c49cb8566.js" crossorigin="anonymous"></script>
    
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

        <a class="navbar-brand" href="#">
            <img class="logo" src="../Commons/Icons/logotest.png" alt="logo" width="50px" height="50px">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <form action="../Controller/HeaderController.php" method="post">
                <ul class="navbar-nav mr-auto navLinks">

                    <li id="nav1" class="nav-item">
                        <a class="nav-link" href="#"> <button class="btnToTxt" type="submit" name="submit" value="navHome"> Home </button> </a>
                    </li>

                    <li id="nav2" class="nav-item">
                        <a class="nav-link" href="#"> <button class="btnToTxt" type="submit" name="submit" value="navInventory"> Inventory </button> </a>
                    </li>

                    <li id="nav3" class="nav-item">
                        <a class="nav-link" href="#"> <button class="btnToTxt" type="submit" name="submit" value="navSuppliers"> Suppliers </button> </a>
                    </li>

                    <li id="nav4" class="nav-item">
                        <a class="nav-link" href="#"> <button class="btnToTxt" type="submit" name="submit" value="navStaff"> Staff </button> </a>
                    </li>

                    <li id="nav5" class="nav-item">
                        <a class="nav-link" href="#"> <button class="btnToTxt" type="submit" name="submit" value="navProfile"> Users </button> </a>
                    </li>

                    <li id="nav7" class="nav-item">
                        <a class="nav-link" href="#"> <button class="activeItem btnToTxt" type="submit" name="submit" value="navDelivery"> Deliveries </button> </a>
                    </li>

                    <li id="nav6" class="nav-item">
                        <a class="nav-link" href="#"> <button class="btnToTxt" type="submit" name="submit" value="navLogout"> Log out </button> </a>
                    </li>

                </ul>
            </form>

        </div>

    </nav>

    <br><br>

    <div class="container">

        <div class="row">
            <div class="col-12">
                <h2 class="TitleTxt">Allocate Sales to Deliveries</h2>
            </div>

            <div class="col-12">
                &nbsp;
            </div>
        </div>

        <div class="row">

            <div class="col-8">

                <nav class="paginationNav">
                    <ul class="pagination">

                        <li class="page-item">
                            <a class="page-link" href="DeliveryAllocateDeliveries.php?page=1">First</a>
                        </li>

                        <li class="page-item <?php if ($page == 1 || $page == 0) {
                                                    echo "disabled";
                                                } ?>">
                            <a class="page-link" href="DeliveryAllocateDeliveries.php?page=<?php echo $previous; ?>">Previous</a>
                        </li>

                        <?php for ($i = 1; $i <= $pages; $i++) { ?>

                            <li class="page-item<?php if ($i == $page) {
                                                    echo " active";
                                                } ?>">
                                <a class="page-link" href="DeliveryAllocateDeliveries.php?page=<?php echo $i; ?>"> <?php echo $i; ?> </a>
                            </li>

                        <?php } ?>

                        <li class="page-item <?php if ($page == $pages || $page == 0) {
                                                    echo "disabled";
                                                } ?>">
                            <a class="page-link" href="DeliveryAllocateDeliveries.php?page=<?php echo $next; ?>">Next</a>
                        </li>

                        <li class="page-item">
                            <a class="page-link" href="DeliveryAllocateDeliveries.php?page=<?php echo $pages; ?>">Last</a>
                        </li>

                    </ul>
                </nav>

            </div>

            <div class="col-3 searchbar">
                <form action="" method="get">
                    <div class="input-group mb-3">
                        <input id="search" name="search" value="<?php if (isset($_GET["search"])) {
                                                                    echo $_GET["search"];
                                                                } ?>" type="text" class="form-control" placeholder="Search for data">
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
                            <th scope="col">Sale Id</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Product Category</th>
                            <th scope="col">Product Brand</th>
                            <th scope="col">Sale Date</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Payment</th>
                            <th scope="col">Status</th>
                            <th scope="th-sm" id="Action">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($sales as $sale) { ?>
                            <tr>
                                <th scope="row"><?php echo $sale['sale_id'] ?></th>
                                <td id="ProductName<?php echo $sale['sale_id'] ?>"> <?php echo $sale['product_name'] ?></td>
                                <td id="ProductCategory<?php echo $sale['sale_id'] ?>"> <?php echo $sale['product_category'] ?></td>
                                <td id="ProductBrand<?php echo $sale['sale_id'] ?>"> <?php echo $sale['product_brand'] ?></td>
                                <td id="SaleDate<?php echo $sale['sale_id'] ?>"><?php echo $sale['sale_date'] ?></td>
                                <td id="SaleQty<?php echo $sale['sale_id'] ?>"><?php echo $sale['sale_qty'] ?></td>
                                <td id="SalePayment<?php echo $sale['sale_id'] ?>"><?php echo $sale['sale_payment'] ?></td>
                                <td id="SaleDeliveryStatus<?php echo $sale['sale_id'] ?>"><button type='button' class='btn btn-block btn-danger btn-status'>Processing</button></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success" name="allocateButton" id="allocate<?php echo $sale['sale_id'] ?>" onclick="openAllocateModal(this.id)"><i class="fa-solid fa-box"></i>&nbsp;&nbsp;Allocate</button>
                                </td>
                            </tr>
                        <?php } ?>

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

    <!-- Modals -->

    <?php

    include_once "DeliveryAllocateDeliveryModal.php";
    //include_once "DeliveryDeleteAgentModal.php";
    //include_once "DeliveryEditAgentModal.php";

    ?>

    <!-- Modals end-->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../JS/DeliveryAllocateDelivery.js"></script>

    <?php

    if (isset($_GET['msg'])) {
        $msg = base64_decode($_GET['msg']);
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }

    ?>

</body>

</html>