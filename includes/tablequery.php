<?php
	
	$tablequery = "useraccounts (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			firstname VARCHAR(30) NOT NULL,
			lastname VARCHAR(30) NOT NULL,
			id_num VARCHAR(30) NOT NULL,
			username VARCHAR(50) NOT NULL,
			email VARCHAR(60) NOT NULL,
			password VARCHAR(60) NOT NULL,
			usertype VARCHAR(50),
			reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 
			)";
	createTable($tablequery, $conn);

	$sql = "SELECT * FROM useraccounts WHERE username='superadmin'";
	$result = $conn->query($sql);
	if ($result->num_rows === 0){
		$sql = "INSERT INTO useraccounts (firstname, lastname, id_num, username, email, password, usertype) 
					VALUES ('super', 'admin', '1', 'superadmin', 'superadmin@gmail.com', 'super', 'admin')";
		cpeQuery($sql,$conn);
	}
	else{
		echo "Superadmin exists.";
	}
	
	$tablequery = "logs (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			name VARCHAR(30) NOT NULL,
			type VARCHAR(50) NOT NULL,
			category VARCHAR(50) NOT NULL,
			action VARCHAR(60) NOT NULL,
			faculty VARCHAR(30) NOT NULL,
			student VARCHAR(30) NOT NULL,
			time_start TIME,
			time_end TIME,
			date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
			)";
	createTable($tablequery, $conn);
	
	$tablequery = "rooms (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			room_no VARCHAR(30),
			room_type VARCHAR(50),
			seat_count INT(12),
			room_status VARCHAR(60) NOT NULL
			)";
	createTable($tablequery, $conn);
	
	$tablequery = "equipments (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			equip_code VARCHAR(20) NOT NULL,
			equip_name VARCHAR(50) NOT NULL,
			category VARCHAR(50) NOT NULL,
			total INT(5) NOT NULL,
			available INT(5) NOT NULL
			)";
	createTable($tablequery, $conn);
	
	$tablequery = "room_man (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			room_no VARCHAR(30),
			room_type VARCHAR(50),
			borrower VARCHAR(50),
			reason VARCHAR(255),
			time_start TIME,
			time_end TIME,
			status VARCHAR(50)
			)";
	createTable($tablequery, $conn);
	
	$tablequery = "eq_man (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			code VARCHAR(30),
			category VARCHAR(50),
			borrower VARCHAR(50),
			reason VARCHAR(255),
			time_start TIME,
			time_end TIME,
			status VARCHAR(50)
			)";
	createTable($tablequery, $conn);