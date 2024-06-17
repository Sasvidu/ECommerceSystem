<?php

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
$userAddress = $_SESSION["userAddress"];

$explosion = explode(" ", $userName);
$Fname = $explosion[0];
$Lname = $explosion[1];

require_once '../Commons/ECommerceDB.php';
require_once '../Model/UserMyProfileModel.php';

$thisDBConnection = new DbConnection();
$myCon = $thisDBConnection->con;

if(isset($_SESSION["cart"])){
    $cartCount = count($_SESSION["cart"]);
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>My Profile</title>

    <link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../CSS/HeaderStyleslight.css">
    <link rel="stylesheet" type="text/css" href="../CSS/HeaderStylesUser.css">
    <link rel="stylesheet" type="text/css" href="../CSS/UserStyles.css">
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
                <span id="cartCount"> <?php if(isset($cartCount)){ echo $cartCount; } else { echo "0"; } ?> </span>

            </div>

        </div>

        <div class="col-1 flexer">
            <a href="UserMyProfile.php">
                <div id="imageHolderNav">
                    <?php
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

    <div class="container">

        <div class="row">

            <div class="col-md-3 col-sm-12">

                <a href="UserMyProfile.php">
                    <div class="card profileCard shadow py-1" style="left: 7%">

                        <div class="card-body">

                            <div class="text-uppercase">My Profile</div>
                            <i class="fa-solid fa-user cardIcon"></i>

                        </div>

                    </div>
                </a>

                <div class="col-12">&nbsp;</div>

                <a href="UserPasswordChange.php">
                    <div class="card passwordCard shadow py-1">

                        <div class="card-body">

                            <div class="text-uppercase">Change Password</div>
                            <i class="fa-solid fa-key cardIcon"></i>

                        </div>

                    </div>
                </a>

            </div>

            <div class="col-md-9 col-sm-12">

                <div class="panelProfile shadow">

                    <div class="panel2">

                        <div class="col-12 panel-headder">
                            <h2 style="color: #4e73df">My Profile</h2>
                        </div>

                        <div class="panel-body">

                            <form action="../Controller/UserMyProfileController.php?status=true" method="post" enctype="multipart/form-data">

                                <div class="row">
                                    <div class="col-12">
                                        &nbsp;
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-6">

                                        <label>First name:</label>
                                        <input id="UserFName" name="UserFName" value="<?php echo $Fname ?>" type="text" class="form-control">

                                    </div>

                                    <div class="col-6">

                                        <label>Last name:</label>
                                        <input id="UserLName" name="UserLName" value="<?php echo $Lname ?>" type="text" class="form-control">

                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        &nbsp;
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        &nbsp;
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-6">

                                        <div class="col-12">

                                            <label>Username:</label>
                                            <input id="UserEmail" name="UserEmail" value="<?php echo $userEmail ?>" type="email" class="form-control">

                                        </div>

                                        <div class="col-12">&nbsp;</div>
                                        <div class="col-12">&nbsp;</div>

                                        <div class="col-12">

                                            <label>Date of Birth:</label>
                                            <input id="UserDOB" name="UserDOB" value="<?php echo $userDOB ?>" type="date" class="form-control">

                                        </div>

                                        <div class="col-12">&nbsp;</div>
                                        <div class="col-12">&nbsp;</div>

                                        <div class="col-12">

                                            <label>My Role:</label>
                                            <input id="UserRole" name="UserRole" value="<?php echo $userRole ?>" type="text" class="form-control" readonly>

                                        </div>

                                    </div>

                                    <div class="col-6">

                                        <label>My Image:</label>
                                        <br><br>
                                        <div id="imageHolder" align="center">

                                            <?php

                                            getImage($myCon, $userEmail, $userId);

                                            ?>

                                        </div>

                                        <div id="ImageChooser">

                                            <br>
                                            <input id="UserImage" name="UserImage" type="file" class="form-control">

                                        </div>

                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        &nbsp;
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-12">

                                        <label>Address Name:</label>
                                        <input id="UserAddress" name="UserAddress" value="<?php echo $userAddress; ?>" type="text" class="form-control">

                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        &nbsp;
                                    </div>
                                </div>

                                <div class="col-12">
                                    <input id="UserId" name="UserId" value="<?php echo $userId ?>" type="hidden" class="form-control" readonly>
                                </div>

                                <div class="row">

                                    <div class="col-12 flexer">

                                        <button class="btn btn-block btn-primary" type="submit">Update Details</button>

                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>


        <?php

        if (isset($_GET['msg'])) {
            $msg = base64_decode($_GET['msg']);
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }

        ?>

</body>

</html>