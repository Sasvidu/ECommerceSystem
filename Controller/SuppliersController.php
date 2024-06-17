<?php

if (!isset($_GET["status"])) {

?>
    <script>
        window.location = "../View/Suppliers.php"
    </script>
<?php
    exit();
} else {

    if (isset($_POST['suppliersManageSubmit'])) {
        header("location: ../View/SuppliersManageSuppliers.php");
    } else if (isset($_POST['pendingPaymentsSubmit'])) {
        header("location: ../View/SuppliersManagePending.php");
    } else if (isset($_POST['paymentsManageSubmit'])) {
        header("location: ../View/SuppliersManagePayments.php");
    }
}

?>