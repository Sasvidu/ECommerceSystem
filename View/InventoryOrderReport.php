<?php

if ($_GET["status"] != "true") {

    header("location: ../View/InventoryManageOrders.php");
} else {

    session_start();
    if (!isset($_SESSION["userName"])) {
        $msg = "Please login first";
        $msg = base64_encode($msg);
        header("location: ../View/Login.php?msg=$msg");
    }

    //Load necessary features
    require_once '../Commons/fpdf185/fpdf.php';
    require_once '../Model/InventoryOrderReportModel.php';
    require_once '../Commons/ECommerceDB.php';

    $thisDBConnection = new DbConnection();
    $myCon = $thisDBConnection->con;

    //Define Id
    $orderId = $_POST['invoiceButton'];
    $orderId = explode("-", $orderId);
    $orderId = end($orderId);
    $orderRow = orderExists($myCon, $orderId);

    //Define Data
    $orderId;
    $orderDate;
    $orderProductId;
    $orderProductName;
    $orderProductCategory;
    $orderProductPrice;
    $orderQty;
    $orderPayment;
    $orderCompletedPayment;
    $orderPendingPayment;
    $orderSupplierId;
    $orderSupplier;

    //Search data
    if ($orderRow === false) {
        $msg = "Error reading receipt data";
        $msg = base64_encode($msg);
        header("location: ../View/InventoryManageOrders.php?msg=$msg");
    } else {
        $orderId = $orderRow['order_id'];
        $orderDate = $orderRow['order_date'];
        $orderProductId = $orderRow['order_product_id'];
        $orderQty = $orderRow['order_qty'];
        $orderPayment = $orderRow['order_payment'];
        $orderCompletedPayment = $orderRow['order_completed_payment'];
        $orderPendingPayment = $orderPayment - $orderCompletedPayment;
        $orderSupplierId = $orderRow['order_supplier_id'];

        $productRow = productExists($myCon, $orderProductId);
        $supplierRow = supplierExists($myCon, $orderSupplierId);


        if ($productRow === false) {
            $msg = "Error reading product data";
            $msg = base64_encode($msg);
            header("location: ../View/InventoryManageOrders.php?msg=$msg");
        } else {
            $orderProductName = $productRow['product_name'];
            $orderProductCategory = $productRow['product_category'];
            $orderProductPrice = $productRow['product_price'];
        }


        if ($supplierRow === false) {
            $msg = "Error reading supplier data";
            $msg = base64_encode($msg);
            header("location: ../View/InventoryManageOrders.php?msg=$msg");
        } else {
            $orderSupplier = $supplierRow['supplier_name'];
            //$orderSupplier = supplierRow['supplier_name'] . $supplierRow['supplier_location'];
        }
    }

    //Present Data
    $pdf = new FPDF();
    $pdf->AddPage("P", "A5");
    $width = $pdf->GetPageWidth();

    $pdf->SetTitle("Receipt #$orderId");

    $pdf->SetFont("Arial", "B", "20");
    $pdf->Image("../Commons/Icons/logotest.png", 10, 5, 30, 30);
    $pdf->Cell(0, 20, "Receipt #$orderId", 0, 1, "C");

    $pdf->SetFont("Arial", "B", 10);
    $pdf->Cell(0, 20, "", 0, 1, "C");

    $pdf->Cell(65, 8, "Order Id:", 0, 0, "L");
    $pdf->Cell(65, 8, "$orderId", 0, 1, "R");

    $pdf->Cell(65, 8, "Order Date:", 0, 0, "L");
    $pdf->Cell(65, 8, "$orderDate", 0, 1, "R");

    $pdf->Cell(65, 8, "Product Id:", 0, 0, "L");
    $pdf->Cell(65, 8, "$orderProductId", 0, 1, "R");

    $pdf->Cell(65, 8, "Product Name:", 0, 0, "L");
    $pdf->Cell(65, 8, "$orderProductName", 0, 1, "R");

    $pdf->Cell(65, 8, "Product Category:", 0, 0, "L");
    $pdf->Cell(65, 8, "$orderProductCategory", 0, 1, "R");

    $pdf->Cell(65, 8, "Product Current Price:", 0, 0, "L");
    $pdf->Cell(65, 8, "$orderProductPrice", 0, 1, "R");

    $pdf->Cell(65, 8, "Ordered Quantity:", 0, 0, "L");
    $pdf->Cell(65, 8, "$orderQty", 0, 1, "R");

    $pdf->Cell(65, 8, "Total Payment:", 0, 0, "L");
    $pdf->Cell(65, 8, "$orderPayment", 0, 1, "R");

    $pdf->Cell(65, 8, "Payment Made:", 0, 0, "L");
    $pdf->Cell(65, 8, "$orderCompletedPayment", 0, 1, "R");

    $pdf->Cell(65, 8, "Payment Pending:", 0, 0, "L");
    $pdf->Cell(65, 8, "$orderPendingPayment", 0, 1, "R");

    $pdf->Cell(65, 8, "Supllier Id:", 0, 0, "L");
    $pdf->Cell(65, 8, "$orderSupplierId", 0, 1, "R");

    $pdf->Cell(65, 8, "Supplier Name:", 0, 0, "L");
    $pdf->Cell(65, 8, "$orderSupplier", 0, 1, "R");


    $pdf->Cell(0, 20, "", 0, 1, "L");
    $pdf->Cell(0, 10, "This is a computer generated document.", 0, 1, "C");
    $pdf->Output();
}
