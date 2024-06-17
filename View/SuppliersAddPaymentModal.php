            <?php

            require_once "../Commons/ECommerceDB.php";
            $thisDBConnection = new DbConnection();
            $myCon = $thisDBConnection->con;

            $sqla = "SELECT * FROM supplier WHERE supplier_status=1 ORDER BY supplier_name;";
            $resulta = $myCon->query($sqla) or die($myCon->error);
            $resChecka = mysqli_num_rows($resulta);

            if ($resChecka > 0) {
                $suppliers = $resulta->fetch_all(MYSQLI_ASSOC);
            } else {
                $msg = "Error: Something went wrong, please try contact your troubleshooting manager";
                echo "<br><p align='center'>$msg</p>";
                exit();
            }

            ?>

            <div id="AddPaymentModal" class="modal fade" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <form action="../Controller/SuppliersAddPaymentModalController.php?status=true" method="post">

                            <div class="modal-header">
                                <h5 id="AddPaymentModalTitle" class="modal-title">Make a payment</h5>
                                <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <div class="row">

                                    <div class="col-12">

                                        <label>Supplier name:</label>
                                        <select id="Supplier" name="Supplier" class="form-select" aria-label="Default select example">
                                            <option selected value="Unspecified">Select a Supplier</option>
                                            <?php foreach ($suppliers as $supplier) { ?>

                                                <option value="<?php echo $supplier['supplier_id'] ?>"><?php echo $supplier['supplier_name'] . ", " . $supplier['supplier_location'] ?></option>

                                            <?php } ?>
                                        </select>

                                    </div>

                                    <div class="col-12">
                                        &nbsp;
                                    </div>

                                    <div class="col-12">

                                        <label>Payment Date:</label>
                                        <input id="PaymentDate" name="PaymentDate" type="date" class="form-control" placeholder="Enter the payment date">

                                    </div>

                                    <div class="col-12">
                                        &nbsp;
                                    </div>

                                    <div class="col-12">

                                        <label>Payment Amount:</label>
                                        <input id="PaymentAmount" name="PaymentAmount" type="number" min="0.00" step=".01" class="form-control" placeholder="000000.00">

                                    </div>

                                    <div class="col-12">
                                        &nbsp;
                                    </div>

                                    <div class="col-12">

                                        <label>Order Id: (Optional)</label>

                                        <?php

                                        $sql = "SELECT * FROM stockorder WHERE order_status=1 AND order_payment > order_completed_payment;";
                                        $result = $myCon->query($sql) or die($myCon->error);
                                        $resCheck = mysqli_num_rows($result);

                                        if ($resCheck > 0) {
                                            $orders = $result->fetch_all(MYSQLI_ASSOC);
                                        } else if ($resCheck == 0) {
                                            $suppliers = array("order_id" => "0");
                                        } else {
                                            $msg = "Error: Something went wrong, please try contact your troubleshooting manager";
                                            echo "<br><p align='center'>$msg</p>";
                                            exit();
                                        }

                                        ?>

                                        <select id="Order" name="Order" class="form-select" aria-label="Default select example">
                                            <option selected value="Unspecified">Select an order's Id</option>
                                            <?php foreach ($orders as $order) { ?>

                                                <option value="<?php if ($order['order_id'] == 0) {
                                                                    echo "Unspecified";
                                                                } else {
                                                                    echo $order['order_id'];
                                                                } ?>"><?php if ($order['order_id'] == 0) {
                                                                            echo "Unspecified";
                                                                        } else {
                                                                            echo $order['order_id'];
                                                                        } ?></option>

                                            <?php } ?>
                                        </select>

                                    </div>

                                    <div class="col-12">
                                        &nbsp;
                                    </div>

                                    <div class="col-12">

                                        <label>Payment Comment (Mandatory if no order selected):</label>
                                        <input id="PaymentComment" name="PaymentComment" type="text" class="form-control" placeholder="Ex: Settlement of overdue interest">

                                    </div>

                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Make Payment</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>