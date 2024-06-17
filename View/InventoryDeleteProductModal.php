<div id="DeleteProductModal" class="modal fade" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form action="../Controller/InventoryDeleteProductModalController.php?status=true" method="post">

                <div class="modal-header">
                    <h5 id="DeleteProductModalTitle" class="modal-title">Delete product</h5>
                    <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-12">
                            &nbsp;
                        </div>

                        <div class="col-12">
                            <input id="Id" name="Id" type="hidden" class="form-control" readonly>
                        </div>

                        <div class="col-12">
                            <p align="center" style="font-size:larger">Are you sure you want to delete this product?</p>
                        </div>

                        <div class="col-12">
                            &nbsp;
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger">Yes</button>
                    </div>

            </form>

        </div>
    </div>
</div>