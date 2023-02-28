<?php
	session_start();
	$_SESSION['username']=null;
	$_SESSION['usertype']=null;
	header('Location: index.php');
	