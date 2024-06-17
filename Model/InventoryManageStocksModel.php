<?php

    require_once "../Commons/ECommerceDB.php";
    $thisDBConnection = new DbConnection();
    $myCon = $thisDBConnection->con;

    //Search Stocks Code:

    //Check whether the user has set a page manually, if not set page to 1:    
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    //Initialize the limit of records per page:
    if(isset($_POST['limitSelector'])){
        $_SESSION['limitStocks'] = $_POST['limitSelector'];
        $limit = $_POST['limitSelector'];
        $page = 1;
    }else{
        if(isset($_SESSION['limitStocks'])){
            $limit = $_SESSION['limitStocks'];
        }else{
            $_SESSION['limitStocks'] = 10;
            $limit = 10;
        }
    }

    //Get the index of the starting tuple for the table:
    $start = ($page - 1) * $limit;

    //If the user has searched for something specific:
    if (isset($_GET["search"])) {

        $filters = $_GET["search"];
        $page = 0;

        $sql = "SELECT * FROM stock JOIN product ON stock_product_id = product_id WHERE CONCAT(product_name, stock_qty_max, stock_qty_buffer, stock_qty_current, stock_updated_date, stock_created_date) LIKE '%$filters%' AND stock_status=1 ORDER BY stock_updated_date DESC;";
        $result = $myCon->query($sql) or die($myCon->error);
        $resCheck = mysqli_num_rows($result);

        if ($resCheck > 0) {
            $stocks = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            //If there are no matching results for the search:
            $msg = "No records have been read from the database";
            $msg = base64_encode($msg);
            header("location: ../View/InventoryManageStocks.php?msg=$msg");
            exit();
        }

    //If the user has not searched for anything:
    } else {

        $sql = "SELECT * FROM stock WHERE stock_status=1 ORDER BY stock_updated_date DESC LIMIT $start, $limit;";
        $result = $myCon->query($sql) or die($myCon->error);
        $resCheck = mysqli_num_rows($result);

        if ($resCheck > 0) {
            $stocks = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            //Stock table in database is empty:
            $msg = "No records have been read from the database";
            $msg = base64_encode($msg);
            header("location: ../View/Inventory.php?msg=$msg");
            exit();
        }
    }

    //Get the total number of records in the database:
    $sqlNew = "SELECT count(stock_id) AS stock_id FROM stock WHERE stock_status = 1";
    $resultNew = $myCon->query($sqlNew) or die($myCon->error);
    $stockCount = $resultNew->fetch_all(MYSQLI_ASSOC);
    $total = $stockCount[0]['stock_id'];
    $pages = ceil($total / $limit);

    $previous = $page - 1;
    $next = $page + 1;


    //Retreive the product name of a particular stock:
    
    function getProductName($con, $Id){

        $sql = "SELECT * FROM product WHERE product_id = ?;";

        $stmt = mysqli_stmt_init($con);  

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $msg = "Error: MySQL statement Failed";
            $msg = base64_encode($msg);
            header("location: ../View/InventoryManageStocks.php?msg=$msg");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $Id);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resultData)){
            $productName = $row["product_name"];
            return $productName;
        }else{
            $msg = "Error: Couldn't fetch product names from the database";
            $msg = base64_encode($msg);
            header("location: ../View/InventoryManageStocks.php?msg=$msg");
            exit();
        }

        mysqli_stmt_close($stmt);

    }

?>