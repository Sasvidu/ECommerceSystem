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

require_once "../Commons/ECommerceDB.php";
require_once "../Model/ClerkHomeModel.php";

$thisDBConnection = new DbConnection();
$myCon = $thisDBConnection->con;

$year = date("Y");
$month = date("n");

if ($month == 1) {
    $pendingYear = $year - 1;
    $pendingMonth = 12;
} else {
    $pendingYear = $year;
    $pendingMonth = $month - 1;
}

//Get payments

$totalPayment = getTotalPayment($myCon, $year, $month);
$totalMonthSales = getMonthSales($myCon, $year, $month);
$totalYearSales = getYearSales($myCon, $year);
$totalPendingSalaries = getTotalPendingSalaries($myCon, $pendingYear, $pendingMonth);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Dashboard</title>

    <link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../CSS/HeaderStyles.css">
    <link rel="stylesheet" type="text/css" href="../CSS/AdminHomeStyles.css">
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

            <form action="../Controller/ClerkHeaderController.php" method="post">
                <ul class="navbar-nav mr-auto navLinks">

                    <li id="nav1" class="nav-item">
                        <a class="nav-link" href="#"> <button class="activeItem btnToTxt" type="submit" name="submit" value="navHome"> Home </button> </a>
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
                        <a class="nav-link" href="#"> <button class="btnToTxt" type="submit" name="submit" value="navDelivery"> Deliveries </button> </a>
                    </li>

                    <li id="nav6" class="nav-item">
                        <a class="nav-link" href="#"> <button class="btnToTxt" type="submit" name="submit" value="navLogout"> Log out </button> </a>
                    </li>

                </ul>
            </form>

        </div>

    </nav>

    <div class="container-fluid">

        <div class="row">

            <div class="col-12">
                &nbsp;
            </div>

        </div>

        <div class="row">

            <div class="col-md-1 col-sm-0"></div>

            <div class="col-md-10 col-sm-12 dashboardCardRow">

                <div class="card dashboardCard primaryCard shadow">

                    <div class="card-body">

                        <div class="text-uppercase">Revenue (Monthly)</div>
                        <div class="dataText">LKR <?php echo "$totalMonthSales"; ?></div>
                        <i class="fa-solid fa-calendar cardIcon"></i>

                    </div>

                </div>

                <div class="card dashboardCard successCard shadow">

                    <div class="card-body">

                        <div class="text-uppercase">Revenue (Yearly)</div>
                        <div class="dataText">LKR <?php echo "$totalYearSales"; ?></div>
                        <i class="fa-solid fa-dollar-sign cardIcon"></i>

                    </div>

                </div>

                <div class="card dashboardCard warningCard shadow">

                    <div class="card-body">

                        <div class="text-uppercase">Payments (Monthly)</div>
                        <div class="dataText">LKR <?php echo "$totalPayment"; ?></div>
                        <i class="fa-solid fa-file-invoice-dollar cardIcon"></i>

                    </div>

                </div>

                <div class="card dashboardCard dangerCard shadow">

                    <div class="card-body">

                        <div class="text-uppercase">
                            Pending Salaries &nbsp;
                            <span class="tt" data-bs-placement="top" title="Pending salaires of employees for the previous month">
                                <img src="../Commons/Icons/tooltip.webp" class="ttImg">
                            </span>
                        </div>
                        <div class="dataText"><?php echo "$totalPendingSalaries"; ?> Employees</div>
                        <i class="fa-solid fa-user-xmark cardIcon"></i>

                    </div>

                </div>

            </div>

            <div class="col-md-1 col-sm-0"></div>

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

            <div class="col-md-1 col-sm-0"></div>

            <div class="col-md-4 col-sm-12">

                <div class="panel profilePanel shadow">

                    <div class="row">

                        <div class="col-12">
                            &nbsp;
                        </div>
                        <h3 align="center" class="styledText">Profile</h3>
                        <br><br>

                        <div id="imageHolder" align="center">

                            <?php
                            getImage($myCon, $userEmail, $userId);
                            ?>

                        </div>

                    </div>

                    <br>

                    <div class="row">

                        <?php
                        echo "<h6 align='center' class='styledText'>" . $userName . "</h3>";
                        echo "<h6 align='center' class='styledText'>" . $userRole . "</h2>";
                        ?>

                    </div>

                    <br>

                </div>

            </div>

            <div class="col-md-6 col-sm-12">

                <div class="panel panelModules shadow">

                    <div class="row">

                        <div class="col-12">

                            <a class="link" href="Inventory.php">
                                <div class="panel panelModule">

                                    <div><img src="../Commons/Icons/iconset/purchasinginverted.png" class="moduleImage"></div>
                                    <div><span class="moduleText">Inventory</span></div>

                                </div>
                            </a>

                            <a class="link" href="Staff.php">
                                <div class="panel panelModule">

                                    <div><img src="../Commons/Icons/iconset/employeeInverted.png" class="moduleImage"></div>
                                    <div><span class="moduleTextEmp">Employees</span></div>

                                </div>
                            </a>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-12">

                            <a class="link" href="Suppliers.php">
                                <div class="panel panelModule">

                                    <div><i class="fa-solid fa-truck-field moduleIcon"></i></div>
                                    <div><span class="moduleText">Suppliers</span></div>

                                </div>
                            </a>

                            <a class="link" href="UsersAddUser.php">
                                <div class="panel panelModule">

                                    <div><i class="fa-solid fa-users moduleIcon2"></i></div>
                                    <div><span class="moduleTextUser">Users</span></div>

                                </div>
                            </a>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-md-1 col-sm-0"></div>

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
                <h3 class="messageText"> Messages </h3>
            </div>

        </div>

        <div class="row">

            <div class="col-12">
                &nbsp;
            </div>

        </div>

        <div class="row">

            <div class="col-1"></div>

            <div class="col-10">

                <div class="accordion messageAccordion" id="inventoryAccordion">

                    <div class="accordion-item">

                        <h2 class="accordion-header" id="inventoryAccordion">

                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#inventoryCollapse" aria-expanded="true" aria-controls="inventoryCollapse">
                                Inventory Module
                            </button>

                        </h2>

                        <div id="inventoryCollapse" class="accordion-collapse collapse" aria-labelledby="inventoryAccordion" data-bs-parent="#inventoryAccordion">

                            <div class="accordion-body">

                                <?php

                                //Checking for inventory items who are below buffer level:

                                $sql = "SELECT * FROM stock JOIN product ON stock_product_id = product_id WHERE stock_status = 1;";
                                $stmt = mysqli_stmt_init($myCon);

                                if (!mysqli_stmt_prepare($stmt, $sql)) {
                                    $msg = "Error: MySQL statement Failed";
                                    $msg = base64_encode($msg);
                                ?>
                                    <script>
                                        window.location = "../View/Error.php?msg=<?php echo $msg; ?>"
                                    </script>
                                <?php
                                    exit();
                                }

                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                $rows = mysqli_num_rows($result);

                                if ($rows > 0) {

                                    while ($stock = mysqli_fetch_assoc($result)) {

                                        $bufferQty = $stock['stock_qty_buffer'];
                                        $currentQty = $stock['stock_qty_current'];
                                        if ($currentQty <= $bufferQty) {
                                            $message = "<div class='panel messsagePanel'>Buffer inventory level of&nbsp;<strong>" . $stock['product_name'] . "</strong>&nbsp;(" . $currentQty . " out of " . $bufferQty . ") had been reached.</div>";
                                            echo $message;
                                        }
                                    }
                                } else {
                                    $message = "<div class='panel messsagePanel'>There is sufficient stock available for all products.</div>";
                                    echo $message;
                                }

                                mysqli_stmt_close($stmt);

                                ?>

                                <div class="row">

                                    <div class="col-12">
                                        &nbsp;
                                    </div>

                                    <form action="InventoryAvaliableStocksReport.php?status=true" method="post" class="flexer">
                                        <button type="submit" formtarget="_blank" class="btn btn-block btn-primary" name="inventoryAvailiableSubmit">See Available Inventory</button>
                                    </form>

                                    <div class="col-12">
                                        &nbsp;
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="accordion-item">

                        <h2 class="accordion-header" id="supplierAccordion">

                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#supplierCollapse" aria-expanded="true" aria-controls="supplierCollapse">
                                Supplier Module
                            </button>

                        </h2>

                        <div id="supplierCollapse" class="accordion-collapse collapse" aria-labelledby="supplierAccordion" data-bs-parent="#supplierAccordion">

                            <div class="accordion-body">

                                <?php

                                //Check for orders yet to be paid:

                                $sqla = "SELECT * FROM stockorder JOIN product ON order_product_id = product_id JOIN supplier ON order_supplier_id = supplier_id WHERE order_completed_payment < order_payment AND order_status = 1;";
                                $stmta = mysqli_stmt_init($myCon);

                                if (!mysqli_stmt_prepare($stmta, $sqla)) {
                                    $msg = "Error: MySQL statement Failed";
                                    $msg = base64_encode($msg);
                                ?>
                                    <script>
                                        window.location = "../View/Error.php?msg=<?php echo $msg; ?>"
                                    </script>
                                <?php
                                    exit();
                                }

                                mysqli_stmt_execute($stmta);
                                $resulta = mysqli_stmt_get_result($stmta);
                                $rowsa = mysqli_num_rows($resulta);

                                if ($rowsa > 0) {

                                    while ($order = mysqli_fetch_assoc($resulta)) {

                                        $orderPendingPayment = $order['order_payment'] - $order['order_completed_payment'];
                                        $orderId = $order['order_id'];
                                        $productName = $order['product_name'];
                                        $supplierName = $order['supplier_name'];

                                        if ($currentQty <= $bufferQty) {
                                            $message = "<div class='panel messsagePanel'>Payment of &nbsp;<strong>" . $orderPendingPayment . "</strong>&nbsp;is pending to&nbsp;<strong>" . $supplierName . "</strong>&nbsp;for Order Id : &nbsp;<strong>" . $orderId . "</strong> </div>";
                                            echo $message;
                                        }
                                    }
                                } else {
                                    $message = "<div class='panel messsagePanel'>No pending payments on any orders.</div>";
                                    echo $message;
                                }

                                mysqli_stmt_close($stmta);

                                echo "<br>";

                                //Check for total owed to suppliers:

                                $sqlb = "SELECT * FROM supplier WHERE supplier_pending_payment > 0 AND supplier_status = 1;";
                                $stmtb = mysqli_stmt_init($myCon);

                                if (!mysqli_stmt_prepare($stmtb, $sqlb)) {
                                    $msg = "Error: MySQL statement Failed";
                                    $msg = base64_encode($msg);
                                ?>
                                    <script>
                                        window.location = "../View/Error.php?msg=<?php echo $msg; ?>"
                                    </script>
                                <?php
                                    exit();
                                }

                                mysqli_stmt_execute($stmtb);
                                $resultb = mysqli_stmt_get_result($stmtb);
                                $rowsb = mysqli_num_rows($resultb);

                                if ($rowsb > 0) {

                                    while ($supplier = mysqli_fetch_assoc($resultb)) {

                                        $supplierName = $supplier['supplier_name'];

                                        $supplierPendingPayment = $supplier['supplier_pending_payment'];
                                        $supplierPendingPayment = abs($supplierPendingPayment); //Remove trailing zeros

                                        $message = "<div class='panel messsagePanel'>Total owed to&nbsp;<strong>" . $supplierName . "</strong>&nbsp;is&nbsp;<strong>" . $supplierPendingPayment . "</strong></div>";
                                        echo $message;
                                    }
                                } else {
                                    $message = "<div class='panel messsagePanel'>No money is owed to any suppliers.</div>";
                                    echo $message;
                                }

                                mysqli_stmt_close($stmtb);

                                //echo "<br>";

                                //Check for total owed by suppliers (to us):

                                /*

                                $sqlc = "SELECT * FROM supplier WHERE supplier_pending_payment < 0 AND supplier_status = 1;";
                                $stmtc = mysqli_stmt_init($myCon);

                                if (!mysqli_stmt_prepare($stmtc, $sqlc)) {
                                    $msg = "Error: MySQL statement Failed";
                                    $msg = base64_encode($msg);
                                ?>
                                    <script>
                                        window.location = "../View/Error.php?msg=<?php echo $msg; ?>"
                                    </script>
                                <?php
                                    exit();
                                }

                                mysqli_stmt_execute($stmtc);
                                $resultc = mysqli_stmt_get_result($stmtc);
                                $rowsc = mysqli_num_rows($resultc);

                                if ($rowsc > 0) {

                                    while ($supplier = mysqli_fetch_assoc($resultc)) {

                                        $supplierName = $supplier['supplier_name'];

                                        $supplierPendingPayment = $supplier['supplier_pending_payment'];
                                        $supplierPendingPayment = abs($supplierPendingPayment); //Remove negative sign and trailing zeros


                                        $message = "<div class='panel messsagePanel'>Total owed to us by&nbsp;<strong>" . $supplierName . "</strong>&nbsp;is&nbsp;<strong>" . $supplierPendingPayment . "</strong></div>";
                                        echo $message;
                                    }
                                } else {
                                    $message = "<div class='panel messsagePanel'>No money is owed to us by any suppliers.</div>";
                                    echo $message;
                                }

                                mysqli_stmt_close($stmtc);

                                echo "<br>";

                                */

                                ?>

                            </div>

                        </div>

                    </div>

                    <div class="accordion-item">

                        <h2 class="accordion-header" id="staffAccordion">

                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#staffCollapse" aria-expanded="true" aria-controls="staffCollapse">
                                Staff Module
                            </button>

                        </h2>

                        <div id="staffCollapse" class="accordion-collapse collapse" aria-labelledby="staffAccordion" data-bs-parent="#staffAccordion">

                            <div class="accordion-body">

                                <?php

                                //Checking for employees who had to be paid in the previous month:

                                $sqld = "SELECT * FROM payroll JOIN employee ON payroll_emp_id = emp_id JOIN job ON emp_job_id = job_id WHERE payroll_year = ? AND payroll_month = ? AND payroll_paid_status = 0 AND payroll_status = 1;";
                                $stmtd = mysqli_stmt_init($myCon);

                                if (!mysqli_stmt_prepare($stmtd, $sqld)) {
                                    $msg = "Error: MySQL statement Failed";
                                    $msg = base64_encode($msg);
                                ?>
                                    <script>
                                        window.location = "../View/Error.php?msg=<?php echo $msg; ?>"
                                    </script>
                                <?php
                                    exit();
                                }

                                mysqli_stmt_bind_param($stmtd, "ss", $pendingYear, $pendingMonth);
                                mysqli_stmt_execute($stmtd);
                                $resultd = mysqli_stmt_get_result($stmtd);
                                $rowsd = mysqli_num_rows($resultd);

                                if ($rowsd > 0) {

                                    while ($payroll = mysqli_fetch_assoc($resultd)) {

                                        $empName = $payroll['emp_fname'] . " " . $payroll['emp_lname'];
                                        $empJob = $payroll['job_name'];
                                        $empSalary = $payroll['job_salary'];
                                        $empOTPay = $payroll['job_OTPay'];

                                        $message = "<div class='panel messsagePanel'>Salary has to be paid to&nbsp;<strong>" . $empName . "</strong>&nbsp;(" . $empJob . ") for last month (Base Salary : " . $empSalary . " & Hourly OT: " . $empOTPay . ").</div>";
                                        echo $message;
                                    }
                                } else {
                                    $message = "<div class='panel messsagePanel'>Salaries of last month are paid for all employees.</div>";
                                    echo $message;
                                }

                                mysqli_stmt_close($stmtd);

                                echo "<br>";

                                //Checking for employees who had to be paid in the previous month:

                                $sqle = "SELECT * FROM payroll JOIN employee ON payroll_emp_id = emp_id JOIN job ON emp_job_id = job_id WHERE payroll_year = ? AND payroll_month = ? AND payroll_paid_status = 0 AND payroll_status = 1;";
                                $stmte = mysqli_stmt_init($myCon);

                                if (!mysqli_stmt_prepare($stmte, $sqle)) {
                                    $msg = "Error: MySQL statement Failed";
                                    $msg = base64_encode($msg);
                                ?>
                                    <script>
                                        window.location = "../View/Error.php?msg=<?php echo $msg; ?>"
                                    </script>
                                <?php
                                    exit();
                                }

                                mysqli_stmt_bind_param($stmte, "ss", $year, $month);
                                mysqli_stmt_execute($stmte);
                                $resulte = mysqli_stmt_get_result($stmte);
                                $rowse = mysqli_num_rows($resulte);

                                if ($rowse > 0) {

                                    while ($payroll = mysqli_fetch_assoc($resulte)) {

                                        $empName = $payroll['emp_fname'] . " " . $payroll['emp_lname'];
                                        $empJob = $payroll['job_name'];
                                        $empSalary = $payroll['job_salary'];
                                        $empOTPay = $payroll['job_OTPay'];

                                        $message = "<div class='panel messsagePanel'>Salary has to be paid to&nbsp;<strong>" . $empName . "</strong>&nbsp;(" . $empJob . ") for this month (Base Salary : " . $empSalary . " & Hourly OT: " . $empOTPay . ").</div>";
                                        echo $message;
                                    }
                                } else {
                                    $message = "<div class='panel messsagePanel'>Salaries of this month are paid for all employees.</div>";
                                    echo $message;
                                }

                                mysqli_stmt_close($stmte);

                                ?>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-1"></div>

        </div>

        <div class="row">

            <div class="col-12">
                &nbsp;
            </div>

            <div class="col-12">
                &nbsp;
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <!--Tooltip enable-->
    <script>
        const tooltips = document.querySelectorAll('.tt');
        tooltips.forEach(t => {
            new bootstrap.Tooltip(t);
        })
    </script>

</body>

</html>