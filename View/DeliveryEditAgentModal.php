    <div id="EditAgentModal" class="modal fade" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <form action="../Controller/DeliveryEditAgentModalController.php?status=true" method="post">

                    <div class="modal-header">
                        <h5 id="EditAgentModalTitle" class="modal-title">Edit agent Details</h5>
                        <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="row">

                            <div class="col-12">
                                <input id="AgentId" name="AgentId" type="hidden" class="form-control" readonly>
                            </div>

                            <div class="col-12">
                                <label>Agent Name:</label>
                                <input id="AgentName" name="AgentName" type="text" class="form-control">
                            </div>

                            <div class="col-12">
                                &nbsp;
                            </div>

                            <div class="col-12">
                                <label>Agent Location:</label>
                                <input id="AgentLocation" name="AgentLocation" type="text" class="form-control"></input>
                            </div>

                            <div class="col-12">
                                &nbsp;
                            </div>

                            <div class="col-12">
                                <label>Agent Address:</label>
                                <input id="AgentAddress" name="AgentAddress" type="text" class="form-control">
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