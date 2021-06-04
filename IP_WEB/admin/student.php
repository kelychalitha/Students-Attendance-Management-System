<h2>Student Details</h2>
             
  <table class="table">
    <thead>
		<tr>
			<th>Index No</th>
			<th>Name</th>
			<th>Faculty</th>
			<th>Batch</th>
			<th>Degree</th>
			<th>Username</th>
			
		</tr>
	</thead>
	<tbody>
	
	<?php
		$sql = mysqli_query($con,"SELECT * FROM `student`");
		while($row = mysqli_fetch_array($sql)){
		
	?>
	
	
		<tr>
			<td><?php echo $row['id'] ?></td>
			<td><?php echo $row['name'] ?></td>
			<td><?php echo $row['faculty'] ?></td>
			<td><?php echo $row['batch'] ?></td>
			<td><?php echo $row['degree'] ?></td>
			<td><?php echo $row['uname'] ?></td>
			
			
		</tr>
		<?php } ?>
	
	
	</tbody>
	</table>