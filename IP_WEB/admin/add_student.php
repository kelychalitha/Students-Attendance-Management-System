<?php



$msg="";
if(isset($_POST['sub'])){
	
	$name = $_POST['name'];
	$faculty = $_POST['faculty'];
	$batch = $_POST['batch'];
	$degree = $_POST['degree'];
	$uname = $_POST['uname'];
	$pass = md5($_POST['pass']);
	
	$query = mysqli_query($con,"INSERT INTO `student` (`id`, `name`, `faculty`, `batch`, `degree`, `uname`, `pass`) VALUES (NULL,'$name','$faculty','$batch','$degree','$uname','$pass')");
	
	if($query){
		$sql = mysqli_query($con,"SELECT * FROM `student` WHERE `name` = '$name' AND `uname` = '$uname'");
		$r = mysqli_fetch_array($sql);
		$idd = $r['id'];
		mysqli_query($con,"INSERT INTO `student_attendance`(`id`, `sid`, `sub_code`) VALUES (NULL,'$idd','Not Set')");
		$msg= '<div class="alert alert-success"><strong>Success!</strong> Added New Student.</div>';
	}else{
		$msg= '<div class="alert alert-danger"><strong>Something Wrong!</strong> Try Again.</div>';
	}
}


?>





<form method="post" action="">
<h2>Add Students</h2>
<?php echo $msg ?>
<table>
	<tr>
		<td>Name</td>
		<td><input type="text" class="form-control" name="name" size="50" required><br></td>
	</tr>
	<tr>
		<td>Faculty</td>
		<td>
			<select name="faculty" class="form-control">
				<option value="School of Computing">School of Computing</option>
			
			</select>
		<br>
		</td>
	</tr>
	<tr>
		<td>Batch</td>
		<td><input type="text" class="form-control" name="batch" required><br></td>
	</tr>
	<tr>
		<td>Degree</td>
		<td>
			<select name="degree" class="form-control">
				<option value="SE">SE</option>
				<option value="NS">NS</option>
			
			</select>
		
		<br></td>
	</tr>
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
		<td><input type="submit" class="btn btn-success" name="sub"><br></td>
	</tr>
	



</form>