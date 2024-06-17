<?php
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../CSS/LoginStyles.css">
    <script src="https://kit.fontawesome.com/0c49cb8566.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container">

        <div class="row">

            <div class="col-12">
                &nbsp;
            </div>

            <div class="col-12" align="center">
                <h1 style="margin: 20px">Xtreme Computers (Pvt) Ltd.</h1>
                <h5 id="dateBox">
                    </h4>
            </div>

            <div class="col-12">
                &nbsp;
            </div>

            <!--Extra complicated -->
            <?php

            if (isset($_REQUEST["msg"])) {
                $msg = ($_GET["msg"]);
                $msg = base64_decode($msg);
            ?>

                <div class="col-12 alert alert-danger" id="alertBox">
                    <p id="alert" class="noMargin">
                        <?php echo $msg; ?>
                        <!--Display only when message is available -->
                    </p>
                </div>

            <?php
            } else if (isset($_REQUEST["code"])) {
                $code = ($_GET["code"]);
                $code = base64_decode($code);
            ?>

                <div class="col-12 alert alert-success" id="alertBox">
                    <p id="alert" class="noMargin">
                        <?php echo $code; ?>
                        <!--Display only when message is available -->
                    </p>
                </div>
            <?php
            } else {
            ?>

                <div class="col-12">
                    &nbsp;
                    <!--Display empty row when when message is not available -->
                </div>

            <?php
            }
            ?>
            <!--Extra complication over -->

            <div class="col-12">
                &nbsp;
            </div>

        </div>

        <div class="row">

            <div class="col-md-4 col-sm-0">
                &nbsp;
            </div>

            <div class="col-md-4 col-sm-12 panel">

                <form action="../Controller/LoginController.php?status=true" method="post">

                    <div class="panel-heading">

                        <h3 align="center">Login</h3>

                    </div>

                    <div class="panel-body">

                        <div class="row">

                            <div class="col-12">
                                &nbsp;
                            </div>

                            <div class="col-12">
                                &nbsp;
                            </div>

                            <div class="col-12">

                                <label>Username:</label>
                                <input id="username" name="username" type="email" class="form-control" placeholder="Enter your email" onclick="getEmailHelper()">
                                <small id="emailHelper" style="font-size: 13px"></small>

                            </div>

                            <div class="col-12">
                                &nbsp;
                            </div>

                        </div>

                        <div class="row flexer">

                            <div class="col-12">

                                <label>Password:</label>
                                <input id="password" name="password" type="password" class="form-control" placeholder="Enter your password">
                                <i id="eye-icon" class="fa-solid fa-eye" onclick="showPasswordFunction()"></i>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-12">
                                <small><a id="passwordHelper" href="../View/UserPasswordReset.php"> &nbsp;Forgot Password? </a></small>
                            </div>

                            <div class="col-12">
                                &nbsp;
                            </div>

                            <div class="col-12">
                                &nbsp;
                            </div>

                            <div class="col-12" align="center">
                                <button type="submit" class="btn btn-block btn-success">Submit</button>
                            </div>

                        </div>

                    </div>

                </form>

            </div>

            <div class="col-md-4 col-sm-0">
                &nbsp;
            </div>

        </div>

        <div class="row">

            <div class="col-12">
                &nbsp;
            </div>

            <div class="col-12">
                &nbsp;
            </div>

            <div class="col-12" align="center">
                <a id="linker" href="SignUp.php">Dont have an account? Sign up!</a>
            </div>

            <div class="col-12">
                &nbsp;
            </div>

            <div class="col-12">
                &nbsp;
            </div>

        </div>

    </div>

    <script src="../JS/LoginJS.js"></script>

</body>

</html>