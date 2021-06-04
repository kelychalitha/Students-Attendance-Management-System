<?php



$msg="";
if(isset($_POST['sub'])){
	
	$name = mysqli_real_escape_string($con, $_POST['name']);
	$faculty = mysqli_real_escape_string($con, $_POST['faculty']); 
	$uname = mysqli_real_escape_string($con, $_POST['uname']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);
    $s_arr = explode(',', mysqli_real_escape_string($con, $_POST['subjects']));
    //var_dump($s_arr);
        $subjects = array();
    foreach($s_arr as $k => $v){
        $v = (int)$v;
        $subjects[] = $v;
    }
    //var_dump($subjects);
	
	$query = mysqli_query($con,"INSERT INTO `lecturer_login` (`name`, `faculty`, `username`, `password`, `uhash`, `subjects`) VALUES ('$name','$faculty','$uname','".md5($pass)."','".md5(date("Y-m-d H:i:s"))."','".serialize($subjects)."')");
	
	if($query){
		$msg= '<div class="alert alert-success"><strong>Success!</strong> Added New Lecturer.</div>';
	}else{
		$msg= '<div class="alert alert-danger"><strong>Something Wrong!</strong> Try Again.</div>';
	}
}


?>





<form method="post" action="">
<h2>Add Lecturers</h2>
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
		<td>User Name &nbsp; &nbsp; &nbsp; </td>
		<td><input type="text" class="form-control" name="uname" required><br></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><input type="password" class="form-control" name="pass" required><br></td>
	</tr>
    <tr>
		<td>Allowed modules for this lecturer &nbsp; &nbsp; &nbsp; </td>
		<td><input type="text" class="form-control" name="subjects" required><br>
        Possible subject id's are (must be comma separated in above field if many added!):<br>
        <?php
        $sql = mysqli_query($con,"SELECT * FROM `subject`");
        
        while($arr = mysqli_fetch_assoc($sql)){
            echo '<b>'.$arr['id'].'</b> <- '.$arr['subject_name'].' ('.$arr['descr'].')<br>';
        }
        ?>
        </td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" class="btn btn-success" name="sub"><br></td>
	</tr>
	



</form>