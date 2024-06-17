function openDeleteModal(id){
    
    $( document ).ready(function() {

        var fields = id.split("l");
        var deliveryId = fields[1];
        $("#DeleteDeliveryModal").modal();
        $(".modal-body #Id").val( deliveryId );
        
    });
  
}

function openDispatchModal(id){
    
    $( document ).ready(function() {

        var fields = id.split("h");
        var deliveryId = fields[1];
        $("#DispatchDeliveryModal").modal();
        $(".modal-body #Id").val( deliveryId );
        
    });
  
}

function openCompleteModal(id){
    
    $( document ).ready(function() {

        var fields = id.split("e");
        var deliveryId = fields[2];
        $("#CompleteDeliveryModal").modal();
        $(".modal-body #Id").val( deliveryId );
        
    });
  
}

function openAllocatePage(){

    window.location.href = "../View/DeliveryAllocateDeliveries.php";

}

function changeLimits(){

    $( document ).ready(function() {

        var limit = document.getElementById("limitSelector");
        limit = limit.value;

        $(".limitSelectForm").submit();
        
    });

}
