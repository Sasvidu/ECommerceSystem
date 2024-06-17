<?php

session_start();
if (!isset($_SESSION["userName"])) {
    $msg = "Please login first";
    $msg = base64_encode($msg);
    header("location: ../View/Login.php?msg=$msg");
}

$userName = $_SESSION['userName'];
$userId = $_SESSION['userId'];
$userImage = $_SESSION['userImage'];
$userRole = $_SESSION['userRole'];
$userEmail = $_SESSION['userEmail'];

//Specific code:

if (isset($_GET['supplierId'])) {

    $supplierId = $_GET['supplierId'];
    $length = strlen($supplierId);

    for ($i = 0; $i < $length - 1; $i++) {
        if (!ctype_digit($supplierId[$i])) {
            $msg = "Invalid Supplier Id";
            $msg = base64_encode($msg);
            header("location: ../View/SuppliersManageSuppliers.php?msg=$msg");
            exit();
        }
    }
} else {

    $msg = "Supplier ID was not passed correctly";
    $msg = base64_encode($msg);
    header("location: ../View/SuppliersManageSuppliers.php?msg=$msg");
    exit();
}

require_once "../Commons/ECommerceDB.php";
$thisDBConnection = new DbConnection();
$myCon = $thisDBConnection->con;

$sql = "SELECT * FROM suppliercontact WHERE supplierContact_status = 1 AND supplierContact_supplier_id = $supplierId ORDER BY supplierContact_type, supplierContact_value;";
$result = $myCon->query($sql) or die($myCon->error);
$resCheck = mysqli_num_rows($result);

if ($resCheck > 0) {
    $contacts = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $msg = "No records have been read form the database";
    $msg = base64_encode($msg);
    header("location: ../View/SuppliersManageSuppliers.php?msg=$msg");
    exit();
}

require_once "../Model/SupplierManageSuppliersContactModel.php";

?>

<!DOCTYPE html>
<html>

<head>

    <title>Manage Supplier Contacts</title>

    <link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../CSS/HeaderStyles.css">
    <link rel="stylesheet" type="text/css" href="../CSS/SuppliersManageSuppliersContactStyles.css">
    <script src="https://kit.fontawesome.com/0c49cb8566.js" crossorigin="anonymous"></script>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

        <a class="navbar-brand" href="#">
            <img class="logo" src="../Commons/Icons/logotest.png" alt="logo" width="50px" height="50px">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <form action="../Controller/HeaderController.php" method="post">
                <ul class="navbar-nav mr-auto navLinks">

                    <li id="nav1" class="nav-item">
                        <a class="nav-link" href="#"> <button class="btnToTxt" type="submit" name="submit" value="navHome"> Home </button> </a>
                    </li>

                    <li id="nav2" class="nav-item">
                        <a class="nav-link" href="#"> <button class="btnToTxt" type="submit" name="submit" value="navInventory"> Inventory </button> </a>
                    </li>

                    <li id="nav3" class="nav-item">
                        <a class="nav-link" href="#"> <button class="activeItem btnToTxt" type="submit" name="submit" value="navSuppliers"> Suppliers </button> </a>
                    </li>

                    <li id="nav4" class="nav-item">
                        <a class="nav-link" href="#"> <button class="btnToTxt" type="submit" name="submit" value="navStaff"> Staff </button> </a>
                    </li>

                    <li id="nav5" class="nav-item">
                        <a class="nav-link" href="#"> <button class="btnToTxt" type="submit" name="submit" value="navProfile"> Users </button> </a>
                    </li>

                    <li id="nav7" class="nav-item">
                        <a class="nav-link" href="#"> <button class="btnToTxt" type="submit" name="submit" value="navDelivery"> Deliveries </button> </a>
                    </li>

                    <li id="nav6" class="nav-item">
                        <a class="nav-link" href="#"> <button class="btnToTxt" type="submit" name="submit" value="navLogout"> Log out </button> </a>
                    </li>

                </ul>
            </form>

        </div>

    </nav>

    <br><br>

    <div class="container">

        <div class="row">
            <div class="col-12">
                <h2 class="TitleTxt">Supplier Contacts of <?php echo getSupplierName($myCon, $supplierId) ?></h2>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                &nbsp;
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                &nbsp;
            </div>
        </div>

        <div class="row">
            <div class="col-12">

                <table class="table table-striped table-hover table-bordered table-responsive">

                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Type</th>
                            <th scope="col">Value</th>
                            <th scope="th-sm">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($contacts as $contact) { ?>
                            <tr>
                                <th scope="row"><?php echo $contact['supplierContact_id'] ?></th>
                                <td id="type<?php echo $contact['supplierContact_id'] ?>"> <?php echo $contact['supplierContact_type'] ?></td>
                                <td id="value<?php echo $contact['supplierContact_id'] ?>"><?php echo $contact['supplierContact_value'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger" name="deleteButton" id="del<?php echo $contact['supplierContact_id'] ?>" onclick="openDeleteModal(this.id, <?php echo $supplierId ?>)"><i class="fa-solid fa-trash-can"></i>&nbsp;Delete</button>&nbsp;
                                    <button type="button" class="btn btn-sm btn-info" name="editButton" id="edit<?php echo $contact['supplierContact_id'] ?>" onclick="openEditModal(this.id, <?php echo $supplierId ?>)"><i class="fa-solid fa-pen-to-square"></i>&nbsp;Edit</button>&nbsp;
                                    <button type="button" class="btn btn-sm btn-half-success" name="addButton" id="add-<?php echo $contact['supplierContact_id'] ?>" onclick="openAddModal(<?php echo $supplierId ?>)"><i class="fa-solid fa-plus"></i>&nbsp;Add</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>

            </div>
        </div>

    </div>

    <?php

    include_once "../View/SuppliersAddSupplierContactModal.php";

    include_once "../View/SuppliersEditSupplierContactModal.php";

    include_once "../View/SuppliersDeleteSupplierContactModal.php";

    ?>




    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../JS/SuppliersManageSuppliersContactJS.js"></script>

    <?php

    if (isset($_GET['msg'])) {
        $msg = base64_decode($_GET['msg']);
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }

    ?>

</body>

</html>