function openEditModal(id){
    
    $( document ).ready(function() {

        var fields = id.split("t");
        var supplierId = fields[1];

        var supplierName = "name";
        supplierName = supplierName.concat(supplierId);
        supplierName = document.getElementById(supplierName).innerText;

        var supplierLocation = "location";
        supplierLocation = supplierLocation.concat(supplierId);
        supplierLocation = document.getElementById(supplierLocation).innerText;
        
        var supplierAddress = "address";
        supplierAddress = supplierAddress.concat(supplierId);
        supplierAddress = document.getElementById(supplierAddress).innerText;


        $("#UpdateSupplierModal").modal();
        $(".modal-body #Id").val( supplierId );
        $(".modal-body #Name").val( supplierName );
        $(".modal-body #Location").val( supplierLocation );
        $(".modal-body #Address").val( supplierAddress );
        
    });
  
}

function openDeleteModal(id){
    
    $( document ).ready(function() {

        var fields = id.split("l");
        var supplierId = fields[1];

        var supplierPendingPayment = "pendingPayment";
        supplierPendingPayment = supplierPendingPayment.concat(supplierId);
        supplierPendingPayment = document.getElementById(supplierPendingPayment).innerText;

        $("#DeleteSupplierModal").modal();
        $(".modal-body #Id").val( supplierId );
        $(".modal-body #PendingPayment").val( supplierPendingPayment );
        
    });
  
}

function openContactModal(id){

    $( document ).ready(function() {

        var fields = id.split("-");
        var supplierId = fields[1];

        var url = "../View/SuppliersManageSuppliersContact.php?supplierId=";
        url = url.concat(supplierId);

        window.open(url, '_blank').focus();
        
    });
    
}

function changeLimits(){

    $( document ).ready(function() {

        var limit = document.getElementById("limitSelector");
        limit = limit.value;

        $(".limitSelectForm").submit();
        
    });

}
