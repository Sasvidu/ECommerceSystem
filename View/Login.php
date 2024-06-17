<!DOCTYPE html>
<html lang="en">
<head>

    <!--Template (Front-end): https://colorlib.com/wp/template/login-form-v1/-->
    <!--Author: https://colorlib.com/wp/aigars-silkalns/-->

	<title>Login</title>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--Link Page icon -->
	<link rel="icon" type="image/png" href="../Commons/icons/iconset/favicon.ico"/>

	<!--Link Imported Stylesheets -->
    <link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../Commons/vendor/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../Commons/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="../Commons/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="../Commons/vendor/select2/select2.min.css">

	<!--Link Original Stylesheets -->
	<link rel="stylesheet" type="text/css" href="../CSS/LoginStylesUtil.css">
	<link rel="stylesheet" type="text/css" href="../CSS/LoginStyles.css">

	<!--Link to fontawesome icons -->
    <script src="https://kit.fontawesome.com/0c49cb8566.js" crossorigin="anonymous"></script>

</head>
<body>
	
	<div class="limiter">

		<div class="container-login100">

            <!-- Use php to dynamically display any messages passed to the page -->
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

                    #eye-icon{
                        position: absolute;
                        top: 56%;
                        right: 30.3%;
                        cursor: pointer;
                        font-size: 1rem;
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

                    #eye-icon{
                        position: absolute;
                        top: 56%;
                        right: 30.3%;
                        cursor: pointer;
                        font-size: 1rem;
                        color: #666666;
                        z-index: 1;
                    }

                </style>
				
            <?php
            } 
            ?>

			<div class="wrap-login100">

				<!-- Add the animated image in the page -->
				<div class="login100-pic js-tilt" data-tilt>
					<img src="../Commons/Icons/img-01.png" alt="IMG">
				</div>

				<!-- The form points to the Controller for the login page -->
				<form action="../Controller/LoginController.php?status=true" method="post" class="login100-form validate-form">

					<span class="login100-form-title">
						Login
					</span>

					<!-- Email Field -->
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input id="username" name="username" class="input100" type="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<!-- Password Field -->
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input id="password" name="password" class="input100" type="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<i id="eye-icon" class="fa-solid fa-eye" onclick="showPasswordFunction()"></i>
					
					<!-- Submit Button -->
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Login
						</button>
					</div>

					<!-- Link to Forgot Password Page -->
					<div class="text-center p-t-12">
						<a class="txt2" href="UserPasswordReset.php">
                            Forgot Password?
						</a>
					</div>

					<!-- Link to Sign Up Page -->
					<div class="text-center p-t-136">
						<a class="txt2" href="SignUp.php">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>

				</form>

			</div>

		</div>

	</div>
	
	<!-- Link Imported JS files -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="../Commons/vendor/select2/select2.min.js"></script>
	<script src="../Commons/vendor/tilt/tilt.jquery.min.js"></script>
	<script>
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>

	<!-- Link own JS File-->
	<script src="../JS/LoginJS.js"></script>

</body>
</html>