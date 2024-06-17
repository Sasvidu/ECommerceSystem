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
    $_SESSION['limitEmployees'] = $_POST['limitSelector'];
    $limit = $_POST['limitSelector'];
    $page = 1;
}else{
    if(isset($_SESSION['limitEmployees'])){
        $limit = $_SESSION['limitEmployees'];
    }else{
        $_SESSION['limitEmployees'] = 10;
        $limit = 10;
    }
}

$start = ($page - 1) * $limit;


if (isset($_GET["search"])) {

    $filters = $_GET["search"];
    $page = 0;

    $sql = "SELECT * FROM employee JOIN job ON employee.emp_job_id = job.job_id WHERE CONCAT(emp_fname, emp_lname, emp_address, emp_dob, emp_nic, emp_email1, emp_email2, emp_telno1, emp_telno2, job_name, job_department) LIKE '%$filters%' AND emp_status=1 ORDER BY emp_id;";

    $result = $myCon->query($sql) or die($myCon->error);
    $resCheck = mysqli_num_rows($result);

    if ($resCheck > 0) {
        $employees = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $msg = "No records have been read from the database";
        $msg = base64_encode($msg);
        header("location: ../View/StaffManageEmployees.php?msg=$msg");
        exit();
    }

} else {

    $sql = "SELECT * FROM employee JOIN job ON employee.emp_job_id = job.job_id WHERE employee.emp_status = 1 ORDER BY emp_id ASC LIMIT $start, $limit;";
    $result = $myCon->query($sql) or die($myCon->error);
    $resCheck = mysqli_num_rows($result);

    if ($resCheck > 0) {
        $employees = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $msg = "No records have been read form the database";
        $msg = base64_encode($msg);
        header("location: ../View/Staff.php?msg=$msg");
        exit();
    }

}

$sqlNew = "SELECT count(emp_id) AS emp_id FROM employee";
$resultNew = $myCon->query($sqlNew) or die($myCon->error);
$empCount = $resultNew->fetch_all(MYSQLI_ASSOC);
$total = $empCount[0]['emp_id'];
$pages = ceil($total / $limit);

$previous = $page - 1;
$next = $page + 1;

?>

<!DOCTYPE html>
<html>

<head>

    <title>Manage Employees</title>

    <link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../CSS/HeaderStyleslight.css">
    <link rel="stylesheet" type="text/css" href="../CSS/StaffManageEmployeesStyles.css">
    <!--Custom select box CSS : -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

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
                        <a class="nav-link" href="#"> <button class="activeItem btnToTxt" type="submit" name="submit" value="navStaff"> Staff </button> </a>
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

    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <h2 class="TitleTxt">Manage Employees</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                &nbsp;
            </div>
        </div>

        <div class="row">
            <div class="col-9">

                <nav class="paginationNav">
                    <ul class="pagination">

                        <li class="page-item">
                            <a class="page-link" href="StaffManageEmployees.php?page=1">First</a>
                        </li>

                        <li class="page-item <?php if ($page == 1 || $page == 0) {
                                                    echo "disabled";
                                                } ?>">
                            <a class="page-link" href="StaffManageEmployees.php?page=<?php echo $previous; ?>">Previous</a>
                        </li>

                        <?php for ($i = 1; $i <= $pages; $i++) { ?>

                            <li class="page-item<?php if ($i == $page) {
                                                    echo " active";
                                                } ?>">
                                <a class="page-link" href="StaffManageEmployees.php?page=<?php echo $i; ?>"> <?php echo $i; ?> </a>
                            </li>

                        <?php } ?>

                        <li class="page-item  <?php if ($page == $pages || $page == 0) {
                                                    echo "disabled";
                                                } ?>">
                            <a class="page-link" href="StaffManageEmployees.php?page=<?php echo $next; ?>">Next</a>
                        </li>

                        <li class="page-item">
                            <a class="page-link" href="StaffManageEmployees.php?page=<?php echo $pages; ?>">Last</a>
                        </li>

                    </ul>
                </nav>

            </div>

            <div class="col-3">
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
                &nbsp;
            </div>
        </div>

    </div>

    <div class="container-fluid">

        <div class="row">
            <div class="col-12">

                <table class="table table-striped table-hover table-bordered table-responsive">

                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Address</th>
                            <th scope="col">Date of Birth</th>
                            <th scope="col">NIC</th>
                            <th scope="col">Email 01</th>
                            <th scope="col">Email 02</th>
                            <th scope="col">Telephone 01</th>
                            <th scope="col">Telephone 02</th>
                            <th scope="th-sm">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($employees as $employee) { ?>
                            <tr>

                                <?php
                                $EmpName = $employee["emp_fname"] . " " . $employee["emp_lname"]
                                ?>

                                <th scope="row"><?php echo $employee['emp_id'] ?></th>
                                <td id="EmpName<?php echo $employee['emp_id'] ?>"> <?php echo $EmpName ?></td>
                                <td id="JobId<?php echo $employee['emp_id'] ?>"> <?php echo $employee['job_name'] ?></td>
                                <td> <?php echo "<textarea id='EmpAddress" . $employee['emp_id'] . "' rows='2'>" . $employee['emp_address'] . "</textarea>" ?> </td>
                                <td id="EmpDOB<?php echo $employee['emp_id'] ?>"> <?php echo $employee['emp_dob'] ?></td>
                                <td id="EmpNIC<?php echo $employee['emp_id'] ?>"> <?php echo $employee['emp_nic'] ?></td>
                                <td id="EmpEmail1<?php echo $employee['emp_id'] ?>"> <?php echo $employee['emp_email1'] ?></td>
                                <td id="EmpEmail2<?php echo $employee['emp_id'] ?>"> <?php echo $employee['emp_email2'] ?></td>
                                <td id="EmpTel1<?php echo $employee['emp_id'] ?>"> <?php echo $employee['emp_telno1'] ?></td>
                                <td id="EmpTel2<?php echo $employee['emp_id'] ?>"> <?php echo $employee['emp_telno2'] ?></td>

                                <td>
                                    <button type="button" class="btn btn-sm btn-danger" name="deleteButton" id="del<?php echo $employee['emp_id'] ?>" onclick="openDeleteEmpModal(this.id)"><i class="fa-solid fa-trash-can"></i>&nbsp;Delete</button>&nbsp;
                                    <button type="button" class="btn btn-sm btn-info" name="editButton" id="edit<?php echo $employee['emp_id'] ?>" onclick="openEditEmpModal(this.id)"><i class="fa-solid fa-pen-to-square"></i>&nbsp;Edit</button>
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


    <?php

    include_once "StaffEditEmployeeModal.php";

    include_once "StaffDeleteEmployeeModal.php";

    ?>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>
    <script src="../JS/StaffManageEmployeesJS.js"></script>

    <!--Custom select box JS : -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <?php

    if (isset($_GET['msg'])) {
        $msg = base64_decode($_GET['msg']);
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }

    ?>

</body>

</html>