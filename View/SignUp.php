<!DOCTYPE html>
<html lang="en">
<head>

    <!--Template (Front-end): https://colorlib.com/wp/template/login-form-v1/-->
    <!--Author: https://colorlib.com/wp/aigars-silkalns/-->

	<title>Sign Up</title>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" type="image/png" href="../Commons/icons/iconset/favicon.ico"/>

    <link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../Commons/vendor/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../Commons/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="../Commons/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="../Commons/vendor/select2/select2.min.css">

	<link rel="stylesheet" type="text/css" href="../CSS/SignUpStylesUtil.css">
	<link rel="stylesheet" type="text/css" href="../CSS/SignUpStyles.css">

    <script src="https://kit.fontawesome.com/0c49cb8566.js" crossorigin="anonymous"></script>

</head>
<body>
	
	<div class="limiter">

		<div class="container-login100">

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

				<style>

                        #eye-icon1{
                            position: absolute;
                            top: 89.7%;
  							right: 44.2%;
                            cursor: pointer;
                            font-size: 1.1rem;
                            color: #666666;
                            z-index: 1;
                        }

                        #eye-icon2{
                            position: absolute;
                            top: 97.3%;
  							right: 44.2%;
                            cursor: pointer;
                            font-size: 1.1rem;
                            color: #666666;
                            z-index: 1;
                        }

                </style>

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

				<style>

                        #eye-icon1{
                            position: absolute;
                            top: 89.7%;
  							right: 44.2%;
                            cursor: pointer;
                            font-size: 1.1rem;
                            color: #666666;
                            z-index: 1;
                        }

                        #eye-icon2{
                            position: absolute;
                            top: 97.3%;
  							right: 44.2%;
                            cursor: pointer;
                            font-size: 1.1rem;
                            color: #666666;
                            z-index: 1;
                        }

                </style>

            <?php
            } 
            ?>
            <!--Extra complication over -->

			<div class="wrap-login100">

				<form action="../Controller/SignUpController.php?status=true" method="post" class="login100-form validate-form">

					<span class="login100-form-title">
                        Create a new account 
					</span>

                    <div class="wrap-input100 validate-input" data-validate = "First name is required">
						<input id="Fname" name="Fname" class="input100" type="text" placeholder="First Name">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

                    <div class="wrap-input100 validate-input" data-validate = "Last name is required">
						<input id="Lname" name="Lname" class="input100" type="text" placeholder="Last Name">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input id="Email" name="Email" class="input100" type="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

                    <div class="wrap-input100 validate-input" data-validate = "Date of birth is required">
						<input id="dob" name="dob" class="input100" type="date" placeholder="Date of Birth">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
                            <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
						</span>
					</div>

                    <div class="wrap-input100 validate-input" data-validate = "NIC no. is required">
						<input id="nic" name="nic" class="input100" type="text" placeholder="National Identity Card No.">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
                            <i class="fa-solid fa-id-card" aria-hidden="true"></i>
						</span>
					</div>

                    <div class="wrap-input100 validate-input" data-validate = "Address is required">
						<input id="address" name="address" class="input100" type="text" placeholder=" Residential Address">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
                            <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input id="password" name="password" class="input100" type="password" placeholder="Password">   
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<i id="eye-icon1" class="fa-solid fa-eye" onclick="showPasswordFunction()"></i>

                    <div class="wrap-input100 validate-input" data-validate = "Confirmation password is required">
						<input id="Repassword" name="Repassword" class="input100" type="password" placeholder=" Confirm Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<i id="eye-icon2" class="fa-solid fa-eye" onclick="showRePasswordFunction()"></i>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Register
						</button>
					</div>

                    <div class="row">
                        <div class="col-12">
                            &nbsp;
                        </div>

                        <div class="col-12">
                            &nbsp;
                        </div>
                    </div>

					<div class="text-center">
						<a class="txt2" href="Login.php">
                            Already have an account? Login!
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>

				</form>

			</div>

		</div>

	</div>
	
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="../Commons/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../Commons/vendor/tilt/tilt.jquery.min.js"></script>
	<script>
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="../JS/SignUpJS.js"></script>

</body>
</html>