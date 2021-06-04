<?php
session_start();
include("db.php");

$msg="";
if(isset($_POST['sub'])){
	
	$uname = $_POST['uname'];
	$pass = $_POST['pass'];
	
	$sql = mysqli_query($con,"SELECT * FROM `admin` WHERE `uname`='$uname' and `pass` ='$pass'");
	if(mysqli_num_rows($sql)>0){
		$row = mysqli_fetch_array($sql);
		$_SESSION['admin_id'] = $row['id'];
		Header("Location: index.php");
		
	}else{
		
		$msg= '<div class="alert alert-danger"><strong>Wrong lohin details!</strong> Try Again.</div>';
	}
	
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
			
			
<form method="post" action="">
<h2>Login</h2>
<?php echo $msg ?>
<table>
	<tr>
		<td>User Name &nbsp; &nbsp; &nbsp; </td>
		<td><input type="text" class="form-control" name="uname" required><br></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><input type="password" class="form-control" name="pass" required><br></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" class="btn btn-success" name="sub" Value="Login"><br></td>
	</tr>
	
			
			
			
			
		</div>
		
	</div>
	
</div>

</body>
</html>
