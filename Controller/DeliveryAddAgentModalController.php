    <?php

    if (!isset($_GET["status"])) {

    ?>
        <script>
            window.location = "../View/DeliveryManageAgents.php"
        </script>
    <?php
        exit();
    } else {

        session_start();
        if (!isset($_SESSION["userName"])) {
            $msg = "Please login first";
            $msg = base64_encode($msg);
            header("location: ../View/Login.php?msg=$msg");
        }

        $agentName = $_POST["AgentName"];
        $agentLocation = $_POST["AgentLocation"];
        $agentAddress = $_POST["AgentAddress"];

        require_once "../Commons/ECommerceDB.php";
        require_once "../Model/DeliveryAddAgentModalModel.php";

        $thisDBConnection = new DbConnection();
        $myCon = $thisDBConnection->con;

        if (emptyInputCheck($agentName, $agentLocation, $agentAddress) === true) {
            InsertAgent($myCon, $agentName, $agentLocation, $agentAddress);
        }
    }

    ?>