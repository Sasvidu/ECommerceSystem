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

    <title>Staff Module</title>

    <link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../CSS/HeaderStyleslight.css">
    <link rel="stylesheet" type="text/css" href="../CSS/StaffStyles.css">
    <!--Custom select box CSS : -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

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

    <div class="container">

        <div class="row">

            <div class="col-12">
                &nbsp;
            </div>

            <div class="col-12">
                &nbsp;
            </div>

        </div>

        <div class="row">

            <div class="col-md-4 col-sm-12">

                <div class="panel panelProfile">

                    <div class="row">

                        <h3 align="center">Profile</h3>

                        <br><br><br>

                        <div id="imageHolder" align="center">

                            <?php

                            require_once '../Commons/ECommerceDB.php';
                            require_once '../Model/StaffModel.php';

                            $thisDBConnection = new DbConnection();
                            $myCon = $thisDBConnection->con;

                            getImage($myCon, $userEmail, $userId);

                            ?>

                        </div>

                    </div>

                    <br>

                    <div class="row">

                        <?php

                        echo "<h6 align='center'>" . $userName . "</h3>";
                        echo "<h6 align='center'>" . $userRole . "</h2>";

                        ?>

                    </div>

                    <br><br><br><br>

                    <div class="row">

                        <?php
                        include_once 'ClockWidget.php';
                        ?>

                    </div>

                    <br>

                </div>

                <br>

                <div class="panel">

                    <h3>The Staff Module</h3>
                    <br>
                    <p style="text-align: justify;"> The Staff module can be used by admins and data entry clerks to deal with the registrations and payments of employees. The pending payments button can be used to select the employees whose salary has not been calculated and paid for for the month. Additionally, Designations themselves can also be managed.</p>
                    <br>

                </div>

            </div>

            <div class="col-md-1">
                &nbsp;
            </div>

            <div class="col-md-7 col-sm-12">

                <form action="../Controller/StaffController.php?status=true" method="post">

                    <div class="row">

                        <div class="panel panelJob">

                            <div class="panel panelJob2">

                                <div class="panel-heading">

                                    <h3 align="center">Employees</h3>

                                </div>

                                <div class="panel-body">

                                    <div class="row">

                                        <div class="col-4">
                                            <img src="../Commons/Icons/employee.png" width="100%" height="100%">
                                        </div>

                                        <div class="col-8">

                                            <div class="row panel-row">
                                                <p>Here you can register new employees and manage the details about them such as name, date of birth, address, etc...</p><br><br><br>
                                            </div>

                                            <br>

                                            <div class="row panelBtnHolder panel-row2">
                                                <button id="AddEmpButton" name="AddEmpButton" type="button" class="btn btn-block btn-half-emp" onclick="openAddEmployeeModal()">Register Employee</button> <br><br>
                                                <button id="ManageEmpButton" name="ManageEmpButton" type="submit" class="btn btn-block btn-half-emp">Manage Employees</button>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-12">

                            &nbsp;

                        </div>

                    </div>

                    <div class="row">

                        <div class="panel panelEmp">

                            <div class="panel panelEmp2">

                                <div class="panel-heading">

                                    <h3 align="center">Designations</h3>

                                </div>

                                <div class="panel-body">

                                    <div class="row">

                                        <div class="col-4">
                                            <img src="../Commons/Icons/job.png" width="100%" height="100%">
                                        </div>

                                        <div class="col-8">

                                            <div class="row panel-row">
                                                <p>Here you can add new designations (job titles) to the system as well as modify and delete them.</p><br><br><br>
                                            </div>
                                            <div class="row panelBtnHolder panel-row2">
                                                <button id="AddJobButton" name="AddJobButton" type="button" class="btn btn-block btn-half-job" onclick="openAddJobModal()">Add a Designation</button> <br><br>
                                                <button id="ManageJobButton" name="ManageJobButton" type="submit" class="btn btn-block btn-half-job">Manage Designations</button>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-12">

                            &nbsp;

                        </div>

                    </div>

                </form>

                <form action="../Controller/StaffViewPayrollModalController.php?status=true" method="post">

                    <div class="row">

                        <div class=" panel panelPayroll">

                            <div class="panel panelPayroll2">

                                <div class="panel-heading">

                                    <h3 align="center">Payroll</h3>

                                </div>

                                <div class="panel-body">

                                    <div class="row">

                                        <div class="col-4">
                                            <img src="../Commons/Icons/payroll.png" width="100%" height="100%">
                                        </div>

                                        <div class="col-8">

                                            <div class="row panel-row">
                                                <p>This will be used to calculate and record the salalaries of each employee for each month.</p>
                                            </div>

                                            <br>

                                            <div class="row panelBtnHolder panel-row2">
                                                <button id="CalcSalaryButton" name="CalcPayButton" type="button" class="btn btn-block btn-half-payroll" onclick="openCalculatePayrollModal()">Calculate salary</button> <br><br>
                                                <button id="ViewPendingSalaryButton" name="ViewPendingSalaryButton" type="submit" class="btn btn-block btn-half-payroll">View payroll</button>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

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

    <!--Modals-->

    <?php

    include_once "StaffAddJobModal.php";

    include_once "StaffAddEmployeeModal.php";

    include_once "StaffCalculateSalaryModal.php";

    //include_once "StaffViewPayrollModal.php";

    ?>

    <?php

    //Insert record to payroll table:

    $sql = "SELECT * FROM employee WHERE employee.emp_status = 1 ORDER BY emp_id ASC;";
    $result = $myCon->query($sql) or die($myCon->error);
    $resCheck = mysqli_num_rows($result);

    if ($resCheck > 0) {

        while ($row = mysqli_fetch_assoc($result)) {

            $year = date("Y");
            $month = date("n"); //No. of month in year
            $empId = $row["emp_id"];

            if (payrollExists($myCon, $year, $month, $empId) === false) {

                $sqlnew = "INSERT INTO payroll(payroll_emp_id, payroll_year, payroll_month) VALUES (?, ?, ?);";

                $stmt = mysqli_stmt_init($myCon);

                if (!mysqli_stmt_prepare($stmt, $sqlnew)) {
                    $msg = "Error: MySQL statement Failed";
    ?>
                    <script type='text/javascript'>
                        alert(<?php echo $msg ?>);
                    </script>
    <?php
                }

                mysqli_stmt_bind_param($stmt, "sss", $empId, $year, $month);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                /*Not displaying
                $code = "Payroll Updated Successfully";
                */
            }
        }
    }

    ?>

    <!--End-->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>
    <script src="../JS/StaffJS.js"></script>

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