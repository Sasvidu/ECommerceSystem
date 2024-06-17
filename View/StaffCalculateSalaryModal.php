<?php

require_once "../Commons/ECommerceDB.php";
require_once "../Model/StaffCalculateSalaryModalModel.php";

$thisDBConnection = new DbConnection();
$myCon = $thisDBConnection->con;

$sql = "SELECT * FROM employee WHERE emp_status = 1 ORDER BY emp_fname";
$result = $myCon->query($sql) or die($myCon->error);
$resCheck = mysqli_num_rows($result);

if ($resCheck > 0) {
    $employees = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $employees = array("emp_id" => "0", "emp_fname" => "Undefined");
}

?>


<div id="CalculateSalaryModal" class="modal fade" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form action="../Controller/StaffCalculateSalaryModalController.php?status=true" method="post">

                <div class="modal-header">
                    <h5 id="CalculateSalaryModalTitle" class="modal-title">Calculate Salary</h5>
                    <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-12">

                            <label>Employee Name:</label>
                            <select id="Id" name="Id" class="selectpicker" data-live-search="true" data-width="auto">
                                <option selected value="Unspecified">Select an employee to calculate the salary for : </option>
                                <?php foreach ($employees as $employee) {
                                    $EmpName = $employee["emp_fname"] . " " . $employee["emp_lname"] ?>
                                    <option value=<?php echo $employee['emp_id'] . "-" . $employee['emp_job_id'] ?>> <?php echo $EmpName ?> </option>
                                <?php } ?>
                            </select>

                        </div>

                        <div class="col-12">
                            &nbsp;
                        </div>

                        <div class="col-12">

                            <label>Worked days for the month:</label>
                            <input id="WorkedDays" name="WorkedDays" type="number" min="0" class="form-control" placeholder="Ex: 19 (days)">

                        </div>

                        <div class="col-12">
                            &nbsp;
                        </div>

                        <div class="col-12">

                            <label>Overtime hours for the month:</label>
                            <input id="OTHours" name="OTHours" type="number" min="0" class="form-control" placeholder="Ex: 3 (hours)">

                        </div>

                        <div class="col-12">
                            &nbsp;
                        </div>

                        <div class="col-6 flexer">

                            <label>Year : &nbsp;&nbsp;</label>
                            <select id="Year" name="Year" class="selectpicker" data-live-search="true" data-width="auto">
                                <?php for ($i = 2020; $i < 3000; $i++) { ?>
                                    <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
                                <?php } ?>
                            </select>

                        </div>

                        <div class="col-6 flexer">

                            <label>Month : &nbsp;&nbsp;</label>
                            <select id="Month" name="Month" class="selectpicker" data-width="auto">
                                <?php for ($i = 1; $i < 13; $i++) { ?>
                                    <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
                                <?php } ?>
                            </select>

                        </div>


                    </div>

                </div>

                <div class="modal-footer flexer">
                    <button type="submit" class="btn btn-salary">Calculate Salary</button>
                </div>

            </form>

        </div>
    </div>
</div>