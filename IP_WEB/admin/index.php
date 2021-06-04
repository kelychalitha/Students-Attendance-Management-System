<?php
session_start();
include("db.php");
if(!isset($_SESSION['admin_id'])){
	Header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Panel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-md-12" align="center">
			<div class="card">
				<h5 class="card-header"><h3>Admin Panel</h3></h5>
				<a href="logout.php">Logout</a>
			</div>
		</div>
		
	</div>
	
	<div class="row">
		<div class="col-md-3">
			<a href="?view=student">Student details</a>
			<br>
			<a href="?view=add">Add Student</a>
			
			<br>
			<a href="?view=addL">Add Lecturer</a>
			<br>
			<a href="?view=att">Attendance details</a>
		</div>
		<div class="col-md-9">
		
			<?php
			if(isset($_GET['view'])){
				if($_GET['view'] == 'student'){
					include("student.php");
				}else if($_GET['view'] == 'att'){
					include("attendance.php");
				}else if($_GET['view'] == 'add'){
					include("add_student.php");
				}else if($_GET['view'] == 'addL'){
					include("add_lecturer.php");
				}
			}else{
					include("attendance.php");
				}
			?>
		
			<?php //include("add_student.php") ?>
		</div>
	</div>
	
</div>

</body>
</html>
