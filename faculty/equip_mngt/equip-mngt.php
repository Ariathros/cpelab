<?php
	//include '../connections.php';	
	//include 'sessions.php';
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" 
		integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" 
		integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" 
		crossorigin="anonymous" referrerpolicy="no-referrer" />

		<title>Faculty Equipment Management - CPE Lab Room and Equipment Management System</title>
	</head>
	<body>
		<?php
			include "../sidebar.php";
		?>

		<nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #4D0000; color: white;">
            Equipment Management
        </nav>

		<div class="container">
			<?php
				if(isset($_GET['msg'])) {
					$msg = $_GET['msg'];
					echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
					'.$msg.'
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				  </div>';
				}
			?>

			<a href="create.php" class="btn btn-dark mb-3">Add New</a>

			<table class="table table-hover text-center">
				<thead class="table-dark">
					<tr>
					<TH SCOPE="COL">ID</TH>
					<TH SCOPE="COL">Code</TH>
					<TH SCOPE="COL">Name</TH>
					<TH SCOPE="COL">Category</TH>
					<TH SCOPE="COL">Total</TH>
					<TH SCOPE="COL">Available</TH>
					<TH SCOPE="COL">Action</TH>
					</tr>
				</thead>
				<tbody>
					<?php
						include '../../connections.php';
						include '../sessions.php';

						$sql = "SELECT * FROM equipments";
						$result = mysqli_query($conn, $sql);
						// This will get all data from our database
						while ($row = mysqli_fetch_assoc($result)) {
							?>
							<tr>
								<td><?php echo $row['id']?></td>
								<td><?php echo $row['equip_code']?></td>
								<td><?php echo $row['equip_name']?></td>
								<td><?php echo $row['category']?></td>
								<td><?php echo $row['total']?></td>
								<td><?php echo $row['available']?></td>
								<td><a href="edit.php?id=<?php echo $row['id']?>" class="link-dark"><i class="fa-solid fa-pen-to-square me-3"></i></a> <!--From fontawesome plugin-->
									<a href="delete.php?id=<?php echo $row['id']?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a></td>
							</tr>
							<?php
						}
					?>
				</tbody>
			</table>
		</div>
		<!-- Bootstrap -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" 
		integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
		</script>
	</body>
</html>