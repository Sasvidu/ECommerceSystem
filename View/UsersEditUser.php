<?php

session_start();
if (!isset($_SESSION["userName"])) {
    $msg = "Please login first";
    $msg = base64_encode($msg);
    header("location: ../View/Login.php?msg=$msg");
}

$myUserName = $_SESSION['userName'];
$myUserId = $_SESSION['userId'];
$myUserImage = $_SESSION['userImage'];
$myUserRole = $_SESSION['userRole'];
$myUserEmail = $_SESSION['userEmail'];
$myUserAddress = $_SESSION['userAddress'];

//Specific code:

require_once "../Commons/ECommerceDB.php";
$thisDBConnection = new DbConnection();
$myCon = $thisDBConnection->con;

if (isset($_POST["search"])) {

    $filter = mysqli_real_escape_string($myCon, $_POST["search"]);
    $page = 0;

    $sql = "SELECT * FROM user WHERE user_email = ?;";

    $stmt = $myCon->prepare($sql);
    $stmt->bind_param("s", $filter);

    $stmt->execute();
    $result = $stmt->get_result();
    $resCheck = mysqli_num_rows($result);

    if ($resCheck > 0) {
        $thisUser = $result->fetch_assoc();

        $UserFName = $thisUser['user_fname'];
        $UserLName = $thisUser['user_lname'];
        $UserDOB = $thisUser['user_dob'];
        $UserNIC = $thisUser['user_nic'];
        $UserRoleId = $thisUser['user_role_id'];
        $UserAddress = $thisUser['user_address'];
        $UserEmail = $filter;

        if ($UserRoleId == 1) {
            $UserRole = "Admin";
        } else if ($UserRoleId == 2) {
            $UserRole = "User";
        } else if ($UserRoleId == 3) {
            $UserRole = "Clerk";
        }
    } else {
        $msg = "No users found";
        $msg = base64_encode($msg);
        header("location: ../View/UsersEditUser.php?msg=$msg");
        exit();
    }
} else {

    $UserFName = "";
    $UserLName = "";
    $UserDOB = "";
    $UserNIC = "";
    $UserRoleId = "";
    $UserRole = "";
    $UserEmail = "";
    $UserAddress = "";

}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Edit Users</title>

    <link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../CSS/HeaderStyleslight.css">
    <link rel="stylesheet" type="text/css" href="../CSS/UsersStyles.css">
    <script src="https://kit.fontawesome.com/0c49cb8566.js" crossorigin="anonymous"></script>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">

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
                        <a class="nav-link" href="#"> <button class="activeItem btnToTxt" type="submit" name="submit" value="navProfile"> Users </button> </a>
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

    <div class="row">

        <div class="col-12">&nbsp;</div>
        <div class="col-12">&nbsp;</div>

    </div>

    <div class="container">

        <div class="row">

            <div class="col-md-3 col-sm-12">

                <a href="UsersMyProfile.php">
                    <div class="card profileCard shadow py-1">

                        <div class="card-body">

                            <div class="text-uppercase">My Profile</div>
                            <i class="fa-solid fa-user cardIcon"></i>

                        </div>

                    </div>
                </a>

                <div class="col-12">&nbsp;</div>

                <a href="UsersPasswordReset.php">
                    <div class="card passwordCard shadow py-1">

                        <div class="card-body">

                            <div class="text-uppercase">Change Password</div>
                            <i class="fa-solid fa-key cardIcon"></i>

                        </div>

                    </div>
                </a>

                <div class="col-12">&nbsp;</div>

                <a href="UsersAddUser.php">
                    <div class="card addCard shadow py-1">

                        <div class="card-body">

                            <p class="text-uppercase">Add User</p>
                            <i class="fa-solid fa-plus cardIcon"></i>

                        </div>

                    </div>
                </a>

                <div class="col-12">&nbsp;</div>

                <?php

                if ($myUserRole === "Admin") {
                ?>

                    <a href="UsersEditUser.php">
                        <div class="card editCard shadow py-1" style="left: 7%">

                            <div class="card-body">

                                <p class="text-uppercase">Edit User</p>
                                <i class="fa-solid fa-pen cardIcon"></i>

                            </div>

                        </div>
                    </a>

                <?php
                } else {

                ?>

                    <script>
                        window.location = "UsersAddUser.php";
                    </script>

                <?php

                }

                ?>

                <div class="col-12">&nbsp;</div>

            </div>

            <div class="col-md-9 col-sm-12">

                <div class="panelEdit shadow">

                    <div class="panel2">

                        <div class="col-12 panel-headder">
                            <h2 style="color: #f6c23e">Edit User</h2>
                        </div>

                        <div class="panel-body">

                            <div class="row">
                                <div class="col-12">
                                    &nbsp;
                                </div>
                            </div>

                            <form action="UsersEditUser.php" method="post">

                                <div class="input-group mb-3">
                                    <input id="search" name="search" value="<?php if (isset($_POST["search"])) {
                                                                                echo $_POST["search"];
                                                                            } ?>" type="email" class="form-control" placeholder="Enter the desired user's email">
                                    <button type="submit" class="btn btn-warning">Search</button>
                                </div>

                            </form>

                            <form action="../Controller/UsersEditUserController.php?status=true" method="post">

                                <div class="row">
                                    <div class="col-12">
                                        &nbsp;
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-6">

                                        <label>First name:</label>
                                        <input id="UserFName" name="UserFName" value="<?php echo $UserFName ?>" type="text" class="form-control">

                                    </div>

                                    <div class="col-6">

                                        <label>Last name:</label>
                                        <input id="UserLName" name="UserLName" value="<?php echo $UserLName ?>" type="text" class="form-control">

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

                                    <div class="col-6">

                                        <label>Username:</label>
                                        <input id="UserEmail" name="UserEmail" value="<?php echo $UserEmail ?>" type="email" class="form-control" readonly>

                                    </div>

                                    <div class="col-6">

                                        <label>NIC:</label>
                                        <input id="UserNIC" name="UserNIC" value="<?php echo $UserNIC ?>" type="text" class="form-control">

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

                                    <div class="col-6">

                                        <label>Date of Birth:</label>
                                        <input id="UserDOB" name="UserDOB" value="<?php echo $UserDOB ?>" type="date" class="form-control">

                                    </div>

                                    <div class="col-6">

                                        <label>User Role:</label>
                                        <select id="UserRole" name="UserRole" class="form-select">
                                            <option selected value="<?php echo $UserRoleId ?>"><?php echo $UserRole ?></option>

                                            <?php if ($UserRoleId == 1) { ?>

                                                <option value="2">User</option>
                                                <option value="3">Clerk</option>

                                            <?php } else if ($UserRoleId == 2) { ?>

                                                <option value="1">Admin</option>
                                                <option value="3">Clerk</option>

                                            <?php } else if ($UserRoleId == 3) { ?>

                                                <option value="1">Admin</option>
                                                <option value="2">User</option>

                                            <?php } ?>
                                        </select>

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

                                    <div class="col-12">

                                        <label>Address:</label>
                                        <input id="UserAddress" name="UserAddress" value="<?php echo $UserAddress ?>" type="text" class="form-control">

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

                                    <div class="col-12 flexer">
                                        <button class="btn btn-block btn-warning" type="submit">Update Details</button>
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