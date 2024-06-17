        <div id="UpdateSupplierModal" class="modal fade" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <form action="../Controller/SuppliersEditSuppliersModalController.php?status=true" method="post">
                    
                    <div class="modal-header">
                        <h5 id="UpdateSupplierModalTitle" class="modal-title">Edit Supplier Details</h5>
                        <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        
                        <div class="row">

                            <div class="col-12">
                                <input id="Id" name="Id" type="hidden" class="form-control" readonly>
                            </div>

                            <div class="col-12">

                                <label>Supplier Name:</label>
                                <input id="Name" name="Name" type="text" class="form-control">

                            </div>

                            <div class="col-12">
                                &nbsp;
                            </div>

                            <div class="col-12">

                                <label>Supplier City:</label>
                                <input id="Location" name="Location" type="text" class="form-control">

                            </div>

                            <div class="col-12">
                                &nbsp;
                            </div>

                            <div class="col-12">

                                <label>Supplier Address:</label>
                                <input id="Address" name="Address" type="text" class="form-control">

                            </div>

                            <div class="col-12">
                                &nbsp;
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