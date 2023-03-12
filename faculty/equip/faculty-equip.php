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

<HTML>
	<HEAD>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" 
		integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" 
		integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" 
		crossorigin="anonymous" referrerpolicy="no-referrer" />

		<TITLE>Equipment Reservations - CPE Lab Room and Equipment Management System</TITLE>
	</HEAD>
	
	<BODY>
		<div class="row">
			<DIV class="col-3 px-2">
				<?php
					include '../sidebar.php';
				?>
			</DIV>
			<meta name="viewport" content="width=device-width, initial-scale=1">

			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
			<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
			<script type="text/javascript" src="../assets/js/ajaxWork.js"></script>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
			<script src="https://code.jquery.com/jquery-4.0.0.min.js" ></script>

			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
			<link rel="stylesheet" href="../assets/css/style.css"></link>
			
			<DIV>
				<H1 class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #4D0000; color: white;">
				Equipment Reservations
				</H1>
			</DIV>
			
			<DIV class="container" style="padding-left:24px; padding-right:24px; ">
				<TABLE class="table table-hover text-center">
					<thead class="table-dark">
						<TR>
							<TH SCOPE="COL">Item Code</TH>
							<TH SCOPE="COL">Category</TH>					
							<TH SCOPE="COL">Quantity</TH>
							<TH SCOPE="COL">Borrower</TH>
							<TH SCOPE="COL">Date</TH>
							<TH SCOPE="COL">Time</TH>
							<TH SCOPE="COL">Actions</TH>
						</TR>
					</thead>
						
					
					<?php
						$sql = "SELECT * FROM eq_man WHERE status= 'Pending'";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							// output data of each row
							while($row = $result->fetch_assoc()) {

								$t1 = strtotime($row['time_start']);
								$t2 = strtotime($row['time_end']);
								$time_start = date('h:i A',$t1);
								$time_end = date('h:i A',$t2);
								
								echo "<TR>
									<TD>" . $row["name"]. "</TD>
									<TD>" . $row["category"]. "</TD>
									<TD>" . $row["qty"]. "</TD>
									<TD>" . $row["borrower"]. "</TD>
									<TD>" . $row["date"]. "</TD>
									<TD>" . $time_start	."-". $time_end."</TD>
									<TD>
										<A HREF='borrow-action.php?id=".$row["id"]."&action=Approved'>Approve</A>
										<A HREF='borrow-action.php?id=".$row["id"]."&action=Declined'>Decline</A>
									</TD>
								</TR>";
							}
						} else {
							echo "<TR><TD>No borrower needs equipment right now.</TD></TR>";
						}
					?>
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
		</div>
	</BODY>
</HTML>