function openEditModal(id){
    
    $( document ).ready(function() {

        //Extract the data of specific stock:
        var fields = id.split("t");
        var productId = fields[1];

        var productName = "ProductName";
        productName = productName.concat(productId);
        productName = document.getElementById(productName).innerText;

        var MaxQty = "MaxQty";
        MaxQty = MaxQty.concat(productId);
        MaxQty = document.getElementById(MaxQty).innerText;

        var BufferQty = "BufferQty";
        BufferQty = BufferQty.concat(productId);
        BufferQty = document.getElementById(BufferQty).innerText;

        var CurrentQty = "CurrentQty";
        CurrentQty = CurrentQty.concat(productId);
        CurrentQty = document.getElementById(CurrentQty).innerText;

        var CreateDate = "CreateDate";
        CreateDate = CreateDate.concat(productId);
        CreateDate = document.getElementById(CreateDate).innerText;
        CreateDate = formatDate(CreateDate);
    
        var UpdateDate = "UpdateDate";
        UpdateDate = UpdateDate.concat(productId);
        UpdateDate = document.getElementById(UpdateDate).innerText;
        UpdateDate = formatDate(UpdateDate);

        //Open the edit stock model and set its field values to one's read from the stock record:
        $("#UpdateStockModal").modal();
        $(".modal-body #Id").val( productId );
        $(".modal-body #Name").val( productName );
        $(".modal-body #MaxQty").val( MaxQty );
        $(".modal-body #BufferQty").val( BufferQty );
        $(".modal-body #CurrentQty").val( CurrentQty );
        $(".modal-body #CurrentQty").val( CurrentQty );
        $(".modal-body #CreateDate").val( CreateDate );
        $(".modal-body #UpdateDate").val( UpdateDate );
        
    });
  
}

function openDeleteModal(id){
    
    $( document ).ready(function() {

        //Extract the data of specific stock:
        var fields = id.split("l");
        var productId = fields[1];

        //Open the delete stock model and set its field values to one's read from the stock record:
        $("#DeleteStockModal").modal();
        $(".modal-body #Id").val( productId );
        
    });
  
}

//Convert the date format to the one used by the date time picker in the modal:
function formatDate(date) {
    var d = new Date(date),
    month = '' + (d.getMonth() + 1),
    day = '' + d.getDate(),
    year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [month, day, year].join('/');
}

//Submit the limit change upon change in value:
function changeLimits(){

    $( document ).ready(function() {

        var limit = document.getElementById("limitSelector");
        limit = limit.value;

        $(".limitSelectForm").submit();
        
    });

}


