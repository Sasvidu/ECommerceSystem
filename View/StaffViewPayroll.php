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

if (!isset($_GET["status"])) {

    header("location: ../View/Staff.php");
    exit();
} else {

    if (isset($_POST['Year']) && isset($_POST['Month'])) {

        $Year = $_POST["Year"];
        $Month = $_POST["Month"];
        $_SESSION["Year"] = $Year;
        $_SESSION["Month"] = $Month;

    } else if (isset($_SESSION['Year']) && isset($_SESSION['Month'])) {

        $Year = $_SESSION["Year"];
        $Month = $_SESSION["Month"];

    }

    require_once "../Commons/ECommerceDB.php";
    require_once "../Model/StaffViewPayrollModel.php";
    $thisDBConnection = new DbConnection();
    $myCon = $thisDBConnection->con;

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    
    
    if(isset($_POST['limitSelector'])){
        $_SESSION['limitPayroll'] = $_POST['limitSelector'];
        $limit = $_POST['limitSelector'];
        $page = 1;
    }else{
        if(isset($_SESSION['limitPayroll'])){
            $limit = $_SESSION['limitPayroll'];
        }else{
            $_SESSION['limitPayroll'] = 10;
            $limit = 10;
        }
    }

    $start = ($page - 1) * $limit;

    if (isset($_POST["search"]) && ($_POST["search"]) != "") {

        $filters = $_POST["search"];
        $page = 0;

        $sql = "SELECT * FROM payroll JOIN employee ON payroll.payroll_emp_id = employee.emp_id JOIN job ON employee.emp_job_id = job.job_id WHERE CONCAT(payroll.payroll_days_attended, payroll.payroll_OTHours, payroll.payroll_amount, employee.emp_fname, employee.emp_lname, job.job_name) LIKE '%$filters%' AND payroll.payroll_year = $Year AND payroll.payroll_month = $Month AND payroll.payroll_status=1 ORDER BY payroll.payroll_emp_id, payroll.payroll_paid_status;";

        $result = $myCon->query($sql) or die($myCon->error);
        $resCheck = mysqli_num_rows($result);

        if ($resCheck > 0) {
            $payrolls = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $msg = "No records have been read from the database";
            $msg = base64_encode($msg);
            header("location: ../View/StaffViewPayroll.php?status=true&msg=$msg");
            exit();
        }

    } else {

        $sql = "SELECT * FROM payroll JOIN employee ON payroll.payroll_emp_id = employee.emp_id WHERE payroll.payroll_status = 1 AND payroll.payroll_year = $Year AND payroll.payroll_month = $Month ORDER BY payroll.payroll_emp_id, payroll.payroll_paid_status ASC LIMIT $start, $limit;";
        $result = $myCon->query($sql) or die($myCon->error);
        $resCheck = mysqli_num_rows($result);

        if ($resCheck > 0) {
            $payrolls = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $msg = "No records have been read form the database";
            $msg = base64_encode($msg);
            header("location: ../View/Staff.php?msg=$msg");
            exit();
        }
    }

    $sqlNew = "SELECT count(payroll_emp_id) AS payroll_emp_id FROM payroll WHERE payroll.payroll_status = 1 AND payroll.payroll_year = $Year AND payroll.payroll_month = $Month;";
    $resultNew = $myCon->query($sqlNew) or die($myCon->error);
    $payrollCount = $resultNew->fetch_all(MYSQLI_ASSOC);
    $total = $payrollCount[0]['payroll_emp_id'];
    $pages = ceil($total / $limit);

    $previous = $page - 1;
    $next = $page + 1;
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>View Payroll</title>

    <link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../CSS/HeaderStyleslight.css">
    <link rel="stylesheet" type="text/css" href="../CSS/StaffViewPayrollStyles.css">
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

    <div class="container">

        <div class="row">
            <div class="col-12">
                <h2 class="TitleTxt">Salaries of Employees at <?php echo getMonthName($Month); ?>, <?php echo $Year ?> </h2>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                &nbsp;
            </div>
        </div>

        <div class="row">
            <div class="col-6">

                <nav class="paginationNav">
                    <ul class="pagination">

                        <li class="page-item">
                            <a class="page-link" href="StaffViewPayroll.php?status=true&page=1">First</a>
                        </li>

                        <li class="page-item <?php if ($page == 1 || $page == 0) {
                                                    echo "disabled";
                                                } ?>">
                            <a class="page-link" href="StaffViewPayroll.php?status=true&page=<?php echo $previous; ?>">Previous</a>
                        </li>

                        <?php for ($i = 1; $i <= $pages; $i++) { ?>

                            <li class="page-item<?php if ($i == $page) {
                                                    echo " active";
                                                } ?>">
                                <a class="page-link" href="StaffViewPayroll.php?status=true&page=<?php echo $i; ?>"> <?php echo $i; ?> </a>
                            </li>

                        <?php } ?>

                        <li class="page-item <?php if ($page == $pages || $page == 0) {
                                                    echo "disabled";
                                                } ?>">
                            <a class="page-link" href="StaffViewPayroll.php?status=true&page=<?php echo $next; ?>">Next</a>
                        </li>

                        <li class="page-item">
                            <a class="page-link" href="StaffViewPayroll.php?status=true&page=<?php echo $pages; ?>">Last</a>
                        </li>

                    </ul>
                </nav>

            </div>

            <div class="col-6">
                <form action="" method="post">
                    <div class="input-group mb-3">

                        <select id="Year" name="Year" class="selectpicker" data-live-search="true" data-width="auto">
                            <option value=<?php echo $Year ?> selected> <?php echo $Year ?> </option>
                            <?php for ($i = 2020; $i < 3000; $i++) { ?>
                                <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
                            <?php } ?>
                        </select>

                        &nbsp;&nbsp;&nbsp;

                        <select id="Month" name="Month" class="selectpicker" data-width="auto">
                            <option value=<?php echo $Month ?> selected> <?php echo $Month ?> </option>
                            <?php for ($i = 1; $i < 13; $i++) { ?>
                                <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
                            <?php } ?>
                        </select>

                        &nbsp;&nbsp;&nbsp;

                        <input id="search" name="search" value="<?php if (isset($_POST["search"])) {
                                                                    echo $_POST["search"];
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

        <div class="row">
            <div class="col-12">

                <table class="table table-striped table-hover table-bordered table-responsive">

                    <thead>
                        <tr>
                            <th scope="col">Employee Name</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Days Attended</th>
                            <th scope="col">Overtime Hours</th>
                            <th scope="col">Amount</th>
                            <th scope="th-sm">
                                <span style="padding-left:35%">Status</span>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($payrolls as $payroll) { ?>
                            <tr>

                                <?php
                                $EmpName = $payroll["emp_fname"] . " " . $payroll["emp_lname"]
                                ?>

                                <td id="EmpName<?php echo $payroll['emp_id'] ?>"> <?php echo $EmpName ?></td>
                                <td id="JobName<?php echo $payroll['emp_id'] ?>"> <?php echo getJobName($myCon, $payroll['emp_job_id']) ?></td>
                                <td id="DaysAttended<?php echo $payroll['emp_id'] ?>"> <?php echo $payroll['payroll_days_attended'] ?></td>
                                <td id="OTHours<?php echo $payroll['emp_id'] ?>"> <?php echo $payroll['payroll_OTHours'] ?></td>
                                <td id="Amount<?php echo $payroll['emp_id'] ?>"> <?php echo $payroll['payroll_amount'] ?></td>
                                <td id="Status<?php echo $payroll['emp_id'] ?>" align="center">
                                    <?php
                                    if ($payroll['payroll_paid_status'] == 0) {
                                        echo "<button class='btn btn-block btn-danger'> Pending </button>";
                                    } else if ($payroll['payroll_paid_status'] == 1) {
                                        echo "<button class='btn btn-block btn-half-success'> Paid </button>";
                                    } else {
                                        echo "<button class='btn btn-block btn-warning'> Unavailable </button>";
                                    }
                                    ?>
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



    ?>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>
    <script src="../JS/StaffManagePayrollJS.js"></script>

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