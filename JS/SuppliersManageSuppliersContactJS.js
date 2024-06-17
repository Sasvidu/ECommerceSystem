function openDeleteModal(id, SupplierId){

    $( document ).ready(function() {

        var fields = id.split("l");
        var Id = fields[1];

        var contactValue = "value";
        contactValue = contactValue.concat(Id);
        contactValue = document.getElementById(contactValue).innerText;

        $("#DeleteSupplierContactModal").modal();
        $(".modal-body #Id").val( Id );
        $(".modal-body #Value").val( contactValue );
        $(".modal-body #SupplierId").val( SupplierId );
        
    });
    
}

function openEditModal(id, SupplierId){

    $( document ).ready(function() {

        var fields = id.split("t");
        var Id = fields[1];

        var contactType = "type";
        contactType = contactType.concat(Id);
        contactType = document.getElementById(contactType).innerText;

        var contactValue = "value";
        contactValue = contactValue.concat(Id);
        contactValue = document.getElementById(contactValue).innerText;

        $("#UpdateSupplierContactModal").modal();
        $(".modal-body #Id").val( Id );
        $(".modal-body #Type").val( contactType );
        $(".modal-body #Value").val( contactValue );
        $(".modal-body #SupplierId").val( SupplierId );
        
    });
    
}



function openAddModal(id){

    $( document ).ready(function() {

        var supplierId = id;

        $("#AddSupplierContactModal").modal();
        $(".modal-body #SupplierId").val( supplierId );
        
    });
    
}