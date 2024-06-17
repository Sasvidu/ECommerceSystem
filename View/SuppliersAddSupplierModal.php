            <div id="AddSupplierModal" class="modal fade" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <form action="../Controller/SuppliersAddSupplierModalController.php?status=true" method="post">

                            <div class="modal-header">
                                <h5 id="AddSupplierModalTitle" class="modal-title">Add a new supplier</h5>
                                <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <div class="row">

                                    <div class="col-12">

                                        <label>Supplier Name:</label>
                                        <input id="Name" name="Name" type="text" class="form-control" placeholder="Enter the supplier's name">

                                    </div>

                                    <div class="col-12">
                                        &nbsp;
                                    </div>

                                    <div class="col-12">

                                        <label>Supplier City:</label>
                                        <input id="Location" name="Location" type="text" class="form-control" placeholder="Enter the city / town the supplier is located in">

                                    </div>

                                    <div class="col-12">
                                        &nbsp;
                                    </div>

                                    <div class="col-12">

                                        <label>Supplier Address:</label>
                                        <input id="Address" name="Address" type="text" class="form-control" placeholder="Enter the full address of the supplier">

                                    </div>

                                    <div class="col-12">
                                        &nbsp;
                                    </div>

                                    <div id="EmailsContainer" class="col-12">

                                        <label>Supplier Email:</label>
                                        <input name="Emails[]" type="email" class="form-control" placeholder="Enter the email address of the supplier">

                                    </div>

                                    <div class="col-12">
                                        &nbsp;
                                    </div>

                                    <div class="col-12" style="display:flex; justify-content:center">
                                        <button id="addEmails" type="button" class="btn btn-half-success btn-sm" onclick="AddEmailField()"><i class="fa-solid fa-plus"></i></button>
                                        &nbsp;
                                        <button id="removeEmails" type="button" class="btn btn-danger btn-sm" style="padding-left:2.2%; padding-right:2.2%;" onclick="RemoveEmailField()"><i class="fa-solid fa-xmark"></i></button>
                                    </div>

                                    <div class="col-12">
                                        &nbsp;
                                    </div>

                                    <div id="TelNosContainer" class="col-12">

                                        <label>Supplier Telephone:</label>
                                        <input name="TelNos[]" type="number" class="form-control" placeholder="Enter the telephone number of the supplier">

                                    </div>

                                    <div class="col-12">
                                        &nbsp;
                                    </div>

                                    <div class="col-12" style="display:flex; justify-content:center">
                                        <button id="addTelNos" type="button" class="btn btn-half-success btn-sm" onclick="AddTelnoField()"><i class="fa-solid fa-plus"></i></button>
                                        &nbsp;
                                        <button id="removeTelNos" type="button" class="btn btn-danger btn-sm" style="padding-left:2.2%; padding-right:2.2%;" onclick="RemoveTelNoField()"><i class="fa-solid fa-xmark"></i></button>
                                    </div>

                                    <div class="col-12">
                                        &nbsp;
                                    </div>

                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add Supplier</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

            <script src="../JS/SuppliersAddSupplierModalJS.js"></script>