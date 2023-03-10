<?php
	// CONNECTION FUNCTIONS
	function connectDatabase($servername, $username, $password){
		// Create connection
		$conn = new mysqli($servername, $username, $password);

		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}
		// echo "Connected successfully";
		return $conn;
	}
	
	function createDatabase($db_name, $conn){
		// Create database
		
		$sql = "CREATE DATABASE IF NOT EXISTS $db_name";
		$conn->query($sql);
		// Database Created
		$conn -> select_db($db_name);
		// echo "Database $db_name selected.";
	}
		
	function cpeQuery($sql, $conn){
		$result = $conn->query($sql);
		return $result;
	}
	
	function createTable($tablequery, $conn){
		// sql to create table
		$sql = "CREATE TABLE IF NOT EXISTS ".$tablequery;
		$conn->query($sql);
	}
	