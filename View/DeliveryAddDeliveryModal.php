    <?php

    require_once "../Commons/ECommerceDB.php";
    $thisDBConnection = new DbConnection();
    $myCon = $thisDBConnection->con;

    $sql = "SELECT * FROM deliveryagent WHERE agent_status=1 ORDER BY agent_name, agent_location;";
    $result = $myCon->query($sql) or die($myCon->error);
    $resCheck = mysqli_num_rows($result);

    $agents = $result->fetch_all(MYSQLI_ASSOC);

    ?>

    <div id="NewDeliveryModal" class="modal fade" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <form action="../Controller/DeliveryAddDeliveryModalController.php?status=true" method="post">

                    <div class="modal-header">
                        <h5 id="NewDeliveryModalTitle" class="modal-title">Schedule a delivery</h5>
                        <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="row">

                            <div class="col-12">

                                <label>Delivery Agent:</label>
                                <select id="Agent" name="Agent" class="form-select" aria-label="Default select example">
                                    <option selected value="Unspecified">Select an Agent</option>
                                    <?php foreach ($agents as $agent) { ?>

                                        <option value="<?php echo $agent['agent_id'] ?>"><?php $agentDisplayData = $agent['agent_name'] .  ", " . $agent['agent_location'];
                                                                                            echo $agentDisplayData; ?></option>

                                    <?php } ?>
                                </select>

                            </div>

                            <div class="col-12">
                                &nbsp;
                            </div>

                            <div class="col-12">

                                <label>Delivery Date:</label>
                                <input id="DeliveryDate" name="DeliveryDate" type="date" class="form-control" placeholder="Enter the date on which delivery is to be completed">

                            </div>

                            <div class="col-12">
                                &nbsp;
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Schedule Delivery</button>
                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>