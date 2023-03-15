<?php
	// CONNECTIONS PHP
	// CONNECTS PHP TO MYSQL

	include 'connections_functions.php';
	
	// MAIN CODE
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db_name = "cpelabman";
	
	$conn = connectDatabase("localhost", "root", "");
	createDatabase($db_name, $conn);
	$conn->select_db($db_name);
	include 'includes/tablequery.php';
	include 'includes/timesync.php';