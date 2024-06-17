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

    <title>Ordering Module</title>

    <link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../CSS/HeaderStyles.css">
    <link rel="stylesheet" type="text/css" href="../CSS/DeliveryStyles.css">
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

        </div>

        <div class="row">

            <div class="col-md-4 col-sm-12">

                <a href="../View/DeliveryManageDeliveries.php">
                    <div class="card scheduleCard shadow">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12">
                                    &nbsp;
                                </div>

                                <div class="col-12">
                                    &nbsp;
                                </div>
                            </div>

                            <div class="row flexer">
                                <i class="fa-solid fa-truck IconImage"></i>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    &nbsp;
                                </div>
                            </div>

                            <div class="row flexer">
                                <div class="cardText">Schedule Delivery</div>
                            </div>

                        </div>
                    </div>
                </a>

            </div>

            <div class="col-md-4 col-sm-12">

                <a href="../View/DeliveryAllocateDeliveries.php">
                    <div class="card allocateCard shadow">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12">
                                    &nbsp;
                                </div>

                                <div class="col-12">
                                    &nbsp;
                                </div>
                            </div>

                            <div class="row flexer">
                                <i class="fa-solid fa-box IconImage"></i>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    &nbsp;
                                </div>
                            </div>

                            <div class="row flexer">
                                <div class="cardText">Allocate Order</div>
                            </div>

                        </div>
                    </div>
                </a>

            </div>

            <div class="col-md-4 col-sm-12">

                <a href="../View/DeliveryManageAgents.php">
                    <div class="card agentCard shadow">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12">
                                    &nbsp;
                                </div>

                                <div class="col-12">
                                    &nbsp;
                                </div>
                            </div>

                            <div class="row flexer">
                                <i class="fa-solid fa-user-tie IconImage"></i>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    &nbsp;
                                </div>
                            </div>

                            <div class="row flexer">
                                <div class="cardText">Manage Agents</div>
                            </div>

                        </div>
                    </div>
                </a>

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

        <div class="row">

            <div class="col-md-4 col-sm-0">

                &nbsp;

            </div>

            <div class="col-md-4 col-sm-12">

                <a href="../View/DeliveryViewCompletedDeliveries.php">
                    <div class="card viewCard shadow">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12">
                                    &nbsp;
                                </div>

                                <div class="col-12">
                                    &nbsp;
                                </div>
                            </div>

                            <div class="row flexer">
                                <i class="fa-solid fa-clipboard-check IconImage"></i>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    &nbsp;
                                </div>
                            </div>

                            <div class="row flexer">
                                <div class="cardText">Completed Deliveries</div>
                            </div>

                        </div>
                    </div>
                </a>

            </div>

            <div class="col-md-4 col-sm-0">

                &nbsp;

            </div>

        </div>


        <!--<script src="../JS/Inventory.js"></script>-->
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