<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../CSS/SignUpStyles.css">
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
            } else {
            ?>

                <div class="col-12">
                    &nbsp;
                    <!--Display empty row when when message is not available -->
                </div>

            <?php
            }
            ?>

            <div class="col-12">
                &nbsp;
            </div>

        </div>

        <div class="row">

            <div class="col-md-3 col-sm-0">
                &nbsp;
            </div>

            <div class="col-md-6 col-sm-12 panel">

                <form action="../Controller/SignUpController.php?status=true" method="post">

                    <div class="panel-heading">

                        <h3 align="center">Create a new account</h3>

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

                                <label>First name:</label>
                                <input id="Fname" name="Fname" type="text" class="form-control" placeholder="Enter your first name">

                            </div>

                            <div class="col-12">
                                &nbsp;
                            </div>

                            <div class="col-12">

                                <label>Last name:</label>
                                <input id="Lname" name="Lname" type="text" class="form-control" placeholder="Enter your last name">

                            </div>

                            <div class="col-12">
                                &nbsp;
                            </div>

                            <div class="col-12">

                                <label>Username:</label>
                                <input id="Email" name="Email" type="email" class="form-control" placeholder="Enter your email" onclick="getEmailHelper()">
                                <small id="emailHelper" style="font-size: 13px"></small>

                            </div>

                            <div class="col-12">
                                &nbsp;
                            </div>

                            <div class="col-12">

                                <label>Date of Birth:</label>
                                <input id="dob" name="dob" type="date" class="form-control" placeholder="Enter your birthday">

                            </div>

                            <div class="col-12">
                                &nbsp;
                            </div>

                            <div class="col-12">

                                <label>NIC:</label>
                                <input id="nic" name="nic" type="text" class="form-control" placeholder="Enter your NIC number">

                            </div>

                            <div class="col-12">
                                &nbsp;
                            </div>

                        </div>

                        <div class="row flexer">

                            <div class="col-12">

                                <label>Password:</label>
                                <input id="password" name="password" type="password" class="form-control" placeholder="Enter your password">
                                <i id="eye-icon1" class="fa-solid fa-eye" onclick="showPasswordFunction()"></i>

                            </div>

                            <div class="col-12">
                                &nbsp;
                            </div>

                            <div class="col-12">

                                <label>Confirm Password:</label>
                                <input id="Repassword" name="Repassword" type="password" class="form-control" placeholder="Re-enter your password">
                                <i id="eye-icon2" class="fa-solid fa-eye" onclick="showRePasswordFunction()"></i>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-12">
                                &nbsp;
                            </div>

                            <div class="col-12">
                                &nbsp;
                            </div>

                            <div class="col-12">
                                &nbsp;
                            </div>

                            <div class="col-12" align="center">
                                <button id="SignButton" type="submit" class="btn btn-block">Create Account</button>
                            </div>

                        </div>

                    </div>

                </form>

            </div>

            <div class="col-md-3 col-sm-0">
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
                <a href="Login.php">Already have an account? Login!</a>
            </div>

            <div class="col-12">
                &nbsp;
            </div>

            <div class="col-12">
                &nbsp;
            </div>

        </div>

    </div>

    <script src="../JS/SignUpJS.js"></script>

</body>