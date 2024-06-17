<div id="UpdateStockModal" class="modal fade" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- The form points to the controller for the specific modal  -->
            <form action="../Controller/InventoryEditStocksModalController.php?status=true" method="post">

                <div class="modal-header">
                    <h5 id="UpdateStockModalTitle" class="modal-title">Edit stock details</h5>
                    <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <!-- Field to store product ID (hidden) -->
                        <div class="col-12">
                            <input id="Id" name="Id" type="hidden" class="form-control" readonly>
                        </div>

                        <!-- Field for Product Name -->
                        <div class="col-12">

                            <label>Product Name:</label>
                            <input id="Name" name="Name" type="text" class="form-control" readonly>

                        </div>

                        <div class="col-12">
                            &nbsp;
                        </div>

                        <!-- Field for Maximum Quantity -->
                        <div class="col-12">

                            <label>Maximum quantity:</label>
                            <input id="MaxQty" name="MaxQty" type="number" min="0" class="form-control" placeholder="Enter the maximum quantity which can be held in stock">

                        </div>

                        <div class="col-12">
                            &nbsp;
                        </div>

                        <!-- Field for Buffer Quantity -->
                        <div class="col-12">

                            <label>Re-order quantity:</label>
                            <input id="BufferQty" name="BufferQty" type="number" min="0" class="form-control" placeholder="Enter the buffer inventory level">

                        </div>

                        <div class="col-12">
                            &nbsp;
                        </div>

                        <!-- Field for Current QUantity -->
                        <div class="col-12">

                            <label>Current quantity:</label>
                            <input id="CurrentQty" name="CurrentQty" type="number" min="0" class="form-control" placeholder="Enter the buffer inventory level">

                        </div>

                        <div class="col-12">
                            &nbsp;
                        </div>

                        <!-- Field for Date of Creation -->
                        <div class="col-12">

                            <label>Date of creation: (mm/dd/yyyy)</label>
                            <input id="CreateDate" name="CreateDate" type="text" class="form-control">

                        </div>

                        <div class="col-12">
                            &nbsp;
                        </div>

                        <!-- Field for Date of Last Modification -->
                        <div class="col-12">

                            <label>Date of last update: (mm/dd/yyyy)</label>
                            <input id="UpdateDate" name="UpdateDate" type="text" class="form-control">

                        </div>

                        <div class="col-12">
                            &nbsp;
                        </div>

                    </div>

                </div>

                <!-- Confirmation buttons -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Information</button>
                </div>

            </form>

        </div>
    </div>
</div>