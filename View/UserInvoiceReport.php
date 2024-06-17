<?php

//Verify that the controller had been accessed through the Customer's purchases history page:
if ($_GET["status"] != "true") {

    header("location: ../View/UserHistory.php");
} else {

    session_start();
    if (!isset($_SESSION["userName"])) {
        $msg = "Please login first";
        $msg = base64_encode($msg);
        header("location: ../View/Login.php?msg=$msg");
    }

    //Load necessary features:
    require_once '../Commons/fpdf185/fpdf.php';
    require_once '../Model/UserInvoiceReportModel.php';
    require_once '../Commons/ECommerceDB.php';

    $thisDBConnection = new DbConnection();
    $myCon = $thisDBConnection->con;

    //Define Id:
    $saleId = $_POST['invoiceButton'];
    $saleId = explode("-", $saleId);
    $saleId = end($saleId);
    $saleRow = saleExists($myCon, $saleId);

    //Define Data:
    $saleId;
    $saleUserId;
    $saleUserName;
    $saleProductName;
    $saleProductCategory;
    $saleProductBrand;
    $saleProductPrice;
    $saleQty;
    $saleOrderedDate;
    $saleTotalPayment;
    $saleDeliveryId;
    $saleDeliveryDate;
    $saleDeliveryAgentName;
    $saleDeliveryAgentLocation;
    $saleDeliveryStatus;

    //Search data:
    if ($saleRow === false) {
        $msg = "Error reading invoice data";
        $msg = base64_encode($msg);
        header("location: ../View/UserHistory.php?msg=$msg");
    } else {
        $saleId = $saleRow['sale_id'];
        $saleProductName = $saleRow['product_name'];
        $saleProductCategory = $saleRow['product_category'];
        $saleProductBrand = $saleRow['product_brand'];
        $saleProductPrice = $saleRow['product_price'];
        $saleQty = $saleRow['sale_qty'];
        $saleOrderedDate = $saleRow['sale_date'];
        $saleTotalPayment = $saleRow['sale_payment'];
        $saleDeliveryId = $saleRow['sale_delivery_id'];
    }
    $saleUserId = $_SESSION["userId"];
    $saleUserName = $_SESSION["userName"];

    //Present Data:
    $pdf = new FPDF();
    $pdf->AddPage("P", "A5");
    $width = $pdf->GetPageWidth();

    $pdf->SetTitle("Invoice #$saleId");

    $pdf->SetFont("Arial", "B", "20");
    $pdf->Image("../Commons/Icons/logotest.png", 10, 5, 30, 30);
    $pdf->Cell(0, 20, "Invoice #$saleId", 0, 1, "C");

    $pdf->SetFont("Arial", "B", 10);
    $pdf->Cell(0, 10, "", 0, 1, "C");

    $pdf->Cell(65, 8, "Sale Id:", 0, 0, "L");
    $pdf->Cell(65, 8, "$saleId", 0, 1, "R");

    $pdf->Cell(65, 8, "User Id:", 0, 0, "L");
    $pdf->Cell(65, 8, "$saleUserId", 0, 1, "R");

    $pdf->Cell(65, 8, "User Name:", 0, 0, "L");
    $pdf->Cell(65, 8, "$saleUserName", 0, 1, "R");

    $pdf->Cell(65, 8, "Product Name:", 0, 0, "L");
    $pdf->Cell(65, 8, "$saleProductName", 0, 1, "R");

    $pdf->Cell(65, 8, "Product Category:", 0, 0, "L");
    $pdf->Cell(65, 8, "$saleProductCategory", 0, 1, "R");

    $pdf->Cell(65, 8, "Product Brand:", 0, 0, "L");
    $pdf->Cell(65, 8, "$saleProductBrand", 0, 1, "R");

    $pdf->Cell(65, 8, "Sale Quantity:", 0, 0, "L");
    $pdf->Cell(65, 8, "$saleQty", 0, 1, "R");

    $pdf->Cell(65, 8, "Sale Ordered Date:", 0, 0, "L");
    $pdf->Cell(65, 8, "$saleOrderedDate", 0, 1, "R");

    $pdf->Cell(65, 8, "Total Payment:", 0, 0, "L");
    $pdf->Cell(65, 8, "$saleTotalPayment", 0, 1, "R");

    if($saleDeliveryId === NULL){

        $pdf->Cell(65, 8, "Delivery Id:", 0, 0, "L");
        $pdf->Cell(65, 8, "N/A", 0, 1, "R");

        $pdf->Cell(65, 8, "Delivery Status:", 0, 0, "L");
        $pdf->Cell(65, 8, "Processing", 0, 1, "R");

    }else{

        $deliveryRow = deliveryExists($myCon, $saleDeliveryId);

        $saleDeliveryDate = $deliveryRow['delivery_scheduled_date'];
        $saleDeliveryAgentName = $deliveryRow['agent_name'];
        $saleDeliveryAgentLocation = $deliveryRow['agent_location'];
        $saleDeliveryStatus = $deliveryRow['delivery_status'];

        if($saleDeliveryStatus == 3){
            $saleDeliveryStatus = "Allocated";
            $saleDeliveryAllocatedDate = $saleRow['sale_delivery_allocated_date'];
            $saleDeliveryDispatchedDate = "N/A";
            $saleDeliveryCompletedDate = "N/A";
        }else if($saleDeliveryStatus == 2){
            $saleDeliveryStatus = "Dispatched";
            $saleDeliveryAllocatedDate = $saleRow['sale_delivery_allocated_date'];
            $saleDeliveryDispatchedDate = $deliveryRow['delivery_dispatched_date'];
            $saleDeliveryCompletedDate = "N/A";
        }else if($saleDeliveryStatus == 1 || $saleDeliveryStatus == 0){
            $saleDeliveryStatus = "Completed";
            $saleDeliveryAllocatedDate = $saleRow['sale_delivery_allocated_date'];
            $saleDeliveryDispatchedDate = $deliveryRow['delivery_dispatched_date'];
            $saleDeliveryCompletedDate = $deliveryRow['delivery_completed_date'];
        }

        $pdf->Cell(65, 8, "Delivery Id:", 0, 0, "L");
        $pdf->Cell(65, 8, "$saleDeliveryId", 0, 1, "R");

        $pdf->Cell(65, 8, "Delivery Scheduled Date:", 0, 0, "L");
        $pdf->Cell(65, 8, "$saleDeliveryDate", 0, 1, "R");

        $pdf->Cell(65, 8, "Delivery Agent Name:", 0, 0, "L");
        $pdf->Cell(65, 8, "$saleDeliveryAgentName", 0, 1, "R");

        $pdf->Cell(65, 8, "Delivery Agent Location:", 0, 0, "L");
        $pdf->Cell(65, 8, "$saleDeliveryAgentLocation", 0, 1, "R");

        $pdf->Cell(65, 8, "Delivery Status:", 0, 0, "L");
        $pdf->Cell(65, 8, "$saleDeliveryStatus", 0, 1, "R");
        
        $pdf->Cell(65, 8, "Delivery Allocated Date:", 0, 0, "L");
        $pdf->Cell(65, 8, "$saleDeliveryAllocatedDate", 0, 1, "R");

        $pdf->Cell(65, 8, "Delivery Dispatched Date:", 0, 0, "L");
        $pdf->Cell(65, 8, "$saleDeliveryDispatchedDate", 0, 1, "R");

        $pdf->Cell(65, 8, "Delivery Completed Date:", 0, 0, "L");
        $pdf->Cell(65, 8, "$saleDeliveryCompletedDate", 0, 1, "R");

    }

    $pdf->Cell(0, 5, "", 0, 1, "L");
    $pdf->Cell(0, 8, "This is a computer generated document.", 0, 1, "C");
    $pdf->Output();
}
