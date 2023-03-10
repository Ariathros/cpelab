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
		<div class="row">
			<div class="col-md-8">
				<img class="bg" src="./assets/images/pup.jpg">
			</div>
			<div class="col-md-4 flex-column">
				<img class="pup_logo" src="./assets/images/pup logo.png" width="80px" height="80px">
				<h2>Hi, PUPian!</h2>
				<p>Please click or tap your destination.</p>
				<div class="index_menu">
					<a class="btn btn-primary" href="login.php" role="button">Login</a>
					<a class="btn btn-primary" href="register.php" role="button">Register</a>
				</div>
			</div>
		</div>
	</BODY>
</HTML>