<?php
	// if(session_status() !== PHP_SESSION_ACTIVE) session_start();
	session_start();
	if (!isset($_SESSION['username'])){
		// echo "Welcome Guest!";
	}
	else{
		if ($_SESSION['usertype']==='admin'){
			header("Location: admin/admin_logs/admin-logs.php");
		}
		elseif ($_SESSION['usertype']==='faculty'){
			header("Location: faculty/dashboard/faculty-dashboard.php");
		}
		else{
			header("Location: student/student-index.php");
		}
	}