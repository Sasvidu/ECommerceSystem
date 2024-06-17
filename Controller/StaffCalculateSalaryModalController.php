<?php

if (!isset($_GET["status"])) {

    header("location: ../View/Staff.php");
    exit();
} else {

    session_start();
    if (!isset($_SESSION["userName"])) {
        $msg = "Please login first";
        $msg = base64_encode($msg);
        header("location: ../View/Login.php?msg=$msg");
    }

    require_once "../Model/StaffCalculateSalaryModalModel.php";
    require_once '../Commons/ECommerceDB.php';

    $thisDBConnection = new DbConnection();
    $myCon = $thisDBConnection->con;

    $Id = $_POST["Id"];
    $Ids = explode('-', $Id);

    $EmpId = array_shift($Ids);
    $JobId = end($Ids);

    $WorkedDays = $_POST["WorkedDays"];
    $OTHours = $_POST["OTHours"];
    $Year = $_POST["Year"];
    $Month = $_POST["Month"];
    $Salary = getJobSalary($myCon, $JobId);
    $OTPay = getJobOT($myCon, $JobId);

    if (InputCheck($EmpId, $WorkedDays, $OTHours, $Year, $Month) === true) {

        $Amount = calculateSalary($Salary, $OTPay, $WorkedDays, $OTHours);
        ?>
        <!DOCTYPE html>
        <html>

        <head>
            <link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="../CSS/StaffCalculateSalaryModalControllerStyles.css">
        </head>

        <body>

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

                    <div class="col-12">
                        &nbsp;
                    </div>

                    <div class="col-12">
                        &nbsp;
                    </div>

                    <div class="col-12">
                        &nbsp;
                    </div>

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

                    <div class="col-md-4 col-sm-0">
                        &nbsp;
                    </div>

                    <div class="col-md-4 col-sm-12 panel">

                        <form action="../Controller/StaffCalculateSalaryModalControllerController.php?status=true" method="post">

                            <div class="panel-heading">

                                <h3 align="center">Salary</h3>

                            </div>

                            <div class="panel-body">

                                <div class="row">

                                    <div class="col-12">
                                        &nbsp;
                                    </div>

                                    <div class="col-12">
                                        &nbsp;
                                    </div>

                                    <div class="col-12 txtbox">The payroll salary for the employee is : </div><br><br>

                                    <div class="col-12">
                                        <input id="Amount" name="Amount" value=<?php echo $Amount ?> type="number" min="0.00" step=".01" class="form-control" readonly>
                                    </div>

                                    <br><br><div class="col-12 txtbox">Has this amount been paid yet?</div>

                                    <div class="col-12">
                                        <input id="EmpId" name="EmpId" value=<?php echo $EmpId ?> type="hidden" class="form-control" readonly>
                                    </div>

                                    <div class="col-12">
                                        <input id="Year" name="Year" value=<?php echo $Year ?> type="hidden" class="form-control" readonly>
                                    </div>

                                    <div class="col-12">
                                        <input id="Month" name="Month" value=<?php echo $Month ?> type="hidden" class="form-control" readonly>
                                    </div>

                                    <div class="col-12">
                                        <input id="WorkedDays" name="WorkedDays" value=<?php echo $WorkedDays ?> type="hidden" class="form-control" readonly>
                                    </div>

                                    <div class="col-12">
                                        <input id="OTHours" name="OTHours" value=<?php echo $OTHours ?> type="hidden" class="form-control" readonly>
                                    </div>

                                    <div class="col-12">
                                        &nbsp;
                                    </div>
                                    
                                    <div class="col-12">
                                        &nbsp;
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-6 flexer">
                                        <button id="NoSubmit" name="NoSubmit" type="submit" class="btn btn-block btn-danger">No</button>
                                    </div>

                                    <div class="col-6 flexer">
                                        <button id="YesSubmit" name="YesSubmit" type="submit" class="btn btn-block btn-success">Yes</button>
                                    </div>

                                </div>

                            </div>

                        </form>

                    </div>

                    <div class="col-md-4 col-sm-0">
                        &nbsp;
                    </div>

                </div>

            </div>

        </body>

        </html>
    <?php
    }
}
