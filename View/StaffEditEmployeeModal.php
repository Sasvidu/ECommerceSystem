<?php

require_once "../Commons/ECommerceDB.php";
$thisDBConnection = new DbConnection();
$myCon = $thisDBConnection->con;

$sql = "SELECT * FROM job WHERE job_status = 1 ORDER BY job_department, job_name;";
$result = $myCon->query($sql) or die($myCon->error);
$resCheck = mysqli_num_rows($result);

if ($resCheck > 0) {
    $jobs = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $jobs = array("job_id" => "0", "job_name" => "No jobs availabe");
}

?>

<div id="EditEmployeeModal" class="modal fade" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form action="../Controller/StaffEditEmployeeModalController.php?status=true" method="post">

                <div class="modal-header">
                    <h5 id="EditEmployeeModalTitle" class="modal-title">Edit Employee Details</h5>
                    <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-12">
                            <input id="EmpId" name="EmpId" type="hidden" class="form-control" readonly>
                        </div>

                        <div class="col-12">
                            <label>First Name:</label>
                            <input id="EmpFName" name="EmpFName" type="text" class="form-control" placeholder="Enter the employee's first name">
                        </div>

                        <div class="col-12">
                            &nbsp;
                        </div>

                        <div class="col-12">
                            <label>Last Name:</label>
                            <input id="EmpLName" name="EmpLName" type="text" class="form-control" placeholder="Enter the employee's last name">
                        </div>

                        <div class="col-12">
                            &nbsp;
                        </div>

                        <div class="col-12">
                            <label>Address:</label>
                            <input id="EmpAddress" name="EmpAddress" type="text" class="form-control" placeholder="Enter the employee's residential address">
                        </div>

                        <div class="col-12">
                            &nbsp;
                        </div>

                        <div class="col-12">
                            <label>Date of Birth:</label>
                            <input id="EmpDOB" name="EmpDOB" type="date" class="form-control" placeholder="Enter the employee's date of birth">
                        </div>

                        <div class="col-12">
                            &nbsp;
                        </div>

                        <div class="col-12">
                            <label>NIC:</label>
                            <input id="EmpNIC" name="EmpNIC" type="text" class="form-control" placeholder="Enter the employee's National Identy Card Number">
                        </div>

                        <div class="col-12">
                            &nbsp;
                        </div>

                        <div class="col-12">
                            <label>Email 1:</label>
                            <input id="EmpEmail1" name="EmpEmail1" type="email" class="form-control" placeholder="Enter the employee's email address">
                        </div>

                        <div class="col-12">
                            &nbsp;
                        </div>

                        <div class="col-12">
                            <label>Email 2: (Optional)</label>
                            <input id="EmpEmail2" name="EmpEmail2" type="email" class="form-control" placeholder="Enter the employee's alternate email address">
                        </div>

                        <div class="col-12">
                            &nbsp;
                        </div>

                        <div class="col-12">
                            <label>Telephone 1:</label>
                            <input id="EmpTel1" name="EmpTel1" type="text" class="form-control" placeholder="Enter the employee's telephone number">
                        </div>

                        <div class="col-12">
                            &nbsp;
                        </div>

                        <div class="col-12">
                            <label>Telephone 2: (Optional)</label>
                            <input id="EmpTel2" name="EmpTel2" type="text" class="form-control" placeholder="Enter the employee's alternate telephone number">
                        </div>

                        <div class="col-12">
                            &nbsp;
                        </div>

                        <div class="col-12">
                            <label>Job Title:</label>
                            <select id="EmpJobId" name="EmpJobId" class="selectpicker myselectpicker customselectpicker" data-live-search="true" data-width="auto">
                                <option selected value="Unspecified">Select the employee's designation</option>
                                <?php foreach ($jobs as $job) { ?>
                                    <option value=<?php echo $job['job_id'] ?>> <?php echo $job['job_name'] ?> </option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Information</button>
                </div>

            </form>

        </div>
    </div>
</div>