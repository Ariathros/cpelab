<?php
	session_start();
	if (!($_SESSION['username'])){
		header("Location: ../index.php");
	}
	else{
		if (!($_SESSION['usertype']==='student')){
			header("Location: ../index.php");
		}
	}