<?php
	include '../connections.php';	
	include 'sessions.php';
?>

<HTML>
	<HEAD>
		<TITLE>Borrow - CPE Lab Room and Equipment Management System</TITLE>
	</HEAD>
	
	<BODY>		
		<DIV>
			<?php include 'sidebar.php'; ?>
		</DIV>

		<DIV>
			<H1>Borrow Equipment</H1>
		</DIV>

        <DIV>
			<?php
				$id = intval($_GET['id']);
				
				$sql = "SELECT * FROM equipments WHERE id=$id";
				$result = $conn->query($sql);
				$row = $result->fetch_assoc();
				$code = $row['equip_code'];
				$equip_name = $row['equip_name'];
				$category = $row['category'];
				$total = intval($row['total']);
				$available = intval($row['available']);
				
				
				// paki REQUIRED LAHAT PAGTAPOS
			?>

			<FORM METHOD="POST">
				Equipment Code: <?php echo $code;?><BR>
				Equipment Name: <?php echo $equip_name;?><BR>
				Remaining: <?php echo $available;?><BR>
				Quantity: <INPUT NAME="qty" TYPE='NUMBER' REQUIRED><BR>
				Time: <INPUT NAME="time_start" TYPE='TIME' REQUIRED>-<INPUT NAME="time_end" TYPE='TIME' REQUIRED><BR>
				Reason: <INPUT NAME="reason" TYPE='TEXT'><BR>
				<INPUT NAME="bBorrow" TYPE='SUBMIT'>
			</FORM>
		</DIV>
		
		<?php
			if (isset($_POST['bBorrow'])){

				// Add quantity column
				$qty = htmlentities($_POST['qty']);
				$time_start = htmlentities($_POST['time_start']);
				$time_end = htmlentities($_POST['time_end']);
				$reason = htmlentities($_POST['reason']);

				// Insert to SQL
				$sql = "INSERT INTO eq_man (name, category, borrower, reason, time_start, time_end, status)
					VALUES ('$equip_name - $qty', '$category', '".$_SESSION['username']."', '$reason', '$time_start', '$time_end', 'pending')";
				if ($conn->query($sql) === FALSE) {
					
					// CONDITIONS START HERE
					// if(condition here){
					// 	mga error output
					//  return;
					// }

					// if (condition here){
					// 	mga error output
					//  return;
					// }

					// MGA CONDITIONS (PWEDE DAGDAGAN)
					// - mas maaga time end sa time start
					// - quantity mas mataas sa remaining items na pwede hiramin
					// - negative quantity count
					// - 0 remaining items (wala nang stock)


				}
				header('Location: student-dashboard.php');
			}
		?>
	</BODY>
</HTML>