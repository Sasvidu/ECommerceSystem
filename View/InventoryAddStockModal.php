            <?php

            require_once "../Commons/ECommerceDB.php";
            $thisDBConnection = new DbConnection();
            $myCon = $thisDBConnection->con;

            $sql = "SELECT * FROM product WHERE product_status=1 AND product_stock_status=0 ORDER BY product_category, product_brand;";
            $result = $myCon->query($sql) or die($myCon->error);
            $resCheck = mysqli_num_rows($result);

            if ($resCheck > 0) {
                $products = $result->fetch_all(MYSQLI_ASSOC);
            } else if ($resCheck == 0) {
                $products = array("product_id" => "0", "product_name" => "No products availabe");
            } else {
                $msg = "Stocks have been created for all products.";
                echo "<br><p align='center'>$msg</p>";
                exit();
            }

            ?>

            <div id="AddStockModal" class="modal fade" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <form action="../Controller/InventoryAddStockModalController.php?status=true" method="post">

                            <div class="modal-header">
                                <h5 id="AddStockModalTitle" class="modal-title">Create a new stock</h5>
                                <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <div class="row">

                                    <div class="col-12">
                                        &nbsp;
                                    </div>

                                    <div class="col-12">

                                        <label>Product to create the stock for:</label>
                                        <select id="Product" name="Product" class="form-select" aria-label="Default select example">
                                            <option selected value="Unspecified">Select a Product</option>
                                            <?php foreach ($products as $product) { ?>

                                                <option value="<?php if ($product['product_id'] == 0) {
                                                                    echo "No products available";
                                                                } else {
                                                                    echo $product['product_id'];
                                                                } ?>"> <?php if ($product['product_id'] == 0) {
                                                                            echo "No products available";
                                                                        } else {
                                                                            echo $product['product_name'];
                                                                        } ?> </option>

                                            <?php } ?>
                                        </select>

                                    </div>

                                    <div class="col-12">
                                        &nbsp;
                                    </div>

                                    <div class="col-12">

                                        <label>Maximum quantity:</label>
                                        <input id="MaxQty" name="MaxQty" type="number" min="0" class="form-control" placeholder="Enter the maximum quantity which can be held in stock">

                                    </div>

                                    <div class="col-12">
                                        &nbsp;
                                    </div>

                                    <div class="col-12">

                                        <label>Re-order quantity:</label>
                                        <input id="BufferQty" name="BufferQty" type="number" min="0" class="form-control" placeholder="Enter the buffer inventory level">

                                    </div>

                                    <div class="col-12">
                                        &nbsp;
                                    </div>

                                    <div class="col-12">

                                        <label>Date of creation:</label>
                                        <input id="Date" name="Date" type="date" class="form-control" placeholder="Enter stock creation date">

                                    </div>

                                    <div class="col-12">
                                        &nbsp;
                                    </div>

                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Create Stock</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>