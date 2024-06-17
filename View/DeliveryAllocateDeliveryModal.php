    <?php

    require_once "../Commons/ECommerceDB.php";
    $thisDBConnection = new DbConnection();
    $myCon = $thisDBConnection->con;

    $sql = "SELECT * FROM delivery JOIN deliveryagent ON delivery.delivery_agent_id = deliveryagent.agent_id WHERE delivery_status=4 OR delivery_status=3 ORDER BY delivery_scheduled_date ASC, agent_name ASC, delivery_id ASC;";
    $result = $myCon->query($sql) or die($myCon->error);
    $resCheck = mysqli_num_rows($result);

    $deliveries = $result->fetch_all(MYSQLI_ASSOC);

    ?>

    <div id="AllocateDeliveryModal" class="modal fade" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <form action="../Controller/DeliveryAllocateDeliveryModalController.php?status=true" method="post">

                    <div class="modal-header">
                        <h5 id="AllocateDeliveryModalTitle" class="modal-title">Allocate to Delivery</h5>
                        <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="row">

                            <div class="col-12">

                                <label>Sale Id:</label>
                                <input id="SaleId" name="SaleId" type="text" class="form-control" readonly>

                            </div>

                            <div class="col-12">
                                &nbsp;
                            </div>

                            <div class="col-12">

                                <label>Delivery Id:</label>
                                <select id="DeliveryId" name="DeliveryId" class="form-select" aria-label="Default select example">
                                    <option selected value="Unspecified">Select a delivery</option>
                                    <?php foreach ($deliveries as $delivery) { ?>

                                        <option value="<?php echo $delivery['delivery_id'] ?>"><?php $deliveryDisplayData = $delivery['delivery_id'] .  ", " . $delivery['delivery_scheduled_date'] . "; " . $delivery['agent_name'] . ", " . $delivery['agent_location'];
                                                                                                echo $deliveryDisplayData; ?></option>

                                    <?php } ?>
                                </select>

                            </div>

                            <div class="col-12">
                                &nbsp;
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Allocate Order</button>
                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>