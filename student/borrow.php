<?php
	include '../connections.php';	
	include 'sessions.php';
?>

<HTML>
	<HEAD>
		<TITLE>Borrow - CPE Lab Room and Equipment Management System</TITLE>

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
		<script type="text/javascript" src="../assets/js/ajaxWork.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-4.0.0.min.js" ></script>

		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="../assets/css/reserve.css"></link>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
		<link rel="stylesheet" href="../assets/css/style.css"></link>

		<script>
			const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
			const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
		</script>
	</HEAD>
	
	<BODY style="background-color:#F5F5F5">
		<div class="row">
			<DIV class="col-3 px-2">
				<?php 
					include 'sidebar.php'; 
				?>
			</DIV>
			<div class="col-9 px-0">
				<div class="reservation_form container allContent-section" style="background-color: #F5F5F5">
					<div class="reservation_title">
						<u >Borrow Equipment</u>
						<hr>
					</div>
					<?php
						$id = intval($_GET['id']);
						
						$sql = "SELECT * FROM equipments WHERE id=$id";
						$result = $conn->query($sql);
						$row = $result->fetch_assoc();
						$code = $row['equip_code'];
						$equip_name = $row['equip_name'];
						$category = $row['category'];
						$description = $row['description'];
						$total = intval($row['total']);
						$available = intval($row['available']);
						
						$timeErr = '';
						$hasErr = false;
						// condition to check if start time is greater than end time
						if($_SERVER['REQUEST_METHOD'] == 'POST') {
							if($_POST["time_start"] > $_POST["time_end"]) {
							$timeErr = "Start time must not greater than end time";
							} else {
								$hasErr = true;
							}
						}
						
						// paki REQUIRED LAHAT PAGTAPOS
					?>
					<FORM METHOD="POST">
						<div class="input-group mb-3">
							<div class="input-title">Equipment Code:</div>
							<div class="input"><?php echo $code;?></div>
						</div>
						<div class="input-group mb-3">
							<div class="input-title">Equipment Name:</div>
							<div  class="input"><?php echo $equip_name;?></div>
						</div>
						<div class="input-group mb-3">
							<div class="input-title">Category:</div>
							<div  class="input"><?php echo $category;?></div>
						</div>
						<div class="input-group mb-3">
							<div class="input-title">Description:</div>
							<div  class="input"><?php echo $description;?></div>
						</div>
						<div class="input-group mb-3">
							<div class="input-title">Remaining:</div>
							<div  class="input"><?php echo $available;?></div>
						</div>
						<div class="input-group mb-3">
							<div class="input-title">Quantity:</div>
							<div  class="input"><INPUT NAME="qty" TYPE='NUMBER'></div>
						</div>						
						<div class="input-group mb-3">
							<div class="input-title">Date:</div>
							<div  class="input"><INPUT NAME="date" TYPE='DATE' REQUIRED></div>
						</div>
						<div class="input-group mb-3">
							<div class="input-title">Time:</div>
							<div class="input"><INPUT NAME="time_start" TYPE='TIME' min="07:00" max="21:00" REQUIRED > - 
							<INPUT NAME="time_end" TYPE='TIME' min="07:00" max="21:00" REQUIRED>
							<span class="error" style="color: red"><?php echo $timeErr;?></span></div>
						</div>
						<div class="input-group mb-3">
							<div class="input-title">Reason:</div>
							<div  class="input"><INPUT NAME="reason" TYPE='TEXT'></div>
						</div>
						<INPUT class="btn" style="padding-bottom: 10px;" NAME="bBorrow" TYPE='SUBMIT'>
					</FORM>
				</div>
				<?php
					if($hasErr) {
						if (isset($_POST['bBorrow'])){

							// Add quantity column
							$qty = htmlentities($_POST['qty']);						
							$date = htmlentities($_POST['date']);
							$time_start = htmlentities($_POST['time_start']);
							$time_end = htmlentities($_POST['time_end']);
							$reason = htmlentities($_POST['reason']);
	
							// Insert to SQL
							$sql = "INSERT INTO eq_man (name, category, qty, borrower, reason, date, time_start, time_end, status)
								VALUES ('$equip_name', '$category', '$qty', '".$_SESSION['username']."', '$reason', '$date', '$time_start', '$time_end', 'Pending')";
	
							if ($conn->query($sql) === TRUE) {
								header('Location: student-index.php');
							} else {
								echo "Error: " . $sql . "<br>" . $conn->error;
							}
						}
					}
				?>
			</div>
		</div>
	</BODY>
</HTML>