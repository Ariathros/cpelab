<?php
	session_start();
	if (!($_SESSION['username'])){
		header("Location: /cpelab/index.php");
	}
	else{
		if (!($_SESSION['usertype']==='faculty')){
			header("Location: /cpelab/index.php");
		}
	}