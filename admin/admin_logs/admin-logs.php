<?php
	include '../../connections.php';
	include '../sessions.php';

	// get page number
	if (isset($_GET['page_no']) && $_GET['page_no'] !== "") {
		$page_no = $_GET['page_no'];
	}else {
		$page_no = 1;
	}

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
<HTML lang="en">
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

		<title>Admin Logs - CPE Lab Room and Equipment Management System</title>
	</head>
	
	<BODY>
		<DIV>
			<?php
				include '../sidebar.php';
			?>
		</DIV>
		
		<DIV>
			<H1 class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #4D0000; color: white;">Logs</H1>
		</DIV>
		
		<DIV class="container">
			<TABLE class="table table-hover text-center">
				<thead class="table-dark">
					<TR>
						<TH SCOPE="COL">ID</TH>
						<TH SCOPE="COL">Name</TH>
						<TH SCOPE="COL">Type</TH>
						<TH SCOPE="COL">Category</TH>
						<TH SCOPE="COL">Action</TH>
						<TH SCOPE="COL">Action By</TH>
						<TH SCOPE="COL">Student</TH>
						<TH SCOPE="COL">Date</TH>
						<TH SCOPE="COL">Time</TH>
					</TR>
				</thead>
				<tbody>
					<?php while ($row = mysqli_fetch_array($result)) { ?>
						<tr>
							<td><?= $row['id']; ?></td>
							<td><?= $row['name']; ?></td>
							<td><?= $row['type']; ?></td>
							<td><?= $row['category']; ?></td>
							<td><?= $row['action']; ?></td>
							<td><?= $row['faculty']; ?></td>
							<td><?= $row['student']; ?></td>
							<td><?= $row['date']; ?></td>
							<td><?= $row['time_start'] . "-" . $row['time_end']; ?></td>

							<?php
								// Set record overdue to creation date + 3 months
								$startDate = strtotime($row['date']. '+3 months');
								// get the current date
								$archiveDate = strtotime(date('y-m-d'));
								// Check if record is overdue
								/*if($startDate < $archiveDate) {
									// insert overdue record to 'archive' table
									mysqli_query($conn, "INSERT INTO `archive`(`archive_id`,`id`, `name`, `type`, `category`, `action`, `faculty`, 
									`student`, `time_start`, `time_end`, `date`) VALUES ('','$row[id]',
									'$row[name]','$row[type]','$row[category]','$row[action]','$row[faculty]','$row[student]',
									'$row[time_start]','$row[time_end]','$row[date]')");
									// delete record from logs table, it will generate new reocrd to archive if not deleted
									mysqli_query($conn, "DELETE FROM `logs` WHERE '$row[id]'='$row[id]'");
								};*/
							?>
						</tr>
					<?php }
					mysqli_close($conn); ?>
				</tbody>
			</TABLE>
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
		</DIV>
		<!-- Bootstrap -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" 
		integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
		</script>
	</BODY>
</HTML>