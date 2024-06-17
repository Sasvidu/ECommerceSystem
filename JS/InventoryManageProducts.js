function openEditModal(id){
    
    $( document ).ready(function() {

        var fields = id.split("t");
        var productId = fields[1];

        var productName = "name";
        productName = productName.concat(productId);
        productName = document.getElementById(productName).innerText;

        var productCategory = "category";
        productCategory = productCategory.concat(productId);
        productCategory = document.getElementById(productCategory).innerText;
        
        var productBrand = "brand";
        productBrand = productBrand.concat(productId);
        productBrand = document.getElementById(productBrand).innerText;

        var productPrice = "price";
        productPrice = productPrice.concat(productId);
        productPrice = document.getElementById(productPrice).innerText;

        $("#UpdateProductsModal").modal();
        $(".modal-body #Id").val( productId );
        $(".modal-body #Name").val( productName );
        $(".modal-body #Category").val( productCategory );
        $(".modal-body #Brand").val( productBrand );
        $(".modal-body #Price").val( productPrice );
        
    });
  
}

function openDeleteModal(id){
    
    $( document ).ready(function() {

        var fields = id.split("l");
        var productId = fields[1];

        $("#DeleteProductModal").modal();
        $(".modal-body #Id").val( productId );
        
    });
  
}

function changeLimits(){

    $( document ).ready(function() {

        var limit = document.getElementById("limitSelector");
        limit = limit.value;

        $(".limitSelectForm").submit();
        
    });

}
