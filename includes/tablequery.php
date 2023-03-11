<?php
	// ACCOUNT DATABASE
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
					VALUES ('super', 'admin', '1', 'superadmin', 'superadmin@gmail.com', '$2y$10\$gnGTtdM4eyfpPwXTG1pfjugP8.QQH8.n6yIMd3oTY2rcaHnQPBqNK', 'admin')"; // Admin pass: superadmin
		cpeQuery($sql,$conn);
	}
	else{
		//echo "Superadmin exists.";
	}
	
	// LOGS DATABASE 
	$tablequery = "logs (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			name VARCHAR(30) NOT NULL,
			type VARCHAR(50) NOT NULL,
			category VARCHAR(50) NOT NULL,
			action VARCHAR(60) NOT NULL,
			faculty VARCHAR(30) NOT NULL,
			student VARCHAR(30) NOT NULL,
			date DATE,
			time_start TIME,
			time_end TIME,
			action_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
			)";
	createTable($tablequery, $conn);
	
	// ARCHIVE DATABASE 
	$tablequery = "archive (
		archive_id INT(6) UNSIGNED PRIMARY KEY,
		id INT(6) UNSIGNED,
		name VARCHAR(30) NOT NULL,
		type VARCHAR(50) NOT NULL,
		category VARCHAR(50) NOT NULL,
		action VARCHAR(60) NOT NULL,
		faculty VARCHAR(30) NOT NULL,
		student VARCHAR(30) NOT NULL,
		date DATE,
		time_start TIME,
		time_end TIME,
		action_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
		)";
	createTable($tablequery, $conn);

	// ROOMS DATABASE
	$tablequery = "rooms (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			room_no VARCHAR(30),
			room_type VARCHAR(50),
			seat_count INT(12),
			room_status VARCHAR(60) NOT NULL
			)";
	createTable($tablequery, $conn);
	
	// EQUIPS DATABASE
	$tablequery = "equipments (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			equip_code VARCHAR(20) NOT NULL,
			equip_name VARCHAR(50) NOT NULL,
			category VARCHAR(50) NOT NULL,
			description VARCHAR(255) NOT NULL,
			total INT(5) NOT NULL,
			available INT(5) NOT NULL,
			p_img VARCHAR(255) NULL
			)";
	createTable($tablequery, $conn);
	
	//  ROOM MANAGEMENT DATABASE
	$tablequery = "room_man (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			room_no VARCHAR(30),
			room_type VARCHAR(50),
			borrower VARCHAR(50),
			reason VARCHAR(255),
			time_start TIME,
			date DATE,
			time_end TIME,
			status VARCHAR(50)
			)";
	createTable($tablequery, $conn);
	
	// EQUIP MANAGEMENT DATABASE
	$tablequery = "eq_man (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			name VARCHAR(30),
			category VARCHAR(50),
			qty INT,
			borrower VARCHAR(50),
			reason VARCHAR(255),
			date DATE,
			time_start TIME,
			time_end TIME,
			status VARCHAR(50)
			)";
	createTable($tablequery, $conn);