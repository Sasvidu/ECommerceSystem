    <div id="CompleteDeliveryModal" class="modal fade" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <form action="../Controller/DeliveryCompleteDeliveryModalController.php?status=true" method="post">

                        <div class="modal-header">
                            <h5 id="CompleteDeliveryModalTitle" class="modal-title">Complete delivery?</h5>
                            <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">

                            <div class="row">

                                <div class="col-12">
                                    &nbsp;
                                </div>

                                <div class="col-12">
                                    <label>Delivery Id:</label>
                                    <input id="Id" name="Id" type="text" class="form-control" readonly>
                                </div>

                                <div class="col-12">
                                    &nbsp;
                                </div>

                                <div class="col-12">
                                    <p id="completeModalText" align="center" style="font-size:larger">Are you sure you want to complete this delivery?<br>Has the delivery reached the customer?</p>
                                </div>

                                <div class="col-12">
                                    &nbsp;
                                </div>

                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-primary">Yes</button>
                        </div>
                        
                </form>

            </div>
        </div>
    </div>