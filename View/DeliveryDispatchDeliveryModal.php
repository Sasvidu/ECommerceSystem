    <div id="DispatchDeliveryModal" class="modal fade" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <form action="../Controller/DeliveryDispatchDeliveryModalController.php?status=true" method="post">

                    <div class="modal-header">
                        <h5 id="DispatchDeliveryModalTitle" class="modal-title">Dispatch delivery?</h5>
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
                                <p id="dispatchModalText" align="center" style="font-size:larger">Are you sure you want to dispatch this delivery?<br>It wont be possible to allocate anymore orders to it once dispatched.</p>
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