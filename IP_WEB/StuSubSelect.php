<?php
include("admin/db.php");
session_start();
 if(!isset($_SESSION['uid'])){
	 Header("Location: login.php");
	 
 }
?>


<!DOCTYPE html>
<html>
<head>
	<title>Stu_Sub_Select</title>
	<link rel="stylesheet" type="text/css" href="css\style1.css">
	<style type="text/css">
		body{
			background-image: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url(lechall.jpg);
			background-size: cover;
			background-attachment:fixed;

		}
	</style>
</head>
<body>

	<div class="banner-area">
		<header>
			<a href="#" class="logo">NSBM AMS</a>

			<ul class="menu">
				<li><a href="index.html">Home</a></li>
				<li><a href="logout.php">Logout</a></li>
				<li><a href="/">Home</a></li>
				<li><a href="#">About us</a></li>

			</ul>
		</header>
		<br><br><br>
		<hr>
	</div>

	<div class="banner-text">
			<br><br>
			<?php 
			$s1 = mysqli_query($con,"SELECT * FROM `subject`");
			while($r1= mysqli_fetch_array($s1)){
			?>
				<a href="submitpage.php?id=<?php echo $r1['id']; ?>"><?php echo $r1['subject_name']; ?></a><br>
				<?php
				
			}
			
			?>
			 
			 
			
	</div>


</body>
</html>