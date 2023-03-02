<?php
	include '../connections.php';	
	include 'sessions.php';
?>

<HTML>
	<HEAD>
		<TITLE>Add Room - CPE Lab Room and Equipment Management System</TITLE>
	</HEAD>
	
	<BODY>
		<DIV>
			<?php include 'sidebar.php'; ?>
		</DIV>
		
		<DIV>
			<H1>Add Equipment</H1>
		</DIV>
		
		<DIV>
			<FORM METHOD="POST">
				Equipment Code: <INPUT NAME="equip_code" TYPE='TEXT'><BR>
				Equipment Name: <INPUT NAME="equip_name" TYPE='TEXT'><BR>
				Category: <INPUT NAME="category" TYPE='TEXT'><BR>
				Total: <INPUT NAME="total" TYPE='NUMBER'><BR>
				<INPUT NAME="bAdd" TYPE='SUBMIT'>
			</FORM>
		</DIV>
		
		<?php
			
			if (isset($_POST['bAdd'])){

				$equip_code = htmlentities($_POST['equip_code']);
				$equip_name = htmlentities($_POST['equip_name']);
				$category = htmlentities($_POST['category']);
				$total = htmlentities($_POST['total']);

				// Insert to SQL
				$sql = "INSERT INTO equipments (equip_code, equip_name, category, total, available)
					VALUES ('$equip_code', '$equip_name', '$category', $total, $total)";
				if ($conn->query($sql) === TRUE) {
					echo "New record created successfully";
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
			}
		?>
	</BODY>
</HTML>