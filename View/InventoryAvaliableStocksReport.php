<?php

if ($_GET["status"] != "true") {

    header("location: ../View/AdminHome.php");
} else {

    session_start();
    if (!isset($_SESSION["userName"])) {
        $msg = "Please login first";
        $msg = base64_encode($msg);
        header("location: ../View/Login.php?msg=$msg");
    }

    //Load necessary features
    require_once '../Commons/fpdf185/fpdf.php';
    require_once '../Model/InventoryAvailableStocksReportModel.php';
    require_once '../Commons/ECommerceDB.php';

    $thisDBConnection = new DbConnection();
    $myCon = $thisDBConnection->con;

    //DefineData
    $stockId;
    $productId;
    $productName;
    $stockMaxQty;
    $stockBufferQty;
    $stockCurrentQty;
    $stockLastUpdateDate;

    //Load Data
    $safeStockTable = getSafeStock($myCon);
    $safeStockTableRows = mysqli_num_rows($safeStockTable);

    $bufferStockTable = getBufferStock($myCon);
    $bufferStockTableRows = mysqli_num_rows($bufferStockTable);

    $emptyStockTable = getEmptyStock($myCon);
    $emptyStockTableRows = mysqli_num_rows($emptyStockTable);

    $dateToday = date("Y-m-d");
    //$timeToday = date("H:i:s");

    //Present Data
    $pdf = new FPDF();
    $pdf->AddPage("P", "A4");
    $width = $pdf->GetPageWidth();

    $pdf->SetTitle("Available Stocks on $dateToday");

    $pdf->SetFont("Arial", "B", "20");
    $pdf->Image("../Commons/Icons/logotest.png", 10, 5, 30, 30);
    $pdf->Cell(0, 20, "Available Stocks on $dateToday", 0, 1, "C");

    $pdf->Cell(0, 10, "", 0, 1, "C");


    //Safe Stocks: (Not yet reached buffer level)
    $pdf->SetFont("Arial", "B", 13);
    $pdf->Cell(0, 20, "Stocks which above the buffer level:", 0, 1, "L");
    $pdf->SetFont("Arial", "B", 10);

    if ($safeStockTableRows > 0) {

        $pdf->Cell(20, 8, "Stock Id", 1, 0, "C");
        $pdf->Cell(20, 8, "Product Id", 1, 0, "C");
        $pdf->Cell(63, 8, "Product Name", 1, 0, "C");
        $pdf->Cell(20, 8, "Max Qty", 1, 0, "C");
        $pdf->Cell(23, 8, "Buffer Qty", 1, 0, "C");
        $pdf->Cell(23, 8, "Current Qty", 1, 0, "C");
        $pdf->Cell(23, 8, "Last Update ", 1, 1, "C");

        while ($stock = mysqli_fetch_assoc($safeStockTable)) {

            $stockId = $stock['stock_id'];
            $productId = $stock['product_id'];
            $productName  = $stock['product_name'];
            $stockMaxQty  = $stock['stock_qty_max'];
            $stockBufferQty  = $stock['stock_qty_buffer'];
            $stockCurrentQty  = $stock['stock_qty_current'];
            $stockLastUpdateDate  = $stock['stock_updated_date'];

            $pdf->Cell(20, 8, $stockId, 1, 0, "C");
            $pdf->Cell(20, 8, $productId, 1, 0, "C");
            $pdf->Cell(63, 8, $productName, 1, 0, "C");
            $pdf->Cell(20, 8, $stockMaxQty, 1, 0, "C");
            $pdf->Cell(23, 8, $stockBufferQty, 1, 0, "C");
            $pdf->Cell(23, 8, $stockCurrentQty, 1, 0, "C");
            $pdf->Cell(23, 8, $stockLastUpdateDate, 1, 1, "C");
        }
    } else {
        $pdf->Cell(0, 20, "All stocks are below buffer level currently", 0, 1, "C");
    }

    $pdf->Cell(0, 10, "", 0, 1, "C");


    //Buffer Stocks: (Has reached buffer level)
    $pdf->SetFont("Arial", "B", 13);
    $pdf->Cell(0, 20, "Stocks below the buffer level but are not fully depleted:", 0, 1, "L");
    $pdf->SetFont("Arial", "B", 10);

    if ($bufferStockTableRows > 0) {

        $pdf->Cell(20, 8, "Stock Id", 1, 0, "C");
        $pdf->Cell(20, 8, "Product Id", 1, 0, "C");
        $pdf->Cell(63, 8, "Product Name", 1, 0, "C");
        $pdf->Cell(20, 8, "Max Qty", 1, 0, "C");
        $pdf->Cell(23, 8, "Buffer Qty", 1, 0, "C");
        $pdf->Cell(23, 8, "Current Qty", 1, 0, "C");
        $pdf->Cell(23, 8, "Last Update ", 1, 1, "C");

        while ($stock = mysqli_fetch_assoc($bufferStockTable)) {

            $stockId = $stock['stock_id'];
            $productId = $stock['product_id'];
            $productName  = $stock['product_name'];
            $stockMaxQty  = $stock['stock_qty_max'];
            $stockBufferQty  = $stock['stock_qty_buffer'];
            $stockCurrentQty  = $stock['stock_qty_current'];
            $stockLastUpdateDate  = $stock['stock_updated_date'];

            $pdf->Cell(20, 8, $stockId, 1, 0, "C");
            $pdf->Cell(20, 8, $productId, 1, 0, "C");
            $pdf->Cell(63, 8, $productName, 1, 0, "C");
            $pdf->Cell(20, 8, $stockMaxQty, 1, 0, "C");
            $pdf->Cell(23, 8, $stockBufferQty, 1, 0, "C");
            $pdf->Cell(23, 8, $stockCurrentQty, 1, 0, "C");
            $pdf->Cell(23, 8, $stockLastUpdateDate, 1, 1, "C");
        }
    } else {
        $pdf->Cell(0, 20, "No undepleted stocks below buffer level detected", 0, 1, "C");
    }

    $pdf->Cell(0, 10, "", 0, 1, "C");


    //Empty Stocks: (No current products)
    $pdf->SetFont("Arial", "B", 13);
    $pdf->Cell(0, 20, "Out of Stock:", 0, 1, "L");
    $pdf->SetFont("Arial", "B", 10);

    if ($emptyStockTableRows > 0) {

        $pdf->Cell(20, 8, "Stock Id", 1, 0, "C");
        $pdf->Cell(20, 8, "Product Id", 1, 0, "C");
        $pdf->Cell(63, 8, "Product Name", 1, 0, "C");
        $pdf->Cell(20, 8, "Max Qty", 1, 0, "C");
        $pdf->Cell(23, 8, "Buffer Qty", 1, 0, "C");
        $pdf->Cell(23, 8, "Current Qty", 1, 0, "C");
        $pdf->Cell(23, 8, "Last Update ", 1, 1, "C");

        while ($stock = mysqli_fetch_assoc($emptyStockTable)) {

            $stockId = $stock['stock_id'];
            $productId = $stock['product_id'];
            $productName  = $stock['product_name'];
            $stockMaxQty  = $stock['stock_qty_max'];
            $stockBufferQty  = $stock['stock_qty_buffer'];
            $stockCurrentQty  = $stock['stock_qty_current'];
            $stockLastUpdateDate  = $stock['stock_updated_date'];

            $pdf->Cell(20, 8, $stockId, 1, 0, "C");
            $pdf->Cell(20, 8, $productId, 1, 0, "C");
            $pdf->Cell(63, 8, $productName, 1, 0, "C");
            $pdf->Cell(20, 8, $stockMaxQty, 1, 0, "C");
            $pdf->Cell(23, 8, $stockBufferQty, 1, 0, "C");
            $pdf->Cell(23, 8, $stockCurrentQty, 1, 0, "C");
            $pdf->Cell(23, 8, $stockLastUpdateDate, 1, 1, "C");
        }
    } else {
        $pdf->Cell(0, 20, "No empty stocks detected", 0, 1, "C");
    }

    $pdf->Cell(0, 10, "", 0, 1, "C");


    $pdf->Output();
}
