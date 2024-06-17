<?php

//Start Session:
session_start();
if (!isset($_SESSION["userName"])) {
    $msg = "Please login first";
    $msg = base64_encode($msg);
    header("location: ../View/Login.php?msg=$msg");
}

//Load the logged in user's details:
$userName = $_SESSION['userName'];
$userId = $_SESSION['userId'];
$userImage = $_SESSION['userImage'];
$userRole = $_SESSION['userRole'];
$userEmail = $_SESSION['userEmail'];

//Load the model of the page:
require_once "../Model/InventoryManageStocksModel.php";

?>

<!DOCTYPE html>
<html>

<head>

    <title>Manage Stocks</title>

    <link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../CSS/HeaderStyles.css">
    <link rel="stylesheet" type="text/css" href="../CSS/InventoryManageStocksStyles.css">
    <script src="https://kit.fontawesome.com/0c49cb8566.js" crossorigin="anonymous"></script>

</head>

<body>

    <!-- Navigation Bar -->
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
                        <a class="nav-link" href="#"> <button class="activeItem btnToTxt" type="submit" name="submit" value="navInventory"> Inventory </button> </a>
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
                        <a class="nav-link" href="#"> <button class="btnToTxt" type="submit" name="submit" value="navDelivery"> Deliveries </button> </a>
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
                <h2 class="TitleTxt">Manage Stocks</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-9">

                <!-- Pagination Links -->
                <nav class="paginationNav">
                    <ul class="pagination">

                        <li class="page-item">
                            <a class="page-link" href="InventoryManageStocks.php?page=1">First</a>
                        </li>

                        <li class="page-item <?php if ($page == 1 || $page == 0) {echo "disabled";} ?>">
                            <a class="page-link" href="InventoryManageStocks.php?page=<?php echo $previous; ?>">Previous</a>
                        </li>

                        <?php for ($i = 1; $i <= $pages; $i++) { ?>

                            <li class="page-item<?php if ($i == $page) {echo " active";} ?>">
                                <a class="page-link" href="InventoryManageStocks.php?page=<?php echo $i; ?>"> <?php echo $i; ?> </a>
                            </li>

                        <?php } ?>

                        <li class="page-item <?php if ($page == $pages || $page == 0) {echo "disabled";} ?>">
                            <a class="page-link" href="InventoryManageStocks.php?page=<?php echo $next; ?>">Next</a>
                        </li>

                        <li class="page-item">
                            <a class="page-link" href="InventoryManageStocks.php?page=<?php echo $pages; ?>">Last</a>
                        </li>

                    </ul>
                </nav>

            </div>

            <div class="col-3">
                <!-- Search Button -->
                <form action="" method="get">
                    <div class="input-group mb-3">
                        <input id="search" name="search" value="<?php if (isset($_GET["search"])) {echo $_GET["search"];} ?>" type="text" class="form-control" placeholder="Search for data">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>

        </div>

        <div class="row">
            <div class="col-12">

                <!--Table -->
                <table class="table table-striped table-hover table-bordered table-responsive">

                    <!-- Attribute Names -->
                    <thead>
                        <tr>
                            <th scope="col">Stock Id</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Max Quantity</th>
                            <th scope="col">Re-Order Quantity</th>
                            <th scope="col">Current Quantity</th>
                            <th scope="col">Created Date</th>
                            <th scope="col">Updated Date</th>
                            <th scope="th-sm" id="Action">Action</th>
                        </tr>
                    </thead>

                    <!-- Table Data -->
                    <tbody>
                        <?php foreach ($stocks as $stock) { ?>
                            <!-- Repeat for each stock tuple -->
                            <tr>
                                <th scope="row"><?php echo $stock['stock_id'] ?></th>
                                <td id="ProductName<?php echo $stock['stock_id'] ?>"> <?php echo getProductName($myCon, $stock['stock_product_id']) ?></td>
                                <td id="MaxQty<?php echo $stock['stock_id'] ?>"><?php echo $stock['stock_qty_max'] ?></td>
                                <td id="BufferQty<?php echo $stock['stock_id'] ?>"><?php echo $stock['stock_qty_buffer'] ?></td>
                                <td id="CurrentQty<?php echo $stock['stock_id'] ?>"><?php echo $stock['stock_qty_current'] ?></td>
                                <td id="CreateDate<?php echo $stock['stock_id'] ?>"><?php echo $stock['stock_created_date'] ?></td>
                                <td id="UpdateDate<?php echo $stock['stock_id'] ?>"><?php echo $stock['stock_updated_date'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger" name="deleteButton" id="del<?php echo $stock['stock_id'] ?>" onclick="openDeleteModal(this.id)"><i class="fa-solid fa-trash-can"></i>&nbsp;Delete</button>&nbsp;
                                    <button type="button" class="btn btn-sm btn-info" name="editButton" id="edit<?php echo $stock['stock_id'] ?>" onclick="openEditModal(this.id)"><i class="fa-solid fa-pen-to-square"></i>&nbsp;Edit</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>

            </div>
        </div>

        <div class="row">

            <!-- Change limits of record per page -->
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

    <!-- Modals Start -->

    <?php

    include_once "InventoryEditStocksModal.php";
    include_once "InventoryDeleteStockModal.php";

    ?>

    <!-- Modals End -->

    <!-- Link to Imported JS Files -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="http://www.datejs.com/build/date.js" type="text/javascript"></script>

    <!-- Link to Own JS File -->
    <script src="../JS/InventoryManageStocks.js"></script>

    <?php

    //Alert box for any meesages passed:
    if (isset($_GET['msg'])) {
        $msg = base64_decode($_GET['msg']);
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }

    ?>

</body>

</html>