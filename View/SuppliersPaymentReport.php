<?php

if ($_GET["status"] != "true") {

    header("location: ../View/SuppliersManagePayments.php");
} else {

    session_start();
    if (!isset($_SESSION["userName"])) {
        $msg = "Please login first";
        $msg = base64_encode($msg);
        header("location: ../View/Login.php?msg=$msg");
    }

    //Load necessary features
    require_once '../Commons/fpdf185/fpdf.php';
    require_once '../Model/SuppliersPaymentReportModel.php';
    require_once '../Commons/ECommerceDB.php';

    $thisDBConnection = new DbConnection();
    $myCon = $thisDBConnection->con;

    //Define Id
    $paymentId = $_POST['voucherButton'];
    $paymentId = explode("-", $paymentId);
    $paymentId = end($paymentId);
    $paymentRow = paymentExists($myCon, $paymentId);

    //Define Data
    $paymentId;
    $paymentDate;
    $paymentAmount;
    $paymentSupplierId;
    $paymentSupplierName;
    $paymentOrderId;
    $paymentOrderProductId;
    $paymentOrderProductName;
    $paymentOrderProductCategory;
    $paymentComment;

    //Search data
    if ($paymentRow === false) {

        $msg = "Error reading payment data";
        $msg = base64_encode($msg);
        header("location: ../View/SuppliersManagePayments.php?msg=$msg");
    } else {

        $paymentId = $paymentRow['payment_id'];
        $paymentDate = $paymentRow['payment_date'];
        $paymentAmount = $paymentRow['payment_amount'];
        $paymentSupplierId = $paymentRow['payment_supplier_id'];
        $paymentOrderId = $paymentRow['payment_order_id'];
        $paymentComment = $paymentRow['payment_comment'];

        if ($paymentOrderId === NULL) {

            $supplierRow = supplierExists($myCon, $paymentSupplierId);

            if ($supplierRow === false) {
                $msg = "Error reading supplier data";
                $msg = base64_encode($msg);
                header("location: ../View/SuppliersManagePayments.php?msg=$msg");
            } else {
                $paymentSupplierName = $supplierRow['supplier_name'];
            }
        } else if ($paymentOrderId !== NULL) {

            $supplierRow = supplierExists($myCon, $paymentSupplierId);
            $orderRow = orderExists($myCon, $paymentOrderId);

            if ($supplierRow === false) {
                $msg = "Error reading supplier data";
                $msg = base64_encode($msg);
                header("location: ../View/SuppliersManagePayments.php?msg=$msg");
            } else {
                $paymentSupplierName = $supplierRow['supplier_name'];
            }

            if ($orderRow === false) {
                $msg = "Error reading order data";
                $msg = base64_encode($msg);
                header("location: ../View/SuppliersManagePayments.php?msg=$msg");
            } else {
                $paymentOrderProductId = $orderRow['product_id'];
                $paymentOrderProductName = $orderRow['product_name'];
                $paymentOrderProductCategory = $orderRow['product_category'];
            }
        }

        if ($paymentComment === ""){
            $paymentComment = "N/A";
        }
    }

    //Present Data
    $pdf = new FPDF();
    $pdf->AddPage("P", "A5");
    $width = $pdf->GetPageWidth();

    $pdf->SetTitle("Voucher #$paymentId");

    $pdf->SetFont("Arial", "B", "20");
    $pdf->Image("../Commons/Icons/logotest.png", 10, 5, 30, 30);
    $pdf->Cell(0, 20, "Voucher #$paymentId", 0, 1, "C");

    $pdf->SetFont("Arial", "B", 10);
    $pdf->Cell(0, 20, "", 0, 1, "C");

    $pdf->Cell(65, 8, "Payment Id:", 0, 0, "L");
    $pdf->Cell(65, 8, "$paymentId", 0, 1, "R");

    $pdf->Cell(65, 8, "Payment Date:", 0, 0, "L");
    $pdf->Cell(65, 8, "$paymentDate", 0, 1, "R");

    $pdf->Cell(65, 8, "Payment Amount:", 0, 0, "L");
    $pdf->Cell(65, 8, "$paymentAmount", 0, 1, "R");

    $pdf->Cell(65, 8, "Supplier Id:", 0, 0, "L");
    $pdf->Cell(65, 8, "$paymentSupplierId", 0, 1, "R");

    $pdf->Cell(65, 8, "Supplier Name:", 0, 0, "L");
    $pdf->Cell(65, 8, "$paymentSupplierName", 0, 1, "R");

    if ($paymentOrderId !== NULL) {

        $pdf->Cell(65, 8, "Order Id:", 0, 0, "L");
        $pdf->Cell(65, 8, "$paymentOrderId", 0, 1, "R");

        $pdf->Cell(65, 8, "Ordered Product Id:", 0, 0, "L");
        $pdf->Cell(65, 8, "$paymentOrderProductId", 0, 1, "R");

        $pdf->Cell(65, 8, "Ordered Product Name:", 0, 0, "L");
        $pdf->Cell(65, 8, "$paymentOrderProductName", 0, 1, "R");

        $pdf->Cell(65, 8, "Ordered Product Category:", 0, 0, "L");
        $pdf->Cell(65, 8, "$paymentOrderProductCategory", 0, 1, "R");
    } else if ($paymentOrderId === NULL) {

        $pdf->Cell(65, 8, "Order Id:", 0, 0, "L");
        $pdf->Cell(65, 8, "The payment has not been made with respect to a specific order", 0, 1, "R");
    }

    $pdf->Cell(65, 8, "Payment Comment:", 0, 0, "L");
    $pdf->Cell(65, 8, "$paymentComment", 0, 1, "R");


    $pdf->Cell(0, 20, "", 0, 1, "L");
    $pdf->Cell(0, 10, "This is a computer generated document.", 0, 1, "C");
    $pdf->Output();
}
