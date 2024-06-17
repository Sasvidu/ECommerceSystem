            <div id="NewAgentModal" class="modal fade" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <form action="../Controller/DeliveryAddAgentModalController.php?status=true" method="post">

                            <div class="modal-header">
                                <h5 id="NewAgentModalTitle" class="modal-title">Add a new delivery agent</h5>
                                <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <div class="row">

                                    <div class="col-12">

                                        <label>Agent Name:</label>
                                        <input id="AgentName" name="AgentName" type="text" class="form-control" placeholder="Enter the agent's name">

                                    </div>

                                    <div class="col-12">
                                        &nbsp;
                                    </div>

                                    <div class="col-12">

                                        <label>Agent Location:</label>
                                        <input id="AgentLocation" name="AgentLocation" type="text" class="form-control" placeholder="Enter the city in which the agent is located">

                                    </div>

                                    <div class="col-12">
                                        &nbsp;
                                    </div>

                                    <div class="col-12">

                                        <label>Agent Address:</label>
                                        <input id="AgentAddress" name="AgentAddress" type="text" class="form-control" placeholder="Enter the agent's full address">

                                    </div>

                                    <div class="col-12">
                                        &nbsp;
                                    </div>


                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add Agent</button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>