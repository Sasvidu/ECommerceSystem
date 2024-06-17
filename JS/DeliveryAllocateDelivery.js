function openAllocateModal(id){
    
    $( document ).ready(function() {

        var fields = id.split("e");
        var saleId = fields[1];
        $("#AllocateDeliveryModal").modal();
        $(".modal-body #SaleId").val( saleId );
        
    });
  
}

function changeLimits(){

    $( document ).ready(function() {

        var limit = document.getElementById("limitSelector");
        limit = limit.value;

        $(".limitSelectForm").submit();
        
    });

}
