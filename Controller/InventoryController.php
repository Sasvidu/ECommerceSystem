<?php

    //Verify that the controller had been accessed through the view:
    if(!isset($_GET["status"])){

        ?>
            <script>window.location="../View/Inventory.php"</script>
        <?php
        exit();

    }else{

        //Redirect to Invenotry module pages:
        if(isset($_POST['productManageSubmit'])){
            header("location: ../View/InventoryManageProducts.php");
        }else if(isset($_POST['stockManageSubmit'])){
            header("location: ../View/InventoryManageStocks.php");
        }else if(isset($_POST['orderViewSubmit'])){
            header("location: ../View/InventoryManageOrders.php");
        }

    }
    
?>