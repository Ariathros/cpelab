<?php
	include '../../connections.php';	
	include '../sessions.php';
	
	include '../../student/includes/room-functions.php';

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
	$record_count = mysqli_query($conn, "SELECT COUNT(*) AS total_records FROM room_man") or die(mysqli_error($conn));
	// total records
	$records = mysqli_fetch_array($record_count);
	// store total records to a variable
	$total_records = $records['total_records'];
	// get total pages
	$total_pages = ceil($total_records / $record_per_page);

	// sql query
	$sql = "SELECT * FROM room_man WHERE status= 'Pending' LIMIT $offset , $record_per_page";
	// result
	$result = $conn->query($sql);
?>

<HTML>
	<HEAD>
		
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" 
		integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" 
		integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" 
		crossorigin="anonymous" referrerpolicy="no-referrer" />
		

		<TITLE>Room Reservations - CPE Lab Room and Equipment Management System</TITLE>

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
		<script type="text/javascript" src="../../assets/js/ajaxWork.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-4.0.0.min.js" ></script>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="../../assets/css/style.css"></link>
		<link rel="stylesheet" href="../../assets/css/mediaquery.css"></link>

		<script>
			$(document).ready(function(){
				$("#myInput").on("keyup", function() {
					var value = $(this).val().toLowerCase();
					$("#myTable tr").filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
					});
				});
			});			

			$(document).on("click", "table thead tr th:not(.no-sort)", function() {
				var table = $(this).parents("table");
				var rows = $(this).parents("table").find("tbody tr").toArray().sort(TableComparer($(this).index()));
				var dir = ($(this).hasClass("sort-asc")) ? "desc" : "asc";

				if (dir == "desc") {
					rows = rows.reverse();
				}

				for (var i = 0; i < rows.length; i++) {
					table.append(rows[i]);
				}

				table.find("thead tr th").removeClass("sort-asc").removeClass("sort-desc");
				$(this).removeClass("sort-asc").removeClass("sort-desc") .addClass("sort-" + dir);
			});

			function TableComparer(index) {
				return function(a, b) {
					var val_a = TableCellValue(a, index);
					var val_b = TableCellValue(b, index);
					var result = ($.isNumeric(val_a) && $.isNumeric(val_b)) ? val_a - val_b : val_a.toString().localeCompare(val_b);

					return result;
				}
			}	

			function TableCellValue(row, index) {
				return $(row).children("td").eq(index).text();
			}
		</script>
		
	</HEAD>
	
	<BODY>
		<div class="row">
			<DIV class="col-3 px-2">
				<?php include '../sidebar.php'; ?>
			</DIV>
			<div class="col-9 px-0">
				<DIV style="padding-top:24px; padding-left:24px; padding-right:24px;">
					<H1 class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #800000; color: white;">
					Room Reservations
					</H1>
				</DIV>
				
				<DIV class="container" style="padding-left:24px; padding-right:24px; ">
					<input id="myInput" type="text" placeholder="Search.." style="float:right; border: 2px solid black;" class="mb-3">
					<TABLE class="table table-hover text-center">
						<thead class="table-dark">
							<TR>
								<TH SCOPE="COL">Room No.</TH>
								<TH SCOPE="COL">Type</TH>
								<TH SCOPE="COL">Borrower</TH>
								<TH SCOPE="COL">Date</TH>
								<TH SCOPE="COL">Time</TH>
								<TH SCOPE="COL">Actions</TH>
							</TR>
						</thead>
						<tbody id="myTable">
						<?php
							if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) { ?>
									<TR>
										<TD><?php echo $row['room_no']?></TD>
										<TD><?php echo $row['room_type']?></TD>
										<TD><?php echo $row['borrower']?></TD>
										<TD><?php echo $row['date']?></TD>
										<TD><?php echo $row['time_start'] ."-". $row['time_end']?></TD>
										<TD>
											<A class="btn btn-primary" HREF='reserve-action.php?id=<?php echo $row["id"]?> &action=Approved'><i class="fa-solid fa-check"></i> Approve</A>
											<A class="btn btn-danger" HREF='reserve-action.php?id=<?php echo $row["id"]?> &action=Declined'><i class="fa-solid fa-ban"></i> Decline</A>
										</TD>
									</TR>
									<?php
								}
							} else {
								echo "<TR><TD COLSPAN=6>No reservations need action right now.</TD></TR>";
							}
						?>
						</tbody>
					</TABLE>
					<!-- Pagination -->
					<div style="position: fixed;  bottom: 0;">
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
						<!-- Page Navigation -->
						<div class="p-10 mb-5" >
							<strong>Page <?= $page_no; ?> of <?= $total_pages; ?></strong>
						</div>
					</div>
				</DIV>
			</div>
		</div>
	</BODY>
</HTML>