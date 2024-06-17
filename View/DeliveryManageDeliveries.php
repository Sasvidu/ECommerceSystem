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
    $_SESSION['limitDeliveries'] = $_POST['limitSelector'];
    $limit = $_POST['limitSelector'];
    $page = 1;
}else{
    if(isset($_SESSION['limitDeliveries'])){
        $limit = $_SESSION['limitDeliveries'];
    }else{
        $_SESSION['limitDeliveries'] = 10;
        $limit = 10;
    }
}

$start = ($page - 1) * $limit;

if (isset($_GET["search"])) {

    $filters = $_GET["search"];
    $page = 0;

    $sql = "SELECT * FROM delivery JOIN deliveryagent ON delivery.delivery_agent_id = deliveryagent.agent_id WHERE CONCAT(delivery_id, delivery_scheduled_date, agent_name, agent_location) LIKE '%$filters%' AND (delivery_status=2 OR delivery_status=3 OR delivery_status=4) ORDER BY delivery_status DESC, delivery_id ASC;";

    $result = $myCon->query($sql) or die($myCon->error);
    $resCheck = mysqli_num_rows($result);

    $deliveries = $result->fetch_all(MYSQLI_ASSOC);

    //No need to check whether its empty as new array adddition is provided on the same page
} else {

    $sql = "SELECT * FROM delivery JOIN deliveryagent ON delivery.delivery_agent_id = deliveryagent.agent_id WHERE delivery_status=2 OR delivery_status=3 OR delivery_status=4 ORDER BY delivery_status DESC, delivery_id ASC LIMIT $start, $limit;";
    $result = $myCon->query($sql) or die($myCon->error);
    $resCheck = mysqli_num_rows($result);

    $deliveries = $result->fetch_all(MYSQLI_ASSOC);
}

$sqlNew = "SELECT count(delivery_id) AS delivery_id FROM delivery WHERE delivery_status=2 OR delivery_status=3 OR delivery_status=4";
$resultNew = $myCon->query($sqlNew) or die($myCon->error);
$deliveryCount = $resultNew->fetch_all(MYSQLI_ASSOC);
$total = $deliveryCount[0]['delivery_id'];
$pages = ceil($total / $limit);

$previous = $page - 1;
$next = $page + 1;

?>

<!DOCTYPE html>
<html>

<head>

    <title>Manage Deliveries</title>

    <link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../CSS/HeaderStyles.css">
    <link rel="stylesheet" type="text/css" href="../CSS/DeliveryManageDeliveriesStyles.css">
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
                <h2 class="TitleTxt">Schedule Deliveries</h2>
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
                            <a class="page-link" href="DeliveryManageDeliveries.php?page=1">First</a>
                        </li>

                        <li class="page-item <?php if ($page == 1 || $page == 0) {
                                                    echo "disabled";
                                                } ?>">
                            <a class="page-link" href="DeliveryManageDeliveries.php?page=<?php echo $previous; ?>">Previous</a>
                        </li>

                        <?php for ($i = 1; $i <= $pages; $i++) { ?>

                            <li class="page-item<?php if ($i == $page) {
                                                    echo " active";
                                                } ?>">
                                <a class="page-link" href="DeliveryManageDeliveries.php?page=<?php echo $i; ?>"> <?php echo $i; ?> </a>
                            </li>

                        <?php } ?>

                        <li class="page-item <?php if ($page == $pages || $page == 0) {
                                                    echo "disabled";
                                                } ?>">
                            <a class="page-link" href="DeliveryManageDeliveries.php?page=<?php echo $next; ?>">Next</a>
                        </li>

                        <li class="page-item">
                            <a class="page-link" href="DeliveryManageDeliveries.php?page=<?php echo $pages; ?>">Last</a>
                        </li>

                    </ul>
                </nav>

            </div>

            <div class="col-1">
                <button type="button" class="btn btn-block btn-half-success" name="addDeliveryButton" id="addDeliveryButton" data-toggle="modal" data-target="#NewDeliveryModal"></i>&nbsp;Schedule Delivery</button>
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
                            <th scope="col">Delivery Id</th>
                            <th scope="col">Delivery Date</th>
                            <th scope="col">Agent Name</th>
                            <th scope="col">Agent Location</th>
                            <th scope="col" id="Status">Delivery Status</th>
                            <th scope="th-sm" id="Action">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($deliveries as $delivery) { ?>
                            <tr>
                                <th scope="row"><?php echo $delivery['delivery_id']; ?></th>
                                <td id="DeliveryDate<?php echo $delivery['delivery_id']; ?>"> <?php echo $delivery['delivery_scheduled_date']; ?></td>
                                <td id="DeliveryAgentName<?php echo $delivery['delivery_id']; ?>"> <?php echo $delivery['agent_name']; ?></td>
                                <td id="DeliveryAgentLocation<?php echo $delivery['delivery_id']; ?>"> <?php echo $delivery['agent_location']; ?></td>
                                <td id="DeliveryStatus<?php echo $delivery['delivery_id']; ?>">
                                    <?php
                                    $deliveryStatus = $delivery['delivery_status'];
                                    if ($deliveryStatus == 4) {
                                        $deliveryStatus = "<button type='button' class='btn btn-block btn-danger btn-status' onclick='openAllocatePage()'>Processing</button>";
                                    } else if ($deliveryStatus == 3) {
                                        $deliveryStatus = "<button type='button' class='btn btn-block btn-warning btn-status' id='dispatch" . $delivery['delivery_id'] . "' onclick='openDispatchModal(this.id)'>Allocated</button>";
                                    } else if ($deliveryStatus == 2) {
                                        $deliveryStatus = "<button type='button' class='btn btn-block btn-primary btn-status' id='complete" . $delivery['delivery_id'] . "' onclick='openCompleteModal(this.id)'>Dispatched</button>";
                                    } else {
                                        $deliveryStatus = "<button type='button' class='btn btn-block btn-secondary btn-status'>Archived</button>";
                                    }
                                    echo $deliveryStatus;
                                    ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger btn-action" name="deleteButton" id="del<?php echo $delivery['delivery_id'] ?>" onclick="openDeleteModal(this.id)"><i class="fa-solid fa-trash-can"></i>&nbsp;Delete</button>
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

    include_once "DeliveryAddDeliveryModal.php";
    include_once "DeliveryDeleteDeliveryModal.php";
    include_once "DeliveryDispatchDeliveryModal.php";
    include_once "DeliveryCompleteDeliveryModal.php";

    ?>

    <!-- Modals end-->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../JS/DeliveryManageDeliveries.js"></script>

    <?php

    if (isset($_GET['msg'])) {
        $msg = base64_decode($_GET['msg']);
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }

    ?>

</body>

</html>