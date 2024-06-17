            <div id="UpdateSupplierContactModal" class="modal fade" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <form action="../Controller/SuppliersEditSupplierContactModalController.php?status=true" method="post">

                            <div class="modal-header">
                                <h5 id="UpdateSupplierContactModalTitle" class="modal-title">Edit supplier contact</h5>
                                <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <div class="row">

                                    <div class="col-12">

                                        <input id="Id" name="Id" type="hidden" class="form-control">

                                    </div>

                                    <div class="col-12">

                                        <input id="SupplierId" name="SupplierId" type="hidden" class="form-control">

                                    </div>

                                    <div class="col-12">

                                        <label>Contact Type:</label>
                                        <select id="Type" name="Type" class="form-select">
                                            <option value="Email">Email</option>
                                            <option value="Telephone">Telephone</option>
                                        </select>

                                    </div>

                                    <div class="col-12">
                                        &nbsp;
                                    </div>

                                    <div class="col-12">

                                        <label>Contact Value:</label>
                                        <input id="Value" name="Value" type="text" class="form-control" placeholder="Enter the contact">

                                    </div>

                                    <div class="col-12">
                                        &nbsp;
                                    </div>

                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update Contact</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>