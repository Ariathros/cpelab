<?php
	include '../../connections.php';
	include '../sessions.php';

	// get page number
	if (isset($_GET['page_no']) && $_GET['page_no'] !== "") {
		$page_no = $_GET['page_no'];
	}else {
		$page_no = 1;
	}
	// These are all required for pagination implementation
	// count of records to display per page
	$record_per_page = 10;
	// page offset for LIMIT query
	$offset = ($page_no -1) * $record_per_page;
	// get previous page
	$previous_page = $page_no - 1;
	// get nxt page
	$nextpage = $page_no + 1;
	// get the total count of records
	$record_count = mysqli_query($conn, "SELECT COUNT(*) AS total_records FROM logs") or die(mysqli_error($conn));
	// total records
	$records = mysqli_fetch_array($record_count);
	// store total records to a variable
	$total_records = $records['total_records'];
	// get total pages
	$total_pages = ceil($total_records / $record_per_page);

	// sql query
	$sql = "SELECT * FROM logs LIMIT $offset , $record_per_page";
	// result
	$result = $conn->query($sql);
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

		<title>Faculty Room Management - CPE Lab Room and Equipment Management System</title>
	</head>
	<body>
		<?php
			include "../sidebar.php";
		?>

		<nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #4D0000; color: white;">
            Room Management
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
					<TH SCOPE="COL">Room Number</TH>
					<TH SCOPE="COL">Type</TH>
					<TH SCOPE="COL">Seat Count</TH>
					<TH SCOPE="COL">Status</TH>
					<TH SCOPE="COL">Action</TH>
					</tr>
				</thead>
				<tbody>
					<?php

						$sql = "SELECT * FROM rooms";
						$result = mysqli_query($conn, $sql);
						// This will get all data from our database
						while ($row = mysqli_fetch_assoc($result)) {
							?>
							<tr>
								<td><?php echo $row['id']?></td>
								<td><?php echo $row['room_no']?></td>
								<td><?php echo $row['room_type']?></td>
								<td><?php echo $row['seat_count']?></td>
								<td><?php echo $row['room_status']?></td>
								<td><a href="edit.php?id=<?php echo $row['id']?>" class="link-dark"><i class="fa-solid fa-pen-to-square me-3"></i></a> <!--From fontawesome plugin-->
									<a href="delete.php?id=<?php echo $row['id']?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a></td>
							</tr>
							<?php
						}
					?>
				</tbody>
			</table>
			<!-- Pagination -->
		<nav aria-label="Page navigation example">
			<ul class="pagination">
			<!-- Previous -->
			<li class="page-item"><a class="page-link <?= ($page_no <= 1) ? 'disabled' : ''; ?>"
			<?= ($page_no > 1) ? 'href=?page_no=' . $previous_page : ''; ?>>Previous</a></li>
			<!-- Page Numbers -->
				<?php for($counter = 1; $counter <= $total_pages; $counter++) { ?>
					<?php if($page_no != $counter) { ?>
						<li class="page-item"><a class="page-link" href="?page_no=<?=
						$counter; ?>"><?= $counter; ?></a></li>
					<?php } else { ?>
						<li class="page-item"><a class="page-link active"><?= $counter; ?>
						</a></li>
					<?php } ?>
				<?php } ?>

				<!-- Next -->
				<li class="page-item"><a class="page-link <?= ($page_no >= $total_pages) ? 'disabled' : ''; ?>"
				<?= ($page_no < $total_pages) ? 'href=?page_no=' . $nextpage : ''; ?>>Next</a></li>
			</ul>
		</nav>
		<div class="p-10">
			<strong>Page <?= $page_no; ?> of <?= $total_pages; ?></strong>
		</div>
		</div>
		<!-- Bootstrap -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" 
		integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
		</script>
	</body>
</html>