<?php
	session_start();
	if (!($_SESSION['username'])){
		header("Location: ../../index.php");
	}
	else{
		if (!($_SESSION['usertype']==='admin')){
			header("Location: ../../index.php");
		}
	}