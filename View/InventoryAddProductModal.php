            <div id="NewProductModal" class="modal fade" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- The form points to the controller for the specific modal  -->
                        <form action="../Controller/InventoryAddProductModalController.php?status=true" method="post" enctype="multipart/form-data">

                            <div class="modal-header">
                                <h5 id="NewProductModalTitle" class="modal-title">Add a new product</h5>
                                <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <div class="row">

                                    <div class="col-12">
                                        &nbsp;
                                    </div>

                                    <!-- Field for Product Category -->
                                    <div class="col-12">

                                        <label>Product Category:</label>
                                        <select id="Category" name="Category" class="form-select" aria-label="Default select example">
                                            <option selected value="Unspecified">Select a Category</option>
                                            <option value="Phone">Phone</option>
                                            <option value="Tablet">Tablet</option>
                                            <option value="Laptop">Laptop</option>
                                            <option value="Processor">Processor</option>
                                            <option value="Motherboard">Motherboard</option>
                                            <option value="RAM">RAM</option>
                                            <option value="Graphics Card">Graphics Card</option>
                                            <option value="Power Supply">Power Supply</option>
                                            <option value="Cooling">Cooling</option>
                                            <option value="Storage">Storage</option>
                                            <option value="Monitor">Monitor</option>
                                            <option value="Case">Case</option>
                                            <option value="Cable">Cable</option>
                                            <option value="Other">Other</option>
                                        </select>

                                    </div>

                                    <div class="col-12">
                                        &nbsp;
                                    </div>

                                    <!-- Field for Product Brand -->
                                    <div class="col-12">

                                        <label>Product Brand:</label>
                                        <input id="Brand" name="Brand" type="text" class="form-control" placeholder="Enter the brand name of the product">

                                    </div>

                                    <div class="col-12">
                                        &nbsp;
                                    </div>

                                    <!-- Field for Product Name  -->
                                    <div class="col-12">

                                        <label>Product Name:</label>
                                        <input id="Name" name="Name" type="text" class="form-control" placeholder="Enter the full name of the product">

                                    </div>

                                    <div class="col-12">
                                        &nbsp;
                                    </div>

                                    <!-- Field for Product Price  -->
                                    <div class="col-12">

                                        <label>Product price:</label>
                                        <input id="Price" name="Price" type="number" min="0.00" step=".01" class="form-control" placeholder="00000.00">

                                    </div>

                                    <div class="col-12">
                                        &nbsp;
                                    </div>

                                    <!-- Field for Product Image  -->
                                    <div class="col-12">

                                        <label>Product Image:</label>
                                        <input id="Image" name="Image" type="file" class="form-control">

                                    </div>

                                    <div class="col-12">
                                        &nbsp;
                                    </div>

                                </div>

                            </div>

                            <!-- Confirmation buttons -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add Product</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>