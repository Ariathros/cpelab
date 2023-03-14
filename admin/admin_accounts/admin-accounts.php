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
	$offset = ($page_no - 1) * $record_per_page;
	// get previous page
	$previous_page = $page_no - 1;
	// get nxt page
	$nextpage = $page_no + 1;
	// get the total count of records
	$record_count = mysqli_query($conn, "SELECT COUNT(*) AS total_records FROM useraccounts") or die(mysqli_error($conn));
	// total records
	$records = mysqli_fetch_array($record_count);
	// store total records to a variable
	$total_records = $records['total_records'];
	// get total pages
	$total_pages = ceil($total_records / $record_per_page);

	// sql query
	$sql = "SELECT * FROM useraccounts LIMIT $offset , $record_per_page";
	// result
	$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

	<head>
		<TITLE>Admin Account Management - CPE Lab Room and Equipment Management System</TITLE>

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
		<script type="text/javascript" src="../assets/js/ajaxWork.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-4.0.0.min.js" ></script>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="../../assets/css/style.css"></link>

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

	</head>

	<body>
		<div class="row">
			<div class="col-3 px-2">
				<?php
					include "../sidebar.php";
				?>
			</div>
			<div class="col-9 px-0" >
				<DIV style="padding-top:24px; padding-left:24px; padding-right:24px;">
					<H1 class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #4D0000; color: white;">
						Account Management
					</H1>
				</DIV>

				<div class="container" style="padding-top:24px; padding-left:24px; padding-right:24px;">
					<?php
						if(isset($_GET['msg'])) {
							$msg = $_GET['msg'];
							echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
							'.$msg.'
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
						}
					?>

					<a href="create.php" class="btn btn-success mb-3 button2 :hover">Add New</a>&emsp;

					<a href="x" download="down.xls" class="btn btn-warning mb-3 button2 :hover" id="btnExport"><i class="fa-solid fa-file-excel"></i> Export Table</a>

					<script>
						$("#btnExport").click(function (e) {
							$(this).attr({
								'download': "admin-account.xls",
									'href': 'data:application/csv;charset=utf-8,' + encodeURIComponent( $('#dvData').html())
							})
						});
					</script>

					<input id="myInput" type="text" placeholder="Search.." style="float:right; border: 2px solid black;">

					<DIV id='dvData'>
						<table class="table table-hover text-center">
							<thead class="table-dark">
								<tr>
									<th scope="col">ID</th>
									<th scope="col">First Name</th>
									<th scope="col">Last Name</th>
									<th scope="col">Username</th>
									<th scope="col">Id No.</th>
									<th scope="col">Email</th>
									<th scope="col">User Type</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody id="myTable">
								<?php
									while ($row = mysqli_fetch_assoc($result)) { ?>
										<tr>
											<td><?php echo $row['id']?></td>
											<td><?php echo $row['firstname']?></td>
											<td><?php echo $row['lastname']?></td>
											<td><?php echo $row['username']?></td>
											<td><?php echo $row['id_num']?></td>
											<td><?php echo $row['email']?></td>
											<td><?php echo $row['usertype']?></td>
											<td><a  href="edit.php?id=<?php echo $row['id']?>" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
											<button type="button" class="btn btn-danger deletebtn" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-solid fa-trash fs-5"></i> Delete</button>
											</td>
										</tr>
									<?php } ?>
							</tbody>
						</table>
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
					<section>
						<!-- Delete Warning (Bootstrap Modal) -->
						<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
							aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel"> Delete User Data </h5>
										<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>

									<form action="delete.php" method="POST">

										<div class="modal-body">

											<input type="hidden" name="delete_id" id="delete_id">

											<p> Are you sure you want to delete user? </p>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cancel </button>
											<button type="submit" name="deletedata" class="btn btn-danger"> Delete </button>
										</div>
									</form>

								</div>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
		<!-- Bootstrap -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" 
		integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
		</script>
		<!-- Modal Delete function -->
		<script>
			$(document).ready(function () {

				$('.deletebtn').on('click', function () {

					$('#deletemodal').modal('show');

					$tr = $(this).closest('tr');

					var data = $tr.children("td").map(function () {
						return $(this).text();
					}).get();

					console.log(data);

					$('#delete_id').val(data[0]);

				});
			});
		</script>
	</body>
</html>