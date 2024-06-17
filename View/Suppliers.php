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

?>

<!DOCTYPE html>
<html>

<head>

    <title>Supplier Module</title>

    <link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../CSS/HeaderStyles.css">
    <link rel="stylesheet" type="text/css" href="../CSS/SupplierStyles.css">
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
                        <a class="nav-link" href="#"> <button class="activeItem btnToTxt" type="submit" name="submit" value="navSuppliers"> Suppliers </button> </a>
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

    <div class="container">

        <div class="row">

            <div class="col-12">
                &nbsp;
            </div>

            <div class="col-12">
                &nbsp;
            </div>

        </div>

        <div class="row flexer">

            <div class="col-md-4 col-sm-12">

                <div class="panel">

                    <div id="imageHolder">
                        <?php

                        require_once '../Commons/ECommerceDB.php';
                        require_once '../Model/SupplierModel.php';

                        $thisDBConnection = new DbConnection();
                        $myCon = $thisDBConnection->con;

                        getImage($myCon, $userEmail, $userId);

                        ?>
                    </div>

                    <br><br>

                    <?php
                    echo "<h2 class='font-change'>Profile</h2>";
                    echo "<h6 class='font-change'>" . $userName . "</h3>";
                    echo "<h6 class='font-change'>" . $userRole . "</h2>";
                    ?>

                </div>

            </div>

            <div class="col-md-8 col-sm-12">

                <div class="panel widgetdiv">

                    <div class="row">
                        <div class="col-12">

                            <?php
                            echo "<h2 class='font-change'>Welcome " . $userRole . "</h2>";
                            echo "<p class='font-change'> Have a nice day! </p>"
                            ?>

                        </div>
                    </div>

                    <div class="row">

                        <div class="col-12">
                            &nbsp;
                        </div>

                        <div class="col-12">
                            &nbsp;
                        </div>

                    </div>

                    <div class="row flexer">

                        <div class="col-md-6 col-sm-12">
                            <?php
                            include_once 'ClockWidget.php';
                            ?>
                        </div>

                        <div class="col-md-6 col-sm-12 componentdiv">
                            <form action="../Controller/SuppliersController.php?status=true" method="post">
                                <h4>Suppliers</h4>
                                <p>Here you can add and manage suppliers of the store.</p>
                                <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#AddSupplierModal">New Supplier</button>&nbsp;&nbsp;
                                <button type="submit" class="btn btn-block btn-half-primary" name="suppliersManageSubmit">Manage Suppliers</button>
                            </form>
                        </div>

                    </div>

                    <br>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-12">
                &nbsp;
            </div>

        </div>

        <div class="row flexer">

            <div class="col-md-6 col-sm-12">
                <div class="panel">
                    <form action="../Controller/SuppliersController.php?status=true" method="post">
                        <h4>Pending Payments</h4>
                        <p>Here you can view pending payments to suppliers</p>
                        <button type="submit" class="btn btn-block btn-primary" name="pendingPaymentsSubmit">View pending payments</button>
                    </form>
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="panel">
                    <form action="../Controller/SuppliersController.php?status=true" method="post">
                        <h4>Payments</h4>
                        <p>Here you can pay suppliers</p>
                        <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#AddPaymentModal">Make payment</button>&nbsp;&nbsp;
                        <button type="submit" class="btn btn-block btn-half-success" name="paymentsManageSubmit">View payments</button>
                    </form>
                </div>
            </div>

        </div>

    </div>

    <!-- Modals -->

    <?php

    include_once "SuppliersAddSupplierModal.php";

    include_once "SuppliersAddPaymentModal.php";

    ?>

    <!-- Modals end-->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <?php

    if (isset($_GET['msg'])) {
        $msg = base64_decode($_GET['msg']);
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }

    ?>

</body>

</html>