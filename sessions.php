<?php
	// if(session_status() !== PHP_SESSION_ACTIVE) session_start();
	session_start();
	if (!isset($_SESSION['username'])){
		// echo "Welcome Guest!";
	}
	else{
		if ($_SESSION['usertype']==='admin'){
			header("Location: admin/admin-logs.php");
		}
		elseif ($_SESSION['usertype']==='faculty'){
			header("Location: faculty/faculty-rooms.php");
		}
		else{
			header("Location: student/student-index.php");
		}
	}