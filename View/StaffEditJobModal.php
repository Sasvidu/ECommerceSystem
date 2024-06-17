<div id="EditJobModal" class="modal fade" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form action="../Controller/StaffEditJobModalController.php?status=true" method="post">

                <div class="modal-header">
                    <h5 id="EditJobModalTitle" class="modal-title">Edit designation Details</h5>
                    <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-12">
                            <input id="JobId" name="JobId" type="hidden" class="form-control" readonly>
                        </div>

                        <div class="col-12">
                            <label>Designation Name:</label>
                            <input id="JobName" name="JobName" type="text" class="form-control">
                        </div>

                        <div class="col-12">
                            &nbsp;
                        </div>

                        <div class="col-12">
                            <label>Designation Description:</label>
                            <textarea id="JobDescription" name="JobDescription" class="form-control"></textarea>
                        </div>

                        <div class="col-12">
                            &nbsp;
                        </div>

                        <div class="col-12">
                            <label>Designation Department:</label>
                            <input id="JobDepartment" name="JobDepartment" type="text" class="form-control">
                        </div>

                        <div class="col-12">
                            &nbsp;
                        </div>

                        <div class="col-12">
                            <label>Designation Salary:</label>
                            <input id="JobSalary" name="JobSalary" type="number" min="0.00" step=".01" class="form-control">
                        </div>

                        <div class="col-12">
                            &nbsp;
                        </div>

                        <div class="col-12">
                            <label>OT Pay per hour:</label>
                            <input id="JobOT" name="JobOT" type="number" min="0.00" step=".01" class="form-control">
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