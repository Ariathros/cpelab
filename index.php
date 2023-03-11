<?php
	include 'connections.php';
	include 'sessions.php';
?>

<HTML>
	<HEAD>
		<TITLE>CPE Lab Room and Equipment Management System</TITLE>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
		<script type="text/javascript" src="../assets/js/ajaxWork.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-4.0.0.min.js" ></script>
		
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="./assets/css/style.css"></link>
	</HEAD>
	
	<BODY>
		<div class="index">
			<img class="bg" src="./assets/images/index.png">
			<nav class="navbar justify-content-between">
				<a class="navbar-brand">
					Computer Engineering Rooms and Equipment Management System
				</a>
				<!-- <button class="btn" type="submit">Register</button> -->
			</nav>	
			<div class="container ">
				<div class="d-flex">
					<div class="user_card">
						<div class="d-flex justify-content-center">
							<div class="brand_logo_container">
								<img src="./assets/images/pup logo.png" alt="Logo">
							</div>
						</div>
					<div class="d-flex justify-content-center form_container">
						<form>
							<div class="input-group mb-3">
								<div class="input-group-append">
									<span class="input-group-text"><i class="fas fa-user"></i></span>
								</div>
								<input type="text" name="" class="form-control input_user" value="" placeholder="username">
							</div>
							<div class="input-group mb-2">
								<div class="input-group-append">
									<span class="input-group-text"><i class="fas fa-key"></i></span>
								</div>
								<input type="password" name="" class="form-control input_pass" value="" placeholder="password">
							</div>
							<div class="form-group">
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="customControlInline">
									<label class="custom-control-label" for="customControlInline">Remember me</label>
								</div>
							</div>
							<div class="d-flex justify-content-center mt-3 login_container">
								<button type="button" name="button" class="btn login_btn">Login</button>
							</div>
						</form>
					</div>
					<div class="mt-4">
						<div class="links d-flex justify-content-center ">
							Don't have an account? <a href="register.php" class="ml-2">Sign Up</a>
						</div>
						<div class="links d-flex justify-content-center ">
							<a href="#">Forgot your password?</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</BODY>
</HTML>