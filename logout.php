<?php
	session_start();
	$_SESSION['username']=null;
	$_SESSION['usertype']=null;
	session_unset();
	session_destroy();
	header('Location: index.php');
?>