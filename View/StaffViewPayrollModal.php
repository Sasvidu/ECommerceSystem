<!-- Not in use -->

<!--
<div id="ViewPayrollModal" class="modal fade" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form action="../View/StaffViewPayroll.php?status=true" method="post">

                <div class="modal-header">
                    <h5 id="ViewPayrollModalTitle" class="modal-title">View payroll</h5>
                    <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="row flexer" align="center">

                        <div class="col-12">
                            <h5> Select a year and a month to view the payroll </h5>
                        </div>

                        <div class="col-12">
                            &nbsp;
                        </div>

                        <div class="col-12">

                            <label>Year :</label>
                            <select id="Year" name="Year" class="selectpicker" data-live-search="true" data-width="auto">
                                <?php for ($i = 2020; $i < 3000; $i++) { ?>
                                    <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
                                <?php } ?>
                            </select>

                        </div>

                        <div class="col-12">
                            &nbsp;
                        </div>

                        <div class="col-12">

                            <label>Month :</label>
                            <select id="Month" name="Month" class="selectpicker" data-width="auto">
                                <?php for ($i = 1; $i < 13; $i++) { ?>
                                    <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
                                <?php } ?>
                            </select>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-half-success">View payroll</button>
                </div>

            </form>

        </div>
    </div>
</div>
                                -->